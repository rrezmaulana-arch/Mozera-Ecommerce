@extends('layouts.shop')

@section('title', 'Keranjang Belanja — MOETIA')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h1 class="font-serif text-3xl font-bold text-neutral-900">Keranjang Belanja</h1>
        <p class="text-xs text-neutral-500 mt-1">Periksa kembali item pilihan Anda sebelum melanjutkan ke pengiriman.</p>
    </div>

    @if(!$cart || $cart->items->isEmpty())
        <div class="text-center py-20 bg-white rounded-3xl border border-neutral-200/80 p-8 shadow-sm">
            <svg class="w-16 h-16 text-neutral-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            <h3 class="font-serif text-xl font-bold text-neutral-800">Keranjang Anda masih kosong</h3>
            <p class="text-xs text-neutral-500 mt-2 max-w-sm mx-auto">Temukan koleksi outerwear dan scarf voal favorit Anda untuk hari-hari yang lebih percaya diri.</p>
            <a href="{{ route('shop.catalog') }}" class="mt-6 inline-block px-8 py-3 bg-neutral-900 hover:bg-neutral-800 text-white text-xs font-bold uppercase tracking-widest rounded-full transition-all">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Items Table (Col 8) -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-neutral-200/80 p-6 shadow-sm">
                <form action="{{ route('shop.cart.update') }}" method="POST">
                    @csrf
                    <div class="divide-y divide-neutral-100">
                        @foreach($cart->items as $item)
                            <div class="py-5 flex gap-4 sm:gap-6 items-center">
                                <img src="{{ $item->sku->image_url ?? $item->sku->product->primary_image }}" alt="{{ $item->sku->name }}" class="w-20 h-24 sm:w-24 sm:h-28 object-cover rounded-2xl bg-neutral-100 flex-shrink-0">
                                
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-serif text-base font-bold text-neutral-900 truncate">
                                        <a href="{{ route('shop.product', $item->sku->product->slug) }}">{{ $item->sku->product->name }}</a>
                                    </h4>
                                    <p class="text-xs text-neutral-500 mt-0.5">Varian: <strong class="text-neutral-700">{{ $item->sku->color }} ({{ $item->sku->size }})</strong></p>
                                    <p class="text-[11px] text-neutral-400">SKU: {{ $item->sku->sku_code }}</p>
                                    <p class="text-xs font-semibold text-neutral-900 mt-2">
                                        {{ \App\Modules\Shared\Money\Money::format($item->sku->price_idr) }}
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row items-center gap-3">
                                    <div class="flex items-center border border-neutral-300 rounded-xl overflow-hidden bg-neutral-50">
                                        <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" max="10" class="w-16 py-1.5 text-center text-xs font-bold bg-transparent focus:outline-none">
                                    </div>
                                    <p class="text-xs font-bold text-neutral-900 w-24 text-right hidden sm:block">
                                        {{ \App\Modules\Shared\Money\Money::format($item->subtotal) }}
                                    </p>
                                    <button type="submit" formaction="{{ route('shop.cart.remove', $item->id) }}" class="p-2 text-neutral-400 hover:text-rose-600 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t border-neutral-100 flex items-center justify-between">
                        <a href="{{ route('shop.catalog') }}" class="text-xs text-neutral-600 hover:text-neutral-900 font-medium">
                            &larr; Lanjut Berbelanja
                        </a>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-neutral-800 text-xs font-semibold transition-all">
                            Perbarui Jumlah
                        </button>
                    </div>
                </form>
            </div>

            <!-- Order Summary (Col 4) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Voucher Input -->
                <div class="bg-white rounded-3xl border border-neutral-200/80 p-6 shadow-sm">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-900 mb-3">Voucher Promo</h3>
                    @if($voucher)
                        <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between text-xs">
                            <div>
                                <span class="font-bold text-emerald-900">{{ $voucher->code }}</span>
                                <p class="text-[10px] text-emerald-700">Hemat {{ \App\Modules\Shared\Money\Money::format($discountIdr) }}</p>
                            </div>
                            <form action="{{ route('shop.cart.voucher.remove') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs text-rose-600 hover:underline">Lepas</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('shop.cart.voucher') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text" name="code" placeholder="Kode voucher" class="flex-1 text-xs uppercase tracking-wider px-3 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:outline-none focus:ring-1 focus:ring-neutral-900" required>
                            <button type="submit" class="px-4 py-2.5 bg-neutral-900 hover:bg-neutral-800 text-white text-xs font-bold rounded-xl transition-all">
                                Pakai
                            </button>
                        </form>
                        <p class="text-[11px] text-neutral-400 mt-2">Gunakan <strong>EVERYDAYFRIDAY</strong> untuk diskon sambutan 10%.</p>
                    @endif
                </div>

                <!-- Price Breakdown -->
                <div class="bg-white rounded-3xl border border-neutral-200/80 p-6 shadow-sm space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-900">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between text-neutral-600">
                            <span>Subtotal Produk</span>
                            <span class="font-semibold text-neutral-900">{{ \App\Modules\Shared\Money\Money::format($cart->total) }}</span>
                        </div>
                        @if($discountIdr > 0)
                            <div class="flex justify-between text-emerald-700">
                                <span>Potongan Voucher</span>
                                <span class="font-semibold">- {{ \App\Modules\Shared\Money\Money::format($discountIdr) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-neutral-500">
                            <span>Estimasi Ongkos Kirim</span>
                            <span>Dihitung saat checkout</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-neutral-100 flex justify-between items-baseline">
                        <span class="text-xs font-bold text-neutral-900 uppercase tracking-wider">Total Belanja</span>
                        <span class="font-serif text-2xl font-bold text-neutral-950">
                            {{ \App\Modules\Shared\Money\Money::format(max(0, $cart->total - $discountIdr)) }}
                        </span>
                    </div>

                    <a href="{{ route('shop.checkout') }}" class="block w-full py-4 bg-neutral-900 hover:bg-neutral-800 text-white text-center font-bold text-xs uppercase tracking-widest rounded-2xl shadow-lg hover:shadow-xl transition-all">
                        Lanjut ke Pembayaran &rarr;
                    </a>

                    <p class="text-[10px] text-center text-neutral-400">
                        Transaksi aman & terenkripsi. Reservasi stok dilakukan otomatis saat checkout.
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

