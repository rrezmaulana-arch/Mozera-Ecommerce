@extends('layouts.shop')

@section('title', 'Katalog Koleksi Busana — MOZÉRA')
@section('meta_description', 'Koleksi lengkap busana modest wanita MOZÉRA: outerwear santun, voal scarf 120x120, dan seri eksklusif pilihan.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
    <!-- Breadcrumb & Header (Sesuai Desain Awal yang Bersih & Elegan) -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs text-neutral-400 mb-2.5">
            <a href="{{ route('shop.home') }}" class="hover:text-neutral-900 transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-neutral-900 font-medium">Katalog</span>
            @if(request('series'))
                <span>/</span>
                <span class="text-[#BA805E] font-bold">{{ request('series') }}</span>
            @elseif(request('category'))
                <span>/</span>
                <span class="text-[#BA805E] font-bold">{{ ucfirst(request('category')) }}</span>
            @endif
        </div>

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-6 border-b border-neutral-200">
            <div>
                <span class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Koleksi Modest Eksklusif</span>
                <h1 class="font-serif text-3xl sm:text-5xl font-bold text-neutral-900 mt-1">
                    @if(request('series'))
                        Seri {{ request('series') }}
                    @elseif(request('category'))
                        Koleksi {{ ucfirst(request('category')) }}
                    @else
                        Seluruh Koleksi
                    @endif
                </h1>
            </div>
            <p class="text-xs text-neutral-500 font-medium">
                Menampilkan <span class="font-bold text-neutral-900">{{ $products->total() }}</span> busana pilihan
            </p>
        </div>
    </div>

    <!-- Quick Pill Category Navigation (Chic & Responsive) -->
    <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-6 custom-scrollbar text-xs">
        <a href="{{ route('shop.catalog') }}" class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all {{ !request('series') && !request('category') ? 'bg-neutral-900 text-white shadow-md' : 'bg-white border border-neutral-200 text-neutral-700 hover:border-neutral-900' }}">
            Semua Busana
        </a>
        <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all {{ request('category') === 'outerwear' ? 'bg-[#BA805E] text-white shadow-md' : 'bg-white border border-neutral-200 text-neutral-700 hover:border-[#BA805E]' }}">
            Outerwear dan Kimono
        </a>
        <a href="{{ route('shop.catalog', ['category' => 'scarf']) }}" class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all {{ request('category') === 'scarf' ? 'bg-[#BA805E] text-white shadow-md' : 'bg-white border border-neutral-200 text-neutral-700 hover:border-[#BA805E]' }}">
            Scarf dan Hijab
        </a>
        <span class="text-neutral-300">|</span>
        @foreach($allSeries as $s)
            <a href="{{ route('shop.catalog', ['series' => $s->code]) }}" class="px-4 py-2 rounded-full font-bold whitespace-nowrap transition-all {{ request('series') === $s->code ? 'bg-neutral-900 text-white shadow-md' : 'bg-white border border-neutral-200 text-neutral-700 hover:border-neutral-900' }}">
                {{ $s->name }}
            </a>
        @endforeach
    </div>

    <!-- Filter & Sort Bar (Clean Minimalist Bar) -->
    <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-neutral-200/80 mb-8 shadow-sm">
        <form method="GET" action="{{ route('shop.catalog') }}" class="flex flex-col sm:flex-row items-center justify-between gap-3">
            @if(request('series')) <input type="hidden" name="series" value="{{ request('series') }}"> @endif
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif

            <!-- Search Field -->
            <div class="relative w-full sm:w-80">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama busana, bahan..." class="w-full text-xs pl-9 pr-4 py-2.5 bg-neutral-50 border border-neutral-200 rounded-xl focus:outline-none focus:border-[#BA805E] focus:bg-white transition-all">
                <svg class="w-4 h-4 text-neutral-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <!-- Sort & Reset -->
            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <div class="flex items-center gap-2">
                    <label class="text-[11px] font-bold uppercase tracking-wider text-neutral-400 hidden sm:inline">Urutan:</label>
                    <select name="sort" onchange="this.form.submit()" class="text-xs px-3 py-2 bg-neutral-50 border border-neutral-200 rounded-xl focus:outline-none focus:border-[#BA805E]">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Terendah &rarr; Tertinggi</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi &rarr; Terendah</option>
                    </select>
                </div>

                @if(request('series') || request('category') || request('search') || request('sort'))
                    <a href="{{ route('shop.catalog') }}" class="text-xs text-rose-600 hover:underline font-semibold whitespace-nowrap px-2">
                        Reset Filter
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Products Grid (Desain Card Bersih & Mewah dengan Arch Motif Sesuai Git Awal) -->
    @if($products->isEmpty())
        <div class="text-center py-20 bg-white rounded-3xl border border-neutral-200/80 p-8 shadow-sm">
            <svg class="w-12 h-12 text-neutral-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <h3 class="text-base font-bold text-neutral-800">Tidak Ada Produk yang Sesuai</h3>
            <p class="text-xs text-neutral-500 mt-1">Coba sesuaikan kata kunci pencarian atau bersihkan filter Anda.</p>
            <a href="{{ route('shop.catalog') }}" class="mt-4 inline-block px-6 py-2.5 bg-neutral-900 text-white text-xs font-bold uppercase tracking-wider rounded-full hover:bg-neutral-800 transition-colors">
                Tampilkan Semua Koleksi
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                @php
                    $isScarf = str_contains(strtolower($product->slug), 'scarf');
                @endphp
                <div class="group bg-white rounded-2xl sm:rounded-3xl overflow-hidden border border-[#E8DEC9] shadow-xs hover:shadow-xl transition-all duration-500 flex flex-col justify-between hover:-translate-y-1">
                    
                    <!-- Visual Model Frame (Dengan Background Arch Motif Butik Mewah) -->
                    <div class="relative h-[250px] sm:h-[280px] bg-gradient-to-b from-[#FAF8F5] to-[#F2EAE0] flex items-center justify-center p-3 sm:p-4 overflow-hidden border-b border-[#F2ECE3]">
                        <!-- Background Arch Motif -->
                        <div class="absolute inset-x-6 top-3 bottom-0 rounded-t-full bg-white/50 border-t border-x border-white/80 pointer-events-none group-hover:scale-105 transition-transform duration-500"></div>

                        <!-- Top Badges -->
                        <div class="absolute top-3 left-3 right-3 flex items-center justify-between z-10">
                            @if($product->is_preorder)
                                <span class="bg-[#BA805E] text-white text-[9px] font-mono font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full shadow-2xs">
                                    Pre-Order
                                </span>
                            @elseif($product->series)
                                <span class="text-[9px] uppercase font-mono tracking-wider font-bold text-[#A66747] bg-white/95 px-2.5 py-0.5 rounded-full border border-[#E8DEC9] shadow-2xs">
                                    {{ $product->series->name }}
                                </span>
                            @else
                                <span class="text-[9px] uppercase font-mono tracking-wider font-bold text-neutral-800 bg-white/95 px-2.5 py-0.5 rounded-full border border-[#E8DEC9] shadow-2xs">
                                    Koleksi MOZÉRA
                                </span>
                            @endif

                            <span class="text-[9px] uppercase tracking-wider font-bold px-2 py-0.5 rounded-full bg-white/95 text-neutral-800 border border-[#E8DEC9] shadow-2xs">
                                {{ ucfirst($product->category) }}
                            </span>
                        </div>

                        <!-- Product / Model Image -->
                        <a href="{{ route('shop.product', $product->slug) }}" class="block w-full h-full flex items-center justify-center relative z-0">
                            <img 
                                src="{{ $product->primary_image }}" 
                                alt="{{ $product->name }} — MOZÉRA" 
                                loading="lazy" 
                                class="{{ $isScarf ? 'w-auto max-h-[85%] object-contain rounded-xl shadow-xs' : 'h-full w-auto max-w-full object-contain filter drop-shadow-md' }} group-hover:scale-105 transition-transform duration-500 block"
                            >
                        </a>
                    </div>

                    <!-- Editorial Content Section (Bawah: Bersih, Rapi & Elegan) -->
                    <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between space-y-3 bg-white">
                        <div class="space-y-1">
                            @if($product->series)
                                <p class="text-[10px] uppercase tracking-widest text-[#BA805E] font-bold font-mono">{{ $product->series->name }}</p>
                            @endif
                            <h3 class="font-serif text-base sm:text-lg font-bold text-neutral-950 group-hover:text-[#BA805E] transition-colors leading-snug line-clamp-1">
                                <a href="{{ route('shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-xs text-neutral-500 line-clamp-1 font-light">{{ $product->material ?: 'Material sejuk dan jatuh anggun' }}</p>
                        </div>

                        <div class="pt-3 border-t border-neutral-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-neutral-400 block uppercase tracking-wider font-mono">Harga</span>
                                <span class="font-bold text-neutral-950 text-sm sm:text-base font-mono">
                                    {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                                </span>
                            </div>
                            <a 
                                href="{{ route('shop.product', $product->slug) }}" 
                                class="inline-flex items-center gap-1.5 text-xs font-bold text-neutral-900 group-hover:text-[#BA805E] transition-colors px-3 py-1.5 rounded-full bg-[#FAF8F5] border border-[#E8DEC9] group-hover:border-[#BA805E] group-hover:bg-[#BA805E] group-hover:text-white"
                            >
                                <span>Detail</span>
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
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
</div>
@endsection
