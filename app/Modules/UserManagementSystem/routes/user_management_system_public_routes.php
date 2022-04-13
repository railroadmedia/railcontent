<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Controllers\AuthenticationController;

Route::group(
    ['prefix' => config('user_management_system.route_prefix'),],
    function () {
        /*
         * Authentication
         */
        Route::post(
            'login/token',
            AuthenticationController::class . '@loginToken'
        )
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
    }
);
