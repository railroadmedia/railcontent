<?php

use Illuminate\Support\Facades\Route;

/*
 * Public Routes
 */
Route::group(
    [
        'prefix' => config('user_management_system.route_prefix'),
        'middleware' => config('user_management_system.route_middleware_public_groups'),
    ],
    function () {
        /*
         * Login
         */
        Route::post(
            'login',
            AuthenticationController::class . '@login'
        )
            ->name('user_management_system.login');

        /*
         * Password Management
         */
        Route::post(
            'password/send-reset-email',
            \Railroad\Usora\Controllers\ForgotPasswordController::class . '@sendResetLinkEmail'
        )
            ->name('user_management_system.password.send-reset-email');

        Route::post(
            'password/reset',
            \Railroad\Usora\Controllers\ResetPasswordController::class . '@reset'
        )
            ->name('user_management_system.password.reset');

        /*
         * User Creation Validation Checks
         */
        Route::get(
            'is-email-unique',
            ApiController::class . '@isEmailUnique'
        )
            ->name('user_management_system.is-email-unique');

        Route::get(
            'is-display-name-unique',
            ApiController::class . '@isDisplayNameUnique'
        )
            ->name('user_management_system.is-display-name-unique');
    }
);

/*
 * Authenticated Routes
 */
Route::group(
    [
        'prefix' => config('user_management_system.route_prefix'),
        'middleware' => config('user_management_system.route_middleware_logged_in_groups'),
    ],
    function () {
        /*
         * Logout
         */
        Route::get(
            'logout',
            AuthenticationController::class . '@logout'
        )
            ->name('user_management_system.logout');

        /*
         * User API
         */
        Route::patch(
            'user/update-password',
            \Railroad\Usora\Controllers\PasswordController::class . '@update'
        )
            ->name('user_management_system.user-password.update');

        Route::post(
            'email-change/request',
            \Railroad\Usora\Controllers\EmailChangeController::class . '@request'
        )
            ->name('user_management_system.email-change.request');

        Route::get(
            'email-change/confirm',
            \Railroad\Usora\Controllers\EmailChangeController::class . '@confirm'
        )
            ->name('user_management_system.email-change.confirm');

        Route::get(
            'json-api/user/index',
            \Railroad\Usora\Controllers\UserJsonController::class . '@index'
        )
            ->name('user_management_system.json-api.user.index');

        Route::get(
            'json-api/user/show/{id}',
            \Railroad\Usora\Controllers\UserJsonController::class . '@show'
        )
            ->name('user_management_system.json-api.user.show');

        Route::put(
            'json-api/user/store',
            \Railroad\Usora\Controllers\UserJsonController::class . '@store'
        )
            ->name('user_management_system.json-api.user.store');

        Route::patch(
            'json-api/user/update/{id}',
            \Railroad\Usora\Controllers\UserJsonController::class . '@update'
        )
            ->name('user_management_system.json-api.user.update');

        Route::delete(
            'json-api/user/delete/{id}',
            \Railroad\Usora\Controllers\UserJsonController::class . '@delete'
        )
            ->name('user_management_system.json-api.user.delete');
    }
);
