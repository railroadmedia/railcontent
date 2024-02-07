<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Modules\Referral\Services\ReferralService;

class ReferralPagesController extends BaseController
{
    private ReferralService $referralService;


    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }

    public function inviteAFriend(Request $request): Factory|View|Application
    {
        $user = user();
        $brand = brand();
        $referrer = $this->referralService->getOrCreateReferrer(
            $user->id,
            config('referral.saasquatch_referral_program_id.' . $brand),
            $brand
        );

        $referralsPerUser = $this->referralService->getReferralsPerUser();

        try {
            Avo::referral_page_viewed(
                AvoHelper::defaultEventProperties(
                    ['referral_code' => $referrer->referral_code, 'brand' => $brand],
                    $user
                )
            );
        } catch (Exception $e) {
            // Do not block user flow if event tracking fails
            Log::error($e->getMessage());
        }

        return view(
            'referral.invite-friend',
            [
                'userReferralCode' => $referrer->referral_code,
                'referralsPerUser' => $referralsPerUser,
                'userReferralsPerformed' => $referrer->referrals_performed,
                'userReferralLink' => $referrer->referral_link,
                'canRefer' => $this->referralService->canRefer($referrer),
            ]
        );
    }
}
