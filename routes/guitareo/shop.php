<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guitareo\ShopController;

Route::domain('{guitareoDomain}')->group(function () {
    Route::get('/shop', [ShopController::class, 'shop']);

    Route::get('/shop/{productslug}', [ShopController::class, 'product']);
});
