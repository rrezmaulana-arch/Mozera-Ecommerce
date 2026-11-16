<!DOCTYPE html>
<html lang="id" class="h-full bg-[#0a0a0a] text-neutral-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 — Kendala Sistem | ITSFRIDAY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex flex-col items-center justify-center p-6 antialiased font-sans">
    <div class="max-w-md w-full text-center space-y-6">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-rose-500/10 border border-rose-500/20 text-rose-400 mx-auto">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>

        <div class="space-y-2">
            <span class="text-xs uppercase tracking-[0.25em] text-[#BA805E] font-bold">500 — Internal Server Error</span>
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white tracking-tight">Terjadi Kendala Teknis</h1>
            <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                Sistem kami sedang mengalami kendala sementara saat memproses permintaan Anda. Tim pengembang telah menerima notifikasi perbaikan.
            </p>
        </div>

        <div class="flex items-center justify-center gap-3 pt-2">
            <a href="javascript:location.reload()" class="px-5 py-2.5 rounded-xl border border-neutral-700 hover:border-neutral-500 text-neutral-300 font-bold text-xs transition-colors">
                Muat Ulang Halaman
            </a>
            <a href="{{ route('shop.home') }}" class="px-6 py-2.5 rounded-xl bg-[#BA805E] hover:bg-[#a66f4e] text-white font-bold text-xs shadow-lg transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>

