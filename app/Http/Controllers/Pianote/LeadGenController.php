<?php

namespace App\Http\Controllers\Pianote;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LeadGenController extends BaseController
{

    public function thankyou()
    {
        return view('pianote.lead-gen.thank-you');
    }

    public function thankyoualt()
    {
        return view('pianote.lead-gen.thank-you-alt');
    }

    public function emailconfirmation ()
    {
        return view('pianote.lead-gen.email-confirmation');
    }

    public function confirming()
    {
        return view('pianote.lead-gen.confirming');
    }

    public function subscribed()
    {
        return view('pianote.lead-gen.subscribed');
    }

    public function weeklyemail()
    {
        return view('pianote.lead-gen.weekly-email');
    }

    public function weeklyemail2()
    {
        return view('pianote.lead-gen.weekly-email-2');
    }

    public function minorBlues()
    {
        return view('pianote.lead-gen.minor-blues');
    }

    public function recitals()
    {
        return view('pianote.lead-gen.recitals');
    }

    public function classicalcohort1()
    {
        return view('pianote.lead-gen.classical-cohort-1');
    }

    public function classicalcohort2()
    {
        return view('pianote.lead-gen.classical-cohort-2');
    }

    public function classicalcohort3()
    {
        return view('pianote.lead-gen.classical-cohort-3');
    }

    public function classicalcohort4()
    {
        return view('pianote.lead-gen.classical-cohort-4');
    }

    public function onemillion()
    {
        return view('pianote.lead-gen.one-million');
    }

    public function beginnerBootcamp(Request $request, $domain, $page = null)
    {
        if(is_null($page)){
            return view('pianote.lead-gen.piano-complete-beginners-bootcamp.piano-complete-beginners-bootcamp');
        }
        else {
            return view('pianote.lead-gen.piano-complete-beginners-bootcamp.zoom');
        }

        throw new NotFoundHttpException();
    }

    public function practiceBootcamp(Request $request, $domain, $page = null)
    {
        if(is_null($page)){
            return view('pianote.lead-gen.perfect-piano-practice-bootcamp.perfect-piano-practice-bootcamp');
        }
        else {
            return view('pianote.lead-gen.perfect-piano-practice-bootcamp.zoom');
        }

        throw new NotFoundHttpException();
    }

    public function chordHacks(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('pianote.lead-gen.chord-hacks.signup');
            case 'lessons' && is_null($lesson):
                return view('pianote.lead-gen.chord-hacks.lessons.lessons');
            case 'lessons' && !is_null($lesson):
                return view('pianote.lead-gen.chord-hacks.lessons.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function riffsAndFills(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('pianote.products.riffs-and-fills');
            case 'lessons' && is_null($lesson):
                return view('pianote.lead-gen.riffs-and-fills.pages.lesson-index');
            case 'lessons' && !is_null($lesson):
                return view('pianote.lead-gen.riffs-and-fills.pages.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function method(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case 'why-people-fail':
                return view('pianote.lead-gen.method.lessons.1');
            case 'play-a-song':
                return view('pianote.lead-gen.method.lessons.2');
            case 'guarantee-success':
                return view('pianote.lead-gen.method.lessons.3');
        }

        throw new NotFoundHttpException();
    }

    public function pianoTechnique(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case '10-min':
                return view('pianote.lead-gen.piano-technique-made-easy.lessons.1');
            case '4-exercises':
                return view('pianote.lead-gen.piano-technique-made-easy.lessons.2');
            case 'scales-sound':
                return view('pianote.lead-gen.piano-technique-made-easy.lessons.3');
        }

        throw new NotFoundHttpException();
    }

    public function learnToPlay(Request $request, $domain, $page = null)
    {
        switch($page){
            case null:
                return view('pianote.lead-gen.learn-to-play.pages.index');
            default:
                return view('pianote.lead-gen.learn-to-play.pages.'.$page);
        }

        throw new NotFoundHttpException();
    }

