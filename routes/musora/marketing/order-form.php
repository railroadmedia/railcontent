<?php

use Illuminate\Support\Facades\Route;

// not needed until we have a shopping experience on musora.com
Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/order/{brand}', [\App\Http\Controllers\Ecommerce\OrderController::class, 'showOrderForm'])
            ->name('order-form');
    });

Route::domain('{drumeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/order/{brand}', [\App\Http\Controllers\Ecommerce\OrderController::class, 'showOrderForm'])
            ->name('drumeo.order-form');
    });

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/order/{brand}', [\App\Http\Controllers\Ecommerce\OrderController::class, 'showOrderForm'])
            ->name('pianote.order-form');
    });

Route::domain('{guitareoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/order/{brand}', [\App\Http\Controllers\Ecommerce\OrderController::class, 'showOrderForm'])
            ->name('guitareo.order-form');
    });

Route::domain('{singeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/order/{brand}', [\App\Http\Controllers\Ecommerce\OrderController::class, 'showOrderForm'])
            ->name('singeo.order-form');
    });

Route::middleware(['web_public'])
    ->group(function () {
        Route::get('/order', [\App\Http\Controllers\Ecommerce\OrderController::class, 'redirectToMusoraOrderForm'])
            ->name('brand-order-form-redirect-to-musora');
    });

Route::middleware(['web_public'])
    ->group(function () {
        Route::get('/laravel/public/shopping-cart/api/query', [\App\Http\Controllers\Ecommerce\OrderController::class, 'redirectLegacyDrumeoAddToCartUrl'])
            ->name('redirect-legacy-drumeo-add-to-cart-url');
    });

Route::middleware(['web_public'])
    ->group(function () {
        Route::get('/thankyou', [\App\Http\Controllers\Ecommerce\OrderController::class, 'thankYouPageForCustomerOrder'])
            ->name('order-thank-you');
    });
