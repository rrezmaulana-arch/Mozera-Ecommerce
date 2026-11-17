@extends('layouts.shop')

@section('title', 'MOZÉRA — Timeless Modest Wear & Premium Outerwear')
@section('meta_description', 'Koleksi modest fashion wanita Indonesia: outerwear santun, voal scarf ultrafine, dan tiered dress casual-elegan. #everydaymozera')

@section('content')
<div class="space-y-12 sm:space-y-20 lg:space-y-24">

    <!-- HERO SECTION (Harmonious Editorial Canvas: Unified Headline & Architectural Model Arch) -->
    <section class="w-full relative bg-[#FAF9F6] border-b border-neutral-200/50 py-10 lg:py-16">
        <div class="max-w-[1360px] mx-auto px-6 sm:px-10 lg:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">

                <!-- Left Text Column: Distinct Narrative & Clear Visual Weight -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#F5EFEB] border border-[#BA805E]/30 text-[#BA805E] text-xs font-bold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-[#BA805E] animate-pulse"></span>
                        <span>Koleksi Modest Atasan dan Outerwear</span>
                    </div>

                    <h1 class="font-serif text-[clamp(2.2rem,5vw,3.75rem)] font-bold tracking-tight text-neutral-950 leading-[1.14]">
                        Outer yang <span class="font-serif italic font-normal text-[#BA805E]">Jatuh Anggun</span>, dari Kuliah sampai Kondangan.
                    </h1>

                    <p class="text-neutral-600 text-[15px] sm:text-base leading-relaxed max-w-xl mx-auto lg:mx-0 font-light">
                        Potongan santun dengan siluet effortless chic dan bahan adem. Dirancang menemani hari aktif wanita Indonesia tanpa khawatir kusut.
                    </p>

                    <!-- CTAs: Primary Terracotta + Secondary Link -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                        <a href="{{ route('shop.catalog') }}" class="w-full sm:w-auto min-h-[48px] px-8 py-3.5 bg-[#BA805E] hover:bg-[#a66f4e] text-white rounded-full font-bold text-xs uppercase tracking-wider transition-all shadow-md hover:shadow-lg text-center flex items-center justify-center">
                            Jelajahi Koleksi Atasan
                        </a>
                        <a href="#try-the-look" class="min-h-[48px] px-5 py-3 text-xs font-bold text-neutral-800 hover:text-[#BA805E] transition-colors flex items-center justify-center gap-2">
                            <span>Lihat Runway Interaktif</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                    </div>

                    <!-- Micro Trust Line under Buttons -->
                    <div class="pt-1 flex flex-wrap items-center gap-x-4 gap-y-1.5 text-[11px] text-neutral-500 font-light justify-center lg:justify-start">
                        <span class="flex items-center gap-1.5 text-neutral-700 font-medium">
                            <span class="text-[#BA805E]">&bull;</span> Bahan Rayon Twill Sejuk
                        </span>
                        <span class="flex items-center gap-1.5 text-neutral-700 font-medium">
                            <span class="text-[#BA805E]">&bull;</span> Jahitan Butik Rapi
                        </span>
                        <span class="flex items-center gap-1.5 text-neutral-700 font-medium">
                            <span class="text-[#BA805E]">&bull;</span> Ready Stock Surabaya
                        </span>
                    </div>
                </div>

                <!-- Right Fashion Visual Column: Architectural Arch Framing Model -->
                <div class="lg:col-span-5 relative flex items-center justify-center">
                    <div class="relative w-full max-w-[270px] sm:max-w-[330px] lg:max-w-[370px] h-[330px] sm:h-[410px] lg:h-[480px] bg-gradient-to-b from-[#F5EFEB] via-[#EFE7DE] to-[#E6DDD2] rounded-t-[110px] sm:rounded-t-[140px] rounded-b-2xl sm:rounded-b-3xl border border-neutral-300/40 p-3 sm:p-4 pt-6 sm:pt-8 shadow-sm flex flex-col items-center justify-end overflow-hidden group">
                        
                        <!-- Top Arch Heritage Tag -->
                        <div class="absolute top-3 sm:top-4 z-10">
                            <span class="text-[8px] sm:text-[9px] font-bold tracking-[0.25em] text-[#8A4F35] bg-white/80 backdrop-blur-md px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-full uppercase border border-[#BA805E]/20 shadow-xs">
                                MOZÉRA ESSENTIALS
                            </span>
                        </div>

                        <!-- Floor Contact Shadow -->
                        <div class="absolute bottom-4 sm:bottom-5 w-36 sm:w-44 h-3.5 sm:h-4 bg-neutral-950/20 rounded-full filter blur-[3.5px]"></div>

                        <!-- Model Cutout Image (Perfect Centered Perspective) -->
                        <img
                            src="/images/models/look-1-terracotta.png"
                            alt="Model Modest Outer Kimono MOZÉRA"
                            class="h-[280px] sm:h-[350px] lg:h-[420px] w-auto object-contain select-none filter drop-shadow-md relative z-10 transition-transform duration-500 group-hover:scale-[1.02]"
                        >

                        <!-- Floating Interactive Product Pill (Anchored at Base) -->
                        <a 
                            href="{{ route('shop.product', 'puspa-floral-outer-kimono') }}" 
                            class="absolute bottom-2.5 sm:bottom-3 left-2.5 sm:left-3 right-2.5 sm:right-3 bg-white/95 backdrop-blur-md px-3 py-2 sm:px-3.5 sm:py-2.5 rounded-xl sm:rounded-2xl border border-neutral-200/90 shadow-md flex items-center justify-between text-xs z-20 hover:border-[#BA805E] transition-all group-hover:shadow-lg"
                        >
                            <div class="text-left">
                                <p class="font-bold text-neutral-900 text-[10px] sm:text-[11px] leading-tight truncate">PUSPA Floral Outer Kimono</p>
                                <p class="text-[9px] sm:text-[10px] text-neutral-500 truncate">Premium Rayon Twill &bull; Terracotta</p>
                            </div>
                            <span class="font-bold text-[#BA805E] font-mono text-[11px] sm:text-xs flex items-center gap-1 shrink-0 ml-1.5">
                                Rp 389.000 &rarr;
                            </span>
                        </a>
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

    <!-- SECTION E: KARTU SERI (Atelier Editorial Showcase - Bersih, Mewah, & Teratur) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-6 pb-3 border-b border-neutral-200">
            <div>
                <span class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">Koleksi Tematik</span>
                <h2 class="font-serif text-[clamp(1.5rem,3.5vw,2.25rem)] font-bold text-neutral-950 mt-1">
                    Seri dan Rilisan Eksklusif
                </h2>
            </div>
            <a href="{{ route('shop.catalog') }}" class="text-xs font-bold text-neutral-900 hover:text-[#BA805E] transition-colors pb-0.5 border-b border-neutral-900 hover:border-[#BA805E] shrink-0">
                Semua Seri &rarr;
            </a>
        </div>

        <!-- Series Grid / Mobile Scroll-snap Carousel -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 -mx-4 px-4 pb-4 sm:mx-0 sm:px-0 sm:grid sm:grid-cols-3 sm:gap-6 custom-scrollbar">
            @foreach($series as $s)
                @php
                    $koleksiNum = '0' . ($loop->index + 1);
                    $tipeBadge = $loop->index === 0 ? 'Tipe A: Siluet Lurus' : ($loop->index === 1 ? 'Tipe B: Siluet Fringe' : 'Heritage Limited');
                @endphp
                <a 
                    href="{{ route('shop.catalog', ['series' => $s->code]) }}" 
                    class="group relative w-[75vw] max-w-[290px] shrink-0 snap-center sm:w-full sm:max-w-none rounded-2xl sm:rounded-3xl overflow-hidden block shadow-xs hover:shadow-xl transition-all duration-500 bg-white border border-[#E8DEC9] hover:-translate-y-1 flex flex-col justify-between"
                >
                    <!-- Visual Model Frame (Atas: Foto Model Jernih & Kompak, Tanpa Memanjang Berlebih) -->
                    <div class="relative h-[220px] sm:h-[250px] lg:h-[270px] bg-gradient-to-b from-[#FAF8F5] to-[#F2EAE0] flex items-center justify-center p-3 sm:p-4 overflow-hidden">
                        <!-- Subtle Background Arch Motif -->
                        <div class="absolute inset-x-8 top-3 bottom-0 rounded-t-full bg-white/50 border-t border-x border-white/80 pointer-events-none group-hover:scale-105 transition-transform duration-500"></div>

                        <!-- Top Badges -->
                        <div class="absolute top-3 left-3 right-3 flex items-center justify-between z-10">
                            <span class="text-[9px] uppercase font-mono tracking-wider font-bold text-[#A66747] bg-white/95 px-2.5 py-0.5 rounded-full border border-[#E8DEC9] shadow-2xs">
                                {{ $tipeBadge }}
                            </span>
                            <span class="text-[9px] uppercase tracking-wider font-bold px-2 py-0.5 rounded-full bg-white/95 text-neutral-800 border border-[#E8DEC9] shadow-2xs">
                                {{ $s->products_count }} Busana
                            </span>
                        </div>

                        <!-- Modest Model Image -->
                        <img 
                            src="{{ $s->banner_image }}" 
                            alt="{{ $s->name }} — Modest Collection" 
                            loading="lazy" 
                            class="h-full w-auto max-w-full object-contain filter drop-shadow-md group-hover:scale-105 transition-transform duration-700 block relative z-0"
                        >
                    </div>

                    <!-- Editorial Content Section (Bawah: Ringkas, Proporsional & Elegan) -->
                    <div class="p-4 sm:p-4.5 bg-white space-y-1.5 flex-1 flex flex-col justify-between border-t border-[#F2ECE3]">
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-[10px] font-mono font-bold text-[#BA805E] uppercase tracking-wider">
                                <span>Koleksi {{ $koleksiNum }}</span>
                                <span class="text-neutral-400">Edisi Khusus</span>
                            </div>
                            <h3 class="font-serif text-base sm:text-lg font-bold tracking-tight text-neutral-950 group-hover:text-[#BA805E] transition-colors leading-snug">
                                {{ $s->name }}
                            </h3>
                            <p class="text-[11px] sm:text-xs text-neutral-500 line-clamp-2 font-light leading-relaxed">
                                {{ $s->description }}
                            </p>
                        </div>

                        <div class="pt-2.5 border-t border-neutral-100 flex items-center justify-between text-xs font-bold text-neutral-900 group-hover:text-[#BA805E] transition-colors">
                            <span class="text-[11px] uppercase tracking-wider">Jelajahi Koleksi</span>
                            <span class="w-6 h-6 rounded-full bg-[#FAF8F5] group-hover:bg-[#BA805E] group-hover:text-white flex items-center justify-center transition-all duration-300 text-xs">
                                &rarr;
                            </span>
                        </div>
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
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200/90 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-2xs hover:shadow-md hover:-translate-y-0.5">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.286L13 21l-2.286-6.857L5 12l5.714-2.286L13 3z"/></svg>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors flex items-center justify-center gap-1">
                    <span>Kondangan & Pesta</span>
                    <span class="text-xs text-[#BA805E] opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all">&rarr;</span>
                </h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Outer jatuh mewah dan voal berkilau</p>
                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-[#BA805E] pt-1">
                    <span>Lihat Gaya</span> &rarr;
                </span>
            </a>

            <!-- Momen 2 -->
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200/90 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-2xs hover:shadow-md hover:-translate-y-0.5">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-5.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/></svg>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors flex items-center justify-center gap-1">
                    <span>Wisuda & Sidang</span>
                    <span class="text-xs text-[#BA805E] opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all">&rarr;</span>
                </h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Siluet santun rapi berwibawa</p>
                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-[#BA805E] pt-1">
                    <span>Lihat Gaya</span> &rarr;
                </span>
            </a>

            <!-- Momen 3 -->
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200/90 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-2xs hover:shadow-md hover:-translate-y-0.5">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors flex items-center justify-center gap-1">
                    <span>Kajian & Silaturahmi</span>
                    <span class="text-xs text-[#BA805E] opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all">&rarr;</span>
                </h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Potongan longgar sejuk tanpa terawang</p>
                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-[#BA805E] pt-1">
                    <span>Lihat Gaya</span> &rarr;
                </span>
            </a>

            <!-- Momen 4 -->
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200/90 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-2xs hover:shadow-md hover:-translate-y-0.5">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8zM6 1v3M10 1v3M14 1v3"/></svg>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors flex items-center justify-center gap-1">
                    <span>Kuliah & Hangout</span>
                    <span class="text-xs text-[#BA805E] opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all">&rarr;</span>
                </h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Casual chic, santun dan mudah di-layering</p>
                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-[#BA805E] pt-1">
                    <span>Lihat Gaya</span> &rarr;
                </span>
            </a>
        </div>
    </section>

    <!-- G1: VIEWPORT-FITTED OPEN RUNWAY ("Try The Look" — Full Look Experience, Center Stage Tanpa Clutter Harga) -->
    <section id="try-the-look" class="w-full relative py-6 lg:py-8 bg-[#FAF9F6] border-y border-neutral-200/50 select-none scroll-mt-16 overflow-hidden">
        
        <!-- Header: Minimal Luxury Editorial Title (Compact, Centered) -->
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 text-center shrink-0 mb-2">
            <span class="text-[10px] uppercase tracking-[0.3em] font-bold text-[#BA805E] block">
                Virtual Styling Runway • Koleksi Lengkap
            </span>
            <h2 class="font-serif text-[clamp(1.6rem,3.5vw,2.5rem)] font-bold text-neutral-950 mt-0.5 tracking-tight">
                Try The Look.
            </h2>
            <p class="text-xs sm:text-sm text-neutral-500 font-light mt-0.5 max-w-xl mx-auto">
                Eksplorasi padu-padan atasan santun MOZÉRA. Klik atau geser model untuk melihat siluet busana secara utuh.
            </p>
        </div>

        <!-- FULL RUNWAY STAGE (Center Stage Runway, Zero Price Clutter, Fluid Scaling) -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex flex-col items-center justify-center my-auto">
            
            <!-- Models Runway Stage (Wide Center Runway, Fluid Responsive Height) -->
            <div class="relative w-full h-[320px] sm:h-[400px] md:h-[460px] lg:h-[520px] flex items-center justify-center pb-4 sm:pb-5 overflow-hidden" id="open-runway-stage">
                
                <!-- Couture Runway Architectural Arch Backdrop (Stage Depth) -->
                <div class="absolute inset-x-3 sm:inset-x-10 lg:inset-x-20 top-1.5 sm:top-2 bottom-3 sm:bottom-5 rounded-t-[120px] sm:rounded-t-[180px] lg:rounded-t-[230px] bg-gradient-to-b from-[#F2ECE3]/85 via-[#FAF7F2]/45 to-transparent border-t border-x border-[#E6DAC9]/70 shadow-[inset_0_4px_24px_rgba(230,218,201,0.35)] pointer-events-none -z-0"></div>

                <!-- Runway Spotlight Floor Glow -->
                <div class="absolute bottom-3 sm:bottom-4 w-[240px] sm:w-[420px] lg:w-[620px] h-10 sm:h-14 bg-gradient-to-r from-transparent via-[#E8DEC9]/75 to-transparent rounded-[100%] filter blur-md sm:blur-lg pointer-events-none -z-0"></div>

                @foreach($curatedLooks as $idx => $look)
                    <div 
                        id="runway-model-{{ $idx }}" 
                        onclick="onModelClick({{ $idx }})" 
                        class="runway-model-item absolute bottom-2 sm:bottom-3 flex flex-col items-center justify-end transition-all duration-500 ease-out cursor-pointer z-10 group"
                        style="will-change: transform, opacity;"
                    >
                        <!-- Floor Contact Shadow -->
                        <div class="model-floor-shadow absolute bottom-1 w-24 sm:w-36 lg:w-48 h-2.5 sm:h-3.5 bg-neutral-950/20 rounded-full filter blur-[3px] sm:blur-[3.5px] transition-all duration-500"></div>

                        <!-- Cutout Model Image: Model Responsif -->
                        <div class="relative h-[250px] sm:h-[330px] md:h-[390px] lg:h-[460px] flex items-end justify-center">
                            <img 
                                src="{{ $look['model_image'] }}" 
                                alt="{{ $look['title'] }} — Model Modest MOZÉRA" 
                                class="h-full w-auto max-w-none object-contain select-none pointer-events-none filter drop-shadow-md transition-all duration-500 group-hover:scale-[1.02]"
                                loading="eager"
                                style="image-rendering: auto; -webkit-backface-visibility: hidden; transform: translateZ(0);"
                            >
                        </div>

                        <!-- Micro Hint on Active Center Model (Klik untuk 3 Sudut Pandang) -->
                        @if($look['has_angles'])
                            <div class="active-angle-hint opacity-0 transition-opacity duration-300 absolute -top-1 pointer-events-none">
                                <span class="px-2.5 py-0.5 rounded-full bg-neutral-900/80 backdrop-blur-sm text-[9px] font-mono text-[#DCC3AD] uppercase tracking-wider flex items-center gap-1 shadow-md">
                                    <svg class="w-3 h-3 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span>Klik: 3 Sudut Pandang</span>
                                </span>
                            </div>
                        @endif

                        <!-- Hidden Form for bundle cart test -->
                        <form action="{{ route('shop.cart.add-bundle') }}" method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="sku_ids[]" value="{{ $look['hero_sku']?->id }}">
                            <input type="hidden" name="sku_ids[]" value="{{ $look['secondary_sku']?->id }}">
                            <input type="hidden" name="bundle_title" value="Set {{ $look['title'] }}">
                            <button type="submit" class="hidden">Beli 1 Look Lengkap</button>
                        </form>
                    </div>
                @endforeach

                <!-- Sleek Minimal Arrow Controls (Tampil Responsif di Mobile & Desktop) -->
                <button 
                    type="button" 
                    onclick="prevLook()" 
                    aria-label="Look Sebelumnya" 
                    class="flex absolute left-1 sm:left-3 xl:left-6 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 lg:w-11 lg:h-11 rounded-full bg-white/95 hover:bg-[#0a0a0a] hover:text-white text-neutral-800 shadow-md border border-[#E8DEC9] backdrop-blur-md items-center justify-center transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer z-30"
                >
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button 
                    type="button" 
                    onclick="nextLook()" 
                    aria-label="Look Berikutnya" 
                    class="flex absolute right-1 sm:right-3 xl:right-6 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 lg:w-11 lg:h-11 rounded-full bg-white/95 hover:bg-[#0a0a0a] hover:text-white text-neutral-800 shadow-md border border-[#E8DEC9] backdrop-blur-md items-center justify-center transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer z-30"
                >
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>

            </div>

        </div>

        <!-- DEDICATED ACTIVE LOOK HIGHLIGHT (Clean, Focused, Direct CTA) -->
        <div class="max-w-2xl mx-auto px-4 mt-2 pb-2 flex flex-wrap items-center justify-center gap-2.5 text-center z-20">
            <span id="runway-look-type" class="px-3 py-1 rounded-full text-[10px] font-mono uppercase tracking-wider font-bold bg-[#FAF8F5] text-[#A66747] border border-[#E4D7C5] shadow-2xs">
                {{ $curatedLooks[0]['type_label'] }}
            </span>
            <span id="runway-look-title" class="px-4 py-1.5 rounded-full bg-neutral-950/90 text-[#F5EFEB] border border-[#BA805E]/40 text-xs font-bold uppercase tracking-wider backdrop-blur-md shadow-md">
                {{ $curatedLooks[0]['title'] }}
            </span>
            <a id="runway-look-btn" href="{{ $curatedLooks[0]['product_url'] }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-neutral-900 bg-white hover:bg-neutral-950 hover:text-white px-5 py-1.5 rounded-full border border-[#DCC3AD] shadow-sm transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer">
                <span>Lihat Detail Busana</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

    </section>

    <!-- 3-ANGLE IMMERSIVE POPUP MODAL ("Pencet pop-up sedikit, sekeliling hilang, ada gambar hadap samping dan belakang") -->
    <div 
        id="look-angles-modal" 
        class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6 bg-neutral-950/85 backdrop-blur-md transition-opacity duration-300"
        role="dialog" 
        aria-modal="true"
        onclick="if(event.target === this) closeAnglesModal()"
    >
        <div 
            class="relative w-full max-w-4xl bg-[#FAF9F6] rounded-3xl border border-[#E8DEC9] shadow-2xl p-6 sm:p-8 flex flex-col items-center transition-all transform scale-95 opacity-0"
            id="look-angles-content"
        >
            <!-- Close Button -->
            <button 
                type="button" 
                onclick="closeAnglesModal()" 
                aria-label="Tutup Tampilan 3 Sudut" 
                class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-white/90 hover:bg-neutral-950 hover:text-white text-neutral-800 shadow-md flex items-center justify-center transition-colors cursor-pointer"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <!-- Minimal Focused Header: Only Name & Series Type -->
            <div class="text-center space-y-1 mb-6">
                <span id="angles-modal-badge" class="px-3 py-1 rounded-full text-[10px] font-mono uppercase tracking-widest font-bold bg-[#F5EFEB] text-[#BA805E] border border-[#EADCCE]">
                    Tipe B: Siluet Fringe
                </span>
                <h3 id="angles-modal-title" class="font-serif text-2xl sm:text-3xl font-bold text-neutral-950">
                    ISLA Sage Fringe Kimono
                </h3>
                <p class="text-xs text-neutral-500 font-light">360° Multi-Angle Fitting View</p>
            </div>

            <!-- 3-Angle Perspective Cards (Kiri: Hadap Samping, Tengah: Hadap Depan, Kanan: Hadap Belakang) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 w-full items-end justify-center">
                
                <!-- Angle 1: Hadap Samping (Side View) -->
                <div class="bg-gradient-to-b from-white/90 to-[#F2EAE0]/60 rounded-2xl border border-neutral-200/80 p-3 sm:p-4 flex flex-col items-center justify-end relative h-[280px] sm:h-[340px] md:h-[380px] shadow-xs group">
                    <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-white/90 text-[9px] font-mono uppercase tracking-wider font-bold text-neutral-700 border border-neutral-200 shadow-2xs z-10">
                        Tampak Samping
                    </span>
                    <img 
                        id="angles-modal-side" 
                        src="" 
                        alt="Tampak Samping" 
                        class="h-full w-auto max-w-full object-contain filter drop-shadow-md transition-transform duration-300 group-hover:scale-105"
                    >
                </div>

                <!-- Angle 2: Hadap Depan (Center Stage Front View - Highlighted) -->
                <div class="bg-gradient-to-b from-[#F5EFEB] to-[#EAE0D4] rounded-2xl sm:rounded-3xl border-2 border-[#BA805E]/40 p-3 sm:p-4 flex flex-col items-center justify-end relative h-[310px] sm:h-[380px] md:h-[420px] shadow-lg group md:-translate-y-2">
                    <span class="absolute top-3 left-3 px-3 py-0.5 rounded-full bg-neutral-950 text-white text-[9px] font-mono uppercase tracking-wider font-bold shadow-2xs z-10 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]"></span>
                        <span>Tampak Depan</span>
                    </span>
                    <img 
                        id="angles-modal-front" 
                        src="" 
                        alt="Tampak Depan" 
                        class="h-full w-auto max-w-full object-contain filter drop-shadow-lg transition-transform duration-300 group-hover:scale-105"
                    >
                </div>

                <!-- Angle 3: Hadap Belakang (Back View) -->
                <div class="bg-gradient-to-b from-white/90 to-[#F2EAE0]/60 rounded-2xl border border-neutral-200/80 p-3 sm:p-4 flex flex-col items-center justify-end relative h-[280px] sm:h-[340px] md:h-[380px] shadow-xs group">
                    <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-white/90 text-[9px] font-mono uppercase tracking-wider font-bold text-neutral-700 border border-neutral-200 shadow-2xs z-10">
                        Tampak Belakang
                    </span>
                    <img 
                        id="angles-modal-back" 
                        src="" 
                        alt="Tampak Belakang" 
                        class="h-full w-auto max-w-full object-contain filter drop-shadow-md transition-transform duration-300 group-hover:scale-105"
                    >
                </div>

            </div>

            <!-- Bottom Actions -->
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                <a 
                    id="angles-modal-link" 
                    href="#" 
                    class="min-h-[44px] px-8 py-2.5 rounded-full bg-neutral-950 hover:bg-[#BA805E] text-white text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-md flex items-center gap-2 cursor-pointer"
                >
                    <span>Lihat Detail & Beli Busana Ini</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <button 
                    type="button" 
                    onclick="closeAnglesModal()" 
                    class="min-h-[44px] px-6 py-2.5 rounded-full border border-neutral-300 hover:border-neutral-900 text-neutral-700 text-xs font-bold transition-colors cursor-pointer"
                >
                    Kembali ke Runway
    <!-- JAVASCRIPT: 0-LATENCY HARDWARE-ACCELERATED OPEN RUNWAY -->
    <script>
        (function() {
            const looks = @json($curatedLooks);
            let currentLookIdx = 0;

            window.onModelClick = function(idx) {
                if (idx === currentLookIdx) {
                    // Jika klik model yang sedang aktif di tengah, buka popup 3 sudut pandang
                    openAnglesModal(idx);
                } else {
                    // Jika klik model samping, geser model tersebut ke tengah
                    switchLook(idx);
                }
            };

            window.openAnglesModal = function(idx) {
                const look = looks[idx];
                if (!look) return;

                const modal = document.getElementById('look-angles-modal');
                const content = document.getElementById('look-angles-content');
                const badge = document.getElementById('angles-modal-badge');
                const title = document.getElementById('angles-modal-title');
                const frontImg = document.getElementById('angles-modal-front');
                const sideImg = document.getElementById('angles-modal-side');
                const backImg = document.getElementById('angles-modal-back');
                const link = document.getElementById('angles-modal-link');

                if (badge) badge.textContent = look.type_label;
                if (title) title.textContent = look.title;
                if (frontImg) frontImg.src = look.model_image;
                if (sideImg) sideImg.src = look.side_image || look.model_image;
                if (backImg) backImg.src = look.back_image || look.model_image;
                if (link) link.href = look.product_url;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 20);
            };

            window.closeAnglesModal = function() {
                const modal = document.getElementById('look-angles-modal');
                const content = document.getElementById('look-angles-content');
                if (!modal || !content) return;
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 200);
            };

            window.switchLook = function(idx) {
                if (idx < 0 || idx >= looks.length) return;
                currentLookIdx = idx;

                const screenW = window.innerWidth;
                const spacing = screenW >= 1024 ? 220 : (screenW >= 640 ? 150 : 105);

                // Circular Shortest Distance Wrap (True Seamless Infinite Loop - No Mental/Teleport)
                looks.forEach((look, i) => {
                    const item = document.getElementById(`runway-model-${i}`);
                    if (!item) return;

                    let diff = i - currentLookIdx;
                    while (diff > looks.length / 2) diff -= looks.length;
                    while (diff < -looks.length / 2) diff += looks.length;

                    const hint = item.querySelector('.active-angle-hint');
                    const shadow = item.querySelector('.model-floor-shadow');

                    if (diff === 0) {
                        // Center Active Model: Scale 1.05, 100% Opacity, Ground Shadow Active
                        item.style.transform = 'translate3d(0px, 0px, 0px) scale(1.05)';
                        item.style.opacity = '1';
                        item.style.zIndex = '30';
                        item.style.pointerEvents = 'auto';
                        if (hint) {
                            hint.style.opacity = '1';
                        }
                        if (shadow) {
                            shadow.style.opacity = '1';
                            shadow.style.transform = 'scale(1.1)';
                        }
                    } else if (Math.abs(diff) > 2) {
                        // Far models: hidden without jumping
                        item.style.transform = `translate3d(${diff * spacing}px, 0px, 0px) scale(0.6)`;
                        item.style.opacity = '0';
                        item.style.zIndex = '5';
                        item.style.pointerEvents = 'none';
                        if (hint) hint.style.opacity = '0';
                        if (shadow) shadow.style.opacity = '0';
                    } else {
                        // Flanking Models (Left or Right): Scale 0.82, Low Opacity, Behind
                        const posX = diff * spacing;
                        const scale = Math.max(0.70, 0.84 - Math.abs(diff) * 0.08);
                        const opacity = Math.abs(diff) === 1 ? '0.35' : '0.12';

                        item.style.transform = `translate3d(${posX}px, 0px, 0px) scale(${scale})`;
                        item.style.opacity = opacity;
                        item.style.zIndex = `${20 - Math.abs(diff)}`;
                        item.style.pointerEvents = 'auto';
                        if (hint) {
                            hint.style.opacity = '0';
                        }
                        if (shadow) {
                            shadow.style.opacity = '0.35';
                            shadow.style.transform = 'scale(0.85)';
                        }
                    }
                });

                // 3. Update Dedicated Active Look Badge & Link
                const activeLook = looks[currentLookIdx];
                const typeEl = document.getElementById('runway-look-type');
                const titleEl = document.getElementById('runway-look-title');
                const btnEl = document.getElementById('runway-look-btn');
                if (typeEl && activeLook) typeEl.textContent = activeLook.type_label;
                if (titleEl && activeLook) titleEl.textContent = activeLook.title;
                if (btnEl && activeLook) btnEl.href = activeLook.product_url;
            };

            window.nextLook = function() {
                switchLook((currentLookIdx + 1) % looks.length);
            };

            window.prevLook = function() {
                switchLook((currentLookIdx - 1 + looks.length) % looks.length);
            };

            // Touch Swipe Support for Mobile
            let touchStartX = 0;
            let touchEndX = 0;
            const stage = document.getElementById('open-runway-stage');
            if (stage) {
                stage.addEventListener('touchstart', e => {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });
                stage.addEventListener('touchend', e => {
                    touchEndX = e.changedTouches[0].screenX;
                    const diff = touchStartX - touchEndX;
                    if (Math.abs(diff) > 45) {
                        if (diff > 0) nextLook();
                        else prevLook();
                    }
                }, { passive: true });
            }

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') closeAnglesModal();
                if (e.key === 'ArrowRight') nextLook();
                if (e.key === 'ArrowLeft') prevLook();
            });

            window.addEventListener('resize', () => switchLook(currentLookIdx));
            document.addEventListener('DOMContentLoaded', () => switchLook(0));
            switchLook(0);
        })();
    </script>

    <!-- G2: INNOVATIVE ATELIER PROPORTION & FIT CONCIERGE -->
    <section id="fit-helper" class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="bg-gradient-to-b from-white to-[#FAF8F5] rounded-2xl sm:rounded-3xl border border-[#E8DEC9] p-4 sm:p-7 lg:p-9 shadow-sm relative overflow-hidden">
            
            <!-- Atelier Top Badge & Title -->
            <div class="max-w-2xl mx-auto text-center space-y-1.5 mb-4 sm:mb-6">
                <span class="inline-flex items-center gap-1.5 px-3 py-0.5 sm:px-3.5 sm:py-1 rounded-full text-[9px] sm:text-[10px] uppercase font-bold tracking-[0.25em] bg-[#F5EFEB] text-[#BA805E] border border-[#EADCCE]">
                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Atelier Proportion & Fit Simulator
                </span>
                <h3 class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-neutral-950">
                    Simulasi Panjang Outer Sesuai Siluet Tinggimu
                </h3>
                <p class="text-[11px] sm:text-xs lg:text-sm text-neutral-600 max-w-xl mx-auto leading-relaxed">
                    Geser penggaris tinggi badan Anda di bawah ini untuk melihat simulasi visual di mana ujung busana outer MOZÉRA akan jatuh di tubuh Anda.
                </p>
            </div>

            <!-- Two-Column Interactive Fit Studio -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 lg:gap-8 items-center max-w-5xl mx-auto">
                
                <!-- Left Column (Visual Silhouette & Interactive Hemline Drop Avatar) -->
                <div class="lg:col-span-5 bg-white rounded-2xl sm:rounded-3xl border border-[#EADCCE] p-3.5 sm:p-5 shadow-xs flex flex-col items-center justify-between relative overflow-hidden">
                    
                    <!-- Top Status Tag -->
                    <div class="w-full flex items-center justify-between text-[10px] sm:text-[11px] font-mono pb-2 sm:pb-3 border-b border-neutral-100">
                        <span class="text-neutral-500 font-bold uppercase tracking-wider">Visual Avatar</span>
                        <span id="fit-avatar-silhouette-badge" class="px-2 py-0.5 rounded-full bg-[#FAF8F5] text-[#A66747] font-bold border border-[#EADCCE] text-[9px] sm:text-[10px]">
                            Proportional Chic
                        </span>
                    </div>

                    <!-- Silhouette Graphic with Dynamic Sliding Hemline -->
                    <div class="relative w-full h-[180px] sm:h-[220px] lg:h-[260px] flex items-center justify-center my-1 sm:my-2">
                        
                        <!-- Anatomy Height Markers (Background Scale Lines) -->
                        <div class="absolute inset-y-0 right-1 sm:right-2 w-20 sm:w-24 flex flex-col justify-between text-[8px] sm:text-[9px] font-mono text-neutral-400 border-l border-dashed border-neutral-200 pl-1.5 sm:pl-2 pointer-events-none select-none">
                            <span>Bahu (0 cm)</span>
                            <span>Pinggang (40 cm)</span>
                            <span>Lutut (90 cm)</span>
                            <span>Betis (110 cm)</span>
                            <span>Mata Kaki (130 cm)</span>
                        </div>

                        <!-- Stylized Modest Silhouette SVG Figure -->
                        <svg class="h-full w-auto text-[#DCC3AD] transition-all duration-300" viewBox="0 0 100 240" fill="none" stroke="currentColor">
                            <!-- Head & Hijab -->
                            <path d="M50 15 C42 15 36 22 36 32 C36 44 42 50 50 50 C58 50 64 44 64 32 C64 22 58 15 50 15 Z" fill="#E8DEC9" stroke="#BA805E" stroke-width="1.5"/>
                            <!-- Hijab Chest Drape -->
                            <path d="M40 45 C40 60 50 70 50 70 C50 70 60 60 60 45" stroke="#BA805E" stroke-width="1.5" stroke-linecap="round"/>
                            <!-- Outerwear Body Silhouette -->
                            <path d="M35 52 L22 88 L32 90 L36 175 L64 175 L68 90 L78 88 L65 52 Z" fill="#F5EFEB" stroke="#8A4F35" stroke-width="1.8" stroke-linejoin="round"/>
                            <!-- Inner / Lower Dress -->
                            <path d="M38 175 L37 215 L46 215 L48 185 L52 185 L54 215 L63 215 L62 175" fill="#262626" stroke="#171717" stroke-width="1.5"/>
                            <!-- Shoes / Heels -->
                            <path d="M35 215 L47 215 L45 224 L37 224 Z" fill="#BA805E"/>
                            <path d="M53 215 L65 215 L63 224 L55 224 Z" fill="#BA805E"/>
                        </svg>

                        <!-- Dynamic Animated Hemline Indicator (Moves up and down based on slider using %) -->
                        <div 
                            id="fit-hemline-bar" 
                            class="absolute left-2 sm:left-4 right-16 sm:right-20 border-t-2 border-dashed border-[#A66747] transition-all duration-300 flex items-center justify-between"
                            style="top: 67%;"
                        >
                            <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-[#A66747] -ml-1 sm:-ml-1.5 shadow-xs ring-4 ring-[#A66747]/20"></span>
                            <span class="text-[8px] sm:text-[9px] font-bold font-mono uppercase tracking-wider bg-[#0a0a0a] text-white px-1.5 py-0.5 rounded shadow-sm">
                                Ujung Outer
                            </span>
                        </div>
                    </div>

                    <!-- Live Hemline Status Banner -->
                    <div class="w-full bg-[#FAF8F5] rounded-xl p-2 sm:p-2.5 border border-[#EADCCE] text-center">
                        <p class="text-[10px] sm:text-[11px] font-bold text-neutral-800" id="fit-hemline-label">
                            Jatuh di Pertengahan Betis (Midi Santun & Leluasa)
                        </p>
                    </div>
                </div>

                <!-- Right Column (Interactive Slider, Height Preset Chips, & Intelligent Modest Insights) -->
                <div class="lg:col-span-7 space-y-3.5 sm:space-y-5">
                    
                    <!-- Height Meter Display & Slider Controls -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl border border-[#EADCCE] p-3.5 sm:p-5 shadow-xs space-y-3">
                        <div class="flex items-end justify-between">
                            <div>
                                <span class="text-[9px] sm:text-[10px] uppercase font-bold tracking-wider text-neutral-400 block">Pilih Tinggi Badan Anda</span>
                                <div class="flex items-baseline gap-1 mt-0.5">
                                    <span class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-neutral-950 font-mono" id="fit-height-number">158</span>
                                    <span class="text-sm sm:text-base font-bold text-[#BA805E] font-serif">cm</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-[9px] sm:text-[10px] text-neutral-400 block uppercase tracking-wider">Rekomendasi Panjang:</span>
                                <span class="font-serif text-lg sm:text-2xl font-bold text-[#BA805E]" id="fit-result-length">110 cm</span>
                            </div>
                        </div>

                        <!-- Draggable Smooth Range Slider -->
                        <div class="space-y-1.5 pt-0.5">
                            <input 
                                type="range" 
                                id="fit-range-slider" 
                                min="148" 
                                max="175" 
                                value="158" 
                                oninput="onFitSliderChange(this.value)" 
                                class="w-full h-2 sm:h-2.5 bg-[#E8DEC9] rounded-lg appearance-none cursor-pointer accent-[#BA805E]"
                            >
                            <div class="flex justify-between text-[9px] sm:text-[10px] font-mono text-neutral-400 px-1">
                                <span>148 cm</span>
                                <span>155 cm</span>
                                <span>162 cm</span>
                                <span>170 cm</span>
                                <span>175 cm</span>
                            </div>
                        </div>

                        <!-- Quick Height Presets (Quick Chips for Convenience) -->
                        <div class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto pt-1 pb-0.5 text-[11px] sm:text-xs custom-scrollbar" id="fit-buttons">
                            <button type="button" onclick="setFitSlider(152)" class="fit-btn px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg sm:rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-700 whitespace-nowrap cursor-pointer">
                                150–155 cm
                            </button>
                            <button type="button" onclick="setFitSlider(158)" class="fit-btn px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg sm:rounded-xl border border-neutral-900 bg-neutral-900 text-white font-bold transition-all whitespace-nowrap cursor-pointer">
                                156–160 cm
                            </button>
                            <button type="button" onclick="setFitSlider(163)" class="fit-btn px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg sm:rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-700 whitespace-nowrap cursor-pointer">
                                161–165 cm
                            </button>
                            <button type="button" onclick="setFitSlider(168)" class="fit-btn px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg sm:rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-700 whitespace-nowrap cursor-pointer">
                                166+ cm
                            </button>
                        </div>
                    </div>

                    <!-- 3 Modest Proportion Intelligence Insights: 3 Kolom Kompak di Mobile & Desktop -->
                    <div class="grid grid-cols-3 gap-2 sm:gap-3">
                        <!-- Insight 1: Hemline Safety -->
                        <div class="bg-white p-2.5 sm:p-3.5 rounded-xl sm:rounded-2xl border border-neutral-200/80 shadow-2xs space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1 text-[#BA805E]">
                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zM9 3v18m-4-14h4m-4 5h4m-4 5h4"/></svg>
                                <span class="text-[8px] sm:text-[10px] font-bold uppercase tracking-wider truncate">Jatuh Baju</span>
                            </div>
                            <p class="text-[11px] sm:text-xs font-bold text-neutral-900 truncate" id="fit-insight-hemline">Midi Santun</p>
                            <p class="text-[9px] sm:text-[10px] text-neutral-500 leading-snug line-clamp-2" id="fit-result-desc">
                                Panjang midi di pertengahan betis.
                            </p>
                        </div>

                        <!-- Insight 2: Scarf Proportion -->
                        <div class="bg-white p-2.5 sm:p-3.5 rounded-xl sm:rounded-2xl border border-neutral-200/80 shadow-2xs space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1 text-[#BA805E]">
                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                                <span class="text-[8px] sm:text-[10px] font-bold uppercase tracking-wider truncate">Padanan Hijab</span>
                            </div>
                            <p class="text-[11px] sm:text-xs font-bold text-neutral-900 truncate" id="fit-insight-hijab">Voal 120x120</p>
                            <p class="text-[9px] sm:text-[10px] text-neutral-500 leading-snug line-clamp-2">Menutup dada proporsional & ramping.</p>
                        </div>

                        <!-- Insight 3: Footwear Guidance -->
                        <div class="bg-white p-2.5 sm:p-3.5 rounded-xl sm:rounded-2xl border border-neutral-200/80 shadow-2xs space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1 text-[#BA805E]">
                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                <span class="text-[8px] sm:text-[10px] font-bold uppercase tracking-wider truncate">Alas Kaki</span>
                            </div>
                            <p class="text-[11px] sm:text-xs font-bold text-neutral-900 truncate" id="fit-insight-shoes">Mules / Heels</p>
                            <p class="text-[9px] sm:text-[10px] text-neutral-500 leading-snug line-clamp-2" id="fit-shoes-desc">Proporsi jatuh semakin semampai.</p>
                        </div>
                    </div>

                    <!-- Action Direct to Catalog -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-2.5 pt-0.5">
                        <div class="flex items-center gap-1.5 text-[11px] sm:text-xs text-neutral-600">
                            <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-emerald-500 shrink-0"></span>
                            <span>Outer MOZÉRA <strong>wudhu-friendly</strong> & tidak menyapu lantai.</span>
                        </div>
                        <a 
                            id="fit-cta-btn" 
                            href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" 
                            class="w-full sm:w-auto min-h-[40px] sm:min-h-[44px] px-5 sm:px-6 py-2 rounded-full bg-neutral-950 hover:bg-[#BA805E] text-white text-[11px] sm:text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-sm flex items-center justify-center gap-2 shrink-0 cursor-pointer"
                        >
                            <span id="fit-cta-text">Lihat Outer Pas Untuk Tinggimu (158 cm)</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>

                </div>

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
                <div class="group bg-white rounded-2xl sm:rounded-3xl overflow-hidden border border-[#EAE0D4] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
                    
                    <div>
                        <!-- Product Image (Compact, Balanced Height - No Vertical Stretching) -->
                        <div class="relative h-[200px] sm:h-[230px] bg-[#FAF9F6] overflow-hidden flex items-center justify-center p-2.5 sm:p-3 block">
                            <a href="{{ route('shop.product', $product->slug) }}" class="block w-full h-full flex items-center justify-center">
                                <img 
                                    src="{{ $product->primary_image }}" 
                                    alt="{{ $product->name }} — Modest Fashion" 
                                    loading="lazy" 
                                    class="h-full w-auto max-w-full object-contain filter drop-shadow-sm group-hover:scale-[1.04] transition-transform duration-500 block"
                                >
                            </a>

                            <!-- Badges (Never overlap: Preorder on top-left, Category on top-right) -->
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

    <!-- SECTION H: KOMUNITAS #everydaymozera (Authentic Buyer Stories & Styling Spotlight) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-b from-[#F5EFEB]/70 to-[#FAF8F5] rounded-3xl border border-neutral-200/80 p-6 sm:p-10 text-center space-y-6 shadow-xs">
            <div class="space-y-2 max-w-xl mx-auto">
                <span class="inline-block text-[11px] font-bold uppercase tracking-[0.25em] text-[#BA805E]">Cerita Nyata Pelanggan</span>
                <h2 class="font-serif text-[clamp(1.5rem,3.5vw,2.25rem)] font-bold text-neutral-950">#everydaymozera</h2>
                <p class="text-neutral-600 text-xs sm:text-sm leading-relaxed font-light">
                    Cerita wanita Indonesia merayakan kenyamanan dan keanggunan busana modest sehari-hari.
                </p>
            </div>

            <!-- 4 Authentic Customer Review & Styling Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 pt-2 text-left">
                <!-- Story 1 -->
                <div class="bg-white rounded-2xl p-5 border border-neutral-200/80 shadow-xs flex flex-col justify-between space-y-4 hover:border-[#BA805E] transition-all">
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <div class="flex text-amber-500 text-xs gap-0.5">
                                &#9733;&#9733;&#9733;&#9733;&#9733;
                            </div>
                            <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200/60">
                                &check; Pembeli Terverifikasi
                            </span>
                        </div>
                        <p class="text-xs text-neutral-700 leading-relaxed font-light italic">
                            &ldquo;Bahan rayon twill-nya sejuk seharian di ruang kuliah. Potongan kimononya jatuh santun menutup pinggul dan wudhu friendly tanpa repot.&rdquo;
                        </p>
                    </div>
                    <div class="pt-3 border-t border-neutral-100 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-neutral-900">Nadia Saraswati</p>
                            <p class="text-[10px] text-neutral-500">Dosen &bull; Surabaya</p>
                        </div>
                        <span class="text-[9px] font-medium text-[#BA805E] bg-[#BA805E]/10 px-2 py-0.5 rounded-md">
                            PUSPA Terracotta
                        </span>
                    </div>
                </div>

                <!-- Story 2 -->
                <div class="bg-white rounded-2xl p-5 border border-neutral-200/80 shadow-xs flex flex-col justify-between space-y-4 hover:border-[#BA805E] transition-all">
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <div class="flex text-amber-500 text-xs gap-0.5">
                                &#9733;&#9733;&#9733;&#9733;&#9733;
                            </div>
                            <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200/60">
                                &check; Pembeli Terverifikasi
                            </span>
                        </div>
                        <p class="text-xs text-neutral-700 leading-relaxed font-light italic">
                            &ldquo;Motif parang heritage-nya berwibawa tapi siluetnya modern santai. Pas banget untuk agenda formal klinik maupun silaturahmi keluarga.&rdquo;
                        </p>
                    </div>
                    <div class="pt-3 border-t border-neutral-100 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-neutral-900">dr. Farida Rahma</p>
                            <p class="text-[10px] text-neutral-500">Praktisi &bull; Jakarta</p>
                        </div>
                        <span class="text-[9px] font-medium text-[#BA805E] bg-[#BA805E]/10 px-2 py-0.5 rounded-md">
                            Sept Drops Trench
                        </span>
                    </div>
                </div>

                <!-- Story 3 -->
                <div class="bg-white rounded-2xl p-5 border border-neutral-200/80 shadow-xs flex flex-col justify-between space-y-4 hover:border-[#BA805E] transition-all">
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <div class="flex text-amber-500 text-xs gap-0.5">
                                &#9733;&#9733;&#9733;&#9733;&#9733;
                            </div>
                            <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200/60">
                                &check; Pembeli Terverifikasi
                            </span>
                        </div>
                        <p class="text-xs text-neutral-700 leading-relaxed font-light italic">
                            &ldquo;Dipakai wisuda lalu lanjut makan siang keluarga tetap rapi dan gak gerah sama sekali. Warna sage green-nya kalem dan flattering di kulit.&rdquo;
                        </p>
                    </div>
                    <div class="pt-3 border-t border-neutral-100 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-neutral-900">Alya Ramadhani</p>
                            <p class="text-[10px] text-neutral-500">Alumni ITB &bull; Bandung</p>
                        </div>
                        <span class="text-[9px] font-medium text-[#BA805E] bg-[#BA805E]/10 px-2 py-0.5 rounded-md">
                            ISLA Kimono Sage
                        </span>
                    </div>
                </div>

                <!-- Story 4 -->
                <div class="bg-white rounded-2xl p-5 border border-neutral-200/80 shadow-xs flex flex-col justify-between space-y-4 hover:border-[#BA805E] transition-all">
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <div class="flex text-amber-500 text-xs gap-0.5">
                                &#9733;&#9733;&#9733;&#9733;&#9733;
                            </div>
                            <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200/60">
                                &check; Pembeli Terverifikasi
                            </span>
                        </div>
                        <p class="text-xs text-neutral-700 leading-relaxed font-light italic">
                            &ldquo;Warna indigo navy-nya sangat mewah. Scarf ultrafine voal-nya gampang dibentuk dan tegak di dahi tanpa perlu jarum pentul banyak.&rdquo;
                        </p>
                    </div>
                    <div class="pt-3 border-t border-neutral-100 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-neutral-900">Zahra Maharani</p>
                            <p class="text-[10px] text-neutral-500">Creative Lead &bull; Jogja</p>
                        </div>
                        <span class="text-[9px] font-medium text-[#BA805E] bg-[#BA805E]/10 px-2 py-0.5 rounded-md">
                            PUSPA Navy Scarf
                        </span>
                    </div>
                </div>
            </div>

            <!-- Social Tagging Reassurance Note & Catalog Button -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-neutral-200/60 text-xs text-neutral-500">
                <p class="font-light">
                    Bagikan OOTD santun Anda dengan tagar <strong>#everydaymozera</strong> dan tag <strong>@mozera.id</strong> di Instagram untuk tampil di lookbook kami.
                </p>
                <a href="{{ route('shop.catalog') }}" class="min-h-[44px] shrink-0 inline-flex items-center justify-center px-7 py-2.5 rounded-full bg-neutral-950 hover:bg-[#BA805E] text-white text-xs font-bold uppercase tracking-wider transition-colors shadow-sm">
                    Mulai Belanja Koleksi Kami
                </a>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
(function() {
    // Dynamic Fit Intelligence Data by Height Range
    function getFitProfile(height) {
        height = parseInt(height);
        if (height <= 154) {
            return {
                length: 105,
                hemlinePercent: 76, // Lower calf/maxi proportion on avatar
                silhouette: 'Petite Modest',
                hemlineLabel: 'Jatuh 15 cm di Atas Mata Kaki (Maxi Santun, Anggun & Bebas Tersangkut)',
                insightHemline: 'Maxi Semampai',
                desc: 'Jatuh pas 15 cm di atas mata kaki, memberi siluet semampai tanpa perlu dipotong.',
                hijab: 'Voal 120x120 Segitiga',
                shoes: 'Flats / Heels 3–5 cm',
                shoesDesc: 'Beri siluet kaki lebih jenjang dan anggun saat melangkah.',
                presetIdx: 0
            };
        } else if (height <= 160) {
            return {
                length: 110,
                hemlinePercent: 67, // Mid-calf
                silhouette: 'Proportional Chic',
                hemlineLabel: 'Jatuh di Pertengahan Betis (Midi Ideal, Langkah Leluasa & Wudhu-Friendly)',
                insightHemline: 'Midi Santun',
                desc: 'Panjang midi ideal di pertengahan betis, sangat leluasa saat berjalan aktif.',
                hijab: 'Voal 120x120 Dada',
                shoes: 'Mules / Kitten Heels',
                shoesDesc: 'Proporsi jatuh baju sangat seimbang dan proporsional.',
                presetIdx: 1
            };
        } else if (height <= 165) {
            return {
                length: 115,
                hemlinePercent: 58, // Below knee
                silhouette: 'Semampai Couture',
                hemlineLabel: 'Jatuh 10 cm di Bawah Lutut (Siluet Jenjang & Layering Modern)',
                insightHemline: 'Midi Semampai',
                desc: 'Jatuh proporsional 10 cm di bawah lutut, siluet semampai dan rapi berwibawa.',
                hijab: 'Voal Drape Menutup',
                shoes: 'Pointed Flats / Loafers',
                shoesDesc: 'Tampilan rapi dan berkelas untuk acara semi-formal.',
                presetIdx: 2
            };
        } else {
            return {
                length: 120,
                hemlinePercent: 50, // Knee / Just below
                silhouette: 'Tall Effortless',
                hemlineLabel: 'Jatuh Tepat di Bawah Lutut (Casual Layering Chic, Sangat Ringan)',
                insightHemline: 'Knee Midi Chic',
                desc: 'Tampilan layering elegan, jatuh tepat di bawah lutut, cocok dipadu celana kulot.',
                hijab: 'Voal Square Santun',
                shoes: 'Mules / Sneakers Minimalis',
                shoesDesc: 'Sangat santai dan nyaman untuk mobilitas tinggi.',
                presetIdx: 3
            };
        }
    }

    window.onFitSliderChange = function(heightVal) {
        const profile = getFitProfile(heightVal);
        
        // Update number readout
        const numEl = document.getElementById('fit-height-number');
        if (numEl) numEl.textContent = heightVal;

        // Update recommendation values
        const lenEl = document.getElementById('fit-result-length');
        if (lenEl) lenEl.textContent = profile.length + ' cm';

        const descEl = document.getElementById('fit-result-desc');
        if (descEl) descEl.textContent = profile.desc;

        const badgeEl = document.getElementById('fit-avatar-silhouette-badge');
        if (badgeEl) badgeEl.textContent = profile.silhouette;

        const hemlineLabelEl = document.getElementById('fit-hemline-label');
        if (hemlineLabelEl) hemlineLabelEl.textContent = profile.hemlineLabel;

        const insightHemline = document.getElementById('fit-insight-hemline');
        if (insightHemline) insightHemline.textContent = profile.insightHemline;

        const insightHijab = document.getElementById('fit-insight-hijab');
        if (insightHijab) insightHijab.textContent = profile.hijab;

        const insightShoes = document.getElementById('fit-insight-shoes');
        if (insightShoes) insightShoes.textContent = profile.shoes;

        const shoesDesc = document.getElementById('fit-shoes-desc');
        if (shoesDesc) shoesDesc.textContent = profile.shoesDesc;

        // Animate the visual Hemline Bar on the avatar (Fluid Percent)
        const hemlineBar = document.getElementById('fit-hemline-bar');
        if (hemlineBar) {
            hemlineBar.style.top = profile.hemlinePercent + '%';
        }

        // Update CTA text
        const ctaText = document.getElementById('fit-cta-text');
        if (ctaText) ctaText.textContent = `Lihat Outer Pas Untuk Tinggimu (${heightVal} cm)`;

        // Highlight active preset chip
        const buttons = document.querySelectorAll('#fit-buttons .fit-btn');
        buttons.forEach((b, idx) => {
            if (idx === profile.presetIdx) {
                b.className = 'fit-btn px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg sm:rounded-xl border border-neutral-900 bg-neutral-900 text-white font-bold transition-all whitespace-nowrap cursor-pointer';
            } else {
                b.className = 'fit-btn px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg sm:rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-700 whitespace-nowrap cursor-pointer';
            }
        });
    };

    window.setFitSlider = function(heightVal) {
        const slider = document.getElementById('fit-range-slider');
        if (slider) {
            slider.value = heightVal;
        }
        window.onFitSliderChange(heightVal);
    };

    // Backward-compatible fallback for existing calls
    window.setFitHeight = function(btn, length, desc) {
        let heightApprox = 158;
        if (length <= 105) heightApprox = 152;
        else if (length <= 110) heightApprox = 158;
        else if (length <= 115) heightApprox = 163;
        else heightApprox = 168;

        window.setFitSlider(heightApprox);
    };

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        window.onFitSliderChange(158);
    });
})();
</script>
@endpush
@endsection
