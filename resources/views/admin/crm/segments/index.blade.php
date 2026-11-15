@extends('layouts.admin')

@section('title', 'Segmentasi RFM — ITSFRIDAY CRM')
@section('page_title', 'Segmentasi Pelanggan RFM (Recency, Frequency, Monetary)')
@section('page_subtitle', 'Analisis Perilaku Pelanggan & Strategi Penjangkauan yang Tepat Sasaran')

@section('content')
<div class="space-y-8">
    <div class="p-6 rounded-3xl bg-neutral-900 border border-neutral-800 shadow-sm space-y-2">
        <h3 class="text-sm font-bold text-white">Prinsip Segmentasi ITSFRIDAY (PRD Section 8)</h3>
        <p class="text-xs text-neutral-400 leading-relaxed max-w-3xl">
            Sistem mengelompokkan pelanggan berdasarkan 3 variabel utama: <strong>Recency</strong> (kapan terakhir beli), <strong>Frequency</strong> (seberapa sering belanja), dan <strong>Monetary</strong> (total nominal Rupiah yang dihabiskan). Setiap segmen mendapatkan pendekatan pesan yang berbeda untuk memaksimalkan retensi tanpa pesan berulang yang mengganggu.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($segments as $code => $seg)
            @php
                $stat = $counts->get($code);
                $memberCount = $stat ? $stat->count : 0;
                $revenue = $stat ? $stat->total_revenue : 0;
            @endphp
            <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full {{ $code === 'champions' ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : ($code === 'at_risk' ? 'bg-amber-950 text-amber-300 border border-amber-800' : 'bg-neutral-800 text-neutral-300') }}">
                            {{ $seg['name'] }}
                        </span>
                        <span class="font-bold font-mono text-sm text-white">{{ $memberCount }} Orang</span>
                    </div>
                    <p class="text-xs text-neutral-400 leading-relaxed">{{ $seg['description'] }}</p>
                </div>

                <div class="pt-4 border-t border-neutral-800/80 flex items-center justify-between text-xs">
                    <div>
                        <span class="text-[10px] text-neutral-500 uppercase tracking-wider block">Kontribusi GMV</span>
                        <span class="font-semibold text-white">{{ \App\Modules\Shared\Money\Money::format($revenue) }}</span>
                    </div>
                    <a href="{{ route('admin.crm.customers.index', ['segment' => $code]) }}" class="text-brand-300 hover:underline font-semibold text-[11px]">
                        Lihat Daftar &rarr;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
