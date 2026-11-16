<!DOCTYPE html>
<html lang="id" class="h-full bg-neutral-950 text-neutral-100 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title', 'Admin Platform Terpadu MOZÉRA')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-full bg-[#0d0d0f] text-neutral-200 font-sans flex flex-col antialiased selection:bg-[#BA805E] selection:text-white">

    <!-- Mobile Header & Drawer Overlay -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300 opacity-0" onclick="toggleSidebar()"></div>

    <div class="flex flex-1 min-h-screen">
        <!-- Sidebar Navigation -->
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-72 lg:w-64 bg-[#141417] border-r border-neutral-800/80 flex flex-col flex-shrink-0 transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:static">
            <!-- Sidebar Header / Brand -->
            <div class="h-16 flex items-center justify-between px-5 border-b border-neutral-800/80 bg-[#111113]">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    <span class="font-bold text-base tracking-[0.2em] text-white">MOZÉRA</span>
                    <span class="text-[9px] font-bold uppercase px-2 py-0.5 rounded-full bg-[#BA805E]/20 text-[#DCC3AD] border border-[#BA805E]/30 tracking-wider">Console</span>
                </a>
                <div class="flex items-center gap-1">
                    <a href="{{ route('shop.home') }}" target="_blank" title="Lihat Toko Publik" class="p-1.5 rounded-lg text-neutral-400 hover:text-white hover:bg-neutral-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                    <!-- Close button on mobile -->
                    <button type="button" onclick="toggleSidebar()" class="lg:hidden p-1.5 rounded-lg text-neutral-400 hover:text-white hover:bg-neutral-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto py-4 px-3 space-y-6 text-xs custom-scrollbar">
                @php
                    $role = auth()->user()->role ?? 'owner';
                    $isOwner = $role === 'owner';
                    $canStore = in_array($role, ['owner', 'store_admin']);
                    $canWms = in_array($role, ['owner', 'warehouse_staff']);
                    $canCrm = in_array($role, ['owner', 'crm_marketer']);
                @endphp

                <!-- Ringkasan & Keputusan (Owner Khusus) -->
                @if($isOwner)
                <div>
                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-2">Pusat Keputusan</p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#BA805E] text-white shadow-lg shadow-[#BA805E]/20' : 'text-neutral-300 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <span>Command Center</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- E-Commerce / Toko Online -->
                @if($canStore)
                <div>
                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-2">Toko (E-Commerce)</p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.store.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.store.products*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>Katalog & Varian SKU</span>
                        </a>
                        <a href="{{ route('admin.store.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.store.orders*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            <span>Pesanan Semua Kanal</span>
                        </a>
                        <a href="{{ route('admin.store.returns.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.store.returns*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            <span>Retur & Karantina</span>
                        </a>
                        <a href="{{ route('admin.store.vouchers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.store.vouchers*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                            <span>Voucher Promo</span>
                        </a>
                        <a href="{{ route('admin.store.drops.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.store.drops*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span>Eksklusif Drops & Waitlist</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Gudang / WMS -->
                @if($canWms)
                <div>
                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-2">Gudang & WMS</p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.wms.inventory') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.wms.inventory*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            <span>Saldo & Buku Besar Ledger</span>
                        </a>
                        <a href="{{ route('admin.wms.inbound.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.wms.inbound*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                            <span>Barang Masuk (Inbound Batch)</span>
                        </a>
                        <a href="{{ route('admin.wms.picking.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.wms.picking*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                            <span>Picking & Scan Barcode</span>
                        </a>
                        <a href="{{ route('admin.wms.stocktake.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.wms.stocktake*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            <span>Stock Opname (Fisik)</span>
                        </a>
                        <a href="{{ route('admin.wms.import.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.wms.import*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <span>Impor Marketplace CSV</span>
                        </a>
                        <a href="{{ route('admin.wms.reorder') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.wms.reorder*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span>Perencana Reorder & PO</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- CRM & Retensi -->
                @if($canCrm)
                <div>
                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-2">CRM & Retensi</p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.crm.customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.crm.customers*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            <span>Profil Pelanggan 360</span>
                        </a>
                        <a href="{{ route('admin.crm.segments') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.crm.segments*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                            <span>Segmen RFM & Ritme</span>
                        </a>
                        <a href="{{ route('admin.crm.flows') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.crm.flows*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>Alur Email & Approval</span>
                        </a>
                        <a href="{{ route('admin.crm.loyalty') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.crm.loyalty*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Poin Loyalitas</span>
                        </a>
                        <a href="{{ route('admin.crm.affiliates') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.crm.affiliates*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            <span>Mitra Kreator & Afiliasi</span>
                        </a>
                        <a href="{{ route('admin.crm.dsr') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.crm.dsr*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span>Hak Subjek Data (UU PDP)</span>
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- User Info & Logout -->
            <div class="p-4 border-t border-neutral-800/80 bg-[#111113]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-8 h-8 rounded-full bg-[#BA805E]/20 text-[#DCC3AD] border border-[#BA805E]/30 flex items-center justify-center font-bold text-xs flex-shrink-0">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="truncate">
                            <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name ?? 'Staf' }}</p>
                            <span class="inline-block text-[9px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full {{ $role === 'owner' ? 'bg-[#BA805E]/20 text-[#DCC3AD] border border-[#BA805E]/30' : ($role === 'warehouse_staff' ? 'bg-amber-950/60 text-amber-300 border border-amber-800/40' : ($role === 'crm_marketer' ? 'bg-cyan-950/60 text-cyan-300 border border-cyan-800/40' : 'bg-emerald-950/60 text-emerald-300 border border-emerald-800/40')) }}">{{ str_replace('_', ' ', auth()->user()->role ?? 'Role') }}</span>
                        </div>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Keluar / Logout" class="text-neutral-400 hover:text-rose-400 p-1.5 rounded-lg hover:bg-neutral-800 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Admin Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Navigation Bar -->
            <header class="h-16 bg-[#141417] border-b border-neutral-800/80 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-30">
                <!-- Left: Hamburger on Mobile + Breadcrumb -->
                <div class="flex items-center gap-3">
                    <button type="button" onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 rounded-xl text-neutral-400 hover:text-white hover:bg-neutral-800 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <h1 class="text-sm sm:text-base font-bold text-white flex items-center gap-2">
                            @yield('page_title', 'Dashboard')
                        </h1>
                        <p class="text-[11px] text-neutral-400 hidden sm:block">@yield('page_subtitle', 'Platform Terpadu MOZÉRA')</p>
                    </div>
                </div>

                <!-- Right: Role Switcher for Fast Testing (Strictly local + config demo_login) -->
                <div class="flex items-center gap-2 sm:gap-3">
                    @if(app()->environment('local') && config('app.demo_login', false))
                    <div class="hidden md:flex items-center gap-1.5 bg-neutral-900/90 border border-neutral-800 px-2 py-1 rounded-xl">
                        <span class="text-[10px] text-neutral-400 uppercase font-semibold tracking-wider px-1">Peran:</span>
                        @php $allUsers = \App\Models\User::all(); @endphp
                        @foreach($allUsers as $u)
                            <form action="{{ route('admin.quick-login', $u->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-[10px] px-2 py-0.5 rounded-lg border transition-all cursor-pointer {{ auth()->id() === $u->id ? 'bg-[#BA805E] text-white border-[#BA805E] font-bold shadow-sm' : 'bg-neutral-800 text-neutral-400 border-transparent hover:text-white hover:bg-neutral-700' }}" title="{{ $u->name }}">
                                    {{ ucfirst(explode('_', $u->role)[0]) }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                    @endif

                    <a href="{{ route('shop.home') }}" target="_blank" class="px-3 py-1.5 rounded-xl border border-neutral-700 bg-neutral-800/80 hover:bg-neutral-700 text-white text-xs font-semibold flex items-center gap-1.5 transition-colors">
                        <span>Toko</span>
                        <svg class="w-3.5 h-3.5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </header>

            <!-- Main Body -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-[#0d0d0f]">
                <div class="max-w-7xl mx-auto space-y-6">
                    <!-- Flash Alerts -->
                    @if(session('success'))
                        <div class="p-4 rounded-2xl bg-emerald-950/40 border border-emerald-500/40 text-emerald-300 text-xs sm:text-sm flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="p-4 rounded-2xl bg-rose-950/40 border border-rose-500/40 text-rose-300 text-xs sm:text-sm flex items-center gap-3">
                            <svg class="w-5 h-5 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif
                    @if(session('info'))
                        <div class="p-4 rounded-2xl bg-blue-950/40 border border-blue-500/40 text-blue-300 text-xs sm:text-sm flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ session('info') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('opacity-0');
                setTimeout(() => backdrop.classList.add('hidden'), 300);
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
