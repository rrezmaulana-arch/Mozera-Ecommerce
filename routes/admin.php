<?php

use App\Modules\Admin\Controllers\AdminDropController;
use App\Modules\Admin\Controllers\AdminOrderController;
use App\Modules\Admin\Controllers\AdminProductController;
use App\Modules\Admin\Controllers\AdminReturnController;
use App\Modules\Admin\Controllers\AdminVoucherController;
use App\Modules\Admin\Controllers\AuthController;
use App\Modules\Admin\Controllers\CrmAffiliateController;
use App\Modules\Admin\Controllers\CrmCustomerController;
use App\Modules\Admin\Controllers\CrmDsrController;
use App\Modules\Admin\Controllers\CrmFlowController;
use App\Modules\Admin\Controllers\CrmLoyaltyController;
use App\Modules\Admin\Controllers\CrmSegmentController;
use App\Modules\Admin\Controllers\DashboardController;
use App\Modules\Admin\Controllers\WmsInboundController;
use App\Modules\Admin\Controllers\WmsInventoryController;
use App\Modules\Admin\Controllers\WmsMarketplaceImportController;
use App\Modules\Admin\Controllers\WmsPickingController;
use App\Modules\Admin\Controllers\WmsReorderController;
use App\Modules\Admin\Controllers\WmsStocktakeController;
use Illuminate\Support\Facades\Route;

// Authentication with rate limiting to prevent brute force
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.submit');
Route::get('/quick-login/{userId}', [AuthController::class, 'quickLogin'])->name('quick-login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Portal
Route::middleware('auth')->group(function () {
    // Command Center / Daily Decision Dashboard (Owner only)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/actions/{id}/resolve', [DashboardController::class, 'resolveActionItem'])->middleware('role:owner')->name('actions.resolve');
    Route::post('/actions/{id}/dismiss', [DashboardController::class, 'dismissActionItem'])->middleware('role:owner')->name('actions.dismiss');

    // Store & E-commerce Operations (owner, store_admin)
    Route::prefix('store')->name('store.')->middleware('role:store_admin')->group(function () {
        // Products
        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}', [AdminProductController::class, 'show'])->name('products.show');
        Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('products.update');

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

        // Returns
        Route::get('/returns', [AdminReturnController::class, 'index'])->name('returns.index');
        Route::get('/returns/{id}', [AdminReturnController::class, 'show'])->name('returns.show');
        Route::post('/returns/{id}/status', [AdminReturnController::class, 'updateStatus'])->name('returns.update-status');

        // Vouchers
        Route::get('/vouchers', [AdminVoucherController::class, 'index'])->name('vouchers.index');
        Route::post('/vouchers', [AdminVoucherController::class, 'store'])->name('vouchers.store');

        // Drops & Waitlists
        Route::get('/drops', [AdminDropController::class, 'index'])->name('drops.index');
        Route::post('/drops', [AdminDropController::class, 'store'])->name('drops.store');
    });

    // WMS & Warehouse Operations (owner, warehouse_staff)
    Route::prefix('wms')->name('wms.')->middleware('role:warehouse_staff')->group(function () {
        // Live inventory balances and immutable movements ledger
        Route::get('/inventory', [WmsInventoryController::class, 'index'])->name('inventory');
        Route::post('/inventory/adjust', [WmsInventoryController::class, 'adjust'])->name('inventory.adjust');

        // Inbound & Goods receipt
        Route::get('/inbound', [WmsInboundController::class, 'index'])->name('inbound.index');
        Route::post('/inbound', [WmsInboundController::class, 'store'])->name('inbound.store');

        // Pick & Pack with Web Barcode Scanner
        Route::get('/picking', [WmsPickingController::class, 'index'])->name('picking.index');
        Route::get('/picking/{id}/scan', [WmsPickingController::class, 'scanStation'])->name('picking.scan');
        Route::post('/picking/{id}/scan', [WmsPickingController::class, 'recordScan'])->name('picking.record-scan');
        Route::post('/picking/{id}/complete', [WmsPickingController::class, 'completePack'])->name('picking.complete');

        // Stocktake (Stock Opname)
        Route::get('/stocktake', [WmsStocktakeController::class, 'index'])->name('stocktake.index');
        Route::post('/stocktake', [WmsStocktakeController::class, 'create'])->name('stocktake.create');
        Route::get('/stocktake/{id}', [WmsStocktakeController::class, 'show'])->name('stocktake.show');
        Route::post('/stocktake/{id}/lines', [WmsStocktakeController::class, 'updateLines'])->name('stocktake.update-lines');
        Route::post('/stocktake/{id}/finalize', [WmsStocktakeController::class, 'finalize'])->name('stocktake.finalize');

        // Marketplace Importer (Shopee / TikTok Shop CSV)
        Route::get('/import', [WmsMarketplaceImportController::class, 'index'])->name('import.index');
        Route::post('/import', [WmsMarketplaceImportController::class, 'process'])->name('import.process');

        // Reorder Planner & Dead Stock
        Route::get('/reorder', [WmsReorderController::class, 'index'])->name('reorder');
        Route::post('/reorder/po', [WmsReorderController::class, 'createPo'])->name('reorder.po');
    });

    // CRM & Retention (owner, crm_marketer)
    Route::prefix('crm')->name('crm.')->middleware('role:crm_marketer')->group(function () {
        // Customer 360 & Identity Resolution
        Route::get('/customers', [CrmCustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/{id}', [CrmCustomerController::class, 'show'])->name('customers.show');
        Route::post('/customers/recalculate', [CrmCustomerController::class, 'recalculateRfm'])->name('customers.recalculate');
        Route::post('/customers/{id}/merge', [CrmCustomerController::class, 'merge'])->name('customers.merge');

        // RFM Segments
        Route::get('/segments', [CrmSegmentController::class, 'index'])->name('segments');

        // Email Flows & Owner Approval Queue
        Route::get('/flows', [CrmFlowController::class, 'index'])->name('flows');
        Route::post('/flows/runs/{id}/approve', [CrmFlowController::class, 'approve'])->name('flows.approve');
        Route::post('/flows/runs/{id}/reject', [CrmFlowController::class, 'reject'])->name('flows.reject');

        // Loyalty Points
        Route::get('/loyalty', [CrmLoyaltyController::class, 'index'])->name('loyalty');
        Route::post('/loyalty/adjust', [CrmLoyaltyController::class, 'adjust'])->name('loyalty.adjust');

        // Affiliates & Creator Attribution
        Route::get('/affiliates', [CrmAffiliateController::class, 'index'])->name('affiliates');
        Route::post('/affiliates', [CrmAffiliateController::class, 'store'])->name('affiliates.store');

        // Data Subject Rights (DSR / UU PDP)
        Route::get('/dsr', [CrmDsrController::class, 'index'])->name('dsr');
        Route::post('/dsr', [CrmDsrController::class, 'store'])->name('dsr.store');
        Route::post('/dsr/{id}/process', [CrmDsrController::class, 'process'])->name('dsr.process');
    });
});

