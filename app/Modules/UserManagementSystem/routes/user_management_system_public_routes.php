<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Controllers\AuthenticationController;
use Modules\UserManagementSystem\Controllers\ForgotPasswordController;
use Modules\UserManagementSystem\Controllers\OnboardingController;
use Modules\UserManagementSystem\Controllers\ResetPasswordController;
use Modules\UserManagementSystem\Controllers\UserController;


Route::group(
    ['prefix' => config('user_management_system.route_prefix'),],
    function () {
        /*
         * Account Creation
         */
        Route::get(
            'create-account',
            UserController::class . '@createAccountPage'
        )
            ->name('user_management_system.create-account-page');

        Route::post(
            'create-account-submit',
            UserController::class . '@createUserWithVerificationToken',
        )
            ->name('user_management_system.create-account-submit');

        /*
         * Authentication
         */
        Route::post(
            'login/token',
            AuthenticationController::class . '@loginToken',
        )->middleware([
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

        Route::get(
            'login/generated-key',
            AuthenticationController::class . '@loginGeneratedKey',
        )
            ->name('user_management_system.login.generated-key');

        Route::get(
            'check-for-auth-then-redirect-back-with-auth-key',
            AuthenticationController::class . '@checkForAuthThenRedirectBackWithAuthKey',
        )
            ->name('user_management_system.check-for-auth-then-redirect-back-with-auth-key');

        Route::post(
            'password/send-reset-email',
            ForgotPasswordController::class . '@sendResetLinkEmail'
        )
            ->name('user_management_system.password.send-reset-email');

        Route::get(
            'password/password-reset-form',
            ResetPasswordController::class . '@passwordResetForm'
        )
            ->name('user_management_system.password.show-reset-form');

        Route::post(
            'password/reset-password-with-token',
            ResetPasswordController::class . '@resetPasswordWithToken'
        )
            ->name('user_management_system.password.reset-password-with-token');

        Route::get(
            'is-email-unique',
            UserController::class . '@isEmailUnique'
        );
    }
);
