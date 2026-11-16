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
        $statusCode = (string) ($payload['status_code'] ?? '');
        $grossAmount = (string) ($payload['gross_amount'] ?? '');
        $signatureKey = (string) ($payload['signature_key'] ?? '');

        // 1. Transaction ID must not be empty
        if (empty($transactionId) || trim($transactionId) === '') {
            return response()->json(['message' => 'Missing transaction_id'], 400);
        }

        // 2. Order ID must not be empty
        if (empty($orderNumber) || trim($orderNumber) === '') {
            return response()->json(['message' => 'Missing order_id'], 400);
        }

        // 3. Verify signature_key = sha512(order_id + status_code + gross_amount + server_key)
        $serverKey = (string) config('services.midtrans.server_key');
        $computedSignature = hash('sha512', $orderNumber . $statusCode . $grossAmount . $serverKey);

        if (! hash_equals($computedSignature, $signatureKey)) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        // 4. Order existence check
        $order = Order::where('order_number', $orderNumber)->first();
        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 5. Match incoming gross_amount with order grand_total_idr
        $incomingGross = (int) round((float) $grossAmount);
        if ($incomingGross !== (int) $order->grand_total_idr) {
            return response()->json(['message' => 'Gross amount mismatch'], 422);
        }

        // 6. Atomic Idempotent Execution
        $idempotencyKey = "webhook:midtrans:{$transactionId}";

        return IdempotencyGuard::run($idempotencyKey, function () use ($order, $transactionStatus, $transactionId, $incomingGross, $payload) {
            if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                // Do not change cancelled orders to paid; flag for manual review
                if ($order->status === 'cancelled') {
                    $order->update([
                        'notes' => trim(($order->notes ?? '') . " [REVIEW: Pembayaran diterima untuk pesanan yang sudah dibatalkan. ID Transaksi: {$transactionId}]"),
                    ]);

                    $payment = Payment::firstOrNew(['order_id' => $order->id]);
                    $payment->fill([
                        'gateway' => 'midtrans',
                        'transaction_id' => $transactionId,
                        'payment_method' => $payload['payment_type'] ?? 'qris',
                        'amount_idr' => $incomingGross,
                        'status' => 'review_required',
                        'payload' => $payload,
                        'paid_at' => now(),
                    ]);
                    $payment->save();

                    return response()->json([
                        'status' => 'review_required',
                        'order_status' => 'cancelled',
                        'message' => 'Pesanan telah dibatalkan sebelumnya. Ditandai untuk ditinjau.',
                    ]);
                }

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
                        'amount_idr' => $incomingGross,
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
