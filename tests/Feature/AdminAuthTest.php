<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_unauthenticated_admin_redirects_to_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_login_page_loads_with_quick_login(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Platform Terpadu');
        $response->assertSee('Miftah Afreza Maulana');
    }

    public function test_quick_login_works_and_accesses_dashboard(): void
    {
        $owner = User::where('role', 'owner')->first();
        $this->assertNotNull($owner);

        $loginResponse = $this->get(route('admin.quick-login', $owner->id));
        $loginResponse->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($owner);

        $dashResponse = $this->actingAs($owner)->get('/admin');
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Command Center');
    }

    public function test_role_based_smart_redirects(): void
    {
        $warehouse = User::where('role', 'warehouse_staff')->first();
        $store = User::where('role', 'store_admin')->first();
        $crm = User::where('role', 'crm_marketer')->first();

        $this->actingAs($warehouse)->get('/admin')->assertRedirect(route('admin.wms.inventory'));
        $this->actingAs($store)->get('/admin')->assertRedirect(route('admin.store.products.index'));
        $this->actingAs($crm)->get('/admin')->assertRedirect(route('admin.crm.customers.index'));
    }

    public function test_admin_key_pages_load_successfully(): void
    {
        $owner = User::where('role', 'owner')->first();

        $routes = [
            route('admin.dashboard'),
            route('admin.store.products.index'),
            route('admin.store.orders.index'),
            route('admin.store.returns.index'),
            route('admin.store.vouchers.index'),
            route('admin.store.drops.index'),
            route('admin.wms.inventory'),
            route('admin.wms.inbound.index'),
            route('admin.wms.picking.index'),
            route('admin.wms.stocktake.index'),
            route('admin.wms.import.index'),
            route('admin.wms.reorder'),
            route('admin.crm.customers.index'),
            route('admin.crm.segments'),
            route('admin.crm.flows'),
            route('admin.crm.loyalty'),
            route('admin.crm.affiliates'),
            route('admin.crm.dsr'),
        ];

        foreach ($routes as $url) {
            $resp = $this->actingAs($owner)->get($url);
            $this->assertEquals(200, $resp->getStatusCode(), "Failed loading route: {$url}");
        }
    }

    public function test_route_level_rbac_enforcement(): void
    {
        $warehouse = User::where('role', 'warehouse_staff')->first();
        $store = User::where('role', 'store_admin')->first();
        $crm = User::where('role', 'crm_marketer')->first();

        // Warehouse staff cannot access CRM or Store
        $this->actingAs($warehouse)->get(route('admin.crm.customers.index'))->assertStatus(403);
        $this->actingAs($warehouse)->get(route('admin.store.vouchers.index'))->assertStatus(403);

        // Store admin cannot access WMS or CRM
        $this->actingAs($store)->get(route('admin.wms.inventory'))->assertStatus(403);
        $this->actingAs($store)->get(route('admin.crm.customers.index'))->assertStatus(403);

        // CRM marketer cannot access WMS or Store
        $this->actingAs($crm)->get(route('admin.wms.inventory'))->assertStatus(403);
        $this->actingAs($crm)->get(route('admin.store.products.create'))->assertStatus(403);

        // Authorized accesses succeed
        $this->actingAs($warehouse)->get(route('admin.wms.inventory'))->assertStatus(200);
        $this->actingAs($store)->get(route('admin.store.products.index'))->assertStatus(200);
        $this->actingAs($crm)->get(route('admin.crm.customers.index'))->assertStatus(200);
    }

    public function test_admin_product_edit_and_update(): void
    {
        $owner = User::where('role', 'owner')->first();
        $product = \App\Modules\Core\Models\Product::first();
        $this->assertNotNull($product);

        // Edit page loads
        $editResp = $this->actingAs($owner)->get(route('admin.store.products.edit', $product->id));
        $editResp->assertStatus(200);
        $editResp->assertSee($product->name);

        // Update product
        $sku = $product->skus->first();
        $updateData = [
            'name' => 'Updated Modest Kimono Lux',
            'category' => 'outerwear',
            'material' => 'Silk Rayon Twill',
            'length_cm' => 120,
            'description' => 'Updated luxury description',
            'is_active' => 1,
            'skus' => [
                [
                    'id' => $sku->id,
                    'sku_code' => $sku->sku_code,
                    'name' => 'Updated Variant Name',
                    'price_idr' => 450000,
                    'cost_idr' => 180000,
                    'color' => 'Navy Blue',
                    'size' => 'All Size',
                    'is_active' => 1,
                ]
            ]
        ];

        $updateResp = $this->actingAs($owner)->put(route('admin.store.products.update', $product->id), $updateData);
        $updateResp->assertRedirect(route('admin.store.products.show', $product->id));

        $product->refresh();
        $this->assertEquals('Updated Modest Kimono Lux', $product->name);
        $this->assertEquals(450000, $product->skus->first()->price_idr);
    }
}

