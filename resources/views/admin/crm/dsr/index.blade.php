@extends('layouts.admin')

@section('title', 'Hak Subjek Data (UU PDP) — ITSFRIDAY CRM')
@section('page_title', 'Hak Subjek Data & Kepatuhan Privasi (UU PDP)')
@section('page_subtitle', 'Pemenuhan Hak Akses, Ekspor & Hak Penghapusan (Pseudonimisasi Data Pribadi)')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- DSR Requests List (Col 8) -->
    <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm space-y-4">
        <div class="p-5 border-b border-neutral-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Daftar Permohonan Hak Subjek Data</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">ID Permohonan</th>
                        <th class="py-3 px-4">Pelanggan</th>
                        <th class="py-3 px-4">Jenis Permintaan</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($requests as $req)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">{{ substr($req->ulid, 0, 10) }}...</td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $req->customer?->name ?? 'Anonymized User' }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $req->customer?->email ?? '-' }}</p>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $req->request_type === 'erase_data' ? 'bg-rose-950 text-rose-300 border border-rose-800' : 'bg-neutral-800 text-neutral-300' }}">
                                    {{ strtoupper(str_replace('_', ' ', $req->request_type)) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $req->status === 'completed' ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-amber-950 text-amber-300 border border-amber-800' }}">
                                    {{ ucfirst($req->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-neutral-400 text-[11px]">{{ $req->created_at->format('d/m/Y') }}</td>
                            <td class="py-3.5 px-4 text-right">
                                @if($req->status !== 'completed')
                                    <form action="{{ route('admin.crm.dsr.process', $req->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengeksekusi permohonan privasi ini? Untuk penghapusan data, profil pribadi akan dianonimisasi secara permanen.')">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-lg text-xs">
                                            Eksekusi
                                        </button>
                                    </form>
                                @else
                                    <span class="text-neutral-500 text-[11px]">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-neutral-500">Belum ada permohonan hak subjek data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $requests->links() }}
        </div>
    </div>

    <!-- Submit DSR Form (Col 4) -->
    <div class="lg:col-span-4 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Catat Permohonan Subjek Data</h3>

        <form action="{{ route('admin.crm.dsr.store') }}" method="POST" class="space-y-4 text-xs">
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
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Jenis Permohonan *</label>
                <select name="request_type" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                    <option value="export_data">Ekspor Salinan Data (Hak Akses)</option>
                    <option value="erase_data">Penghapusan / Anonimisasi Data Pribadi</option>
                    <option value="rectify_data">Koreksi Data Pribadi</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Alasan / Catatan Permohonan</label>
                <textarea name="reason" rows="2" placeholder="Permohonan diajukan pelanggan via tiket atau email..." class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white"></textarea>
            </div>

            <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 text-[11px] text-neutral-400 leading-relaxed space-y-1">
                <p class="font-bold text-white">Standar Integritas Data (PRD Section 10):</p>
                <p>Menghapus pelanggan berarti <strong>anonimisasi</strong> (mengganti nama & menyamarkan email), bukan menghapus riwayat order atau buku besar stok/keuangan agar kepatuhan pajak tetap sah.</p>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider mt-2">
                Simpan Permohonan DSR
            </button>
        </form>
    </div>
</div>
@endsection
