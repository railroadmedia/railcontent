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

    public function coop3rdrumm3r()
    {
        return view('drumeo.lead-gen.coop3rdrumm3r.signup');
    }

    public function destupefy()
    {
        return view('drumeo.lead-gen.100-songs.signup');

        throw new NotFoundHttpException();
    }

    public function drumSetMaintenance()
    {
        return view('drumeo.lead-gen.courses.full.drum-set-maintenance.signup');
    }

    public function dtmeTestimonials(Request $request, $domain, $page = null)
    {
        return view('drumeo.products.dtme-testimonials');
    }

    public function faster()
    {
        return view('drumeo.lead-gen.faster.signup-old');
    }
    public function fasterTesting()
    {
        return view('drumeo.lead-gen.faster.signup');
    }

    public function gavinsGrooves()
    {
        return view('drumeo.lead-gen.courses.full.gavins-grooves.signup');
    }

    public function gstd(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('drumeo.lead-gen.getting-started.signup');
            case 'thank-you':
                return view('drumeo.lead-gen.getting-started.thank-you');
            case '10-practice':
                $currentLesson = (object) array(
                    'title' => 'Building Your Practice Routine',
                    'video_src' => '//player.vimeo.com/video/98739417',
                    'assets' => [
                        (object) array(
                            'title' => 'All Course PDFs',
                            'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
                            'soundslice' => ''
                        ),
                        (object) array(
                            'title' => 'Developing a Practice Routine',
                            'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/10-developing-a-practice-routine.pdf',
                            'soundslice' => ''
                        ),
                    ],
                );

                $lessons = LeadgenLesson::where([['leadgen_id', 9], ['one_off', 0]])->get();
                $currentLessonIndex = 10;
                $prevLesson = $currentLessonIndex === 1 ? null : $lessons[$currentLessonIndex - 2];

                $leadgen = Leadgen::where('id', 9)->first();

                return view('_partials.layout.global-lead-gen-lesson-layout', [
                    'theme' => 'drumeo',
                    'leadgen' => $leadgen,
                    'prevLesson' => $prevLesson ,
                    'currentLesson' => $currentLesson,
                    'nextLesson' => null,
                    'totalLessonNum' => 10,
                    'currentLessonNum' => 10,
                ]);
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
        return view('drumeo.lead-gen.free-playalongs.signup');
    }

    public function metalPlayalongs()
    {
        return view('drumeo.lead-gen.metal-playalongs.signup');
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

    public function handTechnique()
    {
        return view('drumeo.lead-gen.hand-technique.signup');
    }

    public function linearDrumming()
    {
        return view('drumeo.lead-gen.linear-drumming.signup');
    }

    public function jacksonGrooves()
    {
        return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.signup');
    }

    public function mustKnowGrooves()
    {
        return view('drumeo.lead-gen.courses.full.must-know-grooves.signup');
    }

    public function rockDrumming()
    {
        return view('drumeo.products.rdm-testimonials');
    }

    public function subdivision()
    {
        return view('drumeo.lead-gen.courses.full.subdivision-challenge.signup');
    }

    public function sucherman()
    {
        return view('drumeo.lead-gen.courses.full.sucherman-sound.signup');
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

    public function toolboxIndexs(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case 'gsotd':
                return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lesson-grid');
            case '5pa':
                return view('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lesson-grid');
            case 'bdbc':
                return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lesson-grid');
            case 'fwtgf':
                return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lesson-grid');
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

    public function leadgen(Request $request, $domain, $leadgenSlug = null)
    {
        $currentLesson = LeadgenLesson::join('leadgens', 'leadgens.id', '=', 'leadgen_lessons.leadgen_id')->join('brands', 'leadgens.brand_id', '=', 'brands.id')->where('brands.name', 'Drumeo')->where('leadgen_lessons.slug', $leadgenSlug)->select('leadgen_lessons.*', 'brand_id')->first();
        if(!is_null($currentLesson)){
            if(!$currentLesson->one_off){
                $lessons = LeadgenLesson::where([['leadgen_id', $currentLesson->leadgen_id], ['one_off', 0]])->get();
                $currentLessonIndex = $lessons->search(function($item) use($leadgenSlug){
                    return $item->slug === $leadgenSlug;
                }) + 1;
                $prevLesson = $currentLessonIndex === 1 ? null : $lessons[$currentLessonIndex - 2];
                $nextLesson = $currentLessonIndex === count($lessons) ? null : $lessons[$currentLessonIndex];
            }

            $leadgen = Leadgen::join('brands', 'brands.id', '=', 'leadgens.brand_id')->where('brands.name', 'Drumeo')->where('leadgens.id', $currentLesson->leadgen_id)->select('leadgens.*')->first();

            return view('_partials.layout.global-lead-gen-lesson-layout', [
                'theme' => 'drumeo',
                'leadgen' => $leadgen,
                'prevLesson' => $prevLesson ?? null,
                'currentLesson' => $currentLesson,
                'nextLesson' => $nextLesson ?? null,
                'totalLessonNum' => !empty($lessons) ? count($lessons) : null,
                'currentLessonNum' => $currentLessonIndex ?? null,
            ]);
        }
        else {
            $leadgen = Leadgen::join('brands', 'brands.id', '=', 'leadgens.brand_id')->where('brands.name', 'Drumeo')->where('slug', $leadgenSlug)->select('leadgens.*')->first();
            if(!is_null($leadgen)){
                $lessons = LeadgenLesson::where([['leadgen_id', $leadgen->id], ['one_off', 0]])->get();

                return view('_partials.layout.global-lead-gen-index-layout',[
                    'theme' => 'drumeo',
                    'leadgen' => $leadgen,
                    'lessons' => $lessons
                ]);
            }
        }

        throw new NotFoundHttpException();
    }
}
