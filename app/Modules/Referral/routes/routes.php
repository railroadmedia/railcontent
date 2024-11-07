<?php

use App\Modules\Referral\Controllers\ReferralController;
use Illuminate\Support\Facades\Route;

// note: these endpoints support web or json requests
Route::group(
    [
        'prefix' => config('referral.route_prefix'),
        'middleware' => config('referral.route_middleware_logged_in_groups'),
    ],
    function () {
        Route::post(
            '/email-invite',
            ReferralController::class.'@emailInvite'
        )->name('referral.email-invite');

        Route::post(
            '/validate-email',
            [ReferralController::class,'validateEmail']
        )->name('referral.validate-email');
    }
);
