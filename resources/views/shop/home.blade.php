@extends('layouts.shop')

@section('title', 'ITSFRIDAY — Timeless Modest Wear & Premium Outerwear')
@section('meta_description', 'Koleksi modest fashion wanita Indonesia: outerwear santun, voal scarf ultrafine, dan tiered dress casual-elegan. #everydayitsfriday')

@section('content')
<div class="space-y-12 sm:space-y-20 lg:space-y-24">

    <!-- HERO SECTION (Section B: Desktop Split Layout, Max 70vh desktop, 60vh mobile) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-8">
        <div class="bg-[#F5EFEB]/70 rounded-3xl border border-neutral-200/70 p-6 sm:p-10 lg:p-12 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Left Text Column -->
                <div class="lg:col-span-7 space-y-5 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-[#BA805E]/30 text-[#BA805E] text-xs font-bold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]"></span>
                        <span>Koleksi Modest Daily & Formal</span>
                    </div>

                    <h1 class="font-serif text-[clamp(2rem,5vw,3.5rem)] font-bold tracking-tight text-neutral-950 leading-[1.12]">
                        Outer yang Jatuh Anggun, dari Kuliah sampai Kondangan.
                    </h1>

                    <p class="text-neutral-600 text-[15px] sm:text-base leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Potongan santun dengan siluet effortless chic dan bahan adem. Dirancang menemani hari aktifmu tanpa khawatir kusut.
                    </p>

                    <!-- CTAs: Primary Terracotta + Secondary Link -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center gap-3 sm:gap-4 justify-center lg:justify-start">
                        <a href="{{ route('shop.catalog') }}" class="w-full sm:w-auto min-h-[44px] px-8 py-3.5 bg-[#BA805E] hover:bg-[#a66f4e] text-white rounded-full font-bold text-xs uppercase tracking-wider transition-all shadow-md hover:shadow-lg text-center flex items-center justify-center">
                            Jelajahi Koleksi
                        </a>
                        <a href="#fit-helper" class="min-h-[44px] px-4 py-2 text-xs font-bold text-neutral-800 hover:text-[#BA805E] transition-colors flex items-center justify-center gap-1.5">
                            <span>Panduan Ukuran Sesuai Tinggi</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Right Fashion Visual Column (Modest Outer Layering) -->
                <div class="lg:col-span-5 relative">
                    <div class="relative aspect-[4/5] max-h-[380px] sm:max-h-[460px] lg:max-h-[500px] w-full rounded-2xl sm:rounded-3xl overflow-hidden shadow-md">
                        <img 
                            src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=1000&q=80" 
                            alt="Model Modest Outer Layering ITSFRIDAY" 
                            class="w-full h-full object-cover block"
                        >
                        <!-- Gentle overlay gradient for fashion clarity (opacity max 35%) -->
                        <div class="absolute inset-0 bg-gradient-to-t from-neutral-950/35 via-transparent to-transparent pointer-events-none"></div>
                        <div class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/40 flex items-center justify-between text-xs">
                            <div>
                                <p class="font-bold text-neutral-900">PUSPA Kimono Outer</p>
                                <p class="text-[11px] text-neutral-500">Premium Rayon Twill • Sage Green</p>
                            </div>
                            <span class="font-bold text-[#BA805E] font-mono">Rp 389.000</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- TRUST BAR (Section D: Buyer-focused Language, 4 cols desktop, 2x2 mobile) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-neutral-200/80 p-5 sm:p-6 shadow-sm">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                <!-- Point 1 -->
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FAF8F5] border border-[#EADCCE] text-[#BA805E] flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-neutral-900">Checkout Cepat</h4>
                        <p class="text-[11px] sm:text-xs text-neutral-500 leading-snug mt-0.5">Checkout cepat tanpa antre admin</p>
                    </div>
                </div>

                <!-- Point 2 -->
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FAF8F5] border border-[#EADCCE] text-[#BA805E] flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-neutral-900">Stok Selalu Akurat</h4>
                        <p class="text-[11px] sm:text-xs text-neutral-500 leading-snug mt-0.5">Tidak ada pesanan batal karena stok habis</p>
                    </div>
                </div>

                <!-- Point 3 -->
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FAF8F5] border border-[#EADCCE] text-[#BA805E] flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-neutral-900">Panduan Ukuran</h4>
                        <p class="text-[11px] sm:text-xs text-neutral-500 leading-snug mt-0.5">Simulasi panjang pas sesuai tinggi badanmu</p>
                    </div>
                </div>

                <!-- Point 4 -->
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FAF8F5] border border-[#EADCCE] text-[#BA805E] flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <div>
                        <a href="{{ route('shop.returns') }}" class="group block">
                            <h4 class="text-xs font-bold text-neutral-900 group-hover:text-[#BA805E] transition-colors flex items-center gap-1">
                                <span>Garansi Retur 7 Hari</span>
                                <span class="text-[10px] text-[#BA805E]">&rarr;</span>
                            </h4>
                            <p class="text-[11px] sm:text-xs text-neutral-500 leading-snug mt-0.5">Tukar ukuran mandiri tanpa rasa khawatir</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION E: KARTU SERI (Aspect 4/5, Max height 420px, Mobile scroll-snap carousel 78vw) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-6 pb-3 border-b border-neutral-200">
            <div>
                <span class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Koleksi Tematik</span>
                <h2 class="font-serif text-[clamp(1.5rem,3.5vw,2.25rem)] font-bold text-neutral-950 mt-1">
                    Seri & Rilisan Eksklusif
                </h2>
            </div>
            <a href="{{ route('shop.catalog') }}" class="text-xs font-bold text-neutral-900 hover:text-[#BA805E] transition-colors pb-0.5 border-b border-neutral-900 hover:border-[#BA805E] shrink-0">
                Semua Seri &rarr;
            </a>
        </div>

        <!-- Series Grid / Mobile Scroll-snap Carousel -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 -mx-4 px-4 pb-4 sm:mx-0 sm:px-0 sm:grid sm:grid-cols-3 sm:gap-6 custom-scrollbar">
            @foreach($series as $s)
                <a 
                    href="{{ route('shop.catalog', ['series' => $s->code]) }}" 
                    class="group relative w-[78vw] max-w-[320px] shrink-0 snap-center sm:w-full sm:max-w-none aspect-[4/5] max-h-[420px] rounded-2xl sm:rounded-3xl overflow-hidden block shadow-sm hover:shadow-xl transition-all duration-300"
                >
                    <img 
                        src="{{ $s->banner_image }}" 
                        alt="{{ $s->name }} — Modest Collection" 
                        loading="lazy" 
                        class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 block"
                    >
                    <!-- Bottom Gradient Overlay (Contrast > 4.5:1) -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/45 to-transparent"></div>

                    <div class="absolute bottom-5 left-5 right-5 text-white space-y-1.5">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] uppercase tracking-wider font-bold px-2.5 py-0.5 rounded-full bg-white/20 backdrop-blur-md text-[#DCC3AD]">
                                {{ $s->products_count }} Busana
                            </span>
                            <span class="text-xs font-semibold text-white group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </div>
                        <h3 class="font-serif text-xl sm:text-2xl font-bold tracking-tight text-white line-clamp-1">
                            {{ $s->name }}
                        </h3>
                        <p class="text-xs text-neutral-200 line-clamp-2 font-light leading-relaxed">
                            {{ $s->description }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- SECTION G: FITUR BARU RINGKAS -->
    
    <!-- G3: Belanja per Momen (4 Moment Cards) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-6">
            <span class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Inspirasi Busana</span>
            <h2 class="font-serif text-[clamp(1.4rem,3vw,2rem)] font-bold text-neutral-950 mt-1">
                Belanja Berdasarkan Momen
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
            <!-- Momen 1 -->
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-sm hover:shadow-md">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="text-base">✨</span>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors">Kondangan & Pesta</h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Outer jatuh mewah & voal ultrafine berkilau</p>
            </a>

            <!-- Momen 2 -->
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-sm hover:shadow-md">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="text-base">🎓</span>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors">Wisuda & Sidang</h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Siluet santun rapi berwibawa</p>
            </a>

            <!-- Momen 3 -->
            <a href="{{ route('shop.catalog', ['category' => 'dress']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-sm hover:shadow-md">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="text-base">🕊️</span>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors">Kajian & Silaturahmi</h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Potongan longgar sejuk tanpa terawang</p>
            </a>

            <!-- Momen 4 -->
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-sm hover:shadow-md">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="text-base">☕</span>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors">Kuliah & Hangout</h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Casual chic, mudah di-layering</p>
            </a>
        </div>
    </section>

    <!-- G1: Shop the Look (Max height 520px desktop) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#FAF8F5] border border-[#EADCCE] rounded-3xl p-6 sm:p-8 lg:p-10 shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center max-h-none lg:max-h-[520px]">
                
                <!-- Model Lookbook Image -->
                <div class="lg:col-span-5 relative aspect-[4/5] max-h-[320px] sm:max-h-[380px] lg:max-h-[440px] rounded-2xl overflow-hidden shadow-sm">
                    <img 
                        src="https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=800&q=80" 
                        alt="Shop The Look Modest Styling ITSFRIDAY" 
                        loading="lazy" 
                        class="w-full h-full object-cover block"
                    >
                    <span class="absolute top-3 left-3 bg-neutral-900/90 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                        Set Inspirasi
                    </span>
                </div>

                <!-- Products in this look -->
                <div class="lg:col-span-7 space-y-4">
                    <div>
                        <span class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Gaya Lengkap</span>
                        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-neutral-950 mt-1">
                            Set "Effortless Friday"
                        </h3>
                        <p class="text-xs sm:text-sm text-neutral-600 mt-1">
                            Perpaduan kimono outer, voal scarf ultrafine, dan tiered inner dengan harmoni warna earth-tone.
                        </p>
                    </div>

                    <!-- 3 Items in Look -->
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between p-3 rounded-xl bg-white border border-neutral-200 text-xs">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-[#F5EFEB] text-[#BA805E] font-bold text-[11px] flex items-center justify-center">1</span>
                                <div>
                                    <p class="font-bold text-neutral-900">PUSPA Floral Kimono Outer</p>
                                    <p class="text-[11px] text-neutral-500">Bahan Rayon Twill Adem</p>
                                </div>
                            </div>
                            <span class="font-bold font-mono text-neutral-900">Rp 389.000</span>
                        </div>

                        <div class="flex items-center justify-between p-3 rounded-xl bg-white border border-neutral-200 text-xs">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-[#F5EFEB] text-[#BA805E] font-bold text-[11px] flex items-center justify-center">2</span>
                                <div>
                                    <p class="font-bold text-neutral-900">PUSPA Voal Printed Scarf 120x120</p>
                                    <p class="text-[11px] text-neutral-500">Tegak di Dahi, Lembut</p>
                                </div>
                            </div>
                            <span class="font-bold font-mono text-neutral-900">Rp 149.000</span>
                        </div>

                        <div class="flex items-center justify-between p-3 rounded-xl bg-white border border-neutral-200 text-xs">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-[#F5EFEB] text-[#BA805E] font-bold text-[11px] flex items-center justify-center">3</span>
                                <div>
                                    <p class="font-bold text-neutral-900">ISLA Tiered Inner Maxi</p>
                                    <p class="text-[11px] text-neutral-500">Pure Crinkle Airflow</p>
                                </div>
                            </div>
                            <span class="font-bold font-mono text-neutral-900">Rp 299.000</span>
                        </div>
                    </div>

                    <!-- Bundle Action -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-neutral-200/80">
                        <div>
                            <span class="text-[11px] text-neutral-500 block">Harga 1 Paket Spesial:</span>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-lg text-neutral-950 font-mono">Rp 753.000</span>
                                <span class="text-xs text-neutral-400 line-through font-mono">Rp 837.000</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#BA805E]/15 text-[#BA805E]">Hemat 10%</span>
                            </div>
                        </div>
                        <a href="{{ route('shop.catalog') }}" class="w-full sm:w-auto min-h-[44px] px-6 py-2.5 bg-neutral-950 hover:bg-[#BA805E] text-white font-bold text-xs uppercase tracking-wider rounded-full transition-colors flex items-center justify-center gap-2">
                            <span>Jelajahi Paket Lengkap</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- G2: Cari Ukuranmu / Fit Concierge -->
    <section id="fit-helper" class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl border border-neutral-200 p-6 sm:p-8 shadow-sm">
            <div class="max-w-2xl mx-auto text-center space-y-2 mb-6">
                <span class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Fit Concierge</span>
                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-neutral-950">
                    Cari Ukuran Panjang Outer Sesuai Tinggimu
                </h3>
                <p class="text-xs sm:text-sm text-neutral-600">
                    Pilih rentang tinggi badan Anda untuk melihat simulasi rekomendasi panjang baju agar tidak mengatung atau menyapu lantai.
                </p>
            </div>

            <!-- Height Selector Buttons -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 max-w-xl mx-auto mb-6 text-xs" id="fit-buttons">
                <button type="button" onclick="setFitHeight(105, '150 - 155 cm', 'Jatuh pas 10 cm di bawah lutut, memberi siluet jenjang tanpa perlu dipotong.')" class="fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-800 focus:outline-none">
                    150 – 155 cm
                </button>
                <button type="button" onclick="setFitHeight(110, '156 - 160 cm', 'Panjang midi ideal di pertengahan betis, sangat leluasa saat berjalan aktif.')" class="fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-900 bg-neutral-900 text-white font-bold transition-all focus:outline-none">
                    156 – 160 cm
                </button>
                <button type="button" onclick="setFitHeight(115, '161 - 165 cm', 'Jatuh proporsional 15 cm di atas mata kaki, siluet semampai dan rapi.')" class="fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-800 focus:outline-none">
                    161 – 165 cm
                </button>
                <button type="button" onclick="setFitHeight(120, '166+ cm', 'Tampilan full-length elegan, jatuh tepat di batas atas sepatu/heels.')" class="fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-800 focus:outline-none">
                    166+ cm
                </button>
            </div>

            <!-- Recommendation Display Card -->
            <div class="max-w-xl mx-auto p-4 sm:p-5 rounded-2xl bg-[#FAF8F5] border border-[#EADCCE] flex items-center justify-between text-xs gap-4">
                <div>
                    <span class="text-[11px] text-neutral-500 uppercase tracking-wider block">Rekomendasi Panjang Outer:</span>
                    <span class="font-serif text-xl sm:text-2xl font-bold text-[#BA805E]" id="fit-result-length">110 cm</span>
                    <p class="text-[11px] text-neutral-600 mt-0.5" id="fit-result-desc">
                        Panjang midi ideal di pertengahan betis, sangat leluasa saat berjalan aktif.
                    </p>
                </div>
                <a href="{{ route('shop.catalog') }}" class="min-h-[44px] px-5 py-2.5 rounded-full bg-neutral-900 hover:bg-[#BA805E] text-white text-xs font-bold shrink-0 transition-colors inline-flex items-center">
                    Cari Model Ini &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION F: KARTU PRODUK (4 Kolom desktop, 3 tablet, 2 mobile. Max height 360px desktop, 280px mobile) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-6 pb-3 border-b border-neutral-200">
            <div>
                <span class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Paling Diminati</span>
                <h2 class="font-serif text-[clamp(1.5rem,3.5vw,2.25rem)] font-bold text-neutral-950 mt-1">
                    Koleksi Terpopuler
                </h2>
            </div>
            <a href="{{ route('shop.catalog') }}" class="text-xs font-bold text-neutral-900 hover:text-[#BA805E] transition-colors pb-0.5 border-b border-neutral-900 hover:border-[#BA805E] shrink-0">
                Lihat Semua ({{ $featuredProducts->count() }}+) &rarr;
            </a>
        </div>

        <!-- Responsive Grid: 4 cols (≥1024px), 3 cols (768-1023px), 2 cols (<768px) -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
            @foreach($featuredProducts as $index => $product)
                <div class="group bg-white rounded-2xl sm:rounded-3xl overflow-hidden border border-neutral-200/80 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    
                    <div>
                        <!-- Product Image (Aspect 3/4, max height 360px desktop, 280px mobile) -->
                        <div class="relative aspect-[3/4] max-h-[280px] sm:max-h-[360px] bg-[#F5EFEB] overflow-hidden block">
                            <a href="{{ route('shop.product', $product->slug) }}" class="block w-full h-full">
                                <img 
                                    src="{{ $product->primary_image }}" 
                                    alt="{{ $product->name }} — Modest Fashion" 
                                    loading="lazy" 
                                    class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 block"
                                >
                            </a>

                            <!-- Badges (Never overlap: Preorder on top-left, Category on top-right) -->
                            <div class="absolute top-2.5 left-2.5 flex flex-col gap-1 items-start pointer-events-none">
                                @if($product->is_preorder)
                                    <span class="bg-[#BA805E] text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full shadow-sm">
                                        Pre-Order
                                    </span>
                                @elseif($index === 0)
                                    <span class="bg-neutral-900 text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full shadow-sm">
                                        Terlaris
                                    </span>
                                @endif
                            </div>

                            <span class="absolute top-2.5 right-2.5 bg-white/95 text-neutral-800 text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full shadow-sm pointer-events-none">
                                {{ ucfirst($product->category) }}
                            </span>

                            <!-- Desktop Quick View Button (hover reveal) -->
                            <div class="absolute inset-x-3 bottom-3 hidden lg:flex justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('shop.product', $product->slug) }}" class="min-h-[40px] w-full py-2 bg-white/95 hover:bg-neutral-950 hover:text-white text-neutral-900 text-xs font-bold rounded-xl shadow-md text-center transition-colors flex items-center justify-center">
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
                                    <span>★</span>
                                    <span class="text-neutral-700">4.9</span>
                                </div>
                            </div>

                            <!-- Product Title (Max 2 lines) -->
                            <h3 class="font-serif text-sm sm:text-base font-bold text-neutral-950 group-hover:text-[#BA805E] transition-colors leading-snug line-clamp-2">
                                <a href="{{ route('shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h3>

                            <!-- Short Description (Desktop only, max 1 line) -->
                            <p class="hidden md:block text-xs text-neutral-500 line-clamp-1 font-light">
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

                        <!-- Quick Add Cart Button (Min 44x44px touch target) -->
                        <a 
                            href="{{ route('shop.product', $product->slug) }}" 
                            aria-label="Pilih varian {{ $product->name }}" 
                            class="min-h-[44px] min-w-[44px] rounded-xl bg-neutral-100 hover:bg-[#BA805E] hover:text-white text-neutral-800 flex items-center justify-center transition-colors cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    </section>

    <!-- SECTION H: KOMUNITAS #everydayitsfriday (6 photos 1/1 desktop, 3x2 mobile, Max 180px per side) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#F5EFEB]/50 rounded-3xl border border-neutral-200/80 p-6 sm:p-10 text-center space-y-4">
            <span class="inline-block text-[11px] font-bold uppercase tracking-[0.25em] text-[#BA805E]">Komunitas Cerita</span>
            <h2 class="font-serif text-[clamp(1.5rem,3.5vw,2.25rem)] font-bold text-neutral-950">#everydayitsfriday</h2>
            <p class="text-neutral-600 text-xs sm:text-sm max-w-xl mx-auto leading-relaxed">
                Cerita hangat wanita Indonesia merayakan keanggunan dan kenyamanan pakaian modest setiap hari. Tag <strong>@itsfriday.id</strong> untuk tampil di sini.
            </p>

            <!-- UGC Photo Grid: 6 photos (6 cols desktop, 3x2 mobile, max 180px each) -->
            <div class="grid grid-cols-3 sm:grid-cols-6 gap-2.5 sm:gap-3.5 pt-3">
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80" alt="Pelanggan ITSFRIDAY UGC 1" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&q=80" alt="Pelanggan ITSFRIDAY UGC 2" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&q=80" alt="Pelanggan ITSFRIDAY UGC 3" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=400&q=80" alt="Pelanggan ITSFRIDAY UGC 4" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&q=80" alt="Pelanggan ITSFRIDAY UGC 5" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=400&q=80" alt="Pelanggan ITSFRIDAY UGC 6" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
            </div>

            <div class="pt-2">
                <a href="{{ route('shop.catalog') }}" class="min-h-[44px] inline-flex items-center justify-center px-7 py-3 rounded-full bg-neutral-900 hover:bg-[#BA805E] text-white text-xs font-bold uppercase tracking-wider transition-colors shadow-sm">
                    Mulai Belanja Koleksi Kami
                </a>
            </div>
        </div>
    </section>

</div>

@push('scripts')
<script>
function setFitHeight(length, range, desc) {
    document.getElementById('fit-result-length').innerText = length + ' cm';
    document.getElementById('fit-result-desc').innerText = desc;
    
    // Toggle active style on buttons
    const buttons = document.querySelectorAll('#fit-buttons .fit-btn');
    buttons.forEach(btn => {
        if (btn.innerText.includes(range.split(' ')[0])) {
            btn.className = 'fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-900 bg-neutral-900 text-white font-bold transition-all focus:outline-none';
        } else {
            btn.className = 'fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-800 focus:outline-none';
        }
    });
}
</script>
@endpush
@endsection
