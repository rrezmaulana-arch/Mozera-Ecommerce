<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Customer;
use App\Modules\Crm\Models\DsrRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CrmDsrController extends Controller
{
    public function index()
    {
        $requests = DsrRequest::with(['customer', 'processor'])->latest()->paginate(15);
        $customers = Customer::where('is_active', true)->get();

        return view('admin.crm.dsr.index', compact('requests', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'request_type' => 'required|in:export_data,rectify_data,erase_data',
            'reason' => 'nullable|string',
        ]);

        $dsr = DsrRequest::create([
            'ulid' => (string) Str::ulid(),
            'customer_id' => $request->customer_id,
            'request_type' => $request->request_type,
            'reason' => $request->reason,
            'status' => 'submitted',
        ]);

        return back()->with('success', "Permintaan hak subjek data (#{$dsr->ulid}) berhasil dicatat.");
    }

    public function process(Request $request, int $id)
    {
        $dsr = DsrRequest::with('customer.orders')->findOrFail($id);
        $customer = $dsr->customer;

        if ($dsr->request_type === 'erase_data') {
            // Pseudonymize customer data according to UU PDP and PRD Section 10
            $customer->update([
                'name' => 'ANONYMIZED_USER_' . $customer->id,
                'email' => "anonymized_{$customer->id}@deleted.internal",
                'phone' => null,
                'tags' => ['anonymized', 'dsr_erased'],
                'notes' => 'Data pribadi disamarkan/dihapus atas permohonan UU PDP pada ' . now()->toDateTimeString(),
                'is_active' => false,
            ]);
            $customer->delete(); // Soft delete
        }

        $dsr->update([
            'status' => 'completed',
            'completed_at' => now(),
            'processed_by' => auth()->id(),
        ]);

        return back()->with('success', "Permintaan DSR ({$dsr->request_type}) untuk pelanggan telah diproses tuntas sesuai kepatuhan privasi UU PDP.");
    }
}

