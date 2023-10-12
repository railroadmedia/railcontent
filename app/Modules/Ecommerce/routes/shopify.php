<?php

use App\Modules\Ecommerce\Controllers\ShopifyCartAPIController;
use App\Modules\Ecommerce\Controllers\ShopifyWebHookController;
use App\Modules\Ecommerce\Middleware\WebhookVerify;
use Illuminate\Support\Facades\Route;

Route::prefix('ecommerce/shopify')->group(function () {
    Route::prefix('webhook')
        ->middleware(WebhookVerify::class)
        ->group(function () {
            Route::post(
                'order/update',
                ShopifyWebHookController::class . '@orderUpdated'
            )->name('shopify.webhook.order.update');
        });

    Route::prefix('cart')
        ->group(function () {
            Route::get(
                'add-to-cart',
                ShopifyCartAPIController::class . '@createOrAddToCart'
            );
        });
});

Route::middleware(['web_public'])
    ->group(function () {
        Route::get('/order/{brand?}', [\App\Modules\Ecommerce\Controllers\ShopifyCartAPIController::class, 'redirectToShopifyOrderForm'])
            ->name('redirect-to-shopify-order-form');
    });
