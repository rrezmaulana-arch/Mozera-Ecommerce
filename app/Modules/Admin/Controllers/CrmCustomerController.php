<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\CustomerIdentity;
use App\Modules\Core\Models\Order;
use App\Modules\Crm\Models\Consent;
use App\Modules\Crm\Models\CustomerMetric;
use App\Modules\Crm\Models\LoyaltyLedger;
use App\Modules\Crm\Services\RfmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrmCustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::with(['orders', 'identities'])->withCount('orders');

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('email', 'like', $search)
                  ->orWhere('phone', 'like', $search);
            });
        }

        if ($request->filled('segment')) {
            $query->whereHas('metric', function ($q) use ($request) {
                $q->where('segment', $request->segment);
            });
        }

        $customers = $query->latest()->paginate(15);
        $metrics = CustomerMetric::whereIn('customer_id', $customers->pluck('id'))->get()->keyBy('customer_id');

        return view('admin.crm.customers.index', compact('customers', 'metrics'));
    }

    public function show(int $id)
    {
        $customer = Customer::with(['identities', 'addresses', 'orders.items.sku'])->findOrFail($id);
        $metric = CustomerMetric::firstOrCreate(['customer_id' => $customer->id], [
            'recency_days' => 0, 'frequency_count' => 0, 'monetary_total_idr' => 0, 'segment' => 'new',
        ]);
        $consents = Consent::where('customer_id', $customer->id)->get();
        $loyaltyPoints = (int) LoyaltyLedger::where('customer_id', $customer->id)->sum('points');
        $loyaltyHistory = LoyaltyLedger::where('customer_id', $customer->id)->latest('created_at')->take(10)->get();

        // Other customers for manual merge option
        $otherCustomers = Customer::where('id', '!=', $customer->id)->take(20)->get();

        return view('admin.crm.customers.show', compact('customer', 'metric', 'consents', 'loyaltyPoints', 'loyaltyHistory', 'otherCustomers'));
    }

    public function recalculateRfm()
    {
        app(RfmService::class)->recalculate();
        return back()->with('success', 'Perhitungan RFM dan ritme belanja pelanggan berhasil diperbarui!');
    }

    public function merge(Request $request, int $id)
    {
        $request->validate(['target_customer_id' => 'required|exists:customers,id|different:id']);

        $source = Customer::findOrFail($id);
        $target = Customer::findOrFail($request->target_customer_id);

        DB::transaction(function () use ($source, $target) {
            // Reassign orders
            Order::where('customer_id', $source->id)->update(['customer_id' => $target->id]);

            // Reassign identities
            CustomerIdentity::where('customer_id', $source->id)->update(['customer_id' => $target->id]);

            // Reassign loyalty points
            LoyaltyLedger::where('customer_id', $source->id)->update(['customer_id' => $target->id]);

            // Soft-delete source customer
            $source->notes .= " [Digabungkan ke Pelanggan #{$target->id} ({$target->email}) pada " . now()->toDateTimeString() . "]";
            $source->save();
            $source->delete();

            // Recalculate RFM for target
            app(RfmService::class)->recalculate($target->id);

            // Audit Logger
            \App\Modules\Shared\Audit\AuditLogger::log(
                action: 'customer.merge',
                entityType: 'Customer',
                entityId: $target->id,
                oldValues: ['source_customer_id' => $source->id, 'source_email' => $source->email],
                newValues: ['target_customer_id' => $target->id, 'target_email' => $target->email],
                userId: auth()->id()
            );
        });

        return redirect()->route('admin.crm.customers.show', $target->id)
            ->with('success', "Pelanggan {$source->email} berhasil disatukan ke dalam profil {$target->email}.");
    }
}

