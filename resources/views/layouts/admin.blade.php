<!DOCTYPE html>
<html lang="id" class="h-full bg-neutral-900 text-neutral-100 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Platform Terpadu ITSFRIDAY')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        brand: {
                            500: '#BA805E',
                            600: '#A66747',
                            700: '#8A4F35',
                        }
                    }
                }
            }
        }
    </script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
    @stack('head')
</head>
<body class="flex h-full bg-neutral-950 text-neutral-200">

    <!-- Sidebar -->
    <aside class="w-64 bg-neutral-900 border-r border-neutral-800 flex flex-col flex-shrink-0">
        <!-- Logo -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-neutral-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <span class="font-bold text-lg tracking-widest text-white">ITSFRIDAY</span>
                <span class="text-[10px] font-semibold uppercase px-2 py-0.5 rounded bg-brand-500/20 text-brand-300 border border-brand-500/30">Admin</span>
            </a>
            <a href="{{ route('shop.home') }}" target="_blank" title="Lihat Toko Publik" class="text-neutral-400 hover:text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto py-4 px-3 space-y-6 text-xs">
            <!-- Ringkasan & Keputusan -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-2">Pusat Keputusan</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-brand-500 text-white' : 'text-neutral-300 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Command Center (Harian)</span>
                    </a>
                </div>
            </div>

            <!-- E-Commerce / Toko Online -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-2">Toko (E-Commerce)</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.store.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.store.products*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span>Katalog & Varian SKU</span>
                    </a>
                    <a href="{{ route('admin.store.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.store.orders*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Pesanan Semua Kanal</span>
                    </a>
                    <a href="{{ route('admin.store.returns.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.store.returns*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        <span>Retur & Karantina</span>
                    </a>
                    <a href="{{ route('admin.store.vouchers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.store.vouchers*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                        <span>Voucher Promo</span>
                    </a>
                    <a href="{{ route('admin.store.drops.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.store.drops*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span>Eksklusif Drops & Waitlist</span>
                    </a>
                </div>
            </div>

            <!-- Gudang / WMS -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-2">Gudang & WMS</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.wms.inventory') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.wms.inventory*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span>Saldo & Buku Besar Ledger</span>
                    </a>
                    <a href="{{ route('admin.wms.inbound.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.wms.inbound*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                        <span>Barang Masuk (Inbound Batch)</span>
                    </a>
                    <a href="{{ route('admin.wms.picking.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.wms.picking*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        <span>Picking & Scan Barcode</span>
                    </a>
                    <a href="{{ route('admin.wms.stocktake.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.wms.stocktake*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        <span>Stock Opname (Fisik)</span>
                    </a>
                    <a href="{{ route('admin.wms.import.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.wms.import*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        <span>Impor Marketplace CSV</span>
                    </a>
                    <a href="{{ route('admin.wms.reorder') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.wms.reorder*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span>Perencana Reorder & PO</span>
                    </a>
                </div>
            </div>

            <!-- CRM & Retensi -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-2">CRM & Retensi</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.crm.customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.crm.customers*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Profil Pelanggan 360</span>
                    </a>
                    <a href="{{ route('admin.crm.segments') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.crm.segments*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                        <span>Segmen RFM & Ritme</span>
                    </a>
                    <a href="{{ route('admin.crm.flows') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.crm.flows*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Alur Email & Antrean Approval</span>
                    </a>
                    <a href="{{ route('admin.crm.loyalty') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.crm.loyalty*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Poin Loyalitas</span>
                    </a>
                    <a href="{{ route('admin.crm.affiliates') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.crm.affiliates*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        <span>Mitra Kreator & Afiliasi</span>
                    </a>
                    <a href="{{ route('admin.crm.dsr') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.crm.dsr*') ? 'bg-neutral-800 text-white font-semibold' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Hak Subjek Data (UU PDP)</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- User Info & Logout -->
        <div class="p-4 border-t border-neutral-800 bg-neutral-900/50">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-brand-500/20 text-brand-300 border border-brand-500/40 flex items-center justify-center font-bold text-xs">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name ?? 'Staff' }}</p>
                        <p class="text-[10px] text-neutral-400 uppercase tracking-wider">{{ auth()->user()->role ?? 'Role' }}</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Logout" class="text-neutral-400 hover:text-rose-400 p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Admin Container -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Top Navigation -->
        <header class="h-16 bg-neutral-900 border-b border-neutral-800 px-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <h1 class="text-base font-semibold text-white">@yield('page_title', 'Dashboard')</h1>
                <span class="text-neutral-600">/</span>
                <span class="text-xs text-neutral-400">@yield('page_subtitle', 'Platform Terpadu ITSFRIDAY')</span>
            </div>

            <!-- Role Switcher for Testing Demonstration -->
            <div class="flex items-center gap-3">
                <span class="text-[11px] text-neutral-400 hidden sm:inline">Uji Peran:</span>
                <div class="flex items-center gap-1.5">
                    @php $allUsers = \App\Models\User::all(); @endphp
                    @foreach($allUsers as $u)
                        <a href="{{ route('admin.quick-login', $u->id) }}" class="text-[10px] px-2 py-1 rounded border {{ auth()->id() === $u->id ? 'bg-brand-500/20 text-brand-300 border-brand-500/50 font-semibold' : 'bg-neutral-800 text-neutral-400 border-neutral-700 hover:text-white' }}" title="{{ $u->name }}">
                            {{ ucfirst(str_replace('_', ' ', $u->role)) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 overflow-y-auto p-6 bg-neutral-950">
            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="mb-5 p-4 rounded-xl bg-emerald-950/40 border border-emerald-500/40 text-emerald-300 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-5 p-4 rounded-xl bg-rose-950/40 border border-rose-500/40 text-rose-300 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @if(session('info'))
                <div class="mb-5 p-4 rounded-xl bg-blue-950/40 border border-blue-500/40 text-blue-300 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>

