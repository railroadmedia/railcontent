<?php

namespace App\Http\Controllers\Guitareo;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LeadGenController extends BaseController
{
    public function thankyouwhite() {
        return view('guitareo.lead-gen.pages.thank-you');
    }
    public function welcomeparty() {
        return view('guitareo.lead-gen.pages.welcome-party');
    }
    public function welcomepartycarlos() {
        return view('guitareo.lead-gen.pages.welcome-party-carlos');
    }
    public function confirming() {
        return view('guitareo.lead-gen.pages.confirming');
    }
    public function subscribed() {
        return view('guitareo.lead-gen.pages.subscribed');
    }
    public function weeklyemail() {
        return view('guitareo.lead-gen.pages.weekly-email');
    }
    public function weeklyemail2() {
        return view('guitareo.lead-gen.pages.weekly-email-2');
    }
    public function recitals() {
        return view('guitareo.lead-gen.pages.recitals');
    }
    public function fretboardcheatsheet() {
        return view('guitareo.lead-gen.pages.fretboard-cheatsheet');
    }

    public function backToBasics(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.back-to-basics.back-to-basics');
            case 'zoom':
                return view('guitareo.lead-gen.back-to-basics.zoom');
        }

        throw new NotFoundHttpException();
    }

    public function cleanUpChords(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.clean-up-your-chord-changes.clean-up-your-chord-changes');
            case 'zoom':
                return view('guitareo.lead-gen.clean-up-your-chord-changes.zoom');
        }

        throw new NotFoundHttpException();
    }

    public function songInAnHour(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.song-in-an-hour.signup');
            case 'thank-you':
                return view('guitareo.lead-gen.song-in-an-hour.thank-you');
            case 'success':
                return view('guitareo.lead-gen.song-in-an-hour.success');
            case 'writing-a-melody':
                return view('guitareo.lead-gen.song-in-an-hour.lessons.writing-a-melody', [
                    'songInAnHourProgress' => json_decode(request()->cookie('song_in_an_hour_progress')),
                    'lessonNumber' => 8,
                ]);
            case 'next-steps':
                return view('guitareo.lead-gen.song-in-an-hour.lessons.next-steps', [
                    'songInAnHourProgress' => json_decode(request()->cookie('song_in_an_hour_progress')),
                    'lessonNumber' => 9,
                ]);
            case 'your-challenge':
                return view('guitareo.lead-gen.song-in-an-hour.lessons.'.$lesson, [
                    'songInAnHourProgress' => json_decode(request()->cookie('song_in_an_hour_progress')),
                    'lessonNumber' => $lesson,
                ]);
        }

        throw new NotFoundHttpException();
    }

    public function fagl()
    {
        return view('guitareo.lead-gen.free-acoustic-guitar-lessons.signup');
    }

    public function fegl()
    {
        return view('guitareo.lead-gen.free-electric-guitar-lessons.signup');
    }

    public function hitSongs(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.chords-for-hit-songs.signup');
            case 'thank-you':
                return view('guitareo.lead-gen.chords-for-hit-songs.thank-you');
        }

        throw new NotFoundHttpException();
    }

    public function tricks()
    {
        return view('guitareo.lead-gen.guitar-tricks.signup');
    }

    public function soloInAnHour()
    {
        return view('guitareo.lead-gen.solo-in-an-hour.signup');
    }

    public function jumpstart()
    {
        return view('guitareo.lead-gen.acoustic-guitar-jumpstart.signup');
    }

    public function starterKit(Request $request, $domain, $page = null, $lesson = null, $num = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.starter-kit.signup');
            case 'lessons' && is_null($lesson):
                return view('guitareo.lead-gen.starter-kit.lesson-grid');
            case 'lessons' && $lesson === 'using-a-tuner':
                return view('guitareo.lead-gen.starter-kit.using-a-tuner.lesson');
            case 'lessons' && $lesson === 'whats-next':
                return view('guitareo.lead-gen.starter-kit.whats-next.lesson');
        }

        throw new NotFoundHttpException();
    }

    public function starterKitPages(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case 'fundamentals':
                return view('guitareo.lead-gen.starter-kit.fundamentals.overview');
            case 'open-chords':
                return view('guitareo.lead-gen.starter-kit.open-chords.overview');
            case 'heartbreak-avenue':
                return view('guitareo.lead-gen.starter-kit.heartbreak.overview');
            case 'strumming':
                return view('guitareo.lead-gen.starter-kit.strumming.overview');
        }

        throw new NotFoundHttpException();
    }

    public function strumming(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.starter-kit.strumming.overview');
            default:
                return view('guitareo.lead-gen.starter-kit.strumming.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function toolbox(Request $request, $domain, $page = null)
    {
        switch ($page){
            case null:
                return view('guitareo.lead-gen.toolbox.signup');
            case 'lessons':
                return view('guitareo.lead-gen.toolbox.lesson-grid');
        }

        throw new NotFoundHttpException();
    }

    public function toolboxPages(Request $request, $domain, $page = null)
    {
        switch ($page){
            case 'changing-chords-smoothly':
                return view('guitareo.lead-gen.toolbox.changing-chords.overview');
            case 'exploring-guitar-rhythms':
                return view('guitareo.lead-gen.toolbox.exploring-rhythms.overview');
            case 'how-to-tune-a-guitar':
                return view('guitareo.lead-gen.toolbox.tune-guitar.overview');
            case 'legato-hammer-ons-pull-offs':
                return view('guitareo.lead-gen.toolbox.legato.overview');
            case 'making-chords-sound-clean':
                return view('guitareo.lead-gen.toolbox.clean-chords.overview');
            case 'playing-your-first-guitar-solo':
                return view('guitareo.lead-gen.toolbox.first-solo.overview');
            case 'playing-your-first-song':
                return view('guitareo.lead-gen.toolbox.first-song.overview');
            case 'sight-reading-essentials':
                return view('guitareo.lead-gen.toolbox.sight-reading.overview');
            case 'soloing-with-minor-pentatonic-scales':
                return view('guitareo.lead-gen.toolbox.soloing-pentatonic.overview');
        }

        throw new NotFoundHttpException();
    }

    public function soloingPentatonic(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.toolbox.soloing-pentatonic.overview');
            default:
                return view('guitareo.lead-gen.toolbox.soloing-pentatonic.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function leadgen(Request $request, $domain, $leadgenSlug = null)
    {
        $currentLesson = LeadgenLesson::join('leadgens', 'leadgens.id', '=', 'leadgen_lessons.leadgen_id')->join('brands', 'leadgens.brand_id', '=', 'brands.id')->where('brands.name', 'Guitareo')->where('leadgen_lessons.slug', $leadgenSlug)->select('leadgen_lessons.*', 'brand_id')->first();
        if(!is_null($currentLesson)){
            if(!$currentLesson->one_off){
                $lessons = LeadgenLesson::where([['leadgen_id', $currentLesson->leadgen_id], ['one_off', 0]])->get();
                $currentLessonIndex = $lessons->search(function($item) use($leadgenSlug){
                        return $item->slug === $leadgenSlug;
                    }) + 1;
                $prevLesson = $currentLessonIndex === 1 ? null : $lessons[$currentLessonIndex - 2];
                $nextLesson = $currentLessonIndex === count($lessons) ? null : $lessons[$currentLessonIndex];
            }

            $leadgen = Leadgen::join('brands', 'brands.id', '=', 'leadgens.brand_id')->where('brands.name', 'Guitareo')->where('leadgens.id', $currentLesson->leadgen_id)->select('leadgens.*')->first();

            return view('_partials.layout.global-lead-gen-lesson-layout', [
                'theme' => 'guitareo',
                'leadgen' => $leadgen,
                'prevLesson' => $prevLesson ?? null,
                'currentLesson' => $currentLesson,
                'nextLesson' => $nextLesson ?? null,
                'totalLessonNum' => !empty($lessons) ? count($lessons) : null,
                'currentLessonNum' => $currentLessonIndex ?? null,
            ]);
        }
        else {
            $leadgen = Leadgen::where('slug', $leadgenSlug)->first();
            if(!is_null($leadgen)){
                $lessons = LeadgenLesson::where([['leadgen_id', $leadgen->id], ['one_off', 0]])->get();

                return view('_partials.layout.global-lead-gen-index-layout',[
                    'theme' => 'guitareo',
                    'leadgen' => $leadgen,
                    'lessons' => $lessons
                ]);
            }
        }

        throw new NotFoundHttpException();
    }
}
