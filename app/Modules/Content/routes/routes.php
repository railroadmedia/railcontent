<?php

use App\Modules\Content\Controllers\ChallengesMetaDataController;
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
            'user_data_permissions',
            [ContentMetadataController::class, 'getUserPermissions']
        )->name('content.user-permissions');



    });

Route::prefix('challenges')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::get(
            '{id}',
            [ChallengesMetaDataController::class, 'getChallengeMetadata']
        )->name('challenges.metadata');

        Route::get(
            'lessons/{id}',
            [ChallengesMetaDataController::class, 'getChallengeLessons']
        )->name('challenges.lessons');

        Route::get(
            'user_data/{id}',
            [ChallengesMetaDataController::class, 'getUserChallengeProgress']
        )->name('challenges.user_progress');

        Route::get(
            'download_award/{id}',
            [ChallengesMetaDataController::class, 'getUserAward']
        )->name('challenges.user_award');

        Route::post(
            'enroll/{id}',
            [ChallengesMetaDataController::class, 'enrollUser']
        )->name('challenges.enroll');

        Route::post(
            'set_start_date/{id}',
            [ChallengesMetaDataController::class, 'setStartDate']
        )->name('challenges.set_start_date');

        Route::post(
            'leave/{id}',
            [ChallengesMetaDataController::class, 'leaveChallenge']
        )->name('challenges.leave');

        Route::post(
            'unlock/{id}',
            [ChallengesMetaDataController::class, 'unlockChallenge']
        )->name('challenges.unlock');

        Route::post(
            'notifications/enrollment_open/{id}',
            [ChallengesMetaDataController::class, 'notificationsEnrollmentOpen']
        )->name('challenges.notifications.enroll');

        Route::post(
            'notifications/community_reminders/{id}',
            [ChallengesMetaDataController::class, 'notificationsCommunityReminders']
        )->name('challenges.notifications.community_reminders');
    });

Route::prefix('playlists')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::get(
            'all',
            [\App\Modules\Content\Controllers\PlaylistsMetadataController::class, 'getUserPlaylists']
        )->name('playlists.catalog');

        Route::post('/duplicate/{id}', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@duplicatePlaylist')->name('playlist.duplicate');
        Route::delete('/playlist',\App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@deletePlaylistWithItems')->name('playlist.delete');
        Route::put('/playlist/{id}', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@updatePlaylist')->name('playlist.update');
        Route::post('/playlist', \App\Modules\Content\Controllers\PlaylistsMetadataController::class  . '@createPlaylist')->name('playlist.create');
        Route::put('/like', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@likePlaylist')->name('playlist.like');
        Route::delete('/like', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@deletePlaylistLike')->name('playlist.delete.like');
        Route::get('/playlist', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@getPlaylist')->name('playlist.fetch');
        Route::get('/playlist-lessons', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@getPlaylistItems')->name('playlist.items');
        //
    });
