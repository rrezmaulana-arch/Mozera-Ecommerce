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
                <span class="text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 font-semibold">
                    Menunggu Pembayaran
                </span>
                <p class="text-[10px] text-neutral-400 mt-1">Stok direservasi aman di gudang</p>
            </div>
        </div>

        <div class="p-6 sm:p-8 space-y-8">
            <!-- Payment Method Tabs -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-900">Pilih Metode Pembayaran</h3>

                <!-- QRIS Preview -->
                <div class="border-2 border-neutral-900 rounded-2xl p-6 bg-neutral-50 text-center space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-white border border-neutral-200 rounded-full text-xs font-bold text-neutral-800">
                        <span>QRIS Standar Nasional</span>
                        <span class="text-emerald-600">● Real-time</span>
                    </div>

                    <div class="w-48 h-48 mx-auto bg-white p-3 rounded-2xl border border-neutral-300 shadow-sm flex flex-col items-center justify-center">
                        <!-- Simulated SVG QR code -->
                        <svg class="w-full h-full text-neutral-900" viewBox="0 0 100 100" fill="currentColor">
                            <rect x="10" y="10" width="25" height="25" fill="#111"/>
                            <rect x="15" y="15" width="15" height="15" fill="#fff"/>
                            <rect x="18" y="18" width="9" height="9" fill="#111"/>
                            <rect x="65" y="10" width="25" height="25" fill="#111"/>
                            <rect x="70" y="15" width="15" height="15" fill="#fff"/>
                            <rect x="73" y="18" width="9" height="9" fill="#111"/>
                            <rect x="10" y="65" width="25" height="25" fill="#111"/>
                            <rect x="15" y="70" width="15" height="15" fill="#fff"/>
                            <rect x="18" y="73" width="9" height="9" fill="#111"/>
                            <rect x="45" y="15" width="8" height="8" fill="#111"/>
                            <rect x="45" y="35" width="12" height="12" fill="#111"/>
                            <rect x="25" y="45" width="8" height="8" fill="#111"/>
                            <rect x="65" y="50" width="15" height="8" fill="#111"/>
                            <rect x="45" y="65" width="8" height="15" fill="#111"/>
                            <rect x="65" y="75" width="20" height="12" fill="#111"/>
                        </svg>
                    </div>

                    <p class="text-xs text-neutral-600">
                        Pindai kode QRIS menggunakan GoPay, OVO, ShopeePay, BCA, atau aplikasi mobile banking favorit Anda.
                    </p>
                </div>

                <!-- Virtual Account Alternatif -->
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3 rounded-xl border border-neutral-200 bg-white">
                        <p class="font-bold text-neutral-900">BCA Virtual Account</p>
                        <p class="text-neutral-500 font-mono text-[11px] mt-0.5">8277 0812 3456 7890</p>
                    </div>
                    <div class="p-3 rounded-xl border border-neutral-200 bg-white">
                        <p class="font-bold text-neutral-900">Mandiri Virtual Account</p>
                        <p class="text-neutral-500 font-mono text-[11px] mt-0.5">8890 0812 3456 7890</p>
                    </div>
                </div>
            </div>

            <!-- Simulation Action Buttons (Testing Sandbox - Local / Testing Only) -->
            @if(app()->environment(['local', 'testing']))
            <div class="pt-6 border-t border-neutral-200 space-y-3">
                <p class="text-xs font-bold uppercase tracking-wider text-neutral-700 text-center">Simulator Pembayaran Gateway (Sandbox)</p>
                
                <form action="{{ route('shop.order.payment.simulate', $order->ulid) }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="qris">
                    <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-bold text-xs uppercase tracking-widest shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simulasikan Pembayaran Berhasil (Instant Webhook)
                    </button>
                </form>

                <form action="{{ route('shop.order.payment.expire', $order->ulid) }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" class="w-full py-2.5 bg-neutral-100 hover:bg-neutral-200 text-neutral-700 rounded-xl font-medium text-xs transition-all">
                        Simulasikan Kedaluwarsa / Batalkan (Release Reservasi Stok)
                    </button>
                </form>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

