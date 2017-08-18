<?php

Route::post('/category', 'Railroad\Railcontent\Controllers\CategoryController@store');
Route::put('/category/{categoryId}', 'Railroad\Railcontent\Controllers\CategoryController@update');
Route::delete('/category/{categoryId}', 'Railroad\Railcontent\Controllers\CategoryController@delete');
Route::post('/category/field',  'Railroad\Railcontent\Controllers\FieldController@storeCategoryField');
Route::put('/category/field/{fieldId}',  'Railroad\Railcontent\Controllers\FieldController@updateCategoryField');
Route::delete('/category/field/{fieldId}', 'Railroad\Railcontent\Controllers\FieldController@deleteCategoryField');
Route::post('/category/datum',  'Railroad\Railcontent\Controllers\DatumController@storeCategoryDatum');
Route::put('/category/datum/{datumId}',  'Railroad\Railcontent\Controllers\DatumController@updateCategoryDatum');
Route::delete('/category/datum/{datumId}', 'Railroad\Railcontent\Controllers\DatumController@deleteCategoryDatum');
