<?php

use App\Http\Controllers\Platform\AdminController;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->prefix('admin')
    ->middleware(['web_authenticated', 'web_authenticated_admin'])
    ->group(function () {
        Route::get('/vimeo-data', [AdminController::class, 'vimeoData'])
            ->whereIn('brand', all_brands())
            ->name('admin.vimeo-data');
    });


Route::domain('{musoraDomain}')
    ->middleware(['web_authenticated', 'web_authenticated_admin'])
    ->any('/admin/studio{any}', [\App\Http\Controllers\Misc\SanityStudioCMSController::class, 'renderStudio'])
    ->where('any', '.*')
    ->name('admin.studio');
