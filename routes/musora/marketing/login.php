<?php

use App\Http\Controllers\Platform\LoginPageController;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('login', [LoginPageController::class, 'show'])->name('login');
    });
