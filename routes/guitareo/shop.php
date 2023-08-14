<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guitareo\ShopController;

Route::domain('{guitareoDomain}')
    ->middleware(['web_public'])
    ->group(function () {

        Route::get('/{category}', [ShopController::class, 'shop'])
            ->whereIn('category', ['shop', 'lessons', 'accessories']);;

    Route::get('/shop/{productslug}', [ShopController::class, 'product']);
});
