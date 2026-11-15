@extends('layouts.shop')

@section('title', 'Lacak Status Pesanan Mandiri — ITSFRIDAY')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="text-center mb-10">
        <span class="text-xs uppercase tracking-widest text-brand-700 font-bold">Layanan Mandiri Pelanggan</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-neutral-900 mt-1">Lacak Status Pesanan</h1>
        <p class="text-xs text-neutral-500 mt-2 max-w-md mx-auto">
            Pantau perjalanan paket busana Anda dari gudang pusat hingga ke alamat tujuan tanpa perlu chat admin WhatsApp.
        </p>
    </div>

    <!-- Search Form -->
    <div class="bg-white p-6 rounded-3xl border border-neutral-200/90 shadow-sm mb-10">
        <form action="{{ route('shop.tracking') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="order_number" value="{{ request('order_number') ?? ($order ? $order->order_number : '') }}" placeholder="Masukkan Nomor Pesanan (Contoh: ORD-20261110-001)" class="w-full text-xs px-4 py-3 bg-neutral-50 border border-neutral-300 rounded-2xl focus:outline-none focus:ring-1 focus:ring-neutral-900 font-medium" required>
            </div>
            <button type="submit" class="px-8 py-3 bg-neutral-900 hover:bg-neutral-800 text-white rounded-2xl font-bold text-xs uppercase tracking-widest transition-all">
                Lacak Sekarang
            </button>
        </form>
        <div class="mt-3 text-[11px] text-neutral-400 flex items-center justify-between">
            <span>Contoh order untuk dicoba: <a href="{{ route('shop.tracking', ['order_number' => 'ORD-20261110-001']) }}" class="text-neutral-700 underline font-medium">ORD-20261110-001</a> (Selesai), <a href="{{ route('shop.tracking', ['order_number' => 'ORD-20261115-002']) }}" class="text-neutral-700 underline font-medium">ORD-20261115-002</a> (Picking)</span>
        </div>
    </div>

    @if($order)
        <!-- Order Result Card -->
        <div class="bg-white rounded-3xl border border-neutral-200/90 shadow-lg overflow-hidden space-y-8 p-6 sm:p-8">
            <!-- Header Status -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-neutral-100 gap-4">
                <div>
                    <span class="text-[10px] uppercase tracking-wider text-neutral-400">Nomor Pesanan</span>
                    <h2 class="font-serif text-2xl font-bold text-neutral-900">{{ $order->order_number }}</h2>
                    <p class="text-xs text-neutral-500">Penerima: {{ $order->customer_name }} • {{ $order->shipping_city }}</p>
                </div>
                <div class="text-right">
                    @php
                        $statusBadge = match($order->status) {
                            'pending_payment' => ['bg-amber-100 text-amber-900', 'Menunggu Bayar'],
                            'paid' => ['bg-blue-100 text-blue-900', 'Lunas (Antrean Gudang)'],
                            'picking' => ['bg-purple-100 text-purple-900', 'Sedang Dipick di Gudang'],
                            'packed' => ['bg-indigo-100 text-indigo-900', 'Selesai Dipack & Siap Dikirim'],
                            'shipped' => ['bg-teal-100 text-teal-900', 'Dalam Perjalanan Kurir'],
                            'delivered', 'completed' => ['bg-emerald-100 text-emerald-900', 'Telah Diterima'],
                            default => ['bg-neutral-100 text-neutral-800', ucfirst($order->status)],
                        };
                    @endphp
                    <span class="px-3 py-1.5 rounded-full text-xs font-bold {{ $statusBadge[0] }}">
                        {{ $statusBadge[1] }}
                    </span>
                    @if($order->shipments->isNotEmpty() && $order->shipments->first()->tracking_number)
                        <p class="text-xs font-mono font-bold text-neutral-800 mt-2">
                            Resi {{ $order->shipments->first()->courier_name }}: {{ $order->shipments->first()->tracking_number }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Stepper Progress Timeline -->
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-700 mb-6">Tahapan Pemrosesan Pesanan</h3>
                
                @php
                    $steps = [
                        ['id' => 'paid', 'title' => 'Pembayaran Lunas', 'desc' => 'Diverifikasi otomatis gateway'],
                        ['id' => 'picking', 'title' => 'Picking Gudang', 'desc' => 'Item diambil staf gudang'],
                        ['id' => 'packed', 'title' => 'Packing & Scan Barcode', 'desc' => 'Verifikasi akurasi SKU'],
                        ['id' => 'shipped', 'title' => 'Dalam Pengiriman', 'desc' => 'Diserahkan ke kurir'],
                        ['id' => 'delivered', 'title' => 'Pesanan Diterima', 'desc' => 'Garansi retur 7 hari aktif'],
                    ];

                    $statusRank = [
                        'pending_payment' => 0,
                        'paid' => 1,
                        'picking' => 2,
                        'packed' => 3,
                        'shipped' => 4,
                        'delivered' => 5,
                        'completed' => 5,
                    ];
                    $currentRank = $statusRank[$order->status] ?? 0;
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 relative">
                    @foreach($steps as $index => $step)
                        @php
                            $stepRank = $index + 1;
                            $isComplete = $currentRank >= $stepRank;
                            $isCurrent = $currentRank === $stepRank;
                        @endphp
                        <div class="flex flex-col items-center text-center p-3 rounded-2xl {{ $isCurrent ? 'bg-brand-50 border border-brand-200' : '' }}">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs mb-2 {{ $isComplete ? 'bg-neutral-900 text-white' : 'bg-neutral-200 text-neutral-500' }}">
                                @if($isComplete)
                                    ✓
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </div>
                            <p class="text-xs font-bold {{ $isComplete ? 'text-neutral-900' : 'text-neutral-400' }}">{{ $step['title'] }}</p>
                            <p class="text-[10px] text-neutral-400 mt-0.5 leading-tight">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Ordered Items List -->
            <div class="pt-6 border-t border-neutral-100">
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-700 mb-4">Item dalam Pesanan Ini</h3>
                <div class="divide-y divide-neutral-100">
                    @foreach($order->items as $item)
                        <div class="py-3 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded bg-neutral-100 font-bold flex items-center justify-center text-[10px]">{{ $item->quantity }}x</span>
                                <div>
                                    <p class="font-bold text-neutral-900">{{ $item->product_name }}</p>
                                    <p class="text-[10px] text-neutral-500">{{ $item->variant_name }} ({{ $item->sku_code }})</p>
                                </div>
                            </div>
                            <span class="font-semibold text-neutral-900">{{ \App\Modules\Shared\Money\Money::format($item->subtotal_idr) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Return Option if delivered -->
            @if(in_array($order->status, ['delivered', 'completed']))
                <div class="p-4 rounded-2xl bg-neutral-50 border border-neutral-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                    <div>
                        <p class="font-bold text-neutral-900">Ukuran kurang pas atau ingin tukar varian?</p>
                        <p class="text-neutral-500 text-[11px]">Anda memiliki garansi retur/tukar 7 hari mandiri.</p>
                    </div>
                    <a href="{{ route('shop.returns', ['order_number' => $order->order_number]) }}" class="px-5 py-2.5 bg-neutral-900 hover:bg-neutral-800 text-white rounded-xl font-bold uppercase tracking-wider text-[11px] whitespace-nowrap">
                        Ajukan Retur Mandiri
                    </a>
                </div>
            @endif
        </div>
    @elseif(request('order_number'))
        <div class="p-8 text-center bg-white rounded-3xl border border-neutral-200">
            <p class="text-sm font-semibold text-neutral-800">Nomor pesanan "{{ request('order_number') }}" tidak ditemukan.</p>
            <p class="text-xs text-neutral-500 mt-1">Pastikan penulisan nomor pesanan sesuai dengan email konfirmasi Anda.</p>
        </div>
    @endif
</div>
@endsection

