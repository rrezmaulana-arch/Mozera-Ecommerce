@extends('layouts.shop')

@section('title', 'Lacak Status Pesanan — MOETIA')
@section('meta_description', 'Pantau status pesanan dan nomor resi pengiriman busana MOETIA secara mandiri dan real-time.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 select-none">
    
    <!-- Hero Header -->
    <div class="text-center max-w-2xl mx-auto mb-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-neutral-100 text-neutral-800 text-[11px] font-semibold tracking-wide mb-3 border border-neutral-200">
            <svg class="w-3.5 h-3.5 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span>Layanan Pelacakan Mandiri 24/7</span>
        </div>
        <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-neutral-900 tracking-tight">
            Lacak Perjalanan Pesanan
        </h1>
        <p class="text-xs sm:text-sm text-neutral-600 mt-3 leading-relaxed">
            Pantau status pesanan dan nomor resi pengiriman busana Anda langsung dari gudang pusat hingga sampai ke depan pintu Anda.
        </p>
    </div>

    <!-- Search Form Card -->
    <div class="bg-white rounded-2xl border border-neutral-200/80 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] p-5 sm:p-7 mb-8">
        <label for="order_number" class="block text-xs font-bold text-neutral-900 tracking-wide mb-2.5">
            Nomor Pesanan
        </label>
        
        <form action="{{ route('shop.tracking') }}" method="GET" class="space-y-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="relative">
                    <label for="order_number" class="block text-xs font-bold text-neutral-800 mb-1.5">Nomor Pesanan *</label>
                    <input 
                        type="text" 
                        id="order_number"
                        name="order_number" 
                        value="{{ request('order_number') ?? ($order ? $order->order_number : '') }}" 
                        placeholder="Contoh: ORD-20261110-001" 
                        class="w-full text-xs sm:text-sm px-4 py-3 bg-[#FAF9F6] border border-neutral-200 rounded-xl focus:bg-white focus:outline-none focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900 transition-all font-mono placeholder:text-neutral-400 text-neutral-900" 
                        required
                    >
                </div>
                <div class="relative">
                    <label for="verification" class="block text-xs font-bold text-neutral-800 mb-1.5">Email Pemesan / 4 Digit Akhir No. HP *</label>
                    <input 
                        type="text" 
                        id="verification"
                        name="verification" 
                        value="{{ request('verification') }}" 
                        placeholder="Contoh: nama@email.com atau 4 digit HP" 
                        class="w-full text-xs sm:text-sm px-4 py-3 bg-[#FAF9F6] border border-neutral-200 rounded-xl focus:bg-white focus:outline-none focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900 transition-all placeholder:text-neutral-400 text-neutral-900" 
                        required
                    >
                </div>
            </div>
            <div>
                <button 
                    type="submit" 
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3 bg-neutral-900 hover:bg-neutral-800 active:scale-[0.99] text-white rounded-xl font-semibold text-xs tracking-wider uppercase transition-all shadow-sm cursor-pointer select-none focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2"
                >
                    <span>Lacak Pesanan Mandiri</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>
        </form>

        <div class="mt-3.5 pt-3 border-t border-neutral-100 flex flex-wrap items-center gap-2 text-xs text-neutral-500">
            <span class="text-[11px] text-neutral-400">Contoh order aktif:</span>
            <a href="{{ route('shop.tracking', ['order_number' => 'ORD-20261110-001']) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-neutral-100 hover:bg-neutral-200 text-neutral-800 text-[11px] font-mono transition-colors cursor-pointer select-none">
                <span>ORD-20261110-001</span>
                <span class="text-[10px] text-emerald-700 font-sans font-medium">(Selesai)</span>
            </a>
            <a href="{{ route('shop.tracking', ['order_number' => 'ORD-20261115-002']) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-neutral-100 hover:bg-neutral-200 text-neutral-800 text-[11px] font-mono transition-colors cursor-pointer select-none">
                <span>ORD-20261115-002</span>
                <span class="text-[10px] text-purple-700 font-sans font-medium">(Proses Gudang)</span>
            </a>
        </div>
    </div>

    @if($order)
        <!-- Order Result Card -->
        <div class="bg-white rounded-2xl border border-neutral-200/90 shadow-[0_8px_30px_-6px_rgba(0,0,0,0.06)] p-6 sm:p-8 space-y-8">
            
            <!-- Header Status -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-neutral-100 gap-4">
                <div>
                    <span class="text-[11px] font-mono text-neutral-400 uppercase tracking-wider">PESANAN TERDAFTAR</span>
                    <h2 class="font-serif text-2xl font-bold text-neutral-900 mt-0.5">#{{ $order->order_number }}</h2>
                    <p class="text-xs text-neutral-500 mt-1">
                        Penerima: <strong class="text-neutral-800">{{ $order->customer_name }}</strong> ({{ $order->customer_phone }}) &bull; Alamat: {{ $order->shipping_address }}, {{ $order->shipping_city }}
                    </p>
                </div>
                <div class="sm:text-right">
                    @php
                        $statusBadge = match($order->status) {
                            'pending_payment' => ['bg-amber-50 text-amber-800 border-amber-200', 'Menunggu Pembayaran'],
                            'paid' => ['bg-blue-50 text-blue-800 border-blue-200', 'Lunas &bull; Antrean Gudang'],
                            'picking' => ['bg-purple-50 text-purple-800 border-purple-200', 'Sedang Dipick di Gudang'],
                            'packed' => ['bg-indigo-50 text-indigo-800 border-indigo-200', 'Selesai Dipack & Siap Kirim'],
                            'shipped' => ['bg-teal-50 text-teal-800 border-teal-200', 'Dalam Perjalanan Kurir'],
                            'delivered', 'completed' => ['bg-emerald-50 text-emerald-800 border-emerald-200', 'Pesanan Diterima'],
                            default => ['bg-neutral-100 text-neutral-800 border-neutral-200', ucfirst($order->status)],
                        };
                    @endphp
                    <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-semibold border {{ $statusBadge[0] }}">
                        {!! $statusBadge[1] !!}
                    </span>
                    @if($order->shipments->isNotEmpty() && $order->shipments->first()->tracking_number)
                        <p class="text-xs font-mono font-bold text-neutral-800 mt-2">
                            Resi {{ $order->shipments->first()->courier_name }}: <span class="bg-neutral-100 px-2 py-0.5 rounded text-neutral-900">{{ $order->shipments->first()->tracking_number }}</span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Stepper Progress Timeline -->
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-800 mb-5">Perjalanan Paket Busana</h3>
                
                @php
                    $steps = [
                        ['id' => 'paid', 'title' => 'Pembayaran Lunas', 'desc' => 'Diverifikasi otomatis'],
                        ['id' => 'picking', 'title' => 'Picking Gudang', 'desc' => 'Item diambil dari rak'],
                        ['id' => 'packed', 'title' => 'Packing & Barcode', 'desc' => 'QC fisik 100% akurat'],
                        ['id' => 'shipped', 'title' => 'Pengiriman Kurir', 'desc' => 'Menuju kota tujuan'],
                        ['id' => 'delivered', 'title' => 'Pesanan Diterima', 'desc' => 'Garansi 7 hari aktif'],
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

                <div class="grid grid-cols-1 sm:grid-cols-5 gap-3">
                    @foreach($steps as $index => $step)
                        @php
                            $stepRank = $index + 1;
                            $isComplete = $currentRank >= $stepRank;
                            $isCurrent = $currentRank === $stepRank;
                        @endphp
                        <div class="p-3.5 rounded-xl border {{ $isCurrent ? 'bg-neutral-900 text-white border-neutral-900 shadow-sm' : ($isComplete ? 'bg-white border-neutral-200 text-neutral-900' : 'bg-neutral-50/50 border-neutral-200/60 text-neutral-400') }} transition-all">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center font-bold text-[11px] {{ $isCurrent ? 'bg-white text-neutral-900' : ($isComplete ? 'bg-neutral-900 text-white' : 'bg-neutral-200 text-neutral-500') }}">
                                    @if($isComplete)
                                        ✓
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </div>
                                <span class="text-[10px] font-mono uppercase tracking-wider opacity-60">Langkah {{ $index + 1 }}</span>
                            </div>
                            <p class="text-xs font-bold leading-tight">{{ $step['title'] }}</p>
                            <p class="text-[11px] mt-1 leading-snug {{ $isCurrent ? 'text-neutral-300' : 'text-neutral-500' }}">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Ordered Items List -->
            <div class="pt-6 border-t border-neutral-100">
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-800 mb-4">Item Busana Terverifikasi</h3>
                <div class="divide-y divide-neutral-100">
                    @foreach($order->items as $item)
                        <div class="py-3 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded bg-neutral-100 font-bold flex items-center justify-center text-[10px] text-neutral-700">{{ $item->quantity }}x</span>
                                <div>
                                    <p class="font-bold text-neutral-900">{{ $item->product_name }}</p>
                                    <p class="text-[11px] text-neutral-500">{{ $item->variant_name }} &bull; SKU: {{ $item->sku_code }}</p>
                                </div>
                            </div>
                            <span class="font-bold text-neutral-900">{{ \App\Modules\Shared\Money\Money::format($item->subtotal_idr) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Return Option if delivered -->
            @if(in_array($order->status, ['delivered', 'completed']))
                <div class="p-4 rounded-xl bg-brand-50/70 border border-brand-200/80 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                    <div>
                        <p class="font-bold text-brand-950">Ukuran kurang pas atau ingin tukar warna?</p>
                        <p class="text-neutral-600 text-[11px] mt-0.5">Garansi retur & tukar ukuran mandiri 7 hari Anda masih berlaku aktif.</p>
                    </div>
                    <a href="{{ route('shop.returns', ['order_number' => $order->order_number]) }}" class="px-5 py-2.5 bg-neutral-900 hover:bg-neutral-800 text-white rounded-xl font-bold tracking-wider uppercase text-[11px] whitespace-nowrap cursor-pointer select-none transition-all">
                        Ajukan Retur Mandiri &rarr;
                    </a>
                </div>
            @endif
        </div>
    @elseif(request('order_number'))
        <div class="p-8 text-center bg-white rounded-2xl border border-neutral-200 shadow-sm max-w-lg mx-auto space-y-3">
            <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-700 flex items-center justify-center mx-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-neutral-900">Pesanan Tidak Ditemukan</h3>
            <p class="text-xs text-neutral-600 leading-relaxed">
                Nomor pesanan "{{ request('order_number') }}" tidak terdaftar di sistem. Mohon pastikan penulisan sesuai dengan nomor pada email konfirmasi Anda.
            </p>
        </div>
    @endif
</div>
@endsection
