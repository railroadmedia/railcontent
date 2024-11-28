<?php

use App\Modules\MusoraApi\Controllers\V1\LearningController as LearningControllerV1;
use App\Modules\MusoraApi\Controllers\V2\LearningControllerV2;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::post(
            '/v1/trial-section-dismiss',
            [LearningControllerV1::class, 'hideLearningPaths']
        )
            ->middleware('api_version:v1')
            ->name('v1.learning.paths.dismiss');

        Route::group(['prefix' => '/v2'], function () {
            Route::get('/homepage-learning-paths', [LearningControllerV2::class, 'getLearningPaths'])
                ->middleware('api_version:v2')
                ->name('homepage.learning-paths');
        });
    });
