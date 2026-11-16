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

        $curatedLooks = collect();

        if ($puspaOuter && $puspaOuter->skus->isNotEmpty()) {
            $curatedLooks->push([
                'id' => 1,
                'tag' => '01 • KAJIAN & FORMAL',
                'title' => 'The Grand Senja Kimono',
                'vibe' => 'Potongan kimono santun dengan siluet jatuh bebas kusut, dipadukan voal segiempat tegak di dahi.',
                'model_image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=900&q=80',
                'hanger_image' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800&q=80',
                'hero_product' => $puspaOuter,
                'hero_sku' => $puspaOuter->skus->first(),
                'hero_role' => 'Atasan / Outer Utama',
                'secondary_product' => $puspaScarf,
                'secondary_sku' => $puspaScarf?->skus->first() ?? $puspaOuter->skus->first(),
                'secondary_role' => 'Scarf Voal Ultrafine 120x120',
                'bundle_discount_pct' => 10,
            ]);

            $curatedLooks->push([
                'id' => 2,
                'tag' => '02 • WISUDA & KANTOR',
                'title' => 'Belgian Linen Trench Set',
                'vibe' => 'Struktur berwibawa dari 100% Belgian Washed Linen dengan tali serut untuk siluet ramping modest.',
                'model_image' => 'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?w=900&q=80',
                'hanger_image' => 'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?w=800&q=80',
                'hero_product' => $septTrench ?? $puspaOuter,
                'hero_sku' => ($septTrench ?? $puspaOuter)->skus->first(),
                'hero_role' => 'Trench Outerwear',
                'secondary_product' => $puspaScarf,
                'secondary_sku' => $puspaScarf?->skus->skip(1)->first() ?? $puspaScarf?->skus->first() ?? $puspaOuter->skus->first(),
                'secondary_role' => 'Scarf Voal Segiempat Olive',
                'bundle_discount_pct' => 10,
            ]);

            $curatedLooks->push([
                'id' => 3,
                'tag' => '03 • CASUAL HANGOUT',
                'title' => 'Terracotta Sunset Outer',
                'vibe' => 'Nuansa earth-tone terakota hangat untuk momen santai sore dan silaturahmi akhir pekan.',
                'model_image' => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=900&q=80',
                'hanger_image' => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=800&q=80',
                'hero_product' => $puspaOuter,
                'hero_sku' => $puspaOuter->skus->skip(1)->first() ?? $puspaOuter->skus->first(),
                'hero_role' => 'Outer Kimono Terakota',
                'secondary_product' => $puspaScarf,
                'secondary_sku' => $puspaScarf?->skus->first() ?? $puspaOuter->skus->first(),
                'secondary_role' => 'Voal Ultrafine Glow',
                'bundle_discount_pct' => 10,
            ]);

            $curatedLooks->push([
                'id' => 4,
                'tag' => '04 • KONDANGAN ELEGAN',
                'title' => 'Timeless Layering Maxi',
                'vibe' => 'Paduan outerwear santun dengan maxi inner tanpa terawang untuk jamuan formal & kondangan.',
                'model_image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=900&q=80',
                'hanger_image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=800&q=80',
                'hero_product' => $septTrench ?? $puspaOuter,
                'hero_sku' => ($septTrench ?? $puspaOuter)->skus->first(),
                'hero_role' => 'Linen Trench Outer',
                'secondary_product' => $islaDress ?? $puspaOuter,
                'secondary_sku' => ($islaDress ?? $puspaOuter)->skus->first(),
                'secondary_role' => 'Maxi Inner Crinkle Airflow',
                'bundle_discount_pct' => 10,
            ]);
        }

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

