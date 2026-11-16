@extends('layouts.admin')

@section('title', 'Katalog Produk & SKU — ITSFRIDAY')
@section('page_title', 'Katalog Produk & Varian SKU')
@section('page_subtitle', 'Manajemen Busana, Seri, Harga, HPP & Panjang Baju (Fit Helper)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <!-- Search and Filter -->
        <form method="GET" action="{{ route('admin.store.products.index') }}" class="flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="px-3.5 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-xs text-white focus:outline-none">
            <select name="series_id" onchange="this.form.submit()" class="px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-xs text-white focus:outline-none">
                <option value="">Semua Seri</option>
                @foreach($allSeries as $s)
                    <option value="{{ $s->id }}" {{ request('series_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-neutral-800 hover:bg-neutral-700 rounded-xl text-xs font-semibold text-white">Filter</button>
        </form>

        <a href="{{ route('admin.store.products.create') }}" class="px-5 py-2.5 bg-brand-500 hover:bg-brand-600 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Produk Baru
        </a>
    </div>

    <!-- Products Table -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3.5 px-4">Produk</th>
                        <th class="py-3.5 px-4">Seri & Kategori</th>
                        <th class="py-3.5 px-4">Panjang (Fit Helper)</th>
                        <th class="py-3.5 px-4">Varian SKU</th>
                        <th class="py-3.5 px-4">Harga Jual</th>
                        <th class="py-3.5 px-4">Pre-Order</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @foreach($products as $p)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $p->primary_image }}" alt="{{ $p->name }}" class="w-10 h-12 rounded-lg object-cover bg-neutral-800 flex-shrink-0">
                                    <div>
                                        <p class="font-bold text-white">{{ $p->name }}</p>
                                        <p class="text-[10px] text-neutral-500">{{ $p->material }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-neutral-800 text-neutral-300 border border-neutral-700">
                                    {{ $p->series?->name ?? 'Non-Seri' }}
                                </span>
                                <p class="text-[10px] text-neutral-500 mt-1 capitalize">{{ $p->category }}</p>
                            </td>
                            <td class="py-3.5 px-4 font-mono">
                                {{ $p->length_cm ? "{$p->length_cm} cm" : '-' }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded bg-brand-500/10 text-brand-300 border border-brand-500/30 text-[10px] font-bold">
                                    {{ $p->skus->count() }} SKU
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-white">
                                {{ \App\Modules\Shared\Money\Money::format($p->min_price) }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($p->is_preorder)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-950 text-amber-300 border border-amber-800">
                                        PO ({{ $p->preorder_lead_days }} Hari)
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-950 text-emerald-300 border border-emerald-800">
                                        Ready
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-2">
                                <a href="{{ route('admin.store.products.edit', $p->id) }}" class="text-[#BA805E] hover:underline font-semibold">Edit</a>
                                <span class="text-neutral-700">|</span>
                                <a href="{{ route('admin.store.products.show', $p->id) }}" class="text-neutral-300 hover:underline font-semibold">Detail & Stok</a>
                                <a href="{{ route('shop.product', $p->slug) }}" target="_blank" class="text-neutral-500 hover:text-white" title="Lihat di Toko">
                                    ↗
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

