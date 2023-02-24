<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\LeadGenController;

Route::domain('{singeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/{leadgenSlug?}', LeadGenController::class.'@leadgen')
            ->where('leadgenSlug', '(.*)');
    });

