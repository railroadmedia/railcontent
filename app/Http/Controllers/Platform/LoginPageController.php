<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class LoginPageController extends BaseController
{
    public function show()
    {
        return view('pages.login');
    }
}
