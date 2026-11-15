@extends('layouts.admin')

@section('title', $product->name . ' — ITSFRIDAY Admin')
@section('page_title', 'Detail Produk & Stok SKU')
@section('page_subtitle', $product->name . ' (' . ($product->series?->name ?? 'Non-Seri') . ')')

@section('content')
<div class="space-y-8">
    <!-- Top Details Card -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm">
        <div class="flex flex-col md:flex-row gap-6 items-start">
            <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-32 h-40 object-cover rounded-2xl bg-neutral-800 flex-shrink-0">
            <div class="flex-1 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="text-xs px-2.5 py-0.5 rounded-full font-bold bg-brand-500/20 text-brand-300 border border-brand-500/30">
                        {{ $product->series?->name ?? 'Non-Seri' }}
                    </span>
                    <span class="text-xs text-neutral-400 capitalize">• {{ $product->category }}</span>
                    @if($product->length_cm)
                        <span class="text-xs text-neutral-400">• Panjang: <strong>{{ $product->length_cm }} cm</strong></span>
                    @endif
                </div>
                <h2 class="text-xl font-bold text-white">{{ $product->name }}</h2>
                <p class="text-xs text-neutral-400 leading-relaxed">{{ $product->description }}</p>
                <div class="pt-2 text-xs flex items-center gap-6 text-neutral-400">
                    <span>Material: <strong class="text-white">{{ $product->material }}</strong></span>
                    <span>Status: <strong class="text-emerald-400">{{ $product->is_active ? 'Aktif di Toko' : 'Non-Aktif' }}</strong></span>
                    <a href="{{ route('shop.product', $product->slug) }}" target="_blank" class="text-brand-300 hover:underline">Lihat Tampilan Toko ↗</a>
                </div>
            </div>
        </div>
    </div>

    <!-- SKUs and Warehouse Balances -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Varian SKU & Saldo Stok Fisik per Gudang</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800">
                    <tr>
                        <th class="py-3 px-3">Kode SKU</th>
                        <th class="py-3 px-3">Barcode</th>
                        <th class="py-3 px-3">Warna / Ukuran</th>
                        <th class="py-3 px-3">Harga Jual</th>
                        <th class="py-3 px-3">HPP (Cost)</th>
                        <th class="py-3 px-3 text-center">Fisik (Gudang)</th>
                        <th class="py-3 px-3 text-center">Direservasi</th>
                        <th class="py-3 px-3 text-center">Tersedia Dijual</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @foreach($product->skus as $sku)
                        @php
                            $sb = $stockBalances->where('sku_id', $sku->id);
                            $phys = $sb->sum('physical_qty');
                            $resv = $sb->sum('reserved_qty');
                            $avail = $sb->sum('available_qty');
                        @endphp
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3 px-3 font-mono font-bold text-white">{{ $sku->sku_code }}</td>
                            <td class="py-3 px-3 font-mono text-neutral-400">{{ $sku->barcode ?: '-' }}</td>
                            <td class="py-3 px-3">{{ $sku->color }} / {{ $sku->size }}</td>
                            <td class="py-3 px-3 font-semibold text-white">{{ \App\Modules\Shared\Money\Money::format($sku->price_idr) }}</td>
                            <td class="py-3 px-3 text-neutral-400">{{ \App\Modules\Shared\Money\Money::format($sku->cost_idr) }}</td>
                            <td class="py-3 px-3 text-center font-bold text-white">{{ $phys }} pcs</td>
                            <td class="py-3 px-3 text-center text-amber-400">{{ $resv }} pcs</td>
                            <td class="py-3 px-3 text-center">
                                <span class="px-2 py-0.5 rounded font-bold {{ $avail > 5 ? 'bg-emerald-950 text-emerald-300' : ($avail > 0 ? 'bg-amber-950 text-amber-300' : 'bg-rose-950 text-rose-300') }}">
                                    {{ $avail }} pcs
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

