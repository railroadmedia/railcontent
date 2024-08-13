<?php

use App\Modules\MusoraApi\Controllers\V1\LearningController as LearningControllerV1;
use App\Modules\MusoraApi\Controllers\V2\LearningController as LearningControllerV2;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::group(['prefix' => '/v1'], function () {
            Route::post('/trial-section-dismiss', [LearningControllerV1::class, 'hideLearningPaths'])
                ->name('learning.paths.dismiss');
        });
        Route::group(['prefix' => '/v2'], function () {
            Route::get('/homepage-learning-paths', [LearningControllerV2::class, 'getLearningPaths'])
                ->name('homepage.learning-paths');
        });
    });
