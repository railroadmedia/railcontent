<?php

use App\Http\Controllers\Platform\SupportController;
use Illuminate\Support\Facades\Route;


//todo: move to a diff. route file
Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('contact', [SupportController::class, 'contact']);
    });
