<?php

use App\Modules\Ecommerce\Controllers\ShopifyCartAPIController;
use Illuminate\Support\Facades\Route;
use Railroad\Ecommerce\Controllers\AppleStoreKitController;

Route::prefix(config('ecommerce.route_prefix'))->group(function () {
    Route::post(
        'apple/webhook/notification/v1',
        AppleStoreKitController::class . '@processNotification'
    );

    Route::post(
        'revenuecat/webhook/notification',
        \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@processNotification'
    );
});

Route::prefix('shopify')->group(function () {
    Route::get(
        'handle-webhook',
        ShopifyCartAPIController::class . '@addToCart'
    );
    Route::get(
        'add-to-cart',
        ShopifyCartAPIController::class . '@addToCart'
    );
    Route::get(
        'set-shopify-cart-id-cookie-and-redirect-to-cart',
        ShopifyCartAPIController::class . '@setShopifyCartIdCookieAndRedirectToCart'
    );
});
