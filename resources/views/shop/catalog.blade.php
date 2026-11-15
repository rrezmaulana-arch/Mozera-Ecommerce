@extends('layouts.shop')

@section('title', 'Katalog Koleksi — ITSFRIDAY')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb & Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs text-neutral-500 mb-2">
            <a href="{{ route('shop.home') }}" class="hover:text-neutral-900">Beranda</a>
            <span>/</span>
            <span class="text-neutral-900 font-medium">Koleksi</span>
            @if(request('series'))
                <span>/</span>
                <span class="text-brand-700 font-semibold">{{ request('series') }}</span>
            @endif
        </div>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-neutral-900">
            @if(request('series'))
                Koleksi Seri {{ request('series') }}
            @elseif(request('category'))
                Koleksi {{ ucfirst(request('category')) }}
            @else
                Seluruh Koleksi
            @endif
        </h1>
        <p class="text-xs text-neutral-500 mt-1">Daftar busana outerwear, scarf voal, dan dress modest premium.</p>
    </div>

    <!-- Filters & Sorting Bar -->
    <div class="bg-white p-4 rounded-2xl border border-neutral-200/80 mb-8 shadow-sm">
        <form method="GET" action="{{ route('shop.catalog') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-1">Cari Produk</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: Kimono, Voal..." class="w-full text-xs px-3 py-2 bg-neutral-50 border border-neutral-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-neutral-900">
            </div>

            <!-- Series Filter -->
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-1">Seri / Koleksi</label>
                <select name="series" onchange="this.form.submit()" class="w-full text-xs px-3 py-2 bg-neutral-50 border border-neutral-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-neutral-900">
                    <option value="">Semua Seri</option>
                    @foreach($allSeries as $s)
                        <option value="{{ $s->code }}" {{ request('series') == $s->code ? 'selected' : '' }}>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-1">Kategori</label>
                <select name="category" onchange="this.form.submit()" class="w-full text-xs px-3 py-2 bg-neutral-50 border border-neutral-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-neutral-900">
                    <option value="">Semua Kategori</option>
                    <option value="outerwear" {{ request('category') == 'outerwear' ? 'selected' : '' }}>Outerwear</option>
                    <option value="scarf" {{ request('category') == 'scarf' ? 'selected' : '' }}>Scarf & Hijab</option>
                    <option value="dress" {{ request('category') == 'dress' ? 'selected' : '' }}>Dress</option>
                </select>
            </div>

            <!-- Sort By -->
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-1">Urutkan</label>
                <select name="sort" onchange="this.form.submit()" class="w-full text-xs px-3 py-2 bg-neutral-50 border border-neutral-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-neutral-900">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Terendah &rarr; Tertinggi</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi &rarr; Terendah</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    @if($products->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl border border-neutral-200/80">
            <svg class="w-12 h-12 text-neutral-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <h3 class="text-base font-bold text-neutral-800">Tidak ada produk ditemukan</h3>
            <p class="text-xs text-neutral-500 mt-1">Coba sesuaikan kata kunci pencarian atau reset filter.</p>
            <a href="{{ route('shop.catalog') }}" class="mt-4 inline-block px-5 py-2 bg-neutral-900 text-white text-xs font-semibold rounded-lg">Reset Filter</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="group bg-white rounded-2xl overflow-hidden border border-neutral-200/80 shadow-sm hover:shadow-md transition-all flex flex-col">
                    <a href="{{ route('shop.product', $product->slug) }}" class="relative aspect-[3/4] bg-neutral-100 overflow-hidden block">
                        <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($product->is_preorder)
                            <span class="absolute top-2.5 left-2.5 bg-neutral-900/90 text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full backdrop-blur-sm">
                                Pre-Order
                            </span>
                        @endif
                        <span class="absolute top-2.5 right-2.5 bg-white/90 text-neutral-800 text-[9px] font-semibold uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                            {{ ucfirst($product->category) }}
                        </span>
                    </a>
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-2">
                        <div>
                            @if($product->series)
                                <p class="text-[9px] uppercase tracking-widest text-brand-700 font-bold mb-0.5">{{ $product->series->name }}</p>
                            @endif
                            <h3 class="font-serif text-base font-bold text-neutral-900 group-hover:text-brand-700 transition-colors line-clamp-1">
                                <a href="{{ route('shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-[11px] text-neutral-500 line-clamp-1 mt-0.5">{{ $product->material }}</p>
                        </div>

                        <div class="pt-2 border-t border-neutral-100 flex items-center justify-between">
                            <div>
                                <span class="font-semibold text-neutral-900 text-xs">
                                    {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                                </span>
                            </div>
                            <a href="{{ route('shop.product', $product->slug) }}" class="px-3 py-1.5 bg-neutral-900 hover:bg-neutral-800 text-white text-[11px] font-semibold rounded-lg tracking-wider uppercase transition-colors">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection

