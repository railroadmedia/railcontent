<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Platform\LoginController;

Route::domain('{subdomain}.musora.com')->group(function () {
    Route::get('login', [LoginController::class, 'show']);
});
