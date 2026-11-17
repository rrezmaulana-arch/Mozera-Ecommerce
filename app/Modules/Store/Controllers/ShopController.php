<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Product;
use App\Modules\Core\Models\Series;
use App\Modules\Core\Models\Sku;
use App\Modules\Store\Models\Drop;
use App\Modules\Wms\Models\StockBalance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShopController extends Controller
{
    public function home()
    {
        $series = Series::where('is_active', true)->withCount('products')->get();
        $featuredProducts = Product::where('is_active', true)
            ->with(['series', 'skus'])
            ->latest()
            ->take(6)
            ->get();
        $liveDrop = Drop::where('is_active', true)->latest()->first();

        // Curated Modest Tops & Layering Looks for the Interactive Runway Lookbook
        $puspaOuter = Product::with('skus')->where('slug', 'puspa-floral-outer-kimono')->first() ?? $featuredProducts->first();
        $puspaScarf = Product::with('skus')->where('slug', 'puspa-voal-printed-scarf')->first() ?? $featuredProducts->skip(1)->first() ?? $puspaOuter;
        $septTrench = Product::with('skus')->where('slug', 'sept-drops-heritage-linen-trench')->first() ?? $featuredProducts->skip(2)->first() ?? $puspaOuter;
        $islaDress = Product::with('skus')->where('slug', 'isla-tiered-midi-dress')->first() ?? $featuredProducts->skip(3)->first() ?? $puspaOuter;

        // 8 Curated Looks from Folder 'gambar' (Tipe A: Siluet Klasik Lurus vs Tipe B: Siluet Fringe Rumbai)
        $islaOuter = Product::with('skus')->where('slug', 'isla-geometrik-kimono-outer')->first() ?? $puspaOuter;
        $defaultHeroSku = $puspaOuter?->skus->first();
        $defaultSecSku = $puspaScarf?->skus->first();
        
        $curatedLooks = collect([
            // --- TIPE A: Siluet Lurus Klasik (01 - 04, Foto Tampak Depan) ---
            [
                'id' => 1,
                'type' => 'Tipe A',
                'type_label' => 'Tipe A: Siluet Lurus Klasik',
                'title' => 'Heritage Parang Trench Outer',
                'vibe' => 'Motif parang heritage klasik cokelat hangat yang berwibawa dan anggun.',
                'model_image' => '/images/models/model-a-1-front.png',
                'side_image' => '/images/models/model-a-1-side.png',
                'back_image' => '/images/models/model-a-1-back.png',
                'has_angles' => true,
                'hero_product' => $septTrench ?? $puspaOuter,
                'hero_sku' => ($septTrench ?? $puspaOuter)?->skus->first() ?? $defaultHeroSku,
                'secondary_sku' => $defaultSecSku,
                'product_url' => route('shop.product', ($septTrench ?? $puspaOuter)->slug),
            ],
            [
                'id' => 2,
                'type' => 'Tipe A',
                'type_label' => 'Tipe A: Siluet Lurus Klasik',
                'title' => 'PUSPA Indigo Navy Kimono',
                'vibe' => 'Nuansa navy pekat anggun berpadu motif flora dan siluet kimono santun.',
                'model_image' => '/images/models/model-a-2-front.png',
                'side_image' => '/images/models/model-a-2-side.png',
                'back_image' => '/images/models/model-a-2-back.png',
                'has_angles' => true,
                'hero_product' => $puspaOuter,
                'hero_sku' => $puspaOuter?->skus->where('color', 'Indigo Navy')->first() ?? $defaultHeroSku,
                'secondary_sku' => $defaultSecSku,
                'product_url' => route('shop.product', $puspaOuter->slug),
            ],
            [
                'id' => 3,
                'type' => 'Tipe A',
                'type_label' => 'Tipe A: Siluet Lurus Klasik',
                'title' => 'PUSPA Sage Green Kimono',
                'vibe' => 'Warna sage green sejuk dengan siluet lurus yang jatuh flowy dan breathable.',
                'model_image' => '/images/models/model-a-3-front.png',
                'side_image' => '/images/models/model-a-3-side.png',
                'back_image' => '/images/models/model-a-3-back.png',
                'has_angles' => true,
                'hero_product' => $puspaOuter,
                'hero_sku' => $puspaOuter?->skus->where('color', 'Sage Green')->first() ?? $defaultHeroSku,
                'secondary_sku' => $defaultSecSku,
                'product_url' => route('shop.product', $puspaOuter->slug),
            ],
            [
                'id' => 4,
                'type' => 'Tipe A',
                'type_label' => 'Tipe A: Siluet Lurus Klasik',
                'title' => 'PUSPA Terracotta Kimono',
                'vibe' => 'Potongan kimono lurus klasik dengan detail motif flora terakota hangat.',
                'model_image' => '/images/models/model-a-4-front.png',
                'side_image' => '/images/models/model-a-4-side.png',
                'back_image' => '/images/models/model-a-4-back.png',
                'has_angles' => true,
                'hero_product' => $puspaOuter,
                'hero_sku' => $puspaOuter?->skus->where('color', 'Terracotta')->first() ?? $defaultHeroSku,
                'secondary_sku' => $defaultSecSku,
                'product_url' => route('shop.product', $puspaOuter->slug),
            ],

            // --- TIPE B: Siluet Fringe Rumbai dengan 3 Sudut Pandang (05 - 08) ---
            [
                'id' => 5,
                'type' => 'Tipe B',
                'type_label' => 'Tipe B: Siluet Fringe Rumbai',
                'title' => 'ISLA Sage Fringe Kimono',
                'vibe' => 'Kimono beraksen rumbai halus bernuansa sage green adem.',
                'model_image' => '/images/models/model-b-1-front.png',
                'side_image' => '/images/models/model-b-1-side.png',
                'back_image' => '/images/models/model-b-1-back.png',
                'has_angles' => true,
                'hero_product' => $islaOuter,
                'hero_sku' => $islaOuter?->skus->first() ?? $defaultHeroSku,
                'secondary_sku' => $defaultSecSku,
                'product_url' => route('shop.product', $islaOuter->slug),
            ],
            [
                'id' => 6,
                'type' => 'Tipe B',
                'type_label' => 'Tipe B: Siluet Fringe Rumbai',
                'title' => 'Ivory Sand Lace Fringe Outer',
                'vibe' => 'Bahan lembut berongga dengan aksen rumbai bohemia berkelas.',
                'model_image' => '/images/models/model-b-2-front.png',
                'side_image' => '/images/models/model-b-2-side.png',
                'back_image' => '/images/models/model-b-2-back.png',
                'has_angles' => true,
                'hero_product' => $islaOuter,
                'hero_sku' => $islaOuter?->skus->first() ?? $defaultHeroSku,
                'secondary_sku' => $defaultSecSku,
                'product_url' => route('shop.product', $islaOuter->slug),
            ],
            [
                'id' => 7,
                'type' => 'Tipe B',
                'type_label' => 'Tipe B: Siluet Fringe Rumbai',
                'title' => 'Burgundy Wine Fringe Kimono',
                'vibe' => 'Warna marun anggun dengan rumbai dinamis yang flowy saat melangkah.',
                'model_image' => '/images/models/model-b-3-front.png',
                'side_image' => '/images/models/model-b-3-side.png',
                'back_image' => '/images/models/model-b-3-back.png',
                'has_angles' => true,
                'hero_product' => $islaOuter,
                'hero_sku' => $islaOuter?->skus->first() ?? $defaultHeroSku,
                'secondary_sku' => $defaultSecSku,
                'product_url' => route('shop.product', $islaOuter->slug),
            ],
            [
                'id' => 8,
                'type' => 'Tipe B',
                'type_label' => 'Tipe B: Siluet Fringe Rumbai',
                'title' => 'Midnight Indigo Fringe Outer',
                'vibe' => 'Aksen rumbai mewah berpadu tenun indigo malam yang memikat.',
                'model_image' => '/images/models/model-b-4-front.png',
                'side_image' => '/images/models/model-b-4-side.png',
                'back_image' => '/images/models/model-b-4-back.png',
                'has_angles' => true,
                'hero_product' => $islaOuter,
                'hero_sku' => $islaOuter?->skus->first() ?? $defaultHeroSku,
                'secondary_sku' => $defaultSecSku,
                'product_url' => route('shop.product', $islaOuter->slug),
            ],
        ]);

        return view('shop.home', compact('series', 'featuredProducts', 'liveDrop', 'curatedLooks'));
    }

    public function catalog(Request $request)
    {
        $query = Product::where('is_active', true)->with(['series', 'skus']);

        if ($request->filled('series')) {
            $query->whereHas('series', function ($q) use ($request) {
                $q->where('code', $request->series);
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('description', 'like', $search)
                  ->orWhere('material', 'like', $search);
            });
        }

        if ($request->sort === 'price_asc') {
            $query->orderBy(Sku::select('price_idr')->whereColumn('product_id', 'products.id')->orderBy('price_idr', 'asc')->limit(1), 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy(Sku::select('price_idr')->whereColumn('product_id', 'products.id')->orderBy('price_idr', 'desc')->limit(1), 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $allSeries = Series::where('is_active', true)->get();

        return view('shop.catalog', compact('products', 'allSeries'));
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['series', 'skus'])
            ->firstOrFail();

        // Calculate available stock per SKU
        $skuStock = [];
        foreach ($product->skus as $sku) {
            $available = StockBalance::where('sku_id', $sku->id)->sum('available_qty');
            $skuStock[$sku->id] = (int) $available;
        }

        $relatedProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                $q->where('series_id', $product->series_id)
                  ->orWhere('category', $product->category);
            })
            ->with('skus')
            ->take(4)
            ->get();

        return view('shop.product', compact('product', 'skuStock', 'relatedProducts'));
    }

    public function robotsTxt(): Response
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /checkout/\nDisallow: /cart/\nSitemap: " . url('/sitemap.xml');
        return response($content, 200)->header('Content-Type', 'text/plain');
    }

    public function llmsTxt(): Response
    {
        $content = "# MOZÉRA Knowledge Base\n\n" .
            "Platform Terpadu MOZÉRA: E-commerce, Gudang & CRM untuk brand fashion modest premium Nusantara (#everydaymozera).\n\n" .
            "## Produk Utama\n" .
            "- Outerwear Kimono & Trench Linen (Seri PUSPA, Sept Drops)\n" .
            "- Voal Ultrafine Scarf 120x120\n" .
            "- Tiered Midi Dress Airflow (Seri ISLA)\n\n" .
            "## Kebijakan Layanan\n" .
            "- Garansi retur/tukar 7 hari mandiri tanpa chat admin WhatsApp via portal: " . url('/returns') . "\n" .
            "- Lacak pengiriman real-time: " . url('/tracking') . "\n" .
            "- Pembayaran instan aman via QRIS, Virtual Account, & Kartu Kredit.\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }

    public function sitemapXml(): Response
    {
        $products = Product::where('is_active', true)->get();
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $xml .= '<url><loc>' . url('/') . '</loc><priority>1.0</priority></url>';
        $xml .= '<url><loc>' . url('/collections') . '</loc><priority>0.9</priority></url>';
        $xml .= '<url><loc>' . url('/tracking') . '</loc><priority>0.7</priority></url>';
        $xml .= '<url><loc>' . url('/returns') . '</loc><priority>0.7</priority></url>';

        foreach ($products as $p) {
            $xml .= '<url><loc>' . url('/products/' . $p->slug) . '</loc><priority>0.8</priority></url>';
        }

        $xml .= '</urlset>';
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}

