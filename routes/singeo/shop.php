<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\ShopController;
use App\Http\Controllers\Singeo\SalesController;

Route::domain('{singeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::group(['prefix' => 'shop' ],
            function () {
                Route::get('/singing-starter-kit', [SalesController::class, 'singingstarterkit']);
                Route::get('/beautiful-harmonies', [SalesController::class, 'beautifulharmonies']);
            }
        );

        Route::get('/{category}', [ShopController::class, 'shop'])
            ->whereIn('category', ['shop', 'lessons', 'accessories', 'clothing']);;

        Route::get('/shop/{productslug}', [ShopController::class, 'product']);
});

