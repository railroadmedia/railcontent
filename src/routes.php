<?php
Route::get('/', 'Railroad\Railcontent\Controllers\ContentController@index');
Route::post('/content', 'Railroad\Railcontent\Controllers\ContentController@store');
Route::put('/content/{contentId}', 'Railroad\Railcontent\Controllers\ContentController@update');
Route::delete('/content/{contentId}', 'Railroad\Railcontent\Controllers\ContentController@delete');
Route::post('/content/field', 'Railroad\Railcontent\Controllers\FieldController@store');
Route::put('/content/field/{fieldId}', 'Railroad\Railcontent\Controllers\FieldController@update');
Route::delete('/content/field/{fieldId}', 'Railroad\Railcontent\Controllers\FieldController@delete');
Route::post('/content/datum', 'Railroad\Railcontent\Controllers\DatumController@store');
Route::put('/content/datum/{datumId}', 'Railroad\Railcontent\Controllers\DatumController@update');
Route::delete('/content/datum/{datumId}', 'Railroad\Railcontent\Controllers\DatumController@delete');
Route::get(
    '/content/restore/{versionId}',
    'Railroad\Railcontent\Controllers\ContentController@restoreContent'
);
Route::post('/permission', 'Railroad\Railcontent\Controllers\PermissionController@store');
Route::put('/permission/{permissionId}', 'Railroad\Railcontent\Controllers\PermissionController@update');
Route::delete('/permission/{permissionId}', 'Railroad\Railcontent\Controllers\PermissionController@delete');
Route::post('/permission/assign', 'Railroad\Railcontent\Controllers\PermissionController@assign');
Route::put('/start', 'Railroad\Railcontent\Controllers\ContentController@startContent');
Route::put('/complete', 'Railroad\Railcontent\Controllers\ContentController@completeContent');
Route::put('/progress', 'Railroad\Railcontent\Controllers\ContentController@saveProgress');
Route::post('/playlists/add', 'Railroad\Railcontent\Controllers\PlaylistsController@addToPlaylist');
Route::post('/playlists/create', 'Railroad\Railcontent\Controllers\PlaylistsController@store');
Route::post(
    'switchLang',
    ['as' => 'switchLang', 'uses' => 'Railroad\Railcontent\Controllers\LanguageController@switchLang']
);