<?php

use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->name('platform.')
    ->middleware(['web_authenticated'])
    ->group(function () {
        /*
         * Home Page
         */
        Route::get('/{brand}', [\App\Http\Controllers\Platform\ContentPagesController::class, 'home'])
            ->whereIn('brand', all_brands())
            ->name('home');

        /*
         * Content Pages
         */
        Route::get('/{brand}/courses', [\App\Http\Controllers\Platform\ContentPagesController::class, 'courses'])
            ->whereIn('brand', all_brands())
            ->name('courses');

        /*
         * Users Lists Pages
         */

        /*
         * Forums Pages
         */

        /*
         * Profile Pages
         */
        Route::get(
            '/{brand}/profile/{userId}/dashboard',
            [\App\Http\Controllers\Platform\ContentPagesController::class, 'courses']
        )
            ->whereIn('brand', all_brands())
            ->name('profile.dashboard');
        /*
         * Referral Pages
         */
    });
