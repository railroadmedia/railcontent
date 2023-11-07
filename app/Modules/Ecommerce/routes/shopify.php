<?php

use App\Modules\Ecommerce\Controllers\ShopifyCartAPIController;
use App\Modules\Ecommerce\Controllers\ShopifyWebHookController;
use App\Modules\Ecommerce\Middleware\ShopifyWebhookVerify;
use Illuminate\Support\Facades\Route;

Route::post('ecommerce/shopify/webhook/order/update', [ShopifyWebHookController::class, 'orderUpdated'])
    ->middleware(ShopifyWebhookVerify::class)
    ->name('shopify.webhook.order.update');
Route::post('ecommerce/shopify/webhook/order/create', [ShopifyWebHookController::class, 'orderCreated'])
    ->middleware(ShopifyWebhookVerify::class)
    ->name('shopify.webhook.order.create');
Route::post('ecommerce/shopify/webhook/refunds/create', [ShopifyWebHookController::class, 'refundCreated'])
    ->middleware(ShopifyWebhookVerify::class)
    ->name('shopify.webhook.refund.create');

Route::prefix('ecommerce/shopify')->group(function () {

    Route::prefix('cart')
        ->group(function () {
            Route::get(
                'add-to-cart',
                ShopifyCartAPIController::class . '@createOrAddToCart'
            );
        });

    Route::get(
        'shopify-thank-you-page-account-creation-link-js-file',
        ShopifyCartAPIController::class . '@serveShopifyCartCustomizationScriptTagFile'
    );
});

Route::middleware(['web_public'])
    ->group(function () {
        Route::get(
            '/order/{brand?}',
            [\App\Modules\Ecommerce\Controllers\ShopifyCartAPIController::class, 'redirectToShopifyOrderForm']
        )
            ->name('redirect-to-shopify-order-form');
    });
