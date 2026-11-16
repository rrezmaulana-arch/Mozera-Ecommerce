<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Product;
use App\Modules\Core\Models\Sku;
use App\Modules\Shared\Idempotency\IdempotencyGuard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Tests\TestCase;

class Phase1SecurityAndPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        config(['services.midtrans.server_key' => 'dummy-midtrans-server-key-12345']);
    }

    protected function createTestOrder(int $grandTotal = 150000, string $status = 'pending_payment'): Order
    {
        $channel = Channel::firstOrFail();
        $customer = Customer::firstOrFail();

        return Order::create([
            'ulid' => (string) Str::ulid(),
            'channel_id' => $channel->id,
            'customer_id' => $customer->id,
            'order_number' => 'ORD-TEST-' . strtoupper(Str::random(6)),
            'status' => $status,
            'currency' => 'IDR',
            'subtotal_idr' => $grandTotal - 15000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 15000,
            'grand_total_idr' => $grandTotal,
            'customer_name' => 'Testing User',
            'customer_email' => 'testing@itsfriday.id',
            'customer_phone' => '081234567890',
            'shipping_address' => 'Jl. Modest No. 10',
            'shipping_city' => 'Surabaya',
            'shipping_province' => 'Jawa Timur',
            'shipping_postal_code' => '60111',
            'shipping_courier' => 'JNE',
        ]);
    }

    /** 1. Quick-login route: 404 in non-local environment */
    public function test_quick_login_is_404_in_non_local_or_disabled_mode(): void
    {
        $owner = User::where('role', 'owner')->firstOrFail();

        // In testing environment (non-local), the GET route must return 404
        $this->get('/admin/quick-login/' . $owner->id)->assertStatus(404);
        $this->post('/admin/quick-login/' . $owner->id)->assertStatus(404);
    }

    /** 2. AuthController@login: reject inactive user */
    public function test_login_rejects_inactive_user(): void
    {
        $user = User::where('role', 'store_admin')->firstOrFail();
        $user->update(['is_active' => false]);

        $response = $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** 3. Payment simulation: 404 in non-local/testing environment */
    public function test_payment_simulation_is_blocked_in_production(): void
    {
        $order = $this->createTestOrder();

        // Override environment to production
        $this->app->detectEnvironment(fn () => 'production');

        $response = $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->post("/order/{$order->ulid}/payment/simulate");
        $response->assertStatus(404);

        $expireResponse = $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->post("/order/{$order->ulid}/payment/expire");
        $expireResponse->assertStatus(404);
    }

    /** 4. Webhook: missing transaction_id returns 400 */
    public function test_midtrans_webhook_rejects_missing_transaction_id(): void
    {
        $order = $this->createTestOrder();

        $response = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_status' => 'settlement',
            'gross_amount' => (string) $order->grand_total_idr,
            // transaction_id missing
        ]);

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Missing transaction_id']);
    }

    /** 5. Webhook: invalid signature returns 403 */
    public function test_midtrans_webhook_rejects_invalid_signature(): void
    {
        $order = $this->createTestOrder();

        $response = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => 'TRX-' . uniqid(),
            'transaction_status' => 'settlement',
            'status_code' => '200',
            'gross_amount' => (string) $order->grand_total_idr,
            'signature_key' => 'invalid-signature-hash',
        ]);

        $response->assertStatus(403);
        $response->assertJson(['message' => 'Invalid signature key']);
    }

    /** 6. Webhook: gross_amount mismatch returns 422 */
    public function test_midtrans_webhook_rejects_gross_amount_mismatch(): void
    {
        $order = $this->createTestOrder(250000);
        $serverKey = config('services.midtrans.server_key');
        $tamperedAmount = '100000.00';
        $signature = hash('sha512', $order->order_number . '200' . $tamperedAmount . $serverKey);

        $response = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => 'TRX-' . uniqid(),
            'transaction_status' => 'settlement',
            'status_code' => '200',
            'gross_amount' => $tamperedAmount,
            'signature_key' => $signature,
        ]);

        $response->assertStatus(422);
        $response->assertJson(['message' => 'Gross amount mismatch']);
    }

    /** 7. Webhook: cancelled order is marked for review without changing to paid */
    public function test_midtrans_webhook_flags_cancelled_order_for_review(): void
    {
        $order = $this->createTestOrder(150000, 'cancelled');
        $serverKey = config('services.midtrans.server_key');
        $grossAmount = '150000';
        $signature = hash('sha512', $order->order_number . '200' . $grossAmount . $serverKey);

        $response = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => 'TRX-LATE-' . uniqid(),
            'transaction_status' => 'settlement',
            'status_code' => '200',
            'gross_amount' => $grossAmount,
            'signature_key' => $signature,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['status' => 'review_required']);

        $order->refresh();
        $this->assertEquals('cancelled', $order->status, 'Cancelled order must NOT be set to paid!');
        $this->assertStringContainsString('REVIEW', (string) $order->notes);
    }

    /** 8. Webhook: valid payment marks order paid */
    public function test_midtrans_webhook_marks_pending_order_as_paid_with_valid_signature(): void
    {
        $order = $this->createTestOrder(350000, 'pending_payment');
        $serverKey = config('services.midtrans.server_key');
        $grossAmount = '350000';
        $signature = hash('sha512', $order->order_number . '200' . $grossAmount . $serverKey);

        $response = $this->postJson('/webhooks/midtrans', [
            'order_id' => $order->order_number,
            'transaction_id' => 'TRX-VALID-' . uniqid(),
            'transaction_status' => 'settlement',
            'status_code' => '200',
            'gross_amount' => $grossAmount,
            'signature_key' => $signature,
            'payment_type' => 'qris',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['status' => 'success', 'order_status' => 'paid']);

        $order->refresh();
        $this->assertEquals('paid', $order->status);
    }

    /** 9. IdempotencyGuard: rejects empty key and handles execution atomically */
    public function test_idempotency_guard_rejects_empty_key(): void
    {
        $this->expectException(InvalidArgumentException::class);
        IdempotencyGuard::run('', function () {
            return 'should-not-run';
        });
    }

    public function test_idempotency_guard_executes_callback_once(): void
    {
        $key = 'test-idempotency-' . uniqid();
        $count = 0;

        $res1 = IdempotencyGuard::run($key, function () use (&$count) {
            $count++;
            return 'result-1';
        });

        $res2 = IdempotencyGuard::run($key, function () use (&$count) {
            $count++;
            return 'result-2';
        });

        $this->assertEquals('result-1', $res1);
        $this->assertEquals('result-1', $res2);
        $this->assertEquals(1, $count, 'Callback must be executed only once');
    }
}
