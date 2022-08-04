<?php

namespace App\Http\Controllers\Musora;

use App\Http\Controllers\BaseController;

class MarketingController extends BaseController
{

    public function terms()
    {
        return view('musora.pages.terms');
    }

    public function privacy()
    {
        return view('musora.pages.privacy');
    }

    public function careers()
    {
        return view('musora.pages.careers');
    }

    public function ambassador()
    {
        return view('musora.pages.ambassador');
    }
}
