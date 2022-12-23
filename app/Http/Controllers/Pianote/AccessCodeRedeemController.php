<?php

namespace App\Http\Controllers\Pianote;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class AccessCodeRedeemController extends BaseController
{
    public function showRedeemPageForNewUsers()
    {
        return view('pianote.access-code-redeem.access-code-redeem-page', ['newAccount' => true]);
    }

    public function showRedeemPageForExistingUsers()
    {
        return view('pianote.access-code-redeem.access-code-redeem-page', ['newAccount' => false]);
    }
}
