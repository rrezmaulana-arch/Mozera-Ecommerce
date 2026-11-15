<?php

use App\Modules\Store\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/midtrans', [WebhookController::class, 'midtrans'])->name('midtrans');

