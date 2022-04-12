<?php

use Illuminate\Support\Facades\Route;
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
            UserController::class . '@delete'
        )
            ->name('user_management_system.user.delete');
    }
);
