<?php

use App\Modules\MusoraApi\Controllers\V1\ReferralController;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::post(
            '/v1/referral/link-copied', [ReferralController::class, 'linkCopied']
        )
            ->middleware('api_version:v1')
            ->name('v1.referral.link_copied');
        Route::post(
            '/v1/referral/invite-sent', [ReferralController::class, 'inviteSent']
        )
            ->middleware('api_version:v1')
            ->name('v1.referral.invite_sent');
    });
