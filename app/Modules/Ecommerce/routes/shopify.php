<?php

use App\Modules\Ecommerce\Controllers\ShopifyCartAPIController;
use App\Modules\Ecommerce\Controllers\ShopifyWebHookController;
use App\Modules\Ecommerce\Middleware\ShopifyWebhookVerify;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Middleware\AuthenticateViaKeyIfAvailable;

Route::prefix('ecommerce/shopify')
    ->middleware(config('ecommerce.route_middleware_public_groups'))
    ->group(function () {
        Route::prefix('webhook')
            ->middleware(ShopifyWebhookVerify::class)
            ->group(function () {
                Route::post('order/update', [ShopifyWebHookController::class, 'orderUpdated'])
                    ->name('shopify.webhook.order.update');

                Route::post('order/create', [ShopifyWebHookController::class, 'orderCreated'])
                    ->name('shopify.webhook.order.create');

                Route::post('refunds/create', [ShopifyWebHookController::class, 'refundCreated'])
                    ->name('shopify.webhook.refund.create');
            });

        Route::prefix('cart')
            ->group(function () {
                Route::get(
                    'add-to-cart',
                    ShopifyCartAPIController::class.'@createOrAddToCart'
                );
            });

        Route::get(
            'shopify-thank-you-page-account-creation-link-js-file',
            ShopifyCartAPIController::class.'@serveShopifyCartCustomizationScriptTagFile'
        );

        Route::get(
            'redirect-to-current-cart-shop-page',
            [ShopifyCartAPIController::class, 'redirectToCurrentCartShopPage']
        )
            ->name('redirect-to-current-cart-shop-page');
    });

Route::get(
    '/order/{brand?}',
    [ShopifyCartAPIController::class, 'redirectToShopifyOrderForm']
)
    ->name('redirect-to-shopify-order-form')
    ->middleware(
        array_merge([AuthenticateViaKeyIfAvailable::class], config('ecommerce.route_middleware_public_groups'))
    );
