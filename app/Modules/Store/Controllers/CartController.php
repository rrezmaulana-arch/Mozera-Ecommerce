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
            $voucher = Voucher::where('code', $appliedVoucherCode)->where('is_active', true)->first();
            if ($voucher) {
                $discountIdr = $voucher->calculateDiscount($cart->total);
            }
        }

        return view('shop.cart', compact('cart', 'voucher', 'discountIdr'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'sku_id' => 'required|exists:skus,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $sku = Sku::findOrFail($request->sku_id);
        $qty = $request->input('quantity', 1);

        // Check available stock
        $available = StockBalance::where('sku_id', $sku->id)->sum('available_qty');
        if ($available < $qty) {
            return back()->with('error', "Maaf, stok untuk varian ini tersisa {$available} pcs.");
        }

        $cart = $this->getOrCreateCart($request);
        $item = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'sku_id' => $sku->id,
        ]);

        $item->quantity = ($item->exists ? $item->quantity : 0) + $qty;
        $item->save();

        return redirect()->route('shop.cart')->with('success', "{$sku->name} berhasil ditambahkan ke keranjang belanja!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:0',
        ]);

        $cart = $this->getOrCreateCart($request);

        foreach ($request->quantities as $itemId => $qty) {
            $item = CartItem::where('cart_id', $cart->id)->where('id', $itemId)->first();
            if ($item) {
                if ($qty <= 0) {
                    $item->delete();
                } else {
                    $item->quantity = $qty;
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

        $code = strtoupper($request->code);
        $voucher = Voucher::where('code', $code)->where('is_active', true)->first();

        if (!$voucher) {
            return back()->with('error', 'Kode voucher tidak valid atau telah kedaluwarsa.');
        }

        $cart = $this->getOrCreateCart($request);
        if ($cart->total < $voucher->min_purchase_idr) {
            return back()->with('error', 'Minimum belanja untuk voucher ini adalah Rp ' . number_format($voucher->min_purchase_idr, 0, ',', '.'));
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

