<?php

namespace App\Http\Controllers\Musora;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class HomePageController extends BaseController
{
    public function homepage()
    {
        return view('musora.homepage', ['theme' => 'musora']);
    }

    public function handbook()
    {
        return view('musora.handbook');
    }
}
