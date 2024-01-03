<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\EventTracking\Events\ReferralLinkCopied;
use App\Modules\EventTracking\Events\ReferralPageViewed;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            config('referral.saasquatch_referral_program_id.' . brand()),
            brand()
        );

        $referralsPerUser = $this->referralService->getReferralsPerUser();

        event(new ReferralPageViewed(user(), brand(), $referrer->referral_code));

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

    /**
     * @throws Exception
     */
    public function referralLinkCopied(Request $request): JsonResponse
    {
        $user = user();
        $brand = brand();

        try {
            $referrer = $this->referralService->getReferrer(
                $user->id,
                config('referral.saasquatch_referral_program_id.' . brand()),
                $brand
            );

            event(new ReferralLinkCopied($user, $brand, $referrer->referral_code));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json(
            [
                'success' => true,
            ]
        );
    }
}
