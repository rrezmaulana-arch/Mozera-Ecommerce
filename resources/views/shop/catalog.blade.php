@extends('layouts.shop')

@section('title', 'Katalog Koleksi Busana — MOZÉRA')
@section('meta_description', 'Jelajahi seluruh koleksi modest wear MOZÉRA: outerwear santun, voal scarf ultrafine 120x120, dan seri eksklusif pilihan.')

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

    $currentSeries = null;
    if (request('series')) {
        $currentSeries = $allSeries->firstWhere('code', request('series'));
    }
@endphp

<div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10 space-y-6 sm:space-y-8">
    
    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-neutral-400">
        <a href="{{ route('shop.home') }}" class="hover:text-neutral-900 transition-colors">Beranda</a>
        <span>/</span>
        <a href="{{ route('shop.catalog') }}" class="{{ !request('series') && !request('category') ? 'text-neutral-900 font-bold' : 'hover:text-neutral-900' }}">Katalog</a>
        @if($currentSeries)
            <span>/</span>
            <span class="text-[#BA805E] font-bold">{{ $currentSeries->name }}</span>
        @elseif(request('category'))
            <span>/</span>
            <span class="text-[#BA805E] font-bold">{{ ucfirst(request('category')) }}</span>
        @endif
    </nav>

    <!-- EDITORIAL HERO HEADER BANNER (Mewah & Bernuansa Butik) -->
    <div class="relative bg-gradient-to-b from-[#F5EFEB]/90 via-[#FAF8F5] to-white rounded-3xl border border-[#EADCCE] p-6 sm:p-10 shadow-xs overflow-hidden">
        <!-- Subtle Arch Motif in Background -->
        <div class="absolute right-0 top-0 bottom-0 w-1/3 rounded-l-full bg-white/40 pointer-events-none -z-0"></div>

        <div class="relative z-10 max-w-2xl space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/90 border border-[#BA805E]/30 text-[#BA805E] text-[10px] sm:text-xs font-bold uppercase tracking-wider shadow-2xs">
                <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]"></span>
                @if($currentSeries)
                    <span>Edisi Koleksi Tematik</span>
                @elseif(request('category') === 'outerwear')
                    <span>Atasan & Outerwear Santun</span>
                @elseif(request('category') === 'scarf')
                    <span>Voal Ultrafine Glow Series</span>
                @else
                    <span>Atelier Modest Wear</span>
                @endif
            </div>

            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-neutral-950 tracking-tight leading-tight">
                @if($currentSeries)
                    {{ $currentSeries->name }}
                @elseif(request('category') === 'outerwear')
                    Outerwear & Kimono
                @elseif(request('category') === 'scarf')
                    Voal Scarf 120x120
                @else
                    Seluruh Koleksi Busana
                @endif
            </h1>

            <p class="text-xs sm:text-sm text-neutral-600 font-light leading-relaxed">
                @if($currentSeries)
                    {{ $currentSeries->description }}
                @elseif(request('category') === 'outerwear')
                    Potongan outer dan kimono santun dengan siluet jatuh anggun, sejuk di kulit, dan wudhu-friendly untuk kegiatan aktif Anda.
                @elseif(request('category') === 'scarf')
                    Hijab segiempat voal ultrafine berdimensi 120x120 cm dengan kilau lembut mewah, mudah dibentuk, dan menutup dada proporsional.
                @else
                    Eksplorasi ragam atasan modest, outer kimono nusantara, dan scarf voal premium yang dirancang abadi untuk kenyamanan wanita Indonesia.
                @endif
            </p>

            <div class="pt-1 flex items-center gap-4 text-xs text-neutral-500 font-mono">
                <span class="font-bold text-neutral-900">{{ $products->total() }}</span> Busana Pilihan
                <span>&bull;</span>
                <span class="text-emerald-700 font-semibold flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Ready Stock Surabaya
                </span>
            </div>
        </div>
    </div>

    <!-- CHIC CATEGORY & SERIES PILL NAVIGATION -->
    <div class="space-y-3">
        <div class="flex items-center gap-2 overflow-x-auto pb-2 custom-scrollbar text-xs">
            <!-- All -->
            <a 
                href="{{ route('shop.catalog') }}" 
                class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all duration-300 {{ !request('series') && !request('category') ? 'bg-neutral-950 text-white shadow-sm' : 'bg-white border border-[#EADCCE] text-neutral-700 hover:border-neutral-900' }}"
            >
                Semua Koleksi
            </a>

            <!-- Outerwear -->
            <a 
                href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" 
                class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all duration-300 flex items-center gap-1.5 {{ request('category') === 'outerwear' ? 'bg-[#BA805E] text-white shadow-sm' : 'bg-white border border-[#EADCCE] text-neutral-700 hover:border-[#BA805E]' }}"
            >
                <span>Outerwear & Kimono</span>
            </a>

            <!-- Scarf -->
            <a 
                href="{{ route('shop.catalog', ['category' => 'scarf']) }}" 
                class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all duration-300 flex items-center gap-1.5 {{ request('category') === 'scarf' ? 'bg-[#BA805E] text-white shadow-sm' : 'bg-white border border-[#EADCCE] text-neutral-700 hover:border-[#BA805E]' }}"
            >
                <span>Voal Scarf 120x120</span>
            </a>

            <div class="h-5 w-px bg-neutral-300 mx-1 shrink-0"></div>

            <!-- Series Pills -->
            @foreach($allSeries as $s)
                <a 
                    href="{{ route('shop.catalog', ['series' => $s->code]) }}" 
                    class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all duration-300 {{ request('series') === $s->code ? 'bg-neutral-950 text-white shadow-sm' : 'bg-white border border-[#EADCCE] text-neutral-700 hover:border-neutral-900' }}"
                >
                    {{ $s->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- FILTER & SORT BAR (Clean Atelier Tooling) -->
    <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-[#EAE0D4] shadow-xs">
        <form method="GET" action="{{ route('shop.catalog') }}" class="flex flex-col sm:flex-row items-center justify-between gap-3">
            @if(request('series')) <input type="hidden" name="series" value="{{ request('series') }}"> @endif
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif

            <!-- Search Field -->
            <div class="relative w-full sm:w-80">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari busana, bahan, warna..." 
                    class="w-full text-xs pl-9 pr-4 py-2.5 bg-[#FAF9F6] border border-[#EADCCE] rounded-xl focus:outline-none focus:border-[#BA805E] focus:bg-white transition-all placeholder:text-neutral-400"
                >
                <svg class="w-4 h-4 text-neutral-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <!-- Sort & Reset -->
            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <div class="flex items-center gap-2">
                    <label class="text-[10px] font-mono font-bold uppercase tracking-wider text-neutral-400 hidden sm:inline">Urutan:</label>
                    <select 
                        name="sort" 
                        onchange="this.form.submit()" 
                        class="text-xs px-3 py-2 bg-[#FAF9F6] border border-[#EADCCE] rounded-xl focus:outline-none focus:border-[#BA805E] cursor-pointer"
                    >
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Terendah &rarr; Tertinggi</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi &rarr; Terendah</option>
                    </select>
                </div>

                @if(request('series') || request('category') || request('search') || request('sort'))
                    <a href="{{ route('shop.catalog') }}" class="text-xs text-rose-600 hover:text-rose-700 font-semibold whitespace-nowrap px-2 py-1 rounded-lg hover:bg-rose-50 transition-colors">
                        Reset Filter
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- PRODUCTS GRID (Consistent with Premium Homepage Pedestal Cards) -->
    @if($products->isEmpty())
        <div class="text-center py-20 bg-white rounded-3xl border border-[#EADCCE] p-8 shadow-xs">
            <div class="w-14 h-14 mx-auto rounded-full bg-[#FAF8F5] text-neutral-400 flex items-center justify-center mb-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-neutral-900">Tidak Ada Produk yang Sesuai</h3>
            <p class="text-xs text-neutral-500 mt-1 max-w-sm mx-auto">
                Coba sesuaikan kata kunci pencarian atau bersihkan filter untuk melihat koleksi lainnya.
            </p>
            <a href="{{ route('shop.catalog') }}" class="mt-5 inline-block px-7 py-2.5 bg-neutral-950 text-white text-xs font-bold uppercase tracking-wider rounded-full hover:bg-[#BA805E] transition-colors shadow-sm">
                Tampilkan Semua Koleksi
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
            @foreach($products as $index => $product)
                @php
                    $uniqueColors = $product->skus->pluck('color')->filter()->unique()->values();
                    $isScarf = str_contains(strtolower($product->slug), 'scarf');
                @endphp
                <div class="group bg-white rounded-2xl sm:rounded-3xl overflow-hidden border border-[#EAE0D4] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
                    
                    <div>
                        <!-- Product Visual Frame: Pedestal Arsitektural Bersih (Sama seperti Homepage) -->
                        <div class="relative h-[220px] sm:h-[250px] bg-gradient-to-b from-[#F7F4EF]/80 via-[#FAF8F5] to-[#F0EAE1]/60 overflow-hidden flex items-end justify-center p-3 border-b border-neutral-100">
                            
                            <!-- Badges Top Left & Right -->
                            <div class="absolute top-2.5 left-2.5 flex flex-col gap-1 items-start z-10 pointer-events-none">
                                @if($product->is_preorder)
                                    <span class="bg-[#BA805E] text-white text-[9px] font-mono font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full shadow-xs">
                                        Pre-Order
                                    </span>
                                @elseif($index === 0)
                                    <span class="bg-neutral-900 text-white text-[9px] font-mono font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full shadow-xs">
                                        Terlaris
                                    </span>
                                @else
                                    <span class="bg-neutral-800 text-white text-[9px] font-mono font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full shadow-xs">
                                        Boutique
                                    </span>
                                @endif
                            </div>

                            <span class="absolute top-2.5 right-2.5 bg-white/95 text-[#A66747] text-[9px] font-mono font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full shadow-2xs border border-[#EADCCE] z-10 pointer-events-none">
                                {{ $product->series?->name ?? ucfirst($product->category) }}
                            </span>

                            <!-- Product Visual Link & Image (Zero unwanted overlays) -->
                            <a href="{{ route('shop.product', $product->slug) }}" class="block w-full h-full flex items-center justify-center relative z-10">
                                <img 
                                    src="{{ $product->primary_image }}" 
                                    alt="{{ $product->name }} — Modest Fashion" 
                                    loading="lazy" 
                                    class="{{ $isScarf ? 'w-auto max-h-[85%] object-contain rounded-xl shadow-xs' : 'h-full w-auto max-w-full object-contain filter drop-shadow-sm' }} group-hover:scale-[1.04] transition-transform duration-500 block"
                                >
                            </a>

                        </div>

                        <!-- Card Content Section -->
                        <div class="p-3.5 sm:p-4 space-y-2">
                            <!-- Real Dynamic SKU Swatches & Rating -->
                            <div class="flex items-center justify-between text-[11px]">
                                <div class="flex items-center gap-1.5">
                                    @forelse($uniqueColors->take(4) as $col)
                                        @php
                                            $hex = $colorMap[$col] ?? '#BA805E';
                                        @endphp
                                        <span class="w-3.5 h-3.5 rounded-full border border-white shadow-2xs block" style="background-color: {{ $hex }};" title="{{ $col }}"></span>
                                    @empty
                                        <span class="w-3.5 h-3.5 rounded-full bg-[#BA805E] border border-white shadow-2xs"></span>
                                    @endforelse
                                    @if($uniqueColors->count() > 4)
                                        <span class="text-[10px] text-neutral-400 font-mono ml-0.5">+{{ $uniqueColors->count() - 4 }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center text-amber-500 font-bold text-[11px] gap-0.5">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-neutral-700">4.9</span>
                                </div>
                            </div>

                            <!-- Product Title -->
                            <h3 class="font-serif text-sm sm:text-base font-bold text-neutral-950 group-hover:text-[#BA805E] transition-colors leading-snug line-clamp-2">
                                <a href="{{ route('shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h3>

                            <!-- Material Description -->
                            <p class="text-xs text-neutral-500 line-clamp-1 font-light flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]/60 shrink-0"></span>
                                <span class="truncate">{{ $product->material ?: 'Material sejuk & nyaman sepanjang hari' }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Price & Quick Add Button (Bottom row) -->
                    <div class="px-3.5 pb-3.5 sm:px-4 sm:pb-4 pt-2.5 border-t border-neutral-100 flex items-center justify-between gap-2">
                        <div>
                            <span class="font-bold text-neutral-950 text-xs sm:text-sm block font-mono">
                                {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                            </span>
                            @if($product->is_preorder)
                                <span class="text-[10px] text-[#BA805E] font-medium block">Lead time 7-10 hari</span>
                            @else
                                <span class="text-[10px] text-emerald-700 font-medium block flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Stok Siap Kirim</span>
                                </span>
                            @endif
                        </div>

                        <!-- Quick Add Cart / View Button (Min 44x44px touch target) -->
                        <a 
                            href="{{ route('shop.product', $product->slug) }}" 
                            aria-label="Pilih varian {{ $product->name }}" 
                            class="min-h-[44px] min-w-[44px] rounded-xl bg-neutral-100 hover:bg-[#BA805E] hover:text-white text-neutral-800 flex items-center justify-center transition-all cursor-pointer shadow-2xs hover:scale-105 active:scale-95"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-6">
            {{ $products->links() }}
        </div>
    @endif

</div>
@endsection
