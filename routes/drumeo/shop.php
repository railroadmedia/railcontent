<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\ShopController;

Route::domain('{drumeoDomain}')->group(function () {
    Route::get('/drumshop', [ShopController::class, 'shop']);

    Route::get('/drumshop/{productslug}', [ShopController::class, 'product']);
});
