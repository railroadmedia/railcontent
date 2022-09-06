<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PasswordResetController extends BaseController
{

    /**
     * Show the application's reset password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request)
    {
        return view('pages.reset', [
            'token' => $request->get('token'),
            'email' => $request->get('email'),
        ]);
    }
}
