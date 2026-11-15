@extends('layouts.admin')

@section('title', 'Order #' . $order->order_number . ' — ITSFRIDAY Admin')
@section('page_title', 'Detail Pesanan #' . $order->order_number)
@section('page_subtitle', 'Kanal: ' . $order->channel->name . ' • ' . $order->created_at->format('d M Y H:i'))

@section('content')
<div class="space-y-6">
    <!-- Status Control Bar -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
            <p class="text-xs text-neutral-400">Status Saat Ini:</p>
            <span class="text-base font-bold text-white capitalize">{{ $order->status }}</span>
            @if($order->paid_at)
                <p class="text-[10px] text-emerald-400 mt-0.5">● Terbayar pada {{ $order->paid_at->format('d M Y H:i') }}</p>
            @endif
        </div>

        <form action="{{ route('admin.store.orders.update-status', $order->id) }}" method="POST" class="flex flex-wrap items-center gap-3 text-xs">
            @csrf
            <div>
                <select name="status" class="px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                    <option value="pending_payment" {{ $order->status === 'pending_payment' ? 'selected' : '' }}>Menunggu Bayar</option>
                    <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Lunas (Antrean Gudang)</option>
                    <option value="picking" {{ $order->status === 'picking' ? 'selected' : '' }}>Picking di Gudang</option>
                    <option value="packed" {{ $order->status === 'packed' ? 'selected' : '' }}>Packed</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped (Dalam Pengiriman)</option>
                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered / Selesai</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>
            <div>
                <input type="text" name="tracking_number" value="{{ $order->shipments->first()?->tracking_number }}" placeholder="Nomor Resi (Opsional)" class="px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-mono">
            </div>
            <button type="submit" class="px-5 py-2 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider">
                Simpan Status
            </button>
        </form>
    </div>

    <!-- 2 Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Order Items (Col 8) -->
        <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Rincian Barang yang Dipesan</h3>
            <div class="divide-y divide-neutral-800">
                @foreach($order->items as $item)
                    <div class="py-3 flex items-center justify-between text-xs">
                        <div class="space-y-0.5">
                            <p class="font-bold text-white">{{ $item->product_name }}</p>
                            <p class="text-neutral-400 text-[11px]">{{ $item->variant_name }} • SKU: <span class="font-mono text-neutral-300">{{ $item->sku_code }}</span></p>
                            <p class="text-[10px] text-neutral-500">Harga Beku: {{ \App\Modules\Shared\Money\Money::format($item->unit_price_idr) }} x {{ $item->quantity }} pcs</p>
                        </div>
                        <span class="font-bold text-white text-sm">{{ \App\Modules\Shared\Money\Money::format($item->subtotal_idr) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="pt-4 border-t border-neutral-800 space-y-2 text-xs">
                <div class="flex justify-between text-neutral-400">
                    <span>Subtotal</span>
                    <span class="text-white">{{ \App\Modules\Shared\Money\Money::format($order->subtotal_idr) }}</span>
                </div>
                @if($order->discount_idr > 0)
                    <div class="flex justify-between text-emerald-400">
                        <span>Diskon</span>
                        <span>- {{ \App\Modules\Shared\Money\Money::format($order->discount_idr) }}</span>
                    </div>
                @endif
                <div class="flex justify-between text-neutral-400">
                    <span>Ongkos Kirim ({{ $order->shipping_courier }})</span>
                    <span class="text-white">{{ \App\Modules\Shared\Money\Money::format($order->shipping_cost_idr) }}</span>
                </div>
                <div class="pt-2 border-t border-neutral-800 flex justify-between items-baseline text-sm font-bold">
                    <span class="text-white uppercase tracking-wider">Total Tagihan</span>
                    <span class="text-brand-300 text-lg">{{ \App\Modules\Shared\Money\Money::format($order->grand_total_idr) }}</span>
                </div>
            </div>
        </div>

        <!-- Customer & Shipment Info (Col 4) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Customer -->
            <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-3 text-xs">
                <h3 class="font-bold uppercase tracking-wider text-neutral-400">Data Pelanggan</h3>
                <div>
                    <p class="font-bold text-white text-sm">{{ $order->customer_name }}</p>
                    <p class="text-neutral-400">{{ $order->customer_email }}</p>
                    <p class="text-neutral-400 font-mono">{{ $order->customer_phone ?: '-' }}</p>
                </div>
                @if($order->customer_id)
                    <a href="{{ route('admin.crm.customers.show', $order->customer_id) }}" class="inline-block text-brand-300 hover:underline font-semibold mt-1">
                        Lihat Profil 360 & Poin &rarr;
                    </a>
                @endif
            </div>

            <!-- Shipping -->
            <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-3 text-xs">
                <h3 class="font-bold uppercase tracking-wider text-neutral-400">Tujuan Pengiriman</h3>
                <p class="text-neutral-300 leading-relaxed">{{ $order->shipping_address }}</p>
                <p class="text-neutral-400">{{ $order->shipping_city }}, {{ $order->shipping_province }}</p>
                <div class="pt-2 border-t border-neutral-800">
                    <p class="text-[10px] text-neutral-500 uppercase tracking-wider">Kurir & Resi</p>
                    <p class="font-bold text-white mt-0.5">{{ $order->shipping_courier }} ({{ $order->shipping_service }})</p>
                    @if($order->shipments->isNotEmpty() && $order->shipments->first()->tracking_number)
                        <p class="text-xs font-mono text-emerald-400 font-bold mt-1">Resi: {{ $order->shipments->first()->tracking_number }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

