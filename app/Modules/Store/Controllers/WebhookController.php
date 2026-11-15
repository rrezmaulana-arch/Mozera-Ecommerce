<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Payment;
use App\Modules\Shared\Idempotency\IdempotencyGuard;
use App\Modules\Shared\Outbox\DomainEventDispatcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function midtrans(Request $request): JsonResponse
    {
        $payload = $request->all();
        $orderNumber = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $transactionId = $payload['transaction_id'] ?? null;

        if (!$orderNumber) {
            return response()->json(['message' => 'Missing order_id'], 400);
        }

        $idempotencyKey = "webhook:midtrans:{$transactionId}";

        return IdempotencyGuard::run($idempotencyKey, function () use ($orderNumber, $transactionStatus, $transactionId, $payload) {
            $order = Order::where('order_number', $orderNumber)->first();
            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                if ($order->status === 'pending_payment') {
                    $order->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                    ]);

                    $payment = Payment::firstOrNew(['order_id' => $order->id]);
                    $payment->fill([
                        'gateway' => 'midtrans',
                        'transaction_id' => $transactionId,
                        'payment_method' => $payload['payment_type'] ?? 'qris',
                        'amount_idr' => (int) ($payload['gross_amount'] ?? $order->grand_total_idr),
                        'status' => 'paid',
                        'payload' => $payload,
                        'paid_at' => now(),
                    ]);
                    $payment->save();

                    DomainEventDispatcher::publish('order.paid', [
                        'order_id' => $order->id,
                        'order_number' => $order->order_number,
                        'customer_id' => $order->customer_id,
                        'amount_idr' => $order->grand_total_idr,
                    ]);
                }
            } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {
                if ($order->status === 'pending_payment') {
                    $order->update(['status' => 'cancelled', 'cancelled_at' => now()]);
                    DomainEventDispatcher::publish('order.cancelled', [
                        'order_id' => $order->id,
                        'order_number' => $order->order_number,
                    ]);
                }
            }

            return response()->json(['status' => 'success', 'order_status' => $order->fresh()->status]);
        });
    }
}

