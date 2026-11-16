@extends('layouts.admin')

@section('title', 'Stock Opname (Fisik) — ITSFRIDAY WMS')
@section('page_title', 'Stock Opname (Perhitungan Fisik Gudang)')
@section('page_subtitle', 'Audit Fisik Persediaan & Rekonsiliasi Selisih ke Buku Besar Ledger')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Stocktake Sessions List (Col 8) -->
    <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="p-5 border-b border-neutral-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Daftar Sesi Audit Stock Opname</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">Kode Sesi</th>
                        <th class="py-3 px-4">Lokasi Audit</th>
                        <th class="py-3 px-4">Total Item Diuji</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($stocktakes as $st)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">{{ $st->code }}</td>
                            <td class="py-3.5 px-4 font-semibold text-white">{{ $st->location->name }} ({{ $st->location->code }})</td>
                            <td class="py-3.5 px-4 text-neutral-300">{{ $st->lines->count() }} SKU</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $st->status === 'completed' ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-amber-950 text-amber-300 border border-amber-800' }}">
                                    {{ ucfirst(str_replace('_', ' ', $st->status)) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-neutral-400 text-[11px]">{{ $st->created_at->format('d/m/Y') }}</td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.wms.stocktake.show', $st->id) }}" class="text-brand-300 hover:underline font-semibold">
                                    {{ $st->status === 'completed' ? 'Lihat Hasil' : 'Input Hitung' }} &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-neutral-500">Belum ada sesi stock opname yang dibuat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $stocktakes->links() }}
        </div>
    </div>

    <!-- Start New Stocktake Session Form (Col 4) -->
    <div class="lg:col-span-4 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Mulai Sesi Opname Baru</h3>
        
        <form action="{{ route('admin.wms.stocktake.create') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Pilih Lokasi yang Akan Dihitung *</label>
                <select name="location_id" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->name }} ({{ $loc->code }})</option>
                    @endforeach
                </select>
            </div>

            <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 text-[11px] text-neutral-400 leading-relaxed space-y-1">
                <p class="font-bold text-white">Petunjuk Audit Fisik:</p>
                <p>Sistem akan membekukan saldo sistem saat ini sebagai angka pembanding (Expected Qty). Staf memasukkan hasil hitung fisik di lembar kerja.</p>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider mt-2">
                Buka Sesi Opname
            </button>
        </form>
    </div>
</div>
@endsection

