<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web_public'])
    ->group(function () {
        Route::get('/laravel/public/shopping-cart/api/query', [\App\Http\Controllers\Ecommerce\OrderController::class, 'redirectLegacyDrumeoAddToCartUrl'])
            ->name('redirect-legacy-drumeo-add-to-cart-url');
    });
