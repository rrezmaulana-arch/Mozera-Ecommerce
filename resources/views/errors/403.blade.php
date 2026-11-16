<!DOCTYPE html>
<html lang="id" class="h-full bg-[#0a0a0a] text-neutral-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 — Akses Dibatasi | ITSFRIDAY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex flex-col items-center justify-center p-6 antialiased font-sans">
    <div class="max-w-md w-full text-center space-y-6">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-amber-500/10 border border-amber-500/20 text-amber-400 mx-auto">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 15v2m0 0v2m0-2h2m-2 0H10m11-3.5a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>

        <div class="space-y-2">
            <span class="text-xs uppercase tracking-[0.25em] text-[#BA805E] font-bold">403 — Hak Akses Terbatas</span>
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white tracking-tight">Wewenang Tidak Cukup</h1>
            <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                {{ $exception->getMessage() ?: 'Akun Anda tidak memiliki izin untuk membuka halaman atau modul ini sesuai kebijakan pembagian peran (RBAC).' }}
            </p>
        </div>

        <div class="p-4 rounded-2xl bg-neutral-900/80 border border-neutral-800 text-left text-xs space-y-2 text-neutral-300">
            <div class="flex items-center justify-between">
                <span class="text-neutral-500">Akun Masuk:</span>
                <span class="font-bold text-white">{{ auth()->user()->name ?? 'Tamu' }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-neutral-500">Peran Aktif:</span>
                <span class="px-2 py-0.5 rounded-full font-bold bg-[#BA805E]/20 text-[#BA805E] uppercase text-[10px]">
                    {{ auth()->user()->role ?? 'Belum Login' }}
                </span>
            </div>
        </div>

        <div class="flex items-center justify-center gap-3 pt-2">
            <a href="javascript:history.back()" class="px-5 py-2.5 rounded-xl border border-neutral-700 hover:border-neutral-500 text-neutral-300 font-bold text-xs transition-colors">
                Kembali
            </a>
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 rounded-xl bg-[#BA805E] hover:bg-[#a66f4e] text-white font-bold text-xs shadow-lg transition-colors">
                Menu Utama Admin
            </a>
        </div>
    </div>
</body>
</html>
