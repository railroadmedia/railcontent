<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\HomePageController;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/', [HomePageController::class, 'show']);
        Route::get('/2023', [HomePageController::class, 'homepage']);
//        Route::get('/handbook', [HomePageController::class, 'handbook']);
    });

