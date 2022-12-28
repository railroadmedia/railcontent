<?php

namespace App\Http\Controllers\Singeo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SalesController extends BaseController
{
    public function home()
    {
        return view('singeo.sales.standard', [ 'theme' => 'singeo' ]);
    }
    public function home23()
    {
        return view('singeo.sales.subscription-homepages', ['theme' => 'singeo']);
    }
    public function promo()
    {
        return view('singeo.sales.subscription-homepages', ['theme' => 'singeo', 'promoVersion' => 'true']);
    }
    public function plan23()
    {
        return view('singeo.sales.choose-plan', ['theme' => 'singeo']);
    }
    public function studentOnly()
    {
        return view('singeo.sales.student-only');
    }
    public function privacy()
    {
        return view('singeo.sales.pages.privacy');
    }
    public function terms()
    {
        return view('singeo.sales.pages.terms');
    }
    public function trial()
    {
        return view('singeo.sales.trials.trial');
    }
    public function trialMonth()
    {
        return view('singeo.sales.trials.30-trial');
    }
    public function chooseYourTrial()
    {
        return view('singeo.sales.trials.trial-selection.week');
    }
    public function chooseYourTrialMonth()
    {
        return view('singeo.sales.trials.trial-selection.month');
    }
    public function cookie()
    {
        return view('singeo.sales.pages.cookie');
    }
    public function asobergirlsguide()
    {
        return view('singeo.sales.trials.affiliates.asobergirlsguide');
    }
    public function affiliateTrial()
    {
        return view('singeo.sales.trials.trial-selection.affiliates');
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
    public function method()
    {
        return view('singeo.sales.pages.method.method', ['theme' => 'singeo', 'page' => 'method']);
    }
    public function coaches()
    {
        return view('singeo.sales.pages.coaches.coaches', ['theme' => 'singeo', 'page' => 'coaches']);
    }
    public function songs()
    {
        return view('singeo.sales.pages.songs.songs', ['theme' => 'singeo', 'page' => 'songs']);
    }
}
