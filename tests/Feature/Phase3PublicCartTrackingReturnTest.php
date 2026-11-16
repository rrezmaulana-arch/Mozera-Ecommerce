<?php

namespace Tests\Feature;

use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\OrderItem;
use App\Modules\Core\Models\Sku;
use App\Modules\Store\Models\ReturnItem;
use App\Modules\Store\Models\ReturnRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Phase3PublicCartTrackingReturnTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_tracking_requires_verification_and_masks_sensitive_data(): void
    {
        $channel = Channel::firstOrFail();
        $order = Order::create([
            'ulid' => (string) \Illuminate\Support\Str::ulid(),
            'channel_id' => $channel->id,
            'order_number' => 'ORD-TRACK-001',
            'customer_name' => 'Siti Nurhaliza',
            'customer_email' => 'siti.nurhaliza@example.com',
            'customer_phone' => '081234567890',
            'shipping_address' => 'Jl. Rungkut Industri Raya No. 45 Blok B',
            'shipping_city' => 'Surabaya',
            'shipping_province' => 'Jawa Timur',
            'shipping_courier' => 'JNE',
            'shipping_service' => 'REG',
            'subtotal_idr' => 200000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 15000,
            'grand_total_idr' => 215000,
            'status' => 'shipped',
        ]);

        // 1. Request with order number but NO verification contact
        $resNoVerification = $this->get('/tracking?order_number=' . $order->order_number);
        $resNoVerification->assertSessionHas('error');
        $this->assertStringContainsString('Wajib memasukkan email', session('error'));

        // 2. Request with WRONG email / phone
        $resWrongVerification = $this->get('/tracking?order_number=' . $order->order_number . '&verification=wrong@example.com');
        $resWrongVerification->assertSessionHas('error');
        $this->assertStringContainsString('tidak cocok', session('error'));

        // 3. Request with valid matching email
        $resValidEmail = $this->get('/tracking?order_number=' . $order->order_number . '&verification=siti.nurhaliza@example.com');
        $resValidEmail->assertStatus(200);
        $resValidEmail->assertSee('ORD-TRACK-001');
        // Check data masking for privacy (UU PDP)
        $resValidEmail->assertDontSee('Jl. Rungkut Industri Raya No. 45 Blok B');
        $resValidEmail->assertSee('disensor');

        // 4. Request with valid matching last 4 digits of phone ('7890')
        $resValidPhone = $this->get('/tracking?order_number=' . $order->order_number . '&verification=7890');
        $resValidPhone->assertStatus(200);
        $resValidPhone->assertSee('ORD-TRACK-001');
    }

    public function test_return_validations_ownership_delivered_status_and_sku(): void
    {
        $channel = Channel::firstOrFail();
        $sku1 = Sku::firstOrFail();
        $sku2 = Sku::where('id', '!=', $sku1->id)->firstOrFail();

        // 1. Order that is still paid (NOT delivered)
        $orderPaid = Order::create([
            'ulid' => (string) \Illuminate\Support\Str::ulid(),
            'channel_id' => $channel->id,
            'order_number' => 'ORD-RETURN-PAID',
            'customer_name' => 'Fatimah Az Zahra',
            'customer_email' => 'fatimah@example.com',
            'customer_phone' => '081298765432',
            'shipping_address' => 'Jl. Kenanga No. 10',
            'shipping_city' => 'Jakarta',
            'shipping_province' => 'DKI',
            'shipping_courier' => 'JNE',
            'shipping_service' => 'REG',
            'subtotal_idr' => 150000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 15000,
            'grand_total_idr' => 165000,
            'status' => 'paid', // not delivered
        ]);

        OrderItem::create([
            'order_id' => $orderPaid->id,
            'sku_id' => $sku1->id,
            'sku_code' => $sku1->sku_code,
            'product_name' => 'Product 1',
            'unit_price_idr' => 150000,
            'quantity' => 1,
            'subtotal_idr' => 150000,
        ]);

        $resPaidReturn = $this->post('/returns', [
            'order_id' => $orderPaid->id,
            'customer_email' => 'fatimah@example.com',
            'sku_id' => $sku1->id,
            'quantity' => 1,
            'reason' => 'Tukar Ukuran',
        ]);
        $resPaidReturn->assertSessionHas('error');
        $this->assertStringContainsString('terkirim', session('error'));

        // 2. Order delivered, but email does not match
        $orderPaid->update(['status' => 'delivered']);
        $resWrongOwner = $this->post('/returns', [
            'order_id' => $orderPaid->id,
            'customer_email' => 'attacker@example.com',
            'sku_id' => $sku1->id,
            'quantity' => 1,
            'reason' => 'Tukar Ukuran',
        ]);
        $resWrongOwner->assertSessionHas('error');
        $this->assertStringContainsString('Email pemesan tidak cocok', session('error'));

        // 3. Order delivered, correct email, but SKU does not belong to order
        $resWrongSku = $this->post('/returns', [
            'order_id' => $orderPaid->id,
            'customer_email' => 'fatimah@example.com',
            'sku_id' => $sku2->id,
            'quantity' => 1,
            'reason' => 'Tukar Ukuran',
        ]);
        $resWrongSku->assertSessionHas('error');
        $this->assertStringContainsString('tidak terdaftar', session('error'));
    }

    public function test_return_quantity_and_duplicate_active_protection(): void
    {
        $channel = Channel::firstOrFail();
        $sku = Sku::firstOrFail();

        $order = Order::create([
            'ulid' => (string) \Illuminate\Support\Str::ulid(),
            'channel_id' => $channel->id,
            'order_number' => 'ORD-RETURN-QTY',
            'customer_name' => 'Aisyah Putri',
            'customer_email' => 'aisyah@example.com',
            'customer_phone' => '081211112222',
            'shipping_address' => 'Jl. Melati No. 5',
            'shipping_city' => 'Bandung',
            'shipping_province' => 'Jawa Barat',
            'shipping_courier' => 'SiCepat',
            'shipping_service' => 'REG',
            'subtotal_idr' => 200000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 18000,
            'grand_total_idr' => 218000,
            'status' => 'delivered',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'sku_id' => $sku->id,
            'sku_code' => $sku->sku_code,
            'product_name' => 'Baju Aisyah',
            'unit_price_idr' => 100000,
            'quantity' => 2, // Bought 2 pcs
            'subtotal_idr' => 200000,
        ]);

        // 1. Submit return with qty 5 (exceeds purchased 2 pcs)
        $resExceedQty = $this->post('/returns', [
            'order_id' => $order->id,
            'customer_email' => 'aisyah@example.com',
            'sku_id' => $sku->id,
            'quantity' => 5,
            'reason' => 'Tukar Ukuran',
        ]);
        $resExceedQty->assertSessionHas('error');
        $this->assertStringContainsString('melebihi batas maksimal', session('error'));

        // 2. Submit valid return for 1 pc
        $resSuccess = $this->post('/returns', [
            'order_id' => $order->id,
            'customer_email' => 'aisyah@example.com',
            'sku_id' => $sku->id,
            'quantity' => 1,
            'reason' => 'Tukar Ukuran',
        ]);
        $resSuccess->assertSessionHas('success');

        // 3. Duplicate active return: submitting again while first is submitted/pending
        $resDuplicate = $this->post('/returns', [
            'order_id' => $order->id,
            'customer_email' => 'aisyah@example.com',
            'sku_id' => $sku->id,
            'quantity' => 1,
            'reason' => 'Tukar Ukuran',
        ]);
        $resDuplicate->assertSessionHas('error');
        $this->assertStringContainsString('sedang diproses', session('error'));
    }

    public function test_checkout_validation_rules_for_phone_courier_and_notes(): void
    {
        $sku = Sku::firstOrFail();
        $sessionId = 'test-checkout-val-' . uniqid();

        // 1. Invalid courier
        $resBadCourier = $this->post('/checkout', [
            'customer_name' => 'Test User',
            'customer_email' => 'test@example.com',
            'customer_phone' => '081234567890',
            'shipping_address' => 'Alamat valid',
            'shipping_city' => 'Jakarta',
            'shipping_province' => 'DKI',
            'shipping_courier' => 'WahanaExpress', // Invalid courier
        ]);
        $resBadCourier->assertSessionHasErrors('shipping_courier');

        // 2. Invalid phone format
        $resBadPhone = $this->post('/checkout', [
            'customer_name' => 'Test User',
            'customer_email' => 'test@example.com',
            'customer_phone' => '123456', // Invalid regex
            'shipping_address' => 'Alamat valid',
            'shipping_city' => 'Jakarta',
            'shipping_province' => 'DKI',
            'shipping_courier' => 'JNE',
        ]);
        $resBadPhone->assertSessionHasErrors('customer_phone');

        // 3. Notes too long (> 500 chars)
        $resLongNotes = $this->post('/checkout', [
            'customer_name' => 'Test User',
            'customer_email' => 'test@example.com',
            'customer_phone' => '081234567890',
            'shipping_address' => 'Alamat valid',
            'shipping_city' => 'Jakarta',
            'shipping_province' => 'DKI',
            'shipping_courier' => 'JNE',
            'notes' => str_repeat('A', 501), // 501 chars
        ]);
        $resLongNotes->assertSessionHasErrors('notes');
    }

    public function test_tracking_detail_route_requires_verification_or_session(): void
    {
        $channel = Channel::firstOrFail();
        $order = Order::create([
            'ulid' => (string) \Illuminate\Support\Str::ulid(),
            'channel_id' => $channel->id,
            'order_number' => 'ORD-TRACK-DETAIL-001',
            'customer_name' => 'Dewi Lestari',
            'customer_email' => 'dewi@example.com',
            'customer_phone' => '081233334444',
            'shipping_address' => 'Jl. Mawar No. 10',
            'shipping_city' => 'Jakarta',
            'shipping_province' => 'DKI',
            'shipping_courier' => 'JNE',
            'shipping_service' => 'REG',
            'subtotal_idr' => 100000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 15000,
            'grand_total_idr' => 115000,
            'status' => 'paid',
        ]);

        // Unverified direct visit to /tracking/{order_number} must redirect to tracking index with error
        $response = $this->get('/tracking/' . $order->order_number);
        $response->assertRedirect('/tracking?order_number=' . $order->order_number);
        $response->assertSessionHas('error');

        // Verified visit with email query param
        $resVerified = $this->get('/tracking/' . $order->order_number . '?verification=dewi@example.com');
        $resVerified->assertStatus(200);
        $resVerified->assertSee('ORD-TRACK-DETAIL-001');
    }
}
