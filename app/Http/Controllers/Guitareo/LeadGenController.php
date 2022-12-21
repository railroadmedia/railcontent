<?php

namespace App\Http\Controllers\Guitareo;

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

    public function fagl(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.free-acoustic-guitar-lessons.signup');
            case 'lessons' && is_null($lesson):
                return view('guitareo.lead-gen.free-acoustic-guitar-lessons.lesson-index');
            case 'lessons' && !is_null($lesson):
                return view('guitareo.lead-gen.free-acoustic-guitar-lessons.lessons.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function fegl(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.free-electric-guitar-lessons.signup');
            case 'lessons' && is_null($lesson):
                return view('guitareo.lead-gen.free-electric-guitar-lessons.lesson-index');
            case 'lessons' && !is_null($lesson):
                return view('guitareo.lead-gen.free-electric-guitar-lessons.lessons.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function hitSongs(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.chords-for-hit-songs.signup');
            case 'thank-you':
                return view('guitareo.lead-gen.chords-for-hit-songs.thank-you');
            case 'lessons' && is_null($lesson):
                return view('guitareo.lead-gen.chords-for-hit-songs.lessons');
            case 'lessons' && !is_null($lesson):
                return view('guitareo.lead-gen.chords-for-hit-songs.lessons.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function tricks(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.guitar-tricks.signup');
            case 'your-videos' && is_null($lesson):
                return view('guitareo.lead-gen.guitar-tricks.lesson-index');
            default:
                return view('guitareo.lead-gen.guitar-tricks.lessons.'.$lesson[0]);
        }

        throw new NotFoundHttpException();
    }

    public function soloInAnHour(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.solo-in-an-hour.signup');
            case 'lessons' && is_null($lesson):
                return view('guitareo.lead-gen.solo-in-an-hour.lesson-index');
            case 'lessons' && !is_null($lesson):
                return view('guitareo.lead-gen.solo-in-an-hour.lessons.'.$lesson);
        }

        throw new NotFoundHttpException();
    }

    public function jumpstart(Request $request, $domain, $page = null, $lesson = null)
    {
        switch ($page) {
            case null:
                return view('guitareo.lead-gen.acoustic-guitar-jumpstart.signup');
            case 'lessons' && is_null($lesson):
                return view('guitareo.lead-gen.acoustic-guitar-jumpstart.lesson-index');
            case 'lessons' && !is_null($lesson):
                return view('guitareo.lead-gen.acoustic-guitar-jumpstart.'.$lesson);
        }

        throw new NotFoundHttpException();
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

    public function openChords(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.starter-kit.open-chords.overview');
            default:
                return view('guitareo.lead-gen.starter-kit.open-chords.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function fundamentals(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.starter-kit.fundamentals.overview');
            default:
                return view('guitareo.lead-gen.starter-kit.fundamentals.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function heartbreak(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.starter-kit.heartbreak.overview');
            default:
                return view('guitareo.lead-gen.starter-kit.heartbreak.'.$num);
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

    public function changingChords(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.toolbox.changing-chords.overview');
            default:
                return view('guitareo.lead-gen.toolbox.changing-chords.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function exploreRhythms(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.toolbox.exploring-rhythms.overview');
            default:
                return view('guitareo.lead-gen.toolbox.exploring-rhythms.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function tuneGuitar(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.toolbox.tune-guitar.overview');
            default:
                return view('guitareo.lead-gen.toolbox.tune-guitar.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function legato(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.toolbox.legato.overview');
            default:
                return view('guitareo.lead-gen.toolbox.legato.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function cleanChords(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.toolbox.clean-chords.overview');
            default:
                return view('guitareo.lead-gen.toolbox.clean-chords.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function firstSolo(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.toolbox.first-solo.overview');
            default:
                return view('guitareo.lead-gen.toolbox.first-solo.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function firstSong(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.toolbox.first-song.overview');
            default:
                return view('guitareo.lead-gen.toolbox.first-song.'.$num);
        }

        throw new NotFoundHttpException();
    }

    public function sightReading(Request $request, $domain, $num = null)
    {
        switch ($num){
            case null:
                return view('guitareo.lead-gen.toolbox.sight-reading.overview');
            default:
                return view('guitareo.lead-gen.toolbox.sight-reading.'.$num);
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
}
