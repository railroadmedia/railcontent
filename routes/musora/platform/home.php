<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Platform\HomeController;

Route::domain('{musoraDomain}')
    ->middleware(['web_authenticated'])
    ->group(function () {
    Route::get('members', [
        HomeController::class,
        'show',
    ]);
});
