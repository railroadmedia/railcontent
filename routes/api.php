<?php
use Illuminate\Support\Facades\Route;
Route::group(
    [
        'prefix' => 'api/railcontent',
        'middleware' => \Railroad\Railcontent\Services\ConfigService::$apiMiddleware,
    ],
    function () {
        // content fields
        Route::get(
            '/content/field/{id}',
            \Railroad\Railcontent\Controllers\ContentFieldJsonController::class . '@show'
        )
            ->name('content.field.show');
        // permissions
        Route::get(
            '/permission',
            \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@index'
        )
            ->name('permissions.index');
        // content
        Route::options(
            '/content',
            \Railroad\Railcontent\Controllers\ContentJsonController::class . '@options'
        )
            ->name('content.options');
        Route::get(
            '/content',
            \Railroad\Railcontent\Controllers\ContentJsonController::class . '@index'
        )
            ->name('content.index');
        Route::get(
            '/content/parent/{parentId}',
            \Railroad\Railcontent\Controllers\ContentJsonController::class . '@getByParentId'
        )
            ->name('content.get-by-parent-id');
        Route::get(
            '/content/get-by-ids',
            \Railroad\Railcontent\Controllers\ContentJsonController::class . '@getByIds'
        )
            ->name('content.get-by-ids');
        Route::get(
            '/content/{id}',
            \Railroad\Railcontent\Controllers\ContentJsonController::class . '@show'
        )
            ->name('content.show');
        // content user progression
        Route::put(
            '/start',
            Railroad\Railcontent\Controllers\ContentProgressJsonController::class . '@startContent'
        )
            ->name('content.progress.start');
        Route::put(
            '/complete',
            Railroad\Railcontent\Controllers\ContentProgressJsonController::class . '@completeContent'
        )
            ->name('content.progress.complete');
        Route::put(
            '/reset',
            Railroad\Railcontent\Controllers\ContentProgressJsonController::class . '@resetContent'
        )
            ->name('content.progress.reset');
        Route::put(
            '/progress',
            Railroad\Railcontent\Controllers\ContentProgressJsonController::class . '@saveProgress'
        )
            ->name('content.progress.store');
        //comments
        Route::put(
            '/comment',
            \Railroad\Railcontent\Controllers\CommentJsonController::class . '@store'
        )
            ->name('comment.store');
        Route::patch(
            '/comment/{id}',
            \Railroad\Railcontent\Controllers\CommentJsonController::class . '@update'
        )
            ->name('comment.update');
        Route::delete(
            '/comment/{id}',
            \Railroad\Railcontent\Controllers\CommentJsonController::class . '@delete'
        )
            ->name('comment.delete');
        Route::put(
            '/comment/reply',
            \Railroad\Railcontent\Controllers\CommentJsonController::class . '@reply'
        )
            ->name('comment.reply');
        Route::get(
            '/comment',
            \Railroad\Railcontent\Controllers\CommentJsonController::class . '@index'
        )
            ->name('comment.index');
        Route::get(
            '/comment/{id}',
            \Railroad\Railcontent\Controllers\CommentJsonController::class . '@getLinkedComment'
        )
            ->name('comment.linked');
        //comment-likes
        Route::get(
            '/comment-likes/{commentId}',
            \Railroad\Railcontent\Controllers\CommentLikeJsonController::class . '@index'
        )
            ->name('comment-likes.index');
        Route::put(
            '/comment-like/{id}',
            \Railroad\Railcontent\Controllers\CommentLikeJsonController::class . '@store'
        )
            ->name('comment-like.store');
        Route::delete(
            '/comment-like/{id}',
            \Railroad\Railcontent\Controllers\CommentLikeJsonController::class . '@delete'
        )
            ->name('comment-like.delete');
        // content-likes
        Route::get(
            '/content-like/{id}',
            \Railroad\Railcontent\Controllers\ContentLikeJsonController::class . '@index'
        )
            ->name('content-likes.index');
        Route::put(
            '/content-like',
            \Railroad\Railcontent\Controllers\ContentLikeJsonController::class . '@like'
        )
            ->name('content-like.store');
        Route::delete(
            '/content-like',
            \Railroad\Railcontent\Controllers\ContentLikeJsonController::class . '@unlike'
        )
            ->name('content-like.delete');
        //full text search
        Route::get(
            '/search',
            \Railroad\Railcontent\Controllers\FullTextSearchJsonController::class . '@index'
        )
            ->name('search.index');
    }
);