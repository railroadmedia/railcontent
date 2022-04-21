<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Platform\HomeController;

Route::domain('{musoraDomain}')->group(function () {
    Route::get('members/{component?}', [HomeController::class, 'show',]);
});
