<?php

use App\Http\Controllers\Platform\LoginController;
use Illuminate\Support\Facades\Route;

Route::domain('{subdomain}.musora.com')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('login', [LoginController::class, 'show']);
    });
