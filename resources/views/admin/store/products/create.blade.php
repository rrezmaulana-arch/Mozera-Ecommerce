@extends('layouts.admin')

@section('title', 'Tambah Produk Baru — ITSFRIDAY')
@section('page_title', 'Tambah Produk Busana Baru')
@section('page_subtitle', 'Definisi Spesifikasi Produk, Panjang Baju & Varian SKU Awal')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 sm:p-8 shadow-sm">
        <form action="{{ route('admin.store.products.store') }}" method="POST" class="space-y-6 text-xs">
            @csrf

            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Informasi Produk Utama</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nama Produk *</label>
                        <input type="text" name="name" required placeholder="Contoh: PUSPA Linen Trench Coat" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Seri Koleksi</label>
                        <select name="series_id" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                            <option value="">Tanpa Seri Khusus</option>
                            @foreach($allSeries as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kategori *</label>
                        <select name="category" required class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                            <option value="outerwear">Outerwear & Kimono</option>
                            <option value="scarf">Scarf & Hijab</option>
                            <option value="dress">Dress</option>
                            <option value="bundle">Bundel Set</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Material Kain</label>
                        <input type="text" name="material" placeholder="Contoh: Premium Linen Belgian" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Panjang Baju (cm) [Fit Helper]</label>
                        <input type="number" name="length_cm" placeholder="Contoh: 115" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">URL Foto Produk Utama</label>
                    <input type="url" name="primary_image" placeholder="https://..." class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Deskripsi Lengkap</label>
                    <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none" placeholder="Deskripsikan keunggulan dan siluet busana ini..."></textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Instruksi Perawatan</label>
                    <input type="text" name="care_instructions" placeholder="Cuci tangan air dingin, setrika suhu rendah" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none">
                </div>

                <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 flex items-center gap-4">
                    <label class="flex items-center gap-2 cursor-pointer text-neutral-300">
                        <input type="checkbox" name="is_preorder" value="1" class="rounded border-neutral-700 text-brand-500 focus:ring-0">
                        <span>Produk ini bersifat <strong>Pre-Order (PO)</strong></span>
                    </label>
                    <div class="flex items-center gap-2">
                        <span class="text-neutral-400">Lead time:</span>
                        <input type="number" name="preorder_lead_days" value="7" min="1" max="60" class="w-16 px-2 py-1 bg-neutral-900 border border-neutral-700 rounded text-center text-white">
                        <span class="text-neutral-400">hari kerja</span>
                    </div>
                </div>
            </div>

            <!-- Initial SKU Variant (PRD Section 5 & 6) -->
            <div class="space-y-4 pt-4 border-t border-neutral-800">
                <h3 class="text-xs font-bold uppercase tracking-wider text-brand-300 border-b border-neutral-800 pb-2">Varian SKU Awal</h3>

                <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kode SKU Unik *</label>
                            <input type="text" name="skus[0][sku_code]" required placeholder="OUT-LNN-SND-ALL" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white font-mono">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nama Varian *</label>
                            <input type="text" name="skus[0][name]" required placeholder="Sand Beige (All Size)" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Barcode (EAN-13/Custom)</label>
                            <input type="text" name="skus[0][barcode]" placeholder="899100..." class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white font-mono">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Warna</label>
                            <input type="text" name="skus[0][color]" placeholder="Sand Beige" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Ukuran</label>
                            <input type="text" name="skus[0][size]" value="All Size" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Harga Jual (Rp) *</label>
                            <input type="number" name="skus[0][price_idr]" required placeholder="389000" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white font-semibold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">HPP / Biaya (Rp)</label>
                            <input type="number" name="skus[0][cost_idr]" placeholder="175000" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-neutral-800">
                <a href="{{ route('admin.store.products.index') }}" class="px-5 py-2.5 rounded-xl bg-neutral-800 text-neutral-300 hover:text-white">Batal</a>
                <button type="submit" class="px-7 py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl uppercase tracking-wider">
                    Simpan Produk & SKU
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

