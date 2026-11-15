<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Customer;
use App\Modules\Crm\Models\Affiliate;
use App\Modules\Crm\Models\Referral;
use Illuminate\Http\Request;

class CrmAffiliateController extends Controller
{
    public function index()
    {
        $affiliates = Affiliate::withCount('referrals')->latest()->paginate(15);
        $recentReferrals = Referral::with(['affiliate', 'order'])->latest()->take(10)->get();
        $customers = Customer::where('is_active', true)->get();

        return view('admin.crm.affiliates.index', compact('affiliates', 'recentReferrals', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:affiliates,code|max:50',
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'commission_rate' => 'required|numeric|min:1|max:50',
            'bank_name' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'bank_account_holder' => 'nullable|string',
        ]);

        Affiliate::create([
            'code' => strtoupper(trim($request->code)),
            'name' => $request->name,
            'email' => $request->email,
            'commission_rate' => $request->commission_rate,
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_account_holder' => $request->bank_account_holder,
            'is_active' => true,
        ]);

        return redirect()->route('admin.crm.affiliates')->with('success', "Affiliate mitra {$request->name} ({$request->code}) berhasil didaftarkan.");
    }
}

