<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\ShopController;

Route::domain('{drumeoDomain}')->group(function () {
    Route::get('{category}', [ShopController::class, 'shop'])
        ->whereIn('category', ['drumshop', 'lessons', 'accessories', 'clothing']);

    Route::get('/drumshop/{productslug}', [ShopController::class, 'product']);
});
