@extends('layouts.admin')

@section('title', 'Saldo & Buku Besar Ledger Stok — ITSFRIDAY WMS')
@section('page_title', 'Saldo Stok & Buku Besar Ledger (WMS)')
@section('page_subtitle', 'Pencatatan Mutasi Stok Bersifat Kekal (Append-Only) & Saldo Real-Time')

@section('content')
<div class="space-y-8">
    <!-- Location Switcher Tabs -->
    <div class="flex items-center gap-2 border-b border-neutral-800 pb-3">
        <span class="text-xs text-neutral-400 font-bold uppercase tracking-wider mr-2">Pilih Titik Lokasi:</span>
        @foreach($locations as $loc)
            <a href="{{ route('admin.wms.inventory', ['location_id' => $loc->id]) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ $selectedLocationId == $loc->id ? 'bg-brand-500 text-white shadow-sm' : 'bg-neutral-900 text-neutral-400 hover:text-white border border-neutral-800' }}">
                {{ $loc->name }} ({{ $loc->code }})
            </a>
        @endforeach
    </div>

    <!-- 1. Stock Balances Grid -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Saldo Stok di Lokasi Terpilih</h3>
            <span class="text-[10px] text-neutral-500">Saldo dihitung otomatis dari transaksi mutasi ledger</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">SKU Code</th>
                        <th class="py-3 px-4">Nama Produk & Varian</th>
                        <th class="py-3 px-4 text-center">Fisik di Rak</th>
                        <th class="py-3 px-4 text-center">Direservasi Checkout</th>
                        <th class="py-3 px-4 text-center">Tersedia Dijual</th>
                        <th class="py-3 px-4 text-right">Terakhir Berubah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @forelse($balances as $b)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-white">{{ $b->sku->sku_code }}</td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $b->sku->product->name }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $b->sku->color }} ({{ $b->sku->size }})</p>
                            </td>
                            <td class="py-3.5 px-4 text-center font-bold text-white text-sm">{{ $b->physical_qty }} pcs</td>
                            <td class="py-3.5 px-4 text-center font-semibold text-amber-400">{{ $b->reserved_qty }} pcs</td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="px-2.5 py-1 rounded font-bold {{ $b->available_qty > 5 ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : ($b->available_qty > 0 ? 'bg-amber-950 text-amber-300 border border-amber-800' : 'bg-rose-950 text-rose-300 border border-rose-800') }}">
                                    {{ $b->available_qty }} pcs
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right text-neutral-500 text-[11px]">{{ $b->updated_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-neutral-500">Belum ada saldo barang di lokasi ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2. Immutable Movement Ledger -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 shadow-sm space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Buku Besar Mutasi Stok (Immutable Ledger)</h3>
                <p class="text-[10px] text-neutral-500">Seluruh pergerakan barang dicatat kekal dan dilindungi trigger database penolak modifikasi.</p>
            </div>

            <!-- Manual Adjustment Trigger -->
            <button type="button" onclick="document.getElementById('adjust-modal').classList.remove('hidden')" class="px-4 py-2 bg-neutral-800 hover:bg-neutral-700 text-neutral-200 rounded-xl text-xs font-semibold flex items-center gap-1.5 border border-neutral-700">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Penyesuaian Manual (ADJUST)
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-300">
                <thead class="text-[10px] uppercase tracking-wider text-neutral-500 border-b border-neutral-800 bg-neutral-950/40">
                    <tr>
                        <th class="py-3 px-4">Waktu & ULID</th>
                        <th class="py-3 px-4">Lokasi</th>
                        <th class="py-3 px-4">SKU</th>
                        <th class="py-3 px-4">Tipe Mutasi</th>
                        <th class="py-3 px-4 text-center">Kuantitas</th>
                        <th class="py-3 px-4">Referensi & Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60 font-normal">
                    @foreach($movements as $m)
                        <tr class="hover:bg-neutral-800/40 transition-colors">
                            <td class="py-3.5 px-4 font-mono text-neutral-400">
                                <span class="text-white">{{ $m->created_at->format('d/m/Y H:i') }}</span>
                                <span class="text-[10px] text-neutral-500 block">{{ substr($m->ulid, 0, 10) }}...</span>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-white">{{ $m->location->code }}</td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $m->sku->sku_code }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $m->sku->name }}</p>
                            </td>
                            <td class="py-3.5 px-4">
                                @php
                                    $movBadge = match($m->movement_type) {
                                        'INBOUND' => 'bg-emerald-950 text-emerald-300 border-emerald-800',
                                        'RESERVE' => 'bg-amber-950 text-amber-300 border-amber-800',
                                        'RELEASE' => 'bg-blue-950 text-blue-300 border-blue-800',
                                        'PICK_OUT' => 'bg-purple-950 text-purple-300 border-purple-800',
                                        'RETURN_IN' => 'bg-teal-950 text-teal-300 border-teal-800',
                                        'OPNAME_ADJUST' => 'bg-indigo-950 text-indigo-300 border-indigo-800',
                                        default => 'bg-neutral-800 text-neutral-300 border-neutral-700',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold border {{ $movBadge }}">
                                    {{ $m->movement_type }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center font-mono font-bold text-sm {{ $m->quantity > 0 ? 'text-emerald-400' : 'text-rose-400' }}">
                                {{ $m->quantity > 0 ? "+{$m->quantity}" : $m->quantity }}
                            </td>
                            <td class="py-3.5 px-4 text-neutral-400">
                                <p class="text-white font-medium">{{ $m->reference_type }}: {{ $m->reference_id ?: '-' }}</p>
                                <p class="text-[10px] text-neutral-500">{{ $m->notes }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-800">
            {{ $movements->links() }}
        </div>
    </div>
</div>

<!-- Modal Manual Adjustment -->
<div id="adjust-modal" class="hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 max-w-md w-full space-y-4 text-xs">
        <div class="flex items-center justify-between border-b border-neutral-800 pb-3">
            <h3 class="font-bold text-white text-sm">Penyesuaian Stok Manual (ADJUST)</h3>
            <button type="button" onclick="document.getElementById('adjust-modal').classList.add('hidden')" class="text-neutral-400 hover:text-white">✕</button>
        </div>

        <form action="{{ route('admin.wms.inventory.adjust') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Pilih Lokasi Gudang *</label>
                <select name="location_id" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->name }} ({{ $loc->code }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Pilih SKU *</label>
                <select name="sku_id" required class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
                    @foreach($skus as $sku)
                        <option value="{{ $sku->id }}">{{ $sku->sku_code }} — {{ $sku->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kuantitas (+ untuk tambah, - untuk kurang) *</label>
                <input type="number" name="quantity" required placeholder="Contoh: -2 atau 5" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white font-mono font-bold">
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Alasan Penyesuaian *</label>
                <input type="text" name="notes" required placeholder="Contoh: Barang rusak saat display di bazar" class="w-full px-3 py-2 bg-neutral-950 border border-neutral-700 rounded-xl text-white">
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('adjust-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl bg-neutral-800 text-neutral-300">Batal</button>
                <button type="submit" class="px-5 py-2 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider">Simpan Mutasi</button>
            </div>
        </form>
    </div>
</div>
@endsection

