@extends('layouts.shop')

@section('title', $product->name . ' — ITSFRIDAY')
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
    "name": "ITSFRIDAY"
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
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-neutral-500 mb-6">
        <a href="{{ route('shop.home') }}" class="hover:text-neutral-900">Beranda</a>
        <span>/</span>
        <a href="{{ route('shop.catalog') }}" class="hover:text-neutral-900">Koleksi</a>
        @if($product->series)
            <span>/</span>
            <a href="{{ route('shop.catalog', ['series' => $product->series->code]) }}" class="hover:text-neutral-900">{{ $product->series->name }}</a>
        @endif
        <span>/</span>
        <span class="text-neutral-900 font-medium truncate">{{ $product->name }}</span>
    </div>

    <!-- Product Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Gallery Images (Col 7) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="aspect-[3/4] bg-neutral-100 rounded-3xl overflow-hidden border border-neutral-200/80 shadow-sm">
                <img id="main-image" src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            @if($product->gallery_images && count($product->gallery_images) > 1)
                <div class="flex gap-3 overflow-x-auto pb-2">
                    @foreach($product->gallery_images as $img)
                        <button type="button" onclick="document.getElementById('main-image').src = '{{ $img }}'" class="w-20 h-24 rounded-xl overflow-hidden border-2 border-neutral-200 hover:border-neutral-900 flex-shrink-0 transition-all">
                            <img src="{{ $img }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Purchase Information (Col 5) -->
        <div class="lg:col-span-5 space-y-6">
            <div>
                @if($product->series)
                    <span class="text-xs uppercase tracking-widest text-brand-700 font-bold">{{ $product->series->name }}</span>
                @endif
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-neutral-900 mt-1">{{ $product->name }}</h1>
                <div class="mt-3 flex items-baseline gap-3">
                    <span id="display-price" class="font-serif text-2xl font-bold text-neutral-900">
                        {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                    </span>
                    @if($product->min_price !== $product->max_price)
                        <span class="text-xs text-neutral-400">s/d {{ \App\Modules\Shared\Money\Money::format($product->max_price) }}</span>
                    @endif
                </div>
            </div>

            <!-- Preorder or Ready Stock Badge -->
            <div>
                @if($product->is_preorder)
                    <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span><strong>Pre-Order:</strong> Estimasi penjahitan & pengiriman {{ $product->preorder_lead_days }} hari kerja.</span>
                    </div>
                @else
                    <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Ready Stock:</strong> Siap diproses & dikirim dari Gudang Pusat Surabaya.</span>
                    </div>
                @endif
            </div>

            <!-- Add to Cart Form -->
            <form action="{{ route('shop.cart.add') }}" method="POST" class="space-y-6 pt-2">
                @csrf
                <!-- Variant Selector -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-neutral-700">Pilih Varian (Warna & Ukuran)</label>
                        <span id="stock-feedback" class="text-xs font-medium text-neutral-500">Pilih varian untuk cek ketersediaan</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        @foreach($product->skus as $sku)
                            @php $stock = $skuStock[$sku->id] ?? 0; @endphp
                            <label class="relative flex items-center justify-between p-3 rounded-xl border border-neutral-300 cursor-pointer hover:border-neutral-900 transition-all has-[:checked]:border-neutral-950 has-[:checked]:bg-neutral-900 has-[:checked]:text-white">
                                <input type="radio" name="sku_id" value="{{ $sku->id }}" 
                                    data-price="{{ $sku->price_idr }}" 
                                    data-formatted-price="{{ \App\Modules\Shared\Money\Money::format($sku->price_idr) }}"
                                    data-stock="{{ $stock }}"
                                    data-sku="{{ $sku->sku_code }}"
                                    onchange="onSelectSku(this)"
                                    class="sr-only" required>
                                <div>
                                    <p class="text-xs font-bold">{{ $sku->name }}</p>
                                    <p class="text-[10px] opacity-80">{{ $sku->color }} • {{ $sku->size }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs font-semibold">{{ \App\Modules\Shared\Money\Money::format($sku->price_idr) }}</p>
                                    <span class="text-[9px] px-1.5 py-0.5 rounded {{ $stock > 5 ? 'bg-emerald-100 text-emerald-800' : ($stock > 0 ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800') }}">
                                        {{ $stock > 0 ? "Stok: {$stock}" : 'Habis' }}
                                    </span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Quantity -->
                <div class="flex items-center gap-4">
                    <div class="w-32">
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-600 mb-1">Jumlah</label>
                        <input type="number" name="quantity" value="1" min="1" max="10" class="w-full text-xs px-3 py-2.5 bg-white border border-neutral-300 rounded-xl font-semibold text-center focus:ring-1 focus:ring-neutral-900">
                    </div>
                    <div class="flex-1 pt-4">
                        <button type="submit" id="submit-btn" class="w-full py-3.5 bg-neutral-900 hover:bg-neutral-800 text-white rounded-xl font-bold text-xs uppercase tracking-widest shadow-md transition-all">
                            Masukkan Keranjang
                        </button>
                    </div>
                </div>
            </form>

            <!-- Interactive Fit Helper Section (PRD Section 6) -->
            @if($product->length_cm)
                <div class="border border-neutral-200 rounded-2xl p-5 bg-white space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-brand-50 text-brand-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                            </span>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-900">Interactive Fit Helper</h4>
                                <p class="text-[11px] text-neutral-500">Panjang baju: <strong>{{ $product->length_cm }} cm</strong></p>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-neutral-600">
                        Pilih perkiraan tinggi badan Anda untuk melihat simulasi jatuhnya baju pada postur tubuh:
                    </p>

                    <!-- Height Selector Buttons -->
                    <div class="grid grid-cols-4 gap-2 text-center text-xs">
                        <button type="button" onclick="calculateFit(152)" class="fit-btn py-2 px-1 rounded-lg border border-neutral-300 hover:border-neutral-900 text-[11px] font-medium">150 - 155 cm</button>
                        <button type="button" onclick="calculateFit(158)" class="fit-btn py-2 px-1 rounded-lg border border-neutral-300 hover:border-neutral-900 text-[11px] font-medium">156 - 160 cm</button>
                        <button type="button" onclick="calculateFit(163)" class="fit-btn py-2 px-1 rounded-lg border border-neutral-300 hover:border-neutral-900 text-[11px] font-medium">161 - 165 cm</button>
                        <button type="button" onclick="calculateFit(168)" class="fit-btn py-2 px-1 rounded-lg border border-neutral-300 hover:border-neutral-900 text-[11px] font-medium">166 - 170+ cm</button>
                    </div>

                    <!-- Dynamic Fit Output Card -->
                    <div id="fit-result-card" class="p-3.5 rounded-xl bg-neutral-50 border border-neutral-200 text-xs space-y-1">
                        <p class="font-bold text-neutral-900 text-[11px] uppercase tracking-wider">Perkiraan Jatuh Baju:</p>
                        <p id="fit-description" class="text-neutral-700 leading-relaxed">Silakan pilih tinggi badan di atas untuk melihat panduan fitting.</p>
                    </div>
                </div>
            @endif

            <!-- Product Details Accordion -->
            <div class="border-t border-neutral-200 pt-5 space-y-4 text-xs">
                <div>
                    <h4 class="font-bold uppercase tracking-wider text-neutral-900 mb-1">Deskripsi & Karakteristik</h4>
                    <p class="text-neutral-600 leading-relaxed">{{ $product->description }}</p>
                </div>
                <div>
                    <h4 class="font-bold uppercase tracking-wider text-neutral-900 mb-1">Material & Komposisi</h4>
                    <p class="text-neutral-600">{{ $product->material }}</p>
                </div>
                @if($product->care_instructions)
                    <div>
                        <h4 class="font-bold uppercase tracking-wider text-neutral-900 mb-1">Instruksi Perawatan</h4>
                        <p class="text-neutral-600 leading-relaxed">{{ $product->care_instructions }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function onSelectSku(input) {
        const formattedPrice = input.getAttribute('data-formatted-price');
        const stock = parseInt(input.getAttribute('data-stock'));
        const skuCode = input.getAttribute('data-sku');

        document.getElementById('display-price').innerText = formattedPrice;

        const stockFeedback = document.getElementById('stock-feedback');
        const submitBtn = document.getElementById('submit-btn');

        if (stock <= 0) {
            stockFeedback.innerHTML = `<span class="text-rose-600 font-bold">Stok habis untuk SKU ${skuCode}</span>`;
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            submitBtn.innerText = 'Stok Habis';
        } else {
            stockFeedback.innerHTML = `<span class="text-emerald-700 font-bold">Tersedia ${stock} pcs di gudang</span>`;
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            submitBtn.innerText = 'Masukkan Keranjang';
        }
    }

    const garmentLength = {{ $product->length_cm ?? 110 }};

    function calculateFit(userHeight) {
        // Highlight active fit button
        document.querySelectorAll('.fit-btn').forEach(btn => btn.classList.remove('bg-neutral-900', 'text-white', 'border-neutral-900'));
        event.currentTarget.classList.add('bg-neutral-900', 'text-white', 'border-neutral-900');

        const descElem = document.getElementById('fit-description');

        // Estimate based on shoulder-to-floor approximate ratio (~0.8 of total height)
        const shoulderHeight = userHeight * 0.82;
        const hemHeightFromFloor = shoulderHeight - garmentLength;

        let resultText = "";
        if (garmentLength >= 120) {
            // Maxi / Dress length
            if (userHeight <= 155) {
                resultText = `Untuk tinggi ${userHeight} cm, gaun sepanjang ${garmentLength} cm akan jatuh pas di mata kaki (maxi drape anggun tanpa menyentuh lantai). Rekomendasi sepatu: flat shoes atau heels 3 cm.`;
            } else if (userHeight <= 163) {
                resultText = `Untuk tinggi ${userHeight} cm, gaun sepanjang ${garmentLength} cm akan jatuh sedikit di atas mata kaki (panjang semata kaki ideal untuk bergerak leluasa).`;
            } else {
                resultText = `Untuk tinggi ${userHeight} cm, gaun sepanjang ${garmentLength} cm akan jatuh di pertengahan betis bawah (midi-maxi silhouette).`;
            }
        } else {
            // Kimono / Outer length
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
</script>
@endsection

