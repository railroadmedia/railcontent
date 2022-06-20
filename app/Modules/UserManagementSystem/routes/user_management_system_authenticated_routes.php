<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Controllers\UserController;
use Modules\UserManagementSystem\Controllers\PasswordController;
use Modules\UserManagementSystem\Controllers\EmailChangeController;
use Modules\UserManagementSystem\Controllers\OnboardingController;


Route::group(
    ['prefix' => config('user_management_system.route_prefix'),],
    function () {
        /*
         * User API
         */
        Route::put(
            'user/store',
            UserController::class . '@store'
        )
            ->name('user_management_system.user.store');

        Route::patch(
            'user/update/{id}',
            UserController::class . '@update'
        )
            ->name('user_management_system.user.update');

        Route::delete(
            'user/delete/{id}',
            UserController::class . '@destroy'
        )
            ->name('user_management_system.user.delete');

        Route::get(
            'user/show/{id}',
            UserController::class . '@read'
        )
            ->name('user_management_system.user.show');

        Route::get(
            'user/index',
            UserController::class . '@index'
        )
            ->name('user_management_system.user.index');

        Route::patch(
            'password/update',
            PasswordController::class . '@update'
        )
            ->name('user_management_system.password.update');

        Route::post(
            'email-change/request',
            EmailChangeController::class . '@request'
        )
            ->name('user_management_system.email-change.request');

        Route::get(
            'email-change/confirm',
            EmailChangeController::class . '@confirm'
        )
            ->name('user_management_system.email-change.confirm');

        /*
          * Onboarding API
          */
        Route::post(
            'onboarding-gears',
            OnboardingController::class . '@updateGears'
        )
            ->name('user_management_system.onboarding.gears');


        Route::get(
            'onboarding-gears',
            OnboardingController::class . '@readGears'
        )
            ->name('user_management_system.onboarding.gears');

    }
);


