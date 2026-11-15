@extends('layouts.admin')

@section('title', 'Alur Email & Antrean Persetujuan — ITSFRIDAY CRM')
@section('page_title', 'Alur Email Otomatis & Antrean Approval')
@section('page_subtitle', 'Mesin Kampanye Berbasis Event & Kontrol Persetujuan Pemilik')

@section('content')
<div class="space-y-8">
    <!-- OWNER APPROVAL QUEUE (PRD Section 8) -->
    <div class="bg-neutral-900 border border-brand-500/40 rounded-3xl p-6 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-500 animate-ping"></span>
                    Antrean Persetujuan Email Pemilik (Approval Queue)
                </h3>
                <p class="text-[10px] text-neutral-400">Pesan kampanye win-back atau penjangkauan bernilai tinggi memerlukan persetujuan pemilik sebelum dikirimkan.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-500/20 text-brand-300 border border-brand-500/30">
                {{ $pendingApprovals->count() }} Menunggu Persetujuan
            </span>
        </div>

        @if($pendingApprovals->isEmpty())
            <div class="py-6 text-center text-xs text-neutral-500 border border-neutral-800 rounded-2xl bg-neutral-950/40">
                Tidak ada draf email pemasaran yang menunggu persetujuan pemilik saat ini.
            </div>
        @else
            <div class="space-y-3">
                @foreach($pendingApprovals as $pa)
                    <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-950 text-amber-300 border border-amber-800">
                                    {{ $pa->flow->name }}
                                </span>
                                <h4 class="font-bold text-white">{{ $pa->customer->name }} ({{ $pa->customer->email }})</h4>
                            </div>
                            <p class="text-neutral-400 text-[11px]">Dijadwalkan untuk: {{ $pa->scheduled_for->format('d M Y H:i') }}</p>
                        </div>

                        <div class="flex items-center gap-2 flex-shrink-0">
                            <form action="{{ route('admin.crm.flows.approve', $pa->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition-all">
                                    ✓ Setujui & Kirim
                                </button>
                            </form>
                            <form action="{{ route('admin.crm.flows.reject', $pa->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-neutral-800 hover:bg-neutral-700 text-rose-400 font-bold rounded-xl text-xs uppercase tracking-wider border border-neutral-700 transition-all">
                                    ✕ Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Active Flows Overview -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Daftar Alur Pemasaran Aktif (Marketing Flows)</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($flows as $flow)
                <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 space-y-2 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-white">{{ $flow->name }}</span>
                        <span class="w-2 h-2 rounded-full {{ $flow->is_active ? 'bg-emerald-400' : 'bg-neutral-600' }}"></span>
                    </div>
                    <p class="text-[10px] text-neutral-500">Pemicu: <strong class="text-neutral-400">{{ $flow->trigger_event }}</strong></p>
                    <p class="text-[10px] text-neutral-500">Jeda Waktu: {{ $flow->delay_hours }} jam</p>
                    <div class="pt-2 border-t border-neutral-800/80 flex items-center justify-between">
                        <span class="text-[10px] text-brand-300 font-mono">{{ $flow->runs_count }} Dieksekusi</span>
                        <span class="text-[9px] px-2 py-0.5 rounded {{ $flow->requires_approval ? 'bg-amber-950 text-amber-300' : 'bg-neutral-800 text-neutral-400' }}">
                            {{ $flow->requires_approval ? 'Wajib Approval' : 'Otomatis' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Executions Log -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="p-5 border-b border-neutral-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Riwayat Eksekusi Pesan Terkirim</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">Nama Alur</th>
                        <th class="py-3 px-4">Penerima</th>
                        <th class="py-3 px-4">Disetujui Oleh</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Waktu Kirim</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($recentRuns as $rr)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-bold text-white">{{ $rr->flow->name }}</td>
                            <td class="py-3.5 px-4">
                                <p class="text-white">{{ $rr->customer->name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $rr->customer->email }}</p>
                            </td>
                            <td class="py-3.5 px-4 text-neutral-400">{{ $rr->approver?->name ?? 'Auto System' }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $rr->status === 'sent' ? 'bg-emerald-950 text-emerald-300' : 'bg-neutral-800 text-neutral-400' }}">
                                    {{ ucfirst($rr->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-neutral-500 text-[11px]">{{ $rr->sent_at?->diffForHumans() ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-neutral-500">Belum ada riwayat pengiriman alur.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $recentRuns->links() }}
        </div>
    </div>
</div>
@endsection
