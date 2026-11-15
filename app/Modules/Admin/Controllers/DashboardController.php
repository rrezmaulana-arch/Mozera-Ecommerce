<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Crm\Models\ActionItem;
use App\Modules\Crm\Models\CustomerMetric;
use App\Modules\Crm\Services\ActionItemService;
use App\Modules\Wms\Models\StockBalance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Refresh daily decisions
        app(ActionItemService::class)->generateDailyDecisions();

        $actionItems = ActionItem::where('status', 'pending')
            ->orderByRaw("CASE priority WHEN 'high' THEN 1 WHEN 'medium' THEN 2 ELSE 3 END")
            ->latest()
            ->get();

        $totalGmv = (int) Order::whereIn('status', ['paid', 'picking', 'packed', 'shipped', 'delivered', 'completed'])->sum('grand_total_idr');
        $ordersCount = Order::count();
        $pendingPackCount = Order::whereIn('status', ['paid', 'picking'])->count();
        $lowStockCount = StockBalance::where('available_qty', '<=', 5)->count();
        $customersCount = Customer::count();

        // Orders by channel
        $channelStats = Channel::withCount('orders')->get();

        // RFM Segment breakdown
        $segmentBreakdown = CustomerMetric::select('segment', \DB::raw('count(*) as total'))
            ->groupBy('segment')
            ->pluck('total', 'segment')
            ->toArray();

        // Recent orders
        $recentOrders = Order::with(['channel', 'customer'])->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'actionItems',
            'totalGmv',
            'ordersCount',
            'pendingPackCount',
            'lowStockCount',
            'customersCount',
            'channelStats',
            'segmentBreakdown',
            'recentOrders'
        ));
    }

    public function resolveActionItem(Request $request, int $id)
    {
        $item = ActionItem::findOrFail($id);
        $item->update([
            'status' => 'resolved',
            'resolved_at' => now(),
            'resolved_by' => auth()->id(),
        ]);

        return back()->with('success', "Keputusan '{$item->title}' ditandai selesai.");
    }

    public function dismissActionItem(Request $request, int $id)
    {
        $item = ActionItem::findOrFail($id);
        $item->update([
            'status' => 'dismissed',
            'resolved_at' => now(),
            'resolved_by' => auth()->id(),
        ]);

        return back()->with('info', "Keputusan '{$item->title}' diabaikan.");
    }
}

