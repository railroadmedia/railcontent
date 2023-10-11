<?php

use Illuminate\Support\Facades\Route;
use Railroad\Ecommerce\Controllers\AppleStoreKitController;

Route::prefix(config('ecommerce.route_prefix'))
    ->group(function () {
        Route::post(
            'apple/webhook/notification/v1',
            AppleStoreKitController::class.'@processNotification'
        );

        Route::post(
            'revenuecat/webhook/notification',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class.'@processNotification'
        );

        Route::post(
            'revenuecat/restore',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class.'@syncSubscriber'
        )
            ->middleware([\Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class]);

        Route::post(
            'revenuecat/signup',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class.'@signupRevenuecat'
        )
            ->middleware([\Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class]);
    });

if (config('ecommerce.revenuecat_only') == true) {
    Route::group([
                     'prefix' => config('ecommerce.mobile_app'),
                     'middleware' => config('ecommerce.route_middleware_mobile_app_receipt_validation_groups'),
                 ], function () {
        //'middleware' => config('ecommerce.route_middleware_mobile_app_receipt_validation_groups'),
        Route::post(
            '/apple/verify-receipt-and-process-payment',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class.'@purchaseIOS'
        )
            ->name('apple_store_kit.process_receipt');

        Route::post(
            '/api/apple/signup',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class. '@signupIOS'
        )
            ->name('apple_store_kit.signup');

        Route::post(
            '/api/apple/restore',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class. '@restoreIOS'
        )
            ->name('apple_store_kit.restore');

        Route::post(
            '/google/verify-receipt-and-process-payment',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class.'@purchaseGoogle'
        )
            ->name('google_play_store.process_receipt');
        Route::post(
            '/api/google/signup',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class.'@signupGoogle'
        )
            ->name('google_play_store.signup');

        Route::post(
            '/api/google/restore',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class.'@restoreGoogle'
        )
            ->name('google_play_store.restore');
    });
}

