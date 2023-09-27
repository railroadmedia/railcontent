<?php

use App\Modules\Ecommerce\Controllers\AccessCodeController;
use App\Modules\Ecommerce\Controllers\AccessCodeJsonController;
use App\Modules\Ecommerce\Controllers\RevenueCatController;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable;
use Railroad\Ecommerce\Controllers\AppleStoreKitController;

Route::prefix(config('ecommerce.route_prefix'))->group(function () {
    Route::post(
        'apple/webhook/notification/v1',
        AppleStoreKitController::class . '@processNotification'
    );

    Route::post(
        'revenuecat/webhook/notification',
        RevenueCatController::class . '@processNotification'
    );

    Route::post(
        'revenuecat/restore',
        RevenueCatController::class . '@syncSubscriber'
    )->middleware([AuthenticateIfAvailable::class]);

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
});
