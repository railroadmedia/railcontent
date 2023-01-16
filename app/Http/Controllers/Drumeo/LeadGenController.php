<?php

namespace App\Http\Controllers\Drumeo;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
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

    public function destupefy()
    {
        return view('drumeo.lead-gen.100-songs.signup');

        throw new NotFoundHttpException();
    }

    public function drumFills(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.drum-fills.index');
            default:
                return view('drumeo.lead-gen.drum-fills.lessons.'.$page);
        }

        throw new NotFoundHttpException();
    }

    public function drumSetMaintenance(Request $request, $domain, $prefix =null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.courses.full.drum-set-maintenance.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.courses.full.drum-set-maintenance.lesson-index');
                default:
                    return view('drumeo.lead-gen.courses.full.drum-set-maintenance.'.$page);
            }
        }

        throw new NotFoundHttpException();
    }

    public function dtme(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case '1-five-technique-myths':
                return view('drumeo.lead-gen.drum-technique-made-easy.lessons.1');
            case '2-massive-technique-fails':
                return view('drumeo.lead-gen.drum-technique-made-easy.lessons.2');
            case '3-the-most-important-technique':
                return view('drumeo.lead-gen.drum-technique-made-easy.lessons.3');
            case 'testimonials':
                return view('drum-technique-made-easy-testimonials');
        }

        throw new NotFoundHttpException();
    }

    public function faster(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.faster.signup');
            case 'lessons':
                return view('drumeo.lead-gen.faster.lesson-grid');
            default:
                return view('drumeo.lead-gen.faster.lessons.'.$page);
        }

        throw new NotFoundHttpException();
    }

    public function gavinsGrooves(Request $request, $domain, $prefix =null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.courses.full.gavins-grooves.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.courses.full.gavins-grooves.lesson-index');
                case '1-intro':
                    return view('drumeo.lead-gen.courses.full.gavins-grooves.1');
                case '2-mother-child-divided':
                    return view('drumeo.lead-gen.courses.full.gavins-grooves.2');
                case '3-halo':
                    return view('drumeo.lead-gen.courses.full.gavins-grooves.3');
                case '4-sound-of-muzak':
                    return view('drumeo.lead-gen.courses.full.gavins-grooves.4');
                case '5-futile':
                    return view('drumeo.lead-gen.courses.full.gavins-grooves.5');
                case '6-anesthetize':
                    return view('drumeo.lead-gen.courses.full.gavins-grooves.6');
                case '7-life':
                    return view('drumeo.lead-gen.courses.full.gavins-grooves.7');
                case '8-conclusion':
                    return view('drumeo.lead-gen.courses.full.gavins-grooves.8');
            }
        }

        throw new NotFoundHttpException();
    }

    public function getFaster()
    {
        return view('drumeo.lead-gen.faster.signup-alt');

        throw new NotFoundHttpException();
    }

    public function gstd(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.getting-started.signup');
            case 'thank-you':
                return view('drumeo.lead-gen.getting-started.thank-you');
            case 'lessons':
                return view('drumeo.lead-gen.getting-started.lesson-grid');
            case 'checking-in':
                return view('drumeo.lead-gen.getting-started.lessons.checking-in');
            case 'great-news':
                return view('drumeo.lead-gen.getting-started.lessons.great-news');
            case '1-setting-up-your-drums':
                return view('drumeo.lead-gen.getting-started.lessons.1');
            case '2-tuning-your-drums':
                return view('drumeo.lead-gen.getting-started.lessons.2');
            case '3-holding-your-drumsticks':
                return view('drumeo.lead-gen.getting-started.lessons.3');
            case '4-reading-drum-notation':
                return view('drumeo.lead-gen.getting-started.lessons.4');
            case '5-basic-counting':
                return view('drumeo.lead-gen.getting-started.lessons.5');
            case '6-your-first-beat':
                return view('drumeo.lead-gen.getting-started.lessons.6');
            case '7-your-first-fill':
                return view('drumeo.lead-gen.getting-started.lessons.7');
            case '8-using-a-metronome':
                return view('drumeo.lead-gen.getting-started.lessons.8');
            case '9-your-first-song':
                return view('drumeo.lead-gen.getting-started.lessons.9');
            case '10-practice-routine':
                return view('drumeo.lead-gen.getting-started.lessons.10');
            case '10-practice':
                return view('drumeo.lead-gen.getting-started.lessons.10-alt');
        }

        throw new NotFoundHttpException();
    }

    public function gtsdAlt()
    {
        return view('drumeo.lead-gen.getting-started.signup-alt');

        throw new NotFoundHttpException();
    }

    public function freePlayalongs(Request $request, $domain, $prefix = null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.free-playalongs.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.free-playalongs.unlocked');
                default:
                    return view('drumeo.lead-gen.free-playalongs.songs.'.$page);
            }
        }

        throw new NotFoundHttpException();
    }

    public function metalPlayalongs(Request $request, $domain, $prefix = null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.metal-playalongs.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.metal-playalongs.unlocked');
                default:
                    return view('drumeo.lead-gen.metal-playalongs.songs.'.$page);
            }
        }

        throw new NotFoundHttpException();
    }

    public function johnGrooves(Request $request, $domain, $prefix = null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.grooves-of-john-bonham.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.grooves-of-john-bonham.unlocked');
                default:
                    return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.'.$page);
            }
        }

        throw new NotFoundHttpException();
    }

    public function handTechnique(Request $request, $domain, $prefix = null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.hand-technique.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.hand-technique.lesson-grid');
                default:
                    return view('drumeo.lead-gen.hand-technique.lessons.'.$page);
            }
        }

        throw new NotFoundHttpException();
    }

    public function linearDrumming(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.linear-drumming.signup');
            case 'lessons':
                return view('drumeo.lead-gen.linear-drumming.lesson-grid');
            case '1-about':
                return view('drumeo.lead-gen.linear-drumming.lessons.1');
            case '2-dance-pop':
                return view('drumeo.lead-gen.linear-drumming.lessons.2');
            case '3-rock-tom':
                return view('drumeo.lead-gen.linear-drumming.lessons.3');
            case '4-gospel':
                return view('drumeo.lead-gen.linear-drumming.lessons.4');
            case '5-metal':
                return view('drumeo.lead-gen.linear-drumming.lessons.5');
            case 'next-level':
                return view('drumeo.lead-gen.linear-drumming.lessons.next-level');
        }

        throw new NotFoundHttpException();
    }

    public function jacksonGrooves(Request $request, $domain, $prefix = null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.lesson-index');
                case '1-intro':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.1');
                case '2-wannabestartin':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.2');
                case '3-smoothcriminal':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.3');
                case '4-billiejean':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.4');
                case '5-humannature':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.5');
                case '6-beatit':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.6');
                case '7-threatened':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.7');
                case '8-thriller':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.8');
                case '9-workingdayandnight':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.9');
                case '10-ontheroad':
                    return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.10');
            }
        }

        throw new NotFoundHttpException();
    }

    public function mustKnowGrooves(Request $request, $domain, $prefix = null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.courses.full.must-know-grooves.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.lesson-index');
                case '1-intro':
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.1');
                case '2-shuffle':
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.2');
                case '3-lindybeat':
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.3');
                case '4-motown':
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.4');
                case '5-latin':
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.5');
                case '6-vacationrhythms':
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.6');
                case '7-secondline':
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.7');
                case '8-socalpunk':
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.8');
                case '9-mozambiquesongo':
                    return view('drumeo.lead-gen.courses.full.must-know-grooves.9');
            }
        }

        throw new NotFoundHttpException();
    }

    public function rockDrumming(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case 'most-underrated-drummer':
                return view('drumeo.lead-gen.rock-drumming-masterclass.lessons.1');
            case 'most-important-rock-drum-tips':
                return view('drumeo.lead-gen.rock-drumming-masterclass.lessons.2');
            case 'epic-drum-video':
                return view('drumeo.lead-gen.rock-drumming-masterclass.lessons.3');
            case 'testimonials':
                return view('drumeo.products.rdm-testimonials');
        }

        throw new NotFoundHttpException();
    }

    public function subdivision(Request $request, $domain, $prefix = null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.courses.full.subdivision-challenge.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.courses.full.subdivision-challenge.lesson-index');
                default:
                    return view('drumeo.lead-gen.courses.full.subdivision-challenge.'.$page);
            }
        }

        throw new NotFoundHttpException();
    }

    public function sucherman(Request $request, $domain, $prefix = null, $page = null)
    {
        if(is_null($prefix) && is_null($page)) {
            return view('drumeo.lead-gen.courses.full.sucherman-sound.signup');
        } else {
            switch ($page) {
                case null:
                    return view('drumeo.lead-gen.courses.full.sucherman-sound.lesson-index');
                case '1-good-sounding':
                    return view('drumeo.lead-gen.courses.full.sucherman-sound.1');
                case '2-hi-hats':
                    return view('drumeo.lead-gen.courses.full.sucherman-sound.2');
                case '3-bass-snare':
                    return view('drumeo.lead-gen.courses.full.sucherman-sound.3');
                case '4-elevating-sound':
                    return view('drumeo.lead-gen.courses.full.sucherman-sound.4');
                case '5-shift-focus':
                    return view('drumeo.lead-gen.courses.full.sucherman-sound.5');
            }
        }

        throw new NotFoundHttpException();
    }

    public function toolbox(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.ultimate-toolbox.signup');
            case 'catalogue':
                return view('drumeo.lead-gen.ultimate-toolbox.catalogue');
        }

        throw new NotFoundHttpException();
    }

    public function toolboxGsotd(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lesson-grid');
            default:
                return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.'.$page);
        }

        throw new NotFoundHttpException();
    }

    public function toolbox5pa(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lesson-grid');
            default:
                return view('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lessons.'.$page);
        }

        throw new NotFoundHttpException();
    }

    public function toolboxBdbc(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lesson-grid');
            default:
                return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lessons.'.$page);
        }

        throw new NotFoundHttpException();
    }

    public function toolboxFwtgf(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lesson-grid');
            default:
                return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.'.$page);
        }

        throw new NotFoundHttpException();
    }

    public function toolboxRest(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case 'mcsa':
                return view('drumeo.lead-gen.ultimate-toolbox.make-cheap-sound-amazing.lesson-page');
            case 'urfd':
                return view('drumeo.lead-gen.ultimate-toolbox.useful-rudiments.lesson-page');
            case 'htls':
                return view('drumeo.lead-gen.ultimate-toolbox.how-to-learn-songs.lesson-page');
            case 'dodt':
                return view('drumeo.lead-gen.ultimate-toolbox.dictionary.lesson-page');
        }

        throw new NotFoundHttpException();
    }

    public function giftGuide()
    {
        return view('drumeo.lead-gen.gift-guide.new-years-guide');
    }

    public function newYearGift()
    {
        return view('drumeo.lead-gen.gift-guide.new-years-guide');
    }

    public function birthdayGifts()
    {
        return view('drumeo.lead-gen.gift-guide.birthday-guide');
    }

    public function christmasGift()
    {
        return view('drumeo.lead-gen.gift-guide.christmas-guide');
    }

    public function fatherGift()
    {
        return view('drumeo.lead-gen.gift-guide.fathers-day-guide');
    }

    public function shows(Request $request, $domain, $page = null)
    {
        return view('drumeo.lead-gen.shows.'.$page);

        throw new NotFoundHttpException();
    }

    public function pages(Request $request, $domain, $page = null)
    {
        if(str_contains($page, 'blog')){
            return view('drumeo.lead-gen.blog-forms.'.$page);
        }
        else {
            return view('drumeo.lead-gen.pages.'.$page);
        }

        throw new NotFoundHttpException();
    }

    public function druminarCBTTD()
    {
        return view('drumeo.lead-gen.webinar.coming-back-to-the-drums');
    }

    public function druminarEvent()
    {
        return view('drumeo.lead-gen.webinar.event');
    }

    public function teachDrums()
    {
        return view('drumeo.lead-gen.pages.teach-drums');
    }

    public function teachBeginner()
    {
        return view('drumeo.lead-gen.pages.teach-a-beginner-lessons');
    }

    public function weeklyEmail()
    {
        return view('drumeo.lead-gen.blog-forms.weekly-email');
    }
    public function weeklyMail()
    {
        return view('drumeo.lead-gen.blog-forms.weeklyemail');
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
            'theme' => 'drumeo',
            'leadgen' => $leadgen,
            'prevLesson' => $prevLesson,
            'currentLesson' => $currentLesson,
            'nextLesson' => $nextLesson,
        ]);
    }
}
