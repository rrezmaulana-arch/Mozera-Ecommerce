<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Order;
use App\Modules\Crm\Models\ActionItem;
use App\Modules\Store\Models\ReturnItem;
use App\Modules\Store\Models\ReturnRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $order = null;
        if ($request->filled('order_number')) {
            $orderNumber = strtoupper(trim($request->order_number));
            $order = Order::where('order_number', $orderNumber)
                ->whereIn('status', ['delivered', 'completed'])
                ->with(['items.sku.product'])
                ->first();

            if (! $order && Order::where('order_number', $orderNumber)->exists()) {
                session()->flash('error', 'Pengajuan retur hanya dapat diproses untuk pesanan yang telah berstatus terkirim (delivered/completed).');
            } elseif (! $order) {
                session()->flash('error', 'Nomor pesanan tidak ditemukan.');
            }
        }

        return view('shop.returns', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'customer_email' => 'required|email|max:150',
            'sku_id' => 'required|exists:skus,id',
            'quantity' => 'required|integer|min:1|max:10',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $order = Order::with('items')->findOrFail($request->order_id);

        // 1. Verifikasi pemilik order
        if (strtolower(trim($request->customer_email)) !== strtolower(trim($order->customer_email))) {
            return back()->with('error', 'Email pemesan tidak cocok dengan data pesanan ini.')->withInput();
        }

        // 2. Status pesanan harus delivered atau completed
        if (! in_array($order->status, ['delivered', 'completed'], true)) {
            return back()->with('error', 'Pengajuan retur hanya dapat diproses untuk pesanan yang telah berstatus terkirim (delivered/completed). Status saat ini: ' . $order->status)->withInput();
        }

        // 3. SKU harus merupakan item dari order tersebut
        $orderItem = $order->items->firstWhere('sku_id', (int) $request->sku_id);
        if (! $orderItem) {
            return back()->with('error', 'Produk (SKU) yang dipilih tidak terdaftar dalam rincian pesanan ini.')->withInput();
        }

        // 4. Tolak duplikat tiket retur aktif untuk SKU yang sama
        $hasActiveReturn = ReturnRequest::where('order_id', $order->id)
            ->whereIn('status', ['submitted', 'approved', 'received'])
            ->whereHas('items', function ($q) use ($request) {
                $q->where('sku_id', $request->sku_id);
            })
            ->exists();

        if ($hasActiveReturn) {
            return back()->with('error', 'Tiket retur untuk produk ini pada pesanan terkait sudah pernah diajukan dan sedang diproses.')->withInput();
        }

        // 5. Validasi quantity retur <= jumlah yang dibeli dikurangi retur sebelumnya
        $alreadyReturnedQty = (int) ReturnItem::whereHas('returnRequest', function ($q) use ($order) {
                $q->where('order_id', $order->id)
                  ->whereIn('status', ['submitted', 'approved', 'received', 'completed']);
            })
            ->where('sku_id', $request->sku_id)
            ->sum('quantity');

        $maxEligibleQty = $orderItem->quantity - $alreadyReturnedQty;

        if ($request->quantity > $maxEligibleQty) {
            return back()->with('error', "Jumlah barang yang diajukan retur ({$request->quantity} pcs) melebihi batas maksimal yang dapat diretur ({$maxEligibleQty} pcs).")->withInput();
        }

        $returnRequest = ReturnRequest::create([
            'ulid' => (string) Str::ulid(),
            'order_id' => $order->id,
            'customer_id' => $order->customer_id,
            'status' => 'submitted',
            'reason' => $request->reason,
            'notes' => $request->notes,
        ]);

        ReturnItem::create([
            'return_request_id' => $returnRequest->id,
            'sku_id' => $request->sku_id,
            'quantity' => $request->quantity,
            'disposition' => 'pending',
        ]);

        // Buat Action Item untuk staf toko / owner
        ActionItem::create([
            'ulid' => (string) Str::ulid(),
            'category' => 'PENDING_RETURN',
            'priority' => 'high',
            'title' => "Permintaan Retur Baru: Order #{$order->order_number}",
            'description' => "Alasan: {$request->reason}. Pelanggan: {$order->customer_name}.",
            'action_url' => "/admin/store/returns/{$returnRequest->id}",
            'status' => 'pending',
        ]);

        return redirect()->route('shop.returns')->with('success', "Permintaan retur untuk pesanan #{$order->order_number} berhasil diajukan. Tim gudang kami akan meninjau dan mengirimkan instruksi pengembalian.");
    }
}
