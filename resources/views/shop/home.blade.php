@extends('layouts.shop')

@section('title', 'ITSFRIDAY — Timeless Modest Wear & Premium Outerwear')

@section('content')
    <!-- Hero Banner -->
    <section class="relative bg-neutral-900 text-white overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-40">
            <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1600&q=80" alt="ITSFRIDAY Hero Collection" class="w-full h-full object-cover">
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-36 flex flex-col items-center text-center">
            <span class="text-xs uppercase tracking-[0.3em] font-semibold text-brand-300 mb-4">Everyday Comfort, Weekend Confidence</span>
            <h1 class="font-serif text-4xl sm:text-6xl lg:text-7xl font-bold tracking-tight max-w-3xl leading-[1.1] mb-6">
                Sentuhan Elegan untuk Hari-Hari Anda
            </h1>
            <p class="text-neutral-300 max-w-xl text-sm sm:text-base font-light mb-8 leading-relaxed">
                Koleksi outerwear, scarf voal ultrafine, dan tiered dress premium yang dirancang untuk menemani gerak dinamis wanita modern.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('shop.catalog') }}" class="px-8 py-3.5 bg-white text-neutral-900 hover:bg-neutral-100 rounded-full font-semibold text-xs uppercase tracking-widest transition-all shadow-lg hover:shadow-xl">
                    Jelajahi Koleksi
                </a>
                <a href="{{ route('shop.catalog', ['series' => 'PUSPA']) }}" class="px-8 py-3.5 bg-neutral-800/80 hover:bg-neutral-800 text-white border border-neutral-700 rounded-full font-semibold text-xs uppercase tracking-widest transition-all">
                    Lihat Seri PUSPA
                </a>
            </div>
        </div>
    </section>

    <!-- Value Propositions -->
    <section class="border-b border-neutral-200 bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="space-y-1">
                    <p class="font-bold text-xs uppercase tracking-wider text-neutral-900">Kanal Mandiri</p>
                    <p class="text-xs text-neutral-500">Checkout aman tanpa admin chat WhatsApp</p>
                </div>
                <div class="space-y-1">
                    <p class="font-bold text-xs uppercase tracking-wider text-neutral-900">Stok Real-Time</p>
                    <p class="text-xs text-neutral-500">Tersinkronisasi langsung dengan sistem gudang</p>
                </div>
                <div class="space-y-1">
                    <p class="font-bold text-xs uppercase tracking-wider text-neutral-900">Interactive Fit Helper</p>
                    <p class="text-xs text-neutral-500">Simulasi jatuhnya baju berdasarkan tinggi badan</p>
                </div>
                <div class="space-y-1">
                    <p class="font-bold text-xs uppercase tracking-wider text-neutral-900">Garansi Retur 7 Hari</p>
                    <p class="text-xs text-neutral-500">Portal pengajuan mandiri dengan inspeksi QC</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Series Spotlight -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <span class="text-xs uppercase tracking-widest text-brand-700 font-semibold">Koleksi Tematik</span>
            <h2 class="font-serif text-3xl font-bold text-neutral-900 mt-1">Seri & Rilisan Eksklusif</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($series as $s)
                <a href="{{ route('shop.catalog', ['series' => $s->code]) }}" class="group relative rounded-2xl overflow-hidden aspect-[4/5] bg-neutral-200 block shadow-sm hover:shadow-md transition-all">
                    <img src="{{ $s->banner_image }}" alt="{{ $s->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-neutral-950/80 via-neutral-950/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white space-y-1.5">
                        <span class="text-[10px] uppercase tracking-widest font-bold text-brand-300">{{ $s->products_count }} Produk</span>
                        <h3 class="font-serif text-2xl font-bold">{{ $s->name }}</h3>
                        <p class="text-xs text-neutral-300 line-clamp-2 font-light">{{ $s->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Products Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mb-16">
        <div class="flex items-end justify-between mb-10">
            <div>
                <span class="text-xs uppercase tracking-widest text-brand-700 font-semibold">Paling Diminati</span>
                <h2 class="font-serif text-3xl font-bold text-neutral-900 mt-1">Koleksi Terpopuler</h2>
            </div>
            <a href="{{ route('shop.catalog') }}" class="text-xs font-semibold text-neutral-900 hover:text-brand-700 tracking-wider uppercase underline">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProducts as $product)
                <div class="group bg-white rounded-2xl overflow-hidden border border-neutral-200/80 shadow-sm hover:shadow-md transition-all flex flex-col">
                    <a href="{{ route('shop.product', $product->slug) }}" class="relative aspect-[3/4] bg-neutral-100 overflow-hidden block">
                        <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($product->is_preorder)
                            <span class="absolute top-3 left-3 bg-neutral-900/90 text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full backdrop-blur-sm">
                                Pre-Order ({{ $product->preorder_lead_days }} Hari)
                            </span>
                        @endif
                        <span class="absolute top-3 right-3 bg-white/90 text-neutral-800 text-[10px] font-semibold uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                            {{ ucfirst($product->category) }}
                        </span>
                    </a>
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                            @if($product->series)
                                <p class="text-[10px] uppercase tracking-widest text-brand-700 font-bold mb-1">{{ $product->series->name }}</p>
                            @endif
                            <h3 class="font-serif text-lg font-bold text-neutral-900 group-hover:text-brand-700 transition-colors">
                                <a href="{{ route('shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-xs text-neutral-500 line-clamp-1 mt-1">{{ $product->material }}</p>
                        </div>

                        <div class="pt-3 border-t border-neutral-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-neutral-400 block text-[10px] uppercase tracking-wider">Mulai dari</span>
                                <span class="font-semibold text-neutral-900 text-sm">
                                    {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                                </span>
                            </div>
                            <a href="{{ route('shop.product', $product->slug) }}" class="px-4 py-2 bg-neutral-900 hover:bg-neutral-800 text-white text-xs font-semibold rounded-lg tracking-wider uppercase transition-colors">
                                Pilih Varian
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Community & Instagram Banner -->
    <section class="bg-neutral-100 border-t border-neutral-200 py-16">
        <div class="max-w-4xl mx-auto px-4 text-center space-y-4">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-700">Komunitas & Cerita</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-neutral-900">#everydayitsfriday</h2>
            <p class="text-neutral-600 text-sm max-w-xl mx-auto leading-relaxed">
                Bergabunglah bersama 51.000+ wanita inspiratif yang merayakan keanggunan, rasa nyaman, dan kepraktisan pakaian modest setiap hari.
            </p>
            <div class="pt-4 flex items-center justify-center gap-3">
                <a href="{{ route('shop.catalog') }}" class="px-6 py-3 bg-neutral-900 text-white rounded-full text-xs font-semibold uppercase tracking-widest hover:bg-neutral-800 transition-all">
                    Belanja Sekarang
                </a>
                <a href="{{ route('shop.tracking') }}" class="px-6 py-3 bg-white text-neutral-800 border border-neutral-300 rounded-full text-xs font-semibold uppercase tracking-widest hover:bg-neutral-50 transition-all">
                    Lacak Pesanan Mandiri
                </a>
            </div>
        </div>
    </section>
@endsection

