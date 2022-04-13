<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Platform\HomeController;

Route::domain('{subdomain}.musora.com')
    ->middleware(['web_authenticated'])
    ->group(function () {
    Route::get('members', [
        HomeController::class,
        'show',
    ]);
});
