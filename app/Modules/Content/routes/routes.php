<?php

use App\Modules\Content\Controllers\ChallengesMetaDataController;
use App\Modules\Content\Controllers\ContentLikesController;
use App\Modules\Content\Controllers\ContentMetadataController;
use App\Modules\Content\Controllers\ContentProgressController;
use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Middleware\DataVersionGetMiddleware;
use App\Modules\DataVersion\Middleware\DataVersionUpdateMiddleware;
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

        Route::get(
            'vimeo-data/{vimeo_id}',
            [ContentMetadataController::class, 'getVimeoData']
        )->name('content.vimeo-data');

        //Content Likes
        Route::get(
            'user/likes/all',
            [ContentLikesController::class, 'all']
        )->name('content.user.likes.all')
            ->middleware(DataVersionGetMiddleware::class . ':' . UserDataVersionKeyEnum::ContentLikes->value);

        Route::post(
            'user/likes/like/{contentId}',
            [ContentLikesController::class, 'like']
        )->name('content.user.like')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentLikes->value);

        Route::post(
            'user/likes/unlike/{contentId}',
            [ContentLikesController::class, 'unLike']
        )->name('content.user.unlike')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentLikes->value);


        //Content Progress
        Route::get(
            'user/progress/all',
            [ContentProgressController::class, 'all']
        )->name('content.user.progress.all')
            ->middleware(DataVersionGetMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

        //Content Progress
        Route::put(
            'user/progress/start',
            [ContentProgressController::class, 'start']
        )->name('content.user.progress.start')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);


        Route::put(
            'user/progress/complete',
            [ContentProgressController::class, 'complete']
        )->name('content.user.progress.complete')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

        Route::put(
            'user/progress/reset',
            [ContentProgressController::class, 'reset']
        )->name('content.user.progress.reset')
            ->middleware(DataVersionUpdateMiddleware::class . ':' . UserDataVersionKeyEnum::ContentProgress->value);

    });

Route::prefix('challenges')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::get(
            'user_progress_for_index_page/get',
            [ChallengesMetaDataController::class, 'getChallengesMetadataForIndexPage']
        )->name('challenges.user_progress_for_index_page');

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

        Route::post(
            'complete_lesson/{id}',
            [ChallengesMetaDataController::class, 'completeLesson']
        )->name('challenges.complete_lesson');
    });

Route::prefix('playlists')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::get(
            'all',
            [\App\Modules\Content\Controllers\PlaylistsMetadataController::class, 'getUserPlaylists']
        )->name('playlists.catalog');

        Route::post('/duplicate/{id}', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@duplicatePlaylist')->name('playlist.duplicate');
        Route::delete('/playlist/{id}', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@deletePlaylistWithItems')->name('playlist.delete');
        Route::put('/playlist/{id}', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@updatePlaylist')->name('playlist.update');
        Route::post('/playlist', \App\Modules\Content\Controllers\PlaylistsMetadataController::class  . '@createPlaylist')->name('playlist.create');
        Route::put('/like', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@likePlaylist')->name('playlist.like');
        Route::delete('/like', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@deletePlaylistLike')->name('playlist.delete.like');
        Route::get('/playlist/{id}', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@getPlaylist')->name('playlist.fetch');
        Route::get('/playlist-lessons', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@getPlaylistItems')->name('playlist.items');
        Route::post('/item', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@updatePlaylistItem')->name('playlist.item.update');
        Route::delete('/item', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@removeItemFromPlaylist')->name('playlist.item.remove');
        Route::get('/item/{id}', \App\Modules\Content\Controllers\PlaylistsMetadataController::class . '@getPlaylistItem')->name('playlist.item');

    });
