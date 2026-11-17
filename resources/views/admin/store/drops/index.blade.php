@extends('layouts.admin')

@section('title', 'Eksklusif Drops & Waitlist — MOZÉRA Admin')
@section('page_title', 'Rilisan Eksklusif Drop & Waitlist')
@section('page_subtitle', 'Alokasi Kuota Drop, Jadwal Rilis & Pendaftar Antrean')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 items-start">
        <!-- Drops List (Col 8) -->
        <div class="xl:col-span-8 bg-[#121215] border border-neutral-800/90 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-5 border-b border-neutral-800/80 flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-300">Jadwal Rilisan Drop Eksklusif</h3>
                    <p class="text-[11px] text-neutral-500 mt-0.5">Daftar batch drop berbatas waktu dan alokasi kuota produk.</p>
                </div>
                <span class="text-[10px] font-bold uppercase px-2.5 py-1 rounded-full bg-neutral-800/80 text-neutral-400 border border-neutral-700/60 font-mono">
                    {{ $drops->count() }} Rilisan
                </span>
            </div>
            <div class="overflow-x-auto w-full custom-scrollbar">
                <table class="w-full text-left text-xs text-neutral-300">
                    <thead class="text-[10px] uppercase tracking-wider text-neutral-400 border-b border-neutral-800/80 bg-[#0e0e11]">
                        <tr>
                            <th class="py-3 px-4 font-semibold">Judul Drop</th>
                            <th class="py-3 px-4 font-semibold">Waktu Rilis</th>
                            <th class="py-3 px-4 font-semibold">SKU & Kuota</th>
                            <th class="py-3 px-4 font-semibold">Terjual</th>
                            <th class="py-3 px-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800/60 font-normal">
                        @forelse($drops as $drop)
                            <tr class="hover:bg-neutral-800/30 transition-colors">
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-white">{{ $drop->title }}</p>
                                    <p class="text-[10px] text-neutral-500 font-mono mt-0.5">{{ $drop->code }}</p>
                                </td>
                                <td class="py-3.5 px-4 font-mono text-neutral-300 whitespace-nowrap">
                                    {{ $drop->drop_time->format('d M Y H:i') }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @foreach($drop->items as $it)
                                        <p class="text-neutral-200 font-medium">{{ $it->sku->name }}</p>
                                        <p class="text-[10px] text-[#DCC3AD]">Kuota: <span class="font-semibold">{{ $it->drop_quota }} pcs</span></p>
                                    @endforeach
                                </td>
                                <td class="py-3.5 px-4 font-bold text-white whitespace-nowrap">
                                    {{ $drop->items->sum('sold_count') }} pcs
                                </td>
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    @if($drop->isLive())
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-950/80 text-emerald-300 border border-emerald-700/60">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            LIVE NOW
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-neutral-800/80 text-neutral-400 border border-neutral-700/60">
                                            Terjadwal
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-xs text-neutral-500">
                                    Belum ada jadwal rilisan drop eksklusif.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Schedule Drop Form (Col 4) -->
        <div class="xl:col-span-4 bg-[#121215] border border-neutral-800/90 rounded-2xl p-6 shadow-xl space-y-4">
            <div class="border-b border-neutral-800/80 pb-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-white">Jadwalkan Drop Baru</h3>
                <p class="text-[11px] text-neutral-400 mt-0.5">Alokasikan stok terbatas untuk flash drop.</p>
            </div>
            
            <form action="{{ route('admin.store.drops.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1.5">Kode Drop *</label>
                    <input type="text" name="code" required placeholder="CONTOH: DROP-NOV-2026" class="w-full px-3.5 py-2.5 bg-[#0e0e11] border border-neutral-700/80 rounded-xl text-white font-mono uppercase focus:outline-none focus:border-[#BA805E] transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1.5">Judul Drop *</label>
                    <input type="text" name="title" required placeholder="Sept Drops: Heritage Coat" class="w-full px-3.5 py-2.5 bg-[#0e0e11] border border-neutral-700/80 rounded-xl text-white focus:outline-none focus:border-[#BA805E] transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1.5">Waktu Mulai Drop *</label>
                    <input type="datetime-local" name="drop_time" required class="w-full px-3.5 py-2.5 bg-[#0e0e11] border border-neutral-700/80 rounded-xl text-white focus:outline-none focus:border-[#BA805E] transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1.5">SKU yang Ditargetkan *</label>
                    <select name="sku_id" required class="w-full px-3.5 py-2.5 bg-[#0e0e11] border border-neutral-700/80 rounded-xl text-white focus:outline-none focus:border-[#BA805E] transition-colors">
                        @foreach($skus as $sku)
                            <option value="{{ $sku->id }}">{{ $sku->sku_code }} — {{ $sku->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1.5">Alokasi Kuota Drop (pcs) *</label>
                    <input type="number" name="drop_quota" value="25" min="1" required class="w-full px-3.5 py-2.5 bg-[#0e0e11] border border-neutral-700/80 rounded-xl text-white font-bold focus:outline-none focus:border-[#BA805E] transition-colors">
                </div>
                <button type="submit" class="w-full py-3 bg-[#BA805E] hover:bg-[#A66747] text-white font-bold rounded-xl text-xs uppercase tracking-wider shadow-lg shadow-[#BA805E]/20 transition-all cursor-pointer">
                    Jadwalkan Drop
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
