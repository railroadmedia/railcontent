<?php

namespace App\Modules\MusoraApi\Controllers\V1;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Railroad\Referral\Services\ReferralService;

class ReferralController
{
    private ReferralService $referralService;

    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }

    public function linkCopied(Request $request): JsonResponse
    {
        try {
            $referrer = $this->referralService->getReferrer(
                user()->id,
                config('referral.saasquatch_referral_program_id.' . brand()),
                brand()
            );

            Avo::referral_link_copied(
                AvoHelper::defaultEventProperties(
                    ['referral_code' => $referrer->referral_code, 'brand' => brand()],
                    user()
                )
            );
        } catch (Exception $e) {
            // do not block user flow if event tracking fails
            Log::error($e->getMessage());
        }

        return response()->json();
    }

    public function inviteSent(Request $request): JsonResponse
    {
        try {
            $referrer = $this->referralService->getReferrer(
                user()->id,
                config('referral.saasquatch_referral_program_id.' . brand()),
                brand()
            );

            Avo::referral_invite_sent(
                AvoHelper::defaultEventProperties(
                    ['referral_code' => $referrer->referral_code, 'brand' => brand()],
                    user()
                )
            );
        } catch (Exception $e) {
            // do not block user flow if event tracking fails
            Log::error($e->getMessage());
        }

        return response()->json();
    }
}
