<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class InactiveMemberController extends BaseController
{
    public function showExpiredMemberPage(Request $request): View
    {
        return view('pages.upgrade');
    }

    public function showPausedMemberPage(Request $request): View
    {
        return view('pages.paused');
    }
}