    public function gstd(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page){
            case null:
                return view('pianote.lead-gen.getting-started.pages.signup');
            case 'thank-you':
                return view('pianote.lead-gen.getting-started.thank-you');
            case 'lessons' && is_null($lesson):
                return view('pianote.lead-gen.getting-started.pages.lessons');
            default:
                return view('pianote.lead-gen.getting-started.pages.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function sightReading(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page){
            case null:
                return view('pianote.lead-gen.sight-reading-made-simple.signup');
            case 'lessons' && is_null($lesson):
                return view('pianote.lead-gen.sight-reading-made-simple.pages.lesson-index');
            default:
                return view('pianote.lead-gen.sight-reading-made-simple.pages.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function learnSongs(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page){
            case null:
                return view('pianote.lead-gen.learn-songs.signup');
            case 'thank-you':
                return view('pianote.lead-gen.learn-songs.thank-you');
            case 'lessons' && is_null($lesson):
                return view('pianote.lead-gen.learn-songs.pages.lesson-index');
            default:
                switch ($lesson){
                    case 'intro':
                        return view('pianote.lead-gen.learn-songs.pages.1');
                    case 'someone-you-loved':
                        return view('pianote.lead-gen.learn-songs.pages.2');
                    case 'hallelujah':
                        return view('pianote.lead-gen.learn-songs.pages.3');
                    case 'love-story':
                        return view('pianote.lead-gen.learn-songs.pages.4');
                }
        }

        throw new NotFoundHttpException();
    }

    public function carols(Request $request, $domain, $page = null, $lesson = null)
    {
        if(is_null($page) && is_null($lesson)){
            return view('pianote.lead-gen.christmas-carols.signup');
        }
        elseif($page === 'songs' && is_null($lesson)) {
            return view('pianote.lead-gen.christmas-carols.pages.lesson-index');
        }
        else {
            switch ($lesson){
                case 'deck-the-halls':
                    return view('pianote.lead-gen.christmas-carols.pages.1');
                case 'joy-to-the-world':
                    return view('pianote.lead-gen.christmas-carols.pages.2');
                case 'o-holy-night':
                    return view('pianote.lead-gen.christmas-carols.pages.3');
                case 'silent-night':
                    return view('pianote.lead-gen.christmas-carols.pages.4');
                case 'jingle-bells':
                    return view('pianote.lead-gen.christmas-carols.pages.5');
            }
        }

        throw new NotFoundHttpException();
    }

    public function classicalPiano(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page){
            case null:
                return view('pianote.lead-gen.classical-piano.signup');
            case 'lessons' && is_null($lesson):
                return view('pianote.lead-gen.classical-piano.pages.lesson-index');
            default:
                return view('pianote.lead-gen.classical-piano.pages.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function chordCharts(Request $request, $domain, $page = null)
    {
        if(is_null($page)){
            return view('pianote.lead-gen.50-chord-charts.signup');
        }
        else {
            return view('pianote.lead-gen.50-chord-charts.unlocked');
        }

        throw new NotFoundHttpException();
    }

    public function fiveDays(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page){
            case null:
                return view('pianote.lead-gen.piano-in-5-days.signup');
            case 'lessons' && is_null($lesson):
                return view('pianote.lead-gen.piano-in-5-days.pages.lesson-index');
            default:
                return view('pianote.lead-gen.piano-in-5-days.pages.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function startHere(Request $request, $domain)
    {
        return view('pianote.lead-gen.start-here');

        throw new NotFoundHttpException();
    }

    public function sevenDaysSightReading(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page){
            case null:
                return view('pianote.lead-gen.7-days-to-sight-reading.signup');
            case 'lessons' && is_null($lesson):
                return view('pianote.lead-gen.7-days-to-sight-reading.lesson-index');
            default:
                return view('pianote.lead-gen.7-days-to-sight-reading.lessons.'.str_replace('day-','',$lesson));
        }

        throw new NotFoundHttpException();
    }

    public function personalityQuiz(Request $request, $domain, $page = null)
    {
        switch($page){
            case null:
                return view('pianote.lead-gen.personality-quiz.personality-quiz');
            default:
                return view('pianote.lead-gen.personality-quiz.'.$page);
        }

        throw new NotFoundHttpException();
    }

    public function test($root, $slug)
    {
        $currentLesson = LeadgenLesson::where('slug', $slug)->first();
        $lessons = LeadgenLesson::where('leadgen_id', $currentLesson->leadgen_id)->get();
        $currentLessonIndex = $lessons->search(function($item) use($slug){
            return $item['slug'] === $slug;
        });

        $prevLesson = $currentLessonIndex === 0 ? null : $lessons[$currentLessonIndex - 1];
        $nextLesson = $currentLessonIndex === count($lessons) - 1 ? null : $lessons[$currentLessonIndex + 1];

        $leadgen = Leadgen::where('id', $currentLesson->leadgen_id)->first();

        return view('_partials.layout.global-lead-gen-lesson-layout', [
            'theme' => 'pianote',
            'leadgen' => $leadgen,
            'prevLesson' => $prevLesson,
            'currentLesson' => $currentLesson,
            'nextLesson' => $nextLesson,
        ]);
    }
}
