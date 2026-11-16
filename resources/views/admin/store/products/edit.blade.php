@extends('layouts.admin')

@section('title', 'Edit Produk — ' . $product->name)
@section('page_title', 'Perbarui Spesifikasi Produk')
@section('page_subtitle', $product->name . ' (' . ucfirst($product->category) . ')')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.store.products.show', $product->id) }}" class="inline-flex items-center gap-1.5 text-xs text-neutral-400 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Detail Produk
        </a>
        <span class="text-[11px] font-mono text-neutral-500">ULID: {{ $product->ulid }}</span>
    </div>

    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 sm:p-8 shadow-sm">
        <form action="{{ route('admin.store.products.update', $product->id) }}" method="POST" class="space-y-6 text-xs">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-neutral-800 pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#BA805E]">Informasi Produk Utama</h3>
                    <label class="flex items-center gap-2 cursor-pointer text-xs">
                        <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="rounded border-neutral-700 text-[#BA805E] focus:ring-0">
                        <span class="text-neutral-300 font-semibold">Produk Aktif Ditampilkan di Toko</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nama Produk *</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-[#BA805E]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Seri Koleksi</label>
                        <select name="series_id" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-[#BA805E]">
                            <option value="">Tanpa Seri Khusus</option>
                            @foreach($allSeries as $s)
                                <option value="{{ $s->id }}" {{ $product->series_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kategori *</label>
                        <select name="category" required class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-[#BA805E]">
                            <option value="outerwear" {{ $product->category === 'outerwear' ? 'selected' : '' }}>Outerwear & Kimono</option>
                            <option value="scarf" {{ $product->category === 'scarf' ? 'selected' : '' }}>Scarf & Hijab</option>
                            <option value="dress" {{ $product->category === 'dress' ? 'selected' : '' }}>Dress</option>
                            <option value="bundle" {{ $product->category === 'bundle' ? 'selected' : '' }}>Bundel Set</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Material Kain</label>
                        <input type="text" name="material" value="{{ old('material', $product->material) }}" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-[#BA805E]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Panjang Baju (cm) [Fit Helper]</label>
                        <input type="number" name="length_cm" value="{{ old('length_cm', $product->length_cm) }}" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-[#BA805E]">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">URL Foto Produk Utama</label>
                    <input type="url" name="primary_image" value="{{ old('primary_image', $product->primary_image) }}" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-[#BA805E]">
                    @if($product->primary_image)
                        <div class="mt-2 flex items-center gap-3">
                            <img src="{{ $product->primary_image }}" alt="Preview" class="w-12 h-12 object-cover rounded-lg border border-neutral-800">
                            <span class="text-[11px] text-neutral-500">Preview foto aktif</span>
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Deskripsi Lengkap</label>
                    <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-[#BA805E]">{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Instruksi Perawatan</label>
                    <input type="text" name="care_instructions" value="{{ old('care_instructions', $product->care_instructions) }}" class="w-full px-3.5 py-2.5 bg-neutral-950 border border-neutral-700 rounded-xl text-white focus:outline-none focus:border-[#BA805E]">
                </div>

                <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 flex flex-wrap items-center gap-4">
                    <label class="flex items-center gap-2 cursor-pointer text-neutral-300">
                        <input type="checkbox" name="is_preorder" value="1" {{ $product->is_preorder ? 'checked' : '' }} class="rounded border-neutral-700 text-[#BA805E] focus:ring-0">
                        <span>Status <strong>Pre-Order (PO)</strong></span>
                    </label>
                    <div class="flex items-center gap-2">
                        <span class="text-neutral-400">Lead time:</span>
                        <input type="number" name="preorder_lead_days" value="{{ old('preorder_lead_days', $product->preorder_lead_days ?: 7) }}" min="1" max="60" class="w-16 px-2 py-1 bg-neutral-900 border border-neutral-700 rounded text-center text-white">
                        <span class="text-neutral-400">hari kerja</span>
                    </div>
                </div>
            </div>

            <!-- SKU Variants Section -->
            <div class="space-y-4 pt-4 border-t border-neutral-800">
                <div class="flex items-center justify-between border-b border-neutral-800 pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#BA805E]">Varian SKU Produk ({{ $product->skus->count() }})</h3>
                    <span class="text-[10px] text-neutral-500">Harga jual, HPP & status varian</span>
                </div>

                <div class="space-y-4">
                    @foreach($product->skus as $idx => $sku)
                        <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 space-y-3">
                            <input type="hidden" name="skus[{{ $idx }}][id]" value="{{ $sku->id }}">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-neutral-300">#{{ $idx + 1 }} — {{ $sku->sku_code }}</span>
                                <label class="flex items-center gap-1.5 text-[11px] text-neutral-400">
                                    <input type="checkbox" name="skus[{{ $idx }}][is_active]" value="1" {{ $sku->is_active ? 'checked' : '' }} class="rounded border-neutral-700 text-[#BA805E] focus:ring-0">
                                    <span>Varian Aktif</span>
                                </label>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Kode SKU *</label>
                                    <input type="text" name="skus[{{ $idx }}][sku_code]" value="{{ old('skus.'.$idx.'.sku_code', $sku->sku_code) }}" required class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white font-mono focus:border-[#BA805E]">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Nama Varian *</label>
                                    <input type="text" name="skus[{{ $idx }}][name]" value="{{ old('skus.'.$idx.'.name', $sku->name) }}" required class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white focus:border-[#BA805E]">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Barcode</label>
                                    <input type="text" name="skus[{{ $idx }}][barcode]" value="{{ old('skus.'.$idx.'.barcode', $sku->barcode) }}" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white font-mono focus:border-[#BA805E]">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Warna</label>
                                    <input type="text" name="skus[{{ $idx }}][color]" value="{{ old('skus.'.$idx.'.color', $sku->color) }}" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white focus:border-[#BA805E]">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Ukuran</label>
                                    <input type="text" name="skus[{{ $idx }}][size]" value="{{ old('skus.'.$idx.'.size', $sku->size) }}" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white focus:border-[#BA805E]">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">Harga Jual (IDR) *</label>
                                    <input type="number" name="skus[{{ $idx }}][price_idr]" value="{{ old('skus.'.$idx.'.price_idr', $sku->price_idr) }}" required class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white font-semibold focus:border-[#BA805E]">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-400 mb-1">HPP / Modal (IDR)</label>
                                    <input type="number" name="skus[{{ $idx }}][cost_idr]" value="{{ old('skus.'.$idx.'.cost_idr', $sku->cost_idr) }}" class="w-full px-3 py-2 bg-neutral-900 border border-neutral-700 rounded-lg text-white focus:border-[#BA805E]">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-neutral-800">
                <a href="{{ route('admin.store.products.show', $product->id) }}" class="px-5 py-2.5 rounded-xl border border-neutral-700 text-neutral-300 hover:bg-neutral-800 font-bold transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#BA805E] hover:bg-[#a66f4e] text-white font-bold shadow-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
