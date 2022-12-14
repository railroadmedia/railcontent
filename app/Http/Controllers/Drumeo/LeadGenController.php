<?php

namespace App\Http\Controllers\Drumeo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LeadGenController extends BaseController
{
    public function oneHundredSongs(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.100-songs.signup');
            case 'unlocked':
                return view('drumeo.lead-gen.100-songs.unlocked');
        }

        throw new NotFoundHttpException();
    }

    public function coop3rdrumm3r(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.coop3rdrumm3r.signup');
            case 'lessons':
                return view('drumeo.lead-gen.coop3rdrumm3r.lesson-grid');
            case '1-the-drum-set':
                return view('drumeo.lead-gen.coop3rdrumm3r.lessons.1');
            case '2-drum-theory':
                return view('drumeo.lead-gen.coop3rdrumm3r.lessons.2');
            case '3-practice':
                return view('drumeo.lead-gen.coop3rdrumm3r.lessons.3');
            case '4-grooves':
                return view('drumeo.lead-gen.coop3rdrumm3r.lessons.4');
            case '5-drum-fills':
                return view('drumeo.lead-gen.coop3rdrumm3r.lessons.5');
            case 'keep-getting-better':
                return view('drumeo.lead-gen.coop3rdrumm3r.lessons.get-better');
        }

        throw new NotFoundHttpException();
    }
}
