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
}
