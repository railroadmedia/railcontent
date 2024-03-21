<?php

use App\Modules\MusoraApi\Controllers\V5\JourneyController;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::post('/v5/journeys/{event}', [JourneyController::class, 'track'])
            ->whereIn('event', array_keys(config('journeys.v5.schema')))
            ->middleware('api_version:v5')
            ->name('v5.journeys');
    });
