@extends('layouts.shop')

@section('title', 'ITSFRIDAY — Timeless Modest Wear & Premium Outerwear')

@section('content')
    <!-- Hero Banner (Luxury Fashion Editorial) -->
    <section class="relative bg-[#0d0d0f] text-white overflow-hidden min-h-[580px] sm:min-h-[660px] flex items-center">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1600&q=80" alt="ITSFRIDAY Hero Collection" class="w-full h-full object-cover opacity-50 scale-105 animate-pulse duration-[10000ms]">
            <!-- Elegant Multi-Stop Dark Gradient for High-Contrast Text Legibility -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d0f] via-black/50 to-black/30"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 flex flex-col items-center text-center">
            <span class="inline-block text-[11px] sm:text-xs uppercase tracking-[0.35em] font-semibold text-[#DCC3AD] mb-4 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15">
                Everyday Comfort &bull; Weekend Confidence
            </span>
            <h1 class="font-serif text-4xl sm:text-6xl lg:text-7xl font-bold tracking-tight max-w-4xl leading-[1.1] mb-6 text-white drop-shadow-md">
                Sentuhan Elegan untuk <br class="hidden sm:inline">Hari-Hari Anda
            </h1>
            <p class="text-neutral-200 max-w-xl text-sm sm:text-base font-light mb-10 leading-relaxed drop-shadow">
                Koleksi outerwear potongan santun, scarf voal ultrafine, dan tiered dress premium yang dirancang menemani gerak dinamis wanita modern.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('shop.catalog') }}" class="px-8 py-4 bg-white text-neutral-900 hover:bg-[#F5EFEB] rounded-full font-bold text-xs uppercase tracking-widest transition-all shadow-xl hover:scale-105">
                    Jelajahi Koleksi
                </a>
                <a href="{{ route('shop.catalog', ['series' => 'PUSPA']) }}" class="px-8 py-4 bg-black/40 hover:bg-black/60 text-white border border-white/30 backdrop-blur-md rounded-full font-bold text-xs uppercase tracking-widest transition-all hover:scale-105">
                    Lihat Seri PUSPA
                </a>
            </div>
        </div>
    </section>

    <!-- Value Propositions (Clean & Subtle Luxury Badges) -->
    <section class="border-y border-neutral-200/80 bg-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="flex items-center justify-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-neutral-100 flex items-center justify-center flex-shrink-0 text-neutral-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-xs uppercase tracking-wider text-neutral-900">Checkout Mandiri</p>
                        <p class="text-[11px] text-neutral-500">Aman tanpa antre admin WhatsApp</p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-neutral-100 flex items-center justify-center flex-shrink-0 text-neutral-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-xs uppercase tracking-wider text-neutral-900">Stok Real-Time</p>
                        <p class="text-[11px] text-neutral-500">Tersinkronisasi ke buku besar WMS</p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-neutral-100 flex items-center justify-center flex-shrink-0 text-neutral-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-xs uppercase tracking-wider text-neutral-900">Fit Helper Postur</p>
                        <p class="text-[11px] text-neutral-500">Simulasi jatuhnya baju pada tinggi Anda</p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-neutral-100 flex items-center justify-center flex-shrink-0 text-neutral-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-xs uppercase tracking-wider text-neutral-900">Garansi Retur 7 Hari</p>
                        <p class="text-[11px] text-neutral-500">Tukar ukuran mudah & inspeksi QC</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Series Spotlight (High Fashion Lookbook Cards) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <div class="text-center mb-12">
            <span class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Koleksi Tematik</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-neutral-900 mt-1.5">Seri & Rilisan Eksklusif</h2>
            <div class="w-12 h-0.5 bg-[#BA805E] mx-auto mt-3"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($series as $s)
                <a href="{{ route('shop.catalog', ['series' => $s->code]) }}" class="group relative rounded-3xl overflow-hidden aspect-[4/5] bg-neutral-200 block shadow-md hover:shadow-2xl transition-all duration-500">
                    <img src="{{ $s->banner_image }}" alt="{{ $s->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-neutral-950/90 via-neutral-950/30 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] uppercase tracking-widest font-bold px-2.5 py-0.5 rounded-full bg-white/20 backdrop-blur-md text-[#DCC3AD]">
                                {{ $s->products_count }} Produk
                            </span>
                            <span class="text-xs font-semibold tracking-wider text-white group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </div>
                        <h3 class="font-serif text-2xl sm:text-3xl font-bold tracking-tight">{{ $s->name }}</h3>
                        <p class="text-xs text-neutral-300 line-clamp-2 font-light leading-relaxed">{{ $s->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Products Grid (Symmetrical 4-Column Luxury Cards) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-20">
        <div class="flex items-end justify-between mb-10 pb-4 border-b border-neutral-200">
            <div>
                <span class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Paling Diminati</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-neutral-900 mt-1">Koleksi Terpopuler</h2>
            </div>
            <a href="{{ route('shop.catalog') }}" class="text-xs font-bold text-neutral-900 hover:text-[#BA805E] tracking-widest uppercase transition-colors pb-1 border-b-2 border-neutral-900 hover:border-[#BA805E]">
                Lihat Semua &rarr;
            </a>
        </div>

        <!-- SYMMETRICAL 4-COLUMN GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-7">
            @foreach($featuredProducts as $product)
                <div class="group bg-white rounded-3xl overflow-hidden border border-neutral-200/70 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                    <a href="{{ route('shop.product', $product->slug) }}" class="relative aspect-[3/4] bg-neutral-100 overflow-hidden block">
                        <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @if($product->is_preorder)
                            <span class="absolute top-3 left-3 bg-neutral-900/90 text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full backdrop-blur-sm">
                                Pre-Order
                            </span>
                        @endif
                        <span class="absolute top-3 right-3 bg-white/95 text-neutral-800 text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm">
                            {{ ucfirst($product->category) }}
                        </span>
                    </a>
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                        <div class="space-y-1">
                            @if($product->series)
                                <p class="text-[10px] uppercase tracking-widest text-[#BA805E] font-bold">{{ $product->series->name }}</p>
                            @endif
                            <h3 class="font-serif text-base sm:text-lg font-bold text-neutral-900 group-hover:text-[#BA805E] transition-colors leading-snug">
                                <a href="{{ route('shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-xs text-neutral-500 line-clamp-1 font-light">{{ $product->material }}</p>
                        </div>

                        <div class="pt-3 border-t border-neutral-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-neutral-400 block uppercase tracking-wider">Harga</span>
                                <span class="font-bold text-neutral-900 text-sm">
                                    {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                                </span>
                            </div>
                            <a href="{{ route('shop.product', $product->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-neutral-900 group-hover:text-[#BA805E] transition-colors">
                                <span>Detail</span>
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Community & Instagram Banner (#everydayitsfriday) -->
    <section class="bg-gradient-to-b from-[#F5EFEB] to-[#EADCCE]/50 border-t border-neutral-200/80 py-20">
        <div class="max-w-4xl mx-auto px-4 text-center space-y-5">
            <span class="inline-block text-[11px] font-bold uppercase tracking-[0.3em] text-[#BA805E]">Komunitas & Cerita</span>
            <h2 class="font-serif text-4xl sm:text-5xl font-bold text-neutral-900 tracking-tight">#everydayitsfriday</h2>
            <p class="text-neutral-700 text-sm sm:text-base max-w-xl mx-auto leading-relaxed font-light">
                Bergabunglah bersama 51.000+ wanita inspiratif yang merayakan keanggunan, rasa nyaman, dan kepraktisan pakaian modest premium setiap hari.
            </p>
            <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('shop.catalog') }}" class="px-8 py-3.5 bg-neutral-900 hover:bg-neutral-800 text-white rounded-full text-xs font-bold uppercase tracking-widest transition-all shadow-lg hover:scale-105">
                    Mulai Belanja Sekarang
                </a>
                <a href="{{ route('shop.tracking') }}" class="px-8 py-3.5 bg-white text-neutral-900 border border-neutral-300 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-neutral-50 transition-all shadow-sm hover:scale-105">
                    Lacak Status Pesanan
                </a>
            </div>
        </div>
    </section>
@endsection
