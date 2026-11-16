@extends('layouts.shop')

@section('title', 'Checkout Pengiriman — MOETIA')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h1 class="font-serif text-3xl font-bold text-neutral-900">Checkout Pengiriman</h1>
        <p class="text-xs text-neutral-500 mt-1">Lengkapi alamat pengiriman untuk proses reservasi stok dan pembayaran.</p>
    </div>

    <form action="{{ route('shop.checkout.process') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Form Fields (Col 7) -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Kontak Pelanggan -->
                <div class="bg-white rounded-3xl border border-neutral-200/80 p-6 shadow-sm space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-900 flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-neutral-900 text-white flex items-center justify-center text-[10px]">1</span>
                        Informasi Kontak & Akun
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Nama Lengkap *</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required placeholder="Contoh: Aulia Rahma" class="w-full px-3.5 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:ring-1 focus:ring-neutral-900">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Nomor WhatsApp / HP *</label>
                            <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" required placeholder="08123456789" class="w-full px-3.5 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:ring-1 focus:ring-neutral-900">
                        </div>
                    </div>

                    <div class="text-xs">
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Alamat Email (Kunci Pelacakan Mandiri) *</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}" required placeholder="aulia@example.com" class="w-full px-3.5 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:ring-1 focus:ring-neutral-900">
                        <p class="text-[10px] text-neutral-400 mt-1">Status pembayaran, resi pengiriman, dan akses portal retur akan dikirimkan ke email ini.</p>
                    </div>

                    <!-- Consent Checkbox (UU PDP Compliance) -->
                    <div class="pt-2">
                        <label class="flex items-start gap-2.5 cursor-pointer text-xs text-neutral-600">
                            <input type="checkbox" name="marketing_consent" value="1" checked class="mt-0.5 rounded border-neutral-300 text-neutral-900 focus:ring-neutral-900">
                            <span>Saya bersedia menerima kabar rilis drop terbaru, panduan styling, dan penawaran eksklusif dari MOETIA via email.</span>
                        </label>
                    </div>
                </div>

                <!-- Alamat Pengiriman -->
                <div class="bg-white rounded-3xl border border-neutral-200/80 p-6 shadow-sm space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-900 flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-neutral-900 text-white flex items-center justify-center text-[10px]">2</span>
                        Alamat Pengiriman
                    </h3>

                    <div class="text-xs">
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Alamat Lengkap & Patokan Jalan *</label>
                        <textarea name="shipping_address" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan" class="w-full px-3.5 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:ring-1 focus:ring-neutral-900">{{ old('shipping_address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Kota / Kabupaten *</label>
                            <input type="text" name="shipping_city" value="{{ old('shipping_city', 'Surabaya') }}" required class="w-full px-3.5 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:ring-1 focus:ring-neutral-900">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Provinsi *</label>
                            <input type="text" name="shipping_province" value="{{ old('shipping_province', 'Jawa Timur') }}" required class="w-full px-3.5 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:ring-1 focus:ring-neutral-900">
                        </div>
                    </div>

                    <!-- Courier Selector -->
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-2">Pilih Kurir Ekspedisi *</label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="p-3 rounded-xl border border-neutral-300 text-center cursor-pointer hover:border-neutral-900 has-[:checked]:border-neutral-950 has-[:checked]:bg-neutral-900 has-[:checked]:text-white transition-all text-xs">
                                <input type="radio" name="shipping_courier" value="JNE" checked class="sr-only" onchange="updateShipping(15000)">
                                <p class="font-bold">JNE Reguler</p>
                                <p class="text-[10px] opacity-80 mt-0.5">Rp 15.000 (2-3 hari)</p>
                            </label>
                            <label class="p-3 rounded-xl border border-neutral-300 text-center cursor-pointer hover:border-neutral-900 has-[:checked]:border-neutral-950 has-[:checked]:bg-neutral-900 has-[:checked]:text-white transition-all text-xs">
                                <input type="radio" name="shipping_courier" value="SiCepat" class="sr-only" onchange="updateShipping(18000)">
                                <p class="font-bold">SiCepat BEST</p>
                                <p class="text-[10px] opacity-80 mt-0.5">Rp 18.000 (1-2 hari)</p>
                            </label>
                            <label class="p-3 rounded-xl border border-neutral-300 text-center cursor-pointer hover:border-neutral-900 has-[:checked]:border-neutral-950 has-[:checked]:bg-neutral-900 has-[:checked]:text-white transition-all text-xs">
                                <input type="radio" name="shipping_courier" value="J&T" class="sr-only" onchange="updateShipping(16000)">
                                <p class="font-bold">J&T Express</p>
                                <p class="text-[10px] opacity-80 mt-0.5">Rp 16.000 (2-3 hari)</p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary & Pay Button (Col 5) -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-3xl border border-neutral-200/80 p-6 shadow-sm space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-900">Item Pesanan ({{ $cart->item_count }})</h3>
                    
                    <div class="divide-y divide-neutral-100 max-h-72 overflow-y-auto">
                        @foreach($cart->items as $item)
                            <div class="py-3 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-3">
                                    <span class="w-6 h-6 rounded bg-neutral-100 font-bold flex items-center justify-center text-[10px] text-neutral-700">{{ $item->quantity }}x</span>
                                    <div>
                                        <p class="font-bold text-neutral-900 truncate w-40">{{ $item->sku->product->name }}</p>
                                        <p class="text-[10px] text-neutral-500">{{ $item->sku->color }} ({{ $item->sku->size }})</p>
                                    </div>
                                </div>
                                <span class="font-semibold text-neutral-900">{{ \App\Modules\Shared\Money\Money::format($item->subtotal) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t border-neutral-100 space-y-2 text-xs">
                        <div class="flex justify-between text-neutral-600">
                            <span>Subtotal</span>
                            <span class="font-semibold text-neutral-900">{{ \App\Modules\Shared\Money\Money::format($cart->total) }}</span>
                        </div>
                        @if($discountIdr > 0)
                            <div class="flex justify-between text-emerald-700">
                                <span>Voucher ({{ $voucher->code }})</span>
                                <span class="font-semibold">- {{ \App\Modules\Shared\Money\Money::format($discountIdr) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-neutral-600">
                            <span>Ongkos Kirim</span>
                            <span id="shipping-display" class="font-semibold text-neutral-900">{{ \App\Modules\Shared\Money\Money::format($shippingCostIdr) }}</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-neutral-100 flex justify-between items-baseline">
                        <span class="text-xs font-bold uppercase tracking-wider text-neutral-900">Total Tagihan</span>
                        <span id="grand-total-display" class="font-serif text-2xl font-bold text-neutral-950">
                            {{ \App\Modules\Shared\Money\Money::format(max(0, $cart->total - $discountIdr + $shippingCostIdr)) }}
                        </span>
                    </div>

                    <button type="submit" class="w-full py-4 bg-neutral-900 hover:bg-neutral-800 text-white rounded-2xl font-bold text-xs uppercase tracking-widest shadow-lg hover:shadow-xl transition-all">
                        Buat Pesanan & Bayar &rarr;
                    </button>

                    <div class="p-3 bg-neutral-50 rounded-xl border border-neutral-200 text-[10px] text-neutral-500 space-y-1">
                        <p class="font-semibold text-neutral-700">Prinsip Keamanan Stok:</p>
                        <p>Begitu Anda menekan tombol di atas, stok barang Anda akan <strong>direservasi secara atomik di sistem gudang</strong> selama 60 menit.</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    const subtotal = {{ $cart->total }};
    const discount = {{ $discountIdr }};

    function updateShipping(cost) {
        document.getElementById('shipping-display').innerText = 'Rp ' + cost.toLocaleString('id-ID');
        const grandTotal = Math.max(0, subtotal - discount + cost);
        document.getElementById('grand-total-display').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
    }
</script>
@endsection

