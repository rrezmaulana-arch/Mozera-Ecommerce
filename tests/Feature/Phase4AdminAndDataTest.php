<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\OrderItem;
use App\Modules\Core\Models\Product;
use App\Modules\Core\Models\Sku;
use App\Modules\Crm\Models\DsrRequest;
use App\Modules\Wms\Models\Location;
use App\Modules\Wms\Models\StockBalance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Tests\TestCase;

class Phase4AdminAndDataTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_order_state_machine_allows_valid_transition_and_writes_audit_log(): void
    {
        $owner = User::where('role', 'owner')->firstOrFail();
        $channel = Channel::firstOrFail();
        $customer = Customer::firstOrFail();

        $order = Order::create([
            'ulid' => (string) Str::ulid(),
            'channel_id' => $channel->id,
            'customer_id' => $customer->id,
            'order_number' => 'ORD-TEST-0001',
            'status' => 'pending_payment',
            'subtotal_idr' => 250000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 15000,
            'grand_total_idr' => 265000,
            'customer_name' => 'Siti Khadijah',
            'customer_phone' => '081234567890',
            'customer_email' => 'siti@example.com',
            'shipping_address' => 'Jl. Tebet Barat No. 12, Jakarta',
            'shipping_city' => 'Jakarta Selatan',
            'shipping_courier' => 'JNE',
        ]);

        // Transition pending_payment -> paid
        $response = $this->actingAs($owner)->post(route('admin.store.orders.update-status', $order->id), [
            'status' => 'paid',
        ]);

        $response->assertSessionHas('success');
        $this->assertEquals('paid', $order->fresh()->status);
        $this->assertNotNull($order->fresh()->paid_at);

        // Check audit log
        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $owner->id,
            'action' => 'order.status_update',
            'entity_type' => 'Order',
            'entity_id' => $order->id,
        ]);
    }

    public function test_admin_order_state_machine_rejects_illegal_transition(): void
    {
        $owner = User::where('role', 'owner')->firstOrFail();
        $channel = Channel::firstOrFail();
        $customer = Customer::firstOrFail();

        $order = Order::create([
            'ulid' => (string) Str::ulid(),
            'channel_id' => $channel->id,
            'customer_id' => $customer->id,
            'order_number' => 'ORD-TEST-0002',
            'status' => 'delivered',
            'subtotal_idr' => 300000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 0,
            'grand_total_idr' => 300000,
            'customer_name' => 'Fatimah Az-Zahra',
            'customer_phone' => '081298765432',
            'customer_email' => 'fatimah@example.com',
            'shipping_address' => 'Jl. Senopati No. 5, Jakarta',
        ]);

        // Illegal jump: delivered -> pending_payment
        $response = $this->actingAs($owner)->post(route('admin.store.orders.update-status', $order->id), [
            'status' => 'pending_payment',
        ]);

        $response->assertSessionHas('error');
        $this->assertEquals('delivered', $order->fresh()->status);
    }

    public function test_admin_login_rate_limiter_blocks_targeted_brute_force(): void
    {
        $ip = '127.0.0.1';
        RateLimiter::clear(Str::transliterate(Str::lower('owner@itsfriday.id') . '|' . $ip));

        // 5 consecutive failed attempts
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/admin/login', [
                'email' => 'owner@itsfriday.id',
                'password' => 'wrong_password_' . $i,
            ]);
            $response->assertSessionHasErrors(['email' => 'Email atau kata sandi tidak cocok.']);
        }

        // 6th attempt should trigger RateLimiter lock
        $lockResponse = $this->post('/admin/login', [
            'email' => 'owner@itsfriday.id',
            'password' => 'any_attempt',
        ]);

        $lockResponse->assertSessionHasErrors('email');
        $errorMsg = session('errors')->first('email');
        $this->assertStringContainsString('Terlalu banyak percobaan login', $errorMsg);
    }

    public function test_wms_inventory_adjustment_creates_audit_log(): void
    {
        $warehouse = User::where('role', 'warehouse_staff')->firstOrFail();
        $location = Location::firstOrFail();
        $sku = Sku::firstOrFail();

        $response = $this->actingAs($warehouse)->post(route('admin.wms.inventory.adjust'), [
            'location_id' => $location->id,
            'sku_id' => $sku->id,
            'quantity' => 5,
            'notes' => 'Stock opname penyesuaian fisik',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $warehouse->id,
            'action' => 'stock.manual_adjust',
            'entity_type' => 'StockBalance',
            'entity_id' => $sku->id,
        ]);
    }

    public function test_crm_loyalty_and_dsr_actions_create_audit_logs(): void
    {
        $crm = User::where('role', 'crm_marketer')->firstOrFail();
        $customer = Customer::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Aisyah Humaira',
            'email' => 'aisyah.test@example.com',
            'phone' => '081299998888',
            'loyalty_points' => 100,
        ]);

        // Loyalty adjustment
        $loyaltyResponse = $this->actingAs($crm)->post(route('admin.crm.loyalty.adjust'), [
            'customer_id' => $customer->id,
            'points' => 50,
            'notes' => 'Bonus promo hari ibu',
        ]);
        $loyaltyResponse->assertSessionHas('success');

        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $crm->id,
            'action' => 'loyalty.manual_adjust',
            'entity_type' => 'Customer',
            'entity_id' => $customer->id,
        ]);

        // Create DSR Request
        $dsr = DsrRequest::create([
            'ulid' => (string) Str::ulid(),
            'customer_id' => $customer->id,
            'request_type' => 'erase_data',
            'reason' => 'Permintaan penghapusan data pengguna sesuai UU PDP',
            'status' => 'submitted',
        ]);

        // DSR Erasure Process
        $dsrResponse = $this->actingAs($crm)->post(route('admin.crm.dsr.process', $dsr->id));
        $dsrResponse->assertSessionHas('success');

        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $crm->id,
            'action' => 'dsr.process_erase_data',
            'entity_type' => 'DsrRequest',
            'entity_id' => $dsr->id,
        ]);

        // Verify customer data was anonymized
        $customer->refresh();
        $this->assertStringContainsString('anonymized_', $customer->email);
        $this->assertNull($customer->phone);
    }

    public function test_wms_marketplace_import_streaming_processes_csv_and_skips_duplicates(): void
    {
        $warehouse = User::where('role', 'warehouse_staff')->firstOrFail();
        $channel = Channel::where('code', 'shopee')->firstOrFail();
        $sku = Sku::firstOrFail();

        $csvContent = "No. Pesanan,Nomor Referensi SKU,Nama Produk,Jumlah,Total Pembayaran,Username (Pembeli),No. Telepon,No. Resi\n";
        $csvContent .= "SHOPEE-1001,{$sku->sku_code},Outer Modest,1,289000,Pembeli1,081211112222,SPX001\n";
        $csvContent .= "SHOPEE-1001,{$sku->sku_code},Outer Modest,1,289000,Pembeli1,081211112222,SPX001\n"; // duplicate order id

        $file = UploadedFile::fake()->createWithContent('orders.csv', $csvContent);

        $response = $this->actingAs($warehouse)->post(route('admin.wms.import.process'), [
            'channel_id' => $channel->id,
            'csv_file' => $file,
        ]);

        $response->assertSessionHas('success');

        // Only 1 order created because 2nd row is a duplicate
        $this->assertEquals(1, Order::where('order_number', 'SHOPEE-1001')->count());
    }
}
