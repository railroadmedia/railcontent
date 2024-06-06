<?php

use App\Modules\Content\Controllers\SanityStudioCMSController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware(['web_authenticated', 'web_authenticated_admin'])
    ->group(function () {
        Route::any(
            '/studio{any}',
            [SanityStudioCMSController::class, 'renderStudio']
        )->where('any', '.*')
            ->name('admin.studio');
        Route::get(
            '/soundslice',
            [SanityStudioCMSController::class, 'getSoundsliceData']
        )
            ->name('admin.soundslice');
    });

Route::get(
    '/CustomInput.js',
    [SanityStudioCMSController::class, 'customInput']
)
    ->name('sanity.customInput-file');
