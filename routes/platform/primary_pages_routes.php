<?php

use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->group(function () {
        Route::get('/{brand}', [\App\Http\Controllers\Platform\HomeController::class, 'index']);
    });
