<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Store\Models\Voucher;
use Illuminate\Http\Request;

class AdminVoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->paginate(15);
        return view('admin.store.vouchers.index', compact('vouchers'));
    }

    public function store(Request $request)
    {
        $maxDiscount = $request->discount_type === 'percentage' ? 100 : 100000000;

        $request->validate([
            'code' => 'required|string|unique:vouchers,code|max:50',
            'name' => 'required|string|max:150',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_amount' => "required|integer|min:1|max:{$maxDiscount}",
            'min_purchase_idr' => 'nullable|integer|min:0|max:100000000',
            'max_discount_idr' => 'nullable|integer|min:0|max:100000000',
            'quota' => 'nullable|integer|min:1|max:1000000',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        Voucher::create([
            'code' => strtoupper(trim($request->code)),
            'name' => $request->name,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'min_purchase_idr' => $request->min_purchase_idr ?? 0,
            'max_discount_idr' => $request->max_discount_idr,
            'quota' => $request->quota,
            'starts_at' => $request->starts_at,
            'expires_at' => $request->expires_at,
            'is_active' => true,
        ]);

        return redirect()->route('admin.store.vouchers.index')->with('success', "Voucher {$request->code} berhasil dibuat.");
    }
}

