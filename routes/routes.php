<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'railcontent'
    ],
    function () {

        // content fields
        Route::post(
            '/content/field',
            \Railroad\Railcontent\Controllers\ContentFieldJsonController::class . '@store'
        )->name('content.field.store');

        Route::put(
            '/content/field/{fieldId}',
            \Railroad\Railcontent\Controllers\ContentFieldJsonController::class . '@update'
        )->name('content.field.update');

        Route::delete(
            '/content/field/{fieldId}',
            \Railroad\Railcontent\Controllers\ContentFieldJsonController::class . '@delete'
        )->name('content.field.delete');

        // content datum
        Route::post(
            '/content/datum',
            \Railroad\Railcontent\Controllers\ContentDatumJsonController::class . '@store'
        )->name('content.data.store');

        Route::put(
            '/content/datum/{datumId}',
            \Railroad\Railcontent\Controllers\ContentDatumJsonController::class . '@update'
        )->name('content.data.update');

        Route::delete(
            '/content/datum/{datumId}',
            \Railroad\Railcontent\Controllers\ContentDatumJsonController::class . '@delete'
        )->name('content.data.delete');

        // permissions
        Route::post(
            '/permission',
            \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@store'
        )->name('permissions.store');

        Route::put(
            '/permission/{permissionId}',
            \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@update'
        )->name('permissions.update');

        Route::delete(
            '/permission/{permissionId}',
            \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@delete'
        )->name('permissions.delete');

        Route::post(
            '/permission/assign',
            \Railroad\Railcontent\Controllers\PermissionJsonController::class . '@assign'
        )->name('permissions.assign');

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
            '/progress',
            Railroad\Railcontent\Controllers\ContentProgressJsonController::class . '@saveProgress'
        )->name('content.progress.store');

        // content user playlists
        Route::put(
            '/playlists',
            Railroad\Railcontent\Controllers\PlaylistJsonController::class . '@store'
        )->name('playlists.store');

        Route::post(
            '/playlists/add-content',
            Railroad\Railcontent\Controllers\PlaylistJsonController::class . '@addToPlaylist'
        )->name('playlists.content.store');


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
            '/content/{id}',
            \Railroad\Railcontent\Controllers\ContentJsonController::class . '@show'
        )->name('content.show');

        Route::post(
            '/content',
            \Railroad\Railcontent\Controllers\ContentJsonController::class . '@store'
        )->name('content.store');

        Route::put(
            '/content/{id}',
            \Railroad\Railcontent\Controllers\ContentJsonController::class . '@update'
        )->name('content.update');

        Route::delete(
            '/content/{id}',
            \Railroad\Railcontent\Controllers\ContentJsonController::class . '@delete'
        )->name('content.delete');

        Route::get(
            '/content/restore/{versionId}',
            \Railroad\Railcontent\Controllers\ContentVersionJsonController::class . '@restoreContent'
        )->name('content.restore');
    }
);