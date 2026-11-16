@extends('layouts.admin')

@section('title', 'Profil 360 ' . $customer->name . ' — ITSFRIDAY CRM')
@section('page_title', 'Profil Pelanggan 360: ' . $customer->name)
@section('page_subtitle', $customer->email . ' • Terdaftar sejak ' . $customer->created_at->format('d M Y'))

@section('content')
<div class="space-y-8">
    <!-- Top RFM & Rhythm Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-5 shadow-sm">
            <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-400">Segmen RFM Saat Ini</span>
            <p class="font-bold text-2xl text-white mt-1 capitalize">{{ str_replace('_', ' ', $metric->segment) }}</p>
            <p class="text-[11px] text-brand-300 mt-1">Skor: R:{{ $metric->r_score }} | F:{{ $metric->f_score }} | M:{{ $metric->m_score }}</p>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-5 shadow-sm">
            <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-400">Nilai Belanja Seumur Hidup (LTV)</span>
            <p class="font-bold text-2xl text-emerald-400 mt-1">{{ \App\Modules\Shared\Money\Money::format($metric->monetary_total_idr) }}</p>
            <p class="text-[11px] text-neutral-400 mt-1">{{ $metric->frequency_count }} pesanan lunas</p>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-5 shadow-sm">
            <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-400">Ritme Belanja (Customer Rhythm)</span>
            <p class="font-bold text-2xl text-white mt-1">{{ $metric->rhythm_days ? "Tiap {$metric->rhythm_days} Hari" : '1x Belanja' }}</p>
            <p class="text-[11px] text-neutral-400 mt-1">Prediksi berikut: {{ $metric->predicted_next_purchase ? $metric->predicted_next_purchase->format('d M Y') : '-' }}</p>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-5 shadow-sm">
            <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-400">Saldo Poin Loyalitas</span>
            <p class="font-bold text-2xl text-amber-400 mt-1">{{ $loyaltyPoints }} Poin</p>
            <p class="text-[11px] text-neutral-400 mt-1">Setara Rp {{ number_format($loyaltyPoints * 100, 0, ',', '.') }} diskon</p>
        </div>
    </div>

    <!-- 2 Columns Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Order History (Col 8) -->
        <div class="lg:col-span-8 bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Riwayat Transaksi Pesanan ({{ $customer->orders->count() }})</h3>
            
            <div class="divide-y divide-neutral-800">
                @forelse($customer->orders as $ord)
                    <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="font-mono font-bold text-white text-sm">#{{ $ord->order_number }}</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-neutral-800 text-neutral-300">
                                    {{ $ord->channel?->name ?? 'Web' }}
                                </span>
                            </div>
                            <p class="text-neutral-400">
                                @foreach($ord->items as $it)
                                    <span>{{ $it->quantity }}x {{ $it->product_name }} ({{ $it->variant_name }});</span>
                                @endforeach
                            </p>
                            <p class="text-neutral-500 text-[10px]">Tanggal: {{ $ord->created_at->format('d M Y H:i') }}</p>
                        </div>

                        <div class="sm:text-right">
                            <p class="font-bold text-white text-sm">{{ \App\Modules\Shared\Money\Money::format($ord->grand_total_idr) }}</p>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ord->status === 'paid' ? 'bg-blue-950 text-blue-300' : ($ord->status === 'delivered' ? 'bg-emerald-950 text-emerald-300' : 'bg-neutral-800 text-neutral-300') }}">
                                {{ ucfirst($ord->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="py-6 text-center text-neutral-500">Belum ada riwayat pesanan.</p>
                @endforelse
            </div>
        </div>

        <!-- Sidebar Info: Consent, Loyalty, & Merge Tool (Col 4) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Consent & Privacy (UU PDP) -->
            <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-3 text-xs">
                <h3 class="font-bold uppercase tracking-wider text-neutral-400">Status Persetujuan (Consent)</h3>
                <div class="space-y-2">
                    @forelse($consents as $con)
                        <div class="p-3 rounded-2xl bg-neutral-950 border border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="font-bold text-white capitalize">{{ str_replace('_', ' ', $con->consent_type) }}</p>
                                <p class="text-[10px] text-neutral-500">Versi {{ $con->version }}</p>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $con->is_granted ? 'bg-emerald-950 text-emerald-300' : 'bg-rose-950 text-rose-300' }}">
                                {{ $con->is_granted ? 'Diberikan' : 'Ditolak' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-neutral-500 text-[11px]">Belum ada data izin tercatat.</p>
                    @endforelse
                </div>
            </div>

            <!-- Loyalty Points History -->
            <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-3 text-xs">
                <h3 class="font-bold uppercase tracking-wider text-neutral-400">Mutasi Poin Loyalitas Terakhir</h3>
                <div class="space-y-2">
                    @forelse($loyaltyHistory as $lh)
                        <div class="p-2.5 rounded-xl bg-neutral-950 border border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-white">{{ $lh->notes }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $lh->created_at->format('d/m/Y') }}</p>
                            </div>
                            <span class="font-bold font-mono {{ $lh->points > 0 ? 'text-emerald-400' : 'text-rose-400' }}">
                                {{ $lh->points > 0 ? "+{$lh->points}" : $lh->points }}
                            </span>
                        </div>
                    @empty
                        <p class="text-neutral-500 text-[11px]">Belum ada riwayat poin.</p>
                    @endforelse
                </div>
            </div>

            <!-- Manual Identity Merge Tool (PRD Section 8) -->
            <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-3 text-xs">
                <h3 class="font-bold uppercase tracking-wider text-brand-300">Penyatuan Identitas (Manual Merge)</h3>
                <p class="text-neutral-400 text-[11px] leading-relaxed">
                    Gabungkan riwayat order, identitas marketplace, dan poin profil ini ke profil pelanggan utama lain:
                </p>

                <form action="{{ route('admin.crm.customers.merge', $customer->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menggabungkan akun ini? Akun sumber akan dinonaktifkan.')" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Target Pelanggan Utama</label>
                        <select name="target_customer_id" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                            @foreach($otherCustomers as $oc)
                                <option value="{{ $oc->id }}">{{ $oc->name }} ({{ $oc->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full py-2 bg-neutral-800 hover:bg-neutral-700 text-white font-bold rounded-xl uppercase tracking-wider">
                        Satukan ke Profil Target
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

