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
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 pb-24 sm:pb-16">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-neutral-400 mb-6 sm:mb-8">
        <a href="{{ route('shop.home') }}" class="hover:text-neutral-900 transition-colors">Beranda</a>
        <span>/</span>
        <a href="{{ route('shop.catalog') }}" class="hover:text-neutral-900 transition-colors">Koleksi</a>
        @if($product->series)
            <span>/</span>
            <a href="{{ route('shop.catalog', ['series' => $product->series->code]) }}" class="hover:text-neutral-900 transition-colors">{{ $product->series->name }}</a>
        @endif
        <span>/</span>
        <span class="text-neutral-900 font-medium truncate">{{ $product->name }}</span>
    </div>

    <!-- Product Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14">
        <!-- Gallery Images (Col 7) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="aspect-[3/4] bg-neutral-100 rounded-3xl overflow-hidden border border-neutral-200/80 shadow-md">
                <img id="main-image" src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-opacity duration-300">
            </div>
            @if($product->gallery_images && count($product->gallery_images) > 1)
                <div class="flex gap-3 overflow-x-auto pb-2 custom-scrollbar">
                    @foreach($product->gallery_images as $img)
                        <button type="button" onclick="document.getElementById('main-image').src = '{{ $img }}'" class="w-20 h-24 rounded-2xl overflow-hidden border-2 border-neutral-200 hover:border-neutral-900 flex-shrink-0 transition-all focus:border-[#BA805E] focus:outline-none">
                            <img src="{{ $img }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Purchase Information (Col 5) -->
        <div class="lg:col-span-5 space-y-6">
            <div class="space-y-2">
                @if($product->series)
                    <span class="inline-block text-[11px] uppercase tracking-[0.25em] text-[#BA805E] font-bold">{{ $product->series->name }}</span>
                @endif
                <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-neutral-900 leading-tight">{{ $product->name }}</h1>
                <div class="pt-2 flex items-baseline gap-3">
                    <span id="display-price" class="font-serif text-2xl sm:text-3xl font-bold text-neutral-900">
                        {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
                    </span>
                    @if($product->min_price !== $product->max_price)
                        <span class="text-xs text-neutral-400 font-medium">s/d {{ \App\Modules\Shared\Money\Money::format($product->max_price) }}</span>
                    @endif
                </div>
            </div>

            <!-- Preorder or Ready Stock Subtle Luxury Badge -->
            <div>
                @if($product->is_preorder)
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-amber-50 border border-amber-200/70 text-amber-900 text-xs">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        <span><strong>Pre-Order Eksklusif:</strong> Estimasi penjahitan {{ $product->preorder_lead_days }} hari kerja</span>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-emerald-50 border border-emerald-200/70 text-emerald-900 text-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span><strong>Ready Stock:</strong> Tersedia di Gudang Surabaya &bull; Siap Kirim Hari Ini</span>
                    </div>
                @endif
            </div>

            <!-- Add to Cart Form -->
            <form action="{{ route('shop.cart.add') }}" method="POST" id="pdp-form" class="space-y-6 pt-2">
                @csrf
                <!-- Variant Selector (Sleek Modern Boutique Pills) -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="text-[11px] font-bold uppercase tracking-wider text-neutral-800">Pilih Varian (Warna & Ukuran)</label>
                        <span id="stock-feedback" class="text-xs text-neutral-500">Pilih salah satu varian</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        @foreach($product->skus as $index => $sku)
                            @php $stock = $skuStock[$sku->id] ?? 0; @endphp
                            <label class="relative flex items-center justify-between p-3.5 rounded-2xl border-2 border-neutral-200 cursor-pointer hover:border-neutral-900 transition-all has-[:checked]:border-neutral-900 has-[:checked]:bg-neutral-900 has-[:checked]:text-white group">
                                <input type="radio" name="sku_id" value="{{ $sku->id }}" 
                                    data-price="{{ $sku->price_idr }}" 
                                    data-formatted-price="{{ \App\Modules\Shared\Money\Money::format($sku->price_idr) }}"
                                    data-stock="{{ $stock }}"
                                    data-sku="{{ $sku->sku_code }}"
                                    onchange="onSelectSku(this)"
                                    class="sr-only" required {{ $index === 0 ? 'checked' : '' }}>
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full border border-neutral-400/50 flex-shrink-0" style="background-color: {{ str_contains(strtolower($sku->color), 'sage') ? '#8A9A86' : (str_contains(strtolower($sku->color), 'terra') ? '#C46D5E' : (str_contains(strtolower($sku->color), 'linen') ? '#D9CBB8' : '#D0A38B')) }}"></span>
                                        <p class="text-xs font-bold">{{ $sku->name }}</p>
                                    </div>
                                    <p class="text-[10px] opacity-75 pl-5">{{ $sku->color }} &bull; {{ $sku->size }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-full {{ $stock > 5 ? 'bg-emerald-100 text-emerald-800 group-has-[:checked]:bg-emerald-950 group-has-[:checked]:text-emerald-300' : ($stock > 0 ? 'bg-amber-100 text-amber-800 group-has-[:checked]:bg-amber-950 group-has-[:checked]:text-amber-300' : 'bg-rose-100 text-rose-800 group-has-[:checked]:bg-rose-950 group-has-[:checked]:text-rose-300') }}">
                                        {{ $stock > 0 ? "Stok: {$stock}" : 'Habis' }}
                                    </span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Quantity & Add to Cart Button -->
                <div class="flex items-center gap-3 pt-1">
                    <div class="w-28 flex-shrink-0">
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-neutral-500 mb-1">Jumlah</label>
                        <input type="number" name="quantity" value="1" min="1" max="10" class="w-full text-xs px-3 py-3.5 bg-neutral-50 border border-neutral-300 rounded-2xl font-bold text-center focus:outline-none focus:border-neutral-900">
                    </div>
                    <div class="flex-1 pt-4">
                        <button type="submit" id="submit-btn" class="w-full py-4 bg-neutral-900 hover:bg-neutral-800 text-white rounded-2xl font-bold text-xs uppercase tracking-widest shadow-xl transition-all hover:scale-[1.02]">
                            Masukkan Keranjang
                        </button>
                    </div>
                </div>
            </form>

            <!-- Interactive Fit Helper Section (Concierge Look) -->
            @if($product->length_cm)
                <div class="border border-[#BA805E]/30 rounded-3xl p-5 bg-[#FAF8F5] space-y-3.5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-[#BA805E]/20 text-[#8A4F35] flex items-center justify-center flex-shrink-0 font-bold text-xs">
                                📏
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-900">Interactive Fit Helper</h4>
                                <p class="text-[11px] text-neutral-500">Panjang busana: <strong class="text-neutral-900">{{ $product->length_cm }} cm</strong></p>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-neutral-600 leading-relaxed">
                        Pilih tinggi badan Anda untuk melihat simulasi jatuhnya baju pada postur tubuh:
                    </p>

                    <!-- Height Selector Buttons -->
                    <div class="grid grid-cols-4 gap-2 text-center text-xs">
                        <button type="button" onclick="calculateFit(152)" class="fit-btn py-2 px-1 rounded-xl border border-neutral-300 bg-white hover:border-neutral-900 text-[11px] font-semibold transition-all">150–155 cm</button>
                        <button type="button" onclick="calculateFit(158)" class="fit-btn py-2 px-1 rounded-xl border border-neutral-300 bg-white hover:border-neutral-900 text-[11px] font-semibold transition-all">156–160 cm</button>
                        <button type="button" onclick="calculateFit(163)" class="fit-btn py-2 px-1 rounded-xl border border-neutral-300 bg-white hover:border-neutral-900 text-[11px] font-semibold transition-all">161–165 cm</button>
                        <button type="button" onclick="calculateFit(168)" class="fit-btn py-2 px-1 rounded-xl border border-neutral-300 bg-white hover:border-neutral-900 text-[11px] font-semibold transition-all">166–170+ cm</button>
                    </div>

                    <!-- Dynamic Fit Output Card -->
                    <div id="fit-result-card" class="p-3.5 rounded-2xl bg-white border border-neutral-200/80 text-xs space-y-1">
                        <p class="font-bold text-[#8A4F35] text-[10px] uppercase tracking-wider">Simulasi Jatuhnya Baju:</p>
                        <p id="fit-description" class="text-neutral-700 leading-relaxed font-light">
                            Silakan pilih salah satu rentang tinggi badan Anda di atas.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Product Details Accordion -->
            <div class="border-t border-neutral-200 pt-6 space-y-4 text-xs">
                <div>
                    <h4 class="font-bold uppercase tracking-wider text-neutral-900 mb-1">Deskripsi & Karakteristik</h4>
                    <p class="text-neutral-600 leading-relaxed font-light">{{ $product->description }}</p>
                </div>
                <div>
                    <h4 class="font-bold uppercase tracking-wider text-neutral-900 mb-1">Material & Komposisi</h4>
                    <p class="text-neutral-600 font-light">{{ $product->material }}</p>
                </div>
                @if($product->care_instructions)
                    <div>
                        <h4 class="font-bold uppercase tracking-wider text-neutral-900 mb-1">Instruksi Perawatan</h4>
                        <p class="text-neutral-600 leading-relaxed font-light">{{ $product->care_instructions }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Mobile Sticky Bottom Floating Add-to-Cart Bar -->
<div class="sm:hidden fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-neutral-200 px-4 py-3 z-40 flex items-center justify-between shadow-2xl">
    <div>
        <span class="text-[10px] text-neutral-400 block uppercase font-bold tracking-wider">Total</span>
        <span id="mobile-price" class="font-bold text-neutral-900 text-sm">
            {{ \App\Modules\Shared\Money\Money::format($product->min_price) }}
        </span>
    </div>
    <button type="button" onclick="document.getElementById('pdp-form').submit()" class="px-6 py-3 bg-neutral-900 text-white rounded-full font-bold text-xs uppercase tracking-wider shadow-lg">
        + Keranjang
    </button>
</div>

<script>
    function onSelectSku(input) {
        const formattedPrice = input.getAttribute('data-formatted-price');
        const stock = parseInt(input.getAttribute('data-stock'));
        const skuCode = input.getAttribute('data-sku');

        document.getElementById('display-price').innerText = formattedPrice;
        const mobilePrice = document.getElementById('mobile-price');
        if (mobilePrice) mobilePrice.innerText = formattedPrice;

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
        document.querySelectorAll('.fit-btn').forEach(btn => btn.classList.remove('bg-neutral-900', 'text-white', 'border-neutral-900'));
        event.currentTarget.classList.add('bg-neutral-900', 'text-white', 'border-neutral-900');

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
