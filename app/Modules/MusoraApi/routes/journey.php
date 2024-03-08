<?php

use App\Modules\MusoraApi\Controllers\V5\EventTrackingController;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::post('/v5/journeys/{event}', [EventTrackingController::class, 'track'])
            ->whereIn('event', config('journeys.v5'))
            ->middleware('api_version:v5')
            ->name('v5.journeys');
    });
