<?php

namespace App\Http\Controllers\Pianote;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SalesController extends BaseController
{
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
