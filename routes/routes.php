<?php

use Illuminate\Support\Facades\Route;
use Railroad\Railcontent\Controllers\CommentJsonController;
use Railroad\Railcontent\Controllers\CommentLikeJsonController;
use Railroad\Railcontent\Controllers\ContentDatumJsonController;
use Railroad\Railcontent\Controllers\ContentHierarchyJsonController;
use Railroad\Railcontent\Controllers\ContentJsonController;
use Railroad\Railcontent\Controllers\ContentLikeJsonController;
use Railroad\Railcontent\Controllers\FullTextSearchJsonController;
use Railroad\Railcontent\Controllers\PermissionJsonController;
use Railroad\Railcontent\Controllers\UserPermissionsJsonController;

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
                // permissions
                Route::get(
                    '/permission',
                    PermissionJsonController::class . '@index'
                )->name('permissions.index');

                // content
                Route::options(
                    '/content',
                    ContentJsonController::class . '@options'
                )->name('content.options');

                Route::get(
                    '/content',
                    ContentJsonController::class . '@index'
                )->name('content.index');

                Route::get(
                    '/content/parent/{parentId}',
                    ContentJsonController::class . '@getByParentId'
                )->name('content.get-by-parent-id');

                Route::get(
                    '/content/get-by-ids',
                    ContentJsonController::class . '@getByIds'
                )->name('content.get-by-ids');

                Route::get(
                    '/content/{id}',
                    ContentJsonController::class . '@show'
                )->name('content.show');

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
                    CommentJsonController::class . '@store'
                )->name('comment.store');

                Route::patch(
                    '/comment/{id}',
                    CommentJsonController::class . '@update'
                )->name('comment.update');

                Route::delete(
                    '/comment/{id}',
                    CommentJsonController::class . '@delete'
                )->name('comment.delete');

                Route::put(
                    '/comment/reply',
                    CommentJsonController::class . '@reply'
                )->name('comment.reply');

                Route::get(
                    '/comment',
                    CommentJsonController::class . '@index'
                )->name('comment.index');

                Route::get(
                    '/comment/{id}',
                    CommentJsonController::class . '@getLinkedComment'
                )->name('comment.linked');

                //comment-likes
                Route::put(
                    '/comment-like/{id}',
                    CommentLikeJsonController::class . '@store'
                )->name('comment-like.store');

                Route::delete(
                    '/comment-like/{id}',
                    CommentLikeJsonController::class . '@delete'
                )->name('comment-like.delete');

                // content-likes
                Route::get(
                    '/content-like/{id}',
                    ContentLikeJsonController::class . '@index'
                )->name('content-likes.index');
                Route::put(
                    '/content-like',
                    ContentLikeJsonController::class . '@like'
                )->name('content-like.store');
                Route::delete(
                    '/content-like',
                    ContentLikeJsonController::class . '@unlike'
                )->name('content-like.delete');


                //full text search
                Route::get(
                    '/search',
                    FullTextSearchJsonController::class . '@index'
                )->name('search.index');
            }
        );

        Route::group(
            [
                'middleware' => config('railcontent.administrator_routes_middleware')
            ],
            function () {
                // content datum
                Route::put(
                    '/content/datum',
                    ContentDatumJsonController::class . '@store'
                )->name('content.data.store');

                Route::patch(
                    '/content/datum/{datumId}',
                    ContentDatumJsonController::class . '@update'
                )->name('content.data.update');

                Route::delete(
                    '/content/datum/{datumId}',
                    ContentDatumJsonController::class . '@delete'
                )->name('content.data.delete');

                // permissions
                Route::put(
                    '/permission',
                    PermissionJsonController::class . '@store'
                )->name('permissions.store');

                Route::patch(
                    '/permission/dissociate',
                    PermissionJsonController::class . '@dissociate'
                )->name('permissions.dissociate');

                Route::patch(
                    '/permission/{permissionId}',
                    PermissionJsonController::class . '@update'
                )->name('permissions.update');

                Route::delete(
                    '/permission/{permissionId}',
                    PermissionJsonController::class . '@delete'
                )->name('permissions.delete');

                Route::put(
                    '/permission/assign',
                    PermissionJsonController::class . '@assign'
                )->name('permissions.assign');

                // content hierarchy
                Route::put(
                    '/content/hierarchy',
                    ContentHierarchyJsonController::class . '@store'
                )->name('content.hierarchy.store');

                Route::delete(
                    '/content/hierarchy/{parentId}/{childId}',
                    ContentHierarchyJsonController::class . '@delete'
                )->name('content.hierarchy.delete');

                // content
                Route::options(
                    '/content',
                    ContentJsonController::class . '@options'
                )->name('content.options');

                Route::put(
                    '/content',
                    ContentJsonController::class . '@store'
                )->name('content.store');

                Route::patch(
                    '/content/{id}',
                    ContentJsonController::class . '@update'
                )->name('content.update');

                Route::delete(
                    '/content/{id}',
                    ContentJsonController::class . '@delete'
                )->name('content.delete');

                Route::delete(
                    '/soft/content/{id}',
                    ContentJsonController::class . '@softDelete'
                )->name('content.softdelete');

                // remote storage
                Route::put(
                    '/remote',
                    Railroad\Railcontent\Controllers\RemoteStorageJsonController::class . '@put'
                )->name('remote.put');

                //user permission
                Route::put(
                    '/user-permission',
                    UserPermissionsJsonController::class . '@store'
                )->name('user.permissions.store');

                Route::delete(
                    '/user-permission/{userPermissionId}',
                    UserPermissionsJsonController::class . '@delete'
                )->name('user.permissions.delete');

                Route::get(
                    '/user-permission',
                    UserPermissionsJsonController::class . '@index'
                )->name('user.permissions.index');
            }
        );
    }
);