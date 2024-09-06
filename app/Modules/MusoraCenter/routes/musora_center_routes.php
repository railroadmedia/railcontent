<?php

// content management

use App\Modules\MusoraCenter\Controllers\UserController;

Route::get(
    '/content-redirect/{id}',
    \App\Modules\MusoraCenter\Controllers\ContentRedirectController::class . '@redirectToId'
)->name('content.redirect.id');

Route::prefix('content')->middleware('auth', 'admin-only')->group(
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
            \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@videos'
        )->name('content.videos');

        Route::get(
            '/{brand}',
            \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@brand'
        )->name('content.brand');

        Route::get(
            '/{brand}/{type}',
            \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@type'
        )->name('content.brand.type');

        Route::get(
            '/{brand}/{type}/store',
            \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@store'
        )->name('content.brand.type.store');

        Route::get(
            '/{brand}/{type}/edit/{id}',
            \App\Modules\MusoraCenter\Controllers\MusoraCenterContentController::class . '@edit'
        )->name('content.brand.type.edit');
    }
);

// main SPA
Route::prefix('musora-center')->middleware('web_or_api_authenticated', 'musora-center-admin')->group(
    function () {
        Route::get(
            '/',
            \App\Modules\MusoraCenter\Controllers\MusoraCenterSPAController::class . '@show'
        )->name('musora-center.home');
    }
);


// invoice
Route::get(
    '/invoice/{paymentId}',
    \App\Modules\MusoraCenter\Controllers\InvoiceController::class . '@show'
)->name('invoice.show');

Route::group(
    [
        'prefix' => 'musora-center/api/users',
        'middleware' => ['web_or_api_authenticated', 'musora-center-admin']
    ],
    function () {
        Route::patch('/{user}', [UserController::class, 'update'])->name('user.update');
    }
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
