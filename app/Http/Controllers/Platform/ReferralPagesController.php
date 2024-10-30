<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\Referral\Services\ReferralService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReferralPagesController extends BaseController
{
    private ReferralService $referralService;

    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }

    public function inviteAFriend(Request $request): Factory|View|Application
    {
        return view('referral.invite-friend');
    }
}