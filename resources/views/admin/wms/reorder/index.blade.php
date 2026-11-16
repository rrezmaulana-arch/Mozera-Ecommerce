@extends('layouts.admin')

@section('title', 'Perencana Reorder & Stok Mati — ITSFRIDAY WMS')
@section('page_title', 'Perencana Reorder & Deteksi Stok Mati')
@section('page_subtitle', 'Analisis Kecepatan Perputaran Stok & Pembuatan Draft Purchase Order (PO)')

@section('content')
<div class="space-y-8">
    <!-- Reorder & Dead Stock Grids -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Low Stock / Reorder Needed (Col 6) -->
        <div class="lg:col-span-6 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-rose-400 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                        SKU Menipis (Perlu Reorder Segera &le; 10)
                    </h3>
                    <p class="text-[10px] text-neutral-500">Varian yang mendekati habis dan butuh jadwal produksi baru.</p>
                </div>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-950 text-rose-300 border border-rose-800">
                    {{ $reorderNeeded->count() }} SKU
                </span>
            </div>

            <div class="divide-y divide-neutral-800">
                @forelse($reorderNeeded as $b)
                    <div class="py-3 flex items-center justify-between text-xs">
                        <div>
                            <p class="font-bold text-white">{{ $b->sku->product->name }}</p>
                            <p class="text-[10px] text-neutral-400 font-mono">{{ $b->sku->sku_code }} ({{ $b->sku->color }} {{ $b->sku->size }})</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2.5 py-1 rounded bg-rose-950 text-rose-300 border border-rose-800 font-bold font-mono">
                                Sisa {{ $b->available_qty }} pcs
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="py-6 text-center text-xs text-neutral-500">Seluruh stok SKU berada di atas batas aman.</p>
                @endforelse
            </div>
        </div>

        <!-- Dead Stock Detection (Col 6) -->
        <div class="lg:col-span-6 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-amber-400 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        Deteksi Stok Mati (0 Penjualan dalam 30 Hari)
                    </h3>
                    <p class="text-[10px] text-neutral-500">Barang mengendap di rak yang perlu dipromosikan atau dibundel.</p>
                </div>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-950 text-amber-300 border border-amber-800">
                    {{ $deadStocks->count() }} SKU
                </span>
            </div>

            <div class="divide-y divide-neutral-800">
                @forelse($deadStocks as $b)
                    <div class="py-3 flex items-center justify-between text-xs">
                        <div>
                            <p class="font-bold text-white">{{ $b->sku->product->name }}</p>
                            <p class="text-[10px] text-neutral-400 font-mono">{{ $b->sku->sku_code }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2.5 py-1 rounded bg-amber-950 text-amber-300 border border-amber-800 font-bold font-mono">
                                Mengendap {{ $b->physical_qty }} pcs
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="py-6 text-center text-xs text-neutral-500">Tidak ada stok mati yang terdeteksi.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Purchase Orders & Generator Form -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- PO History (Col 8) -->
        <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm space-y-4">
            <div class="p-5 border-b border-neutral-800">
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Daftar Purchase Order (PO) ke Penjahit</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-neutral-300">
                    <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                        <tr>
                            <th class="py-3 px-4">No. PO</th>
                            <th class="py-3 px-4">Penjahit / Supplier</th>
                            <th class="py-3 px-4">Target Tiba</th>
                            <th class="py-3 px-4">Total Biaya</th>
                            <th class="py-3 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800/60 font-normal">
                        @forelse($purchaseOrders as $po)
                            <tr class="hover:bg-neutral-800/40 transition-colors">
                                <td class="py-3.5 px-4 font-mono font-bold text-white">{{ $po->po_number }}</td>
                                <td class="py-3.5 px-4 font-bold text-white">{{ $po->supplier_name }}</td>
                                <td class="py-3.5 px-4 font-mono text-neutral-400">{{ $po->expected_arrival_date ? $po->expected_arrival_date->format('d/m/Y') : '-' }}</td>
                                <td class="py-3.5 px-4 font-semibold text-white">{{ \App\Modules\Shared\Money\Money::format($po->total_cost_idr) }}</td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-neutral-800 text-neutral-300 border border-neutral-700">
                                        {{ ucfirst($po->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-neutral-500">Belum ada dokumen PO yang dibuat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create PO Form (Col 4) -->
        <div class="lg:col-span-4 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Buat Draft PO Baru</h3>

            <form action="{{ route('admin.wms.reorder.po') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nama Penjahit / Konveksi *</label>
                    <input type="text" name="supplier_name" required placeholder="Contoh: Konveksi Hijab Mandiri" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Target Tanggal Tiba</label>
                    <input type="date" name="expected_arrival_date" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                </div>

                <div class="space-y-3 pt-2">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400">Pilih SKU & Kuantitas Pesan</label>
                    <div class="p-3.5 rounded-2xl bg-neutral-950 border border-neutral-800 space-y-2">
                        <select name="items[0][sku_id]" required class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white">
                            @foreach($allSkus as $s)
                                <option value="{{ $s->id }}">{{ $s->sku_code }} — {{ $s->name }}</option>
                            @endforeach
                        </select>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" name="items[0][quantity]" value="50" min="1" placeholder="Jumlah" class="w-full px-3 py-1.5 bg-neutral-900 border border-neutral-700 rounded-lg text-white font-bold">
                            <input type="number" name="items[0][cost_idr]" placeholder="Estimasi HPP/pc" class="w-full px-3 py-1.5 bg-neutral-900 border border-neutral-700 rounded-lg text-white">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider mt-2">
                    Terbitkan Draft Purchase Order
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

