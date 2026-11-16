<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Core\Models\Customer;
use App\Modules\Crm\Models\ActionItem;
use App\Modules\Crm\Models\CustomerMetric;
use App\Modules\Crm\Services\ActionItemService;
use App\Modules\Crm\Services\RfmService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrmRfmAndActionItemsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_rfm_scoring_and_segmentation(): void
    {
        $rfmService = app(RfmService::class);
        $rfmService->recalculate();

        $metrics = CustomerMetric::all();
        $this->assertNotEmpty($metrics);

        foreach ($metrics as $metric) {
            $this->assertGreaterThanOrEqual(1, $metric->r_score);
            $this->assertLessThanOrEqual(5, $metric->r_score);
            $this->assertContains($metric->segment, ['champions', 'loyal', 'potential', 'at_risk', 'hibernating', 'lost', 'new']);
        }
    }

    public function test_owner_daily_action_items_generated(): void
    {
        $actionService = app(ActionItemService::class);
        $actionService->generateDailyDecisions();

        $actionItems = ActionItem::where('status', 'pending')->get();
        $this->assertNotEmpty($actionItems);

        // Owner can resolve action item
        $owner = User::where('role', 'owner')->firstOrFail();
        $this->actingAs($owner);

        $firstItem = $actionItems->first();
        $response = $this->post("/admin/actions/{$firstItem->id}/resolve");
        $response->assertSessionHas('success');

        $firstItem->refresh();
        $this->assertEquals('resolved', $firstItem->status);
    }
}

