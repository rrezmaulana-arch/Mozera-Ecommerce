<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Sku;
use App\Modules\Wms\Models\PickPack;
use App\Modules\Wms\Models\StockMovement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class WmsLedgerAndStockReservationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_stock_movement_ledger_is_immutable_and_cannot_be_deleted_or_updated(): void
    {
        $movement = StockMovement::firstOrFail();

        // Attempting to update a movement must trigger exception
        $updateFailed = false;
        try {
            DB::table('stock_movements')->where('id', $movement->id)->update(['quantity' => 999]);
        } catch (\Throwable $e) {
            $updateFailed = true;
            $this->assertStringContainsString('STOCK_MOVEMENT_IMMUTABLE', $e->getMessage());
        }
        $this->assertTrue($updateFailed, 'Ledger movement update should be prevented by trigger.');

        // Attempting to delete a movement must trigger exception
        $deleteFailed = false;
        try {
            DB::table('stock_movements')->where('id', $movement->id)->delete();
        } catch (\Throwable $e) {
            $deleteFailed = true;
            $this->assertStringContainsString('STOCK_MOVEMENT_IMMUTABLE', $e->getMessage());
        }
        $this->assertTrue($deleteFailed, 'Ledger movement delete should be prevented by trigger.');
    }

    public function test_picking_barcode_scan_verification(): void
    {
        $staff = User::where('role', 'warehouse_staff')->firstOrFail();
        $pickPack = PickPack::where('status', 'picking')->firstOrFail();
        $order = $pickPack->order;
        $firstItem = $order->items->first();

        $this->actingAs($staff);

        // 1. Scan correct barcode
        $response = $this->post("/admin/wms/picking/{$pickPack->id}/scan", [
            'barcode' => $firstItem->sku->barcode,
        ]);
        $response->assertSessionHas('success');

        // 2. Scan wrong barcode
        $response = $this->post("/admin/wms/picking/{$pickPack->id}/scan", [
            'barcode' => '999999999999',
        ]);
        $response->assertSessionHas('error');
    }
}
