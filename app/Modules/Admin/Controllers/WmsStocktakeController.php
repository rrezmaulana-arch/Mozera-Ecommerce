<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Sku;
use App\Modules\Wms\Models\Location;
use App\Modules\Wms\Models\StockBalance;
use App\Modules\Wms\Models\Stocktake;
use App\Modules\Wms\Models\StocktakeLine;
use App\Modules\Wms\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WmsStocktakeController extends Controller
{
    public function index()
    {
        $stocktakes = Stocktake::with(['location', 'creator', 'lines'])->latest()->paginate(15);
        $locations = Location::where('is_active', true)->get();

        return view('admin.wms.stocktake.index', compact('stocktakes', 'locations'));
    }

    public function create(Request $request)
    {
        $request->validate(['location_id' => 'required|exists:locations,id']);

        $location = Location::findOrFail($request->location_id);
        $code = 'STK-' . date('Ymd') . '-' . $location->code;

        $stocktake = Stocktake::create([
            'ulid' => (string) Str::ulid(),
            'code' => $code,
            'location_id' => $location->id,
            'status' => 'in_progress',
            'created_by' => auth()->id(),
        ]);

        // Prepopulate lines from existing balances
        $balances = StockBalance::where('location_id', $location->id)->get();
        foreach ($balances as $b) {
            StocktakeLine::create([
                'stocktake_id' => $stocktake->id,
                'sku_id' => $b->sku_id,
                'expected_qty' => $b->physical_qty,
                'counted_qty' => $b->physical_qty,
                'difference_qty' => 0,
            ]);
        }

        return redirect()->route('admin.wms.stocktake.show', $stocktake->id)
            ->with('success', "Sesi Stock Opname {$stocktake->code} berhasil dimulai.");
    }

    public function show(int $id)
    {
        $stocktake = Stocktake::with(['location', 'creator', 'lines.sku.product'])->findOrFail($id);
        return view('admin.wms.stocktake.show', compact('stocktake'));
    }

    public function updateLines(Request $request, int $id)
    {
        $stocktake = Stocktake::with('lines')->findOrFail($id);

        if ($stocktake->status === 'completed') {
            return back()->with('error', 'Sesi stock opname ini sudah selesai dan tidak dapat diubah lagi.');
        }

        $counted = $request->input('counted', []);

        foreach ($counted as $lineId => $qty) {
            $line = $stocktake->lines->firstWhere('id', $lineId);
            if ($line) {
                $qty = (int) $qty;
                $line->counted_qty = $qty;
                $line->difference_qty = $qty - $line->expected_qty;
                $line->save();
            }
        }

        return back()->with('success', 'Hasil hitung fisik berhasil disimpan.');
    }

    public function finalize(Request $request, int $id)
    {
        $stocktake = Stocktake::with('lines')->findOrFail($id);

        if ($stocktake->status === 'completed') {
            return back()->with('error', 'Sesi sudah selesai.');
        }

        DB::transaction(function () use ($stocktake) {
            $stockService = app(StockService::class);

            foreach ($stocktake->lines as $line) {
                if ($line->difference_qty != 0) {
                    // Record OPNAME_ADJUST into immutable ledger
                    $stockService->recordMovement(
                        $stocktake->location_id,
                        $line->sku_id,
                        'OPNAME_ADJUST',
                        $line->difference_qty,
                        'Stocktake',
                        $stocktake->code,
                        "Penyesuaian hasil stock opname {$stocktake->code} (Fisik: {$line->counted_qty}, Sistem: {$line->expected_qty})",
                        auth()->id()
                    );
                }
            }

            $stocktake->status = 'completed';
            $stocktake->completed_at = now();
            $stocktake->save();
        });

        return redirect()->route('admin.wms.stocktake.index')
            ->with('success', "Stock opname {$stocktake->code} selesai. Selisih telah otomatis disesuaikan ke ledger stok.");
    }
}

