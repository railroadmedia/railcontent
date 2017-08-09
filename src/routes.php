<?php

Route::post('/category', 'Railroad\Railcontent\Controllers\CategoryController@store');
Route::put('/category/{id}', 'Railroad\Railcontent\Controllers\CategoryController@update');
Route::delete('/category/{id}', 'Railroad\Railcontent\Controllers\CategoryController@delete');
