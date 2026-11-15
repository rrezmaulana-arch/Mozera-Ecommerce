<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Order;
use App\Modules\Crm\Models\ActionItem;
use App\Modules\Store\Models\ReturnItem;
use App\Modules\Store\Models\ReturnRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $order = null;
        if ($request->filled('order_number')) {
            $order = Order::where('order_number', strtoupper(trim($request->order_number)))
                ->whereIn('status', ['delivered', 'completed'])
                ->with(['items.sku.product'])
                ->first();
        }

        return view('shop.returns', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'sku_id' => 'required|exists:skus,id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $order = Order::findOrFail($request->order_id);

        $returnRequest = ReturnRequest::create([
            'ulid' => (string) Str::ulid(),
            'order_id' => $order->id,
            'customer_id' => $order->customer_id,
            'status' => 'submitted',
            'reason' => $request->reason,
            'notes' => $request->notes,
        ]);

        ReturnItem::create([
            'return_request_id' => $returnRequest->id,
            'sku_id' => $request->sku_id,
            'quantity' => $request->quantity,
            'disposition' => 'pending',
        ]);

        // Create action item for Owner/Admin
        ActionItem::create([
            'ulid' => (string) Str::ulid(),
            'category' => 'PENDING_RETURN',
            'priority' => 'high',
            'title' => "Permintaan Retur Baru: Order #{$order->order_number}",
            'description' => "Alasan: {$request->reason}. Pelanggan: {$order->customer_name}.",
            'action_url' => "/admin/store/returns/{$returnRequest->id}",
            'status' => 'pending',
        ]);

        return redirect()->route('shop.returns')->with('success', "Permintaan retur untuk pesanan #{$order->order_number} berhasil diajukan. Tim gudang kami akan meninjau dan mengirimkan instruksi pengembalian.");
    }
}

