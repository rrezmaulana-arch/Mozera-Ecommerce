@extends('layouts.admin')

@section('title', 'Eksklusif Drops & Waitlist — ITSFRIDAY Admin')
@section('page_title', 'Rilisan Eksklusif Drop & Waitlist')
@section('page_subtitle', 'Alokasi Kuota Drop, Jadwal Rilis & Pendaftar Antrean')

@section('content')
<div class="space-y-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Drops List (Col 8) -->
        <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm">
            <div class="p-5 border-b border-neutral-800">
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Jadwal Rilisan Drop Eksklusif</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-neutral-300">
                    <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                        <tr>
                            <th class="py-3 px-4">Judul Drop</th>
                            <th class="py-3 px-4">Waktu Rilis</th>
                            <th class="py-3 px-4">SKU & Kuota</th>
                            <th class="py-3 px-4">Terjual</th>
                            <th class="py-3 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800/60 font-normal">
                        @foreach($drops as $drop)
                            <tr class="hover:bg-neutral-800/40 transition-colors">
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-white">{{ $drop->title }}</p>
                                    <p class="text-[10px] text-neutral-500 font-mono">{{ $drop->code }}</p>
                                </td>
                                <td class="py-3.5 px-4 font-mono text-neutral-300">
                                    {{ $drop->drop_time->format('d M Y H:i') }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @foreach($drop->items as $it)
                                        <p class="text-white">{{ $it->sku->name }}</p>
                                        <p class="text-[10px] text-brand-300">Kuota: {{ $it->drop_quota }} pcs</p>
                                    @endforeach
                                </td>
                                <td class="py-3.5 px-4 font-bold text-white">
                                    {{ $drop->items->sum('sold_count') }} pcs
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($drop->isLive())
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-950 text-emerald-300 border border-emerald-800">
                                            ● LIVE NOW
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-neutral-800 text-neutral-400">
                                            Terjadwal
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Schedule Drop Form (Col 4) -->
        <div class="lg:col-span-4 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Jadwalkan Drop Baru</h3>
            <form action="{{ route('admin.store.drops.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kode Drop *</label>
                    <input type="text" name="code" required placeholder="Contoh: DROP-NOV-2026" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-mono uppercase focus:outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Judul Drop *</label>
                    <input type="text" name="title" required placeholder="Sept Drops: Heritage Coat" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-xl text-white focus:outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Waktu Mulai Drop *</label>
                    <input type="datetime-local" name="drop_time" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">SKU yang Ditargetkan *</label>
                    <select name="sku_id" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                        @foreach($skus as $sku)
                            <option value="{{ $sku->id }}">{{ $sku->sku_code }} — {{ $sku->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Alokasi Kuota Drop (pcs) *</label>
                    <input type="number" name="drop_quota" value="25" min="1" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-bold">
                </div>
                <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider mt-2">
                    Jadwalkan Drop
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

