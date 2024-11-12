<?php

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Middleware\DataVersionUpdateMiddleware;
use App\Modules\RailTracker\Controllers\MediaPlaybackTrackingJsonControllerV2;
use Illuminate\Support\Facades\Route;
use App\Modules\RailTracker\Controllers\MediaPlaybackTrackingJsonController;

Route::prefix('railtracker')->middleware('web_or_api_authenticated')->group(
    function () {
        Route::put(
            '/media-playback-session/store',
            MediaPlaybackTrackingJsonController::class . '@store'
        )
            ->name('railtracker.media-playback-session.store')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

        Route::post(
            '/media-playback-session',
            MediaPlaybackTrackingJsonController::class . '@store'
        )
            ->name('railtracker.media-playback-session.post')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

        Route::patch(
            '/media-playback-session/update/{sessionId}',
            MediaPlaybackTrackingJsonController::class . '@update'
        )
            ->name('railtracker.media-playback-session.update')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

        Route::get(
            '/last-engaged/store',
            \App\Modules\RailTracker\Controllers\ContentLastEngagedJsonController::class . '@store'
        )
            ->name('railtracker.last-engaged.store')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

        // Version 2
        Route::post(
            '/v2/media-playback-session/',
            MediaPlaybackTrackingJsonControllerV2::class . '@store'
        )
            ->name('railtracker.v2.media-playback-session.store')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);


    }
);
