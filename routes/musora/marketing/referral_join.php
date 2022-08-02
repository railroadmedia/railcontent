<?php

use App\Http\Controllers\Musora\ReferralJoinController;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('referral-join', [ReferralJoinController::class, 'join']);
    });
