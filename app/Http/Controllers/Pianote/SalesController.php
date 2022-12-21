<?php

namespace App\Http\Controllers\Pianote;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SalesController extends BaseController
{

    public function about()
    {
        return view('pianote.sales.pages.about');
    }

    public function app()
    {
        return view('pianote.sales.pages.app');
    }

    public function cookie()
    {
        return view('pianote.sales.pages.cookie');
    }

    public function terms()
    {
        return view('pianote.sales.pages.terms');
    }

    public function privacy()
    {
        return view('pianote.sales.pages.privacy');
    }

    public function songs()
    {
        return view('pianote.sales.pages.songs.songs', [ 'theme' => 'pianote', 'page' => 'songs']);
    }

    public function method()
    {
        return view('pianote.sales.pages.method.method', [ 'theme' => 'pianote', 'page' => 'method']);
    }

    public function coaches()
    {
        return view('pianote.sales.pages.coaches.coaches', [ 'theme' => 'pianote', 'page' => 'coaches']);
    }

    public function chooseyourtrial()
    {
        return view('pianote.sales.trials.trial-selection.week');
    }

    public function chooseyourtrialmonth()
    {
        return view('pianote.sales.trials.trial-selection.month');
    }

    public function davidbennett()
    {
        return view('pianote.sales.trials.affiliates.davidbennett');
    }

    public function affiliates(Request $request, $domain, $page = null)
    {
        return view('pianote.sales.trials.affiliates.'.$page);

        throw new NotFoundHttpException();
    }

    public function affiliatetrial()
    {
        return view('pianote.sales.trials.trial-selection.affiliates');
    }

    public function giveaway()
    {
        return view('pianote.lead-gen.giveaway');
    }

    public function products(Request $request, $domain, $page = null)
    {
        return view('pianote.products.'.$page);

        throw new NotFoundHttpException();
    }

    public function fasterfingers()
    {
        return view('pianote.products.faster-fingers');
    }

    public function worshippiano()
    {
        return view('pianote.products.worship-piano');
    }

    public function pianotechniquemadeeasy()
    {
        return view('pianote.products.piano-technique-made-easy');
    }

    public function destupefyyourlefthand()
    {
        return view('pianote.products.destupefy-your-left-hand');
    }

    public function playbeautifulpiano()
    {
        return view('pianote.products.play-beautiful-piano');
    }

    public function beginnerclassicalpiano()
    {
        return view('pianote.products.beginner-classical-piano');
    }

    public function lifetime()
    {
        return view('pianote.shop.pages.lifetime');
    }

    public function keeplearning()
    {
        return view('pianote.shop.pages.keep-learning');
    }

    public function upgradeoffer()
    {
        return view('pianote.shop.pages.upgrade-offer');
    }

    public function lisarecommends()
    {
        return view('pianote.shop.lisa-recommends');
    }

    public function welcomeparty()
    {
        return view('pianote.lead-gen.welcome-party');
    }


    public function home()
    {
        return view('pianote.sales.standard', [ 'theme' => 'pianote' ]);
    }

    public function jesusMolina()
    {
        return view('pianote.products.improvisation-with-jesus-molina');
    }

    public function studentOnly()
    {
        return view('pianote.sales.student-only');
    }

    public function roland()
    {
        return view('pianote.sales.roland');
    }

    public function trial()
    {
        return view('pianote.sales.trials.trial');
    }

    public function trialMonth()
    {
        return view('pianote.sales.trials.30-trial');
    }

    public function songs500()
    {
        return view('pianote.products.500-songs');
    }

    public function PowerOfChords()
    {
        return view('pianote.products.the-power-of-chords');
    }

    public function PowerOfChordsBootcamp()
    {
        return view('pianote.products.the-power-of-chords-bootcamp');
    }

    public function PowerOfChordsGiveaway()
    {
        return view('pianote.products.the-power-of-chords-giveaway');
    }

    public function concertHeadphones()
    {
        return view('pianote.products.concert-headphones');
    }

    public function foundations()
    {
        return view('pianote.products.foundation-books');
    }
}
