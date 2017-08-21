<?php

Route::post('/content', 'Railroad\Railcontent\Controllers\ContentController@store');
Route::put('/content/{contentId}', 'Railroad\Railcontent\Controllers\ContentController@update');
Route::delete('/content/{contentId}', 'Railroad\Railcontent\Controllers\ContentController@delete');
Route::post('/content/field',  'Railroad\Railcontent\Controllers\FieldController@store');
Route::put('/content/field/{fieldId}',  'Railroad\Railcontent\Controllers\FieldController@update');
Route::delete('/content/field/{fieldId}', 'Railroad\Railcontent\Controllers\FieldController@delete');
Route::post('/content/datum',  'Railroad\Railcontent\Controllers\DatumController@store');
Route::put('/content/datum/{datumId}',  'Railroad\Railcontent\Controllers\DatumController@update');
Route::delete('/content/datum/{datumId}', 'Railroad\Railcontent\Controllers\DatumController@delete');
