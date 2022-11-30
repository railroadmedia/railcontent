<?php

namespace App\Http\Controllers\Guitareo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SalesController extends BaseController
{
    public function home()
    {
        return view('guitareo.sales.standard', [ 'theme' => 'guitareo' ]);
    }

    public function membership()
    {
        return view('guitareo.sales.standard');
    }
    public function membershipStudents()
    {
        return view('guitareo.sales.student-only');
    }

    public function trial()
    {
        return view('guitareo.sales.trials.trial');
    }

    public function trial30()
    {
        return view('guitareo.sales.trials.30-trial');
    }

    public function songs500()
    {
        return view('guitareo.products.500-songs');
    }

    public function songs500Discount()
    {
        return view('guitareo.products.500-songs-discount');
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

    public function guitarTechniqueMadeEasyBeginner()
    {
        return view('guitareo.products.guitar-technique-made-easy-beginner');
    }

    public function guitarTechniqueMadeEasyDiscount()
    {
        return view('guitareo.products.guitar-technique-made-easy-discount');
    }

    public function guitarTechniqueMadeEasyGSDiscount()
    {
        return view('guitareo.products.guitar-technique-made-easy-gs');
    }

    public function guitarTechniqueMadeEasyPack()
    {
        return view('guitareo.products.guitar-technique-made-easy-pack');
    }

    public function rhythmAndGroove()
    {
        return view('guitareo.products.rhythm-and-groove');
    }
}
