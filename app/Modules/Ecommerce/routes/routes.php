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

    Route::post(
        'revenuecat/restore',
        \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@syncSubscriber'
    )->middleware([\Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class]);
});

if(config('ecommerce.revenuecat_only') == true){
    Route::post(
        '/apple/verify-receipt-and-process-payment',
        \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@purchaseIOS'
    )
        ->name('apple_store_kit.process_receipt');

    Route::post(
        '/google/verify-receipt-and-process-payment',
        \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@purchaseGoogle'
    )
        ->name('google_play_store.process_receipt');

}

