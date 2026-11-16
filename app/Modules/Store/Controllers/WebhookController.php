<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Payment;
use App\Modules\Shared\Idempotency\IdempotencyGuard;
use App\Modules\Shared\Outbox\DomainEventDispatcher;
use App\Modules\Wms\Services\StockService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    protected const ALLOWED_STATUSES = [
        'capture',
        'settlement',
        'pending',
        'deny',
        'cancel',
        'expire',
        'refund',
    ];

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

        // 3. Validate status_code and transaction_status
        if (! in_array($transactionStatus, self::ALLOWED_STATUSES, true) || trim($statusCode) === '') {
            return response()->json(['message' => 'Invalid transaction_status or status_code'], 422);
        }

        // 4. Verify server_key configuration - reject if empty with 503, never verify with empty string
        $serverKey = (string) config('services.midtrans.server_key');
        if (trim($serverKey) === '') {
            Log::error('Midtrans server key is not configured in services.midtrans.server_key.');
            return response()->json(['message' => 'Payment gateway service unavailable'], 503);
        }

        // 5. Verify signature_key = sha512(order_id + status_code + gross_amount + server_key)
        $computedSignature = hash('sha512', $orderNumber . $statusCode . $grossAmount . $serverKey);
        if (! hash_equals($computedSignature, $signatureKey)) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        // 6. Order existence check
        $order = Order::where('order_number', $orderNumber)->first();
        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 7. Match incoming gross_amount with order grand_total_idr
        $incomingGross = (int) round((float) $grossAmount);
        if ($incomingGross !== (int) $order->grand_total_idr) {
            return response()->json(['message' => 'Gross amount mismatch'], 422);
        }

        // 8. Atomic Idempotent Execution incorporating transaction_status
        $idempotencyKey = "webhook:midtrans:{$transactionId}:{$transactionStatus}";

        return IdempotencyGuard::run($idempotencyKey, function () use ($order, $transactionStatus, $transactionId, $incomingGross, $payload) {
            if ($transactionStatus === 'pending') {
                if ($order->status === 'pending_payment') {
                    $payment = Payment::firstOrNew(['order_id' => $order->id]);
                    $payment->fill([
                        'gateway' => 'midtrans',
                        'transaction_id' => $transactionId,
                        'payment_method' => $payload['payment_type'] ?? 'qris',
                        'amount_idr' => $incomingGross,
                        'status' => 'pending',
                        'payload' => $payload,
                    ]);
                    $payment->save();
                }

                return response()->json([
                    'status' => 'pending',
                    'order_status' => $order->fresh()->status,
                ]);
            }

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
            } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'], true)) {
                if ($order->status === 'pending_payment') {
                    $order->update([
                        'status' => 'cancelled',
                        'cancelled_at' => now(),
                    ]);

                    // Release reserved stock synchronously
                    app(StockService::class)->releaseOrderStock($order);

                    $payment = Payment::firstOrNew(['order_id' => $order->id]);
                    $payment->fill([
                        'gateway' => 'midtrans',
                        'transaction_id' => $transactionId,
                        'payment_method' => $payload['payment_type'] ?? 'qris',
                        'amount_idr' => $incomingGross,
                        'status' => $transactionStatus,
                        'payload' => $payload,
                    ]);
                    $payment->save();

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
