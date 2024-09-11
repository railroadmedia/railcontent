<?php

use App\Modules\Content\Controllers\ContentMetadataController;
use Illuminate\Support\Facades\Route;

Route::prefix('content')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::get(
            'is_liked_by_user/{user?}',
            [ContentMetadataController::class, 'isLikedByUser']
        )->name('content.is_liked_by_user');

        Route::get(
            'user_progress/{user?}',
            [ContentMetadataController::class, 'userProgress']
        )->name('content.user_progress');

        Route::get(
            'in_progress/{user?}',
            [ContentMetadataController::class, 'inProgressForUser']
        )->name('content.in_progress');

        Route::get(
            'completed/{user?}',
            [ContentMetadataController::class, 'completedByUser']
        )->name('content.completed');

        Route::get(
            '{contentId}/user_data/{user?}',
            [ContentMetadataController::class, 'getContentPageUserData']
        )->name('content.user_data');

        Route::get(
            'vimeo-data/{vimeo_id}',
            [ContentMetadataController::class, 'getVimeoData']
        )->name('content.vimeo-data');
    });
