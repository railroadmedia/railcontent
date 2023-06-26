<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ExpiredMemberController extends BaseController
{
    public function showExpiredMemberPage(Request $request)
    {
        return view('pages.upgrade');
    }


    public function showPausedMemberPage(Request $request)
    {
        return view('pages.paused');
    }
}
