<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Platform\ContentPagesController;
use App\Models\Product;

Route::domain('{musoraDomain}')
    ->middleware(['web_authenticated'])
    ->group(function () {
        Route::get('members', [
        	ContentPagesController::class,
            'show',
        ]);
    });

