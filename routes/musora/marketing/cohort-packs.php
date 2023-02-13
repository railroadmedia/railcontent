<?php

use App\Http\Controllers\Musora\CohortPackController;
use Illuminate\Support\Facades\Route;

Route::domain('{drumeoDomain}')->middleware(['web_public'])
    ->group(function () {
        Route::get('/cohort-packs/register/30-day-drummer-2', [CohortPackController::class, 'registerFor30DayDrummer2'] );
    });

Route::domain('{musoraDomain}')->middleware(['web_public'])
    ->group(function () {
        Route::get('/cohort-packs/register/30-day-drummer-2', [CohortPackController::class, 'registerFor30DayDrummer2'] );
    });

Route::domain('{pianoteDomain}')->middleware(['web_public'])
    ->group(function () {
        Route::get('/cohort-packs/register/new-piano-players-start-here', [CohortPackController::class, 'registerNewPianoPlayersStartHere'] );
    });



