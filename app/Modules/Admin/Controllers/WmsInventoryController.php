<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Sku;
use App\Modules\Wms\Models\Location;
use App\Modules\Wms\Models\StockBalance;
use App\Modules\Wms\Models\StockMovement;
use App\Modules\Wms\Services\StockService;
use Illuminate\Http\Request;

class WmsInventoryController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::where('is_active', true)->get();
        $selectedLocationId = $request->location_id ?? $locations->first()?->id;

        $balances = StockBalance::with(['sku.product', 'location'])
            ->when($selectedLocationId, function ($q) use ($selectedLocationId) {
                $q->where('location_id', $selectedLocationId);
            })
            ->get();

        $movementsQuery = StockMovement::with(['sku.product', 'location'])->latest('created_at');

        if ($request->filled('movement_type')) {
            $movementsQuery->where('movement_type', $request->movement_type);
        }

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $movementsQuery->whereHas('sku', function ($q) use ($search) {
                $q->where('sku_code', 'like', $search)->orWhere('name', 'like', $search);
            });
        }

        $movements = $movementsQuery->paginate(20);
        $skus = Sku::with('product')->where('is_active', true)->get();

        return view('admin.wms.inventory.index', compact('balances', 'movements', 'locations', 'selectedLocationId', 'skus'));
    }

    public function adjust(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'sku_id' => 'required|exists:skus,id',
            'quantity' => 'required|integer|not_in:0',
            'notes' => 'required|string',
        ]);

        $stockService = app(StockService::class);
        $stockService->recordMovement(
            $request->location_id,
            $request->sku_id,
            'ADJUST',
            $request->quantity,
            'ManualAdjustment',
            'ADJ-' . uniqid(),
            $request->notes,
            auth()->id()
        );

        return back()->with('success', 'Penyesuaian stok (ADJUST) berhasil dicatat ke buku besar ledger.');
    }
}

