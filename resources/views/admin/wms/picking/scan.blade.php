@extends('layouts.admin')

@section('title', 'Stasiun Scan Barcode #' . $order->order_number . ' — ITSFRIDAY WMS')
@section('page_title', 'Stasiun Pemindai Barcode (Scan Station)')
@section('page_subtitle', 'Verifikasi Pesanan #' . $order->order_number . ' • ' . $order->customer_name)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Top Order Info Bar -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2.5 py-0.5 rounded-full font-bold bg-purple-950 text-purple-300 border border-purple-800">
                    Sedang Diproses (Picking)
                </span>
                <span class="text-xs text-neutral-400">Kurir: <strong class="text-white">{{ $order->shipping_courier }}</strong></span>
            </div>
            <h2 class="text-xl font-bold text-white mt-1">Pesanan #{{ $order->order_number }}</h2>
            <p class="text-xs text-neutral-400">Penerima: {{ $order->customer_name }} • {{ $order->shipping_city }}</p>
        </div>

        <div class="text-right">
            <span class="text-xs text-neutral-400">Status Kelengkapan Scan:</span>
            @if($allComplete)
                <p class="text-base font-bold text-emerald-400 flex items-center gap-1.5 justify-end mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Semua Item Lengkap Terverifikasi
                </p>
            @else
                <p class="text-base font-bold text-amber-400 flex items-center gap-1.5 justify-end mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Menunggu Pindaian Barcode
                </p>
            @endif
        </div>
    </div>

    <!-- Scanner Input & Instructions -->
    <div class="bg-neutral-900 border border-brand-500/30 rounded-3xl p-6 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                Pindai Barcode Barang (Camera / USB Scanner)
            </h3>
            <span class="text-[10px] text-neutral-400">Arahkan scanner ke barcode atau ketik kode barcode di bawah</span>
        </div>

        <form action="{{ route('admin.wms.picking.record-scan', $pickPack->id) }}" method="POST" class="flex gap-3">
            @csrf
            <div class="flex-1 relative">
                <input type="text" id="barcode-input" name="barcode" autofocus placeholder="Pindai barcode SKU (Contoh: 8991001001)..." class="w-full px-4 py-3 bg-neutral-950 border-2 border-brand-500/50 rounded-2xl text-white font-mono text-sm tracking-wider focus:outline-none focus:border-brand-500 shadow-inner" required>
            </div>
            <button type="submit" class="px-7 py-3 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-2xl text-xs uppercase tracking-wider transition-all">
                Submit Scan
            </button>
        </form>

        <!-- Quick 1-Click Scan Simulator Buttons (For ease of demonstration) -->
        <div class="pt-3 border-t border-neutral-800">
            <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold block mb-2">Simulasi Cepat 1-Klik Barcode SKU Pesanan Ini:</span>
            <div class="flex flex-wrap gap-2">
                @foreach($order->items as $item)
                    @if($item->sku && $item->sku->barcode)
                        <button type="button" onclick="document.getElementById('barcode-input').value = '{{ $item->sku->barcode }}'; this.form.submit();" class="px-3 py-1.5 rounded-xl bg-neutral-800 hover:bg-neutral-700 text-neutral-200 border border-neutral-700 text-xs font-mono flex items-center gap-1.5">
                            <span>Scan: {{ $item->sku->sku_code }}</span>
                            <span class="text-neutral-400">({{ $item->sku->barcode }})</span>
                        </button>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Items Verification Checklist -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Checklist Verifikasi Item Pesanan</h3>

        <div class="divide-y divide-neutral-800">
            @foreach($order->items as $item)
                @php
                    $scanned = $scannedCounts[$item->sku_id] ?? 0;
                    $isItemComplete = $scanned >= $item->quantity;
                @endphp
                <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center font-bold text-xs {{ $isItemComplete ? 'bg-emerald-500 text-white' : 'bg-neutral-800 text-neutral-400' }}">
                                {{ $isItemComplete ? '✓' : $scanned }}
                            </span>
                            <p class="font-bold text-white text-sm">{{ $item->product_name }}</p>
                        </div>
                        <p class="text-neutral-400 pl-8">{{ $item->variant_name }} • SKU: <span class="font-mono text-neutral-300">{{ $item->sku_code }}</span></p>
                        <p class="text-neutral-500 pl-8 font-mono text-[10px]">Barcode Terdaftar: {{ $item->sku?->barcode ?: 'Belum disetel' }}</p>
                    </div>

                    <div class="flex items-center gap-4 sm:text-right pl-8 sm:pl-0">
                        <div>
                            <span class="text-[10px] text-neutral-400 block uppercase">Kemajuan Scan</span>
                            <span class="font-bold font-mono text-sm {{ $isItemComplete ? 'text-emerald-400' : 'text-amber-400' }}">
                                {{ $scanned }} / {{ $item->quantity }} pcs
                            </span>
                        </div>
                        <span class="px-2.5 py-1 rounded text-[10px] font-bold {{ $isItemComplete ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-amber-950 text-amber-300 border border-amber-800' }}">
                            {{ $isItemComplete ? 'LENGKAP' : 'BELUM' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Final Pack Completion Form -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Selesaikan Packing & Cetak Resi</h3>

        <form action="{{ route('admin.wms.picking.complete', $pickPack->id) }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nomor Resi Pengiriman ({{ $order->shipping_courier }}) *</label>
                <input type="text" name="tracking_number" value="JNE-SUB-{{ rand(10000000, 99999999) }}" required class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-mono font-bold tracking-wider">
            </div>

            <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 text-neutral-400 text-[11px] space-y-1">
                <p class="font-bold text-white">Efek Transaksi Setelah Klik Selesai:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    <li>Status pesanan berubah menjadi <strong>PACKED / SHIPPED</strong>.</li>
                    <li>Sistem gudang secara otomatis mencatat <strong>PICK_OUT</strong> di buku besar ledger stok fisik.</li>
                    <li>Email konfirmasi pengiriman berserta tautan lacak resi otomatis terkirim ke pembeli.</li>
                </ul>
            </div>

            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('admin.wms.picking.index') }}" class="text-neutral-400 hover:text-white">&larr; Kembali ke Antrean</a>
                <button type="submit" {{ !$allComplete ? 'disabled' : '' }} class="px-8 py-3.5 bg-emerald-600 hover:bg-emerald-500 disabled:bg-neutral-800 disabled:text-neutral-600 disabled:cursor-not-allowed text-white font-bold rounded-2xl uppercase tracking-widest transition-all shadow-lg">
                    Selesaikan Packing & Keluarkan Stok &rarr;
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
