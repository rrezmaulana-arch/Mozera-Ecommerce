<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Shipment;
use App\Modules\Shared\Audit\AuditLogger;
use App\Modules\Shared\Outbox\DomainEventDispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'tracking_number' => 'nullable|string|max:100',
            'courier_name' => 'nullable|string|max:50',
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $newStatus = $request->status;

        if ($oldStatus === $newStatus) {
            return back()->with('info', "Status pesanan sudah {$oldStatus}.");
        }

        // State Machine validation
        $allowedTransitions = [
            'pending_payment' => ['paid', 'cancelled'],
            'paid' => ['picking', 'cancelled', 'refunded'],
            'picking' => ['packed', 'cancelled'],
            'packed' => ['shipped', 'cancelled'],
            'shipped' => ['delivered'],
            'delivered' => ['completed', 'returned'],
            'completed' => ['returned'],
            'cancelled' => [],
            'refunded' => [],
            'returned' => [],
        ];

        if (! in_array($newStatus, $allowedTransitions[$oldStatus] ?? [], true)) {
            return back()->with('error', "Perubahan status dari '{$oldStatus}' langsung ke '{$newStatus}' tidak diizinkan oleh sistem.");
        }

        DB::transaction(function () use ($order, $request, $oldStatus, $newStatus) {
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

            // Audit Logger
            AuditLogger::log(
                action: 'order.status_update',
                entityType: 'Order',
                entityId: $order->id,
                oldValues: ['status' => $oldStatus],
                newValues: [
                    'status' => $newStatus,
                    'tracking_number' => $request->tracking_number,
                    'courier_name' => $request->courier_name,
                ],
                userId: auth()->id()
            );
        });

        return back()->with('success', "Status order #{$order->order_number} berhasil diubah dari {$oldStatus} ke {$newStatus}.");
    }
}
