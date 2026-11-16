<!DOCTYPE html>
<html lang="id" class="h-full bg-[#0b0b0d] text-neutral-100 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Login Staf & Portal Akses — ITSFRIDAY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-[#0b0b0d] selection:bg-[#BA805E] selection:text-white">
    <div class="w-full max-w-lg space-y-8 my-auto py-8">
        <!-- Logo & Header -->
        <div class="text-center space-y-3">
            <a href="{{ route('shop.home') }}" class="inline-block group">
                <span class="text-3xl sm:text-4xl font-extrabold tracking-[0.25em] text-white block group-hover:text-[#DCC3AD] transition-colors">ITSFRIDAY</span>
                <span class="text-[10px] sm:text-[11px] tracking-[0.3em] uppercase text-[#BA805E] font-medium block mt-1">#everydayitsfriday &bull; Platform Terpadu</span>
            </a>
            <p class="text-xs text-neutral-400 max-w-sm mx-auto">Satu pintu gerbang operasional terintegrasi: E-Commerce Storefront, Warehouse WMS & CRM Retention.</p>
        </div>

        @if(session('info'))
            <div class="p-4 rounded-2xl bg-blue-950/40 border border-blue-500/40 text-blue-300 text-xs">
                {{ session('info') }}
            </div>
        @endif
        @if($errors->any())
            <div class="p-4 rounded-2xl bg-rose-950/40 border border-rose-500/40 text-rose-300 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Card Container -->
        <div class="bg-[#141417] border border-neutral-800 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
            <!-- 1-Click Role Testing / Switcher (Strictly Local + Config Only, POST + CSRF) -->
            @if(app()->environment('local') && config('app.demo_login', false) && $demoUsers->isNotEmpty())
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-neutral-400">Pilih Akses Peran (1-Klik Demo):</span>
                    <span class="text-[10px] text-[#BA805E] font-medium">Bypass Cepat (Local Only)</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs">
                    @foreach($demoUsers as $user)
                        <form action="{{ route('admin.quick-login', $user->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full p-3.5 rounded-2xl bg-[#1a1a1f] hover:bg-[#22222a] border border-neutral-800 hover:border-[#BA805E]/50 transition-all text-left flex flex-col justify-between group cursor-pointer">
                                <div class="flex items-center justify-between mb-1.5 w-full">
                                    <span class="font-bold text-white text-xs group-hover:text-[#DCC3AD] transition-colors truncate">{{ $user->name }}</span>
                                    <span class="w-2 h-2 rounded-full {{ $user->role === 'owner' ? 'bg-[#BA805E]' : ($user->role === 'warehouse_staff' ? 'bg-amber-400' : ($user->role === 'crm_marketer' ? 'bg-cyan-400' : 'bg-emerald-400')) }}"></span>
                                </div>
                                <div class="flex items-center justify-between text-[10px] w-full">
                                    <span class="text-neutral-400 uppercase tracking-wider font-semibold">{{ str_replace('_', ' ', $user->role) }}</span>
                                    <span class="text-neutral-500 font-mono text-[9px]">{{ $user->email }}</span>
                                </div>
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>

            <!-- Divider -->
            <div class="relative py-1">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-neutral-800/80"></div></div>
                <div class="relative flex justify-center text-[10px] uppercase tracking-wider"><span class="bg-[#141417] px-3 text-neutral-500">atau login manual kredensial</span></div>
            </div>
            @endif

            <!-- Manual Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-neutral-300 mb-1.5">Alamat Email Staf</label>
                    <input type="email" name="email" value="miftah@itsfriday.id" required class="w-full px-4 py-3 bg-[#0d0d0f] border border-neutral-700/80 rounded-xl text-white placeholder-neutral-500 focus:outline-none focus:border-[#BA805E] transition-colors">
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-neutral-300 mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" value="password123" required class="w-full px-4 py-3 bg-[#0d0d0f] border border-neutral-700/80 rounded-xl text-white placeholder-neutral-500 focus:outline-none focus:border-[#BA805E] transition-colors">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-[#BA805E] to-[#A66747] hover:from-[#A66747] hover:to-[#8A4F35] text-white rounded-xl font-bold text-xs uppercase tracking-widest transition-all shadow-lg shadow-[#BA805E]/20 flex items-center justify-center gap-2">
                        <span>Masuk ke Konsol</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Credential Info Matrix for User (Local Demo Only) -->
        @if(app()->environment('local') && config('app.demo_login', false))
        <div class="p-5 rounded-3xl bg-[#141417]/60 border border-neutral-800/80 text-xs space-y-3">
            <h3 class="font-bold text-[11px] text-white uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Daftar Akun & Hak Akses Tersedia (Local Demo):</span>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px] text-neutral-300">
                <div class="bg-[#0d0d0f] p-2.5 rounded-xl border border-neutral-800/60">
                    <p class="font-bold text-white">1. Owner / Super Admin</p>
                    <p class="text-neutral-400 text-[10px]">Email: <span class="font-mono text-white">miftah@itsfriday.id</span></p>
                    <p class="text-neutral-400 text-[10px]">Akses: Semua Modul, Approval Queue, GMV</p>
                </div>
                <div class="bg-[#0d0d0f] p-2.5 rounded-xl border border-neutral-800/60">
                    <p class="font-bold text-white">2. Admin Toko (E-Commerce)</p>
                    <p class="text-neutral-400 text-[10px]">Email: <span class="font-mono text-white">toko@itsfriday.id</span></p>
                    <p class="text-neutral-400 text-[10px]">Akses: Katalog, SKU, Pesanan, Drops, Retur</p>
                </div>
                <div class="bg-[#0d0d0f] p-2.5 rounded-xl border border-neutral-800/60">
                    <p class="font-bold text-white">3. Gudang & WMS</p>
                    <p class="text-neutral-400 text-[10px]">Email: <span class="font-mono text-white">gudang@itsfriday.id</span></p>
                    <p class="text-neutral-400 text-[10px]">Akses: Ledger Stok, Inbound, Barcode Picking, SO</p>
                </div>
                <div class="bg-[#0d0d0f] p-2.5 rounded-xl border border-neutral-800/60">
                    <p class="font-bold text-white">4. CRM & Pemasaran</p>
                    <p class="text-neutral-400 text-[10px]">Email: <span class="font-mono text-white">crm@itsfriday.id</span></p>
                    <p class="text-neutral-400 text-[10px]">Akses: Pelanggan 360, RFM, Email Flows, UU PDP</p>
                </div>
            </div>
            <p class="text-[10px] text-neutral-500 text-center">Password untuk semua akun: <span class="font-mono text-[#DCC3AD] font-bold">password123</span></p>
        </div>
        @endif

        <!-- Store Link -->
        <div class="text-center text-xs text-neutral-500">
            <a href="{{ route('shop.home') }}" class="hover:text-white transition-colors inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Kembali ke Halaman Toko ITSFRIDAY</span>
            </a>
        </div>
    </div>
</body>
</html>
