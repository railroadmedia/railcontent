<?php

use App\Modules\Ecommerce\Controllers\RechargeWebhookController;
use App\Modules\Ecommerce\Middleware\RechargeWebhookVerify;
use Illuminate\Support\Facades\Route;

Route::prefix('ecommerce/recharge')
    ->middleware(config('ecommerce.route_middleware_public_groups'))
    ->group(function () {
        Route::prefix('webhook')
            ->middleware(RechargeWebhookVerify::class)
            ->group(function () {
                Route::post('subscription/paused', [RechargeWebhookController::class, 'subscriptionPaused'])
                    ->name('recharge.webhook.subscription.paused');

                Route::post('subscription/cancelled', [RechargeWebhookController::class, 'subscriptionCancelled'])
                    ->name('recharge.webhook.subscription.cancel');

                Route::post('charge/failed', [RechargeWebhookController::class, 'chargeFailed'])
                    ->name('recharge.webhook.charge.failed');

                Route::post('customer/payment-method-updated', [RechargeWebhookController::class, 'paymentMethodUpdated'])
                    ->name('recharge.webhook.customer.payment-method-updated');
            });
    });
