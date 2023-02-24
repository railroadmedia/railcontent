<?php

namespace App\Http\Controllers\Singeo;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
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

    public function improveAnyVoice()
    {
        return view('singeo.lead-gen.improve-any-voice.signup');
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

    public function stopHatingVoice()
    {
        return view('singeo.lead-gen.stop-hating-your-voice.signup');
    }

    public function leadgen(Request $request, $domain, $leadgenSlug = null)
    {
        $currentLesson = LeadgenLesson::join('leadgens', 'leadgens.id', '=', 'leadgen_lessons.leadgen_id')->join('brands', 'leadgens.brand_id', '=', 'brands.id')->where('brands.name', 'Singeo')->where('leadgen_lessons.slug', $leadgenSlug)->select('leadgen_lessons.*', 'brand_id')->first();
        if(!is_null($currentLesson)){
            if(!$currentLesson->one_off){
                $lessons = LeadgenLesson::where([['leadgen_id', $currentLesson->leadgen_id], ['one_off', 0]])->get();
                $currentLessonIndex = $lessons->search(function($item) use($leadgenSlug){
                        return $item->slug === $leadgenSlug;
                    }) + 1;
                $prevLesson = $currentLessonIndex === 1 ? null : $lessons[$currentLessonIndex - 2];
                $nextLesson = $currentLessonIndex === count($lessons) ? null : $lessons[$currentLessonIndex];
            }

            $leadgen = Leadgen::join('brands', 'brands.id', '=', 'leadgens.brand_id')->where('brands.name', 'Singeo')->where('leadgens.id', $currentLesson->leadgen_id)->select('leadgens.*')->first();

            return view('_partials.layout.global-lead-gen-lesson-layout', [
                'theme' => 'singeo',
                'leadgen' => $leadgen,
                'prevLesson' => $prevLesson ?? null,
                'currentLesson' => $currentLesson,
                'nextLesson' => $nextLesson ?? null,
                'totalLessonNum' => !empty($lessons) ? count($lessons) : null,
                'currentLessonNum' => $currentLessonIndex ?? null,
            ]);
        }
        else {
            $leadgen = Leadgen::join('brands', 'brands.id', '=', 'leadgens.brand_id')->where('brands.name', 'Singeo')->where('slug', $leadgenSlug)->select('leadgens.*')->first();
            if(!is_null($leadgen)){
                $lessons = LeadgenLesson::where([['leadgen_id', $leadgen->id], ['one_off', 0]])->get();

                return view('_partials.layout.global-lead-gen-index-layout',[
                    'theme' => 'singeo',
                    'leadgen' => $leadgen,
                    'lessons' => $lessons
                ]);
            }
        }

        throw new NotFoundHttpException();
    }
}
