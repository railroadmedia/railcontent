<?php

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

