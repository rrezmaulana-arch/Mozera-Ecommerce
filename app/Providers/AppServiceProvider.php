<?php

namespace App\Providers;

use App\Modules\Core\Models\Order;
use App\Modules\Crm\Models\Flow;
use App\Modules\Crm\Models\FlowRun;
use App\Modules\Crm\Services\LoyaltyService;
use App\Modules\Crm\Services\RfmService;
use App\Modules\Shared\Outbox\DomainEventDispatcher;
use App\Modules\Wms\Models\PickPack;
use App\Modules\Wms\Services\StockService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Security & Configuration boot check for non-local / non-testing environments
        if (! $this->app->environment('local', 'testing')) {
            if (empty(config('services.midtrans.server_key'))) {
                throw new \RuntimeException('MIDTRANS_SERVER_KEY must not be empty in non-local environments.');
            }
            if (config('app.debug') === true) {
                throw new \RuntimeException('APP_DEBUG must be false in non-local environments.');
            }
        }

        // 1. Event: order.created -> Reserve stock in WMS
        DomainEventDispatcher::register('order.created', function (array $payload) {
            $order = Order::with('items')->find($payload['order_id'] ?? null);
            if ($order) {
                app(StockService::class)->reserveOrderStock($order);
            }
        }, 'wms_reserve_stock');

        // 2. Event: order.paid -> WMS Pick queue + CRM Loyalty points + CRM Post-purchase flow
        DomainEventDispatcher::register('order.paid', function (array $payload) {
            $order = Order::with('items')->find($payload['order_id'] ?? null);
            if ($order) {
                // WMS Pick queue
                PickPack::firstOrCreate(
                    ['order_id' => $order->id],
                    ['status' => 'pending']
                );

                // CRM Loyalty points
                if ($order->customer_id) {
                    app(LoyaltyService::class)->awardPoints(
                        $order->customer_id,
                        $order->grand_total_idr,
                        $order->order_number
                    );

                    // Recalculate RFM
                    app(RfmService::class)->recalculate($order->customer_id);

                    // Post-purchase flow
                    $flow = Flow::where('code', 'post_purchase')->where('is_active', true)->first();
                    if ($flow) {
                        FlowRun::create([
                            'flow_id' => $flow->id,
                            'customer_id' => $order->customer_id,
                            'reference_type' => 'Order',
                            'reference_id' => $order->id,
                            'status' => $flow->requires_approval ? 'pending_approval' : 'scheduled',
                            'scheduled_for' => now()->addHours($flow->delay_hours ?: 24),
                        ]);
                    }
                }
            }
        }, 'crm_wms_order_paid');

        // 3. Event: order.cancelled -> Release reserved stock
        DomainEventDispatcher::register('order.cancelled', function (array $payload) {
            $order = Order::find($payload['order_id'] ?? null);
            if ($order) {
                app(StockService::class)->releaseOrderStock($order);
            }
        }, 'wms_release_stock');

        // 4. Event: order.packed -> Deduct physical stock
        DomainEventDispatcher::register('order.packed', function (array $payload) {
            $order = Order::find($payload['order_id'] ?? null);
            if ($order) {
                app(StockService::class)->fulfillOrderStock($order);
            }
        }, 'wms_fulfill_stock');
    }
}
