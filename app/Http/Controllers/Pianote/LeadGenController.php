<?php

namespace App\Http\Controllers\Pianote;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
use Carbon\Carbon;
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

    public function emailconfirmation()
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

    public function preferences()
    {
        return view('pianote.lead-gen.preferences');
    }

    public function weeklyemail()
    {
        return view('pianote.lead-gen.blog-forms.weekly-email', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function weeklyemail2()
    {
        return view('pianote.lead-gen.blog-forms.weekly-email-2', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function minorBlues()
    {
        return view('pianote.lead-gen.blog-forms.minor-blues', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function fSharpMinor()
    {
        return view('pianote.lead-gen.blog-forms.f-sharp-minor', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function pentatonicScale()
    {
        return view('pianote.lead-gen.blog-forms.pentatonic-scale', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function chordInversions()
    {
        return view('pianote.lead-gen.blog-forms.chord-inversions', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function recitals()
    {
        return view('pianote.lead-gen.recitals');
    }

    public function classicalcohort1()
    {
        return view('pianote.lead-gen.classical-cohort.1');
    }

    public function classicalcohort2()
    {
        return view('pianote.lead-gen.classical-cohort.2');
    }

    public function classicalcohort3()
    {
        return view('pianote.lead-gen.classical-cohort.3');
    }

    public function classicalcohort4()
    {
        return view('pianote.lead-gen.classical-cohort.4');
    }

    public function onemillion()
    {
        return view('pianote.lead-gen.one-million');
    }

    public function lifetimeMasterclass()
    {
        return view('pianote.lead-gen.lifetime-members-masterclass');
    }

    public function songSecrets()
    {
        return view('pianote.lead-gen.song-secrets.song-secrets-webinar', ['theme' => 'pianote']);
    }
    public function songSecretsTY()
    {
        return view('pianote.lead-gen.song-secrets.thank-you', ['theme' => 'pianote']);
    }
    public function giveaway()
    {
        return view('pianote.lead-gen.casio-giveaway', ['theme' => 'pianote', 'recaptchaKey' => config('recaptcha.key')]);
    }
    public function digitalChordsAndScales()
    {
        return view('pianote.lead-gen.digital-chords-scales-guide', ['theme' => 'pianote', 'recaptchaKey' => config('recaptcha.key')]);
    }
    public function awards()
    {
        return view('pianote.lead-gen.awards', ['theme' => 'pianote']);
    }
    public function osmoseGiveaway()
    {
        return view('pianote.lead-gen.osmose-giveaway', ['theme' => 'pianote', 'recaptchaKey' => config('recaptcha.key')]);
    }
    public function beginnerBootcamp(Request $request, $domain, $page = null)
    {
        if(is_null($page)) {
            return view('pianote.lead-gen.piano-complete-beginners-bootcamp.piano-complete-beginners-bootcamp');
        } else {
            return view('pianote.lead-gen.piano-complete-beginners-bootcamp.zoom');
        }

        throw new NotFoundHttpException();
    }

    public function practiceBootcamp(Request $request, $domain, $page = null)
    {
        if(is_null($page)) {
            return view('pianote.lead-gen.perfect-piano-practice-bootcamp.perfect-piano-practice-bootcamp');
        } else {
            return view('pianote.lead-gen.perfect-piano-practice-bootcamp.zoom');
        }

        throw new NotFoundHttpException();
    }

    public function chordHacks(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page) {
            case null:
                return view('pianote.lead-gen.chord-hacks.signup', ['recaptchaKey' => config('recaptcha.key')]);
            case 'thank-you':
                return view('pianote.lead-gen.chord-hacks.thank-you', ['theme' => 'pianote']);
            case 'ty-annual':
                return view('pianote.lead-gen.chord-hacks.ty-annual');
            case 'ty-monthly':
                return view('pianote.lead-gen.chord-hacks.ty-monthly');
        }

        throw new NotFoundHttpException();
    }

    public function bluesPianoBootcamp(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page) {
            case null:
                return view('pianote.lead-gen.blues-piano-bootcamp.signup', ['recaptchaKey' => config('recaptcha.key')]);
            case 'thank-you':
                return view('pianote.lead-gen.blues-piano-bootcamp.thank-you', ['theme' => 'pianote', 'month' => true]);
            case 'ty-annual':
                return view('pianote.lead-gen.blues-piano-bootcamp.ty-annual');
            case 'ty-monthly':
                return view('pianote.lead-gen.blues-piano-bootcamp.ty-monthly');
        }

        throw new NotFoundHttpException();
    }
    public function beautifulChristmasClassics(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page) {
            case null:
                return view('pianote.lead-gen.beautiful-christmas-classics', ['recaptchaKey' => config('recaptcha.key')]);
        }

        throw new NotFoundHttpException();
    }

    public function riffsAndFills()
    {
        return view('pianote.products.riffs-and-fills', ['theme' => 'pianote']);
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

    public function gstd(Request $request, $domain, $page = null, $lesson = null)
    {
        switch($page) {
            case null:
                return view('pianote.lead-gen.getting-started.signup', ['recaptchaKey' => config('recaptcha.key'), 'theme' => 'pianote']);
            case 'thank-you':
                return view('pianote.lead-gen.getting-started.thank-you', ['theme' => 'pianote', 'month' => true]);
            case 'ty-annual':
                return view('pianote.lead-gen.chord-hacks.ty-annual');
            case 'ty-monthly':
                return view('pianote.lead-gen.chord-hacks.ty-monthly');
        }

        throw new NotFoundHttpException();
    }

    public function sightReading()
    {
        return view('pianote.lead-gen.sight-reading-made-simple', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function learnSongs(Request $request, $domain, $page = null)
    {
        switch($page) {
            case null:
                return view('pianote.lead-gen.learn-songs.signup', ['recaptchaKey' => config('recaptcha.key')]);
            case 'thank-you':
                return view('pianote.lead-gen.learn-songs.thank-you');
        }

        throw new NotFoundHttpException();
    }

    public function carols()
    {
        return view('pianote.lead-gen.christmas-carols', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function classicalPiano()
    {
        return view('pianote.lead-gen.classical-piano', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function chordCharts(Request $request, $domain, $page = null)
    {
        if(is_null($page)) {
            return view('pianote.lead-gen.50-chord-charts.signup', ['recaptchaKey' => config('recaptcha.key')]);
        } else {
            return view('pianote.lead-gen.50-chord-charts.unlocked');
        }

        throw new NotFoundHttpException();
    }

    public function fiveDays()
    {
        return view('pianote.lead-gen.piano-in-5-days', ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function startHere(Request $request, $domain)
    {
        return view('pianote.lead-gen.start-here', ['recaptchaKey' => config('recaptcha.key')]);

        throw new NotFoundHttpException();
    }

    public function sevenDaysSightReading()
    {
        return view('pianote.lead-gen.7-days-to-sight-reading', ['recaptchaKey' => config('recaptcha.key'), 'theme' => 'pianote']);
    }

    public function personalityQuiz(Request $request, $domain, $page = null)
    {
        switch($page) {
            case null:
                return view('pianote.lead-gen.personality-quiz.personality-quiz');
            default:
                return view('pianote.lead-gen.personality-quiz.'.$page, ['recaptchaKey' => config('recaptcha.key')]);
        }

        throw new NotFoundHttpException();
    }

    public function techniqueEssentials(Request $request, $domain, $page = null, $lesson = null)
    {
        
        return view('pianote.lead-gen.technique-essentials', ['recaptchaKey' => config('recaptcha.key')]);
       
    }

    public function leadgen(Request $request, $domain, $leadgenSlug = null)
    {
        $currentLesson = LeadgenLesson::join('leadgens', 'leadgens.id', '=', 'leadgen_lessons.leadgen_id')->where('leadgens.visible', true)
            ->where(function ($query) {
                return $query
                    ->whereNull('leadgens.start_date')
                    ->orWhere('leadgens.start_date', '<=', Carbon::now('PST')->toDateTimeString());
            })
            ->where(function ($query) {
                return $query
                    ->whereNull('leadgens.end_date')
                    ->orWhere('leadgens.end_date', '>', Carbon::now('PST')->toDateTimeString());
            })
            ->join('brands', 'leadgens.brand_id', '=', 'brands.id')->where('brands.name', 'Pianote')->where('leadgen_lessons.slug', $leadgenSlug)->select('leadgen_lessons.*', 'brand_id')->first();
        if(!is_null($currentLesson)) {
            if(!$currentLesson->one_off) {
                $lessons = LeadgenLesson::where([['leadgen_id', $currentLesson->leadgen_id], ['one_off', 0]])->get();
                $currentLessonIndex = $lessons->search(function ($item) use ($leadgenSlug) {
                    return $item->slug === $leadgenSlug;
                }) + 1;
                $prevLesson = $currentLessonIndex === 1 ? null : $lessons[$currentLessonIndex - 2];
                $nextLesson = $currentLessonIndex === count($lessons) ? null : $lessons[$currentLessonIndex];
            }

            $leadgen = Leadgen::join('brands', 'brands.id', '=', 'leadgens.brand_id')->where('brands.name', 'Pianote')->where('leadgens.id', $currentLesson->leadgen_id)->select('leadgens.*')->first();

            return view('_partials.layout.global-lead-gen-lesson-layout', [
                'theme' => 'pianote',
                'leadgen' => $leadgen,
                'prevLesson' => $prevLesson ?? null,
                'currentLesson' => $currentLesson,
                'nextLesson' => $nextLesson ?? null,
                'totalLessonNum' => !empty($lessons) ? count($lessons) : null,
                'currentLessonNum' => $currentLessonIndex ?? null,
            ]);
        } else {
            $leadgen = Leadgen::where('leadgens.visible', true)
                ->where(function ($query) {
                    return $query
                        ->whereNull('leadgens.start_date')
                        ->orWhere('leadgens.start_date', '<=', Carbon::now('PST')->toDateTimeString());
                })
                ->where(function ($query) {
                    return $query
                        ->whereNull('leadgens.end_date')
                        ->orWhere('leadgens.end_date', '>', Carbon::now('PST')->toDateTimeString());
                })->join('brands', 'brands.id', '=', 'leadgens.brand_id')->where('brands.name', 'Pianote')->where('slug', $leadgenSlug)->select('leadgens.*')->first();
            if(!is_null($leadgen)) {
                $lessons = LeadgenLesson::where([['leadgen_id', $leadgen->id], ['one_off', 0]])->get();

                return view('_partials.layout.global-lead-gen-index-layout', [
                    'theme' => 'pianote',
                    'leadgen' => $leadgen,
                    'lessons' => $lessons
                ]);
            }
        }

        throw new NotFoundHttpException();
    }
}
