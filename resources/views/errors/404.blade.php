<!DOCTYPE html>
<html lang="id" class="h-full bg-[#fbf9f5] text-neutral-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — Halaman Tidak Ditemukan | ITSFRIDAY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex flex-col items-center justify-center p-6 antialiased font-sans">
    <div class="max-w-md w-full text-center space-y-6">
        <a href="{{ route('shop.home') }}" class="inline-block">
            <span class="font-serif text-2xl font-black tracking-widest text-neutral-950 uppercase">ITSFRIDAY</span>
        </a>

        <div class="space-y-3">
            <span class="text-xs uppercase tracking-[0.25em] text-[#BA805E] font-bold">404 — Not Found</span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold text-neutral-950 tracking-tight">Koleksi Tidak Ditemukan</h1>
            <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">
                Halaman busana atau tautan yang Anda tuju mungkin telah dipindahkan, habis terjual, atau alamat URL salah ketik.
            </p>
        </div>

        <div class="flex items-center justify-center gap-3 pt-4">
            <a href="{{ route('shop.home') }}" class="px-5 py-2.5 rounded-full border border-neutral-300 hover:border-neutral-900 text-neutral-800 font-bold text-xs transition-colors">
                Kembali ke Beranda
            </a>
            <a href="{{ route('shop.catalog') }}" class="px-6 py-2.5 rounded-full bg-neutral-950 hover:bg-[#BA805E] text-white font-bold text-xs shadow-md transition-colors">
                Jelajahi Katalog Busana
            </a>
        </div>
    </div>
</body>
</html>

