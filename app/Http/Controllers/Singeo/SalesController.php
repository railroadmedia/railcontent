<?php

namespace App\Http\Controllers\Singeo;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SalesController extends BaseController
{
    public function home(): View
    {
        return view('singeo.sales.subscription', ['theme' => 'singeo']);
    }
    public function fiveReasons(): View
    {
        return view('singeo.sales.pages.5-reasons', ['theme' => 'singeo']);
    }

    public function homeMonth(): View
    {
        return view('singeo.sales.subscription', ['theme' => 'singeo', 'month' => true]);
    }

    public function trial(): View
    {
        return view('singeo.sales.subscription', ['theme' => 'singeo', 'trialVersion' => true, 'promoVersion' => 'true']);
    }

    public function trialBeginner(): View
    {
        return view('singeo.sales.subscription', ['theme' => 'singeo', 'trialVersion' => true, 'promoVersion' => 'true', 'beginnerVersion' => 'true']);
    }

    public function promo(): View
    {
        return view('singeo.sales.subscription', ['theme' => 'singeo', 'promoVersion' => 'true']);
    }

    public function choosePlan(): View
    {
        return view('singeo.sales.choose-plan', ['theme' => 'singeo']);
    }

    public function choosePlanMonth(Request $request): View
    {
        return view('singeo.sales.choose-plan', ['theme' => 'singeo', 'month' => true, 'referralCode' => $request->get('referralCode')]);
    }

    public function privacy(): View
    {
        return view('singeo.sales.pages.privacy');
    }

    public function terms(): View
    {
        return view('singeo.sales.pages.terms');
    }

    public function cookie(): View
    {
        return view('singeo.sales.pages.cookie');
    }

    public function asobergirlsguide(): View
    {
        return view('singeo.sales.affiliates.asobergirlsguide', ['theme' => 'singeo', 'month' => true]);
    }

    public function prefBeginner(): View
    {
        return view('singeo.lead-gen.self-segmentaion.beginner');
    }

    public function prefIntermediate(): View
    {
        return view('singeo.lead-gen.self-segmentaion.intermediate');
    }

    public function prefProfessionals(): View
    {
        return view('singeo.lead-gen.self-segmentaion.professional');
    }

    public function thankyou(): View
    {
        return view('singeo.lead-gen.thank-you');
    }

    public function subscribed(): View
    {
        return view('singeo.lead-gen.subscribed');
    }

    public function preferences(): View
    {
        return view('singeo.lead-gen.preferences');
    }

    public function letssingasong(): View
    {
        return view('singeo.lead-gen.lets-sing-a-song');
    }

    public function welcomeparty(): View
    {
        return view('singeo.lead-gen.welcome-party');
    }

    public function singingstarterkit(): View
    {
        return view('singeo.products.singing-starter-kit', [ 'theme' => 'singeo' ]);
    }

    public function singingstarterkitalt(): View
    {
        return view('singeo.products.singing-starter-kit-alt', [ 'theme' => 'singeo' ]);
    }

    public function singingstarterkitdiscount(): View
    {
        return view('singeo.products.singing-starter-kit-discount', [ 'theme' => 'singeo' ]);
    }

    public function singingstarterkitshyvdiscount(): View
    {
        return view('singeo.products.singing-starter-kit-shyv-discount', [ 'theme' => 'singeo' ]);
    }

    public function recitals(): View
    {
        return view('singeo.lead-gen.recitals');
    }

    public function giveaway(): View
    {
        return view('singeo.lead-gen.giveaway');
    }

    public function ultimategiveaway(): View
    {
        return view('lead-gen.ultimate-giveaway');
    }

    public function beautifulharmonies(): View
    {
        return view('singeo.products.beautiful-harmonies', [ 'theme' => 'singeo' ]);
    }

    public function singingStraw(): View
    {
        return view('singeo.products.singing-straw', [ 'theme' => 'singeo' ]);
    }

    public function lifetimeMasterclass(): View
    {
        return view('singeo.lead-gen.lifetime-members-masterclass');
    }

    public function salesLifetime(): View
    {
        return view('singeo.sales.pages.lifetime', ['theme' => 'singeo']);
    }
    public function lifetimeDiscount(): View
    {
        return view('singeo.sales.pages.lifetime', ['theme' => 'singeo', 'upgradeVersion' => true]);
    }

    public function method(): View
    {
        return view('singeo.sales.features.method', ['theme' => 'singeo', 'page' => 'method']);
    }

    public function coaches(): View
    {
        return view('singeo.sales.features.coaches', ['theme' => 'singeo', 'page' => 'coaches']);
    }

    public function songs(): View
    {
        return view('singeo.sales.features.songs', ['theme' => 'singeo', 'page' => 'songs']);
    }
}
