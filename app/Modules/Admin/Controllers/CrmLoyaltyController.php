<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Customer;
use App\Modules\Crm\Models\LoyaltyLedger;
use Illuminate\Http\Request;

class CrmLoyaltyController extends Controller
{
    public function index()
    {
        $ledgers = LoyaltyLedger::with('customer')->latest('created_at')->paginate(20);
        $totalPointsIssued = (int) LoyaltyLedger::where('points', '>', 0)->sum('points');
        $totalPointsRedeemed = (int) abs(LoyaltyLedger::where('points', '<', 0)->sum('points'));
        $customers = Customer::where('is_active', true)->get();

        return view('admin.crm.loyalty.index', compact('ledgers', 'totalPointsIssued', 'totalPointsRedeemed', 'customers'));
    }

    public function adjust(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'points' => 'required|integer|not_in:0',
            'notes' => 'required|string',
        ]);

        LoyaltyLedger::create([
            'customer_id' => $request->customer_id,
            'points' => $request->points,
            'transaction_type' => 'MANUAL_ADJUST',
            'reference_id' => 'ADJ-' . uniqid(),
            'notes' => $request->notes,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        return back()->with('success', 'Penyesuaian poin loyalitas berhasil disimpan.');
    }
}

