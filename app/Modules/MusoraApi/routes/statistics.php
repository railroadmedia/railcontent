<?php

use App\Modules\MusoraApi\Controllers\V5\UserStatisticsController;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::get('/v5/users/statistics', [UserStatisticsController::class, 'index'])
            ->middleware('api_version:v5')
            ->name('v5.users.statistics');
    });
