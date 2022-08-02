<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Railroad\Referral\Models\Referrer;
use Railroad\Referral\Services\ReferralService;

class ReferralPagesController extends BaseController
{
    /**
     * @var ReferralService
     */
    private $referralService;


    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }


    public function inviteAFriend()
    {
        /**
         * @var $referrer Referrer
         */
        $referrer = $this->referralService->getOrCreateReferrer(
            user()->id,
            config('referral.saasquatch_referral_program_id', 'drumeo-30-day-referral-staging')  // check here
        );

        $referralsPerUser = $this->referralService->getReferralsPerUser();

        return view(
            'referral.invite-friend',
            [
                'referralsPerUser' => $referralsPerUser,
                'userReferralsPerformed' => $referrer->referrals_performed,
                'userReferralLink' => $referrer->referral_link,
                'canRefer' => $this->referralService->canRefer($referrer),
            ]
        );
    }
}
