<?php

use App\Modules\MusoraApi\Controllers\V1\LearningController;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::post(
            '/v1/trial-section-dismiss',
            [LearningController::class, 'hideLearningPaths']
        )
            ->middleware('api_version:v1')
            ->name('v1.learning.paths.dismiss');
    });
