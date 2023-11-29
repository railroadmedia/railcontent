<?php

// content management
Route::get(
    '/content-redirect/{id}',
    [
        'as' => 'content.redirect.id',
        'uses' => \App\Modules\MusoraCenter\Controllers\ContentRedirectController::class . '@redirectToId'
    ]
);

Route::group(
    [
        'prefix' => 'content',
        'middleware' => ['auth', 'admin-only']
    ],
    function () {
//        Route::get(
//            '/',
//            [
//                'as' => 'content.index',
//                'uses' => \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@index'
//            ]
//        );

        Route::get(
            '/videos',
            [
                'as' => 'content.videos',
                'uses' => \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@videos'
            ]
        );

        Route::get(
            '/{brand}',
            [
                'as' => 'content.brand',
                'uses' => \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@brand'
            ]
        );

        Route::get(
            '/{brand}/{type}',
            [
                'as' => 'content.brand.type',
                'uses' => \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@type'
            ]
        );

        Route::get(
            '/{brand}/{type}/store',
            [
                'as' => 'content.brand.type.store',
                'uses' => \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@store'
            ]
        );

        Route::get(
            '/{brand}/{type}/edit/{id}',
            [
                'as' => 'content.brand.type.edit',
                'uses' => \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@edit'
            ]
        );
    }
);

// main SPA
Route::group(
    [
        'prefix' => 'musora-center',
        'middleware' => ['web_or_api_authenticated', 'musora-center-admin']
    ],
    function () {
        Route::get(
            '/',
            [
                'as' => 'musora-center.home',
                'uses' => \App\Modules\MusoraCenter\Controllers\MusoraCenterSPAController::class . '@show'
            ]
        );
    }
);


// invoice
Route::get(
    '/invoice/{paymentId}',
    [
        'as' => 'invoice.show',
        'uses' => \App\Modules\MusoraCenter\Controllers\InvoiceController::class . '@show'
    ]
);

// http options
Route::options('/{any}', function () {
    return response('OK', 200)
        ->header('Access-Control-Allow-Origin', 'http://localhost:8001')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
        ->header(
            'Access-Control-Allow-Headers',
            'Access-Control-Allow-Origin, Content-Type, X-Auth-Token, Origin, Authorization'
        );
})->where('any', '.*');
