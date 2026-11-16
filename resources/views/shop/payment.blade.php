@extends('layouts.shop')

@section('title', 'Pembayaran Pesanan #' . $order->order_number . ' — MOZÉRA')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="text-center mb-8">
        <span class="text-xs uppercase tracking-widest text-brand-700 font-bold">Gerbang Pembayaran Aman</span>
        <h1 class="font-serif text-3xl font-bold text-neutral-900 mt-1">Selesaikan Pembayaran Anda</h1>
        <p class="text-xs text-neutral-500 mt-1">Nomor Pesanan: <strong class="text-neutral-800">{{ $order->order_number }}</strong></p>
    </div>

    <!-- Payment Container -->
    <div class="bg-white rounded-3xl border border-neutral-200/90 shadow-xl overflow-hidden">

        <!-- Top Status Bar -->
        <div class="bg-neutral-900 text-white p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <p class="text-xs text-neutral-400">Total yang harus dibayar:</p>
                <p class="font-serif text-3xl font-bold text-brand-300">
                    {{ \App\Modules\Shared\Money\Money::format($order->grand_total_idr) }}
                </p>
            </div>
            <div class="text-right">
                @if($order->status === 'pending_payment')
                    <span class="text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 font-semibold">
                        Menunggu Pembayaran
                    </span>
                    <p class="text-[10px] text-neutral-400 mt-1">Stok direservasi aman di gudang</p>
                @elseif($order->status === 'paid')
                    <span class="text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 font-semibold">
                        ✓ Pembayaran Diterima
                    </span>
                @elseif($order->status === 'cancelled')
                    <span class="text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full bg-red-500/20 text-red-300 border border-red-500/30 font-semibold">
                        Pesanan Dibatalkan
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6 sm:p-8 space-y-6">

            {{-- Error from Midtrans gateway --}}
            @if(!empty($snapError))
            <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-sm text-red-700 flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 3a9 9 0 110 18A9 9 0 0112 3z"/></svg>
                <span>{{ $snapError }}</span>
            </div>
            @endif

            {{-- Already Paid --}}
            @if($order->status === 'paid')
            <div class="text-center py-8 space-y-4">
                <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 flex items-center justify-center">
                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <p class="font-serif text-xl font-bold text-neutral-900">Pembayaran Berhasil!</p>
                    <p class="text-sm text-neutral-500 mt-1">Pesanan Anda sedang diproses oleh tim gudang kami.</p>
                </div>
                <a href="{{ route('shop.tracking') }}" class="inline-block px-6 py-3 bg-neutral-900 text-white rounded-2xl text-sm font-bold hover:bg-neutral-700 transition-all">
                    Lacak Pesanan →
                </a>
            </div>

            {{-- Cancelled --}}
            @elseif($order->status === 'cancelled')
            <div class="text-center py-8 space-y-4">
                <div class="w-20 h-20 mx-auto rounded-full bg-red-50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <div>
                    <p class="font-serif text-xl font-bold text-neutral-900">Pesanan Dibatalkan</p>
                    <p class="text-sm text-neutral-500 mt-1">Reservasi stok telah dilepaskan. Silakan belanja kembali.</p>
                </div>
                <a href="{{ route('shop.home') }}" class="inline-block px-6 py-3 bg-brand-600 text-white rounded-2xl text-sm font-bold hover:bg-brand-700 transition-all">
                    Kembali Belanja →
                </a>
            </div>

            {{-- Pending — Show Snap Pay Button --}}
            @elseif($order->status === 'pending_payment')

                {{-- Midtrans Snap Button --}}
                @if(!empty($snapToken))
                <div class="space-y-4">
                    <div class="rounded-2xl bg-neutral-50 border border-neutral-200 p-5 space-y-3">
                        <p class="text-xs font-bold uppercase tracking-wider text-neutral-700">Metode Pembayaran Tersedia</p>
                        <div class="flex flex-wrap gap-2 text-[11px] text-neutral-500">
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">QRIS</span>
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">BCA Virtual Account</span>
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">Mandiri VA</span>
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">BNI VA</span>
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">BRI VA</span>
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">GoPay</span>
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">OVO</span>
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">ShopeePay</span>
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">Kartu Kredit</span>
                            <span class="px-2 py-1 bg-white border border-neutral-200 rounded-lg">Alfamart / Indomaret</span>
                        </div>
                    </div>

                    <!-- Midtrans Snap CTA -->
                    <button id="snap-pay-btn"
                        class="w-full py-4 bg-neutral-900 hover:bg-neutral-700 active:scale-95 text-white rounded-2xl font-bold text-sm uppercase tracking-widest shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Bayar Sekarang via Midtrans
                    </button>

                    <p class="text-center text-[11px] text-neutral-400">
                        🔒 Transaksi dienkripsi & dijamin aman oleh Midtrans (Gojek Group)
                    </p>
                </div>
                @endif

                {{-- Local / Testing Simulator --}}
                @if(app()->environment(['local', 'testing']))
                <div class="pt-4 border-t border-dashed border-neutral-200 space-y-3">
                    <p class="text-xs font-bold uppercase tracking-wider text-neutral-500 text-center">⚙️ Simulator (Dev / Sandbox Only)</p>

                    <form action="{{ route('shop.order.payment.simulate', $order->ulid) }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="qris">
                        <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-bold text-xs uppercase tracking-widest transition-all flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simulasikan Pembayaran Berhasil
                        </button>
                    </form>

                    <form action="{{ route('shop.order.payment.expire', $order->ulid) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Batalkan pesanan ini?')" class="w-full py-2.5 bg-neutral-100 hover:bg-neutral-200 text-neutral-600 rounded-xl font-medium text-xs transition-all">
                            Simulasikan Kedaluwarsa / Batalkan
                        </button>
                    </form>
                </div>
                @endif

            @endif

            <!-- Order Summary -->
            <div class="border-t border-neutral-100 pt-6 space-y-2 text-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-neutral-500 mb-3">Ringkasan Pesanan</p>
                @foreach($order->items as $item)
                <div class="flex justify-between text-neutral-700">
                    <span class="truncate max-w-xs">{{ $item->product_name }} <span class="text-neutral-400">({{ $item->variant_name }}) ×{{ $item->quantity }}</span></span>
                    <span class="ml-4 font-medium shrink-0">{{ \App\Modules\Shared\Money\Money::format($item->subtotal_idr) }}</span>
                </div>
                @endforeach
                @if($order->discount_idr > 0)
                <div class="flex justify-between text-emerald-600">
                    <span>Diskon Voucher</span>
                    <span>−{{ \App\Modules\Shared\Money\Money::format($order->discount_idr) }}</span>
                </div>
                @endif
                <div class="flex justify-between text-neutral-500 text-xs">
                    <span>Ongkos Kirim ({{ $order->shipping_courier }})</span>
                    <span>{{ \App\Modules\Shared\Money\Money::format($order->shipping_cost_idr) }}</span>
                </div>
                <div class="flex justify-between font-bold text-neutral-900 border-t border-neutral-100 pt-2 mt-2">
                    <span>Total</span>
                    <span>{{ \App\Modules\Shared\Money\Money::format($order->grand_total_idr) }}</span>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Midtrans Snap.js Integration --}}
@if(!empty($snapToken) && $order->status === 'pending_payment')
<script src="{{ $snapUrl }}" data-client-key="{{ $clientKey }}"></script>
<script>
    document.getElementById('snap-pay-btn').addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                // Payment success — redirect to tracking page
                window.location.href = "{{ route('shop.tracking') }}";
            },
            onPending: function(result) {
                // Payment pending (VA / QR generated) — reload to show pending state
                window.location.reload();
            },
            onError: function(result) {
                alert('Pembayaran gagal. Silakan coba lagi atau hubungi CS kami.');
                window.location.reload();
            },
            onClose: function() {
                // User closed the Snap popup without paying — do nothing
            }
        });
    });
</script>
@endif
@endsection
