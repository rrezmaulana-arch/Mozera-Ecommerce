<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\OrderItem;
use App\Modules\Core\Models\Sku;
use App\Modules\Wms\Models\PurchaseOrder;
use App\Modules\Wms\Models\PurchaseOrderItem;
use App\Modules\Wms\Models\StockBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WmsReorderController extends Controller
{
    public function index(Request $request)
    {
        // 1. Low stock items (available <= 10)
        $balances = StockBalance::with(['sku.product', 'location'])
            ->where('location_id', 1) // Gudang Pusat
            ->get();

        $reorderNeeded = $balances->filter(function ($b) {
            return $b->available_qty <= 10;
        });

        // 2. Dead stock: SKUs with 0 sales in last 30 days
        $activeSkuIds = OrderItem::where('created_at', '>=', now()->subDays(30))->pluck('sku_id')->unique();
        $deadStocks = $balances->filter(function ($b) use ($activeSkuIds) {
            return $b->physical_qty > 0 && !$activeSkuIds->contains($b->sku_id);
        });

        // 3. Purchase Orders
        $purchaseOrders = PurchaseOrder::with(['items.sku.product', 'creator'])->latest()->paginate(10);
        $allSkus = Sku::with('product')->where('is_active', true)->get();

        return view('admin.wms.reorder.index', compact('reorderNeeded', 'deadStocks', 'purchaseOrders', 'allSkus'));
    }

    public function createPo(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:150',
            'expected_arrival_date' => 'nullable|date',
            'items' => 'required|array|min:1',
            'items.*.sku_id' => 'required|exists:skus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.cost_idr' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $poNumber = 'PO-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $totalCost = 0;

        $po = PurchaseOrder::create([
            'ulid' => (string) Str::ulid(),
            'po_number' => $poNumber,
            'supplier_name' => $request->supplier_name,
            'status' => 'draft',
            'expected_arrival_date' => $request->expected_arrival_date,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
        ]);

        foreach ($request->items as $row) {
            $sku = Sku::find($row['sku_id']);
            if (!$sku) continue;

            $qty = (int) $row['quantity'];
            $cost = (int) ($row['cost_idr'] ?? $sku->cost_idr);
            $lineTotal = $qty * $cost;
            $totalCost += $lineTotal;

            PurchaseOrderItem::create([
                'purchase_order_id' => $po->id,
                'sku_id' => $sku->id,
                'quantity' => $qty,
                'cost_idr' => $cost,
            ]);
        }

        $po->update(['total_cost_idr' => $totalCost]);

        return redirect()->route('admin.wms.reorder')->with('success', "Draft Purchase Order {$po->po_number} berhasil dibuat (Total: Rp " . number_format($totalCost, 0, ',', '.') . ").");
    }
}

