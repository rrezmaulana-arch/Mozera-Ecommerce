<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Order;
use App\Modules\Store\Models\ReturnItem;
use App\Modules\Store\Models\ReturnRequest;
use App\Modules\Wms\Models\Location;
use App\Modules\Wms\Services\StockService;
use Illuminate\Http\Request;

class AdminReturnController extends Controller
{
    public function index(Request $request)
    {
        $returns = ReturnRequest::with(['order', 'customer', 'items.sku'])->latest()->paginate(15);
        return view('admin.store.returns.index', compact('returns'));
    }

    public function show(int $id)
    {
        $return = ReturnRequest::with(['order.items', 'customer', 'items.sku'])->findOrFail($id);
        $locations = Location::where('is_active', true)->get();

        return view('admin.store.returns.show', compact('return', 'locations'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:submitted,approved,received_quarantine,inspected_passed,inspected_rejected,completed',
            'admin_notes' => 'nullable|string',
            'restock' => 'nullable|boolean',
            'location_id' => 'nullable|exists:locations,id',
        ]);

        $return = ReturnRequest::with('items')->findOrFail($id);
        $return->status = $request->status;
        $return->admin_notes = $request->admin_notes;

        if ($request->status === 'inspected_passed' && $request->boolean('restock')) {
            $locationId = $request->location_id ?? Location::where('code', 'PUSAT')->value('id') ?? 1;
            $stockService = app(StockService::class);

            foreach ($return->items as $item) {
                if ($item->disposition !== 'restocked') {
                    $item->disposition = 'restocked';
                    $item->save();

                    // Record RETURN_IN in immutable stock ledger
                    $stockService->recordMovement(
                        $locationId,
                        $item->sku_id,
                        'RETURN_IN',
                        $item->quantity,
                        'ReturnRequest',
                        $return->ulid,
                        "Restock barang retur lolos inspeksi order #{$return->order->order_number}",
                        auth()->id()
                    );
                }
            }
        }

        $return->save();

        return back()->with('success', "Status pengajuan retur #{$return->ulid} berhasil diperbarui.");
    }
}

