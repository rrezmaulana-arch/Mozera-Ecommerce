<?php

namespace Tests\Feature;

use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\OrderItem;
use App\Modules\Core\Models\Sku;
use App\Modules\Wms\Models\StockBalance;
use App\Modules\Wms\Services\StockService;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;
use Tests\TestCase;

class Phase1bWebhookAndConfigTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        config(['services.midtrans.server_key' => 'midtrans-test-secret-key-999']);
    }

    protected function createTestOrder(int $grandTotal = 200000, string $status = 'pending_payment'): Order
    {
        $channel = Channel::firstOrFail();
        $customer = Customer::firstOrFail();

        return Order::create([
            'ulid' => (string) Str::ulid(),
            'channel_id' => $channel->id,
            'customer_id' => $customer->id,
            'order_number' => 'ORD-1B-' . strtoupper(Str::random(6)),
            'status' => $status,
            'currency' => 'IDR',
            'subtotal_idr' => $grandTotal - 15000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 15000,
            'grand_total_idr' => $grandTotal,
            'customer_name' => 'Fase 1B Tester',
            'customer_email' => 'fase1b@itsfriday.id',
            'customer_phone' => '081299998888',
            'shipping_address' => 'Jl. Hijab Cantik No. 99',
            'shipping_city' => 'Jakarta Selatan',
            'shipping_province' => 'DKI Jakarta',
            'shipping_postal_code' => '12190',
            'shipping_courier' => 'JNE',
        ]);
    }

    /** 1. Webhook: empty server key must return 503, never verify with empty string */
    public function test_midtrans_webhook_returns_503_when_server_key_is_empty(): void
    {
        config(['services.midtrans.server_key' => '']);
        $order = $this->createTestOrder(200000);

        // Attempting to compute signature with empty server key
        $signatureWithEmptyKey = hash('sha512', $order->order_number . '200' . '200000' . '');

        $response = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => 'TRX-' . uniqid(),
            'transaction_status' => 'settlement',
            'status_code' => '200',
            'gross_amount' => '200000',
            'signature_key' => $signatureWithEmptyKey,
        ]);

        $response->assertStatus(503);
    }

    /** 2. Webhook: validate transaction_status and status_code (in: capture, settlement, pending, deny, cancel, expire, refund) -> 422 if invalid */
    public function test_midtrans_webhook_rejects_invalid_transaction_status_with_422(): void
    {
        $order = $this->createTestOrder(200000);
        $serverKey = config('services.midtrans.server_key');
        $signature = hash('sha512', $order->order_number . '200' . '200000' . $serverKey);

        $response = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => 'TRX-' . uniqid(),
            'transaction_status' => 'invalid_status_xyz',
            'status_code' => '200',
            'gross_amount' => '200000',
            'signature_key' => $signature,
        ]);

        $response->assertStatus(422);
    }

    public function test_midtrans_webhook_rejects_empty_status_code_with_422(): void
    {
        $order = $this->createTestOrder(200000);
        $serverKey = config('services.midtrans.server_key');
        $signature = hash('sha512', $order->order_number . '' . '200000' . $serverKey);

        $response = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => 'TRX-' . uniqid(),
            'transaction_status' => 'settlement',
            'status_code' => '',
            'gross_amount' => '200000',
            'signature_key' => $signature,
        ]);

        $response->assertStatus(422);
    }

    /** 3. Webhook idempotency key incorporates transaction_status: pending then settlement works, duplicate settlement is idempotent */
    public function test_midtrans_webhook_handles_pending_then_settlement_with_same_transaction_id(): void
    {
        $order = $this->createTestOrder(200000);
        $serverKey = config('services.midtrans.server_key');
        $trxId = 'TRX-SAME-' . uniqid();

        // 1. Pending notification
        $pendingSig = hash('sha512', $order->order_number . '201' . '200000' . $serverKey);
        $pendingRes = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => $trxId,
            'transaction_status' => 'pending',
            'status_code' => '201',
            'gross_amount' => '200000',
            'signature_key' => $pendingSig,
            'payment_type' => 'echannel',
        ]);

        $pendingRes->assertStatus(200);
        $order->refresh();
        $this->assertEquals('pending_payment', $order->status, 'Order must remain pending_payment when receiving pending status');

        // 2. Settlement notification with the SAME transaction_id
        $settlementSig = hash('sha512', $order->order_number . '200' . '200000' . $serverKey);
        $settlementRes = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => $trxId,
            'transaction_status' => 'settlement',
            'status_code' => '200',
            'gross_amount' => '200000',
            'signature_key' => $settlementSig,
            'payment_type' => 'echannel',
        ]);

        $settlementRes->assertStatus(200);
        $order->refresh();
        $this->assertEquals('paid', $order->status, 'Order must be updated to paid upon settlement');

        // 3. Duplicate settlement notification with the same transaction_id and status
        $duplicateRes = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => $trxId,
            'transaction_status' => 'settlement',
            'status_code' => '200',
            'gross_amount' => '200000',
            'signature_key' => $settlementSig,
            'payment_type' => 'echannel',
        ]);

        $duplicateRes->assertStatus(200);
    }

    /** 4. Webhook: expire/cancel/deny cancels pending order and releases stock */
    public function test_midtrans_webhook_cancels_pending_order_and_releases_reserved_stock_on_expire(): void
    {
        $order = $this->createTestOrder(200000);
        $sku = Sku::where('sku_code', 'PUSPA-OUT-SGE-ALL')->firstOrFail();

        // Create order item
        OrderItem::create([
            'order_id' => $order->id,
            'sku_id' => $sku->id,
            'sku_code' => $sku->sku_code,
            'product_name' => 'PUSPA Kimono',
            'unit_price_idr' => 200000,
            'quantity' => 2,
            'subtotal_idr' => 400000,
        ]);

        // Reserve stock
        $stockService = app(StockService::class);
        $stockService->reserveOrderStock($order);

        $balanceBefore = StockBalance::where('sku_id', $sku->id)->firstOrFail();
        $this->assertGreaterThanOrEqual(2, $balanceBefore->reserved_qty);

        $serverKey = config('services.midtrans.server_key');
        $expireSig = hash('sha512', $order->order_number . '202' . '200000' . $serverKey);

        $response = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => 'TRX-EXPIRE-' . uniqid(),
            'transaction_status' => 'expire',
            'status_code' => '202',
            'gross_amount' => '200000',
            'signature_key' => $expireSig,
        ]);

        $response->assertStatus(200);
        $order->refresh();
        $this->assertEquals('cancelled', $order->status);

        $balanceAfter = StockBalance::where('sku_id', $sku->id)->firstOrFail();
        $this->assertEquals($balanceBefore->reserved_qty - 2, $balanceAfter->reserved_qty);
    }

    /** 5. Boot check in non-local/testing environments */
    public function test_boot_check_fails_in_production_if_midtrans_server_key_is_empty(): void
    {
        $app = $this->createApplication();
        $app['env'] = 'production';
        $app['config']->set('services.midtrans.server_key', '');
        $app['config']->set('app.debug', false);

        $provider = new AppServiceProvider($app);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('MIDTRANS_SERVER_KEY');
        $provider->boot();
    }

    public function test_boot_check_fails_in_production_if_app_debug_is_true(): void
    {
        $app = $this->createApplication();
        $app['env'] = 'production';
        $app['config']->set('services.midtrans.server_key', 'valid-production-key-12345');
        $app['config']->set('app.debug', true);

        $provider = new AppServiceProvider($app);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('APP_DEBUG');
        $provider->boot();
    }
}

