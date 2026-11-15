<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Sku;
use App\Modules\Wms\Models\Batch;
use App\Modules\Wms\Models\Inbound;
use App\Modules\Wms\Models\InboundItem;
use App\Modules\Wms\Models\Location;
use App\Modules\Wms\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WmsInboundController extends Controller
{
    public function index()
    {
        $inbounds = Inbound::with(['batch', 'location', 'items.sku.product', 'creator'])->latest()->paginate(15);
        $locations = Location::where('is_active', true)->get();
        $skus = Sku::with('product')->where('is_active', true)->get();

        return view('admin.wms.inbound.index', compact('inbounds', 'locations', 'skus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:150',
            'batch_number' => 'required|string|max:60',
            'location_id' => 'required|exists:locations,id',
            'items' => 'required|array|min:1',
            'items.*.sku_id' => 'required|exists:skus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.cost_idr' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $batch = Batch::firstOrCreate(
                ['batch_number' => trim($request->batch_number)],
                [
                    'supplier_name' => trim($request->supplier_name),
                    'notes' => $request->notes,
                    'received_at' => now(),
                ]
            );

            $inboundNumber = 'INB-' . date('Ymd') . '-' . strtoupper(Str::random(4));
            $inbound = Inbound::create([
                'ulid' => (string) Str::ulid(),
                'inbound_number' => $inboundNumber,
                'batch_id' => $batch->id,
                'location_id' => $request->location_id,
                'status' => 'completed',
                'notes' => $request->notes,
                'created_by' => auth()->id(),
                'received_at' => now(),
            ]);

            $stockService = app(StockService::class);

            foreach ($request->items as $row) {
                $sku = Sku::find($row['sku_id']);
                if (!$sku) continue;

                $qty = (int) $row['quantity'];
                $cost = (int) ($row['cost_idr'] ?? $sku->cost_idr);

                InboundItem::create([
                    'inbound_id' => $inbound->id,
                    'sku_id' => $sku->id,
                    'quantity' => $qty,
                    'cost_idr' => $cost,
                ]);

                // Record INBOUND in immutable ledger
                $stockService->recordMovement(
                    $request->location_id,
                    $sku->id,
                    'INBOUND',
                    $qty,
                    'Inbound',
                    $inbound->inbound_number,
                    "Penerimaan barang masuk dari {$batch->supplier_name}",
                    auth()->id()
                );
            }
        });

        return redirect()->route('admin.wms.inbound.index')->with('success', 'Barang masuk berhasil dicatat dan stok gudang telah diperbarui.');
    }
}

