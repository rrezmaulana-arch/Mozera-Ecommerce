@extends('layouts.shop')

@section('title', 'MOZÉRA — Timeless Modest Wear & Premium Outerwear')
@section('meta_description', 'Koleksi modest fashion wanita Indonesia: outerwear santun, voal scarf ultrafine, dan tiered dress casual-elegan. #everydaymozera')

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
                            alt="Model Modest Outer Layering MOZÉRA" 
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

    <!-- G1: INTERACTIVE ATASAN RUNWAY ("Try The Look" & Virtual Hanger Studio) -->
    <section id="try-the-look" class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-4 border-b border-neutral-200">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FAF8F5] border border-[#BA805E]/30 text-[#BA805E] text-xs font-bold uppercase tracking-wider mb-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E] animate-pulse"></span>
                    <span>Virtual Styling Runway</span>
                </div>
                <h2 class="font-serif text-[clamp(1.6rem,3.8vw,2.5rem)] font-bold text-neutral-950 leading-tight">
                    Try The Look — Padu-Padan Atasan Pilihan
                </h2>
                <p class="text-xs sm:text-sm text-neutral-600 mt-1 max-w-2xl">
                    Geser inspirasi busana untuk melihat siluet jatuh atasan modest di tubuh model, atau klik detail atasan untuk melihatnya tergantung di studio.
                </p>
            </div>
            
            <!-- Quick Look Tabs (Desktop) -->
            <div class="hidden lg:flex items-center gap-1.5 bg-[#F5EFEB] p-1.5 rounded-2xl border border-neutral-200/80 text-xs font-bold shrink-0 mt-4 md:mt-0">
                @foreach($curatedLooks as $idx => $look)
                    <button 
                        type="button" 
                        onclick="switchLook({{ $idx }})" 
                        id="look-tab-{{ $idx }}" 
                        class="look-tab-btn px-4 py-2 rounded-xl transition-all cursor-pointer {{ $idx === 0 ? 'bg-neutral-900 text-white shadow-xs' : 'text-neutral-600 hover:text-neutral-950' }}"
                    >
                        {{ $look['title'] }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Main Stage Container: 3D Runway (Left/Center) + Dynamic "In This Look" Sidebar (Right) -->
        <div class="bg-[#FAF8F5] border border-[#EADCCE] rounded-3xl p-4 sm:p-6 lg:p-8 shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                
                <!-- Left/Center Stage: Desktop 3D Runway + Mobile Horizontal Swipe -->
                <div class="lg:col-span-7 flex flex-col items-center">
                    
                    <!-- DESKTOP 3D PERSPECTIVE RUNWAY (Visible on lg+) -->
                    <div class="hidden lg:block relative w-full h-[520px] overflow-hidden rounded-2xl bg-gradient-to-b from-[#F5EFEB]/50 to-[#EADCCE]/30 border border-neutral-200/60 p-4">
                        <div class="relative w-full h-full flex items-center justify-center perspective-[1200px]" id="runway-stage">
                            @foreach($curatedLooks as $idx => $look)
                                <div 
                                    id="desktop-model-{{ $idx }}" 
                                    onclick="switchLook({{ $idx }})"
                                    class="desktop-model-card absolute inset-y-6 w-[280px] rounded-2xl overflow-hidden shadow-xl transition-all duration-700 ease-out cursor-pointer group"
                                    style="transform-style: preserve-3d;"
                                >
                                    <img 
                                        src="{{ $look['model_image'] }}" 
                                        alt="{{ $look['title'] }} — Model Modest MOZÉRA" 
                                        class="w-full h-full object-cover block"
                                    >
                                    <!-- Subtle dark overlay on hover / inactive -->
                                    <div class="model-overlay absolute inset-0 bg-neutral-950/20 transition-opacity"></div>
                                    
                                    <!-- Tag & Click Prompt -->
                                    <div class="absolute bottom-4 inset-x-4 flex items-center justify-between text-white drop-shadow-md">
                                        <span class="text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-full bg-neutral-950/75 backdrop-blur-md">
                                            {{ $look['tag'] }}
                                        </span>
                                        <span class="active-badge hidden text-[11px] font-bold px-2 py-0.5 rounded-full bg-[#BA805E] text-white">
                                            Aktif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Previous / Next Floating Arrows (Desktop) -->
                        <button 
                            type="button" 
                            onclick="prevLook()" 
                            aria-label="Look Sebelumnya" 
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 hover:bg-neutral-950 hover:text-white text-neutral-800 shadow-md backdrop-blur-md flex items-center justify-center transition-all cursor-pointer z-30"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button 
                            type="button" 
                            onclick="nextLook()" 
                            aria-label="Look Berikutnya" 
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 hover:bg-neutral-950 hover:text-white text-neutral-800 shadow-md backdrop-blur-md flex items-center justify-center transition-all cursor-pointer z-30"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                    <!-- MOBILE TOUCH-SNAP RUNWAY (Visible on < lg) -->
                    <div class="lg:hidden w-full space-y-3">
                        <div 
                            id="mobile-runway-carousel" 
                            class="flex overflow-x-auto snap-x snap-mandatory gap-3.5 -mx-4 px-4 pb-2 pt-1 custom-scrollbar scroll-smooth"
                        >
                            @foreach($curatedLooks as $idx => $look)
                                <div 
                                    id="mobile-model-{{ $idx }}" 
                                    onclick="switchLook({{ $idx }})" 
                                    class="mobile-model-card w-[78vw] max-w-[300px] shrink-0 snap-center aspect-[3/4] rounded-2xl overflow-hidden relative shadow-md border-2 border-transparent transition-all cursor-pointer"
                                >
                                    <img 
                                        src="{{ $look['model_image'] }}" 
                                        alt="{{ $look['title'] }} — Modest Look MOZÉRA" 
                                        class="w-full h-full object-cover block"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-neutral-950/80 via-transparent to-transparent"></div>
                                    <div class="absolute bottom-3 left-3 right-3 text-white">
                                        <span class="text-[9px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full bg-white/20 backdrop-blur-md text-[#DCC3AD]">
                                            {{ $look['tag'] }}
                                        </span>
                                        <h4 class="font-serif font-bold text-base mt-1 line-clamp-1">{{ $look['title'] }}</h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Mobile Pagination Indicators -->
                        <div class="flex items-center justify-center gap-1.5 pt-1">
                            @foreach($curatedLooks as $idx => $look)
                                <button 
                                    type="button" 
                                    onclick="switchLook({{ $idx }})" 
                                    id="mobile-dot-{{ $idx }}" 
                                    class="mobile-dot w-2 h-2 rounded-full transition-all cursor-pointer {{ $idx === 0 ? 'w-6 bg-[#BA805E]' : 'bg-neutral-300' }}"
                                    aria-label="Pilih Look {{ $idx + 1 }}"
                                ></button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Runway Bottom Status Bar: Occasion & Look Description -->
                    <div class="w-full mt-4 p-3.5 rounded-xl bg-white border border-neutral-200/80 flex items-center justify-between text-xs gap-3">
                        <div class="flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-[#BA805E]"></span>
                            <div>
                                <span class="font-bold text-neutral-900" id="look-status-title">{{ $curatedLooks[0]['title'] }}</span>
                                <span class="text-neutral-400 hidden sm:inline">•</span>
                                <span class="text-neutral-500 block sm:inline mt-0.5 sm:mt-0" id="look-status-vibe">{{ $curatedLooks[0]['vibe'] }}</span>
                            </div>
                        </div>
                        <span class="text-[11px] font-mono font-bold text-[#BA805E] shrink-0" id="look-counter-indicator">
                            01 / {{ sprintf('%02d', count($curatedLooks)) }}
                        </span>
                    </div>
                </div>

                <!-- Right Sticky Panel: "In This Look" Items & 1-Click Bundle Checkout -->
                <div class="lg:col-span-5 space-y-4">
                    
                    <!-- Panel Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-neutral-200">
                        <div>
                            <span class="text-[10px] uppercase tracking-[0.2em] font-bold text-[#BA805E]">Kelengkapan Set</span>
                            <h3 class="font-serif text-xl sm:text-2xl font-bold text-neutral-950 mt-0.5" id="panel-look-title">
                                {{ $curatedLooks[0]['title'] }}
                            </h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-full bg-[#BA805E]/15 text-[#BA805E] text-[11px] font-bold font-mono">
                            Diskon 10% Set
                        </span>
                    </div>

                    <!-- Dynamic Look Items List -->
                    @foreach($curatedLooks as $idx => $look)
                        <div id="look-items-panel-{{ $idx }}" class="look-items-container space-y-3 {{ $idx === 0 ? 'block' : 'hidden' }}">
                            
                            <!-- ITEM 1: HERO ATASAN / OUTER (With Virtual Hanger Quick Trigger) -->
                            <div class="p-3.5 rounded-2xl bg-white border border-neutral-200/90 hover:border-[#BA805E] transition-all shadow-2xs space-y-3">
                                <div class="flex items-start gap-3">
                                    <div class="relative w-16 h-20 rounded-xl overflow-hidden bg-[#F5EFEB] shrink-0">
                                        <img 
                                            src="{{ $look['hero_product']->primary_image }}" 
                                            alt="{{ $look['hero_product']->name }}" 
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="text-[10px] uppercase font-bold text-[#BA805E] tracking-wider block">
                                            {{ $look['hero_role'] }}
                                        </span>
                                        <h4 class="font-serif font-bold text-neutral-950 text-sm leading-snug truncate mt-0.5">
                                            {{ $look['hero_product']->name }}
                                        </h4>
                                        <p class="text-[11px] text-neutral-500 line-clamp-1 mt-0.5">
                                            {{ $look['hero_sku']?->color ? 'Warna ' . $look['hero_sku']->color . ' • ' : '' }} {{ $look['hero_product']->material }}
                                        </p>
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="font-bold text-sm font-mono text-neutral-950">
                                                {{ \App\Modules\Shared\Money\Money::format($look['hero_sku']?->price_idr ?? 389000) }}
                                            </span>
                                            <!-- Open Hanger Modal Button -->
                                            <button 
                                                type="button" 
                                                onclick="openHangerModal({{ $idx }})" 
                                                class="px-2.5 py-1 rounded-lg bg-[#FAF8F5] hover:bg-neutral-950 hover:text-white border border-neutral-300 text-neutral-800 text-[11px] font-bold transition-all flex items-center gap-1 cursor-pointer"
                                            >
                                                <span>🔍 Cek di Hanger</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ITEM 2: COMPLEMENTARY ITEM (Scarf / Inner) -->
                            <div class="p-3.5 rounded-2xl bg-white border border-neutral-200/90 hover:border-[#BA805E] transition-all shadow-2xs">
                                <div class="flex items-start gap-3">
                                    <div class="relative w-16 h-20 rounded-xl overflow-hidden bg-[#F5EFEB] shrink-0">
                                        <img 
                                            src="{{ $look['secondary_product']->primary_image }}" 
                                            alt="{{ $look['secondary_product']->name }}" 
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="text-[10px] uppercase font-bold text-neutral-500 tracking-wider block">
                                            {{ $look['secondary_role'] }}
                                        </span>
                                        <h4 class="font-serif font-bold text-neutral-950 text-sm leading-snug truncate mt-0.5">
                                            {{ $look['secondary_product']->name }}
                                        </h4>
                                        <p class="text-[11px] text-neutral-500 line-clamp-1 mt-0.5">
                                            {{ $look['secondary_sku']?->color ? 'Varian ' . $look['secondary_sku']->color : 'Material Voal Lembut' }}
                                        </p>
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="font-bold text-sm font-mono text-neutral-950">
                                                {{ \App\Modules\Shared\Money\Money::format($look['secondary_sku']?->price_idr ?? 149000) }}
                                            </span>
                                            <a 
                                                href="{{ route('shop.product', $look['secondary_product']->slug) }}" 
                                                class="text-[11px] font-bold text-neutral-600 hover:text-[#BA805E] transition-colors"
                                            >
                                                Lihat Produk &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $priceHero = $look['hero_sku']?->price_idr ?? 389000;
                                $priceSecondary = $look['secondary_sku']?->price_idr ?? 149000;
                                $subtotalNormal = $priceHero + $priceSecondary;
                                $discountAmount = (int) round($subtotalNormal * 0.10);
                                $bundleTotal = $subtotalNormal - $discountAmount;
                            @endphp

                            <!-- BUNDLE SUMMARY & 1-CLICK ACTION -->
                            <div class="p-4 rounded-2xl bg-white border border-[#EADCCE] space-y-3 mt-4">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-neutral-500">Harga Satuan Terpisah:</span>
                                    <span class="font-mono text-neutral-400 line-through">
                                        {{ \App\Modules\Shared\Money\Money::format($subtotalNormal) }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-neutral-700 font-medium">Diskon Paket Hemat (10%):</span>
                                    <span class="font-mono font-bold text-emerald-600">
                                        - {{ \App\Modules\Shared\Money\Money::format($discountAmount) }}
                                    </span>
                                </div>
                                <div class="pt-2 border-t border-neutral-100 flex items-center justify-between">
                                    <div>
                                        <span class="text-[10px] text-neutral-500 uppercase tracking-wider block">Total 1 Set Lengkap:</span>
                                        <span class="font-bold text-lg font-mono text-[#BA805E]">
                                            {{ \App\Modules\Shared\Money\Money::format($bundleTotal) }}
                                        </span>
                                    </div>
                                    <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                        Stok Tersedia
                                    </span>
                                </div>

                                <!-- Form 1-Klik Tambah Bundle Look ke Keranjang -->
                                <form action="{{ route('shop.cart.add-bundle') }}" method="POST" class="pt-1">
                                    @csrf
                                    <input type="hidden" name="sku_ids[]" value="{{ $look['hero_sku']?->id }}">
                                    <input type="hidden" name="sku_ids[]" value="{{ $look['secondary_sku']?->id }}">
                                    <input type="hidden" name="bundle_title" value="Set {{ $look['title'] }}">
                                    
                                    <button 
                                        type="submit" 
                                        class="w-full min-h-[46px] px-6 py-3 bg-neutral-950 hover:bg-[#BA805E] text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        <span>Beli 1 Look Lengkap (2 Busana)</span>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </section>

    <!-- FLOATING WOODEN HANGER MODAL (Virtual Garment Studio Drill-Down) -->
    <div 
        id="hanger-modal" 
        class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-neutral-950/70 backdrop-blur-md transition-opacity duration-300"
        role="dialog" 
        aria-modal="true"
    >
        <div 
            class="relative w-full max-w-3xl bg-[#FAF9F6] rounded-3xl border border-neutral-200 shadow-2xl overflow-hidden transition-all transform scale-95 opacity-0" 
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
                
                <!-- Left Column: The Floating Garment on Wooden Hanger -->
                <div class="md:col-span-6 flex flex-col items-center justify-center bg-white rounded-2xl border border-neutral-200/80 p-6 relative min-h-[360px]">
                    <!-- Stylized Wooden Hanger Graphic Header -->
                    <div class="w-24 h-4 border-t-4 border-amber-800 rounded-t-full mb-1 opacity-80"></div>
                    
                    <div class="relative w-full aspect-[3/4] max-h-[320px] overflow-hidden rounded-xl">
                        <img 
                            id="hanger-modal-img" 
                            src="" 
                            alt="Detail Busana di Hanger" 
                            class="w-full h-full object-contain filter drop-shadow-lg transition-transform duration-500"
                        >
                    </div>

                    <!-- Front / Back Angle Switcher -->
                    <div class="flex items-center gap-2 mt-4 text-[11px] font-bold">
                        <button 
                            type="button" 
                            id="hanger-angle-front" 
                            onclick="setHangerAngle('front')" 
                            class="px-3 py-1 rounded-full bg-neutral-900 text-white cursor-pointer"
                        >
                            Tampak Depan
                        </button>
                        <button 
                            type="button" 
                            id="hanger-angle-back" 
                            onclick="setHangerAngle('back')" 
                            class="px-3 py-1 rounded-full bg-neutral-100 text-neutral-700 hover:bg-neutral-200 cursor-pointer"
                        >
                            Tampak Belakang
                        </button>
                    </div>
                </div>

                <!-- Right Column: Specifications, Fit & Direct Cart Form -->
                <div class="md:col-span-6 space-y-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] uppercase font-bold text-[#BA805E] tracking-wider" id="hanger-modal-category">
                                Outerwear Modest
                            </span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Siap Kirim
                            </span>
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-neutral-950 mt-1" id="hanger-modal-title">
                            Nama Atasan
                        </h3>
                        <p class="font-serif text-xl font-bold text-[#BA805E] mt-1 font-mono" id="hanger-modal-price">
                            Rp 0
                        </p>
                    </div>

                    <!-- Material & Fit Helper Info -->
                    <div class="space-y-2 text-xs text-neutral-600 bg-[#FAF8F5] p-3.5 rounded-xl border border-[#EADCCE]">
                        <div class="flex items-start gap-2">
                            <span class="font-bold text-neutral-900 shrink-0">Bahan:</span>
                            <span id="hanger-modal-material">-</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="font-bold text-neutral-900 shrink-0">Panjang:</span>
                            <span id="hanger-modal-length">-</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="font-bold text-neutral-900 shrink-0">Siluet:</span>
                            <span>Jatuh anggun santun, wudhu-friendly, tidak menerawang.</span>
                        </div>
                    </div>

                    <!-- Direct Add To Cart Form -->
                    <form action="{{ route('shop.cart.add') }}" method="POST" class="space-y-3 pt-1">
                        @csrf
                        <input type="hidden" name="sku_id" id="hanger-modal-sku-id" value="">
                        
                        <div>
                            <label class="text-[11px] font-bold text-neutral-700 block mb-1.5 uppercase tracking-wider">
                                Pilihan Ukuran:
                            </label>
                            <div class="flex items-center gap-2">
                                <span class="px-3.5 py-1.5 rounded-lg border border-neutral-900 bg-neutral-900 text-white text-xs font-bold font-mono">
                                    All Size (Fit S – XL)
                                </span>
                            </div>
                        </div>

                        <div class="pt-2 flex items-center gap-2">
                            <button 
                                type="submit" 
                                class="flex-1 min-h-[46px] px-6 py-3 bg-[#BA805E] hover:bg-[#a66f4e] text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                <span>Tambah Atasan ke Bag</span>
                            </button>
                            <a 
                                id="hanger-modal-product-link" 
                                href="#" 
                                class="min-h-[46px] px-4 py-3 rounded-xl border border-neutral-300 hover:border-neutral-900 text-neutral-800 text-xs font-bold transition-colors flex items-center justify-center shrink-0"
                            >
                                Detail &rarr;
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- JAVASCRIPT: Runway Stage 3D Perspective + Synchronization + Hanger Modal -->
    <script>
        (function() {
            const looks = @json($curatedLooks);
            let currentLookIdx = 0;

            window.switchLook = function(idx) {
                if (idx < 0 || idx >= looks.length) return;
                currentLookIdx = idx;

                // 1. Update Desktop Runway Models Positioning (3D Perspective Math)
                looks.forEach((_, i) => {
                    const card = document.getElementById(`desktop-model-${i}`);
                    if (!card) return;

                    const diff = i - currentLookIdx;
                    const overlay = card.querySelector('.model-overlay');
                    const badge = card.querySelector('.active-badge');

                    if (diff === 0) {
                        // Center Active Model
                        card.style.transform = 'translateX(0px) scale(1.04) rotateY(0deg)';
                        card.style.zIndex = '30';
                        card.style.opacity = '1';
                        card.style.filter = 'none';
                        if (overlay) overlay.style.opacity = '0';
                        if (badge) badge.classList.remove('hidden');
                    } else if (diff === -1 || (currentLookIdx === 0 && i === looks.length - 1 && looks.length > 2)) {
                        // Left Flanking Model
                        card.style.transform = 'translateX(-190px) scale(0.88) rotateY(16deg)';
                        card.style.zIndex = '20';
                        card.style.opacity = '0.72';
                        card.style.filter = 'blur(0.5px)';
                        if (overlay) overlay.style.opacity = '0.35';
                        if (badge) badge.classList.add('hidden');
                    } else if (diff === 1 || (currentLookIdx === looks.length - 1 && i === 0 && looks.length > 2)) {
                        // Right Flanking Model
                        card.style.transform = 'translateX(190px) scale(0.88) rotateY(-16deg)';
                        card.style.zIndex = '20';
                        card.style.opacity = '0.72';
                        card.style.filter = 'blur(0.5px)';
                        if (overlay) overlay.style.opacity = '0.35';
                        if (badge) badge.classList.add('hidden');
                    } else {
                        // Out of primary focus
                        const offset = diff > 0 ? 320 : -320;
                        card.style.transform = `translateX(${offset}px) scale(0.75) rotateY(${diff > 0 ? -26 : 26}deg)`;
                        card.style.zIndex = '10';
                        card.style.opacity = '0.25';
                        card.style.filter = 'blur(1.5px)';
                        if (overlay) overlay.style.opacity = '0.6';
                        if (badge) badge.classList.add('hidden');
                    }
                });

                // 2. Update Desktop Tabs
                document.querySelectorAll('.look-tab-btn').forEach((btn, i) => {
                    if (i === currentLookIdx) {
                        btn.className = 'look-tab-btn px-4 py-2 rounded-xl transition-all cursor-pointer bg-neutral-900 text-white shadow-xs';
                    } else {
                        btn.className = 'look-tab-btn px-4 py-2 rounded-xl transition-all cursor-pointer text-neutral-600 hover:text-neutral-950';
                    }
                });

                // 3. Update Mobile Carousel Scroll & Dots
                const mobileCard = document.getElementById(`mobile-model-${currentLookIdx}`);
                const mobileCarousel = document.getElementById('mobile-runway-carousel');
                if (mobileCard && mobileCarousel) {
                    mobileCarousel.scrollTo({
                        left: mobileCard.offsetLeft - 24,
                        behavior: 'smooth'
                    });
                }
                document.querySelectorAll('.mobile-dot').forEach((dot, i) => {
                    if (i === currentLookIdx) {
                        dot.className = 'mobile-dot w-6 h-2 rounded-full bg-[#BA805E] transition-all cursor-pointer';
                    } else {
                        dot.className = 'mobile-dot w-2 h-2 rounded-full bg-neutral-300 transition-all cursor-pointer';
                    }
                });

                // 4. Update Bottom Status Bar
                const look = looks[currentLookIdx];
                const statusTitle = document.getElementById('look-status-title');
                const statusVibe = document.getElementById('look-status-vibe');
                const counter = document.getElementById('look-counter-indicator');
                const panelTitle = document.getElementById('panel-look-title');

                if (statusTitle) statusTitle.textContent = look.title;
                if (statusVibe) statusVibe.textContent = look.vibe;
                if (counter) counter.textContent = `0${currentLookIdx + 1} / 0${looks.length}`;
                if (panelTitle) panelTitle.textContent = look.title;

                // 5. Update Right Items Panel
                document.querySelectorAll('.look-items-container').forEach((el, i) => {
                    if (i === currentLookIdx) {
                        el.classList.remove('hidden');
                        el.classList.add('block');
                    } else {
                        el.classList.remove('block');
                        el.classList.add('hidden');
                    }
                });
            };

            window.nextLook = function() {
                const nextIdx = (currentLookIdx + 1) % looks.length;
                switchLook(nextIdx);
            };

            window.prevLook = function() {
                const prevIdx = (currentLookIdx - 1 + looks.length) % looks.length;
                switchLook(prevIdx);
            };

            // HANGER MODAL LOGIC
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

            // ESC key to close modal
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeHangerModal();
            });

            // Initialize look on DOM ready
            document.addEventListener('DOMContentLoaded', function() {
                switchLook(0);
            });
            // Also call switchLook(0) immediately in case script runs after load
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

    <!-- SECTION H: KOMUNITAS #everydaymozera (6 photos 1/1 desktop, 3x2 mobile, Max 180px per side) -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#F5EFEB]/50 rounded-3xl border border-neutral-200/80 p-6 sm:p-10 text-center space-y-4">
            <span class="inline-block text-[11px] font-bold uppercase tracking-[0.25em] text-[#BA805E]">Komunitas Cerita</span>
            <h2 class="font-serif text-[clamp(1.5rem,3.5vw,2.25rem)] font-bold text-neutral-950">#everydaymozera</h2>
            <p class="text-neutral-600 text-xs sm:text-sm max-w-xl mx-auto leading-relaxed">
                Cerita hangat wanita Indonesia merayakan keanggunan dan kenyamanan pakaian modest setiap hari. Tag <strong>@mozera.id</strong> untuk tampil di sini.
            </p>

            <!-- UGC Photo Grid: 6 photos (6 cols desktop, 3x2 mobile, max 180px each) -->
            <div class="grid grid-cols-3 sm:grid-cols-6 gap-2.5 sm:gap-3.5 pt-3">
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80" alt="Pelanggan MOZÉRA UGC 1" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&q=80" alt="Pelanggan MOZÉRA UGC 2" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&q=80" alt="Pelanggan MOZÉRA UGC 3" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=400&q=80" alt="Pelanggan MOZÉRA UGC 4" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&q=80" alt="Pelanggan MOZÉRA UGC 5" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="aspect-square max-h-[180px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=400&q=80" alt="Pelanggan MOZÉRA UGC 6" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
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
