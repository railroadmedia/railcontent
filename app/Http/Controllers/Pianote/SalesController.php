<?php

namespace App\Http\Controllers\Pianote;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

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

    public function asobergirlsguide()
    {
        return view('pianote.sales.trials.affiliates.asobergirlsguide');
    }

    public function keyboardkraze()
    {
        return view('pianote.sales.trials.affiliates.keyboardkraze');
    }

    public function leviclay()
    {
        return view('pianote.sales.trials.affiliates.leviclay');
    }

    public function pianodreamers()
    {
        return view('pianote.sales.trials.affiliates.pianodreamers');
    }

    public function affiliatetrial()
    {
        return view('pianote.sales.trials.trial-selection.affiliates');
    }

    public function giveaway()
    {
        return view('pianote.lead-gen.giveaway');
    }

    public function songs500fb()
    {
        return view('pianote.products.500-songs-fb');
    }

    public function songs500discount()
    {
        return view('pianote.products.500-songs-discount');
    }

    public function songs500carolsdiscount()
    {
        return view('pianote.products.500-songs-carols-discount');
    }

    public function songs500chorddiscount()
    {
        return view('pianote.products.500-songs-chord-discount');
    }

    public function songs500eltonjohn()
    {
        return view('pianote.products.500-songs-elton-john');
    }

    public function songs500aliciakeys()
    {
        return view('pianote.products.500-songs-alicia-keys');
    }

    public function songs500samsmith()
    {
        return view('pianote.products.500-songs-sam-smith');
    }

    public function songs500taylorswift()
    {
        return view('pianote.products.500-songs-taylor-swift');
    }

    public function songs500thebeatles()
    {
        return view('pianote.products.500-songs-the-beatles');
    }

    public function songs500freelesson()
    {
        return view('pianote.lead-gen.500-songs-free-lesson');
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
