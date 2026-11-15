<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Product;
use App\Modules\Core\Models\Series;
use App\Modules\Core\Models\Sku;
use App\Modules\Wms\Models\StockBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['series', 'skus']);

        if ($request->filled('series_id')) {
            $query->where('series_id', $request->series_id);
        }

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('description', 'like', $search);
            });
        }

        $products = $query->latest()->paginate(15);
        $allSeries = Series::where('is_active', true)->get();

        return view('admin.store.products.index', compact('products', 'allSeries'));
    }

    public function create()
    {
        $allSeries = Series::where('is_active', true)->get();
        return view('admin.store.products.create', compact('allSeries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'series_id' => 'nullable|exists:series,id',
            'category' => 'required|string',
            'material' => 'nullable|string',
            'length_cm' => 'nullable|integer',
            'care_instructions' => 'nullable|string',
            'description' => 'nullable|string',
            'primary_image' => 'nullable|url',
            'is_preorder' => 'nullable|boolean',
            'preorder_lead_days' => 'nullable|integer',
            // SKUs
            'skus' => 'required|array|min:1',
            'skus.*.sku_code' => 'required|string|distinct',
            'skus.*.name' => 'required|string',
            'skus.*.color' => 'nullable|string',
            'skus.*.size' => 'nullable|string',
            'skus.*.price_idr' => 'required|integer|min:0',
            'skus.*.cost_idr' => 'nullable|integer|min:0',
            'skus.*.barcode' => 'nullable|string',
        ]);

        $product = Product::create([
            'ulid' => (string) Str::ulid(),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'series_id' => $request->series_id,
            'category' => $request->category,
            'material' => $request->material,
            'length_cm' => $request->length_cm,
            'care_instructions' => $request->care_instructions,
            'description' => $request->description,
            'primary_image' => $request->primary_image ?: 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=800&q=80',
            'is_preorder' => (bool)$request->is_preorder,
            'preorder_lead_days' => $request->preorder_lead_days ?: 0,
            'is_active' => true,
        ]);

        foreach ($request->skus as $skuData) {
            Sku::create([
                'ulid' => (string) Str::ulid(),
                'product_id' => $product->id,
                'sku_code' => strtoupper($skuData['sku_code']),
                'name' => $skuData['name'],
                'color' => $skuData['color'] ?? null,
                'size' => $skuData['size'] ?? 'All Size',
                'price_idr' => $skuData['price_idr'],
                'cost_idr' => $skuData['cost_idr'] ?? 0,
                'barcode' => $skuData['barcode'] ?? null,
                'image_url' => $product->primary_image,
                'is_active' => true,
            ]);
        }

        return redirect()->route('admin.store.products.index')->with('success', "Produk '{$product->name}' berhasil ditambahkan beserta varian SKU!");
    }

    public function show(int $id)
    {
        $product = Product::with(['series', 'skus'])->findOrFail($id);
        $stockBalances = StockBalance::with('location')->whereIn('sku_id', $product->skus->pluck('id'))->get();

        return view('admin.store.products.show', compact('product', 'stockBalances'));
    }
}

