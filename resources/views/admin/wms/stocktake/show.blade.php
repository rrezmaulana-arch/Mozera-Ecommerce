@extends('layouts.admin')

@section('title', 'Sesi Opname ' . $stocktake->code . ' — ITSFRIDAY WMS')
@section('page_title', 'Lembar Kerja Stock Opname (' . $stocktake->code . ')')
@section('page_subtitle', 'Lokasi: ' . $stocktake->location->name . ' • Dibuat oleh ' . ($stocktake->creator?->name ?? 'Admin'))

@section('content')
<div class="space-y-6">
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
            <span class="text-[10px] uppercase tracking-wider text-neutral-400">Kode Sesi Audit</span>
            <h2 class="text-xl font-bold text-white font-mono mt-0.5">{{ $stocktake->code }}</h2>
            <p class="text-xs text-neutral-400">Status: <strong class="text-white capitalize">{{ str_replace('_', ' ', $stocktake->status) }}</strong></p>
        </div>

        @if($stocktake->status !== 'completed')
            <form action="{{ route('admin.wms.stocktake.finalize', $stocktake->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memfinalisasi opname ini? Selisih hitung akan otomatis diposting ke buku besar ledger stok!')">
                @csrf
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs uppercase tracking-wider shadow-lg">
                    Finalisasi & Catat Mutasi ke Ledger
                </button>
            </form>
        @else
            <span class="px-4 py-2 rounded-xl bg-emerald-950 text-emerald-300 border border-emerald-800 text-xs font-bold">
                ✓ Selesai & Telah Dibukukan ke Ledger
            </span>
        @endif
    </div>

    <!-- Counting Lines Form -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <form action="{{ route('admin.wms.stocktake.update-lines', $stocktake->id) }}" method="POST">
            @csrf
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-neutral-300">
                    <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                        <tr>
                            <th class="py-3 px-4">SKU Code</th>
                            <th class="py-3 px-4">Nama Produk & Varian</th>
                            <th class="py-3 px-4 text-center">Saldo Sistem (Expected)</th>
                            <th class="py-3 px-4 text-center">Hitung Fisik (Counted)</th>
                            <th class="py-3 px-4 text-center">Selisih (Difference)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800/60 font-normal">
                        @foreach($stocktake->lines as $line)
                            <tr class="hover:bg-neutral-800/40 transition-colors">
                                <td class="py-3.5 px-4 font-mono font-bold text-white">{{ $line->sku->sku_code }}</td>
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-white">{{ $line->sku->product->name }}</p>
                                    <p class="text-[10px] text-neutral-500">{{ $line->sku->color }} ({{ $line->sku->size }})</p>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-white font-mono text-sm">
                                    {{ $line->expected_qty }} pcs
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    @if($stocktake->status === 'completed')
                                        <span class="font-bold text-white font-mono text-sm">{{ $line->counted_qty }} pcs</span>
                                    @else
                                        <input type="number" name="counted[{{ $line->id }}]" value="{{ $line->counted_qty }}" min="0" class="w-20 px-2 py-1 bg-neutral-950 border border-neutral-700 rounded-lg text-white font-mono font-bold text-center">
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-center font-mono font-bold text-sm">
                                    @if($line->difference_qty > 0)
                                        <span class="text-emerald-400">+{{ $line->difference_qty }} pcs (Lebih)</span>
                                    @elseif($line->difference_qty < 0)
                                        <span class="text-rose-400">{{ $line->difference_qty }} pcs (Kurang)</span>
                                    @else
                                        <span class="text-neutral-500">0 (Cocok)</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($stocktake->status !== 'completed')
                <div class="pt-4 border-t border-neutral-800 flex justify-end">
                    <button type="submit" class="px-5 py-2 rounded-xl bg-neutral-800 hover:bg-neutral-700 text-white font-semibold text-xs">
                        Simpan Sementara Hasil Hitung
                    </button>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection

