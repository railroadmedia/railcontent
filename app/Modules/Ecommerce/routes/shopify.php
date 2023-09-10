<?php

use App\Modules\Ecommerce\Controllers\ShopifyWebHookController;
use Illuminate\Support\Facades\Route;

Route::prefix('ecommerce/shopify')->group(function () {
    Route::prefix('webhook')->group(function () {
        Route::post(
            'order/create',
            ShopifyWebHookController::class . '@orderCreated'
        )->name('shopify.webhook.order.create');

        Route::post(
            'order/update',
            ShopifyWebHookController::class . '@orderUpdated'
        )->name('shopify.webhook.order.update');
    });
});

