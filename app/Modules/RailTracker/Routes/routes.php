<?php

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Middleware\DataVersionUpdateMiddleware;
use Illuminate\Support\Facades\Route;
use App\Modules\RailTracker\Controllers\MediaPlaybackTrackingJsonController;

Route::group(
    [
        'middleware' => config('railtracker.route_middleware_logged_in_groups'),
    ],
    function () {
        Route::put(
            '/railtracker/media-playback-session/store',
            MediaPlaybackTrackingJsonController::class . '@store'
        )
            ->name('railtracker.media-playback-session.store')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

        Route::post(
            '/railtracker/media-playback-session',
            MediaPlaybackTrackingJsonController::class . '@store'
        )
            ->name('railtracker.media-playback-session.post')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

        Route::patch(
            '/railtracker/media-playback-session/update/{sessionId}',
            MediaPlaybackTrackingJsonController::class . '@update'
        )
            ->name('railtracker.media-playback-session.update')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

        Route::get(
            '/railtracker/last-engaged/store',
            \App\Modules\RailTracker\Controllers\ContentLastEngagedJsonController::class . '@store'
        )
            ->name('railtracker.last-engaged.store')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);
    }
);
