<?php

use App\Modules\Ecommerce\Controllers\ShopifyWebHookController;
use App\Modules\Ecommerce\Middleware\ShopifyWebhookVerify;
use Illuminate\Support\Facades\Route;

Route::prefix('ecommerce/shopify')->group(function () {
    Route::prefix('webhook')
        ->middleware(ShopifyWebhookVerify::class)
        ->group(function () {
            Route::post('order/update', [ShopifyWebHookController::class, 'orderUpdated'])
                ->name('shopify.webhook.order.update');

            Route::post('order/create', [ShopifyWebHookController::class, 'orderCreated'])
                ->name('shopify.webhook.order.create');
        });
});
