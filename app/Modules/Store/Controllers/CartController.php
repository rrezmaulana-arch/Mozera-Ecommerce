<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Sku;
use App\Modules\Store\Models\Cart;
use App\Modules\Store\Models\CartItem;
use App\Modules\Store\Models\Voucher;
use App\Modules\Wms\Models\StockBalance;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function getOrCreateCart(Request $request): Cart
    {
        $sessionId = $request->header('X-Session-ID') ?: $request->session()->getId();
        return Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['expires_at' => now()->addDays(7)]
        );
    }

    public function index(Request $request)
    {
        $cart = $this->getOrCreateCart($request);
        $cart->load(['items.sku.product']);

        $appliedVoucherCode = $request->session()->get('applied_voucher');
        $voucher = null;
        $discountIdr = 0;

        if ($appliedVoucherCode) {
            $voucher = Voucher::where('code', $appliedVoucherCode)->first();
            if ($voucher && $voucher->isUsableBy($cart->total, auth()->id())) {
                $discountIdr = $voucher->calculateDiscount($cart->total);
            } else {
                $voucher = null;
                $request->session()->forget('applied_voucher');
            }
        }

        return view('shop.cart', compact('cart', 'voucher', 'discountIdr'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'sku_id' => 'required|exists:skus,id',
            'quantity' => 'nullable|integer|min:1|max:10',
        ]);

        $sku = Sku::with('product')->findOrFail($request->sku_id);

        // SKU dan produk harus aktif
        if (! $sku->is_active || ! $sku->product || ! $sku->product->is_active) {
            return back()->with('error', 'Maaf, varian atau produk ini saat ini tidak tersedia.');
        }

        $qty = (int) $request->input('quantity', 1);

        $cart = $this->getOrCreateCart($request);
        $item = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'sku_id' => $sku->id,
        ]);

        $totalQty = ($item->exists ? (int) $item->quantity : 0) + $qty;
        if ($totalQty > 10) {
            return back()->with('error', 'Maksimal pembelian untuk satu varian produk adalah 10 pcs.');
        }

        // Check available stock against total quantity
        $available = (int) StockBalance::where('sku_id', $sku->id)->sum('available_qty');
        if ($available < $totalQty) {
            return back()->with('error', "Maaf, stok untuk varian ini tersisa {$available} pcs.");
        }

        $item->quantity = $totalQty;
        $item->save();

        return redirect()->route('shop.cart')->with('success', "{$sku->name} berhasil ditambahkan ke keranjang belanja!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:0|max:10',
        ]);

        $cart = $this->getOrCreateCart($request);

        foreach ($request->quantities as $itemId => $qty) {
            $item = CartItem::where('cart_id', $cart->id)->where('id', $itemId)->with('sku.product')->first();
            if ($item) {
                if ($qty <= 0) {
                    $item->delete();
                } else {
                    if (! $item->sku || ! $item->sku->is_active || ! $item->sku->product || ! $item->sku->product->is_active) {
                        return back()->with('error', 'Produk dalam keranjang tidak lagi aktif.');
                    }

                    $available = (int) StockBalance::where('sku_id', $item->sku_id)->sum('available_qty');
                    if ($available < $qty) {
                        return back()->with('error', "Maaf, stok untuk {$item->sku->product->name} tersisa {$available} pcs.");
                    }

                    $item->quantity = min(10, $qty);
                    $item->save();
                }
            }
        }

        return redirect()->route('shop.cart')->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove(Request $request, int $itemId)
    {
        $cart = $this->getOrCreateCart($request);
        CartItem::where('cart_id', $cart->id)->where('id', $itemId)->delete();

        return redirect()->route('shop.cart')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function applyVoucher(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = strtoupper(trim($request->code));
        $voucher = Voucher::where('code', $code)->first();

        if (! $voucher) {
            return back()->with('error', 'Kode voucher tidak valid atau telah kedaluwarsa.');
        }

        $cart = $this->getOrCreateCart($request);
        $errorMessage = $voucher->getValidationErrorMessage($cart->total, auth()->id());
        if ($errorMessage !== null) {
            return back()->with('error', $errorMessage);
        }

        $request->session()->put('applied_voucher', $voucher->code);
        return back()->with('success', "Voucher {$voucher->code} berhasil digunakan!");
    }

    public function removeVoucher(Request $request)
    {
        $request->session()->forget('applied_voucher');
        return back()->with('success', 'Voucher telah dilepas.');
    }
}

