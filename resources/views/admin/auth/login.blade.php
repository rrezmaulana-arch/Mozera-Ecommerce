<!DOCTYPE html>
<html lang="id" class="h-full bg-neutral-950 text-neutral-100 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Staf & Admin — Platform Terpadu ITSFRIDAY</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="flex min-h-full items-center justify-center p-4 sm:p-6 bg-neutral-950">
    <div class="w-full max-w-md space-y-8">
        <!-- Logo & Header -->
        <div class="text-center">
            <span class="text-2xl font-bold tracking-widest text-white">ITSFRIDAY</span>
            <p class="text-xs uppercase tracking-[0.25em] text-neutral-400 mt-1">Platform Terpadu (E-commerce, WMS & CRM)</p>
            <h2 class="text-lg font-bold text-neutral-200 mt-6">Masuk ke Portal Operasional</h2>
        </div>

        @if(session('info'))
            <div class="p-3.5 rounded-xl bg-blue-950/50 border border-blue-500/40 text-blue-300 text-xs">
                {{ session('info') }}
            </div>
        @endif
        @if($errors->any())
            <div class="p-3.5 rounded-xl bg-rose-950/50 border border-rose-500/40 text-rose-300 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Quick 1-Click Role Login for Demonstration & Testing -->
        <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-xl space-y-4">
            <p class="text-[11px] font-bold uppercase tracking-wider text-neutral-400">Pilih Akun Demo untuk Pengujian Cepat:</p>
            <div class="grid grid-cols-2 gap-2 text-xs">
                @foreach($demoUsers as $user)
                    <a href="{{ route('admin.quick-login', $user->id) }}" class="p-3 rounded-2xl bg-neutral-800 hover:bg-neutral-700 border border-neutral-700 hover:border-neutral-500 transition-all text-left flex flex-col justify-between">
                        <span class="font-bold text-white truncate">{{ $user->name }}</span>
                        <span class="text-[10px] text-amber-400 uppercase tracking-wider mt-1">{{ str_replace('_', ' ', $user->role) }}</span>
                    </a>
                @endforeach
            </div>

            <div class="relative py-2">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-neutral-800"></div></div>
                <div class="relative flex justify-center text-[10px] uppercase"><span class="bg-neutral-900 px-2 text-neutral-500">atau login manual</span></div>
            </div>

            <!-- Manual Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Email Staf</label>
                    <input type="email" name="email" value="miftah@itsfriday.id" required class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-neutral-400">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kata Sandi</label>
                    <input type="password" name="password" value="password123" required class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-neutral-400">
                </div>
                <button type="submit" class="w-full py-3 bg-white hover:bg-neutral-200 text-neutral-900 rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
                    Masuk Sekarang
                </button>
            </form>
        </div>

        <div class="text-center text-xs text-neutral-500">
            <a href="{{ route('shop.home') }}" class="hover:underline">&larr; Kembali ke Toko Publik</a>
        </div>
    </div>
</body>
</html>

