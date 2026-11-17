<!DOCTYPE html>
<html lang="id" class="h-full bg-[#FAF9F6] text-neutral-800 antialiased selection:bg-neutral-900 selection:text-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MOZÉRA — Timeless Modest Wear & Premium Outerwear')</title>
    <meta name="description" content="@yield('meta_description', 'Koleksi modest fashion wanita Indonesia: outerwear santun, scarf voal ultrafine, dan tiered dress bergaya casual-elegan. #everydaymozera')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen flex flex-col justify-between overflow-x-hidden bg-[#FAF9F6] text-[15px] sm:text-base leading-relaxed">

    <div>
        <!-- Top Announcement Bar (Single line, single message) -->
        <div class="bg-neutral-950 text-neutral-300 text-xs py-2 px-4 text-center font-medium tracking-wide">
            <span>Gratis Ongkir se-Indonesia untuk Pesanan Pertama • Gunakan Kode: <strong class="text-[#DCC3AD] font-semibold tracking-wider font-mono">MOZERAFIRST</strong></span>
        </div>

        <!-- Sticky Navigation Header (Max height 64px, never jumps) -->
        <header class="sticky top-0 z-50 bg-[#FAF9F6]/95 backdrop-blur-md border-b border-neutral-200/80 transition-all select-none">
            <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    
                    <!-- Mobile Hamburger Button (Min 44x44px touch target) -->
                    <div class="flex items-center lg:hidden">
                        <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" aria-label="Buka Menu" class="min-h-[44px] min-w-[44px] -ml-2 inline-flex items-center justify-center text-neutral-800 hover:text-neutral-950 cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>

                    <!-- Brand Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('shop.home') }}" class="flex flex-col cursor-pointer group py-1">
                            <span class="font-serif text-2xl sm:text-[26px] tracking-[0.18em] uppercase font-bold text-neutral-950 group-hover:text-neutral-700 transition-colors">MOZÉRA</span>
                            <span class="text-[9px] uppercase tracking-[0.28em] text-[#BA805E] -mt-1 font-semibold">Timeless Modest Wear</span>
                        </a>
                    </div>

                    <!-- Desktop Navigation Links (Max 4-5 focused items) -->
                    <nav class="hidden lg:flex items-center space-x-8 text-xs font-bold tracking-wider uppercase">
                        <a href="{{ route('shop.catalog') }}" class="text-neutral-700 hover:text-neutral-950 transition-colors py-2 cursor-pointer {{ request()->routeIs('shop.catalog') && !request('series') ? 'text-neutral-950 border-b-2 border-neutral-950' : '' }}">Koleksi</a>
                        <a href="{{ route('shop.home') }}#fit-helper" class="text-neutral-700 hover:text-neutral-950 transition-colors py-2 cursor-pointer">Panduan Ukuran</a>
                        <a href="{{ route('shop.returns') }}" class="text-neutral-700 hover:text-neutral-950 transition-colors py-2 cursor-pointer {{ request()->routeIs('shop.returns') ? 'text-neutral-950 border-b-2 border-neutral-950' : '' }}">Bantuan</a>
                    </nav>

                    <!-- Right Action Icons (Search, Cart - min 44x44px touch targets) -->
                    <div class="flex items-center space-x-1 sm:space-x-2">
                        <!-- Search Icon -->
                        <a href="{{ route('shop.catalog') }}" aria-label="Cari Produk" class="min-h-[44px] min-w-[44px] inline-flex items-center justify-center text-neutral-800 hover:text-[#BA805E] transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </a>

                        <!-- Shopping Cart -->
                        <a href="{{ route('shop.cart') }}" aria-label="Keranjang Belanja" class="relative min-h-[44px] min-w-[44px] inline-flex items-center justify-center text-neutral-800 hover:text-[#BA805E] transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            @php
                                $cartCount = 0;
                                if (session()->getId()) {
                                    $c = \App\Modules\Store\Models\Cart::where('session_id', session()->getId())->withCount('items')->first();
                                    $cartCount = $c ? $c->items_count : 0;
                                }
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute top-1.5 right-1.5 bg-[#BA805E] text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center shadow-sm">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div id="mobile-menu" class="hidden lg:hidden border-t border-neutral-200 bg-[#FAF9F6] px-5 py-5 space-y-4 shadow-lg">
                <div class="space-y-2 pb-3 border-b border-neutral-200">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#BA805E]">Menu Belanja</span>
                    <a href="{{ route('shop.catalog') }}" class="block text-sm font-semibold text-neutral-900 py-1.5 cursor-pointer">Seluruh Koleksi</a>
                    <a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="block text-sm text-neutral-700 py-1 cursor-pointer">Outerwear dan Kimono</a>
                    <a href="{{ route('shop.catalog', ['category' => 'scarf']) }}" class="block text-sm text-neutral-700 py-1 cursor-pointer">Voal Scarf 120x120</a>
                </div>

                <div class="space-y-2 pt-1 text-xs">
                    <a href="{{ route('shop.home') }}#fit-helper" class="block font-semibold text-neutral-800 py-1.5 cursor-pointer flex items-center gap-2">
                        <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <span>Panduan Ukuran (Fit Helper)</span>
                    </a>
                    <a href="{{ route('shop.tracking') }}" class="block font-semibold text-neutral-800 py-1.5 cursor-pointer flex items-center gap-2">
                        <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Lacak Pesanan Mandiri</span>
                    </a>
                    <a href="{{ route('shop.returns') }}" class="block font-semibold text-neutral-800 py-1.5 cursor-pointer flex items-center gap-2">
                        <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H4m0 0l3-3m-3 3l3 3"/></svg>
                        <span>Portal Retur dan Tukar Ukuran</span>
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="block font-semibold text-[#BA805E] py-1.5 cursor-pointer flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Portal Staf dan Admin</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Global Flash Alerts -->
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            @if(session('success'))
                <div class="mb-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <main class="w-full">
            @yield('content')
        </main>
    </div>

    <!-- Redesigned Footer (Clean 4-column, no technical jargon) -->
    <footer class="bg-neutral-950 text-neutral-300 mt-20 sm:mt-28 border-t border-neutral-900 select-none">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10 mb-12">
                <!-- Col 1: Brand Story -->
                <div class="space-y-4">
                    <div>
                        <span class="font-serif text-2xl tracking-[0.18em] uppercase font-bold text-white block">MOZÉRA</span>
                        <span class="text-[9px] uppercase tracking-[0.28em] text-[#BA805E] font-semibold block -mt-1">Timeless Modest Wear</span>
                    </div>
                    <p class="text-xs sm:text-[13px] text-neutral-400 leading-relaxed">
                        Busana modest wanita Indonesia bergaya casual-elegan. Menghadirkan siluet santun, material sejuk, dan keanggunan abadi untuk setiap hari Anda.
                    </p>
                    <div class="flex items-center gap-3 pt-1">
                        <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="Instagram MOZÉRA" class="w-8 h-8 rounded-full bg-neutral-900 hover:bg-[#BA805E] text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://tiktok.com" target="_blank" rel="noopener" aria-label="TikTok MOZÉRA" class="w-8 h-8 rounded-full bg-neutral-900 hover:bg-[#BA805E] text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 003 15.67 6.34 6.34 0 009.34 22a6.34 6.34 0 006.34-6.33V9.05a8.16 8.16 0 004.88 1.6v-3.5a4.85 4.85 0 01-.97-.46z"/></svg>
                        </a>
                        <span class="text-xs text-[#BA805E] font-bold font-mono">#everydaymozera</span>
                    </div>
                </div>

                <!-- Col 2: Koleksi -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-neutral-100 mb-3.5">Koleksi Busana</h4>
                    <ul class="space-y-2.5 text-xs sm:text-[13px] text-neutral-400">
                        <li><a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="hover:text-white transition-colors cursor-pointer">Outerwear dan Kimono</a></li>
                        <li><a href="{{ route('shop.catalog', ['category' => 'scarf']) }}" class="hover:text-white transition-colors cursor-pointer">Voal Ultrafine Scarf 120x120</a></li>
                        <li><a href="{{ route('shop.catalog', ['series' => 'PUSPA']) }}" class="hover:text-white transition-colors cursor-pointer">Seri PUSPA Koleksi</a></li>
                        <li><a href="{{ route('shop.catalog', ['series' => 'ISLA']) }}" class="hover:text-white transition-colors cursor-pointer">Seri ISLA Koleksi</a></li>
                        <li><a href="{{ route('shop.catalog', ['series' => 'SEPT_DROPS']) }}" class="hover:text-white transition-colors cursor-pointer">Sept Drops Eksklusif</a></li>
                    </ul>
                </div>

                <!-- Col 3: Layanan Pelanggan -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-neutral-100 mb-3.5">Bantuan dan Layanan</h4>
                    <ul class="space-y-2.5 text-xs sm:text-[13px] text-neutral-400">
                        <li><a href="{{ route('shop.tracking') }}" class="hover:text-white transition-colors cursor-pointer">Lacak Status Pesanan</a></li>
                        <li><a href="{{ route('shop.returns') }}" class="hover:text-white transition-colors cursor-pointer">Portal Retur dan Tukar Ukuran</a></li>
                        <li><a href="{{ route('shop.home') }}#fit-helper" class="hover:text-white transition-colors cursor-pointer">Panduan Ukuran (Fit Helper)</a></li>
                        <li><a href="{{ route('shop.returns') }}" class="hover:text-white transition-colors cursor-pointer">Kebijakan Garansi 7 Hari</a></li>
                        <li><a href="{{ route('admin.dashboard') }}" class="text-[#DCC3AD] hover:underline transition-colors cursor-pointer">Akses Portal Staf dan Gudang &rarr;</a></li>
                    </ul>
                </div>

                <!-- Col 4: Pembayaran & Pengiriman -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-neutral-100 mb-3.5">Metode Pembayaran</h4>
                    <p class="text-xs sm:text-[13px] text-neutral-400 leading-relaxed mb-3">
                        Transaksi aman dan instan didukung QRIS, Virtual Account bank nasional, dan kartu debit/kredit.
                    </p>
                    <div class="flex flex-wrap items-center gap-1.5 text-[11px] font-mono text-neutral-300">
                        <span class="px-2 py-1 rounded bg-neutral-900 border border-neutral-800">QRIS</span>
                        <span class="px-2 py-1 rounded bg-neutral-900 border border-neutral-800">BCA VA</span>
                        <span class="px-2 py-1 rounded bg-neutral-900 border border-neutral-800">Mandiri</span>
                        <span class="px-2 py-1 rounded bg-neutral-900 border border-neutral-800">BNI</span>
                        <span class="px-2 py-1 rounded bg-neutral-900 border border-neutral-800">GoPay</span>
                        <span class="px-2 py-1 rounded bg-neutral-900 border border-neutral-800">ShopeePay</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & Policies -->
            <div class="pt-6 border-t border-neutral-900 flex flex-col sm:flex-row items-center justify-between text-xs text-neutral-400 gap-3">
                <span>&copy; {{ date('Y') }} MOZÉRA. Seluruh hak cipta dilindungi.</span>
                <div class="flex items-center gap-4 text-xs">
                    <a href="{{ route('shop.returns') }}" class="hover:text-white transition-colors">Kebijakan Retur</a>
                    <span>&bull;</span>
                    <a href="{{ route('shop.catalog') }}" class="hover:text-white transition-colors">Syarat dan Ketentuan</a>
                    <span>&bull;</span>
                    <span class="text-neutral-500">Jakarta dan Surabaya, Indonesia</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
