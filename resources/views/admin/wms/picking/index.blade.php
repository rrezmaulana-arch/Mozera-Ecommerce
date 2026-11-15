@extends('layouts.admin')

@section('title', 'Picking & Packing Gudang — ITSFRIDAY WMS')
@section('page_title', 'Picking & Packing Gudang')
@section('page_subtitle', 'Verifikasi Akurasi Barang Menggunakan Pemindai Barcode Web')

@section('content')
<div class="space-y-8">
    <!-- Active Pick & Pack Queue -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Antrean Pesanan Menunggu Dipack</h3>
                <p class="text-[10px] text-neutral-500">Staf gudang memverifikasi setiap SKU menggunakan pemindai barcode kamera / laser sebelum cetak resi.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-950 text-amber-300 border border-amber-800">
                {{ $pickPacks->total() }} Menunggu
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">No. Order</th>
                        <th class="py-3 px-4">Penerima & Kota</th>
                        <th class="py-3 px-4">Daftar Item & Kuantitas</th>
                        <th class="py-3 px-4">Kurir</th>
                        <th class="py-3 px-4">Status Picking</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($pickPacks as $pp)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">#{{ $pp->order->order_number }}</td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $pp->order->customer_name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $pp->order->shipping_city }}</p>
                            </td>
                            <td class="py-3.5 px-4">
                                <ul class="space-y-0.5 text-neutral-300">
                                    @foreach($pp->order->items as $it)
                                        <li>{{ $it->quantity }}x {{ $it->product_name }} ({{ $it->variant_name }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-white">{{ $pp->order->shipping_courier }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $pp->status === 'picking' ? 'bg-purple-950 text-purple-300 border border-purple-800' : 'bg-neutral-800 text-neutral-400' }}">
                                    {{ ucfirst($pp->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.wms.picking.scan', $pp->id) }}" class="px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl text-xs uppercase tracking-wider inline-flex items-center gap-1.5 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                    Stasiun Scan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-neutral-500">Tidak ada antrean pesanan yang menunggu dipack saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $pickPacks->links() }}
        </div>
    </div>

    <!-- Recently Packed Audit -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Selesai Dipack & Dikeluarkan dari Ledger Gudang (Hari Ini)</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">No. Order</th>
                        <th class="py-3 px-4">Staf Pemroses</th>
                        <th class="py-3 px-4">Resi Pengiriman</th>
                        <th class="py-3 px-4">Waktu Selesai Pack</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($recentPacked as $rp)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">#{{ $rp->order->order_number }}</td>
                            <td class="py-3.5 px-4 text-white">{{ $rp->assignee?->name ?? 'Staf Gudang' }}</td>
                            <td class="py-3.5 px-4 font-mono text-emerald-400 font-bold">
                                {{ $rp->order->shipments->first()?->tracking_number ?? 'Label Dibuat' }}
                            </td>
                            <td class="py-3.5 px-4 text-neutral-500 text-[11px]">{{ $rp->packed_at?->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-neutral-500">Belum ada aktivitas packing baru hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
