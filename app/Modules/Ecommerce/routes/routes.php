<?php

use App\Modules\Ecommerce\Controllers\AccessCodeController;
use App\Modules\Ecommerce\Controllers\AccessCodeJsonController;
use App\Modules\Ecommerce\Controllers\RevenueCatController;
use App\Modules\Ecommerce\Controllers\UserAccessPermissionsController;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable;
use Railroad\Ecommerce\Controllers\AppleStoreKitController;

Route::prefix(config('ecommerce.route_prefix'))
    ->group(function () {
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
        )
            ->middleware([\Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class]);

        /*
* ACCESS CODES
*/
        Route::post(
            '/access-codes/redeem',
            AccessCodeController::class . '@claim'
        )
            ->name('access-codes.form-claim')
            ->middleware(config('ecommerce.route_middleware_public_groups'));
        Route::group([
            'middleware' => config('ecommerce.route_middleware_logged_in_groups'),
        ], function () {
            Route::get(
                '/access-codes',
                AccessCodeJsonController::class . '@index'
            )
                ->name('access-codes.index');
            Route::get(
                '/access-codes/search',
                AccessCodeJsonController::class . '@search'
            )
                ->name('access-codes.search');
            Route::post(
                '/access-codes/claim',
                AccessCodeJsonController::class . '@claim'
            )
                ->name('access-codes.claim');
            Route::post(
                '/access-codes/release',
                AccessCodeJsonController::class . '@release'
            )
                ->name('access-codes.release');
        });

      Route::get('user-access-permissions', UserAccessPermissionsController::class . '@index')
        ->name('user-access-permissions.index');
    });

if (config('ecommerce.revenuecat_only') == true) {
    Route::group([
        'prefix' => config('ecommerce.mobile_app'),
        'middleware' => config('ecommerce.route_middleware_mobile_app_receipt_validation_groups'),
    ], function () {
        //'middleware' => config('ecommerce.route_middleware_mobile_app_receipt_validation_groups'),
        Route::post(
            '/apple/verify-receipt-and-process-payment',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@purchaseIOS'
        )
            ->name('apple_store_kit.process_receipt');

        Route::post(
            '/api/apple/signup',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@signupIOS'
        )
            ->name('apple_store_kit.signup');

        Route::post(
            '/api/apple/restore',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@restoreIOS'
        )
            ->name('apple_store_kit.restore');

        Route::post(
            '/google/verify-receipt-and-process-payment',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@purchaseGoogle'
        )
            ->name('google_play_store.process_receipt');
        Route::post(
            '/api/google/signup',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@signupGoogle'
        )
            ->name('google_play_store.signup');

        Route::post(
            '/api/google/restore',
            \App\Modules\Ecommerce\Controllers\RevenueCatController::class . '@restoreGoogle'
        )
            ->name('google_play_store.restore');
    });
}

