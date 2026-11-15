<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\OrderItem;
use App\Modules\Core\Models\Payment;
use App\Modules\Crm\Models\Consent;
use App\Modules\Shared\Outbox\DomainEventDispatcher;
use App\Modules\Store\Models\Cart;
use App\Modules\Store\Models\Voucher;
use App\Modules\Store\Models\VoucherRedemption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $sessionId = $request->header('X-Session-ID') ?: $request->session()->getId();
        $cart = Cart::where('session_id', $sessionId)->with('items.sku.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('shop.cart')->with('error', 'Keranjang Anda masih kosong.');
        }

        $appliedVoucherCode = $request->session()->get('applied_voucher');
        $voucher = null;
        $discountIdr = 0;

        if ($appliedVoucherCode) {
            $voucher = Voucher::where('code', $appliedVoucherCode)->where('is_active', true)->first();
            if ($voucher) {
                $discountIdr = $voucher->calculateDiscount($cart->total);
            }
        }

        // Standard shipping estimation
        $shippingCostIdr = 15000;

        return view('shop.checkout', compact('cart', 'voucher', 'discountIdr', 'shippingCostIdr'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_email' => 'required|email|max:150',
            'customer_phone' => 'required|string|max:30',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string|max:100',
            'shipping_province' => 'required|string|max:100',
            'shipping_courier' => 'required|string',
            'marketing_consent' => 'nullable|boolean',
        ]);

        $sessionId = $request->header('X-Session-ID') ?: $request->session()->getId();
        $cart = Cart::where('session_id', $sessionId)->with('items.sku.product')->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('shop.cart')->with('error', 'Keranjang belanja kosong.');
        }

        try {
            $order = DB::transaction(function () use ($request, $cart) {
                $chWeb = Channel::where('code', 'web')->firstOrFail();

                // 1. Resolve or create customer
                $customer = Customer::firstOrCreate(
                    ['email' => strtolower(trim($request->customer_email))],
                    [
                        'name' => trim($request->customer_name),
                        'phone' => trim($request->customer_phone),
                    ]
                );

                // Record consent
                Consent::updateOrCreate(
                    ['customer_id' => $customer->id, 'consent_type' => 'transactional_email'],
                    ['is_granted' => true, 'version' => 'v1.0', 'ip_address' => $request->ip(), 'updated_at' => now()]
                );
                Consent::updateOrCreate(
                    ['customer_id' => $customer->id, 'consent_type' => 'marketing_email'],
                    ['is_granted' => (bool)$request->marketing_consent, 'version' => 'v1.0', 'ip_address' => $request->ip(), 'updated_at' => now()]
                );

                // 2. Compute amounts
                $subtotalIdr = $cart->total;
                $appliedVoucherCode = $request->session()->get('applied_voucher');
                $voucher = null;
                $discountIdr = 0;

                if ($appliedVoucherCode) {
                    $voucher = Voucher::where('code', $appliedVoucherCode)->where('is_active', true)->first();
                    if ($voucher) {
                        $discountIdr = $voucher->calculateDiscount($subtotalIdr);
                    }
                }

                $courierRates = ['JNE' => 15000, 'SiCepat' => 18000, 'J&T' => 16000];
                $shippingCostIdr = $courierRates[$request->shipping_courier] ?? 15000;
                $grandTotalIdr = max(0, $subtotalIdr - $discountIdr + $shippingCostIdr);

                // 3. Create Order
                $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5));

                $order = Order::create([
                    'ulid' => (string) Str::ulid(),
                    'order_number' => $orderNumber,
                    'channel_id' => $chWeb->id,
                    'customer_id' => $customer->id,
                    'customer_name' => $customer->name,
                    'customer_email' => $customer->email,
                    'customer_phone' => $customer->phone,
                    'shipping_address' => $request->shipping_address,
                    'shipping_city' => $request->shipping_city,
                    'shipping_province' => $request->shipping_province,
                    'shipping_courier' => $request->shipping_courier,
                    'shipping_service' => 'REG',
                    'subtotal_idr' => $subtotalIdr,
                    'discount_idr' => $discountIdr,
                    'shipping_cost_idr' => $shippingCostIdr,
                    'grand_total_idr' => $grandTotalIdr,
                    'status' => 'pending_payment',
                    'notes' => $request->notes,
                ]);

                // 4. Order Items
                foreach ($cart->items as $cartItem) {
                    $sku = $cartItem->sku;
                    OrderItem::create([
                        'order_id' => $order->id,
                        'sku_id' => $sku->id,
                        'sku_code' => $sku->sku_code,
                        'product_name' => $sku->product->name,
                        'variant_name' => trim(($sku->color ?? '') . ' ' . ($sku->size ?? '')),
                        'unit_price_idr' => $sku->price_idr,
                        'cost_idr' => $sku->cost_idr,
                        'quantity' => $cartItem->quantity,
                        'subtotal_idr' => $sku->price_idr * $cartItem->quantity,
                    ]);
                }

                // 5. Voucher redemption
                if ($voucher && $discountIdr > 0) {
                    VoucherRedemption::create([
                        'voucher_id' => $voucher->id,
                        'order_id' => $order->id,
                        'customer_id' => $customer->id,
                        'discount_idr' => $discountIdr,
                    ]);
                    $voucher->increment('used_count');
                }

                // 6. Payment placeholder
                Payment::create([
                    'ulid' => (string) Str::ulid(),
                    'order_id' => $order->id,
                    'gateway' => 'midtrans',
                    'amount_idr' => $grandTotalIdr,
                    'status' => 'pending',
                    'idempotency_key' => 'IDEMP-' . $order->order_number,
                ]);

                return $order;
            });

            // 7. Publish order.created domain event (atomic stock reservation in WMS)
            DomainEventDispatcher::publish('order.created', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
            ]);

            // Clear cart & voucher
            $cart->items()->delete();
            $request->session()->forget('applied_voucher');

            return redirect()->route('shop.order.payment', ['ulid' => $order->ulid]);
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage())->withInput();
        }
    }
}

