<?php

use App\Modules\DataVersion\Controllers\DataVersionController;

Route::prefix('data-version')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::get(
            'get',
            [DataVersionController::class, 'getUserDataVersion']
        )->name('data-version.get');
    });
