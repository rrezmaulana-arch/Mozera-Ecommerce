<?php

use Illuminate\Support\Facades\Route;

// Fallback login route alias for Laravel auth middleware
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Web routes are organized modularly in:
// - routes/shop.php (Storefront E-commerce)
// - routes/admin.php (Staff Admin Portal & Command Center)
// - routes/webhooks.php (Payment & Service Webhooks)

