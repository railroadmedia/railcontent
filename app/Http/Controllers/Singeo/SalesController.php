<?php

namespace App\Http\Controllers\Singeo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SalesController extends BaseController
{
    public function home()
    {
        return view('singeo.sales.subscription', ['theme' => 'singeo']);
    }

    public function homeMonth()
    {
        return view('singeo.sales.subscription', ['theme' => 'singeo', 'month' => true]);
    }

    public function promo()
    {
        return view('singeo.sales.subscription', ['theme' => 'singeo', 'promoVersion' => 'true']);
    }

    public function choosePlan()
    {
        return view('singeo.sales.choose-plan', ['theme' => 'singeo']);
    }

    public function choosePlanMonth()
    {
        return view('singeo.sales.choose-plan', ['theme' => 'singeo', 'month' => true]);
    }

    public function privacy()
    {
        return view('singeo.sales.pages.privacy');
    }

    public function terms()
    {
        return view('singeo.sales.pages.terms');
    }

    public function cookie()
    {
        return view('singeo.sales.pages.cookie');
    }

    public function asobergirlsguide()
    {
        return view('singeo.sales.trials.affiliates.asobergirlsguide', ['theme' => 'singeo', 'month' => true]);
    }

    public function prefBeginner()
    {
        return view('singeo.lead-gen.self-segmentaion.beginner');
    }

    public function prefIntermediate()
    {
        return view('singeo.lead-gen.self-segmentaion.intermediate');
    }

    public function prefProfessionals()
    {
        return view('singeo.lead-gen.self-segmentaion.professional');
    }

    public function thankyou()
    {
        return view('singeo.lead-gen.thank-you');
    }

    public function subscribed()
    {
        return view('singeo.lead-gen.subscribed');
    }

    public function letssingasong()
    {
        return view('singeo.lead-gen.lets-sing-a-song');
    }

    public function welcomeparty()
    {
        return view('singeo.lead-gen.welcome-party');
    }

    public function singingstarterkit()
    {
        return view('singeo.products.singing-starter-kit');
    }

    public function singingstarterkitalt()
    {
        return view('singeo.products.singing-starter-kit-alt');
    }

    public function singingstarterkitdiscount()
    {
        return view('singeo.products.singing-starter-kit-discount');
    }

    public function singingstarterkitshyvdiscount()
    {
        return view('singeo.products.singing-starter-kit-shyv-discount');
    }

    public function recitals()
    {
        return view('singeo.lead-gen.recitals');
    }

    public function giveaway()
    {
        return view('singeo.lead-gen.giveaway');
    }

    public function ultimategiveaway()
    {
        return view('lead-gen.ultimate-giveaway');
    }

    public function beautifulharmonies()
    {
        return view('singeo.products.beautiful-harmonies');
    }

    public function lifetimeMasterclass()
    {
        return view('singeo.lead-gen.lifetime-members-masterclass');
    }

    public function method()
    {
        return view('singeo.sales.features.method', ['theme' => 'singeo', 'page' => 'method']);
    }

    public function coaches()
    {
        return view('singeo.sales.features.coaches', ['theme' => 'singeo', 'page' => 'coaches']);
    }

    public function songs()
    {
        return view('singeo.sales.features.songs', ['theme' => 'singeo', 'page' => 'songs']);
    }
}
