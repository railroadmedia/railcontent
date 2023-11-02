<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\ShopController;

Route::domain('{singeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::group(['prefix' => 'shop' ],
            function () {
            }
        );

        Route::get('/{category}', [ShopController::class, 'shop'])
            ->whereIn('category', ['shop', 'lessons', 'accessories', 'clothing']);;

        Route::get('/shop/{productslug}', [ShopController::class, 'product']);
});

