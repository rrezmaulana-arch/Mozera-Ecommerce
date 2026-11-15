@extends('layouts.admin')

@section('title', 'Pelanggan 360 CRM — ITSFRIDAY')
@section('page_title', 'Direktori Pelanggan & Profil 360')
@section('page_subtitle', 'Pengelolaan Pelanggan Beridentitas, Segmentasi RFM & Consent')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <!-- Search and Segment Filter -->
        <form method="GET" action="{{ route('admin.crm.customers.index') }}" class="flex items-center gap-2 text-xs">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, hp..." class="px-3.5 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none">
            <select name="segment" onchange="this.form.submit()" class="px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none">
                <option value="">Semua Segmen RFM</option>
                <option value="champions" {{ request('segment') == 'champions' ? 'selected' : '' }}>Champions</option>
                <option value="loyal" {{ request('segment') == 'loyal' ? 'selected' : '' }}>Loyal</option>
                <option value="potential" {{ request('segment') == 'potential' ? 'selected' : '' }}>Potential Loyalist</option>
                <option value="at_risk" {{ request('segment') == 'at_risk' ? 'selected' : '' }}>At Risk</option>
                <option value="hibernating" {{ request('segment') == 'hibernating' ? 'selected' : '' }}>Hibernating</option>
                <option value="lost" {{ request('segment') == 'lost' ? 'selected' : '' }}>Lost</option>
                <option value="new" {{ request('segment') == 'new' ? 'selected' : '' }}>New</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-neutral-800 hover:bg-neutral-700 rounded-xl font-semibold text-white">Filter</button>
        </form>

        <!-- Recalculate RFM Trigger -->
        <form action="{{ route('admin.crm.customers.recalculate') }}" method="POST">
            @csrf
            <button type="submit" class="px-5 py-2.5 bg-neutral-800 hover:bg-neutral-700 text-white rounded-xl text-xs font-semibold border border-neutral-700 flex items-center gap-2 transition-all">
                <svg class="w-4 h-4 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Hitung Ulang Skor RFM & Ritme
            </button>
        </form>
    </div>

    <!-- Customers Table -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3.5 px-4">Nama & Email</th>
                        <th class="py-3.5 px-4">Nomor HP</th>
                        <th class="py-3.5 px-4">Segmen RFM</th>
                        <th class="py-3.5 px-4 text-center">Skor (R-F-M)</th>
                        <th class="py-3.5 px-4">Total Order</th>
                        <th class="py-3.5 px-4">Total Belanja (LTV)</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @foreach($customers as $c)
                        @php
                            $m = $metrics->get($c->id);
                            $segBadge = match($m?->segment) {
                                'champions' => 'bg-emerald-950 text-emerald-300 border-emerald-800',
                                'loyal' => 'bg-blue-950 text-blue-300 border-blue-800',
                                'potential' => 'bg-indigo-950 text-indigo-300 border-indigo-800',
                                'at_risk' => 'bg-amber-950 text-amber-300 border-amber-800',
                                'hibernating' => 'bg-neutral-800 text-neutral-400 border-neutral-700',
                                'lost' => 'bg-rose-950 text-rose-300 border-rose-800',
                                default => 'bg-neutral-800 text-neutral-300 border-neutral-700',
                            };
                        @endphp
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $c->name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $c->email }}</p>
                            </td>
                            <td class="py-3.5 px-4 font-mono text-neutral-400">{{ $c->phone ?: '-' }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $segBadge }}">
                                    {{ ucfirst(str_replace('_', ' ', $m?->segment ?? 'New')) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center font-mono font-bold text-white">
                                {{ $m ? "{$m->r_score}-{$m->f_score}-{$m->m_score}" : '1-1-1' }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-white">{{ $c->orders_count }} Transaksi</td>
                            <td class="py-3.5 px-4 font-semibold text-white">
                                {{ \App\Modules\Shared\Money\Money::format($m?->monetary_total_idr ?? 0) }}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.crm.customers.show', $c->id) }}" class="text-brand-300 hover:underline font-semibold">
                                    Profil 360 &rarr;
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection
