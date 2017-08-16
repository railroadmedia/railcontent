<?php

Route::post('/category', 'Railroad\Railcontent\Controllers\CategoryController@store');
Route::put('/category/{categoryId}', 'Railroad\Railcontent\Controllers\CategoryController@update');
Route::delete('/category/{categoryId}', 'Railroad\Railcontent\Controllers\CategoryController@delete');
Route::post('/category/field',  'Railroad\Railcontent\Controllers\CategoryController@createCategoryField');
Route::put('/category/field/{fieldId}',  'Railroad\Railcontent\Controllers\CategoryController@updateCategoryField');
Route::delete('/category/field/{fieldId}', 'Railroad\Railcontent\Controllers\CategoryController@deleteCategoryField');