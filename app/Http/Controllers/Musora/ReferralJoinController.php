<?php

namespace App\Http\Controllers\Musora;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\UserManagementSystem\Models\User;
use Railroad\Referral\Models\Referrer;
use Railroad\Referral\Services\ReferralService;


class ReferralJoinController extends BaseController
{

    /**
     * ReferralController constructor.
     *
     * @param ReferralService $referralService
     */
    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }

    /**
     * @return Factory|Application|View
     */
    public function join(Request $request)
    {
        $referrer = Referrer::query()->where('referral_code', $request->get('rsCode'))->first();
        if (empty($referrer)) {
            return redirect()->back();
        }

        $user = User::findOrFail($referrer->user_id);

        return view(
            'musora.referral.referral-join',
            [
                'canRefer' => $this->referralService->canRefer($referrer),
                'referredByUserName' => $user->firstname ? $user->firstname : $user->email,
                'brand' => config("referral.brand"),
                'googleRecaptchaSiteKey' => config("referral.recaptcha_site_secret")
            ]
        );
    }

}
