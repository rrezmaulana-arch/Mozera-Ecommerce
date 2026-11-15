@extends('layouts.admin')

@section('title', 'Manajemen Pesanan — ITSFRIDAY Admin')
@section('page_title', 'Pesanan Semua Kanal Terpadu')
@section('page_subtitle', 'Toko Online, Shopee, TikTok Shop & Bazar Pop-Up')

@section('content')
<div class="space-y-6">
    <!-- Filters -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-4 shadow-sm">
        <form method="GET" action="{{ route('admin.store.orders.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-xs">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor order / pelanggan..." class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
            </div>
            <div>
                <select name="channel_id" onchange="this.form.submit()" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                    <option value="">Semua Kanal</option>
                    @foreach($channels as $c)
                        <option value="{{ $c->id }}" {{ request('channel_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                    <option value="">Semua Status</option>
                    <option value="pending_payment" {{ request('status') == 'pending_payment' ? 'selected' : '' }}>Menunggu Bayar</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas (Antrean Gudang)</option>
                    <option value="picking" {{ request('status') == 'picking' ? 'selected' : '' }}>Picking di Gudang</option>
                    <option value="packed" {{ request('status') == 'packed' ? 'selected' : '' }}>Packed</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped (Dalam Pengiriman)</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered / Selesai</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full py-2 bg-neutral-800 hover:bg-neutral-700 rounded-xl font-semibold text-white">Filter</button>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3.5 px-4">Nomor Pesanan</th>
                        <th class="py-3.5 px-4">Kanal</th>
                        <th class="py-3.5 px-4">Pelanggan</th>
                        <th class="py-3.5 px-4">Item & Varian</th>
                        <th class="py-3.5 px-4">Total Rupiah</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Waktu</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @foreach($orders as $ord)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">{{ $ord->order_number }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-neutral-800 text-neutral-300 border border-neutral-700">
                                    {{ $ord->channel->name }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $ord->customer_name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $ord->shipping_city }}</p>
                            </td>
                            <td class="py-3.5 px-4 text-neutral-400">
                                {{ $ord->items->sum('quantity') }} pcs ({{ $ord->items->pluck('product_name')->unique()->join(', ') }})
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-white">
                                {{ \App\Modules\Shared\Money\Money::format($ord->grand_total_idr) }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ord->status === 'paid' ? 'bg-blue-950 text-blue-300 border border-blue-800' : ($ord->status === 'delivered' ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : ($ord->status === 'picking' ? 'bg-purple-950 text-purple-300' : 'bg-neutral-800 text-neutral-300')) }}">
                                    {{ ucfirst($ord->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-neutral-500 text-[11px]">{{ $ord->created_at->format('d M H:i') }}</td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.store.orders.show', $ord->id) }}" class="text-brand-300 hover:underline font-semibold">Buka</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection

