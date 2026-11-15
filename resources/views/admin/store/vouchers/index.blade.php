@extends('layouts.admin')

@section('title', 'Voucher Promo — ITSFRIDAY Admin')
@section('page_title', 'Voucher & Kupon Promo')
@section('page_subtitle', 'Diskon Persentase, Nominal Tetap & Batas Kuota')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Vouchers List (Col 8) -->
    <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="p-5 border-b border-neutral-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Daftar Kode Voucher Aktif</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">Kode</th>
                        <th class="py-3 px-4">Nama Promo</th>
                        <th class="py-3 px-4">Tipe & Nilai</th>
                        <th class="py-3 px-4">Min. Belanja</th>
                        <th class="py-3 px-4">Terpakai / Kuota</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @foreach($vouchers as $v)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">{{ $v->code }}</td>
                            <td class="py-3.5 px-4 font-medium text-white">{{ $v->name }}</td>
                            <td class="py-3.5 px-4 font-semibold text-brand-300">
                                {{ $v->discount_type === 'percentage' ? $v->discount_amount . '%' : \App\Modules\Shared\Money\Money::format($v->discount_amount) }}
                            </td>
                            <td class="py-3.5 px-4">{{ \App\Modules\Shared\Money\Money::format($v->min_purchase_idr) }}</td>
                            <td class="py-3.5 px-4 font-mono">{{ $v->used_count }} / {{ $v->quota ?: '∞' }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $v->is_active ? 'bg-emerald-950 text-emerald-300' : 'bg-neutral-800 text-neutral-500' }}">
                                    {{ $v->is_active ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $vouchers->links() }}
        </div>
    </div>

    <!-- Create Voucher Form (Col 4) -->
    <div class="lg:col-span-4 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Buat Voucher Baru</h3>
        <form action="{{ route('admin.store.vouchers.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kode Voucher *</label>
                <input type="text" name="code" required placeholder="Contoh: FRIDAY50" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-mono uppercase focus:outline-none">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nama Promo *</label>
                <input type="text" name="name" required placeholder="Diskon Spesial Akhir Pekan" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Tipe Diskon *</label>
                    <select name="discount_type" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                        <option value="fixed">Nominal (Rp)</option>
                        <option value="percentage">Persen (%)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nilai Diskon *</label>
                    <input type="number" name="discount_amount" required placeholder="50000" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-semibold">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Min. Belanja (Rp)</label>
                    <input type="number" name="min_purchase_idr" value="0" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kuota Pakai</label>
                    <input type="number" name="quota" placeholder="100" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                </div>
            </div>
            <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider mt-2">
                Simpan Voucher
            </button>
        </form>
    </div>
</div>
@endsection

