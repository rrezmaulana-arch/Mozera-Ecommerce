<?php

namespace App\Modules\Crm\Services;

use App\Modules\Crm\Models\ActionItem;
use App\Modules\Crm\Models\CustomerMetric;
use App\Modules\Crm\Models\FlowRun;
use App\Modules\Store\Models\ReturnRequest;
use App\Modules\Wms\Models\StockBalance;
use Illuminate\Support\Str;

class ActionItemService
{
    /**
     * Scans the system for daily decisions required by the business owner.
     */
    public function generateDailyDecisions(): int
    {
        $createdCount = 0;

        // 1. Check Low Stock (< 5 items)
        $lowStocks = StockBalance::with('sku.product')
            ->where('available_qty', '<=', 5)
            ->where('physical_qty', '>', 0)
            ->get();

        foreach ($lowStocks as $balance) {
            $sku = $balance->sku;
            if (!$sku) continue;

            $exists = ActionItem::where('category', 'REORDER_LOW_STOCK')
                ->where('status', 'pending')
                ->where('action_url', 'like', "%{$sku->id}%")
                ->exists();

            if (!$exists) {
                ActionItem::create([
                    'ulid' => (string) Str::ulid(),
                    'category' => 'REORDER_LOW_STOCK',
                    'priority' => 'high',
                    'title' => "Stok Menipis: {$sku->sku_code} ({$sku->name})",
                    'description' => "Tersisa {$balance->available_qty} pcs di gudang. Segera buat purchase order ke penjahit/supplier.",
                    'action_url' => "/admin/wms/reorder?sku_id={$sku->id}",
                    'status' => 'pending',
                ]);
                $createdCount++;
            }
        }

        // 2. Pending Return Requests
        $pendingReturns = ReturnRequest::with('order')->where('status', 'submitted')->get();
        foreach ($pendingReturns as $return) {
            $exists = ActionItem::where('category', 'PENDING_RETURN')
                ->where('status', 'pending')
                ->where('action_url', 'like', "%{$return->id}%")
                ->exists();

            if (!$exists) {
                ActionItem::create([
                    'ulid' => (string) Str::ulid(),
                    'category' => 'PENDING_RETURN',
                    'priority' => 'high',
                    'title' => "Permintaan Retur Baru: Order #{$return->order->order_number}",
                    'description' => "Alasan: {$return->reason}. Pelanggan menunggu konfirmasi instruksi pengiriman barang.",
                    'action_url' => "/admin/store/returns/{$return->id}",
                    'status' => 'pending',
                ]);
                $createdCount++;
            }
        }

        // 3. Flow Runs Needing Approval
        $pendingFlows = FlowRun::with(['flow', 'customer'])->where('status', 'pending_approval')->get();
        foreach ($pendingFlows as $run) {
            $exists = ActionItem::where('category', 'FLOW_APPROVAL')
                ->where('status', 'pending')
                ->where('action_url', 'like', "%{$run->id}%")
                ->exists();

            if (!$exists) {
                ActionItem::create([
                    'ulid' => (string) Str::ulid(),
                    'category' => 'FLOW_APPROVAL',
                    'priority' => 'medium',
                    'title' => "Persetujuan Kampanye: {$run->flow->name}",
                    'description' => "Pesan email untuk pelanggan {$run->customer->name} ({$run->customer->email}) siap dikirim setelah persetujuan pemilik.",
                    'action_url' => "/admin/crm/flows",
                    'status' => 'pending',
                ]);
                $createdCount++;
            }
        }

        // 4. Win-back Opportunities (High-value at-risk customers)
        $atRiskVips = CustomerMetric::with('customer')
            ->where('segment', 'at_risk')
            ->where('monetary_total_idr', '>=', 1000000)
            ->take(5)
            ->get();

        foreach ($atRiskVips as $metric) {
            $customer = $metric->customer;
            if (!$customer) continue;

            $exists = ActionItem::where('category', 'WIN_BACK_OPPORTUNITY')
                ->where('status', 'pending')
                ->where('action_url', 'like', "%{$customer->id}%")
                ->exists();

            if (!$exists) {
                ActionItem::create([
                    'ulid' => (string) Str::ulid(),
                    'category' => 'WIN_BACK_OPPORTUNITY',
                    'priority' => 'medium',
                    'title' => "Peluang Win-Back: {$customer->name} (Total Belanja: Rp " . number_format($metric->monetary_total_idr, 0, ',', '.') . ")",
                    'description' => "Pelanggan sudah {$metric->recency_days} hari tidak berbelanja. Direkomendasikan kirim sapaan hangat atau preview koleksi baru.",
                    'action_url' => "/admin/crm/customers/{$customer->id}",
                    'status' => 'pending',
                ]);
                $createdCount++;
            }
        }

        return $createdCount;
    }
}
