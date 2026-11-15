@extends('layouts.admin')

@section('title', 'Mitra Kreator & Afiliasi — ITSFRIDAY CRM')
@section('page_title', 'Mitra Kreator & Program Afiliasi')
@section('page_subtitle', 'Pelacakan Kode Kreator, Atribusi Pesanan & Perhitungan Komisi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Affiliates List (Col 8) -->
    <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm space-y-4">
        <div class="p-5 border-b border-neutral-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Daftar Mitra Afiliasi & Kreator</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">Nama & Email</th>
                        <th class="py-3 px-4">Kode Unik</th>
                        <th class="py-3 px-4">Komisi (%)</th>
                        <th class="py-3 px-4 text-center">Pesanan Diatribusi</th>
                        <th class="py-3 px-4">Total Komisi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($affiliates as $af)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $af->name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $af->email }}</p>
                            </td>
                            <td class="py-3.5 px-4 font-mono font-bold text-brand-300">{{ $af->code }}</td>
                            <td class="py-3.5 px-4 font-semibold text-white">{{ $af->commission_rate }}%</td>
                            <td class="py-3.5 px-4 text-center font-bold text-white">{{ $af->referrals_count }} Transaksi</td>
                            <td class="py-3.5 px-4 font-bold text-emerald-400">
                                {{ \App\Modules\Shared\Money\Money::format($af->total_commission_idr) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-neutral-500">Belum ada mitra kreator terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $affiliates->links() }}
        </div>
    </div>

    <!-- Register Affiliate Form (Col 4) -->
    <div class="lg:col-span-4 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Daftarkan Kreator Baru</h3>

        <form action="{{ route('admin.crm.affiliates.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nama Lengkap Kreator *</label>
                <input type="text" name="name" required placeholder="Contoh: Aulia Rahma" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Email Kreator *</label>
                <input type="email" name="email" required placeholder="aulia@creator.com" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kode Unik *</label>
                    <input type="text" name="code" required placeholder="AULIAFRIDAY" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-mono uppercase focus:outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Rate Komisi (%) *</label>
                    <input type="number" step="0.5" name="commission_rate" value="10" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-bold">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nomor Rekening Bank</label>
                <input type="text" name="bank_account_number" placeholder="BCA - 8290123456" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider mt-2">
                Simpan & Terbitkan Kode
            </button>
        </form>
    </div>
</div>
@endsection
