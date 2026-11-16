@extends('layouts.admin')

@section('title', 'Poin Loyalitas — ITSFRIDAY CRM')
@section('page_title', 'Program Poin Loyalitas Pelanggan')
@section('page_subtitle', 'Pencatatan Poin Otomatis dari Transaksi & Buku Besar Poin (Append-Only)')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Points Ledger (Col 8) -->
    <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm space-y-4">
        <!-- Stats Bar -->
        <div class="p-6 border-b border-neutral-800 grid grid-cols-2 gap-4">
            <div>
                <span class="text-[10px] text-neutral-400 uppercase tracking-wider font-bold">Total Poin Diterbitkan</span>
                <p class="font-bold text-2xl text-emerald-400 mt-1">+{{ number_format($totalPointsIssued, 0, ',', '.') }} Poin</p>
            </div>
            <div>
                <span class="text-[10px] text-neutral-400 uppercase tracking-wider font-bold">Total Poin Ditukarkan</span>
                <p class="font-bold text-2xl text-rose-400 mt-1">-{{ number_format($totalPointsRedeemed, 0, ',', '.') }} Poin</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4">Pelanggan</th>
                        <th class="py-3 px-4">Tipe Transaksi</th>
                        <th class="py-3 px-4 text-center">Poin</th>
                        <th class="py-3 px-4">Keterangan / Order</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($ledgers as $l)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono text-neutral-400">{{ $l->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $l->customer->name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $l->customer->email }}</p>
                            </td>
                            <td class="py-3.5 px-4 font-mono text-[10px] text-neutral-300">{{ $l->transaction_type }}</td>
                            <td class="py-3.5 px-4 text-center font-mono font-bold text-sm {{ $l->points > 0 ? 'text-emerald-400' : 'text-rose-400' }}">
                                {{ $l->points > 0 ? "+{$l->points}" : $l->points }}
                            </td>
                            <td class="py-3.5 px-4 text-neutral-400">{{ $l->notes }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-neutral-500">Belum ada transaksi poin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $ledgers->links() }}
        </div>
    </div>

    <!-- Manual Adjustment Form (Col 4) -->
    <div class="lg:col-span-4 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Penyesuaian Poin Manual</h3>

        <form action="{{ route('admin.crm.loyalty.adjust') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Pilih Pelanggan *</label>
                <select name="customer_id" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->email }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Jumlah Poin (+ untuk tambah, - untuk kurang) *</label>
                <input type="number" name="points" required placeholder="Contoh: 50 atau -20" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-mono font-bold">
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Alasan Penyesuaian *</label>
                <input type="text" name="notes" required placeholder="Contoh: Kompensasi keterlambatan pengiriman" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider mt-2">
                Simpan ke Buku Besar Poin
            </button>
        </form>
    </div>
</div>
@endsection

