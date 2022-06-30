<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Controllers\EmailChangeController;
use Modules\UserManagementSystem\Controllers\OnboardingController;
use Modules\UserManagementSystem\Controllers\PasswordController;
use Modules\UserManagementSystem\Controllers\UserController;


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
            OnboardingController::class . '@gears'
        )
            ->name('user_management_system.onboarding.gears');

        Route::post(
            'onboarding-topics',
            OnboardingController::class . '@topics'
        )
            ->name('user_management_system.onboarding.topics');

        Route::post(
            'onboarding-genres',
            OnboardingController::class . '@genres'
        )
            ->name('user_management_system.onboarding.genres');

        Route::post(
            'onboarding-experience',
            OnboardingController::class . '@experience'
        )
            ->name('user_management_system.onboarding.experience');
        Route::match(
            ['post', 'put'],
            'profile-picture/upload',
            [
                'as' => 'user_management_system.profile-picture.upload',
                'uses' => \Modules\UserManagementSystem\Controllers\ProfilePictureUploadController::class . '@upload',
            ]
        );

        Route::match(
            ['post', 'put'],
            'profile-picture/upload-from-s3-front-end',
            [
                'as' => 'user_management_system.profile-picture.upload-from-s3-front-end',
                'uses' => \Modules\UserManagementSystem\Controllers\ProfilePictureUploadController::class . '@uploadFromS3FrontEnd',
            ]
        );
    }
);


