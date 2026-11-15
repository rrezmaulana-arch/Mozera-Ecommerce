@extends('layouts.shop')

@section('title', 'Portal Pengajuan Retur Mandiri — ITSFRIDAY')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="text-center mb-10">
        <span class="text-xs uppercase tracking-widest text-brand-700 font-bold">Garansi Kualitas 7 Hari</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-neutral-900 mt-1">Portal Pengajuan Retur Mandiri</h1>
        <p class="text-xs text-neutral-500 mt-2 max-w-md mx-auto">
            Kenyamanan Anda adalah prioritas kami. Tukar ukuran atau ajukan retur produk secara mudah dan transparan tanpa perlu menunggu balasan admin chat.
        </p>
    </div>

    <!-- Step 1: Search Delivered Order -->
    <div class="bg-white p-6 rounded-3xl border border-neutral-200/90 shadow-sm mb-8">
        <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-900 mb-3">Langkah 1: Temukan Pesanan Anda</h3>
        <form action="{{ route('shop.returns') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="order_number" value="{{ request('order_number') ?? ($order ? $order->order_number : '') }}" placeholder="Masukkan Nomor Pesanan yang telah diterima (Contoh: ORD-20261110-001)" class="w-full text-xs px-4 py-3 bg-neutral-50 border border-neutral-300 rounded-2xl focus:outline-none focus:ring-1 focus:ring-neutral-900" required>
            </div>
            <button type="submit" class="px-8 py-3 bg-neutral-900 hover:bg-neutral-800 text-white rounded-2xl font-bold text-xs uppercase tracking-widest transition-all">
                Cari Pesanan
            </button>
        </form>
    </div>

    @if($order)
        <!-- Step 2: Return Request Form -->
        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-neutral-200/90 shadow-lg space-y-6">
            <div class="pb-4 border-b border-neutral-100 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-xl font-bold text-neutral-900">Pesanan #{{ $order->order_number }}</h3>
                    <p class="text-xs text-neutral-500">Penerima: {{ $order->customer_name }} • Tanggal Bayar: {{ $order->paid_at?->format('d M Y') }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                    Status: {{ ucfirst($order->status) }}
                </span>
            </div>

            <form action="{{ route('shop.returns.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">

                <!-- Select Item to return -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-neutral-700 mb-2">Pilih Item yang Ingin Diretur *</label>
                    <div class="space-y-2">
                        @foreach($order->items as $item)
                            <label class="flex items-center justify-between p-3.5 rounded-2xl border border-neutral-200 cursor-pointer hover:border-neutral-900 has-[:checked]:border-neutral-950 has-[:checked]:bg-neutral-50 transition-all text-xs">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="sku_id" value="{{ $item->sku_id }}" required class="text-neutral-900 focus:ring-neutral-900">
                                    <div>
                                        <p class="font-bold text-neutral-900">{{ $item->product_name }}</p>
                                        <p class="text-[11px] text-neutral-500">{{ $item->variant_name }} ({{ $item->sku_code }})</p>
                                    </div>
                                </div>
                                <span class="font-semibold text-neutral-800">{{ \App\Modules\Shared\Money\Money::format($item->unit_price_idr) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <!-- Quantity -->
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Jumlah Barang *</label>
                        <input type="number" name="quantity" value="1" min="1" max="10" required class="w-full px-3.5 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:ring-1 focus:ring-neutral-900 font-semibold">
                    </div>

                    <!-- Reason -->
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Alasan Retur / Penukaran *</label>
                        <select name="reason" required class="w-full px-3.5 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:ring-1 focus:ring-neutral-900 text-xs">
                            <option value="Tukar Ukuran (Size Mismatch)">Tukar Ukuran (Kebesaran / Kekecilan)</option>
                            <option value="Tukar Varian Warna">Ingin Tukar Varian Warna</option>
                            <option value="Cacat Produksi / Jahitan">Cacat Produksi / Jahitan Kurang Rapi</option>
                            <option value="Barang Tidak Sesuai Pesanan">Barang Berbeda dari yang Dipesan</option>
                        </select>
                    </div>
                </div>

                <!-- Notes -->
                <div class="text-xs">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Catatan Tambahan / Ukuran yang Diinginkan</label>
                    <textarea name="notes" rows="3" placeholder="Jelaskan kebutuhan penukaran Anda secara detail..." class="w-full px-3.5 py-2.5 bg-neutral-50 border border-neutral-300 rounded-xl focus:ring-1 focus:ring-neutral-900"></textarea>
                </div>

                <!-- Info Box -->
                <div class="p-4 rounded-2xl bg-neutral-50 border border-neutral-200 text-[11px] text-neutral-600 space-y-1">
                    <p class="font-bold text-neutral-900">Alur Karantina & QC Gudang:</p>
                    <p>Setelah pengajuan dikirim, tiket retur akan masuk ke antrean staf gudang. Paket retur Anda akan melalui inspeksi karantina sebelum varian pengganti dikirimkan atau dana dikembalikan.</p>
                </div>

                <button type="submit" class="w-full py-4 bg-neutral-900 hover:bg-neutral-800 text-white rounded-2xl font-bold text-xs uppercase tracking-widest shadow-lg hover:shadow-xl transition-all">
                    Kirim Pengajuan Retur &rarr;
                </button>
            </form>
        </div>
    @elseif(request('order_number'))
        <div class="p-8 text-center bg-white rounded-3xl border border-neutral-200">
            <p class="text-sm font-semibold text-neutral-800">Pesanan "{{ request('order_number') }}" tidak memenuhi syarat retur.</p>
            <p class="text-xs text-neutral-500 mt-1">Hanya pesanan berstatus "Diterima / Selesai" yang dapat mengajukan retur mandiri.</p>
        </div>
    @endif
</div>
@endsection

