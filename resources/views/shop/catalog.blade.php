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

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10 space-y-6 sm:space-y-8">
    
    <!-- Breadcrumb & Header (Sesuai Desain Awal Butik Editorial) -->
    <div class="space-y-2">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-neutral-400">
            <a href="{{ route('shop.home') }}" class="hover:text-neutral-900 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('shop.catalog') }}" class="{{ !request('series') && !request('category') ? 'text-neutral-900 font-bold' : 'hover:text-neutral-900' }}">Katalog</a>
            @if(request('series'))
                <span>/</span>
                <span class="text-[#BA805E] font-bold">{{ request('series') }}</span>
            @elseif(request('category'))
                <span>/</span>
                <span class="text-[#BA805E] font-bold">{{ ucfirst(request('category')) }}</span>
            @endif
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-5 border-b border-neutral-200/80">
            <div>
                <span class="text-[10px] sm:text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Koleksi Modest Eksklusif</span>
                <h1 class="font-serif text-2xl sm:text-4xl lg:text-5xl font-bold text-neutral-950 mt-0.5">
                    @if(request('series'))
                        Seri {{ request('series') }}
                    @elseif(request('category'))
                        Koleksi {{ ucfirst(request('category')) }}
                    @else
                        Seluruh Koleksi Busana
                    @endif
                </h1>
            </div>
            <div class="text-xs text-neutral-500 font-medium flex items-center gap-2">
                <span>Menampilkan <strong class="text-neutral-900 font-bold">{{ $products->total() }}</strong> busana pilihan</span>
                <span class="text-neutral-300">•</span>
                <span class="text-emerald-700 font-semibold flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Ready Stock
                </span>
            </div>
        </div>
    </div>

    <!-- Quick Pill Category Navigation (Chic & Responsive) -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 custom-scrollbar text-xs">
        <a 
            href="{{ route('shop.catalog') }}" 
            class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all duration-300 {{ !request('series') && !request('category') ? 'bg-neutral-950 text-white shadow-sm' : 'bg-white border border-[#E8DEC9] text-neutral-700 hover:border-neutral-900' }}"
        >
            Semua Busana
        </a>
        <a 
            href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" 
            class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all duration-300 {{ request('category') === 'outerwear' ? 'bg-[#BA805E] text-white shadow-sm' : 'bg-white border border-[#E8DEC9] text-neutral-700 hover:border-[#BA805E]' }}"
        >
            Outerwear dan Kimono
        </a>
        <a 
            href="{{ route('shop.catalog', ['category' => 'scarf']) }}" 
            class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all duration-300 {{ request('category') === 'scarf' ? 'bg-[#BA805E] text-white shadow-sm' : 'bg-white border border-[#E8DEC9] text-neutral-700 hover:border-[#BA805E]' }}"
        >
            Scarf dan Hijab
        </a>
        
        <div class="h-5 w-px bg-neutral-300 mx-1 shrink-0"></div>

        @foreach($allSeries as $s)
            <a 
                href="{{ route('shop.catalog', ['series' => $s->code]) }}" 
                class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all duration-300 {{ request('series') === $s->code ? 'bg-neutral-950 text-white shadow-sm' : 'bg-white border border-[#E8DEC9] text-neutral-700 hover:border-neutral-900' }}"
            >
                {{ $s->name }}
            </a>
        @endforeach
    </div>

    <!-- Filter & Sort Bar (Clean Minimalist Atelier Bar) -->
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
                    placeholder="Cari nama busana, bahan..." 
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
                    <a href="{{ route('shop.catalog') }}" class="text-xs text-rose-600 hover:text-rose-700 font-semibold whitespace-nowrap px-2.5 py-1.5 rounded-lg hover:bg-rose-50 transition-colors">
                        Reset Filter
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Products Grid (Desain Card Mewah dengan Arch Motif Sesuai Git Awal & Proporsi Terbaik) -->
    @if($products->isEmpty())
        <div class="text-center py-20 bg-white rounded-3xl border border-[#EADCCE] p-8 shadow-xs">
            <div class="w-14 h-14 mx-auto rounded-full bg-[#FAF8F5] text-neutral-400 flex items-center justify-center mb-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-neutral-900">Tidak Ada Produk yang Sesuai</h3>
            <p class="text-xs text-neutral-500 mt-1 max-w-sm mx-auto">Coba sesuaikan kata kunci pencarian atau bersihkan filter Anda.</p>
            <a href="{{ route('shop.catalog') }}" class="mt-5 inline-block px-7 py-2.5 bg-neutral-950 text-white text-xs font-bold uppercase tracking-wider rounded-full hover:bg-[#BA805E] transition-colors shadow-sm">
                Tampilkan Semua Koleksi
            </a>
        </div>
    @else
        <!-- Grid: 2 kolom di mobile, 3 di tablet, 4 di desktop -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
            @foreach($products as $index => $product)
                @php
                    $uniqueColors = $product->skus->pluck('color')->filter()->unique()->values();
                    $isScarf = str_contains(strtolower($product->slug), 'scarf');
                @endphp
                <div class="group bg-white rounded-2xl sm:rounded-3xl overflow-hidden border border-[#E8DEC9] shadow-2xs hover:shadow-xl transition-all duration-500 flex flex-col justify-between hover:-translate-y-1">
                    
                    <!-- Visual Model Frame (Dengan Background Arch Motif Butik Mewah & Floor Shadow) -->
                    <div class="relative h-[230px] sm:h-[270px] lg:h-[290px] bg-gradient-to-b from-[#FAF8F5] to-[#F2EAE0] flex items-center justify-center p-3 sm:p-4 overflow-hidden border-b border-[#F2ECE3]">
                        
                        <!-- Background Arch Motif -->
                        <div class="absolute inset-x-5 sm:inset-x-8 top-3 bottom-0 rounded-t-full bg-white/50 border-t border-x border-white/80 pointer-events-none group-hover:scale-105 transition-transform duration-500"></div>

                        <!-- Top Badges -->
                        <div class="absolute top-2.5 left-2.5 right-2.5 sm:top-3 sm:left-3 sm:right-3 flex items-center justify-between z-10 pointer-events-none">
                            @if($product->is_preorder)
                                <span class="bg-[#BA805E] text-white text-[8px] sm:text-[9px] font-mono font-bold uppercase tracking-wider px-2 py-0.5 rounded-full shadow-2xs">
                                    Pre-Order
                                </span>
                            @elseif($product->series)
                                <span class="text-[8px] sm:text-[9px] uppercase font-mono tracking-wider font-bold text-[#A66747] bg-white/95 px-2 py-0.5 rounded-full border border-[#E8DEC9] shadow-2xs">
                                    {{ $product->series->name }}
                                </span>
                            @else
                                <span class="text-[8px] sm:text-[9px] uppercase font-mono tracking-wider font-bold text-neutral-800 bg-white/95 px-2 py-0.5 rounded-full border border-[#E8DEC9] shadow-2xs">
                                    MOZÉRA
                                </span>
                            @endif

                            <span class="text-[8px] sm:text-[9px] uppercase tracking-wider font-bold px-2 py-0.5 rounded-full bg-white/95 text-neutral-800 border border-[#E8DEC9] shadow-2xs">
                                {{ ucfirst($product->category) }}
                            </span>
                        </div>

                        <!-- Product Visual Link & Image (Zero unwanted hover overlays, no black drop shadow) -->
                        <a href="{{ route('shop.product', $product->slug) }}" class="block w-full h-full flex items-center justify-center relative z-0">
                            <img 
                                src="{{ $product->primary_image }}" 
                                alt="{{ $product->name }} — MOZÉRA" 
                                loading="lazy" 
                                class="{{ $isScarf ? 'w-auto max-h-[85%] object-contain rounded-xl' : 'h-full w-auto max-w-full object-contain' }} group-hover:scale-105 transition-transform duration-500 block relative z-10"
                            >
                        </a>
                    </div>

                    <!-- Editorial Content Section (Bawah: Bersih, Rapi & Elegan) -->
                    <div class="p-3.5 sm:p-4.5 space-y-2 flex-1 flex flex-col justify-between bg-white">
                        <div class="space-y-1.5">
                            <!-- Real Dynamic SKU Swatches & Rating -->
                            <div class="flex items-center justify-between text-[11px]">
                                <div class="flex items-center gap-1 sm:gap-1.5">
                                    @forelse($uniqueColors->take(4) as $col)
                                        @php
                                            $hex = $colorMap[$col] ?? '#BA805E';
                                        @endphp
                                        <span class="w-3 h-3 sm:w-3.5 sm:h-3.5 rounded-full border border-white shadow-2xs block" style="background-color: {{ $hex }};" title="{{ $col }}"></span>
                                    @empty
                                        <span class="w-3 h-3 sm:w-3.5 sm:h-3.5 rounded-full bg-[#BA805E] border border-white shadow-2xs"></span>
                                    @endforelse
                                    @if($uniqueColors->count() > 4)
                                        <span class="text-[9px] text-neutral-400 font-mono ml-0.5">+{{ $uniqueColors->count() - 4 }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center text-amber-500 font-bold text-[10px] sm:text-[11px] gap-0.5">
                                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-neutral-700">4.9</span>
                                </div>
                            </div>

                            <!-- Product Title -->
                            <h3 class="font-serif text-xs sm:text-base font-bold text-neutral-950 group-hover:text-[#BA805E] transition-colors leading-snug line-clamp-2">
                                <a href="{{ route('shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h3>

                            <!-- Short Material Description -->
                            <p class="text-[10px] sm:text-xs text-neutral-500 line-clamp-1 font-light flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]/60 shrink-0"></span>
                                <span class="truncate">{{ $product->material ?: 'Material sejuk & nyaman sepanjang hari' }}</span>
                            </p>
                        </div>

                        <!-- Price & Action Button (Bottom Row) -->
                        <div class="pt-2.5 sm:pt-3 border-t border-neutral-100 flex items-center justify-between gap-1.5">
                            <div>
                                <span class="font-bold text-neutral-950 text-xs sm:text-sm font-mono block">
                                    {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                                </span>
                                @if($product->is_preorder)
                                    <span class="text-[9px] text-[#BA805E] font-medium block">Lead time 7-10 hari</span>
                                @else
                                    <span class="text-[9px] text-emerald-700 font-medium block flex items-center gap-0.5">
                                        <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                                        <span>Siap Kirim</span>
                                    </span>
                                @endif
                            </div>

                            <a 
                                href="{{ route('shop.product', $product->slug) }}" 
                                class="inline-flex items-center gap-1 text-[11px] font-bold text-neutral-900 group-hover:text-[#BA805E] transition-colors px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-full bg-[#FAF8F5] border border-[#E8DEC9] group-hover:border-[#BA805E] group-hover:bg-[#BA805E] group-hover:text-white shrink-0"
                            >
                                <span>Detail</span>
                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @endif

    <!-- Atelier Size & Fit Concierge Callout (Peningkatan Halaman Katalog) -->
    <div class="mt-10 bg-gradient-to-r from-[#FAF8F5] via-[#F5EFEB] to-[#FAF8F5] rounded-3xl border border-[#E8DEC9] p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs">
        <div class="flex items-center gap-4 text-center sm:text-left">
            <div class="w-12 h-12 rounded-2xl bg-white border border-[#EADCCE] text-[#BA805E] flex items-center justify-center shrink-0 shadow-xs hidden sm:flex">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <div>
                <span class="text-[10px] uppercase font-mono font-bold tracking-[0.2em] text-[#BA805E] block">Atelier Fit Concierge</span>
                <h3 class="font-serif text-lg sm:text-xl font-bold text-neutral-950 mt-0.5">Ragu Memilih Panjang Outer yang Pas?</h3>
                <p class="text-xs text-neutral-600 font-light mt-1 max-w-xl">
                    Gunakan simulator interaktif kami untuk melihat simulasi visual di mana ujung busana outer MOZÉRA akan jatuh di tubuh sesuai tinggi badanmu.
                </p>
            </div>
        </div>
        <a 
            href="{{ route('shop.home') }}#fit-helper" 
            class="min-h-[44px] px-6 py-2.5 rounded-full bg-neutral-950 hover:bg-[#BA805E] text-white text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-sm flex items-center gap-2 shrink-0 cursor-pointer"
        >
            <span>Coba Fit Simulator</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>
</div>
@endsection
