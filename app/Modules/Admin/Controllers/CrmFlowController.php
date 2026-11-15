<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Crm\Models\Flow;
use App\Modules\Crm\Models\FlowRun;
use App\Modules\Crm\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CrmFlowController extends Controller
{
    public function index()
    {
        $flows = Flow::withCount('runs')->get();

        $pendingApprovals = FlowRun::with(['flow', 'customer'])
            ->where('status', 'pending_approval')
            ->latest()
            ->get();

        $recentRuns = FlowRun::with(['flow', 'customer', 'approver'])
            ->where('status', '!=', 'pending_approval')
            ->latest()
            ->paginate(15);

        return view('admin.crm.flows.index', compact('flows', 'pendingApprovals', 'recentRuns'));
    }

    public function approve(Request $request, int $id)
    {
        $run = FlowRun::with(['flow', 'customer'])->findOrFail($id);

        $run->update([
            'status' => 'sent',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'sent_at' => now(),
        ]);

        // Record outgoing message
        Message::create([
            'ulid' => (string) Str::ulid(),
            'customer_id' => $run->customer_id,
            'flow_run_id' => $run->id,
            'recipient' => $run->customer->email,
            'subject' => "Pesan Eksklusif ITSFRIDAY: {$run->flow->name}",
            'body_html' => "<p>Halo {$run->customer->name}, pesan kampanye {$run->flow->name} telah dikirim.</p>",
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return back()->with('success', "Kampanye untuk {$run->customer->name} disetujui dan email telah dikirim!");
    }

    public function reject(Request $request, int $id)
    {
        $run = FlowRun::findOrFail($id);
        $run->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return back()->with('info', "Pengiriman kampanye untuk flow #{$run->id} ditolak.");
    }
}

