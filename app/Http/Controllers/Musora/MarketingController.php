<?php

namespace App\Http\Controllers\Musora;

use App\Http\Controllers\BaseController;

class MarketingController extends BaseController
{

    public function homepage()
    {
        return view('musora.homepage', ['theme' => 'musora']);
    }
    public function sixReasons()
    {
        return view('musora.pages.6-reasons', ['theme' => 'musora']);
    }
    public function moderators()
    {
        return view('musora.pages.moderators', ['theme' => 'musora']);
    }

    public function handbook()
    {
        return view('musora.handbook');
    }
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
        return view('musora.pages.unified-2022', [ 'theme' => 'musora']);
    }

    public function mentors()
    {
        return view('musora.pages.mentors', [ 'theme' => 'musora']);
    }

    public function playlists()
    {
        return view('musora.pages.playlists', [ 'theme' => 'musora']);
    }

    public function recitals()
    {
        return view('musora.pages.recitals');
    }

    public function giftcard()
    {
        return view('musora.pages.gift-card');
    }
    public function method()
    {
        return view('musora.pages.method', [ 'theme' => 'musora', 'page' => 'method' ]);
    }
    public function songs()
    {
        return view('musora.pages.songs', [ 'theme' => 'musora', 'page' => 'songs' ]);
    }
    public function community()
    {
        return view('musora.pages.community', [ 'theme' => 'musora', ]);
    }
    public function choosePlan()
    {
        return view('musora.pages.choose-plan', ['theme' => 'musora']);
    }
}
