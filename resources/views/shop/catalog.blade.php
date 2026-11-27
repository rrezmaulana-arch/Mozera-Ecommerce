@extends('layouts.shop')

@section('title', 'Katalog Koleksi Busana — MOZÉRA')
@section('meta_description', 'Koleksi lengkap busana modest wanita MOZÉRA: outerwear santun, voal scarf 120x120, dan seri eksklusif pilihan.')

@section('content')
@php
    $colorMap = [
        'Terracotta' => '#BA805E',
        'Sage Green' => '#8C9A86',
        'Indigo Navy' => '#2D3A4B',
        'Heritage Parang' => '#6A4A33',
        'Dusty Pink' => '#D8A49B',
        'Olive Ash' => '#878C74',
        'Ivory Sand' => '#DCD3C5',
        'Burgundy Wine' => '#691F2B',
        'Midnight Indigo' => '#1F2430',
    ];
@endphp

<div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-6 sm:space-y-8">

    <!-- Editorial Header -->
    <div class="space-y-2 pb-5 border-b border-neutral-200">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-neutral-400">
            <a href="{{ route('shop.home') }}" class="hover:text-neutral-900 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('shop.catalog') }}" class="{{ !request('series') && !request('category') ? 'text-neutral-900 font-medium' : 'hover:text-neutral-900' }}">Katalog</a>
            @if(request('series'))
                <span>/</span>
                <span class="text-neutral-900 font-medium">{{ request('series') }}</span>
            @elseif(request('category'))
                <span>/</span>
                <span class="text-neutral-900 font-medium">{{ ucfirst(request('category')) }}</span>
            @endif
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
            <div>
                <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-neutral-950 tracking-tight">
                    @if(request('series'))
                        Seri {{ request('series') }}
                    @elseif(request('category'))
                        Koleksi {{ ucfirst(request('category')) }}
                    @else
                        Seluruh Koleksi
                    @endif
                </h1>
            </div>
            <p class="text-xs text-neutral-500">
                {{ $products->total() }} busana
            </p>
        </div>
    </div>

    <!-- Clean Editorial Filter & Search Bar -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 border-b border-neutral-200/80 pb-4">
        <!-- Category & Series Text Tabs -->
        <div class="flex items-center gap-5 overflow-x-auto custom-scrollbar text-xs whitespace-nowrap pb-1 lg:pb-0">
            <a
                href="{{ route('shop.catalog') }}"
                class="py-1.5 border-b-2 transition-colors {{ !request('series') && !request('category') ? 'border-neutral-950 text-neutral-950 font-semibold' : 'border-transparent text-neutral-500 hover:text-neutral-900' }}"
            >
                Semua
            </a>
            <a
                href="{{ route('shop.catalog', ['category' => 'outerwear']) }}"
                class="py-1.5 border-b-2 transition-colors {{ request('category') === 'outerwear' ? 'border-neutral-950 text-neutral-950 font-semibold' : 'border-transparent text-neutral-500 hover:text-neutral-900' }}"
            >
                Outerwear &amp; Kimono
            </a>
            <a
                href="{{ route('shop.catalog', ['category' => 'scarf']) }}"
                class="py-1.5 border-b-2 transition-colors {{ request('category') === 'scarf' ? 'border-neutral-950 text-neutral-950 font-semibold' : 'border-transparent text-neutral-500 hover:text-neutral-900' }}"
            >
                Voal Scarf
            </a>

            <span class="text-neutral-300">|</span>

            @foreach($allSeries as $s)
                <a
                    href="{{ route('shop.catalog', ['series' => $s->code]) }}"
                    class="py-1.5 border-b-2 transition-colors {{ request('series') === $s->code ? 'border-[#BA805E] text-neutral-950 font-semibold' : 'border-transparent text-neutral-500 hover:text-neutral-900' }}"
                >
                    {{ $s->name }}
                </a>
            @endforeach
        </div>

        <!-- Compact Search & Sort -->
        <form method="GET" action="{{ route('shop.catalog') }}" class="flex items-center gap-3 w-full lg:w-auto justify-between lg:justify-end">
            @if(request('series')) <input type="hidden" name="series" value="{{ request('series') }}"> @endif
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif

            <div class="relative flex-1 sm:w-56 lg:flex-none">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari busana atau bahan..."
                    class="w-full text-xs pl-8 pr-3 py-2 bg-transparent border-b border-neutral-300 focus:outline-none focus:border-neutral-950 transition-colors placeholder:text-neutral-400"
                >
                <svg class="w-3.5 h-3.5 text-neutral-400 absolute left-2 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <select
                name="sort"
                onchange="this.form.submit()"
                class="text-xs px-2 py-2 bg-transparent border-b border-neutral-300 focus:outline-none focus:border-neutral-950 cursor-pointer text-neutral-700"
            >
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
            </select>

            @if(request('series') || request('category') || request('search') || request('sort'))
                <a href="{{ route('shop.catalog') }}" class="text-xs text-neutral-500 hover:text-neutral-950 underline whitespace-nowrap">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Products Grid (Editorial Minimalist) -->
    @if($products->isEmpty())
        <div class="text-center py-20 border border-neutral-200 bg-white p-8">
            <h3 class="font-serif text-lg font-bold text-neutral-900">Tidak Ada Produk yang Sesuai</h3>
            <p class="text-xs text-neutral-500 mt-1 max-w-sm mx-auto">Coba sesuaikan kata kunci pencarian atau bersihkan filter Anda.</p>
            <a href="{{ route('shop.catalog') }}" class="mt-5 inline-block px-7 py-2.5 bg-neutral-950 text-white text-xs font-semibold uppercase tracking-[0.15em] hover:bg-[#BA805E] transition-colors">
                Tampilkan Semua Koleksi
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($products as $product)
                @php
                    $uniqueColors = $product->skus->pluck('color')->filter()->unique()->values();
                    $isScarf = str_contains(strtolower($product->slug), 'scarf');
                @endphp
                <a href="{{ route('shop.product', $product->slug) }}" class="group block">
                    <!-- Clean Editorial Frame -->
                    <div class="relative h-[240px] sm:h-[300px] lg:h-[320px] bg-[#F4F1EC] overflow-hidden flex items-center justify-center p-4">
                        @if($product->is_preorder)
                            <span class="absolute top-3 left-3 text-[9px] uppercase tracking-[0.15em] font-semibold text-neutral-800 bg-white/90 px-2 py-0.5 z-10">
                                Pre-Order
                            </span>
                        @endif

                        <img
                            src="{{ $product->primary_image }}"
                            alt="{{ $product->name }}"
                            loading="lazy"
                            class="{{ $isScarf ? 'w-auto max-h-[82%] object-contain' : 'h-full w-auto max-w-full object-contain' }} group-hover:scale-[1.03] transition-transform duration-500 block"
                        >
                    </div>

                    <!-- Minimalist Caption -->
                    <div class="pt-3 space-y-1">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-[10px] uppercase tracking-wider text-neutral-400">
                                {{ $product->series?->name ?? ucfirst($product->category) }}
                            </span>
                            @if($uniqueColors->count() > 0)
                                <div class="flex items-center gap-1">
                                    @foreach($uniqueColors->take(4) as $col)
                                        <span class="w-2.5 h-2.5 rounded-full border border-neutral-300/60 block" style="background-color: {{ $colorMap[$col] ?? '#BA805E' }};" title="{{ $col }}"></span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <h3 class="font-serif text-sm sm:text-base font-medium text-neutral-950 group-hover:text-[#BA805E] transition-colors leading-snug line-clamp-1">
                            {{ $product->name }}
                        </h3>

                        <p class="text-xs sm:text-sm text-neutral-700">
                            {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="pt-6">
            {{ $products->links() }}
        </div>
    @endif

    <!-- Quiet Fit Guide Link -->
    <div class="pt-6 border-t border-neutral-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-neutral-600">
        <span>Ragu memilih panjang outer yang sesuai tinggi badan?</span>
        <a href="{{ route('shop.home') }}#fit-helper" class="font-semibold text-neutral-950 hover:text-[#BA805E] transition-colors">
            Cek Panduan Panjang Outer &rarr;
        </a>
    </div>
</div>
@endsection
