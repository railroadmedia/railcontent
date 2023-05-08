<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'customer-io',
        'middleware' => config('customer-io.all_routes_middleware'),
    ],
    function () {
        Route::post(
            '/submit-email-form',
            \App\Modules\CustomerIO\Controllers\CustomerIoController::class.'@submitEmailForm'
        )
            ->name('customer-io.submit-email-form');
        Route::post(
            '/submit-email-form-rc',
            \App\Modules\CustomerIO\Controllers\CustomerIoController::class.'@submitEmailFormRC'
        )
            ->name('customer-io.submit-email-form-rc');
    }
);
