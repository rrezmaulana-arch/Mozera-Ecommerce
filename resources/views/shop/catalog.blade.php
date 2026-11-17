@extends('layouts.shop')

@section('title', 'Katalog Koleksi Busana — MOZÉRA')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
    <!-- Breadcrumb & Header -->
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
    <div class="bg-white p-3 sm:p-3.5 rounded-2xl border border-neutral-200/80 mb-6 shadow-xs">
        <form method="GET" action="{{ route('shop.catalog') }}" class="flex flex-col sm:flex-row items-center justify-between gap-3">
            @if(request('series')) <input type="hidden" name="series" value="{{ request('series') }}"> @endif
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif

            <!-- Search Field -->
            <div class="relative w-full sm:w-72">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama busana, bahan..." class="w-full text-xs pl-9 pr-4 py-2 bg-neutral-50 border border-neutral-200 rounded-xl focus:outline-none focus:border-[#BA805E] focus:bg-white transition-all">
                <svg class="w-4 h-4 text-neutral-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <!-- Sort & Reset -->
            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <div class="flex items-center gap-2">
                    <label class="text-[11px] font-bold uppercase tracking-wider text-neutral-400 hidden sm:inline">Urutan:</label>
                    <select name="sort" onchange="this.form.submit()" class="text-xs px-3 py-1.5 bg-neutral-50 border border-neutral-200 rounded-xl focus:outline-none focus:border-[#BA805E]">
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

    <!-- Products Grid (Symmetrical 4-Column Luxury Cards - Consistent with Homepage) -->
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
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
            @foreach($products as $index => $product)
                <div class="group bg-white rounded-2xl sm:rounded-3xl overflow-hidden border border-[#EAE0D4] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
                    <div>
                        <!-- Product Image -->
                        <div class="relative h-[200px] sm:h-[230px] bg-[#FAF9F6] overflow-hidden flex items-center justify-center p-2.5 sm:p-3 block">
                            <a href="{{ route('shop.product', $product->slug) }}" class="block w-full h-full flex items-center justify-center">
                                <img 
                                    src="{{ $product->primary_image }}" 
                                    alt="{{ $product->name }} — Modest Fashion" 
                                    loading="lazy" 
                                    class="h-full w-auto max-w-full object-contain filter drop-shadow-sm group-hover:scale-[1.04] transition-transform duration-500 block"
                                >
                            </a>

                            <!-- Badges -->
                            <div class="absolute top-2.5 left-2.5 flex flex-col gap-1 items-start pointer-events-none">
                                @if($product->is_preorder)
                                    <span class="bg-[#BA805E] text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full shadow-xs">
                                        Pre-Order
                                    </span>
                                @elseif($index === 0)
                                    <span class="bg-neutral-900 text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full shadow-xs">
                                        Terlaris
                                    </span>
                                @endif
                            </div>

                            <span class="absolute top-2.5 right-2.5 bg-white/95 text-neutral-800 text-[9px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full shadow-2xs border border-neutral-200/60 pointer-events-none">
                                {{ ucfirst($product->category) }}
                            </span>

                            <!-- Desktop Quick View Button (hover reveal) -->
                            <div class="absolute inset-x-3 bottom-3 hidden lg:flex justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('shop.product', $product->slug) }}" class="min-h-[36px] w-full py-1.5 bg-white/95 hover:bg-neutral-950 hover:text-white text-neutral-900 text-xs font-bold rounded-xl shadow-md text-center transition-colors flex items-center justify-center">
                                    Lihat Cepat
                                </a>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-3.5 sm:p-4 space-y-2">
                            <!-- Color Swatches & Rating -->
                            <div class="flex items-center justify-between text-[11px]">
                                <div class="flex items-center gap-1">
                                    <span class="w-3 h-3 rounded-full bg-[#BA805E] border border-white shadow-xs"></span>
                                    <span class="w-3 h-3 rounded-full bg-[#EADCCE] border border-white shadow-xs"></span>
                                    <span class="w-3 h-3 rounded-full bg-neutral-800 border border-white shadow-xs"></span>
                                    <span class="text-[10px] text-neutral-400 font-mono ml-0.5">+2</span>
                                </div>
                                <div class="flex items-center text-amber-500 font-bold text-[11px] gap-0.5">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-neutral-700">4.9</span>
                                </div>
                            </div>

                            <!-- Product Title (Full 2 lines allowed, no premature clipping) -->
                            <h3 class="font-serif text-sm sm:text-base font-bold text-neutral-950 group-hover:text-[#BA805E] transition-colors leading-snug line-clamp-2 min-h-[2.5rem]">
                                <a href="{{ route('shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h3>

                            <!-- Material Description (Clean 2 lines allowed without truncation cut) -->
                            <p class="text-xs text-neutral-500 line-clamp-2 font-light leading-relaxed">
                                {{ $product->material ?: 'Material rayon twill lembut & dingin' }}
                            </p>
                        </div>
                    </div>

                    <!-- Price & Quick Add Button (Bottom row) -->
                    <div class="px-3.5 pb-3.5 sm:px-4 sm:pb-4 pt-2 border-t border-neutral-100 flex items-center justify-between gap-2">
                        <div>
                            <span class="font-bold text-neutral-950 text-xs sm:text-sm block font-mono">
                                {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                            </span>
                            @if($product->is_preorder)
                                <span class="text-[10px] text-[#BA805E] font-medium block">Lead time 7 hari</span>
                            @else
                                <span class="text-[10px] text-emerald-700 font-medium block">Stok Siap Kirim</span>
                            @endif
                        </div>

                        <!-- Quick View / Detail Button -->
                        <a 
                            href="{{ route('shop.product', $product->slug) }}" 
                            class="min-h-[38px] px-3.5 py-1.5 rounded-xl bg-neutral-950 hover:bg-[#BA805E] text-white text-xs font-bold transition-colors flex items-center gap-1 cursor-pointer"
                        >
                            <span>Detail</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
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
