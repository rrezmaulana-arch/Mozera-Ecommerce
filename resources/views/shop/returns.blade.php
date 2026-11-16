@extends('layouts.shop')

@section('title', 'Portal Pengajuan Retur Mandiri — ITSFRIDAY')
@section('meta_description', 'Layanan mandiri penukaran ukuran (size swap) dan retur produk bergaransi 7 hari ITSFRIDAY.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 select-none">
    
    <!-- Hero Editorial Header -->
    <div class="text-center max-w-2xl mx-auto mb-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100/70 border border-brand-200/80 text-brand-800 text-[11px] font-semibold tracking-wide mb-3">
            <svg class="w-3.5 h-3.5 text-brand-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <span>Garansi Kualitas & Kepuasan 7 Hari</span>
        </div>
        <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-neutral-900 tracking-tight">
            Portal Retur & Penukaran
        </h1>
        <p class="text-xs sm:text-sm text-neutral-600 mt-3 leading-relaxed">
            Kenyamanan Anda adalah prioritas kami. Tukar ukuran (<span class="italic font-medium">size exchange</span>) atau ajukan klaim produk secara instan, transparan, dan tanpa perlu menunggu balasan admin chat.
        </p>
    </div>

    <!-- Search Box Card -->
    <div class="bg-white rounded-2xl border border-neutral-200/80 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] p-5 sm:p-7 mb-8">
        <div class="flex items-center justify-between mb-3">
            <label for="order_number" class="text-xs font-bold text-neutral-900 tracking-wide">
                Cari Pesanan Anda
            </label>
            <span class="text-[11px] text-neutral-400">Status pesanan minimal: Selesai / Diterima</span>
        </div>

        <form action="{{ route('shop.returns') }}" method="GET" class="flex flex-col sm:flex-row gap-2.5">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input 
                    type="text" 
                    id="order_number"
                    name="order_number" 
                    value="{{ request('order_number') ?? ($order ? $order->order_number : '') }}" 
                    placeholder="Masukkan Nomor Pesanan (Contoh: ORD-20261110-001)" 
                    class="w-full text-xs sm:text-sm pl-10 pr-4 py-3 bg-[#FAF9F6] border border-neutral-200 rounded-xl focus:bg-white focus:outline-none focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900 transition-all font-mono placeholder:text-neutral-400 text-neutral-900" 
                    required
                >
            </div>
            <button 
                type="submit" 
                class="inline-flex items-center justify-center gap-2 px-7 py-3 bg-neutral-900 hover:bg-neutral-800 active:scale-[0.99] text-white rounded-xl font-semibold text-xs tracking-wider uppercase transition-all shadow-sm cursor-pointer select-none focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2"
            >
                <span>Cari Pesanan</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </form>

        <!-- Quick Pill Suggestions -->
        <div class="mt-3.5 pt-3 border-t border-neutral-100 flex flex-wrap items-center gap-2 text-xs text-neutral-500">
            <span class="text-[11px] text-neutral-400">Contoh siap retur:</span>
            <a 
                href="{{ route('shop.returns', ['order_number' => 'ORD-20261110-001']) }}" 
                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-neutral-100 hover:bg-neutral-200 text-neutral-800 text-[11px] font-mono transition-colors cursor-pointer select-none"
            >
                <span>ORD-20261110-001</span>
                <span class="text-[10px] text-emerald-700 font-sans font-medium">(Aulia - Delivered)</span>
            </a>
        </div>
    </div>

    <!-- 3-Step Concierge Guide (Visible when no order is searched) -->
    @if(!$order && !request('order_number'))
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
            <div class="bg-white/80 p-5 rounded-2xl border border-neutral-200/70 space-y-2">
                <div class="w-7 h-7 rounded-lg bg-neutral-100 text-neutral-800 font-bold text-xs flex items-center justify-center">1</div>
                <h3 class="text-xs font-bold text-neutral-900">Temukan Pesanan</h3>
                <p class="text-[11px] text-neutral-500 leading-relaxed">
                    Ketik nomor pesanan yang Anda terima via email konfirmasi atau tagihan belanja Anda.
                </p>
            </div>
            <div class="bg-white/80 p-5 rounded-2xl border border-neutral-200/70 space-y-2">
                <div class="w-7 h-7 rounded-lg bg-neutral-100 text-neutral-800 font-bold text-xs flex items-center justify-center">2</div>
                <h3 class="text-xs font-bold text-neutral-900">Pilih Varian & Alasan</h3>
                <p class="text-[11px] text-neutral-500 leading-relaxed">
                    Pilih busana yang ingin ditukar ukuran atau dilaporkan cacat jahit dalam masa 7 hari.
                </p>
            </div>
            <div class="bg-white/80 p-5 rounded-2xl border border-neutral-200/70 space-y-2">
                <div class="w-7 h-7 rounded-lg bg-neutral-100 text-neutral-800 font-bold text-xs flex items-center justify-center">3</div>
                <h3 class="text-xs font-bold text-neutral-900">QC Cepat & Pengiriman Baru</h3>
                <p class="text-[11px] text-neutral-500 leading-relaxed">
                    Tim gudang menerima paket, melakukan sanitasi QC, dan mengirimkan unit pengganti segera.
                </p>
            </div>
        </div>
    @endif

    @if($order)
        <!-- Step 2: Order Detail & Return Form -->
        <div class="bg-white rounded-2xl border border-neutral-200/90 shadow-[0_8px_30px_-6px_rgba(0,0,0,0.06)] p-6 sm:p-8 space-y-6">
            
            <!-- Order Header Info -->
            <div class="pb-5 border-b border-neutral-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-neutral-400 font-mono">PESANAN</span>
                        <h2 class="font-serif text-2xl font-bold text-neutral-900">#{{ $order->order_number }}</h2>
                    </div>
                    <p class="text-xs text-neutral-500 mt-0.5">
                        Penerima: <strong class="text-neutral-800">{{ $order->customer_name }}</strong> &bull; {{ $order->shipping_city }} &bull; Tanggal Selesai: {{ $order->paid_at?->format('d M Y') }}
                    </p>
                </div>
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200/80">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Pesanan Selesai / Siap Retur
                    </span>
                </div>
            </div>

            <form action="{{ route('shop.returns.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">

                <!-- Select Item to return -->
                <div>
                    <label class="block text-xs font-bold text-neutral-900 uppercase tracking-wider mb-2">
                        Pilih Busana yang Ingin Ditukar / Diretur *
                    </label>
                    <div class="space-y-2.5">
                        @foreach($order->items as $item)
                            <label class="relative flex items-center justify-between p-4 rounded-xl border border-neutral-200/80 bg-neutral-50/50 hover:bg-neutral-50 hover:border-neutral-900 cursor-pointer has-[:checked]:border-neutral-950 has-[:checked]:bg-white has-[:checked]:shadow-sm transition-all text-xs select-none">
                                <div class="flex items-center gap-3.5">
                                    <input 
                                        type="radio" 
                                        name="sku_id" 
                                        value="{{ $item->sku_id }}" 
                                        required 
                                        class="w-4 h-4 text-neutral-900 border-neutral-300 focus:ring-neutral-900 cursor-pointer"
                                    >
                                    <div>
                                        <p class="font-bold text-neutral-900 text-sm">{{ $item->product_name }}</p>
                                        <p class="text-xs text-neutral-500 mt-0.5">
                                            Varian: <span class="font-medium text-neutral-700">{{ $item->variant_name }}</span> &bull; SKU: <span class="font-mono text-[11px]">{{ $item->sku_code }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="font-bold text-neutral-900">{{ \App\Modules\Shared\Money\Money::format($item->unit_price_idr) }}</span>
                                    <p class="text-[10px] text-neutral-400">Qty terbeli: {{ $item->quantity }} pcs</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <!-- Quantity -->
                    <div>
                        <label class="block text-xs font-bold text-neutral-800 mb-1.5">Jumlah Barang yang Diretur *</label>
                        <input 
                            type="number" 
                            name="quantity" 
                            value="1" 
                            min="1" 
                            max="10" 
                            required 
                            class="w-full px-4 py-2.5 bg-[#FAF9F6] border border-neutral-200 rounded-xl focus:bg-white focus:outline-none focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900 font-semibold text-neutral-900"
                        >
                    </div>

                    <!-- Reason -->
                    <div>
                        <label class="block text-xs font-bold text-neutral-800 mb-1.5">Alasan Penukaran / Retur *</label>
                        <select 
                            name="reason" 
                            required 
                            class="w-full px-4 py-2.5 bg-[#FAF9F6] border border-neutral-200 rounded-xl focus:bg-white focus:outline-none focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900 text-xs font-medium text-neutral-900 cursor-pointer"
                        >
                            <option value="Tukar Ukuran (Size Mismatch)">Tukar Ukuran (Kebesaran / Kekecilan)</option>
                            <option value="Tukar Varian Warna">Ingin Tukar Varian Warna Lain</option>
                            <option value="Cacat Produksi / Jahitan">Cacat Produksi / Jahitan Kurang Rapi</option>
                            <option value="Barang Tidak Sesuai Pesanan">Barang Berbeda dari yang Dipesan</option>
                        </select>
                    </div>
                </div>

                <!-- Notes -->
                <div class="text-xs">
                    <label class="block text-xs font-bold text-neutral-800 mb-1.5">
                        Catatan Spesifik Ukuran Pengganti / Detail Keluhan
                    </label>
                    <textarea 
                        name="notes" 
                        rows="3" 
                        placeholder="Contoh: Tolong tukar dengan warna Sage Green ukuran All Size, produk belum pernah dicuci dan tag masih terpasang." 
                        class="w-full px-4 py-3 bg-[#FAF9F6] border border-neutral-200 rounded-xl focus:bg-white focus:outline-none focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900 text-neutral-900 placeholder:text-neutral-400 leading-relaxed"
                    ></textarea>
                </div>

                <!-- Reassurance Info Box -->
                <div class="p-4 rounded-xl bg-brand-50/60 border border-brand-200/60 text-xs text-neutral-700 space-y-1.5">
                    <div class="flex items-center gap-2 font-bold text-brand-900">
                        <svg class="w-4 h-4 text-brand-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Kebijakan Retur & Penukaran Ramah Konsumen:</span>
                    </div>
                    <p class="text-[11px] text-neutral-600 leading-relaxed pl-6">
                        Setiap pembelian berhak mendapatkan penukaran ukuran 1x gratis ongkos kirim pengiriman kembali jika ukuran belum pas. Pastikan busana belum dicuci, wangi asli belum hilang, dan tag masih terpasang utuh.
                    </p>
                </div>

                <button 
                    type="submit" 
                    class="w-full py-3.5 bg-neutral-900 hover:bg-neutral-800 active:scale-[0.99] text-white rounded-xl font-bold text-xs uppercase tracking-widest transition-all shadow-md hover:shadow-lg cursor-pointer select-none flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2"
                >
                    <span>Kirim Pengajuan Retur Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>
        </div>
    @elseif(request('order_number'))
        <div class="p-8 text-center bg-white rounded-2xl border border-neutral-200 shadow-sm max-w-lg mx-auto space-y-3">
            <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mx-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-neutral-900">Pesanan Belum Dapat Diretur</h3>
            <p class="text-xs text-neutral-600 leading-relaxed">
                Pesanan "{{ request('order_number') }}" belum memenuhi syarat retur mandiri. Retur hanya dapat diajukan untuk pesanan dengan status <strong class="text-neutral-900">"Selesai / Diterima"</strong> dalam jangka waktu 7 hari sejak barang sampai.
            </p>
            <div class="pt-2">
                <a href="{{ route('shop.tracking', ['order_number' => request('order_number')]) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-neutral-900 underline hover:text-brand-700">
                    <span>Cek status perjalanan di Lacak Pesanan</span>
                    &rarr;
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
