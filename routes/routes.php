<?php

Route::group(
    [
        'prefix' => 'railcontent'
    ],
    function () {

        Route::options('/content', 'Railroad\Railcontent\Controllers\ContentJsonController@options');
        Route::get('/content', 'Railroad\Railcontent\Controllers\ContentJsonController@index');
        Route::post('/content', 'Railroad\Railcontent\Controllers\ContentJsonController@store');
        Route::put('/content/{contentId}', 'Railroad\Railcontent\Controllers\ContentJsonController@update');
        Route::delete(
            '/content/{contentId}',
            'Railroad\Railcontent\Controllers\ContentJsonController@delete'
        );

        Route::post('/content/field', 'Railroad\Railcontent\Controllers\FieldJsonController@store');
        Route::put('/content/field/{fieldId}', 'Railroad\Railcontent\Controllers\FieldJsonController@update');
        Route::delete(
            '/content/field/{fieldId}',
            'Railroad\Railcontent\Controllers\FieldJsonController@delete'
        );

        Route::post('/content/datum', 'Railroad\Railcontent\Controllers\DatumJsonController@store');
        Route::put('/content/datum/{datumId}', 'Railroad\Railcontent\Controllers\DatumJsonController@update');
        Route::delete(
            '/content/datum/{datumId}',
            'Railroad\Railcontent\Controllers\DatumJsonController@delete'
        );

        Route::get(
            '/content/restore/{versionId}',
            'Railroad\Railcontent\Controllers\ContentVersionJsonController@restoreContent'
        );

        Route::post('/permission', 'Railroad\Railcontent\Controllers\PermissionJsonController@store');
        Route::put(
            '/permission/{permissionId}',
            'Railroad\Railcontent\Controllers\PermissionJsonController@update'
        );
        Route::delete(
            '/permission/{permissionId}',
            'Railroad\Railcontent\Controllers\PermissionJsonController@delete'
        );
        Route::post('/permission/assign', 'Railroad\Railcontent\Controllers\PermissionJsonController@assign');

        Route::put('/start', 'Railroad\Railcontent\Controllers\ContentProgressJsonController@startContent');
        Route::put('/complete', 'Railroad\Railcontent\Controllers\ContentProgressJsonController@completeContent');
        Route::put('/progress', 'Railroad\Railcontent\Controllers\ContentProgressJsonController@saveProgress');

        Route::post(
            '/playlists/add',
            'Railroad\Railcontent\Controllers\PlaylistJsonController@addToPlaylist'
        );
        Route::post('/playlists/create', 'Railroad\Railcontent\Controllers\PlaylistJsonController@store');

    }
);