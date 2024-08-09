<?php

use Illuminate\Support\Facades\Route;

// note: these endpoints support web or json requests
Route::prefix(config('referral.route_prefix'))->middleware(config('referral.route_middleware_logged_in_groups'))->group(
    function () {
        Route::post(
            '/email-invite',
            \App\Modules\Referral\Controllers\ReferralController::class.'@emailInvite'
        )->name('referral.email-invite');
    }
);
