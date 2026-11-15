<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Shipment;
use App\Modules\Core\Models\Sku;
use App\Modules\Shared\Outbox\DomainEventDispatcher;
use App\Modules\Wms\Models\PickPack;
use App\Modules\Wms\Models\PickScan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WmsPickingController extends Controller
{
    public function index()
    {
        $pickPacks = PickPack::with(['order.items.sku.product', 'assignee'])
            ->whereIn('status', ['pending', 'picking'])
            ->latest()
            ->paginate(15);

        $recentPacked = PickPack::with(['order.shipments', 'assignee'])
            ->where('status', 'packed')
            ->latest('packed_at')
            ->take(10)
            ->get();

        return view('admin.wms.picking.index', compact('pickPacks', 'recentPacked'));
    }

    public function scanStation(int $id)
    {
        $pickPack = PickPack::with(['order.items.sku.product', 'scans.sku'])->findOrFail($id);
        $order = $pickPack->order;

        if ($pickPack->status === 'pending') {
            $pickPack->update([
                'status' => 'picking',
                'assigned_to' => auth()->id(),
                'picked_at' => now(),
            ]);
            $order->update(['status' => 'picking']);
        }

        // Compute scan completion status per order item
        $scannedCounts = [];
        foreach ($pickPack->scans as $scan) {
            $scannedCounts[$scan->sku_id] = ($scannedCounts[$scan->sku_id] ?? 0) + 1;
        }

        $allComplete = true;
        foreach ($order->items as $item) {
            $scanned = $scannedCounts[$item->sku_id] ?? 0;
            if ($scanned < $item->quantity) {
                $allComplete = false;
                break;
            }
        }

        return view('admin.wms.picking.scan', compact('pickPack', 'order', 'scannedCounts', 'allComplete'));
    }

    public function recordScan(Request $request, int $id)
    {
        $request->validate([
            'barcode' => 'required|string',
        ]);

        $pickPack = PickPack::with('order.items.sku')->findOrFail($id);
        $barcode = trim($request->barcode);

        // Find SKU matching barcode or SKU code
        $sku = Sku::where('barcode', $barcode)->orWhere('sku_code', $barcode)->first();

        if (!$sku) {
            return back()->with('error', "Barcode '{$barcode}' tidak ditemukan dalam katalog SKU.");
        }

        // Verify that this SKU is in the order
        $orderItem = $pickPack->order->items->firstWhere('sku_id', $sku->id);
        if (!$orderItem) {
            return back()->with('error', "PERINGATAN: Barang '{$sku->name}' (Barcode {$barcode}) BUKAN bagian dari pesanan #{$pickPack->order->order_number}!");
        }

        // Check if already fully scanned
        $alreadyScanned = PickScan::where('pick_pack_id', $pickPack->id)->where('sku_id', $sku->id)->count();
        if ($alreadyScanned >= $orderItem->quantity) {
            return back()->with('warning', "SKU '{$sku->name}' sudah lengkap dipindai ({$alreadyScanned}/{$orderItem->quantity}).");
        }

        PickScan::create([
            'pick_pack_id' => $pickPack->id,
            'sku_id' => $sku->id,
            'barcode_scanned' => $barcode,
            'scanned_at' => now(),
        ]);

        return back()->with('success', "Berhasil scan: {$sku->name} ({$sku->color} {$sku->size})");
    }

    public function completePack(Request $request, int $id)
    {
        $request->validate([
            'tracking_number' => 'nullable|string',
            'courier_name' => 'nullable|string',
        ]);

        $pickPack = PickPack::with('order')->findOrFail($id);
        $order = $pickPack->order;

        $pickPack->update([
            'status' => 'packed',
            'packed_at' => now(),
        ]);

        $order->status = 'packed';
        $order->save();

        // Publish order.packed event -> deducts physical stock in WMS
        DomainEventDispatcher::publish('order.packed', [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
        ]);

        if ($request->filled('tracking_number')) {
            Shipment::create([
                'ulid' => (string) Str::ulid(),
                'order_id' => $order->id,
                'courier_name' => $request->courier_name ?? $order->shipping_courier ?? 'JNE',
                'tracking_number' => trim($request->tracking_number),
                'status' => 'in_transit',
                'shipped_at' => now(),
            ]);

            $order->update(['status' => 'shipped']);
        }

        return redirect()->route('admin.wms.picking.index')
            ->with('success', "Order #{$order->order_number} telah selesai dipacking dan stok fisik telah dikeluarkan dari gudang.");
    }
}

