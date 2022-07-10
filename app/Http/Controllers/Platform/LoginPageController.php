<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class LoginPageController extends BaseController
{
    public function show(Request $request)
    {
        return view('pages.login', ['redirect' => $request->get('redirect_to')]);
    }
}
