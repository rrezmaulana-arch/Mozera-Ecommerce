@extends('layouts.shop')

@section('title', 'MOZÉRA — Timeless Modest Wear & Premium Outerwear')
@section('meta_description', 'Koleksi modest fashion wanita Indonesia: outerwear santun, voal scarf ultrafine, dan tiered dress casual-elegan. #everydaymozera')

@section('content')
<div class="space-y-12 sm:space-y-20 lg:space-y-24">

    <!-- HERO SECTION (Editorial Minimalist) -->
    <section class="w-full relative bg-[#FAF9F6] border-b border-neutral-200/70 py-10 lg:py-16">
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">

                <!-- Left Text Column -->
                <div class="lg:col-span-7 space-y-5 text-center lg:text-left">
                    <p class="text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-semibold">
                        Koleksi Modest Atasan &amp; Outerwear
                    </p>

                    <h1 class="font-serif text-[clamp(2.2rem,5vw,3.6rem)] font-bold tracking-tight text-neutral-950 leading-[1.12]">
                        Outer yang <span class="font-serif italic font-normal text-[#BA805E]">Jatuh Anggun</span>, dari Kuliah sampai Kondangan.
                    </h1>

                    <p class="text-neutral-600 text-[15px] sm:text-base leading-relaxed max-w-lg mx-auto lg:mx-0 font-light">
                        Potongan santun berbahan rayon twill dan linen pilihan. Nyaman dipakai seharian tanpa khawatir kusut.
                    </p>

                    <!-- CTAs -->
                    <div class="pt-3 flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                        <a href="{{ route('shop.catalog') }}" class="w-full sm:w-auto min-h-[46px] px-8 py-3 bg-neutral-950 hover:bg-[#BA805E] text-white text-xs font-semibold uppercase tracking-[0.18em] transition-colors text-center flex items-center justify-center">
                            Jelajahi Koleksi
                        </a>
                        <a href="#try-the-look" class="min-h-[46px] px-4 py-3 text-xs font-semibold uppercase tracking-[0.15em] text-neutral-700 hover:text-neutral-950 border-b border-neutral-300 hover:border-neutral-950 transition-colors flex items-center justify-center gap-2">
                            <span>Try The Look</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Right Fashion Visual Column -->
                <div class="lg:col-span-5 relative flex flex-col items-center">
                    <a href="{{ route('shop.product', 'puspa-floral-outer-kimono') }}" class="group block w-full max-w-[340px]">
                        <div class="relative w-full h-[360px] sm:h-[430px] bg-[#F4F1EC] flex items-end justify-center pt-6 overflow-hidden">
                            <img
                                src="/images/models/look-1-terracotta.png"
                                alt="PUSPA Floral Outer Kimono MOZÉRA"
                                class="h-[92%] w-auto object-contain select-none transition-transform duration-500 group-hover:scale-[1.03]"
                            >
                        </div>
                        <div class="pt-3 flex items-center justify-between text-xs border-b border-neutral-200 pb-2.5">
                            <span class="font-medium text-neutral-900 group-hover:text-[#BA805E] transition-colors">PUSPA Floral Outer Kimono</span>
                            <span class="text-neutral-600">Rp 389.000 &rarr;</span>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- QUIET EDITORIAL SERVICE STRIP -->
    <section class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-4 border-y border-neutral-200/80 text-xs text-neutral-600">
            <div class="flex items-center justify-center md:justify-start gap-2">
                <span class="font-medium text-neutral-900">Ready Stock Surabaya</span>
            </div>
            <div class="flex items-center justify-center md:justify-start gap-2">
                <span class="font-medium text-neutral-900">Bahan Rayon &amp; Voal Sejuk</span>
            </div>
            <div class="flex items-center justify-center md:justify-start gap-2">
                <a href="{{ route('shop.home') }}#fit-helper" class="hover:text-[#BA805E] transition-colors font-medium text-neutral-900">Panduan Panjang Outer &rarr;</a>
            </div>
            <div class="flex items-center justify-center md:justify-end gap-2">
                <a href="{{ route('shop.returns') }}" class="hover:text-[#BA805E] transition-colors font-medium text-neutral-900">Garansi Tukar Ukuran 7 Hari &rarr;</a>
            </div>
        </div>
    </section>

    <!-- SECTION E: KARTU SERI (Atelier Editorial Showcase - Bersih, Mewah, & Teratur) -->
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
                            <h3 class="font-serif text-lg font-bold tracking-tight text-neutral-950 group-hover:text-[#BA805E] transition-colors leading-snug">
                                {{ $s->name }}
                            </h3>
                            <p class="text-xs text-neutral-500 line-clamp-2 font-light leading-relaxed">
                                {{ $s->description }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-neutral-100 flex items-center justify-between text-xs font-bold text-neutral-900 group-hover:text-[#BA805E] transition-colors">
                            <span class="text-[11px] uppercase tracking-wider">Jelajahi Koleksi</span>
                            <span class="w-7 h-7 rounded-full bg-[#FAF8F5] group-hover:bg-[#BA805E] group-hover:text-white flex items-center justify-center transition-all duration-300 text-xs text-[#BA805E] border border-[#E8DEC9] group-hover:border-transparent">
                                &rarr;
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- G1: VIEWPORT-FITTED OPEN RUNWAY ("Try The Look") -->
    <style>
        /* Smooth Haute-Couture Stage Transitions */
        .runway-model-item {
            transition: transform 600ms cubic-bezier(0.22, 1, 0.36, 1), opacity 450ms ease-out !important;
            will-change: transform, opacity;
        }
        .runway-angle-wrap {
            transition: transform 550ms cubic-bezier(0.22, 1, 0.36, 1), opacity 400ms ease-out !important;
            will-change: transform, opacity;
        }
        /* Saat 3 sudut pandang aktif, sembunyikan model lain secara halus tanpa lag repaint */
        #open-runway-stage.angles-open .runway-model-item:not(.active-expanded) {
            opacity: 0 !important;
            pointer-events: none !important;
            transform: scale(0.65) !important;
        }
    </style>
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
                Eksplorasi padu-padan atasan santun MOZÉRA. Klik foto model untuk membuka 3 sudut pandang fitting secara utuh.
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
                        class="runway-model-item absolute bottom-2 sm:bottom-3 flex flex-col items-center justify-end cursor-pointer z-10 group"
                    >
                        <!-- Cutout Model Image: Model Responsif -->
                        <div class="relative h-[250px] sm:h-[330px] md:h-[390px] lg:h-[460px] flex items-end justify-center">
                            <!-- Side Angle Left (Hadap Samping) -->
                            <div id="angle-side-wrap-{{ $idx }}" class="runway-angle-wrap absolute bottom-0 -left-16 sm:-left-28 md:-left-36 lg:-left-48 opacity-0 scale-90 -translate-x-6 z-0 flex flex-col items-center pointer-events-none">
                                <span class="text-[9px] font-mono uppercase tracking-wider font-bold text-neutral-800 bg-white/95 backdrop-blur-xs px-3 py-0.5 rounded-full border border-neutral-200/80 shadow-2xs mb-1">
                                    Tampak Samping
                                </span>
                                <img 
                                    id="angle-side-{{ $idx }}"
                                    src="{{ $look['side_image'] }}" 
                                    alt="Tampak Samping" 
                                    class="h-[230px] sm:h-[305px] md:h-[360px] lg:h-[425px] w-auto max-w-none object-contain select-none"
                                >
                            </div>

                            <!-- Center Front Model -->
                            <div class="flex flex-col items-center z-10">
                                <span id="angle-front-tag-{{ $idx }}" class="opacity-0 transition-opacity duration-300 text-[9px] font-mono uppercase tracking-wider font-bold text-[#BA805E] bg-white/95 backdrop-blur-xs px-3 py-0.5 rounded-full border border-[#EADCCE] shadow-2xs mb-1 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]"></span>
                                    <span>Tampak Depan</span>
                                </span>
                                <img 
                                    id="angle-front-{{ $idx }}"
                                    src="{{ $look['model_image'] }}" 
                                    alt="{{ $look['title'] }} — Model Modest MOZÉRA" 
                                    class="h-[250px] sm:h-[330px] md:h-[390px] lg:h-[460px] w-auto max-w-none object-contain select-none pointer-events-none"
                                    loading="eager"
                                    style="image-rendering: auto; -webkit-backface-visibility: hidden; transform: translateZ(0);"
                                >
                            </div>

                            <!-- Back Angle Right (Hadap Belakang) -->
                            <div id="angle-back-wrap-{{ $idx }}" class="runway-angle-wrap absolute bottom-0 -right-16 sm:-right-28 md:-right-36 lg:-right-48 opacity-0 scale-90 translate-x-6 z-0 flex flex-col items-center pointer-events-none">
                                <span class="text-[9px] font-mono uppercase tracking-wider font-bold text-neutral-800 bg-white/95 backdrop-blur-xs px-3 py-0.5 rounded-full border border-neutral-200/80 shadow-2xs mb-1">
                                    Tampak Belakang
                                </span>
                                <img 
                                    id="angle-back-{{ $idx }}"
                                    src="{{ $look['back_image'] }}" 
                                    alt="Tampak Belakang" 
                                    class="h-[230px] sm:h-[305px] md:h-[360px] lg:h-[425px] w-auto max-w-none object-contain select-none"
                                >
                            </div>
                        </div>

                        <!-- Micro Hint on Active Center Model (Semua model bisa diklik) -->
                        <div class="active-angle-hint opacity-0 transition-opacity duration-300 absolute -top-1 pointer-events-none">
                            <span class="px-2.5 py-0.5 rounded-full bg-neutral-900/85 backdrop-blur-sm text-[9px] font-mono text-[#DCC3AD] uppercase tracking-wider flex items-center gap-1 shadow-md">
                                <svg class="w-3 h-3 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <span id="angle-hint-text-{{ $idx }}">
                                    Klik Foto: 3 Sudut Fitting
                                </span>
                            </span>
                        </div>

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

        <!-- DEDICATED ACTIVE LOOK HIGHLIGHT & RICH INFORMATION -->
        <div class="max-w-2xl mx-auto px-4 mt-4 pb-2 flex flex-col items-center justify-center text-center z-20">
            <span id="runway-look-type" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-[#BA805E]">
                {{ $curatedLooks[0]['type_label'] }}
            </span>
            <h3 id="runway-look-title" class="font-serif text-xl sm:text-2xl font-bold text-neutral-950 mt-1">
                {{ $curatedLooks[0]['title'] }}
            </h3>
            <p id="runway-look-vibe" class="text-xs sm:text-sm text-neutral-600 max-w-lg mx-auto font-light leading-relaxed mt-1.5 mb-4">
                {{ $curatedLooks[0]['vibe'] }}
            </p>
            <a id="runway-look-btn" href="{{ $curatedLooks[0]['product_url'] }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.15em] text-white bg-neutral-950 hover:bg-[#BA805E] px-7 py-3 transition-colors cursor-pointer">
                <span>Lihat Detail Busana</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

    </section>

    <!-- JAVASCRIPT: 0-LATENCY HARDWARE-ACCELERATED OPEN RUNWAY -->
    <script>
        (function() {
            const looks = @json($curatedLooks);
            let currentLookIdx = 0;
            let anglesOpen = false;

            window.onModelClick = function(idx) {
                if (idx === currentLookIdx) {
                    // Klik model tengah: Toggle buka/tutup gambar samping & belakang langsung di panggung!
                    toggleAngles(idx);
                } else {
                    // Tutup sudut otomatis jika pindah model
                    closeAnglesInline();
                    switchLook(idx);
                }
            };

            window.toggleAngles = function(idx) {
                const look = looks[idx];
                if (!look) return;

                const stage = document.getElementById('open-runway-stage');
                const activeModel = document.getElementById(`runway-model-${idx}`);
                const sideWrap = document.getElementById(`angle-side-wrap-${idx}`);
                const backWrap = document.getElementById(`angle-back-wrap-${idx}`);
                const frontTag = document.getElementById(`angle-front-tag-${idx}`);
                const frontImg = document.getElementById(`angle-front-${idx}`);
                const hintText = document.getElementById(`angle-hint-text-${idx}`);

                anglesOpen = !anglesOpen;

                if (anglesOpen) {
                    if (stage) stage.classList.add('angles-open');
                    if (activeModel) activeModel.classList.add('active-expanded');

                    // Buka jejer ke kiri & kanan dengan transisi smooth
                    if (sideWrap) {
                        sideWrap.style.opacity = '1';
                        sideWrap.style.transform = 'translate3d(-24px, 0px, 0px) scale(0.96)';
                        sideWrap.style.pointerEvents = 'auto';
                    }
                    if (backWrap) {
                        backWrap.style.opacity = '1';
                        backWrap.style.transform = 'translate3d(24px, 0px, 0px) scale(0.96)';
                        backWrap.style.pointerEvents = 'auto';
                    }
                    if (frontTag) {
                        frontTag.style.opacity = '1';
                    }
                    if (frontImg) {
                        frontImg.style.transform = 'scale(1.02)';
                    }
                    if (hintText) hintText.textContent = 'Klik Model untuk Menutup Sudut';
                } else {
                    // Tutup kembali
                    closeAnglesInline();
                    switchLook(idx);
                }
            };

            window.closeAnglesInline = function() {
                anglesOpen = false;
                const stage = document.getElementById('open-runway-stage');
                if (stage) stage.classList.remove('angles-open');

                looks.forEach((look, idx) => {
                    const activeModel = document.getElementById(`runway-model-${idx}`);
                    const sideWrap = document.getElementById(`angle-side-wrap-${idx}`);
                    const backWrap = document.getElementById(`angle-back-wrap-${idx}`);
                    const frontTag = document.getElementById(`angle-front-tag-${idx}`);
                    const frontImg = document.getElementById(`angle-front-${idx}`);
                    const hintText = document.getElementById(`angle-hint-text-${idx}`);

                    if (activeModel) {
                        activeModel.classList.remove('active-expanded');
                    }

                    if (sideWrap) {
                        sideWrap.style.opacity = '0';
                        sideWrap.style.transform = 'translate3d(-40px, 0px, 0px) scale(0.85)';
                        sideWrap.style.pointerEvents = 'none';
                    }
                    if (backWrap) {
                        backWrap.style.opacity = '0';
                        backWrap.style.transform = 'translate3d(40px, 0px, 0px) scale(0.85)';
                        backWrap.style.pointerEvents = 'none';
                    }
                    if (frontTag) {
                        frontTag.style.opacity = '0';
                    }
                    if (frontImg) {
                        frontImg.style.transform = 'scale(1)';
                    }
                    if (hintText) {
                        hintText.textContent = 'Klik Foto: 3 Sudut Fitting';
                    }
                });
            };

            window.switchLook = function(idx) {
                if (idx < 0 || idx >= looks.length) return;
                // Otomatis tutup sudut fitting saat berpindah model/panah
                closeAnglesInline();
                currentLookIdx = idx;

                const screenW = window.innerWidth;
                const spacing = screenW >= 1024 ? 220 : (screenW >= 640 ? 150 : 105);

                // Circular Shortest Distance Wrap (True Seamless Infinite Loop - No Mental/Teleport)
                looks.forEach((look, i) => {
                    const item = document.getElementById(`runway-model-${i}`);
                    if (!item) return;

                    item.style.display = '';
                    item.style.visibility = '';

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

                // 3. Update Dedicated Active Look Badge, Title, Vibe & Link
                const activeLook = looks[currentLookIdx];
                const typeEl = document.getElementById('runway-look-type');
                const titleEl = document.getElementById('runway-look-title');
                const vibeEl = document.getElementById('runway-look-vibe');
                const btnEl = document.getElementById('runway-look-btn');
                if (typeEl && activeLook) typeEl.textContent = activeLook.type_label;
                if (titleEl && activeLook) titleEl.textContent = activeLook.title;
                if (vibeEl && activeLook) vibeEl.textContent = activeLook.vibe;
                if (btnEl && activeLook) btnEl.href = activeLook.product_url;
            };

            window.nextLook = function() {
                closeAnglesInline();
                switchLook((currentLookIdx + 1) % looks.length);
            };

            window.prevLook = function() {
                closeAnglesInline();
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

    <!-- G2: PANDUAN PANJANG OUTER (Clean Editorial Size Guide, Tanpa Avatar SVG Kartun) -->
    <section id="fit-helper" class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="border-y border-neutral-200 py-10 sm:py-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                <!-- Left: Heading & Height Slider -->
                <div class="lg:col-span-6 space-y-5">
                    <div>
                        <span class="text-[11px] uppercase tracking-[0.2em] text-[#BA805E] font-semibold">Panduan Ukuran</span>
                        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-neutral-950 mt-1">
                            Cek Jatuh Panjang Outer
                        </h3>
                        <p class="text-xs sm:text-sm text-neutral-600 font-light mt-1.5 leading-relaxed">
                            Sesuaikan tinggi badan Anda untuk mengetahui estimasi jatuh ujung outer dan rekomendasi panjang yang paling pas.
                        </p>
                    </div>

                    <div class="bg-white border border-neutral-200 p-5 space-y-4">
                        <div class="flex items-baseline justify-between">
                            <div>
                                <span class="text-[10px] uppercase tracking-wider text-neutral-400 block">Tinggi Badan</span>
                                <div class="flex items-baseline gap-1 mt-0.5">
                                    <span class="font-serif text-3xl sm:text-4xl font-bold text-neutral-950" id="fit-height-number">158</span>
                                    <span class="text-sm text-[#BA805E] font-serif">cm</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] uppercase tracking-wider text-neutral-400 block">Rekomendasi Panjang</span>
                                <span class="font-serif text-xl sm:text-2xl font-bold text-neutral-950" id="fit-result-length">110 cm</span>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <input
                                type="range"
                                id="fit-range-slider"
                                min="148"
                                max="175"
                                value="158"
                                oninput="onFitSliderChange(this.value)"
                                class="w-full h-1.5 bg-neutral-200 appearance-none cursor-pointer accent-[#BA805E]"
                            >
                            <div class="flex justify-between text-[10px] text-neutral-400">
                                <span>148 cm</span>
                                <span>155 cm</span>
                                <span>162 cm</span>
                                <span>170 cm</span>
                                <span>175 cm</span>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 pt-1 text-xs" id="fit-buttons">
                            <button type="button" onclick="setFitSlider(152)" class="fit-btn px-3 py-1.5 border border-neutral-200 hover:border-neutral-900 font-medium transition-colors text-neutral-700 cursor-pointer">
                                150–155 cm
                            </button>
                            <button type="button" onclick="setFitSlider(158)" class="fit-btn px-3 py-1.5 border border-neutral-900 bg-neutral-900 text-white font-medium transition-colors cursor-pointer">
                                156–160 cm
                            </button>
                            <button type="button" onclick="setFitSlider(163)" class="fit-btn px-3 py-1.5 border border-neutral-200 hover:border-neutral-900 font-medium transition-colors text-neutral-700 cursor-pointer">
                                161–165 cm
                            </button>
                            <button type="button" onclick="setFitSlider(168)" class="fit-btn px-3 py-1.5 border border-neutral-200 hover:border-neutral-900 font-medium transition-colors text-neutral-700 cursor-pointer">
                                166+ cm
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right: Clean Breakdown Table + CTA -->
                <div class="lg:col-span-6 space-y-5 lg:pt-2">
                    <div class="border border-neutral-200 bg-white divide-y divide-neutral-200">
                        <div class="p-4 flex items-start justify-between gap-4">
                            <span class="text-xs uppercase tracking-wider text-neutral-500 shrink-0">Jatuh Baju</span>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-neutral-950" id="fit-insight-hemline">Midi Santun</p>
                                <p class="text-xs text-neutral-500 mt-0.5" id="fit-result-desc">Panjang midi ideal di pertengahan betis.</p>
                            </div>
                        </div>
                        <div class="p-4 flex items-start justify-between gap-4">
                            <span class="text-xs uppercase tracking-wider text-neutral-500 shrink-0">Padanan Hijab</span>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-neutral-950" id="fit-insight-hijab">Voal 120x120</p>
                                <p class="text-xs text-neutral-500 mt-0.5">Menutup dada proporsional &amp; rapi.</p>
                            </div>
                        </div>
                        <div class="p-4 flex items-start justify-between gap-4">
                            <span class="text-xs uppercase tracking-wider text-neutral-500 shrink-0">Alas Kaki</span>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-neutral-950" id="fit-insight-shoes">Mules / Kitten Heels</p>
                                <p class="text-xs text-neutral-500 mt-0.5" id="fit-shoes-desc">Proporsi jatuh semakin seimbang.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden elements kept for JS compatibility -->
                    <span id="fit-avatar-silhouette-badge" class="hidden"></span>
                    <span id="fit-hemline-label" class="hidden"></span>
                    <div id="fit-hemline-bar" class="hidden"></div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <p class="text-xs text-neutral-500" id="fit-hemline-summary">Semua outer MOZÉRA wudhu-friendly &amp; tidak menyapu lantai.</p>
                        <a
                            id="fit-cta-btn"
                            href="{{ route('shop.catalog', ['category' => 'outerwear']) }}"
                            class="min-h-[44px] px-6 py-2.5 bg-neutral-950 hover:bg-[#BA805E] text-white text-xs font-semibold uppercase tracking-[0.15em] transition-colors inline-flex items-center justify-center gap-2 shrink-0 cursor-pointer"
                        >
                            <span id="fit-cta-text">Lihat Outer (158 cm)</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION F: KOLEKSI TERPOPULER (Editorial Minimalist Grid — Bersih Tanpa Clutter Pill/Rating Palsu) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-6 pb-3 border-b border-neutral-200">
            <div>
                <span class="text-[11px] uppercase tracking-[0.22em] text-[#BA805E] font-semibold">Pilihan Favorit</span>
                <h2 class="font-serif text-[clamp(1.5rem,3.5vw,2.25rem)] font-bold text-neutral-950 mt-0.5">
                    Koleksi Terpopuler
                </h2>
            </div>
            <a href="{{ route('shop.catalog') }}" class="text-xs font-semibold text-neutral-900 hover:text-[#BA805E] transition-colors pb-0.5 border-b border-neutral-900 hover:border-[#BA805E] shrink-0">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($featuredProducts as $product)
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
                    $uniqueColors = $product->skus->pluck('color')->filter()->unique()->values();
                    $isScarf = str_contains(strtolower($product->slug), 'scarf');
                @endphp
                <a href="{{ route('shop.product', $product->slug) }}" class="group block">
                    <!-- Clean Editorial Frame -->
                    <div class="relative h-[240px] sm:h-[290px] bg-[#F4F1EC] overflow-hidden flex items-center justify-center p-4">
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
    </section>

    <!-- SECTION H: EDITORIAL BRAND NOTE (#everydaymozera) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="border-t border-neutral-200 pt-10 pb-4 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
            <div class="space-y-1.5 max-w-xl">
                <span class="text-[11px] uppercase tracking-[0.22em] text-[#BA805E] font-semibold">#everydaymozera</span>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-neutral-950">Nyaman Dipakai, Santun Dipandang.</h2>
                <p class="text-xs sm:text-sm text-neutral-600 font-light leading-relaxed">
                    Bagikan gaya harianmu bersama MOZÉRA di Instagram dan TikTok dengan menandai <strong class="font-medium text-neutral-900">@mozera.id</strong>.
                </p>
            </div>
            <a href="{{ route('shop.catalog') }}" class="min-h-[44px] shrink-0 inline-flex items-center justify-center px-7 py-3 bg-neutral-950 hover:bg-[#BA805E] text-white text-xs font-semibold uppercase tracking-[0.15em] transition-colors">
                Belanja Semua Koleksi
            </a>
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
