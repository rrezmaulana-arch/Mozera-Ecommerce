<?php

namespace Tests\Feature;

use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Product;
use App\Modules\Core\Models\Sku;
use App\Modules\Shared\Outbox\DomainEventDispatcher;
use App\Modules\Store\Models\Cart;
use App\Modules\Store\Models\CartItem;
use App\Modules\Store\Models\Voucher;
use App\Modules\Store\Models\VoucherRedemption;
use App\Modules\Wms\Models\Location;
use App\Modules\Wms\Models\StockBalance;
use App\Modules\Wms\Models\StockReservation;
use App\Modules\Wms\Services\StockService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Phase2StockCheckoutVoucherTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_checkout_rolls_back_when_stock_is_insufficient(): void
    {
        $sku = Sku::where('sku_code', 'PUSPA-OUT-SGE-ALL')->firstOrFail();
        $balance = StockBalance::where('sku_id', $sku->id)->firstOrFail();
        
        // Set stock to 2 pcs
        $balance->update([
            'physical_qty' => 2,
            'reserved_qty' => 0,
            'available_qty' => 2,
        ]);

        $sessionId = 'test-stock-rollback-' . uniqid();
        $cart = Cart::create(['session_id' => $sessionId, 'expires_at' => now()->addDays(7)]);
        
        // Put 5 in cart (more than available 2)
        CartItem::create([
            'cart_id' => $cart->id,
            'sku_id' => $sku->id,
            'quantity' => 5,
        ]);

        $ordersBefore = Order::count();
        $reservationsBefore = StockReservation::count();

        $response = $this->withHeaders(['X-Session-ID' => $sessionId])->post('/checkout', [
            'customer_name' => 'Siti Khadijah',
            'customer_email' => 'siti@example.com',
            'customer_phone' => '081234567890',
            'shipping_address' => 'Jl. Mawar No. 12',
            'shipping_city' => 'Jakarta Selatan',
            'shipping_province' => 'DKI Jakarta',
            'shipping_courier' => 'JNE',
        ]);

        // Should redirect back with error message about insufficient stock
        $response->assertSessionHas('error');
        $errorMessage = session('error');
        $this->assertStringContainsString('Stok tidak mencukupi', $errorMessage);

        // Order and stock reservations must be completely rolled back
        $this->assertEquals($ordersBefore, Order::count());
        $this->assertEquals($reservationsBefore, StockReservation::count());

        // Cart items must NOT be deleted
        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
            'sku_id' => $sku->id,
        ]);
    }

    public function test_domain_event_dispatcher_does_not_swallow_reservation_exception(): void
    {
        $sku = Sku::firstOrFail();
        $balance = StockBalance::where('sku_id', $sku->id)->firstOrFail();
        $balance->update(['physical_qty' => 1, 'reserved_qty' => 0, 'available_qty' => 1]);

        $order = Order::create([
            'ulid' => (string) \Illuminate\Support\Str::ulid(),
            'channel_id' => \App\Modules\Core\Models\Channel::first()->id ?? 1,
            'order_number' => 'ORD-TEST-SWALLOW',
            'customer_name' => 'Test',
            'customer_email' => 'test@example.com',
            'customer_phone' => '08123',
            'shipping_address' => 'Test Address',
            'shipping_city' => 'Jakarta',
            'shipping_province' => 'DKI',
            'shipping_courier' => 'JNE',
            'shipping_service' => 'REG',
            'subtotal_idr' => 100000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 10000,
            'grand_total_idr' => 110000,
            'status' => 'pending_payment',
        ]);

        \App\Modules\Core\Models\OrderItem::create([
            'order_id' => $order->id,
            'sku_id' => $sku->id,
            'sku_code' => $sku->sku_code,
            'product_name' => 'Test Product',
            'unit_price_idr' => 100000,
            'quantity' => 10, // Demands 10 when available is 1
            'subtotal_idr' => 1000000,
        ]);

        $this->expectException(\Throwable::class);

        DomainEventDispatcher::publish('order.created', [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
        ]);
    }

    public function test_cart_validations_max_qty_active_sku_and_stock(): void
    {
        $sku = Sku::where('sku_code', 'PUSPA-OUT-SGE-ALL')->firstOrFail();
        $balance = StockBalance::where('sku_id', $sku->id)->firstOrFail();
        $balance->update(['physical_qty' => 5, 'reserved_qty' => 0, 'available_qty' => 5]);

        // 1. Quantity > 10 should be rejected
        $response = $this->post('/cart/add', [
            'sku_id' => $sku->id,
            'quantity' => 15,
        ]);
        $response->assertSessionHasErrors('quantity');

        // 2. Inactive SKU should be rejected
        $sku->update(['is_active' => false]);
        $response = $this->post('/cart/add', [
            'sku_id' => $sku->id,
            'quantity' => 1,
        ]);
        $response->assertSessionHas('error');
        $this->assertStringContainsString('tidak tersedia', session('error'));

        // Reactivate SKU, deactivate product
        $sku->update(['is_active' => true]);
        $sku->product->update(['is_active' => false]);
        $response = $this->post('/cart/add', [
            'sku_id' => $sku->id,
            'quantity' => 1,
        ]);
        $response->assertSessionHas('error');
        $this->assertStringContainsString('tidak tersedia', session('error'));

        // Reactivate product, test stock limit (stock = 5, request = 6)
        $sku->product->update(['is_active' => true]);
        $response = $this->post('/cart/add', [
            'sku_id' => $sku->id,
            'quantity' => 6,
        ]);
        $response->assertSessionHas('error');
        $this->assertStringContainsString('tersisa 5 pcs', session('error'));
    }

    public function test_voucher_is_usable_by_method_and_rules(): void
    {
        $voucher = Voucher::create([
            'code' => 'TESTVOUCHER',
            'name' => 'Diskon Uji Coba',
            'discount_type' => 'fixed',
            'discount_amount' => 50000,
            'min_purchase_idr' => 200000,
            'quota' => 2,
            'used_count' => 0,
            'starts_at' => now()->subDay(),
            'expires_at' => now()->addDay(),
            'is_active' => true,
        ]);

        $customer = Customer::create([
            'ulid' => (string) \Illuminate\Support\Str::ulid(),
            'name' => 'Customer Test',
            'email' => 'cust@example.com',
            'phone' => '08123456789',
        ]);

        // 1. Valid conditions
        $this->assertTrue($voucher->isUsableBy(250000, $customer->id));

        // 2. Minimum purchase not met
        $this->assertFalse($voucher->isUsableBy(150000, $customer->id));

        // 3. Voucher inactive
        $voucher->update(['is_active' => false]);
        $this->assertFalse($voucher->isUsableBy(250000, $customer->id));
        $voucher->update(['is_active' => true]);

        // 4. Starts at in the future
        $voucher->update(['starts_at' => now()->addDays(2)]);
        $this->assertFalse($voucher->isUsableBy(250000, $customer->id));
        $voucher->update(['starts_at' => now()->subDay()]);

        // 5. Expired voucher
        $voucher->update(['expires_at' => now()->subHour()]);
        $this->assertFalse($voucher->isUsableBy(250000, $customer->id));
        $voucher->update(['expires_at' => now()->addDay()]);

        // 6. Quota exhausted
        $voucher->update(['used_count' => 2]);
        $this->assertFalse($voucher->isUsableBy(250000, $customer->id));
        $voucher->update(['used_count' => 0]);

        // 7. Per-customer limit: customer already redeemed
        VoucherRedemption::create([
            'voucher_id' => $voucher->id,
            'order_id' => 1,
            'customer_id' => $customer->id,
            'discount_idr' => 50000,
        ]);
        $this->assertFalse($voucher->isUsableBy(250000, $customer->id));
    }

    public function test_stock_service_prevents_negative_physical_qty(): void
    {
        $stockService = app(StockService::class);
        $location = Location::firstOrFail();
        $sku = Sku::firstOrFail();

        $balance = StockBalance::firstOrCreate(
            ['location_id' => $location->id, 'sku_id' => $sku->id],
            ['physical_qty' => 5, 'reserved_qty' => 0, 'available_qty' => 5]
        );
        $balance->update(['physical_qty' => 5, 'reserved_qty' => 0, 'available_qty' => 5]);

        $this->expectException(\RuntimeException::class);
        $this->assertStringContainsString('negatif', 'Stok fisik tidak boleh bernilai negatif');

        // Deduct 10 when physical is 5
        $stockService->recordMovement(
            $location->id,
            $sku->id,
            'PICK_OUT',
            -10
        );
    }

    public function test_checkout_rejects_expired_or_exhausted_voucher(): void
    {
        $sku = Sku::where('sku_code', 'PUSPA-OUT-SGE-ALL')->firstOrFail();
        $voucher = Voucher::create([
            'code' => 'LIMITED1',
            'name' => 'Voucher Kuota 1',
            'discount_type' => 'fixed',
            'discount_amount' => 20000,
            'min_purchase_idr' => 100000,
            'quota' => 1,
            'used_count' => 1, // already exhausted!
            'starts_at' => now()->subDay(),
            'expires_at' => now()->addDay(),
            'is_active' => true,
        ]);

        $sessionId = 'test-voucher-exhausted-' . uniqid();
        $cart = Cart::create(['session_id' => $sessionId, 'expires_at' => now()->addDays(7)]);
        CartItem::create([
            'cart_id' => $cart->id,
            'sku_id' => $sku->id,
            'quantity' => 1,
        ]);

        // Put exhausted voucher in session
        $response = $this->withHeaders(['X-Session-ID' => $sessionId])
            ->withSession(['applied_voucher' => 'LIMITED1'])
            ->post('/checkout', [
                'customer_name' => 'Budi Santoso',
                'customer_email' => 'budi@example.com',
                'customer_phone' => '081234567890',
                'shipping_address' => 'Jl. Kenanga No. 5',
                'shipping_city' => 'Bandung',
                'shipping_province' => 'Jawa Barat',
                'shipping_courier' => 'JNE',
            ]);

        $response->assertSessionHas('error');
        $this->assertStringContainsString('Voucher', session('error'));
    }
}
