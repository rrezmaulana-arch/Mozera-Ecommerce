<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Payment;
use App\Modules\Shared\Outbox\DomainEventDispatcher;
use App\Modules\Store\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function show(string $ulid)
    {
        $order = Order::where('ulid', $ulid)->with(['items.sku.product', 'payments'])->firstOrFail();
        $payment = $order->payments()->latest()->first();

        $snapToken = null;
        $snapError = null;

        // Only generate Snap token if order is still pending payment
        if ($order->status === 'pending_payment') {
            try {
                $snapToken = (new MidtransService())->createSnapToken($order);
            } catch (\Throwable $e) {
                Log::error('Midtrans Snap token error', [
                    'order'     => $order->order_number,
                    'message'   => $e->getMessage(),
                ]);
                $snapError = 'Gagal memuat gateway pembayaran. Silakan refresh halaman atau hubungi CS.';
            }
        }

        $clientKey  = config('services.midtrans.client_key');
        $snapUrl    = config('services.midtrans.snap_url');

        return view('shop.payment', compact('order', 'payment', 'snapToken', 'snapError', 'clientKey', 'snapUrl'));
    }

    public function simulateSuccess(Request $request, string $ulid)
    {
        if (! app()->environment(['local', 'testing'])) {
            abort(404);
        }

        $order = Order::where('ulid', $ulid)->with('payments')->firstOrFail();


        if ($order->status !== 'pending_payment') {
            return redirect()->route('shop.order.payment', $ulid)->with('info', 'Status pembayaran pesanan ini sudah: ' . $order->status);
        }

        $payment = $order->payments()->latest()->first();
        if ($payment) {
            $payment->update([
                'status'           => 'paid',
                'payment_method'   => $request->input('payment_method', 'qris'),
                'transaction_id'   => 'MID-SIM-' . strtoupper(uniqid()),
                'paid_at'          => now(),
            ]);
        }

        $order->update([
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        // Publish order.paid domain event (WMS pick queue + CRM loyalty + CRM post-purchase flow)
        DomainEventDispatcher::publish('order.paid', [
            'order_id'      => $order->id,
            'order_number'  => $order->order_number,
            'customer_id'   => $order->customer_id,
            'amount_idr'    => $order->grand_total_idr,
        ]);

        $request->session()->put('tracking_verified_' . $order->order_number, true);

        return redirect()->route('shop.tracking.detail', ['order_number' => $order->order_number])
            ->with('success', 'Pembayaran berhasil dikonfirmasi! Pesanan Anda telah masuk antrean packing gudang.');
    }

    public function simulateExpire(Request $request, string $ulid)
    {
        if (! app()->environment(['local', 'testing'])) {
            abort(404);
        }

        $order = Order::where('ulid', $ulid)->firstOrFail();


        if ($order->status === 'pending_payment') {
            $order->update([
                'status'       => 'cancelled',
                'cancelled_at' => now(),
            ]);

            DomainEventDispatcher::publish('order.cancelled', [
                'order_id'     => $order->id,
                'order_number' => $order->order_number,
            ]);

            return redirect()->route('shop.home')->with('info', "Pesanan #{$order->order_number} telah dibatalkan dan reservasi stok dikembalikan ke gudang.");
        }

        return redirect()->route('shop.home');
    }
}
