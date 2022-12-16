<?php

namespace App\Http\Controllers\Singeo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LeadGenController extends BaseController
{
    public function beginnerBootcamp(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('singeo.lead-gen.beginner-vocal-bootcamp.beginner-vocal-bootcamp');
            case 'zoom':
                return view('singeo.lead-gen.beginner-vocal-bootcamp.zoom');
        }

        throw new NotFoundHttpException();
    }

    public function harmonyBootcamp(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('singeo.lead-gen.harmony-bootcamp.harmony-bootcamp');
            case 'zoom':
                return view('singeo.lead-gen.harmony-bootcamp.zoom');
        }

        throw new NotFoundHttpException();
    }

    public function holidayKaraoke(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('singeo.lead-gen.holiday-karaoke.signup');
            case 'unlocked':
                return view('singeo.lead-gen.holiday-karaoke.unlocked');
        }

        throw new NotFoundHttpException();
    }

    public function improveAnyVoice(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('singeo.lead-gen.improve-any-voice.signup');
            case 'lessons' && is_null($lesson):
                return view('singeo.lead-gen.improve-any-voice.lessons.1');
            case 'lessons' && !is_null($lesson):
                return view('singeo.lead-gen.improve-any-voice.lessons.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function liveBootcamp(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('singeo.lead-gen.live-vocal-bootcamp.live-vocal-bootcamp');
            case 'zoom':
                return view('singeo.lead-gen.live-vocal-bootcamp.zoom');
        }

        throw new NotFoundHttpException();
    }

    public function stopHatingVoice(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('singeo.lead-gen.stop-hating-your-voice.signup');
            case 'lessons' && is_null($lesson):
                return view('singeo.lead-gen.stop-hating-your-voice.lesson-index');
            case 'lessons' && !is_null($lesson):
                return view('singeo.lead-gen.stop-hating-your-voice.lessons.'.$lesson);
        }

        throw new NotFoundHttpException();
    }
}
