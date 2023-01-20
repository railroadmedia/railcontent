<?php

use Illuminate\Support\Facades\Route;
use Railroad\Railcontent\Controllers\MyListJsonController;

Route::group(
    [
        'prefix' => 'railcontent',
        'middleware' => config('railcontent.all_routes_middleware')
    ],
    function () {

        Route::group(
            [
                'middleware' => config('railcontent.user_routes_middleware')
            ],
            function () {

                // content fields
                Route::get(
                    '/content/field/{id}',
                    \Railroad\Railcontent\Controllers\ContentFieldJsonController::class . '@show'
                )->name('content.field.show');

                // permissions
                Route::get(
                    '/permission',
                    \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@index'
                )->name('permissions.index');

                // content
                Route::options(
                    '/content',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@options'
                )->name('content.options');

                Route::get(
                    '/content',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@index'
                )->name('content.index');

                Route::get(
                    '/content/parent/{parentId}',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@getByParentId'
                )->name('content.get-by-parent-id');

                Route::get(
                    '/content/child/{childId}/{type}',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@getByChildIdWhereType'
                )->name('content.get-by-child-id');

                Route::get(
                    '/content/get-by-ids',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@getByIds'
                )->name('content.get-by-ids');

                Route::get(
                    '/content/{id}',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@show'
                )->name('content.show');

                // content statistics
                Route::get(
                    '/content-statistics/individual/{id}',
                    \Railroad\Railcontent\Controllers\ContentStatisticsJsonController::class . '@individualContentStatistics'
                )->name('content.statistics.individual');

                Route::get(
                    '/content-statistics',
                    \Railroad\Railcontent\Controllers\ContentStatisticsJsonController::class . '@contentStatistics'
                )->name('content.statistics.all');

                Route::get(
                    '/content-statistics/field-filters-values',
                    \Railroad\Railcontent\Controllers\ContentStatisticsJsonController::class . '@fieldFiltersValues'
                )->name('content.statistics.field-filters-values');

                // content user progression
                Route::put(
                    '/start',
                    Railroad\Railcontent\Controllers\ContentProgressJsonController::class . '@startContent'
                )->name('content.progress.start');

                Route::put(
                    '/complete',
                    Railroad\Railcontent\Controllers\ContentProgressJsonController::class . '@completeContent'
                )->name('content.progress.complete');

                Route::put(
                    '/reset',
                    Railroad\Railcontent\Controllers\ContentProgressJsonController::class . '@resetContent'
                )->name('content.progress.reset');

                Route::put(
                    '/progress',
                    Railroad\Railcontent\Controllers\ContentProgressJsonController::class . '@saveProgress'
                )->name('content.progress.store');

                //comments
                Route::put(
                    '/comment',
                    \Railroad\Railcontent\Controllers\CommentJsonController::class . '@store'
                )->name('comment.store');

                Route::patch(
                    '/comment/{id}',
                    \Railroad\Railcontent\Controllers\CommentJsonController::class . '@update'
                )->name('comment.update');

                Route::delete(
                    '/comment/{id}',
                    \Railroad\Railcontent\Controllers\CommentJsonController::class . '@delete'
                )->name('comment.delete');

                Route::put(
                    '/comment/reply',
                    \Railroad\Railcontent\Controllers\CommentJsonController::class . '@reply'
                )->name('comment.reply');

                Route::get(
                    '/comment',
                    \Railroad\Railcontent\Controllers\CommentJsonController::class . '@index'
                )->name('comment.index');

                Route::get(
                    '/comment/{id}',
                    \Railroad\Railcontent\Controllers\CommentJsonController::class . '@getLinkedComment'
                )->name('comment.linked');

                //comment-likes
                Route::get(
                    '/comment-likes/{commentId}',
                    \Railroad\Railcontent\Controllers\CommentLikeJsonController::class . '@index'
                )->name('comment-likes.index');

                Route::put(
                    '/comment-like/{id}',
                    \Railroad\Railcontent\Controllers\CommentLikeJsonController::class . '@store'
                )->name('comment-like.store');

                Route::delete(
                    '/comment-like/{id}',
                    \Railroad\Railcontent\Controllers\CommentLikeJsonController::class . '@delete'
                )->name('comment-like.delete');

                // content-likes
                Route::get(
                    '/content-like/{id}',
                    \Railroad\Railcontent\Controllers\ContentLikeJsonController::class . '@index'
                )->name('content-likes.index');

                Route::put(
                    '/content-like',
                    \Railroad\Railcontent\Controllers\ContentLikeJsonController::class . '@like'
                )->name('content-like.store');

                Route::delete(
                    '/content-like',
                    \Railroad\Railcontent\Controllers\ContentLikeJsonController::class . '@unlike'
                )->name('content-like.delete');


                //full text search
                Route::get(
                    '/search',
                    \Railroad\Railcontent\Controllers\FullTextSearchJsonController::class . '@index'
                )->name('search.index');
                
                // vimeo endpoints
                Route::get(
                    '/vimeo-video/{vimeoVideoId}',
                    \Railroad\Railcontent\Controllers\VimeoJsonController::class . '@show'
                )->name('vimeo-video.show');

                // content follow
                Route::put(
                    '/follow',
                    Railroad\Railcontent\Controllers\ContentFollowsJsonController::class . '@followContent'
                )->name('content.follow');

                Route::put(
                    '/unfollow',
                    Railroad\Railcontent\Controllers\ContentFollowsJsonController::class . '@unfollowContent'
                )->name('content.unfollow');

                Route::get(
                    '/followed-content',
                    Railroad\Railcontent\Controllers\ContentFollowsJsonController::class . '@getFollowedContent'
                )->name('followed.content');

                Route::get(
                    '/followed-lessons',
                    Railroad\Railcontent\Controllers\ContentFollowsJsonController::class . '@getLatestLessonsForFollowedContentByType'
                )->name('followed.lessons');

                Route::post('/add-to-primary-playlist', \Railroad\Railcontent\Controllers\MyListJsonController::class . '@addToPrimaryPlaylist');
                Route::post('/remove-from-primary-playlist', \Railroad\Railcontent\Controllers\MyListJsonController::class . '@removeFromPrimaryPlaylist');
                Route::post(
                    '/request-song',
                    Railroad\Railcontent\Controllers\RequestedSongsJsonController::class . '@requestSong'
                )->name('request.song');

                /**
                 * Playlists v2 Routes
                 */
                Route::post('/playlist', MyListJsonController::class . '@createPlaylist')->name('create.playlist');
                Route::get('/playlists', MyListJsonController::class . '@getUserPlaylists')->name('user.playlists');
                Route::get('/playlist', MyListJsonController::class . '@getPlaylist')->name('show.playlist');
                Route::put('/copy-playlist', MyListJsonController::class . '@copyPlaylist')->name('copy.playlist');
                Route::patch('/playlist/{id}', MyListJsonController::class . '@updatePlaylist')->name('update.playlist');
                Route::get('/public-playlists', MyListJsonController::class . '@getPublicPlaylists')->name('public.playlists');
                Route::put('/add-item-to-list', MyListJsonController::class . '@addItemToPlaylist')->name('add.item.to.playlist');
                Route::put('/pin-playlist',MyListJsonController::class . '@pinPlaylist')->name('pin.playlist');
                Route::get('/my-pinned-playlists', MyListJsonController::class . '@getPinnedPlaylists')->name('my.pinned.playlists');
                Route::put('/unpin-playlist',MyListJsonController::class . '@unpinPlaylist')->name('unpin.playlist');
                Route::put('/like-playlist', MyListJsonController::class . '@likePlaylist')->name('like.playlist');
                Route::get('/playlist-lessons', MyListJsonController::class . '@getPlaylistLessons')->name('playlist.items');
                Route::put('/change-playlist-content', MyListJsonController::class . '@changePlaylistContent')->name('update.playlist.item');
                Route::get('/lessons-and-assignments-count/{contentId}', \Railroad\Railcontent\Controllers\ContentJsonController::class . '@countLessonsAndAssignments')->name('content.assignments.count');
            }
        );

        Route::group(
            [
                'middleware' => config('railcontent.administrator_routes_middleware')
            ],
            function () {
                // content fields
                Route::put(
                    '/content/field',
                    \Railroad\Railcontent\Controllers\ContentFieldJsonController::class . '@store'
                )->name('content.field.store');

                Route::patch(
                    '/content/field/{fieldId}',
                    \Railroad\Railcontent\Controllers\ContentFieldJsonController::class . '@update'
                )->name('content.field.update');

                Route::delete(
                    '/content/field/{fieldId}',
                    \Railroad\Railcontent\Controllers\ContentFieldJsonController::class . '@delete'
                )->name('content.field.delete');

                // content datum
                Route::put(
                    '/content/datum',
                    \Railroad\Railcontent\Controllers\ContentDatumJsonController::class . '@store'
                )->name('content.data.store');

                Route::patch(
                    '/content/datum/{datumId}',
                    \Railroad\Railcontent\Controllers\ContentDatumJsonController::class . '@update'
                )->name('content.data.update');

                Route::delete(
                    '/content/datum/{datumId}',
                    \Railroad\Railcontent\Controllers\ContentDatumJsonController::class . '@delete'
                )->name('content.data.delete');

                // permissions
                Route::put(
                    '/permission',
                    \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@store'
                )->name('permissions.store');

                Route::patch(
                    '/permission/dissociate',
                    \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@dissociate'
                )->name('permissions.dissociate');

                Route::patch(
                    '/permission/{permissionId}',
                    \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@update'
                )->name('permissions.update');

                Route::delete(
                    '/permission/{permissionId}',
                    \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@delete'
                )->name('permissions.delete');

                Route::put(
                    '/permission/assign',
                    \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@assign'
                )->name('permissions.assign');

                // content hierarchy
                Route::put(
                    '/content/hierarchy',
                    \Railroad\Railcontent\Controllers\ContentHierarchyJsonController::class . '@store'
                )->name('content.hierarchy.store');

                Route::patch(
                    '/content/hierarchy/{parentId}/{childId}',
                    \Railroad\Railcontent\Controllers\ContentHierarchyJsonController::class . '@update'
                )->name('content.hierarchy.update');

                Route::delete(
                    '/content/hierarchy/{parentId}/{childId}',
                    \Railroad\Railcontent\Controllers\ContentHierarchyJsonController::class . '@delete'
                )->name('content.hierarchy.delete');

                // content
                Route::options(
                    '/content',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@options'
                )->name('content.options');

                Route::put(
                    '/content',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@store'
                )->name('content.store');

                Route::patch(
                    '/content/{id}',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@update'
                )->name('content.update');

                Route::delete(
                    '/content/{id}',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@delete'
                )->name('content.delete');

                Route::delete(
                    '/soft/content/{id}',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@softDelete'
                )->name('content.softdelete');

                // remote storage
                Route::put(
                    '/remote',
                    Railroad\Railcontent\Controllers\RemoteStorageJsonController::class . '@put'
                )->name('remote.put');

                //comments
                Route::get(
                    '/assigned-comments',
                    \Railroad\Railcontent\Controllers\CommentAssignationJsonController::class . '@index'
                )->name('comment.assigned-to-me');

                Route::delete(
                    '/assigned-comment/{commentId}',
                    \Railroad\Railcontent\Controllers\CommentAssignationJsonController::class . '@delete'
                )->name('comment.assignation-delete');

                //user permission
                Route::put(
                    '/user-permission',
                    \Railroad\Railcontent\Controllers\UserPermissionsJsonController::class . '@store'
                )->name('user.permissions.store');

                Route::patch(
                    '/user-permission/{id}',
                    \Railroad\Railcontent\Controllers\UserPermissionsJsonController::class . '@store'
                )->name('user.permissions.update');

                Route::delete(
                    '/user-permission/{userPermissionId}',
                    \Railroad\Railcontent\Controllers\UserPermissionsJsonController::class . '@delete'
                )->name('user.permissions.delete');

                Route::get(
                    '/user-permission',
                    \Railroad\Railcontent\Controllers\UserPermissionsJsonController::class . '@index'
                )->name('user.permissions.index');

                //new routes for additional tables
                // bpm
                Route::put(
                    '/content/bpm',
                    \Railroad\Railcontent\Controllers\ContentBpmJsonController::class . '@store'
                )->name('content.bpm.store');

                Route::patch(
                    '/content/bpm/{bpmId}',
                    \Railroad\Railcontent\Controllers\ContentBpmJsonController::class . '@update'
                )->name('content.bpm.update');

                Route::delete(
                    '/content/bpm/{bpmId}',
                    \Railroad\Railcontent\Controllers\ContentBpmJsonController::class . '@delete'
                )->name('content.bpm.delete');

                // focus
                Route::put(
                    '/content/focus',
                    \Railroad\Railcontent\Controllers\ContentFocusJsonController::class . '@store'
                )->name('content.focus.store');

                Route::patch(
                    '/content/focus/{focusId}',
                    \Railroad\Railcontent\Controllers\ContentFocusJsonController::class . '@update'
                )->name('content.focus.update');

                Route::delete(
                    '/content/focus/{focusId}',
                    \Railroad\Railcontent\Controllers\ContentFocusJsonController::class . '@delete'
                )->name('content.focus.delete');

                // key
                Route::put(
                    '/content/key',
                    \Railroad\Railcontent\Controllers\ContentKeyJsonController::class . '@store'
                )->name('content.key.store');

                Route::patch(
                    '/content/key/{keyId}',
                    \Railroad\Railcontent\Controllers\ContentKeyJsonController::class . '@update'
                )->name('content.key.update');

                Route::delete(
                    '/content/key/{keyId}',
                    \Railroad\Railcontent\Controllers\ContentKeyJsonController::class . '@delete'
                )->name('content.key.delete');

                // key pitch type
                Route::put(
                    '/content/key-pitch-type',
                    \Railroad\Railcontent\Controllers\ContentKeyPitchTypeJsonController::class . '@store'
                )->name('content.key-pitch-type.store');

                Route::patch(
                    '/content/key-pitch-type/{keyPitchTypeId}',
                    \Railroad\Railcontent\Controllers\ContentKeyPitchTypeJsonController::class . '@update'
                )->name('content.key-pitch-type.update');

                Route::delete(
                    '/content/key-pitch-type/{keyPitchTypeId}',
                    \Railroad\Railcontent\Controllers\ContentKeyPitchTypeJsonController::class . '@delete'
                )->name('content.key-pitch-type.delete');

                // style
                Route::put(
                    '/content/style',
                    \Railroad\Railcontent\Controllers\ContentStyleJsonController::class . '@store'
                )->name('content.style.store');

                Route::patch(
                    '/content/style/{styleId}',
                    \Railroad\Railcontent\Controllers\ContentStyleJsonController::class . '@update'
                )->name('content.style.update');

                Route::delete(
                    '/content/style/{styleId}',
                    \Railroad\Railcontent\Controllers\ContentStyleJsonController::class . '@delete'
                )->name('content.style.delete');

                // tag
                Route::put(
                    '/content/tag',
                    \Railroad\Railcontent\Controllers\ContentTagJsonController::class . '@store'
                )->name('content.tag.store');

                Route::patch(
                    '/content/tag/{tagId}',
                    \Railroad\Railcontent\Controllers\ContentTagJsonController::class . '@update'
                )->name('content.tag.update');

                Route::delete(
                    '/content/tag/{tagId}',
                    \Railroad\Railcontent\Controllers\ContentTagJsonController::class . '@delete'
                )->name('content.tag.delete');

                // topic
                Route::put(
                    '/content/topic',
                    \Railroad\Railcontent\Controllers\ContentTopicJsonController::class . '@store'
                )->name('content.topic.store');

                Route::patch(
                    '/content/topic/{topicId}',
                    \Railroad\Railcontent\Controllers\ContentTopicJsonController::class . '@update'
                )->name('content.topic.update');

                Route::delete(
                    '/content/topic/{topicId}',
                    \Railroad\Railcontent\Controllers\ContentTopicJsonController::class . '@delete'
                )->name('content.topic.delete');

                // instructor
                Route::put(
                    '/content/instructor',
                    \Railroad\Railcontent\Controllers\ContentInstructorJsonController::class . '@store'
                )->name('content.instructor.store');

                Route::patch(
                    '/content/instructor/{instructorId}',
                    \Railroad\Railcontent\Controllers\ContentInstructorJsonController::class . '@update'
                )->name('content.instructor.update');

                Route::delete(
                    '/content/instructor/{instructorId}',
                    \Railroad\Railcontent\Controllers\ContentInstructorJsonController::class . '@delete'
                )->name('content.instructor.delete');
            }
        );
    }
);