<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Shipment;
use App\Modules\Shared\Outbox\DomainEventDispatcher;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['channel', 'customer', 'items']);

        if ($request->filled('channel_id')) {
            $query->where('channel_id', $request->channel_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', $search)
                  ->orWhere('customer_name', 'like', $search)
                  ->orWhere('customer_email', 'like', $search);
            });
        }

        $orders = $query->latest()->paginate(15);
        $channels = Channel::where('is_active', true)->get();

        return view('admin.store.orders.index', compact('orders', 'channels'));
    }

    public function show(int $id)
    {
        $order = Order::with(['channel', 'customer', 'items.sku', 'payments', 'shipments'])->findOrFail($id);
        return view('admin.store.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:pending_payment,paid,picking,packed,shipped,delivered,completed,cancelled,refunded',
            'tracking_number' => 'nullable|string',
            'courier_name' => 'nullable|string',
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $newStatus = $request->status;

        $order->status = $newStatus;

        if ($newStatus === 'paid' && !$order->paid_at) {
            $order->paid_at = now();
            DomainEventDispatcher::publish('order.paid', ['order_id' => $order->id, 'order_number' => $order->order_number]);
        } elseif ($newStatus === 'cancelled') {
            $order->cancelled_at = now();
            DomainEventDispatcher::publish('order.cancelled', ['order_id' => $order->id, 'order_number' => $order->order_number]);
        } elseif ($newStatus === 'packed') {
            DomainEventDispatcher::publish('order.packed', ['order_id' => $order->id, 'order_number' => $order->order_number]);
        }

        $order->save();

        if ($request->filled('tracking_number')) {
            Shipment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'courier_name' => $request->courier_name ?? $order->shipping_courier ?? 'JNE',
                    'tracking_number' => trim($request->tracking_number),
                    'status' => 'in_transit',
                    'shipped_at' => now(),
                ]
            );
        }

        return back()->with('success', "Status order #{$order->order_number} berhasil diubah dari {$oldStatus} ke {$newStatus}.");
    }
}

