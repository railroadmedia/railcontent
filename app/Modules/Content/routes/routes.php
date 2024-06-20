<?php

use App\Modules\Content\Controllers\ContentMetadataController;
use Illuminate\Support\Facades\Route;

Route::prefix('content')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::get(
            'is_liked_by_user/{content}/{user?}',
            [ContentMetadataController::class, 'isLikedByUser']
        )->name('content.is_liked_by_user');

        Route::get(
            'user_progress/{content}/{user?}',
            [ContentMetadataController::class, 'userProgress']
        )->name('content.user_progress');
    });
