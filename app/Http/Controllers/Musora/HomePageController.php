<?php

namespace App\Http\Controllers\Musora;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class HomePageController extends BaseController
{
    public function show()
    {
        return view('musora.home');
    }
}
