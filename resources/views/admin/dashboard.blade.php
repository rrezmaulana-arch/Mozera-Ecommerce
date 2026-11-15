@extends('layouts.admin')

@section('title', 'Command Center — ITSFRIDAY')
@section('page_title', 'Pusat Kendali Harian (Command Center)')
@section('page_subtitle', 'Keputusan & Tindakan Operasional Hari Ini')

@section('content')
<div class="space-y-8">
    <!-- Top KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-5 shadow-sm">
            <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-400">Total Nilai Penjualan (GMV)</span>
            <p class="font-bold text-2xl text-white mt-1">{{ \App\Modules\Shared\Money\Money::format($totalGmv) }}</p>
            <p class="text-[11px] text-emerald-400 mt-1">● Akumulasi pesanan lunas</p>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-5 shadow-sm">
            <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-400">Antrean Packing Gudang</span>
            <p class="font-bold text-2xl text-amber-400 mt-1">{{ $pendingPackCount }} Pesanan</p>
            <p class="text-[11px] text-neutral-400 mt-1">Siap dipindai & dipack hari ini</p>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-5 shadow-sm">
            <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-400">SKU Stok Menipis (&le; 5)</span>
            <p class="font-bold text-2xl text-rose-400 mt-1">{{ $lowStockCount }} Varian</p>
            <p class="text-[11px] text-rose-400 mt-1">Perlu keputusan reorder segera</p>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-5 shadow-sm">
            <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-400">Total Pelanggan Terdata</span>
            <p class="font-bold text-2xl text-white mt-1">{{ $customersCount }} Orang</p>
            <p class="text-[11px] text-neutral-400 mt-1">Aset CRM beridentitas & consent</p>
        </div>
    </div>

    <!-- DAILY DECISIONS QUEUE FOR OWNER (PRD Section 1 & 8) -->
    <div class="bg-neutral-900 border border-brand-500/30 rounded-3xl p-6 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-brand-500 animate-ping"></span>
                <div>
                    <h2 class="text-sm font-bold uppercase tracking-wider text-white">Antrean Keputusan Harian Pemilik (Daily Action Items)</h2>
                    <p class="text-xs text-neutral-400">Tindakan mendesak yang membutuhkan persetujuan atau keputusan Anda hari ini.</p>
                </div>
            </div>
            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-brand-500/20 text-brand-300 border border-brand-500/40">
                {{ $actionItems->count() }} Perlu Keputusan
            </span>
        </div>

        @if($actionItems->isEmpty())
            <div class="py-8 text-center text-xs text-neutral-500 border border-neutral-800 rounded-2xl bg-neutral-950/50">
                Semua keputusan harian telah diselesaikan! Operasional berjalan lancar tanpa hambatan.
            </div>
        @else
            <div class="space-y-3">
                @foreach($actionItems as $item)
                    <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded {{ $item->priority === 'high' ? 'bg-rose-950 text-rose-300 border border-rose-800' : 'bg-amber-950 text-amber-300 border border-amber-800' }}">
                                    {{ $item->category }}
                                </span>
                                <h3 class="text-xs font-bold text-white">{{ $item->title }}</h3>
                            </div>
                            <p class="text-xs text-neutral-400 leading-relaxed">{{ $item->description }}</p>
                        </div>

                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if($item->action_url)
                                <a href="{{ $item->action_url }}" class="px-3.5 py-1.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white text-xs font-bold transition-all">
                                    Buka & Tangani
                                </a>
                            @endif

                            <form action="{{ route('admin.actions.resolve', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 rounded-xl bg-neutral-800 hover:bg-neutral-700 text-emerald-400 border border-neutral-700" title="Tandai Selesai">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </button>
                            </form>

                            <form action="{{ route('admin.actions.dismiss', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 rounded-xl bg-neutral-800 hover:bg-neutral-700 text-neutral-400 border border-neutral-700" title="Abaikan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Multi-Channel & RFM Segmentation Breakdown -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Channel Performance (Col 6) -->
        <div class="lg:col-span-6 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Distribusi Penjualan per Kanal</h3>
            <div class="space-y-3">
                @foreach($channelStats as $ch)
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-neutral-950 border border-neutral-800 text-xs">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full {{ $ch->code === 'web' ? 'bg-emerald-400' : ($ch->code === 'shopee' ? 'bg-orange-500' : ($ch->code === 'tiktok' ? 'bg-cyan-400' : 'bg-purple-400')) }}"></span>
                            <div>
                                <p class="font-bold text-white">{{ $ch->name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $ch->description }}</p>
                            </div>
                        </div>
                        <span class="font-semibold text-neutral-300">{{ $ch->orders_count }} Pesanan</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- RFM Segments Summary (Col 6) -->
        <div class="lg:col-span-6 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Segmentasi Retensi CRM (RFM)</h3>
                <a href="{{ route('admin.crm.segments') }}" class="text-[11px] text-brand-300 hover:underline">Kelola &rarr;</a>
            </div>
            <div class="grid grid-cols-2 gap-3 text-xs">
                <div class="p-3.5 rounded-2xl bg-neutral-950 border border-neutral-800">
                    <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider">Champions</span>
                    <p class="font-bold text-lg text-white mt-1">{{ $segmentBreakdown['champions'] ?? 0 }} Pelanggan</p>
                    <p class="text-[10px] text-neutral-500">Frekuensi & nilai belanja puncak</p>
                </div>
                <div class="p-3.5 rounded-2xl bg-neutral-950 border border-neutral-800">
                    <span class="text-[10px] text-blue-400 font-bold uppercase tracking-wider">Loyal Customers</span>
                    <p class="font-bold text-lg text-white mt-1">{{ $segmentBreakdown['loyal'] ?? 0 }} Pelanggan</p>
                    <p class="text-[10px] text-neutral-500">Pelanggan rutin setia</p>
                </div>
                <div class="p-3.5 rounded-2xl bg-neutral-950 border border-neutral-800">
                    <span class="text-[10px] text-amber-400 font-bold uppercase tracking-wider">At Risk</span>
                    <p class="font-bold text-lg text-white mt-1">{{ $segmentBreakdown['at_risk'] ?? 0 }} Pelanggan</p>
                    <p class="text-[10px] text-neutral-500">Lama tidak kembali (&gt;90 hari)</p>
                </div>
                <div class="p-3.5 rounded-2xl bg-neutral-950 border border-neutral-800">
                    <span class="text-[10px] text-neutral-400 font-bold uppercase tracking-wider">New Registrations</span>
                    <p class="font-bold text-lg text-white mt-1">{{ $segmentBreakdown['new'] ?? 0 }} Pelanggan</p>
                    <p class="text-[10px] text-neutral-500">Baru masuk alur sambutan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Pesanan Terkini Semua Kanal</h3>
            <a href="{{ route('admin.store.orders.index') }}" class="text-[11px] text-brand-300 hover:underline">Semua Pesanan &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800">
                    <tr>
                        <th class="py-3 px-3">Nomor Order</th>
                        <th class="py-3 px-3">Kanal</th>
                        <th class="py-3 px-3">Pelanggan</th>
                        <th class="py-3 px-3">Total Nilai</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3">Waktu</th>
                        <th class="py-3 px-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @foreach($recentOrders as $ord)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3 px-3 font-mono font-bold text-white">{{ $ord->order_number }}</td>
                            <td class="py-3 px-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-neutral-800 text-neutral-300 border border-neutral-700">
                                    {{ $ord->channel->name }}
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <p class="font-medium text-white">{{ $ord->customer_name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $ord->customer_email }}</p>
                            </td>
                            <td class="py-3 px-3 font-semibold text-white">{{ \App\Modules\Shared\Money\Money::format($ord->grand_total_idr) }}</td>
                            <td class="py-3 px-3">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ord->status === 'paid' ? 'bg-blue-950 text-blue-300 border border-blue-800' : ($ord->status === 'delivered' ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-neutral-800 text-neutral-300') }}">
                                    {{ ucfirst($ord->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-3 text-neutral-500 text-[11px]">{{ $ord->created_at->diffForHumans() }}</td>
                            <td class="py-3 px-3 text-right">
                                <a href="{{ route('admin.store.orders.show', $ord->id) }}" class="text-brand-300 hover:underline font-semibold">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

