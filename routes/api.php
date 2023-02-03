<?php

use Illuminate\Support\Facades\Route;
use Railroad\Railcontent\Controllers\CommentJsonController;
use Railroad\Railcontent\Controllers\CommentLikeJsonController;
use Railroad\Railcontent\Controllers\ContentFieldJsonController;
use Railroad\Railcontent\Controllers\ContentJsonController;
use Railroad\Railcontent\Controllers\ContentLikeJsonController;
use Railroad\Railcontent\Controllers\ContentProgressJsonController;
use Railroad\Railcontent\Controllers\FullTextSearchJsonController;
use Railroad\Railcontent\Controllers\PermissionJsonController;
use Railroad\Railcontent\Controllers\MyListJsonController;
use Railroad\Railcontent\Controllers\ApiJsonController;
use Railroad\Railcontent\Services\ConfigService;

Route::group(
    [
        'prefix' => 'api/railcontent',
        'middleware' => ConfigService::$apiMiddleware,
    ],
    function () {
        // content fields
        Route::get(
            '/content/field/{id}',
            ContentFieldJsonController::class . '@show'
        )
            ->name('api.content.field.show');
        // permissions
        Route::get(
            '/permission',
            PermissionJsonController::class . '@index'
        )
            ->name('api.permissions.index');
        // content
        Route::options(
            '/content',
            ContentJsonController::class . '@options'
        )
            ->name('api.content.options');
        Route::get(
            '/content',
            ContentJsonController::class . '@index'
        )
            ->name('api.content.index');
        Route::get(
            '/content/parent/{parentId}',
            ContentJsonController::class . '@getByParentId'
        )
            ->name('api.content.get-by-parent-id');
        Route::get(
            '/content/get-by-ids',
            ContentJsonController::class . '@getByIds'
        )
            ->name('api.content.get-by-ids');
//        Route::get(
//            '/content/{id}',
//            ContentJsonController::class . '@show'
//        )
//            ->name('api.content.show');
        // content user progression
        Route::put(
            '/start',
            ContentProgressJsonController::class . '@startContent'
        )
            ->name('api.content.progress.start');
        Route::put(
            '/complete',
            ContentProgressJsonController::class . '@completeContent'
        )
            ->name('api.content.progress.complete');
        Route::put(
            '/reset',
            ContentProgressJsonController::class . '@resetContent'
        )
            ->name('api.content.progress.reset');
        Route::put(
            '/progress',
            ContentProgressJsonController::class . '@saveProgress'
        )
            ->name('api.content.progress.store');
        //comments
        Route::put(
            '/comment',
            CommentJsonController::class . '@store'
        )
            ->name('api.comment.store');
        Route::patch(
            '/comment/{id}',
            CommentJsonController::class . '@update'
        )
            ->name('api.comment.update');
        Route::delete(
            '/comment/{id}',
            CommentJsonController::class . '@delete'
        )
            ->name('api.comment.delete');
        Route::put(
            '/comment/reply',
            CommentJsonController::class . '@reply'
        )
            ->name('api.comment.reply');
        Route::get(
            '/comment',
            CommentJsonController::class . '@index'
        )
            ->name('api.comment.index');
        Route::get(
            '/comment/{id}',
            CommentJsonController::class . '@getLinkedComment'
        )
            ->name('api.comment.linked');
        //comment-likes
        Route::get(
            '/comment-likes/{commentId}',
            CommentLikeJsonController::class . '@index'
        )
            ->name('api.comment-likes.index');
        Route::put(
            '/comment-like/{id}',
            CommentLikeJsonController::class . '@store'
        )
            ->name('api.comment-like.store');
        Route::delete(
            '/comment-like/{id}',
            CommentLikeJsonController::class . '@delete'
        )
            ->name('api.comment-like.delete');
        // content-likes
        Route::get(
            '/content-like/{id}',
            ContentLikeJsonController::class . '@index'
        )
            ->name('api.content-likes.index');
        Route::put(
            '/content-like',
            ContentLikeJsonController::class . '@like'
        )
            ->name('api.content-like.store');
        Route::delete(
            '/content-like',
            ContentLikeJsonController::class . '@unlike'
        )
            ->name('api.content-like.delete');
        //full text search
        Route::get(
            '/search',
            FullTextSearchJsonController::class . '@index'
        )
            ->name('api.search.index');

        Route::get('/all', ContentJsonController::class . '@getAllContent');
        Route::get(
            '/in-progress',
            ContentJsonController::class . '@getInProgressContent'
        );
        Route::get(
            '/our-picks',
            ContentJsonController::class . '@getOurPicksContent'
        );

        Route::put('/add-to-my-list', MyListJsonController::class . '@addToPrimaryPlaylist');
        Route::put('/remove-from-my-list', MyListJsonController::class . '@removeFromPrimaryPlaylist');
        Route::get('/my-list', MyListJsonController::class . '@getMyLists');

        Route::get('/onboarding', ApiJsonController::class . '@onboarding');

        Route::get('/shows', ApiJsonController::class . '@getShows')->name('api.shows');

        Route::get('/comments', ApiJsonController::class . '@getComments');

        // content follow
        Route::put(
            '/follow',
            Railroad\Railcontent\Controllers\ContentFollowsJsonController::class . '@followContent'
        )->name('api.content.follow');

        Route::put(
            '/unfollow',
            Railroad\Railcontent\Controllers\ContentFollowsJsonController::class . '@unfollowContent'
        )->name('api.content.unfollow');

        Route::get(
            '/followed-content',
            Railroad\Railcontent\Controllers\ContentFollowsJsonController::class . '@getFollowedContent'
        )->name('api.followed.content');

        Route::get(
            '/followed-lessons',
            Railroad\Railcontent\Controllers\ContentFollowsJsonController::class . '@getLatestLessonsForFollowedContentByType'
        )->name('api.followed.lessons');

        Route::post(
            '/request-song',
            Railroad\Railcontent\Controllers\RequestedSongsJsonController::class . '@requestSong'
        )->name('api.request.song');

        /**
         * Playlists v2 routes
         */
        Route::post('/playlist', MyListJsonController::class . '@createPlaylist')->name('api.create.playlist');
        Route::get('/playlists', MyListJsonController::class . '@getUserPlaylists')->name('api.user.playlists');
        Route::get('/playlist', MyListJsonController::class . '@getPlaylist')->name('api.playlist.show');
        Route::put('/copy-playlist', MyListJsonController::class . '@copyPlaylist')->name('api.copy.playlist');
        Route::patch('/playlist/{id}',MyListJsonController::class . '@updatePlaylist')->name('api.update.playlist');
        Route::get('/public-playlists', MyListJsonController::class . '@getPublicPlaylists')->name('api.public.playlists');
        Route::put('/add-item-to-list', MyListJsonController::class . '@addItemToPlaylist')->name('api.add.item.to.playlist');
        Route::put('/pin-playlist',MyListJsonController::class . '@pinPlaylist')->name('api.pin.playlist');
        Route::get('/my-pinned-playlists', MyListJsonController::class . '@getPinnedPlaylists')->name('api.pinned.playlists');
        Route::put('/unpin-playlist',MyListJsonController::class . '@unpinPlaylist')->name('api.unpin.playlist');
        Route::put('/like-playlist',MyListJsonController::class . '@likePlaylist')->name('api.like.playlist');
        Route::delete('/like-playlist',MyListJsonController::class . '@deletePlaylistLike')->name('api.delete.playlist.like');
        Route::get('/liked-playlists', MyListJsonController::class . '@getLikedPlaylists')->name('user.liked.playlists');
        Route::get('/playlist-lessons', MyListJsonController::class . '@getPlaylistLessons')->name('api.playlist.lessons');
        Route::put('/change-playlist-content', MyListJsonController::class . '@changePlaylistContent')->name('api.change.playlist.item');
        Route::get('/lessons-and-assignments-count/{contentId}', ContentJsonController::class . '@countLessonsAndAssignments')->name('api.count.lessons.and.assignments');
        Route::delete('/playlist',MyListJsonController::class . '@deletePlaylist')->name('api.delete.playlist');
        Route::get('/search-playlist',MyListJsonController::class . '@searchPlaylist')->name('api.search.playlist');
        Route::delete('/remove-item-from-list', MyListJsonController::class . '@removeItemFromPlaylist')->name('api.remove.playlist.item');
        Route::post('/upload-playlist-thumb',MyListJsonController::class . '@uploadPlaylistThumbnail');
    }
);
