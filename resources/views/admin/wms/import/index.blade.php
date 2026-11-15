@extends('layouts.admin')

@section('title', 'Impor Pesanan Marketplace — ITSFRIDAY WMS')
@section('page_title', 'Impor Pesanan Marketplace CSV')
@section('page_subtitle', 'Penyelarasan Data Penjualan Shopee & TikTok Shop dengan Pencegahan Duplikat')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Import Logs History (Col 8) -->
    <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm space-y-4">
        <div class="p-5 border-b border-neutral-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Riwayat Impor File Marketplace</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">Nama File</th>
                        <th class="py-3 px-4">Kanal</th>
                        <th class="py-3 px-4 text-center">Total Baris</th>
                        <th class="py-3 px-4 text-center">Berhasil</th>
                        <th class="py-3 px-4 text-center">Duplikat Dicegah</th>
                        <th class="py-3 px-4">Waktu Impor</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($imports as $imp)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">{{ $imp->filename }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-neutral-800 text-neutral-300 border border-neutral-700">
                                    {{ $imp->channel->name }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center font-bold text-white">{{ $imp->total_rows }}</td>
                            <td class="py-3.5 px-4 text-center font-bold text-emerald-400">+{{ $imp->success_rows }}</td>
                            <td class="py-3.5 px-4 text-center font-bold text-amber-400">{{ $imp->duplicate_rows }}</td>
                            <td class="py-3.5 px-4 text-neutral-500 text-[11px]">{{ $imp->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-neutral-500">Belum ada riwayat impor file marketplace.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $imports->links() }}
        </div>
    </div>

    <!-- Upload Form (Col 4) -->
    <div class="lg:col-span-4 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Unggah File Ekspor CSV</h3>
        
        <form action="{{ route('admin.wms.import.process') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Pilih Kanal Asal *</label>
                <select name="channel_id" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                    @foreach($channels as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Pilih File CSV *</label>
                <input type="file" name="csv_file" accept=".csv,.txt" required class="w-full text-xs text-neutral-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-neutral-800 file:text-white hover:file:bg-neutral-700">
            </div>

            <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 text-[11px] text-neutral-400 leading-relaxed space-y-1.5">
                <p class="font-bold text-white">Fitur Keamanan Impor (PRD):</p>
                <ul class="list-disc list-inside space-y-0.5">
                    <li>Pencegahan duplikat otomatis berdasarkan Nomor Pesanan marketplace.</li>
                    <li>Pemetaan cerdas kolom Shopee & TikTok Shop.</li>
                    <li>Pencocokan SKU internal ke katalog produk.</li>
                </ul>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider mt-2">
                Proses & Sinkronkan Pesanan
            </button>
        </form>
    </div>
</div>
@endsection
