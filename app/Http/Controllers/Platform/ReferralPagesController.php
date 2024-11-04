<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\View\View;

class ReferralPagesController extends BaseController
{
    public function inviteAFriend(): View
    {
        return view('referral.invite-friend');
    }
}