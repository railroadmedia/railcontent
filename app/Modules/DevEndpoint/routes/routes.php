<?php


Route::get(
    '/devendpoint/{arg1?}',
    [
            'as' => 'devendpoint',
            'uses' => \App\Modules\DevEndpoint\Controllers\DevEndpointController::class . '@handleRequest'
        ]
);
