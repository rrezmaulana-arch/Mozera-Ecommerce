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
            'points' => 'required|integer|not_in:0|between:-100000,100000',
            'notes' => 'required|string|max:500',
        ]);

        $ledger = LoyaltyLedger::create([
            'customer_id' => $request->customer_id,
            'points' => $request->points,
            'transaction_type' => 'MANUAL_ADJUST',
            'reference_id' => 'ADJ-' . uniqid(),
            'notes' => $request->notes,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        \App\Modules\Shared\Audit\AuditLogger::log(
            action: 'loyalty.manual_adjust',
            entityType: 'Customer',
            entityId: $request->customer_id,
            oldValues: null,
            newValues: [
                'customer_id' => $request->customer_id,
                'points' => $request->points,
                'notes' => $request->notes,
            ],
            userId: auth()->id()
        );

        return back()->with('success', 'Penyesuaian poin loyalitas berhasil disimpan.');
    }
}

