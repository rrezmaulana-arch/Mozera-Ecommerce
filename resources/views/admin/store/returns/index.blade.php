@extends('layouts.admin')

@section('title', 'Retur & Karantina — ITSFRIDAY Admin')
@section('page_title', 'Retur & Karantina Barang')
@section('page_subtitle', 'Pengajuan Mandiri Pelanggan, Pemeriksaan Fisik & Restock Gudang')

@section('content')
<div class="space-y-6">
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3.5 px-4">ID Retur</th>
                        <th class="py-3.5 px-4">Order Asal</th>
                        <th class="py-3.5 px-4">Pelanggan</th>
                        <th class="py-3.5 px-4">Alasan</th>
                        <th class="py-3.5 px-4">Item Diretur</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($returns as $ret)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">{{ substr($ret->ulid, 0, 10) }}...</td>
                            <td class="py-3.5 px-4 font-mono text-white">#{{ $ret->order->order_number }}</td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $ret->customer?->name ?? $ret->order->customer_name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $ret->customer?->phone ?? $ret->order->customer_phone }}</p>
                            </td>
                            <td class="py-3.5 px-4 text-neutral-300">{{ $ret->reason }}</td>
                            <td class="py-3.5 px-4 text-neutral-400">
                                @foreach($ret->items as $it)
                                    <span>{{ $it->quantity }}x {{ $it->sku->name }}</span>
                                @endforeach
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ret->status === 'submitted' ? 'bg-amber-950 text-amber-300 border border-amber-800' : ($ret->status === 'inspected_passed' ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-neutral-800 text-neutral-300') }}">
                                    {{ ucfirst(str_replace('_', ' ', $ret->status)) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.store.returns.show', $ret->id) }}" class="text-brand-300 hover:underline font-semibold">Inspeksi & Proses</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-neutral-500">Belum ada pengajuan retur aktif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $returns->links() }}
        </div>
    </div>
</div>
@endsection

