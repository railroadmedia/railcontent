<?php

use App\Http\Controllers\Platform\LoginPageBaseController;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('login', [LoginPageBaseController::class, 'show']);
    });
