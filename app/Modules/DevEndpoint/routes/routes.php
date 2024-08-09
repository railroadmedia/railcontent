<?php


Route::get(
    '/devendpoint/{arg1?}', \App\Modules\DevEndpoint\Controllers\DevEndpointController::class . '@handleRequest')->name('devendpoint');
