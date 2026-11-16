<!DOCTYPE html>
<html lang="id" class="h-full bg-[#FAF9F6] text-neutral-800 antialiased selection:bg-neutral-900 selection:text-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ITSFRIDAY — Timeless Modest Wear & Outerwear')</title>
    <meta name="description" content="@yield('meta_description', 'Koleksi outerwear, scarf, dan dress premium dengan siluet effortless chic. #everydayitsfriday')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen flex flex-col justify-between overflow-x-hidden bg-[#FAF9F6]">

    <div>
        <!-- Top Announcement Bar -->
        <div class="bg-neutral-950 text-neutral-300 text-[11px] sm:text-xs py-2 px-4 text-center font-medium tracking-wide flex items-center justify-center gap-2 sm:gap-3 select-none">
            <span>Worldwide Shipping</span>
            <span class="text-neutral-600">&bull;</span>
            <span>Gunakan kode voucher: <strong class="text-brand-300 font-semibold tracking-wider font-mono">EVERYDAYFRIDAY</strong> untuk diskon 10%</span>
            <span class="text-neutral-600 hidden sm:inline">&bull;</span>
            <a href="{{ route('shop.tracking') }}" class="underline hover:text-white hidden sm:inline cursor-pointer transition-colors">Lacak Pesanan</a>
        </div>

        <!-- Navigation Header -->
        <header class="sticky top-0 z-40 bg-[#FAF9F6]/95 backdrop-blur-md border-b border-neutral-200/70 transition-all select-none">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Mobile Menu Button -->
                    <div class="flex items-center lg:hidden">
                        <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="p-2 text-neutral-700 hover:text-neutral-900 cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>

                    <!-- Brand Logo -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('shop.home') }}" class="flex flex-col cursor-pointer group">
                            <span class="font-serif text-2xl sm:text-3xl tracking-widest uppercase font-bold text-neutral-950 group-hover:text-neutral-700 transition-colors">ITSFRIDAY</span>
                            <span class="text-[9px] uppercase tracking-[0.28em] text-neutral-500 -mt-1 font-medium">Everyday is Friday</span>
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <nav class="hidden lg:flex items-center space-x-7 text-xs font-semibold tracking-wider uppercase">
                        <a href="{{ route('shop.catalog') }}" class="text-neutral-700 hover:text-neutral-950 transition-colors py-1 cursor-pointer {{ request()->routeIs('shop.catalog') && !request('series') ? 'text-neutral-950 border-b-2 border-neutral-950' : '' }}">Semua Koleksi</a>
                        <a href="{{ route('shop.catalog', ['series' => 'PUSPA']) }}" class="text-neutral-700 hover:text-neutral-950 transition-colors py-1 cursor-pointer {{ request('series') == 'PUSPA' ? 'text-neutral-950 border-b-2 border-neutral-950' : '' }}">Seri PUSPA</a>
                        <a href="{{ route('shop.catalog', ['series' => 'ISLA']) }}" class="text-neutral-700 hover:text-neutral-950 transition-colors py-1 cursor-pointer {{ request('series') == 'ISLA' ? 'text-neutral-950 border-b-2 border-neutral-950' : '' }}">Seri ISLA</a>
                        <a href="{{ route('shop.catalog', ['series' => 'SEPT_DROPS']) }}" class="text-neutral-700 hover:text-neutral-950 transition-colors py-1 cursor-pointer {{ request('series') == 'SEPT_DROPS' ? 'text-neutral-950 border-b-2 border-neutral-950' : '' }}">Sept Drops</a>
                        <a href="{{ route('shop.tracking') }}" class="text-neutral-700 hover:text-neutral-950 transition-colors py-1 cursor-pointer {{ request()->routeIs('shop.tracking') ? 'text-neutral-950 border-b-2 border-neutral-950' : '' }}">Lacak Pesanan</a>
                        <a href="{{ route('shop.returns') }}" class="text-neutral-700 hover:text-neutral-950 transition-colors py-1 cursor-pointer {{ request()->routeIs('shop.returns') ? 'text-neutral-950 border-b-2 border-neutral-950' : '' }}">Retur Mandiri</a>
                    </nav>

                    <!-- Right Actions: Admin portal, Cart -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="hidden md:inline-flex items-center gap-1.5 text-[11px] font-semibold px-3 py-1.5 rounded-full bg-neutral-100 hover:bg-neutral-200 text-neutral-700 border border-neutral-300/80 cursor-pointer transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Portal Staf</span>
                        </a>

                        <a href="{{ route('shop.cart') }}" class="relative p-2 text-neutral-800 hover:text-neutral-950 transition-colors cursor-pointer" title="Keranjang Belanja">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            @php
                                $cartCount = 0;
                                if (session()->getId()) {
                                    $c = \App\Modules\Store\Models\Cart::where('session_id', session()->getId())->withCount('items')->first();
                                    $cartCount = $c ? $c->items_count : 0;
                                }
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute top-0.5 right-0.5 bg-neutral-900 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center animate-pulse">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden lg:hidden border-t border-neutral-200 bg-[#FAF9F6] px-5 pt-3 pb-6 space-y-3">
                <a href="{{ route('shop.catalog') }}" class="block text-sm font-semibold text-neutral-800 hover:text-neutral-950 py-1.5 cursor-pointer">Semua Koleksi</a>
                <a href="{{ route('shop.catalog', ['series' => 'PUSPA']) }}" class="block text-sm font-semibold text-neutral-800 hover:text-neutral-950 py-1.5 cursor-pointer">Seri PUSPA</a>
                <a href="{{ route('shop.catalog', ['series' => 'ISLA']) }}" class="block text-sm font-semibold text-neutral-800 hover:text-neutral-950 py-1.5 cursor-pointer">Seri ISLA</a>
                <a href="{{ route('shop.catalog', ['series' => 'SEPT_DROPS']) }}" class="block text-sm font-semibold text-neutral-800 hover:text-neutral-950 py-1.5 cursor-pointer">Sept Drops</a>
                <a href="{{ route('shop.tracking') }}" class="block text-sm font-semibold text-neutral-800 hover:text-neutral-950 py-1.5 cursor-pointer">Lacak Pesanan Mandiri</a>
                <a href="{{ route('shop.returns') }}" class="block text-sm font-semibold text-neutral-800 hover:text-neutral-950 py-1.5 cursor-pointer">Pengajuan Retur Mandiri</a>
                <a href="{{ route('admin.dashboard') }}" class="block text-sm font-semibold text-brand-700 py-1.5 cursor-pointer">Portal Admin & Gudang</a>
            </div>
        </header>

        <!-- Global Flash Alerts -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            @if(session('success'))
                <div class="mb-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <!-- Main Page Content -->
        <main class="w-full">
            @yield('content')
        </main>
    </div>

    <!-- Editorial Minimal Footer -->
    <footer class="bg-neutral-950 text-neutral-400 mt-16 border-t border-neutral-900 select-none">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
                <div class="space-y-3">
                    <span class="font-serif text-2xl tracking-widest uppercase font-bold text-white">ITSFRIDAY</span>
                    <p class="text-xs text-neutral-400 leading-relaxed max-w-sm">
                        Membawa kenyamanan, kehangatan, dan rasa percaya diri akhir pekan ke dalam setiap hari Anda. Berdiri sejak 2017 di Indonesia dengan pengiriman ke seluruh dunia.
                    </p>
                    <p class="text-xs font-semibold tracking-wider text-brand-300 font-mono">#everydayitsfriday</p>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-neutral-200 mb-3">Koleksi Pilihan</h4>
                    <ul class="space-y-2 text-xs text-neutral-400">
                        <li><a href="{{ route('shop.catalog', ['category' => 'outerwear']) }}" class="hover:text-white transition-colors cursor-pointer">Outerwear & Kimono</a></li>
                        <li><a href="{{ route('shop.catalog', ['category' => 'scarf']) }}" class="hover:text-white transition-colors cursor-pointer">Voal Ultrafine Scarf</a></li>
                        <li><a href="{{ route('shop.catalog', ['category' => 'dress']) }}" class="hover:text-white transition-colors cursor-pointer">Tiered Dresses</a></li>
                        <li><a href="{{ route('shop.catalog', ['series' => 'SEPT_DROPS']) }}" class="hover:text-white transition-colors cursor-pointer">Sept Drops Eksklusif</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-neutral-200 mb-3">Layanan Mandiri</h4>
                    <ul class="space-y-2 text-xs text-neutral-400">
                        <li><a href="{{ route('shop.tracking') }}" class="hover:text-white transition-colors cursor-pointer">Lacak Status Pesanan</a></li>
                        <li><a href="{{ route('shop.returns') }}" class="hover:text-white transition-colors cursor-pointer">Portal Retur & Tukar Size</a></li>
                        <li><a href="{{ route('shop.catalog') }}" class="hover:text-white transition-colors cursor-pointer">Panduan Fit Helper</a></li>
                        <li><a href="{{ url('/llms.txt') }}" class="hover:text-white transition-colors cursor-pointer">Info Platform (llms.txt)</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-neutral-200 mb-3">Kanal & Pop-up Store</h4>
                    <p class="text-xs text-neutral-400 leading-relaxed mb-3">
                        Kunjungi pop-up bazar kami di kota-kota pilihan atau pesan melalui marketplace resmi.
                    </p>
                    <div class="flex items-center gap-2 text-[11px]">
                        <span class="px-2.5 py-1 rounded-md bg-neutral-900 border border-neutral-800 text-neutral-300 font-medium">Surabaya</span>
                        <span class="px-2.5 py-1 rounded-md bg-neutral-900 border border-neutral-800 text-neutral-300 font-medium">Solo</span>
                        <span class="px-2.5 py-1 rounded-md bg-neutral-900 border border-neutral-800 text-neutral-300 font-medium">Malang</span>
                    </div>
                </div>
            </div>
            <div class="pt-6 border-t border-neutral-900 flex flex-col sm:flex-row items-center justify-between text-xs text-neutral-500 gap-2">
                <span>&copy; {{ date('Y') }} ITSFRIDAY. Seluruh hak cipta dilindungi.</span>
                <span class="text-neutral-600 text-[11px]">Sistem Platform Terpadu E-commerce, WMS & CRM</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
