<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Controllers\AuthenticationController;
use Modules\UserManagementSystem\Controllers\ForgotPasswordController;
use Modules\UserManagementSystem\Controllers\ResetPasswordController;


Route::group(
    ['prefix' => config('user_management_system.route_prefix'),],
    function () {
        /*
         * Authentication
         */
        Route::post(
            'login/token',
            AuthenticationController::class . '@loginToken',
        )->middleware(     [
//            \Railroad\Ecommerce\Middleware\SyncInAppPurchasedItems::class,
            \Railroad\MusoraApi\Middleware\AddMemberData::class,
        ])
            ->name('user_management_system.login.token');

        Route::get(
            'logout/token',
            AuthenticationController::class . '@logoutToken'
        )
            ->name('user_management_system.logout.token');

        Route::post(
            'login/cookie',
            AuthenticationController::class . '@loginCookie'
        )
            ->name('user_management_system.login.cookie');

        Route::get(
            'logout/cookie',
            AuthenticationController::class . '@logoutCookie'
        )
            ->name('user_management_system.logout.cookie');

        Route::post(
            'password/send-reset-email',
            ForgotPasswordController::class . '@sendResetLinkEmail'
        )
            ->name('user_management_system.password.send-reset-email');

        Route::post(
            'password/reset-password-with-token',
            ResetPasswordController::class . '@resetPasswordWithToken'
        )
            ->name('user_management_system.password.reset-password-with-token');

    }
);
