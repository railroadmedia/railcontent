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

    public function contact()
    {
        return view('musora.pages.contact');
    }

    public function ambassador()
    {
        return view('musora.pages.ambassador');
    }

    public function about()
    {
        return view('musora.pages.about');
    }

    public function brand()
    {
        return view('musora.pages.brand');
    }

    public function unified2022()
    {
        return view('musora.pages.unified-2022');
    }

    public function recitals()
    {
        return view('musora.pages.recitals');
    }

    public function giftcard()
    {
        return view('musora.pages.giftcard-page');
    }
    public function method()
    {
        return view('musora.pages.method', [ 'theme' => 'musora', 'page' => 'method' ]);
    }
}
