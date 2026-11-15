<?php

use App\Modules\Store\Controllers\CartController;
use App\Modules\Store\Controllers\CheckoutController;
use App\Modules\Store\Controllers\PaymentController;
use App\Modules\Store\Controllers\ReturnController;
use App\Modules\Store\Controllers\ShopController;
use App\Modules\Store\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

// Technical SEO routes
Route::get('/robots.txt', [ShopController::class, 'robotsTxt']);
Route::get('/llms.txt', [ShopController::class, 'llmsTxt']);
Route::get('/sitemap.xml', [ShopController::class, 'sitemapXml']);

// Storefront routes
Route::get('/', [ShopController::class, 'home'])->name('shop.home');
Route::get('/collections', [ShopController::class, 'catalog'])->name('shop.catalog');
Route::get('/products/{slug}', [ShopController::class, 'product'])->name('shop.product');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('shop.cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('shop.cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('shop.cart.update');
Route::post('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('shop.cart.remove');
Route::post('/cart/voucher', [CartController::class, 'applyVoucher'])->name('shop.cart.voucher');
Route::post('/cart/voucher/remove', [CartController::class, 'removeVoucher'])->name('shop.cart.voucher.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('shop.checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('shop.checkout.process');

// Hosted Payment Simulator
Route::get('/order/{ulid}/payment', [PaymentController::class, 'show'])->name('shop.order.payment');
Route::post('/order/{ulid}/payment/simulate', [PaymentController::class, 'simulateSuccess'])->name('shop.order.payment.simulate');
Route::post('/order/{ulid}/payment/expire', [PaymentController::class, 'simulateExpire'])->name('shop.order.payment.expire');

// Self-service Order Tracking
Route::get('/tracking', [TrackingController::class, 'index'])->name('shop.tracking');
Route::get('/tracking/{order_number}', [TrackingController::class, 'detail'])->name('shop.tracking.detail');

// Self-service Returns
Route::get('/returns', [ReturnController::class, 'index'])->name('shop.returns');
Route::post('/returns', [ReturnController::class, 'store'])->name('shop.returns.store');

