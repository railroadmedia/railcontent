<?php

use Illuminate\Support\Facades\Route;

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
                    '/content/get-by-ids',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@getByIds'
                )->name('content.get-by-ids');

                Route::get(
                    '/content/{id}',
                    \Railroad\Railcontent\Controllers\ContentJsonController::class . '@show'
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
                Route::put(
                    '/comment-like/{id}',
                    \Railroad\Railcontent\Controllers\CommentLikeJsonController::class . '@store'
                )->name('comment-like.store');

                Route::delete(
                    '/comment-like/{id}',
                    \Railroad\Railcontent\Controllers\CommentLikeJsonController::class . '@delete'
                )->name('comment-like.delete');


                //full text search
                Route::get(
                    '/search',
                    \Railroad\Railcontent\Controllers\FullTextSearchJsonController::class . '@index'
                )->name('search.index');
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
            }
        );
    }
);