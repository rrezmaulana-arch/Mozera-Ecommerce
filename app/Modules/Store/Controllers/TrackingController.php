<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $order = null;
        if ($request->filled('order_number')) {
            $order = Order::where('order_number', strtoupper(trim($request->order_number)))
                ->with(['items.sku.product', 'shipments', 'payments'])
                ->first();
        }

        return view('shop.tracking', compact('order'));
    }

    public function detail(string $orderNumber)
    {
        $order = Order::where('order_number', strtoupper(trim($orderNumber)))
            ->with(['items.sku.product', 'shipments', 'payments'])
            ->firstOrFail();

        return view('shop.tracking', compact('order'));
    }
}

