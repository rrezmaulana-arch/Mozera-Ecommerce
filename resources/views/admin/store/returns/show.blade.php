@extends('layouts.admin')

@section('title', 'Inspeksi Retur #' . $return->ulid . ' — ITSFRIDAY Admin')
@section('page_title', 'Inspeksi Karantina & Pengajuan Retur')
@section('page_subtitle', 'Order #' . $return->order->order_number . ' • ' . $return->customer?->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
        <div class="flex items-center justify-between pb-4 border-b border-neutral-800">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-neutral-400">Pengajuan Retur Mandiri</span>
                <h2 class="text-lg font-bold text-white font-mono mt-0.5">Tiket ULID: {{ $return->ulid }}</h2>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-950 text-amber-300 border border-amber-800">
                Status: {{ ucfirst(str_replace('_', ' ', $return->status)) }}
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
            <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 space-y-1">
                <p class="text-[10px] text-neutral-500 uppercase tracking-wider">Alasan Pengajuan</p>
                <p class="font-bold text-white">{{ $return->reason }}</p>
                <p class="text-neutral-400 mt-2">{{ $return->notes ?: 'Tidak ada catatan tambahan.' }}</p>
            </div>
            <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 space-y-1">
                <p class="text-[10px] text-neutral-500 uppercase tracking-wider">Item yang Diminta Retur</p>
                @foreach($return->items as $it)
                    <p class="font-bold text-white">{{ $it->quantity }}x {{ $it->sku->name }}</p>
                    <p class="text-neutral-400 font-mono text-[11px]">SKU: {{ $it->sku->sku_code }}</p>
                    <p class="text-[10px] text-brand-300 mt-1">Disposisi Fisik: <strong>{{ strtoupper($it->disposition) }}</strong></p>
                @endforeach
            </div>
        </div>

        <!-- Inspection & Disposition Form -->
        <form action="{{ route('admin.store.returns.update-status', $return->id) }}" method="POST" class="pt-4 border-t border-neutral-800 space-y-4 text-xs">
            @csrf
            <h3 class="font-bold uppercase tracking-wider text-brand-300">Keputusan Inspeksi Karantina Gudang</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Status Pemeriksaan *</label>
                    <select name="status" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                        <option value="submitted" {{ $return->status === 'submitted' ? 'selected' : '' }}>Menunggu Persetujuan Kirim Barang</option>
                        <option value="approved" {{ $return->status === 'approved' ? 'selected' : '' }}>Disetujui (Menunggu Barang Tiba di Gudang)</option>
                        <option value="received_quarantine" {{ $return->status === 'received_quarantine' ? 'selected' : '' }}>Diterima di Karantina Gudang</option>
                        <option value="inspected_passed" {{ $return->status === 'inspected_passed' ? 'selected' : '' }}>Lolos Inspeksi QC (Siap Restock)</option>
                        <option value="inspected_rejected" {{ $return->status === 'inspected_rejected' ? 'selected' : '' }}>Ditolak (Rusak Pemakaian / Tidak Asli)</option>
                        <option value="completed" {{ $return->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Gudang Tujuan Restock</label>
                    <select name="location_id" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->name }} ({{ $loc->code }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Catatan QC Staf Gudang</label>
                <textarea name="admin_notes" rows="2" placeholder="Kondisi tag, kebersihan bahan, kelengkapan packaging..." class="w-full px-3.5 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">{{ $return->admin_notes }}</textarea>
            </div>

            <div class="p-3.5 rounded-xl bg-neutral-950 border border-neutral-800 flex items-center gap-3">
                <input type="checkbox" name="restock" value="1" checked id="cb-restock" class="rounded border-neutral-700 text-brand-500 focus:ring-0">
                <label for="cb-restock" class="text-neutral-300 cursor-pointer">
                    Jika status <strong>Lolos Inspeksi QC</strong>, otomatis catat barang masuk (<strong>RETURN_IN</strong>) ke buku besar ledger stok gudang.
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.store.returns.index') }}" class="px-5 py-2 rounded-xl bg-neutral-800 text-neutral-300">Kembali</a>
                <button type="submit" class="px-6 py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider">
                    Simpan Hasil Inspeksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

