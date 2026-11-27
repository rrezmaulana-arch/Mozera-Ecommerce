@extends('layouts.shop')

@section('title', 'MOZÉRA — Timeless Modest Wear & Premium Outerwear')
@section('meta_description', 'Koleksi modest fashion wanita Indonesia: outerwear santun, voal scarf ultrafine, dan tiered dress casual-elegan. #everydaymozera')

@section('content')
<div class="space-y-12 sm:space-y-20 lg:space-y-24">

    <!-- HERO: TRY THE LOOK — INTERACTIVE VIRTUAL STYLING RUNWAY -->
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
    <section id="try-the-look" class="w-full relative pt-6 pb-10 lg:pt-8 lg:pb-12 bg-gradient-to-b from-[#FAF9F6] via-[#FAF8F4] to-[#FAF9F6] border-b border-[#EAE1D5]/70 select-none scroll-mt-16 overflow-hidden">
        
        <!-- Hero Runway Header -->
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 text-center shrink-0 mb-3">
            <span class="text-[10px] sm:text-[11px] uppercase tracking-[0.28em] font-semibold text-[#BA805E] block">
                Virtual Styling Runway &bull; Koleksi Modest MOZÉRA
            </span>
            <h1 class="font-serif text-[clamp(2rem,4.5vw,3.2rem)] font-bold text-neutral-950 mt-1 tracking-tight leading-tight">
                Try The <span class="italic font-normal text-[#BA805E]">Look.</span>
            </h1>
            <p class="text-xs sm:text-sm text-neutral-500 font-light mt-1 max-w-lg mx-auto">
                Geser untuk memilih busana atau klik model di tengah untuk melihat 3 sudut pandang fitting.
            </p>
        </div>

        <!-- FULL RUNWAY STAGE -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex flex-col items-center justify-center my-auto">
            
            <!-- Models Runway Stage -->
            <div class="relative w-full h-[330px] sm:h-[410px] md:h-[470px] lg:h-[520px] flex items-center justify-center pb-4 sm:pb-5 overflow-hidden" id="open-runway-stage">
                
                <!-- Soft Architectural Arch Backdrop -->
                <div class="absolute inset-x-3 sm:inset-x-10 lg:inset-x-20 top-1.5 sm:top-2 bottom-3 sm:bottom-5 rounded-t-[130px] sm:rounded-t-[190px] lg:rounded-t-[240px] bg-gradient-to-b from-[#F3ECE2]/90 via-[#FAF7F2]/50 to-transparent border-t border-x border-[#E8DEC9]/70 pointer-events-none -z-0"></div>

                @foreach($curatedLooks as $idx => $look)
                    <div 
                        id="runway-model-{{ $idx }}" 
                        onclick="onModelClick({{ $idx }})" 
                        class="runway-model-item absolute bottom-2 sm:bottom-3 flex flex-col items-center justify-end cursor-pointer z-10 group"
                    >
                        <!-- Cutout Model Image -->
                        <div class="relative h-[255px] sm:h-[335px] md:h-[395px] lg:h-[460px] flex items-end justify-center">
                            <!-- Side Angle Left -->
                            <div id="angle-side-wrap-{{ $idx }}" class="runway-angle-wrap absolute bottom-0 -left-16 sm:-left-28 md:-left-36 lg:-left-48 opacity-0 scale-90 -translate-x-6 z-0 flex flex-col items-center pointer-events-none">
                                <span class="text-[9px] uppercase tracking-wider font-semibold text-neutral-700 bg-white/95 backdrop-blur-xs px-3 py-0.5 rounded-full border border-[#E8DEC9] shadow-2xs mb-1">
                                    Tampak Samping
                                </span>
                                <img 
                                    id="angle-side-{{ $idx }}"
                                    src="{{ $look['side_image'] }}" 
                                    alt="Tampak Samping" 
                                    class="h-[235px] sm:h-[310px] md:h-[365px] lg:h-[425px] w-auto max-w-none object-contain select-none"
                                >
                            </div>

                            <!-- Center Front Model -->
                            <div class="flex flex-col items-center z-10">
                                <span id="angle-front-tag-{{ $idx }}" class="opacity-0 transition-opacity duration-300 text-[9px] uppercase tracking-wider font-semibold text-[#BA805E] bg-white/95 backdrop-blur-xs px-3 py-0.5 rounded-full border border-[#EADCCE] shadow-2xs mb-1 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]"></span>
                                    <span>Tampak Depan</span>
                                </span>
                                <img 
                                    id="angle-front-{{ $idx }}"
                                    src="{{ $look['model_image'] }}" 
                                    alt="{{ $look['title'] }} — Model Modest MOZÉRA" 
                                    class="h-[255px] sm:h-[335px] md:h-[395px] lg:h-[460px] w-auto max-w-none object-contain select-none pointer-events-none"
                                    loading="eager"
                                    style="image-rendering: auto; -webkit-backface-visibility: hidden; transform: translateZ(0);"
                                >
                            </div>

                            <!-- Back Angle Right -->
                            <div id="angle-back-wrap-{{ $idx }}" class="runway-angle-wrap absolute bottom-0 -right-16 sm:-right-28 md:-right-36 lg:-right-48 opacity-0 scale-90 translate-x-6 z-0 flex flex-col items-center pointer-events-none">
                                <span class="text-[9px] uppercase tracking-wider font-semibold text-neutral-700 bg-white/95 backdrop-blur-xs px-3 py-0.5 rounded-full border border-[#E8DEC9] shadow-2xs mb-1">
                                    Tampak Belakang
                                </span>
                                <img 
                                    id="angle-back-{{ $idx }}"
                                    src="{{ $look['back_image'] }}" 
                                    alt="Tampak Belakang" 
                                    class="h-[235px] sm:h-[310px] md:h-[365px] lg:h-[425px] w-auto max-w-none object-contain select-none"
                                >
                            </div>
                        </div>

                        <!-- Micro Hint on Active Center Model -->
                        <div class="active-angle-hint opacity-0 transition-opacity duration-300 absolute -top-1 pointer-events-none">
                            <span class="px-3 py-1 rounded-full bg-neutral-900/80 backdrop-blur-sm text-[9px] text-[#F2E6D8] tracking-wider flex items-center gap-1.5 shadow-sm">
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

                <!-- Smooth Round Arrow Controls -->
                <button 
                    type="button" 
                    onclick="prevLook()" 
                    aria-label="Look Sebelumnya" 
                    class="flex absolute left-1 sm:left-3 xl:left-6 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/95 hover:bg-neutral-950 hover:text-white text-neutral-800 shadow-md border border-[#E8DEC9] backdrop-blur-md items-center justify-center transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer z-30"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button 
                    type="button" 
                    onclick="nextLook()" 
                    aria-label="Look Berikutnya" 
                    class="flex absolute right-1 sm:right-3 xl:right-6 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/95 hover:bg-neutral-950 hover:text-white text-neutral-800 shadow-md border border-[#E8DEC9] backdrop-blur-md items-center justify-center transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer z-30"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>

            </div>

        </div>

        <!-- ACTIVE LOOK DETAILS & SOFT PILL CTA -->
        <div class="max-w-2xl mx-auto px-4 mt-4 flex flex-col items-center justify-center text-center z-20">
            <span id="runway-look-type" class="text-[10px] uppercase tracking-[0.22em] font-semibold text-[#BA805E]">
                {{ $curatedLooks[0]['type_label'] }}
            </span>
            <h2 id="runway-look-title" class="font-serif text-xl sm:text-2xl font-bold text-neutral-950 mt-1">
                {{ $curatedLooks[0]['title'] }}
            </h2>
            <p id="runway-look-vibe" class="text-xs sm:text-sm text-neutral-600 max-w-lg mx-auto font-light leading-relaxed mt-1.5 mb-5">
                {{ $curatedLooks[0]['vibe'] }}
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a id="runway-look-btn" href="{{ $curatedLooks[0]['product_url'] }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.14em] text-white bg-neutral-950 hover:bg-[#BA805E] px-7 py-3 rounded-full shadow-sm hover:shadow-md transition-all duration-300 cursor-pointer">
                    <span>Lihat Detail Busana</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('shop.catalog') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-neutral-700 hover:text-[#BA805E] px-5 py-3 rounded-full bg-white border border-[#E5DCCF] hover:border-[#BA805E] transition-all duration-300">
                    <span>Jelajahi Katalog</span>
                </a>
            </div>
        </div>

    </section>

    <!-- SOFT SERVICE STRIP -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#F6F2EC] border border-[#EAE1D5] rounded-2xl px-5 py-4 grid grid-cols-2 md:grid-cols-4 gap-3 text-xs text-neutral-700 text-center md:text-left">
            <div class="font-medium text-neutral-900">Ready Stock Surabaya</div>
            <div class="font-medium text-neutral-900">Bahan Rayon &amp; Voal Sejuk</div>
            <div><a href="{{ route('shop.home') }}#fit-helper" class="hover:text-[#BA805E] transition-colors font-medium text-neutral-900">Panduan Panjang Outer &rarr;</a></div>
            <div class="md:text-right"><a href="{{ route('shop.returns') }}" class="hover:text-[#BA805E] transition-colors font-medium text-neutral-900">Garansi Tukar Ukuran 7 Hari &rarr;</a></div>
        </div>
    </section>

    <!-- SECTION E: KARTU SERI (Atelier Editorial Showcase) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-6 pb-3 border-b border-[#EAE1D5]">
            <div>
                <span class="text-[11px] uppercase tracking-[0.22em] text-[#BA805E] font-semibold">Koleksi Tematik</span>
                <h2 class="font-serif text-[clamp(1.5rem,3.5vw,2.25rem)] font-bold text-neutral-950 mt-0.5">
                    Seri &amp; Rilisan Eksklusif
                </h2>
            </div>
            <a href="{{ route('shop.catalog') }}" class="text-xs font-semibold text-neutral-800 hover:text-[#BA805E] transition-colors pb-0.5 border-b border-neutral-800 hover:border-[#BA805E] shrink-0">
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
                    <!-- Visual Model Frame -->
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
                            class="h-full w-auto max-w-full object-contain group-hover:scale-105 transition-transform duration-700 block relative z-0"
                        >
                    </div>

                    <!-- Editorial Content Section -->
                    <div class="p-4 sm:p-5 bg-white space-y-1.5 flex-1 flex flex-col justify-between border-t border-[#F2ECE3]">
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

    <!-- G2: PANDUAN PANJANG OUTER (Soft Modern Luxury Size Guide) -->
    <section id="fit-helper" class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="bg-white rounded-3xl border border-[#EAE1D5] p-6 sm:p-9 shadow-2xs">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                <!-- Left: Heading & Height Slider -->
                <div class="lg:col-span-6 space-y-5">
                    <div>
                        <span class="text-[11px] uppercase tracking-[0.2em] text-[#BA805E] font-semibold">Panduan Ukuran</span>
                        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-neutral-950 mt-1">
                            Cek Jatuh Panjang Outer
                        </h3>
                        <p class="text-xs sm:text-sm text-neutral-600 font-light mt-1.5 leading-relaxed">
                            Geser tinggi badan Anda untuk melihat estimasi jatuh ujung outer dan rekomendasi panjang yang paling pas.
                        </p>
                    </div>

                    <div class="bg-[#FAF8F5] rounded-2xl border border-[#EAE1D5] p-5 space-y-4">
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
                                <span class="font-serif text-xl sm:text-2xl font-bold text-[#BA805E]" id="fit-result-length">110 cm</span>
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
                                class="w-full h-2 bg-[#E8DEC9] rounded-full appearance-none cursor-pointer accent-[#BA805E]"
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
                            <button type="button" onclick="setFitSlider(152)" class="fit-btn px-3.5 py-1.5 rounded-full border border-[#E5DCCF] bg-white hover:border-neutral-900 font-medium transition-all text-neutral-700 cursor-pointer">
                                150–155 cm
                            </button>
                            <button type="button" onclick="setFitSlider(158)" class="fit-btn px-3.5 py-1.5 rounded-full border border-neutral-900 bg-neutral-900 text-white font-medium transition-all cursor-pointer">
                                156–160 cm
                            </button>
                            <button type="button" onclick="setFitSlider(163)" class="fit-btn px-3.5 py-1.5 rounded-full border border-[#E5DCCF] bg-white hover:border-neutral-900 font-medium transition-all text-neutral-700 cursor-pointer">
                                161–165 cm
                            </button>
                            <button type="button" onclick="setFitSlider(168)" class="fit-btn px-3.5 py-1.5 rounded-full border border-[#E5DCCF] bg-white hover:border-neutral-900 font-medium transition-all text-neutral-700 cursor-pointer">
                                166+ cm
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right: Soft Breakdown Card + Pill CTA -->
                <div class="lg:col-span-6 space-y-5">
                    <div class="rounded-2xl border border-[#EAE1D5] bg-[#FAF8F5]/60 divide-y divide-[#EAE1D5]/80 overflow-hidden">
                        <div class="p-4 sm:p-4.5 flex items-start justify-between gap-4">
                            <span class="text-xs uppercase tracking-wider text-neutral-500 shrink-0">Jatuh Baju</span>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-neutral-950" id="fit-insight-hemline">Midi Santun</p>
                                <p class="text-xs text-neutral-500 mt-0.5" id="fit-result-desc">Panjang midi ideal di pertengahan betis.</p>
                            </div>
                        </div>
                        <div class="p-4 sm:p-4.5 flex items-start justify-between gap-4">
                            <span class="text-xs uppercase tracking-wider text-neutral-500 shrink-0">Padanan Hijab</span>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-neutral-950" id="fit-insight-hijab">Voal 120x120</p>
                                <p class="text-xs text-neutral-500 mt-0.5">Menutup dada proporsional &amp; rapi.</p>
                            </div>
                        </div>
                        <div class="p-4 sm:p-4.5 flex items-start justify-between gap-4">
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
                            class="min-h-[44px] px-6 py-2.5 rounded-full bg-neutral-950 hover:bg-[#BA805E] text-white text-xs font-semibold uppercase tracking-[0.14em] transition-all duration-300 shadow-sm hover:shadow-md inline-flex items-center justify-center gap-2 shrink-0 cursor-pointer"
                        >
                            <span id="fit-cta-text">Lihat Outer (158 cm)</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION F: KOLEKSI TERPOPULER (Fluid Soft Editorial Grid) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-6 pb-3 border-b border-[#EAE1D5]">
            <div>
                <span class="text-[11px] uppercase tracking-[0.22em] text-[#BA805E] font-semibold">Pilihan Favorit</span>
                <h2 class="font-serif text-[clamp(1.5rem,3.5vw,2.25rem)] font-bold text-neutral-950 mt-0.5">
                    Koleksi Terpopuler
                </h2>
            </div>
            <a href="{{ route('shop.catalog') }}" class="text-xs font-semibold text-neutral-800 hover:text-[#BA805E] transition-colors pb-0.5 border-b border-neutral-800 hover:border-[#BA805E] shrink-0">
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
                    <!-- Soft Warm Editorial Frame -->
                    <div class="relative h-[240px] sm:h-[290px] rounded-2xl bg-gradient-to-b from-[#FAF8F5] to-[#F2ECE3] border border-[#EDE6DC] group-hover:border-[#D9C7B4] group-hover:shadow-md overflow-hidden flex items-center justify-center p-4 transition-all duration-300">
                        @if($product->is_preorder)
                            <span class="absolute top-3 left-3 text-[9px] uppercase tracking-[0.14em] font-semibold text-[#8A4F35] bg-white/90 px-2.5 py-0.5 rounded-full border border-[#E8DEC9] z-10">
                                Pre-Order
                            </span>
                        @endif

                        <img
                            src="{{ $product->primary_image }}"
                            alt="{{ $product->name }}"
                            loading="lazy"
                            class="{{ $isScarf ? 'w-auto max-h-[82%] object-contain rounded-xl' : 'h-full w-auto max-w-full object-contain' }} group-hover:scale-[1.04] transition-transform duration-500 block"
                        >
                    </div>

                    <!-- Clean Soft Caption -->
                    <div class="pt-3 px-0.5 space-y-1">
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

    <!-- SECTION H: SOFT EDITORIAL BRAND NOTE (#everydaymozera) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-[#F7F3ED] via-[#FAF8F5] to-[#F5EFE6] rounded-3xl border border-[#EAE1D5] p-7 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
            <div class="space-y-1.5 max-w-xl">
                <span class="text-[11px] uppercase tracking-[0.22em] text-[#BA805E] font-semibold">#everydaymozera</span>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-neutral-950">Nyaman Dipakai, Santun Dipandang.</h2>
                <p class="text-xs sm:text-sm text-neutral-600 font-light leading-relaxed">
                    Bagikan gaya harianmu bersama MOZÉRA di Instagram dan TikTok dengan menandai <strong class="font-medium text-neutral-900">@mozera.id</strong>.
                </p>
            </div>
            <a href="{{ route('shop.catalog') }}" class="min-h-[44px] shrink-0 inline-flex items-center justify-center px-7 py-3 rounded-full bg-neutral-950 hover:bg-[#BA805E] text-white text-xs font-semibold uppercase tracking-[0.14em] transition-all duration-300 shadow-sm hover:shadow-md">
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
