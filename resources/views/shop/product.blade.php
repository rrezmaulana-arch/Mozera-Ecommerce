@extends('layouts.shop')

@section('title', $product->name . ' — MOZÉRA')
@section('meta_description', Str::limit(strip_tags($product->description), 150))

@push('head')
<!-- Schema.org Product & Offer JSON-LD -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org/",
  "@@type": "Product",
  "name": "{{ $product->name }}",
  "image": "{{ $product->primary_image }}",
  "description": "{{ strip_tags($product->description) }}",
  "brand": {
    "@@type": "Brand",
    "name": "MOZÉRA"
  },
  "offers": {
    "@@type": "AggregateOffer",
    "priceCurrency": "IDR",
    "lowPrice": "{{ $product->min_price }}",
    "highPrice": "{{ $product->max_price }}",
    "offerCount": "{{ $product->skus->count() }}"
  }
}
</script>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10 pb-28 sm:pb-16">
    <!-- Breadcrumb (Clean & Minimalist) -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-neutral-400 mb-6 sm:mb-8 font-light">
        <a href="{{ route('shop.home') }}" class="hover:text-neutral-900 transition-colors">Beranda</a>
        <span class="text-neutral-300">/</span>
        <a href="{{ route('shop.catalog') }}" class="hover:text-neutral-900 transition-colors">Koleksi</a>
        @if($product->series)
            <span class="text-neutral-300">/</span>
            <a href="{{ route('shop.catalog', ['series' => $product->series->code]) }}" class="hover:text-neutral-900 transition-colors">{{ $product->series->name }}</a>
        @endif
        <span class="text-neutral-300">/</span>
        <span class="text-neutral-900 font-medium truncate max-w-[200px] sm:max-w-none">{{ $product->name }}</span>
    </nav>

    <!-- Product Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-start">
        
        <!-- Left: Image Gallery (Col 5 - Boutique Showcase Frame) -->
        <div class="lg:col-span-5 space-y-4">
            <!-- Main Showcase Frame -->
            <div class="relative w-full aspect-[4/5] max-h-[520px] bg-gradient-to-b from-[#FAF8F5] to-[#F5EFEB] rounded-3xl overflow-hidden border border-neutral-200/70 shadow-sm flex flex-col items-center justify-end p-4 group">
                <!-- Top Badge: Series or Category -->
                <div class="absolute top-4 left-4 z-10 flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 backdrop-blur-md border border-neutral-200/80 shadow-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]"></span>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-neutral-800">
                        {{ $product->category === 'outerwear' ? 'Kimono Outerwear' : ucfirst($product->category) }}
                    </span>
                </div>

                <!-- Realistic Floor Contact Shadow for Model -->
                <div class="w-36 sm:w-44 h-3.5 bg-neutral-950/15 rounded-full filter blur-[3px] absolute bottom-4 pointer-events-none"></div>

                <!-- Main Product Cutout Image -->
                <div class="relative w-full h-[320px] sm:h-[400px] flex items-end justify-center z-1">
                    <img 
                        id="main-image" 
                        src="{{ $product->primary_image }}" 
                        alt="{{ $product->name }}" 
                        class="h-full w-auto max-w-full object-contain filter drop-shadow-sm transition-all duration-300 select-none group-hover:scale-[1.02]"
                    >
                </div>

                <!-- Subtle Zoom Hint Badge -->
                <div class="absolute bottom-3 right-3 z-10 hidden sm:flex items-center gap-1 px-2.5 py-1 rounded-full bg-white/80 backdrop-blur-md text-[10px] text-neutral-500 border border-neutral-200/60 shadow-xs pointer-events-none">
                    <svg class="w-3 h-3 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                    <span>Foto Asli MOZÉRA</span>
                </div>
            </div>

            <!-- Thumbnail Carousel (If Multiple Images) -->
            @if($product->gallery_images && count($product->gallery_images) > 1)
                <div class="flex gap-2.5 overflow-x-auto pb-1 justify-center custom-scrollbar">
                    @foreach($product->gallery_images as $idx => $img)
                        <button 
                            type="button" 
                            onclick="switchGalleryImage(this, '{{ $img }}')" 
                            class="gallery-thumb-btn w-16 h-20 rounded-xl overflow-hidden border-2 {{ $idx === 0 ? 'border-[#BA805E] ring-2 ring-[#BA805E]/20' : 'border-neutral-200 hover:border-neutral-400' }} flex-shrink-0 transition-all focus:outline-none bg-[#FAF9F6] p-1 flex items-center justify-center cursor-pointer"
                        >
                            <img src="{{ $img }}" alt="{{ $product->name }} view {{ $idx + 1 }}" class="w-full h-full object-contain">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right: Product Purchase Information (Col 7 - Editorial Boutique Column) -->
        <div class="lg:col-span-7 space-y-6">
            <!-- Header: Series, Name, Rating & Price -->
            <div class="space-y-3 pb-5 border-b border-neutral-200/80">
                <div class="flex items-center justify-between">
                    @if($product->series)
                        <span class="inline-block text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">
                            {{ $product->series->name }}
                        </span>
                    @else
                        <span class="inline-block text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">
                            Koleksi Atasan Modest
                        </span>
                    @endif

                    <!-- Star Rating Badge -->
                    <div class="flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#FAF8F5] border border-neutral-200 text-xs">
                        <svg class="w-3.5 h-3.5 fill-amber-500 text-amber-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="font-bold text-neutral-800">4.9</span>
                        <span class="text-neutral-400 text-[10px]">(Ulasan Butik)</span>
                    </div>
                </div>

                <!-- Product Name (Exquisite Serif) -->
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-neutral-950 leading-tight tracking-tight">
                    {{ $product->name }}
                </h1>

                <!-- Price Row -->
                <div class="pt-1 flex items-baseline gap-3">
                    <span id="display-price" class="font-serif text-3xl sm:text-4xl font-bold text-neutral-950 tracking-tight">
                        {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                    </span>
                    @if($product->min_price !== $product->max_price)
                        <span class="text-xs text-neutral-400 font-medium">
                            s/d {{ \App\Modules\Shared\Money\Money::format($product->max_price) }}
                        </span>
                    @endif
                    <span class="text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full font-medium border border-emerald-200/60">
                        Termasuk PPN
                    </span>
                </div>
            </div>

            <!-- Ready Stock or Pre-Order Luxury Status Badge -->
            <div>
                @if($product->is_preorder)
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-2xl bg-amber-50/80 border border-amber-200/80 text-amber-950 text-xs shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        <span><strong>Pre-Order Eksklusif:</strong> Estimasi penjahitan butik {{ $product->preorder_lead_days }} hari kerja</span>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-2xl bg-[#F0FDF4] border border-emerald-200/80 text-emerald-950 text-xs shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span><strong>Ready Stock:</strong> Tersedia di Gudang Surabaya &bull; Siap Kirim Hari Ini</span>
                    </div>
                @endif
            </div>

            <!-- Add to Cart & Variant Selection Form -->
            <form action="{{ route('shop.cart.add') }}" method="POST" id="pdp-form" class="space-y-6 pt-1">
                @csrf

                <!-- Variant Selector (Boutique Swatch Cards) -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="text-[11px] font-bold uppercase tracking-wider text-neutral-800 flex items-center gap-1.5">
                            <span>Pilih Varian Busana</span>
                            <span class="text-neutral-400 font-normal">({{ $product->skus->count() }} pilihan)</span>
                        </label>
                        <span id="stock-feedback" class="text-xs text-neutral-500 font-medium"></span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        @foreach($product->skus as $index => $sku)
                            @php 
                                $stock = $skuStock[$sku->id] ?? 0;
                                $colorHex = str_contains(strtolower($sku->color), 'sage') ? '#8A9A86' : (str_contains(strtolower($sku->color), 'terra') ? '#C46D5E' : (str_contains(strtolower($sku->color), 'navy') ? '#2C3E50' : (str_contains(strtolower($sku->color), 'linen') ? '#D9CBB8' : (str_contains(strtolower($sku->color), 'pink') ? '#D4A5A5' : '#D0A38B'))));
                            @endphp
                            <label class="variant-card relative flex items-center justify-between p-3.5 rounded-2xl border-2 transition-all cursor-pointer group {{ $index === 0 ? 'border-neutral-950 bg-neutral-950 text-white shadow-md' : 'border-neutral-200/90 bg-white hover:border-neutral-900 text-neutral-900' }}">
                                <input 
                                    type="radio" 
                                    name="sku_id" 
                                    value="{{ $sku->id }}"
                                    data-price="{{ $sku->price_idr }}"
                                    data-formatted-price="{{ \App\Modules\Shared\Money\Money::format($sku->price_idr) }}"
                                    data-stock="{{ $stock }}"
                                    data-sku="{{ $sku->sku_code }}"
                                    onchange="onSelectSku(this)"
                                    class="sr-only" 
                                    required 
                                    {{ $index === 0 ? 'checked' : '' }}
                                >
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-3.5 h-3.5 rounded-full border border-white/40 shadow-xs flex-shrink-0" style="background-color: {{ $colorHex }}"></span>
                                        <p class="text-xs font-bold leading-tight">{{ $sku->name }}</p>
                                    </div>
                                    <p class="text-[10px] pl-6 variant-meta opacity-75">
                                        {{ $sku->color }} &bull; Ukuran {{ $sku->size }}
                                    </p>
                                </div>
                                <div class="text-right flex-shrink-0 ml-2">
                                    <span class="variant-stock-tag text-[9px] font-bold px-2 py-0.5 rounded-full {{ $index === 0 ? 'bg-white/20 text-white' : ($stock > 5 ? 'bg-emerald-100 text-emerald-800' : ($stock > 0 ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800')) }}">
                                        {{ $stock > 0 ? "Stok: {$stock}" : 'Habis' }}
                                    </span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Quantity & Add to Cart Controls -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-2">
                    <!-- Minimalist Stepper Quantity -->
                    <div class="flex items-center justify-between sm:justify-start gap-2 bg-[#FAF8F5] border border-neutral-300 rounded-2xl p-1 shrink-0">
                        <button 
                            type="button" 
                            onclick="stepQty(-1)" 
                            class="w-10 h-10 rounded-xl bg-white hover:bg-neutral-100 border border-neutral-200/80 flex items-center justify-center text-neutral-800 font-bold transition-colors cursor-pointer select-none"
                            aria-label="Kurangi kuantitas"
                        >
                            &minus;
                        </button>
                        <input 
                            type="number" 
                            id="qty-input" 
                            name="quantity" 
                            value="1" 
                            min="1" 
                            max="10" 
                            class="w-12 text-center text-sm font-bold bg-transparent border-0 focus:outline-none focus:ring-0 text-neutral-900"
                            readonly
                        >
                        <button 
                            type="button" 
                            onclick="stepQty(1)" 
                            class="w-10 h-10 rounded-xl bg-white hover:bg-neutral-100 border border-neutral-200/80 flex items-center justify-center text-neutral-800 font-bold transition-colors cursor-pointer select-none"
                            aria-label="Tambah kuantitas"
                        >
                            &#43;
                        </button>
                    </div>

                    <!-- Main Add to Cart Button -->
                    <div class="flex-1">
                        <button 
                            type="submit" 
                            id="submit-btn" 
                            class="w-full py-3.5 px-6 bg-neutral-950 hover:bg-[#BA805E] text-white rounded-2xl font-bold text-xs uppercase tracking-widest shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer hover:shadow-lg"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>Masukkan Keranjang</span>
                        </button>
                    </div>
                </div>
            </form>

            <!-- 3 Luxury Assurance Trust Badges -->
            <div class="grid grid-cols-3 gap-2.5 py-4 border-y border-neutral-200/80 text-center">
                <div class="space-y-1">
                    <div class="w-7 h-7 mx-auto rounded-full bg-[#FAF8F5] border border-neutral-200 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-[10px] font-bold text-neutral-900">Jahitan Butik Rapi</p>
                    <p class="text-[9px] text-neutral-500 font-light hidden sm:block">QC ganda standar ekspor</p>
                </div>
                <div class="space-y-1">
                    <div class="w-7 h-7 mx-auto rounded-full bg-[#FAF8F5] border border-neutral-200 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <p class="text-[10px] font-bold text-neutral-900">Garansi Tukar 7 Hari</p>
                    <p class="text-[9px] text-neutral-500 font-light hidden sm:block">Penukaran ukuran mudah</p>
                </div>
                <div class="space-y-1">
                    <div class="w-7 h-7 mx-auto rounded-full bg-[#FAF8F5] border border-neutral-200 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                    </div>
                    <p class="text-[10px] font-bold text-neutral-900">Pengiriman Aman</p>
                    <p class="text-[9px] text-neutral-500 font-light hidden sm:block">Berasuransi ke seluruh RI</p>
                </div>
            </div>

            <!-- Interactive Fit Helper Section (Styling Concierge) -->
            @if($product->length_cm)
                <div class="border border-[#BA805E]/40 rounded-3xl p-5 bg-gradient-to-br from-[#FAF8F5] to-white space-y-3.5 shadow-xs">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-[#BA805E]/15 text-[#BA805E] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#BA805E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 10h16M4 14h16M4 18h16M8 6v4m4-4v4m4-4v4"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-900">Fit Concierge MOZÉRA</h4>
                                <p class="text-[11px] text-neutral-500">Panjang busana: <strong class="text-neutral-900">{{ $product->length_cm }} cm</strong></p>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-neutral-600 leading-relaxed font-light">
                        Pilih rentang tinggi badan Anda untuk rekomendasi siluet jatuhnya busana pada postur tubuh:
                    </p>

                    <!-- Height Selector Buttons -->
                    <div class="grid grid-cols-4 gap-2 text-center text-xs">
                        <button type="button" onclick="calculateFit(this, 152)" class="fit-btn py-2 px-1 rounded-xl border border-neutral-300 bg-white hover:border-neutral-900 text-[11px] font-semibold transition-all cursor-pointer">150–155 cm</button>
                        <button type="button" onclick="calculateFit(this, 158)" class="fit-btn py-2 px-1 rounded-xl border border-neutral-300 bg-white hover:border-neutral-900 text-[11px] font-semibold transition-all cursor-pointer">156–160 cm</button>
                        <button type="button" onclick="calculateFit(this, 163)" class="fit-btn py-2 px-1 rounded-xl border border-neutral-300 bg-white hover:border-neutral-900 text-[11px] font-semibold transition-all cursor-pointer">161–165 cm</button>
                        <button type="button" onclick="calculateFit(this, 168)" class="fit-btn py-2 px-1 rounded-xl border border-neutral-300 bg-white hover:border-neutral-900 text-[11px] font-semibold transition-all cursor-pointer">166–170+ cm</button>
                    </div>

                    <!-- Dynamic Fit Output Card -->
                    <div id="fit-result-card" class="p-3.5 rounded-2xl bg-white border border-neutral-200/80 text-xs space-y-1">
                        <p class="font-bold text-[#8A4F35] text-[10px] uppercase tracking-wider flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#BA805E]"></span>
                            <span>Rekomendasi Postur:</span>
                        </p>
                        <p id="fit-description" class="text-neutral-700 leading-relaxed font-light text-xs">
                            Silakan pilih salah satu rentang tinggi badan Anda di atas.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Product Details Accordion -->
            <div class="space-y-3 pt-2 text-xs">
                <!-- Accordion 1: Deskripsi -->
                <details class="group border border-neutral-200 rounded-2xl p-4 bg-white shadow-xs open:bg-[#FAF8F5]/60 transition-colors" open>
                    <summary class="font-bold uppercase tracking-wider text-neutral-900 cursor-pointer flex items-center justify-between list-none">
                        <span>Deskripsi dan Karakteristik</span>
                        <span class="transition-transform group-open:rotate-180 text-neutral-400">&darr;</span>
                    </summary>
                    <p class="text-neutral-600 leading-relaxed font-light pt-3 text-xs">
                        {{ $product->description }}
                    </p>
                </details>

                <!-- Accordion 2: Material -->
                <details class="group border border-neutral-200 rounded-2xl p-4 bg-white shadow-xs open:bg-[#FAF8F5]/60 transition-colors">
                    <summary class="font-bold uppercase tracking-wider text-neutral-900 cursor-pointer flex items-center justify-between list-none">
                        <span>Material dan Komposisi</span>
                        <span class="transition-transform group-open:rotate-180 text-neutral-400">&darr;</span>
                    </summary>
                    <p class="text-neutral-600 font-light pt-3 text-xs leading-relaxed">
                        {{ $product->material }}
                    </p>
                </details>

                <!-- Accordion 3: Instruksi Perawatan -->
                @if($product->care_instructions)
                    <details class="group border border-neutral-200 rounded-2xl p-4 bg-white shadow-xs open:bg-[#FAF8F5]/60 transition-colors">
                        <summary class="font-bold uppercase tracking-wider text-neutral-900 cursor-pointer flex items-center justify-between list-none">
                            <span>Instruksi Perawatan</span>
                            <span class="transition-transform group-open:rotate-180 text-neutral-400">&darr;</span>
                        </summary>
                        <p class="text-neutral-600 leading-relaxed font-light pt-3 text-xs">
                            {{ $product->care_instructions }}
                        </p>
                    </details>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Mobile Sticky Bottom Floating Add-to-Cart Bar (Smooth & Sleek) -->
<div class="sm:hidden fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-neutral-200/90 px-4 py-3 z-40 flex items-center justify-between shadow-2xl">
    <div class="flex items-center gap-2.5 min-w-0">
        <div class="w-10 h-10 rounded-xl bg-[#FAF8F5] border border-neutral-200 overflow-hidden flex-shrink-0 flex items-center justify-center p-0.5">
            <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
        </div>
        <div class="min-w-0">
            <h4 class="text-[11px] font-bold text-neutral-900 truncate leading-tight">{{ $product->name }}</h4>
            <span id="mobile-price" class="font-bold text-neutral-950 text-xs font-mono">
                {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
            </span>
        </div>
    </div>
    <button 
        type="button" 
        onclick="document.getElementById('pdp-form').submit()" 
        class="px-5 py-2.5 bg-neutral-950 hover:bg-[#BA805E] text-white rounded-full font-bold text-[11px] uppercase tracking-wider shadow-lg flex-shrink-0 flex items-center gap-1.5 transition-colors cursor-pointer"
    >
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
        <span>+ Keranjang</span>
    </button>
</div>

<script>
    function switchGalleryImage(btn, imgSrc) {
        document.getElementById('main-image').src = imgSrc;
        document.querySelectorAll('.gallery-thumb-btn').forEach(b => {
            b.classList.remove('border-[#BA805E]', 'ring-2', 'ring-[#BA805E]/20');
            b.classList.add('border-neutral-200');
        });
        btn.classList.remove('border-neutral-200');
        btn.classList.add('border-[#BA805E]', 'ring-2', 'ring-[#BA805E]/20');
    }

    function stepQty(delta) {
        const input = document.getElementById('qty-input');
        if (!input) return;
        let current = parseInt(input.value) || 1;
        current = Math.max(1, Math.min(10, current + delta));
        input.value = current;
    }

    function onSelectSku(input) {
        const formattedPrice = input.getAttribute('data-formatted-price');
        const stock = parseInt(input.getAttribute('data-stock'));
        const skuCode = input.getAttribute('data-sku');

        document.getElementById('display-price').innerText = formattedPrice;
        const mobilePrice = document.getElementById('mobile-price');
        if (mobilePrice) mobilePrice.innerText = formattedPrice;

        const stockFeedback = document.getElementById('stock-feedback');
        const submitBtn = document.getElementById('submit-btn');

        // Update active visual styles on variant cards
        document.querySelectorAll('.variant-card').forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            const meta = card.querySelector('.variant-meta');
            const tag = card.querySelector('.variant-stock-tag');
            if (radio && radio.checked) {
                card.classList.add('border-neutral-950', 'bg-neutral-950', 'text-white', 'shadow-md');
                card.classList.remove('border-neutral-200/90', 'bg-white', 'text-neutral-900');
                if (tag) {
                    tag.className = 'variant-stock-tag text-[9px] font-bold px-2 py-0.5 rounded-full bg-white/20 text-white';
                }
            } else {
                card.classList.remove('border-neutral-950', 'bg-neutral-950', 'text-white', 'shadow-md');
                card.classList.add('border-neutral-200/90', 'bg-white', 'text-neutral-900');
                if (tag) {
                    const s = parseInt(radio.getAttribute('data-stock')) || 0;
                    tag.className = 'variant-stock-tag text-[9px] font-bold px-2 py-0.5 rounded-full ' + 
                        (s > 5 ? 'bg-emerald-100 text-emerald-800' : (s > 0 ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800'));
                }
            }
        });

        if (stock <= 0) {
            stockFeedback.innerHTML = `<span class="text-rose-600 font-bold">Stok habis untuk SKU ${skuCode}</span>`;
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            submitBtn.innerText = 'Stok Habis';
        } else {
            stockFeedback.innerHTML = `<span class="text-emerald-700 font-bold">Tersedia ${stock} pcs di gudang</span>`;
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            submitBtn.innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span>Masukkan Keranjang</span>
            `;
        }
    }

    const garmentLength = {{ $product->length_cm ?? 110 }};

    function calculateFit(btn, userHeight) {
        document.querySelectorAll('.fit-btn').forEach(b => {
            b.classList.remove('bg-neutral-950', 'text-white', 'border-neutral-950');
            b.classList.add('bg-white', 'text-neutral-800', 'border-neutral-300');
        });
        if (btn) {
            btn.classList.remove('bg-white', 'text-neutral-800', 'border-neutral-300');
            btn.classList.add('bg-neutral-950', 'text-white', 'border-neutral-950');
        }

        const descElem = document.getElementById('fit-description');

        let resultText = "";
        if (garmentLength >= 120) {
            if (userHeight <= 155) {
                resultText = `Untuk tinggi ${userHeight} cm, gaun sepanjang ${garmentLength} cm akan jatuh pas di mata kaki (maxi drape anggun tanpa menyentuh lantai). Rekomendasi sepatu: flat shoes atau heels 3 cm.`;
            } else if (userHeight <= 163) {
                resultText = `Untuk tinggi ${userHeight} cm, gaun sepanjang ${garmentLength} cm akan jatuh sedikit di atas mata kaki (panjang semata kaki ideal untuk bergerak leluasa).`;
            } else {
                resultText = `Untuk tinggi ${userHeight} cm, gaun sepanjang ${garmentLength} cm akan jatuh di pertengahan betis bawah (midi-maxi silhouette).`;
            }
        } else {
            if (userHeight <= 155) {
                resultText = `Untuk tinggi ${userHeight} cm, outer sepanjang ${garmentLength} cm akan jatuh di sekitar betis tengah (tampilan layering elegan yang memberi kesan lebih jenjang).`;
            } else if (userHeight <= 163) {
                resultText = `Untuk tinggi ${userHeight} cm, outer sepanjang ${garmentLength} cm akan jatuh tepat di bawah lutut (siluet effortless dan pas untuk mobilitas harian).`;
            } else {
                resultText = `Untuk tinggi ${userHeight} cm, outer sepanjang ${garmentLength} cm akan jatuh pas di sekeliling lutut (panjang proporsional dan clean look).`;
            }
        }

        descElem.innerHTML = resultText;
    }

    // Auto-trigger on page load for the first checked SKU
    document.addEventListener('DOMContentLoaded', () => {
        const checked = document.querySelector('input[name="sku_id"]:checked');
        if (checked) onSelectSku(checked);
    });
</script>
@endsection
