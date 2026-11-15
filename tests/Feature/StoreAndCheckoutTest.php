<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Product;
use App\Modules\Core\Models\Sku;
use App\Modules\Store\Models\Cart;
use App\Modules\Store\Models\CartItem;
use App\Modules\Store\Models\Voucher;
use App\Modules\Wms\Models\StockBalance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreAndCheckoutTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_storefront_homepage_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('ITSFRIDAY');
        $response->assertSee('PUSPA');
    }

    public function test_catalog_and_fit_helper_product_detail_load(): void
    {
        $product = Product::where('slug', 'puspa-floral-outer-kimono')->firstOrFail();

        $response = $this->get('/products/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee('Fit Helper');
    }

    public function test_cart_addition_and_voucher_discount(): void
    {
        $sessionId = 'test-session-' . uniqid();
        $sku = Sku::where('sku_code', 'PUSPA-OUT-SGE-ALL')->firstOrFail();

        // 1. Add to cart
        $response = $this->withHeaders(['X-Session-ID' => $sessionId])->post('/cart/add', [
            'sku_id' => $sku->id,
            'quantity' => 1,
        ]);
        $response->assertRedirect('/cart');

        // 2. Apply voucher
        $response = $this->withHeaders(['X-Session-ID' => $sessionId])->post('/cart/voucher', [
            'code' => 'EVERYDAYFRIDAY',
        ]);
        $response->assertSessionHas('applied_voucher', 'EVERYDAYFRIDAY');

        // 3. View cart with session
        $response = $this->withHeaders(['X-Session-ID' => $sessionId])
            ->withSession(['applied_voucher' => 'EVERYDAYFRIDAY'])
            ->get('/cart');
        $response->assertStatus(200);
        $response->assertSee('EVERYDAYFRIDAY');
    }

    public function test_checkout_creates_order_and_reserves_stock(): void
    {
        $sessionId = 'test-session-' . uniqid();
        $sku = Sku::where('sku_code', 'PUSPA-OUT-SGE-ALL')->firstOrFail();
        $initialBalance = StockBalance::where('sku_id', $sku->id)->firstOrFail();
        $initialReserved = $initialBalance->reserved_qty;

        // Populate cart in session
        $this->withHeaders(['X-Session-ID' => $sessionId])->post('/cart/add', [
            'sku_id' => $sku->id,
            'quantity' => 1,
        ]);

        $response = $this->withHeaders(['X-Session-ID' => $sessionId])->post('/checkout', [
            'customer_name' => 'Test Pembeli',
            'customer_email' => 'pembeli.test@example.com',
            'customer_phone' => '081234567890',
            'shipping_address' => 'Jl. Test No. 123',
            'shipping_city' => 'Surabaya',
            'shipping_province' => 'Jawa Timur',
            'shipping_courier' => 'JNE',
            'marketing_consent' => 1,
        ]);

        $order = Order::where('customer_email', 'pembeli.test@example.com')->firstOrFail();
        $response->assertRedirect('/order/' . $order->ulid . '/payment');

        // Verify atomic stock reservation
        $newBalance = StockBalance::where('sku_id', $sku->id)->firstOrFail();
        $this->assertEquals($initialReserved + 1, $newBalance->reserved_qty);

        // Simulate payment success
        $payResponse = $this->post('/order/' . $order->ulid . '/payment/simulate');
        $payResponse->assertRedirect('/tracking/' . $order->order_number);

        $order->refresh();
        $this->assertEquals('paid', $order->status);
    }
}
