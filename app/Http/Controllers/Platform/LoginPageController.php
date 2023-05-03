<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class LoginPageController extends BaseController
{
    public function show(Request $request)
    {
        dd(config('app.env') );  // todo: to be deleted

        if (!empty(user())) {
            return redirect()->route('platform.home-redirect');
        }

        return view('pages.login', ['redirect' => $request->get('redirect_to')]);
    }

    public function showResetForm(Request $request)
    {
        return view('pages.login', ['redirect' => $request->get('redirect_to')]);
    }
}
