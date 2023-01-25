<?php

namespace App\Http\Controllers\Guitareo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SalesController extends BaseController
{
    public function home()
    {
        return view('guitareo.sales.subscription', ['theme' => 'guitareo']);
    }

    public function homeMonth()
    {
        return view('guitareo.sales.subscription', ['theme' => 'guitareo', 'month' => true]);
    }

    public function promo()
    {
        return view('guitareo.sales.subscription', ['theme' => 'guitareo', 'promoVersion' => 'true']);
    }

    public function choosePlan()
    {
        return view('guitareo.sales.choose-plan', ['theme' => 'guitareo']);
    }

    public function choosePlanMonth()
    {
        return view('guitareo.sales.choose-plan', ['theme' => 'guitareo', 'month' => true]);
    }

    public function asobergirlsguide()
    {
        return view('guitareo.sales.affiliates.asobergirlsguide', ['theme' => 'guitareo', 'month' => true]);
    }

    public function cookie()
    {
        return view('guitareo.sales.pages.cookie');
    }

    public function terms()
    {
        return view('guitareo.sales.pages.terms');
    }

    public function privacy()
    {
        return view('guitareo.sales.pages.privacy');
    }

    public function lifetime()
    {
        return view('guitareo.shop.pages.lifetime-bundle');
    }


    public function welcome()
    {
        return view('guitareo.sales.pages.welcome-1');
    }

    public function welcome2()
    {
        return view('guitareo.sales.pages.welcome-2');
    }

    public function welcome3()
    {
        return view('guitareo.sales.pages.welcome-3');
    }

    public function aylarecommends()
    {
        return view('guitareo.shop.ayla-recommends');
    }

    public function survivalkitinstructions()
    {
        return view('guitareo.shop.pages.survival-kit-tutorial');
    }

    public function songs500()
    {
        return view('guitareo.products.500-songs');
    }

    public function acousticGuitarMadeEasy()
    {
        return view('guitareo.products.acoustic-guitar-made-easy');
    }

    public function guitarQuest()
    {
        return view('guitareo.products.guitar-quest.guitar-quest');
    }

    public function guitarQuestDiscount()
    {
        return view('guitareo.products.guitar-quest.guitar-quest-discount');
    }

    public function guitarQuestDiscountTricks()
    {
        return view('guitareo.products.guitar-quest.guitar-quest-discount-tricks');
    }

    public function guitarQuestTestimonials()
    {
        return view('guitareo.products.guitar-quest.guitar-quest-testimonials');
    }

    public function gs(Request $request)
    {
        if ($request->get('utm_campaign') === 'gs27_aug2019') {
            return redirect('/acoustic-guitar-made-easy');
        }

        return view('guitareo.products.guitar-system');
    }

    public function guitarTechniqueMadeEasy()
    {
        return view('guitareo.products.guitar-technique-made-easy');
    }

    public function rhythmAndGroove()
    {
        return view('guitareo.products.rhythm-and-groove');
    }

    public function products(Request $request, $domain, $page = null)
    {
        return view('guitareo.products.' . $page);

        throw new NotFoundHttpException();
    }

    public function songs()
    {
        return view('guitareo.sales.features.songs', ['theme' => 'guitareo', 'page' => 'songs']);
    }

    public function coaches()
    {
        return view('guitareo.sales.features.coaches', ['theme' => 'guitareo', 'page' => 'coaches']);
    }

    public function method()
    {
        return view('guitareo.sales.features.method', ['theme' => 'guitareo', 'page' => 'method']);
    }
}
