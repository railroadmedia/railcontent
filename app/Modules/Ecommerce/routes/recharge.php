<?php

use App\Modules\Ecommerce\Controllers\RechargeWebhookController;
use App\Modules\Ecommerce\Middleware\RechargeWebhookVerify;

Route::prefix('ecommerce/recharge')
    ->middleware(config('ecommerce.route_middleware_public_groups'))
    ->group(function () {
        Route::prefix('webhook')
            ->middleware(RechargeWebhookVerify::class)
            ->group(function () {
                Route::post('subscription/cancelled', [RechargeWebhookController::class, 'subscriptionCancelled'])
                    ->name('recharge.webhook.subscription.cancel');
            });
    });

