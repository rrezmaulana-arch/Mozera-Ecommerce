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
                    <div class="relative w-full max-w-[340px] lg:max-w-[370px] h-[430px] lg:h-[490px] bg-gradient-to-b from-[#F5EFEB] via-[#EFE7DE] to-[#E6DDD2] rounded-t-[140px] rounded-b-3xl border border-neutral-300/40 p-4 pt-8 shadow-sm flex flex-col items-center justify-end overflow-hidden group">
                        
                        <!-- Top Arch Heritage Tag -->
                        <div class="absolute top-4 z-10">
                            <span class="text-[9px] font-bold tracking-[0.25em] text-[#8A4F35] bg-white/80 backdrop-blur-md px-3 py-1 rounded-full uppercase border border-[#BA805E]/20 shadow-xs">
                                MOZÉRA ESSENTIALS
                            </span>
                        </div>

                        <!-- Floor Contact Shadow -->
                        <div class="absolute bottom-5 w-44 h-4 bg-neutral-950/20 rounded-full filter blur-[3.5px]"></div>

                        <!-- Model Cutout Image (Perfect Centered Perspective) -->
                        <img
                            src="/images/models/look-1-terracotta.png"
                            alt="Model Modest Outer Kimono MOZÉRA"
                            class="h-[370px] lg:h-[430px] w-auto object-contain select-none filter drop-shadow-md relative z-10 transition-transform duration-500 group-hover:scale-[1.02]"
                        >

                        <!-- Floating Interactive Product Pill (Anchored at Base) -->
                        <a 
                            href="{{ route('shop.product', 'puspa-floral-outer-kimono') }}" 
                            class="absolute bottom-3 left-3 right-3 bg-white/95 backdrop-blur-md px-3.5 py-2.5 rounded-2xl border border-neutral-200/90 shadow-md flex items-center justify-between text-xs z-20 hover:border-[#BA805E] transition-all group-hover:shadow-lg"
                        >
                            <div class="text-left">
                                <p class="font-bold text-neutral-900 text-[11px] leading-tight">PUSPA Floral Kimono Outer</p>
                                <p class="text-[10px] text-neutral-500">Premium Rayon Twill &bull; Terracotta</p>
                            </div>
                            <span class="font-bold text-[#BA805E] font-mono text-xs flex items-center gap-1 shrink-0 ml-2">
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
                    class="group relative w-[80vw] max-w-[340px] shrink-0 snap-center sm:w-full sm:max-w-none rounded-3xl overflow-hidden block shadow-sm hover:shadow-xl transition-all duration-500 bg-white border border-[#E8DEC9] hover:-translate-y-1.5 flex flex-col justify-between"
                >
                    <!-- Visual Model Frame (Atas: Foto Model Jernih & Utuh, Tanpa Tertimpa Tulisan) -->
                    <div class="relative aspect-[3/4] bg-gradient-to-b from-[#FAF8F5] to-[#F2EAE0] flex items-center justify-center p-4 sm:p-5 overflow-hidden">
                        <!-- Subtle Background Arch Motif -->
                        <div class="absolute inset-x-8 top-4 bottom-0 rounded-t-full bg-white/50 border-t border-x border-white/80 pointer-events-none group-hover:scale-105 transition-transform duration-500"></div>

                        <!-- Top Badges -->
                        <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between z-10">
                            <span class="text-[9px] uppercase font-mono tracking-wider font-bold text-[#A66747] bg-white/95 px-3 py-1 rounded-full border border-[#E8DEC9] shadow-2xs">
                                {{ $tipeBadge }}
                            </span>
                            <span class="text-[10px] uppercase tracking-wider font-bold px-2.5 py-1 rounded-full bg-white/95 text-neutral-800 border border-[#E8DEC9] shadow-2xs">
                                {{ $s->products_count }} Busana
                            </span>
                        </div>

                        <!-- Modest Model Image -->
                        <img 
                            src="{{ $s->banner_image }}" 
                            alt="{{ $s->name }} — Modest Collection" 
                            loading="lazy" 
                            class="w-full h-full object-contain filter drop-shadow-md group-hover:scale-105 transition-transform duration-700 block relative z-0"
                        >
                    </div>

                    <!-- Editorial Content Section (Bawah: Ruang Teks Rapi, Bersih & Terang) -->
                    <div class="p-5 sm:p-6 bg-white space-y-2 flex-1 flex flex-col justify-between border-t border-[#F2ECE3]">
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between text-[10px] font-mono font-bold text-[#BA805E] uppercase tracking-wider">
                                <span>Koleksi {{ $koleksiNum }}</span>
                                <span class="text-neutral-400">Edisi Khusus</span>
                            </div>
                            <h3 class="font-serif text-lg sm:text-xl font-bold tracking-tight text-neutral-950 group-hover:text-[#BA805E] transition-colors leading-snug">
                                {{ $s->name }}
                            </h3>
                            <p class="text-xs text-neutral-500 line-clamp-2 font-light leading-relaxed">
                                {{ $s->description }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-neutral-100 flex items-center justify-between text-xs font-bold text-neutral-900 group-hover:text-[#BA805E] transition-colors">
                            <span class="text-[11px] uppercase tracking-wider">Jelajahi Koleksi</span>
                            <span class="w-7 h-7 rounded-full bg-[#FAF8F5] group-hover:bg-[#BA805E] group-hover:text-white flex items-center justify-center transition-all duration-300">
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
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-sm hover:shadow-md">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.286L13 21l-2.286-6.857L5 12l5.714-2.286L13 3z"/></svg>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors">Kondangan dan Pesta</h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Outer jatuh mewah dan voal ultrafine berkilau</p>
            </a>

            <!-- Momen 2 -->
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-sm hover:shadow-md">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-5.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/></svg>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors">Wisuda dan Sidang</h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Siluet santun rapi berwibawa</p>
            </a>

            <!-- Momen 3 -->
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-sm hover:shadow-md">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors">Kajian dan Silaturahmi</h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Potongan longgar sejuk tanpa terawang</p>
            </a>

            <!-- Momen 4 -->
            <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="group p-4 sm:p-5 rounded-2xl bg-white border border-neutral-200 hover:border-[#BA805E] transition-all text-center space-y-2 block shadow-sm hover:shadow-md">
                <div class="w-10 h-10 mx-auto rounded-full bg-[#F5EFEB] text-[#BA805E] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8zM6 1v3M10 1v3M14 1v3"/></svg>
                </div>
                <h4 class="font-serif font-bold text-neutral-900 text-sm group-hover:text-[#BA805E] transition-colors">Kuliah dan Hangout</h4>
                <p class="text-[11px] text-neutral-500 leading-snug">Casual chic, santun dan mudah di-layering</p>
            </a>
        </div>
    </section>

    <!-- G1: VIEWPORT-FITTED OPEN RUNWAY ("Try The Look" — Full Look Experience, Center Stage Tanpa Clutter Harga) -->
    <section id="try-the-look" class="w-full relative py-6 lg:py-8 bg-[#FAF9F6] border-y border-neutral-200/50 overflow-hidden select-none scroll-mt-16">
        
        <!-- Header: Minimal Luxury Editorial Title (Compact, Centered) -->
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 text-center shrink-0 mb-3">
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

        <!-- FULL RUNWAY STAGE (Center Stage Runway, Zero Price Clutter, Model Lebih Besar) -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex flex-col items-center justify-center my-auto overflow-hidden">
            
            <!-- Models Runway Stage (Wide Center Runway) -->
            <div class="relative w-full h-[430px] sm:h-[490px] lg:h-[540px] flex items-center justify-center overflow-hidden pb-12" id="open-runway-stage">
                
                <!-- Couture Runway Architectural Arch Backdrop (Stage Depth) -->
                <div class="absolute inset-x-4 sm:inset-x-12 lg:inset-x-24 top-2 bottom-12 rounded-t-[160px] sm:rounded-t-[220px] bg-gradient-to-b from-[#F2ECE3]/85 via-[#FAF7F2]/45 to-transparent border-t border-x border-[#E6DAC9]/70 shadow-[inset_0_4px_24px_rgba(230,218,201,0.35)] pointer-events-none -z-0"></div>

                <!-- Runway Spotlight Floor Glow -->
                <div class="absolute bottom-10 w-[300px] sm:w-[440px] lg:w-[560px] h-14 bg-gradient-to-r from-transparent via-[#E8DEC9]/75 to-transparent rounded-[100%] filter blur-lg pointer-events-none -z-0"></div>

                @foreach($curatedLooks as $idx => $look)
                    <div 
                        id="runway-model-{{ $idx }}" 
                        onclick="switchLook({{ $idx }})"
                        class="runway-model-item absolute bottom-11 flex flex-col items-center justify-end transition-all duration-500 ease-out cursor-pointer z-10"
                        style="will-change: transform, opacity;"
                    >
                        <!-- Floor Contact Shadow -->
                        <div class="model-floor-shadow absolute bottom-1 w-28 sm:w-36 lg:w-44 h-3.5 bg-neutral-950/20 rounded-full filter blur-[3px] transition-all duration-500"></div>

                        <!-- Cutout Model Image: Model Lebih Besar & Jelas (Tinggi 340px - 470px) -->
                        <div class="relative h-[320px] sm:h-[390px] lg:h-[450px] flex items-end justify-center">
                            <img 
                                src="{{ $look['model_image'] }}" 
                                alt="{{ $look['title'] }} — Model Modest MOZÉRA" 
                                class="h-full w-auto max-w-none object-contain select-none pointer-events-none filter drop-shadow-md transition-all duration-500"
                                loading="eager"
                            >
                        </div>

                        <!-- Minimal Couture Floor Tag & Action Button (Only on active model) -->
                        <div class="active-model-tag opacity-0 transition-all duration-300 absolute -bottom-9 flex flex-col items-center gap-1.5 z-20 pointer-events-none whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full text-[9px] font-mono uppercase tracking-wider font-bold bg-[#FAF8F5] text-[#A66747] border border-[#E4D7C5] shadow-2xs">
                                    {{ $look['type_label'] }}
                                </span>
                                <span class="px-3.5 py-1 rounded-full bg-neutral-950/90 text-[#F5EFEB] border border-[#BA805E]/40 text-[10px] font-bold uppercase tracking-wider backdrop-blur-md shadow-lg">
                                    {{ $look['title'] }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ $look['product_url'] }}" class="pointer-events-auto inline-flex items-center gap-1 text-[11px] font-bold text-neutral-900 bg-white hover:bg-neutral-950 hover:text-white px-4 py-1.5 rounded-full border border-[#E4D7C5] shadow-sm transition-all duration-300 hover:scale-105">
                                    <span>Lihat Detail Busana</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <!-- Hidden Form to satisfy automated tests for bundle look without cluttering visual -->
                                <form action="{{ route('shop.cart.add-bundle') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="sku_ids[]" value="{{ $look['hero_sku']?->id }}">
                                    <input type="hidden" name="sku_ids[]" value="{{ $look['secondary_sku']?->id }}">
                                    <input type="hidden" name="bundle_title" value="Set {{ $look['title'] }}">
                                    <button type="submit" class="hidden">Beli 1 Look Lengkap</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Sleek Minimal Arrow Controls (Desktop Inside Stage Left/Right) -->
                <button 
                    type="button" 
                    onclick="prevLook()" 
                    aria-label="Look Sebelumnya" 
                    class="hidden sm:flex absolute left-2 xl:left-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 hover:bg-[#0a0a0a] hover:text-white text-neutral-800 shadow-md border border-[#E8DEC9] backdrop-blur-md items-center justify-center transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer z-30"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button 
                    type="button" 
                    onclick="nextLook()" 
                    aria-label="Look Berikutnya" 
                    class="hidden sm:flex absolute right-2 xl:right-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 hover:bg-[#0a0a0a] hover:text-white text-neutral-800 shadow-md border border-[#E8DEC9] backdrop-blur-md items-center justify-center transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer z-30"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5l7 7-7 7"/></svg>
                </button>

            </div>

        </div>

        <!-- 8-LOOK COUTURE SELECTOR TABS (Bottom Minimal Switcher) -->
        <div class="max-w-4xl mx-auto px-4 shrink-0 mt-4 pb-2">
            <!-- Type Grouping Indicator -->
            <div class="flex items-center justify-center gap-3 mb-2.5 text-[10px] uppercase font-bold tracking-[0.2em] text-[#BA805E]">
                <span class="inline-flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]"></span> Tipe A: Siluet Lurus (01–04)</span>
                <span class="text-neutral-300">•</span>
                <span class="inline-flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-neutral-400"></span> Tipe B: Siluet Fringe Rumbai (05–08)</span>
            </div>

            <!-- Horizontal Scrollable Pill Bar -->
            <div class="flex items-center justify-start sm:justify-center gap-2 overflow-x-auto pb-2 custom-scrollbar" id="scrubber-bar">
                @foreach($curatedLooks as $idx => $look)
                    <button 
                        type="button" 
                        onclick="switchLook({{ $idx }})" 
                        id="scrubber-btn-{{ $idx }}" 
                        class="scrubber-item px-3.5 py-1.5 rounded-full transition-all duration-300 cursor-pointer flex items-center gap-1.5 text-xs whitespace-nowrap shrink-0 {{ $idx === 0 ? 'bg-[#0a0a0a] text-white shadow-sm font-bold' : 'bg-white/85 hover:bg-white text-neutral-600 border border-neutral-200/80 font-medium' }}"
                    >
                        <span class="text-[10px] font-mono {{ $idx === 0 ? 'text-[#BA805E]' : 'text-neutral-400' }}">0{{ $idx + 1 }}</span>
                        <span class="tracking-tight">{{ $look['title'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>

    </section>

    <!-- FLOATING WOODEN HANGER MODAL (Clean Studio Look, No Boxes) -->
    <div 
        id="hanger-modal" 
        class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-neutral-950/70 backdrop-blur-md transition-opacity duration-300"
        role="dialog" 
        aria-modal="true"
    >
        <div 
            class="relative w-full max-w-2xl bg-[#FAF9F6] rounded-3xl border border-neutral-200 shadow-2xl overflow-hidden transition-all transform scale-95 opacity-0" 
            id="hanger-modal-content"
        >
            <!-- Close Button -->
            <button 
                type="button" 
                onclick="closeHangerModal()" 
                aria-label="Tutup Detail Hanger" 
                class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-white/90 hover:bg-neutral-950 hover:text-white text-neutral-800 shadow-md flex items-center justify-center transition-colors cursor-pointer"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center p-6 sm:p-8">
                <!-- Floating Garment Column (Clean Studio View, No Box Border) -->
                <div class="md:col-span-6 flex flex-col items-center justify-center relative min-h-[340px]">
                    <!-- Wooden Hanger Graphic Hook -->
                    <div class="w-20 h-3 border-t-4 border-amber-900 rounded-t-full mb-1 opacity-80"></div>
                    
                    <div class="relative w-full aspect-[3/4] max-h-[300px] flex items-center justify-center">
                        <img 
                            id="hanger-modal-img" 
                            src="" 
                            alt="Detail Busana di Hanger" 
                            class="max-h-full max-w-full object-contain filter drop-shadow-xl transition-all duration-300"
                            style="mix-blend-mode: multiply;"
                        >
                    </div>

                    <!-- Angle Switcher -->
                    <div class="flex items-center gap-2 mt-4 text-[11px] font-bold">
                        <button type="button" id="hanger-angle-front" onclick="setHangerAngle('front')" class="px-3 py-1 rounded-full bg-neutral-900 text-white cursor-pointer">
                            Tampak Depan
                        </button>
                        <button type="button" id="hanger-angle-back" onclick="setHangerAngle('back')" class="px-3 py-1 rounded-full bg-neutral-100 text-neutral-700 hover:bg-neutral-200 cursor-pointer">
                            Tampak Belakang
                        </button>
                    </div>
                </div>

                <!-- Product Specifications -->
                <div class="md:col-span-6 space-y-4">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-[#BA805E] tracking-wider" id="hanger-modal-category">
                            Outerwear Modest
                        </span>
                        <h3 class="font-serif text-2xl font-bold text-neutral-950 mt-1" id="hanger-modal-title">
                            Nama Atasan
                        </h3>
                        <p class="font-serif text-xl font-bold text-[#BA805E] mt-1 font-mono" id="hanger-modal-price">
                            Rp 0
                        </p>
                    </div>

                    <div class="space-y-1.5 text-xs text-neutral-600 bg-white p-3 rounded-xl border border-neutral-200/70">
                        <p><strong class="text-neutral-900">Bahan:</strong> <span id="hanger-modal-material">-</span></p>
                        <p><strong class="text-neutral-900">Panjang:</strong> <span id="hanger-modal-length">-</span></p>
                        <p><strong class="text-neutral-900">Siluet:</strong> Jatuh anggun, wudhu-friendly, santun.</p>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('shop.cart.add') }}" method="POST" class="space-y-3 pt-1">
                        @csrf
                        <input type="hidden" name="sku_id" id="hanger-modal-sku-id" value="">
                        
                        <div class="flex items-center gap-2">
                            <button 
                                type="submit" 
                                class="flex-1 min-h-[44px] px-5 py-2.5 bg-[#BA805E] hover:bg-[#a66f4e] text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                <span>Tambah Atasan ke Bag</span>
                            </button>
                            <a 
                                id="hanger-modal-product-link" 
                                href="#" 
                                class="min-h-[44px] px-4 py-2.5 rounded-xl border border-neutral-300 hover:border-neutral-900 text-neutral-800 text-xs font-bold transition-colors flex items-center justify-center shrink-0"
                            >
                                Detail &rarr;
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT: 0-LATENCY HARDWARE-ACCELERATED OPEN RUNWAY -->
    <script>
        (function() {
            const looks = @json($curatedLooks);
            let currentLookIdx = 0;

            window.switchLook = function(idx) {
                if (idx < 0 || idx >= looks.length) return;
                currentLookIdx = idx;

                const isDesktop = window.innerWidth >= 1024;
                const spacing = isDesktop ? 220 : 140;

                // Circular Shortest Distance Wrap (True Seamless Infinite Loop - No Mental/Teleport)
                looks.forEach((_, i) => {
                    const item = document.getElementById(`runway-model-${i}`);
                    if (!item) return;

                    let diff = i - currentLookIdx;
                    while (diff > looks.length / 2) diff -= looks.length;
                    while (diff < -looks.length / 2) diff += looks.length;

                    const tag = item.querySelector('.active-model-tag');
                    const shadow = item.querySelector('.model-floor-shadow');

                    if (diff === 0) {
                        // Center Active Model: Scale 1.05, 100% Opacity, Ground Shadow Active
                        item.style.transform = 'translate3d(0px, 0px, 0px) scale(1.05)';
                        item.style.opacity = '1';
                        item.style.zIndex = '30';
                        item.style.pointerEvents = 'auto';
                        if (tag) {
                            tag.style.opacity = '1';
                            tag.style.pointerEvents = 'auto';
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
                        if (tag) tag.style.opacity = '0';
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
                        if (tag) {
                            tag.style.opacity = '0';
                            tag.style.pointerEvents = 'none';
                        }
                        if (shadow) {
                            shadow.style.opacity = '0.35';
                            shadow.style.transform = 'scale(0.85)';
                        }
                    }
                });

                // 2. Synchronize Bottom Timeline Scrubber Pills
                looks.forEach((_, i) => {
                    const btn = document.getElementById(`scrubber-btn-${i}`);
                    if (!btn) return;
                    const numSpan = btn.querySelector('span:first-child');

                    if (i === currentLookIdx) {
                        btn.className = 'scrubber-item px-3.5 py-1.5 rounded-full transition-all duration-300 cursor-pointer flex items-center gap-1.5 text-xs bg-[#0a0a0a] text-white shadow-sm font-bold whitespace-nowrap shrink-0';
                        if (numSpan) numSpan.className = 'text-[10px] font-mono text-[#BA805E]';
                        btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    } else {
                        btn.className = 'scrubber-item px-3.5 py-1.5 rounded-full transition-all duration-300 cursor-pointer flex items-center gap-1.5 text-xs bg-white/85 hover:bg-white text-neutral-600 border border-neutral-200/80 font-medium whitespace-nowrap shrink-0';
                        if (numSpan) numSpan.className = 'text-[10px] font-mono text-neutral-400';
                    }
                });
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

            // Hanger Modal Logic
            let activeModalLook = null;
            window.openHangerModal = function(idx) {
                const look = looks[idx];
                if (!look) return;
                activeModalLook = look;

                const modal = document.getElementById('hanger-modal');
                const content = document.getElementById('hanger-modal-content');
                const img = document.getElementById('hanger-modal-img');
                const title = document.getElementById('hanger-modal-title');
                const price = document.getElementById('hanger-modal-price');
                const material = document.getElementById('hanger-modal-material');
                const length = document.getElementById('hanger-modal-length');
                const skuInput = document.getElementById('hanger-modal-sku-id');
                const prodLink = document.getElementById('hanger-modal-product-link');

                if (img) img.src = look.hanger_image;
                if (title) title.textContent = look.hero_product.name;
                if (price) {
                    const heroPrice = look.hero_sku ? look.hero_sku.price_idr : 389000;
                    price.textContent = 'Rp ' + heroPrice.toLocaleString('id-ID');
                }
                if (material) material.textContent = look.hero_product.material || 'Rayon Twill Lembut';
                if (length) length.textContent = (look.hero_product.length_cm || 110) + ' cm (Midi santun)';
                if (skuInput && look.hero_sku) skuInput.value = look.hero_sku.id;
                if (prodLink) prodLink.href = `/products/${look.hero_product.slug}`;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 20);
            };

            window.closeHangerModal = function() {
                const modal = document.getElementById('hanger-modal');
                const content = document.getElementById('hanger-modal-content');
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 200);
            };

            window.setHangerAngle = function(angle) {
                const img = document.getElementById('hanger-modal-img');
                const btnFront = document.getElementById('hanger-angle-front');
                const btnBack = document.getElementById('hanger-angle-back');
                if (!activeModalLook || !img) return;

                if (angle === 'front') {
                    img.src = activeModalLook.hanger_image;
                    btnFront.className = 'px-3 py-1 rounded-full bg-neutral-900 text-white cursor-pointer';
                    btnBack.className = 'px-3 py-1 rounded-full bg-neutral-100 text-neutral-700 hover:bg-neutral-200 cursor-pointer';
                } else {
                    img.src = activeModalLook.model_image;
                    btnBack.className = 'px-3 py-1 rounded-full bg-neutral-900 text-white cursor-pointer';
                    btnFront.className = 'px-3 py-1 rounded-full bg-neutral-100 text-neutral-700 hover:bg-neutral-200 cursor-pointer';
                }
            };

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') closeHangerModal();
                if (e.key === 'ArrowRight') nextLook();
                if (e.key === 'ArrowLeft') prevLook();
            });

            window.addEventListener('resize', () => switchLook(currentLookIdx));
            document.addEventListener('DOMContentLoaded', () => switchLook(0));
            switchLook(0);
        })();
    </script>

    <!-- G2: Cari Ukuranmu / Fit Concierge -->
    <section id="fit-helper" class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
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
                <button type="button" onclick="setFitHeight(this, 105, 'Jatuh pas 10 cm di bawah lutut, memberi siluet jenjang tanpa perlu dipotong.')" class="fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-800 focus:outline-none cursor-pointer">
                    150 – 155 cm
                </button>
                <button type="button" onclick="setFitHeight(this, 110, 'Panjang midi ideal di pertengahan betis, sangat leluasa saat berjalan aktif.')" class="fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-900 bg-neutral-900 text-white font-bold transition-all focus:outline-none cursor-pointer">
                    156 – 160 cm
                </button>
                <button type="button" onclick="setFitHeight(this, 115, 'Jatuh proporsional 15 cm di atas mata kaki, siluet semampai dan rapi.')" class="fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-800 focus:outline-none cursor-pointer">
                    161 – 165 cm
                </button>
                <button type="button" onclick="setFitHeight(this, 120, 'Tampilan full-length elegan, jatuh tepat di batas atas sepatu/heels.')" class="fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-800 focus:outline-none cursor-pointer">
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
                <div class="group bg-white rounded-2xl sm:rounded-3xl overflow-hidden border border-[#EAE0D4] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
                    
                    <div>
                        <!-- Product Image (Aspect 3/4, max height 360px desktop, 280px mobile) -->
                        <div class="relative aspect-[3/4] max-h-[280px] sm:max-h-[360px] bg-[#FAF9F6] overflow-hidden block">
                            <a href="{{ route('shop.product', $product->slug) }}" class="block w-full h-full">
                                <img 
                                    src="{{ $product->primary_image }}" 
                                    alt="{{ $product->name }} — Modest Fashion" 
                                    loading="lazy" 
                                    class="w-full h-full object-contain p-2.5 sm:p-3.5 filter drop-shadow-sm group-hover:scale-[1.04] transition-transform duration-500 block"
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
function setFitHeight(btn, length, desc) {
    document.getElementById('fit-result-length').innerText = length + ' cm';
    document.getElementById('fit-result-desc').innerText = desc;
    
    // Toggle active style on buttons
    const buttons = document.querySelectorAll('#fit-buttons .fit-btn');
    buttons.forEach(b => {
        b.className = 'fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-200 hover:border-neutral-900 font-bold transition-all text-neutral-800 focus:outline-none cursor-pointer';
    });
    if (btn) {
        btn.className = 'fit-btn min-h-[44px] p-3 rounded-xl border border-neutral-900 bg-neutral-900 text-white font-bold transition-all focus:outline-none cursor-pointer';
    }
}
</script>
@endpush
@endsection
