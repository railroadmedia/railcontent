<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\HomePageController;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/', [HomePageController::class, 'show']);
    });

