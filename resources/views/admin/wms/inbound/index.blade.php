@extends('layouts.admin')

@section('title', 'Penerimaan Barang Masuk (Inbound) — ITSFRIDAY WMS')
@section('page_title', 'Barang Masuk & Batch Produksi (Inbound)')
@section('page_subtitle', 'Penerimaan Penjahit/Konveksi, Pencatatan Batch & Mutasi Otomatis')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Inbound History (Col 7) -->
    <div class="lg:col-span-7 bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="p-5 border-b border-neutral-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Riwayat Penerimaan Barang Masuk</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">No. Inbound</th>
                        <th class="py-3 px-4">Batch / Penjahit</th>
                        <th class="py-3 px-4">Lokasi</th>
                        <th class="py-3 px-4 text-center">Total Kuantitas</th>
                        <th class="py-3 px-4">Waktu Terima</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($inbounds as $inb)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">{{ $inb->inbound_number }}</td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $inb->batch?->supplier_name ?: 'Internal Supplier' }}</p>
                                <p class="text-[10px] text-neutral-500 font-mono">{{ $inb->batch?->batch_number }}</p>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-white">{{ $inb->location->code }}</td>
                            <td class="py-3.5 px-4 text-center font-bold text-emerald-400 text-sm">
                                +{{ $inb->items->sum('quantity') }} pcs
                            </td>
                            <td class="py-3.5 px-4 text-neutral-400 text-[11px]">{{ $inb->received_at?->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-neutral-500">Belum ada data penerimaan inbound.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $inbounds->links() }}
        </div>
    </div>

    <!-- Receive Inbound Form (Col 5) -->
    <div class="lg:col-span-5 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Catat Barang Masuk Baru</h3>

        <form action="{{ route('admin.wms.inbound.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nama Penjahit / Konveksi Supplier *</label>
                <input type="text" name="supplier_name" required placeholder="Contoh: Konveksi Hijab Mandiri" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nomor Batch Produksi *</label>
                    <input type="text" name="batch_number" required placeholder="BATCH-202611-02" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-mono focus:outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Tujuan Gudang *</label>
                    <select name="location_id" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-3 pt-2">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400">Item & Kuantitas Masuk</label>
                
                <div class="p-3.5 rounded-2xl bg-neutral-950 border border-neutral-800 space-y-3">
                    <div>
                        <select name="items[0][sku_id]" required class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white">
                            @foreach($skus as $sku)
                                <option value="{{ $sku->id }}">{{ $sku->sku_code }} — {{ $sku->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" name="items[0][quantity]" required placeholder="Jumlah pcs" min="1" class="w-full px-3 py-1.5 bg-neutral-900 border border-neutral-700 rounded-lg text-white font-bold">
                        </div>
                        <div>
                            <input type="number" name="items[0][cost_idr]" placeholder="Biaya HPP/pc (Rp)" class="w-full px-3 py-1.5 bg-neutral-900 border border-neutral-700 rounded-lg text-white">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Catatan Penerimaan / Kualitas QC</label>
                <textarea name="notes" rows="2" placeholder="Hasil pemeriksaan jahitan, warna kain..." class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white"></textarea>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider mt-2">
                Konfirmasi Barang Masuk (INBOUND)
            </button>
        </form>
    </div>
</div>
@endsection

