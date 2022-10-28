<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\HomePageController;

Route::domain('{pianoteDomain}')->group(function () {
    Route::get('/thank-you',function () { return view('pianote.lead-gen.thank-you'); } );
    Route::get('/thankyou',function () { return view('pianote.lead-gen.thank-you-alt'); } );
    Route::get('/email-confirmation ',function () { return view('pianote.lead-gen.email-confirmation'); } );
    Route::get('/confirming',function () { return view('pianote.lead-gen.confirming'); } );
    Route::get('/subscribed',function () { return view('pianote.lead-gen.subscribed'); } );
    Route::get('/weekly-email',function () { return view('pianote.lead-gen.weekly-email'); } );
    Route::get('/weeklyemail',function () { return view('pianote.lead-gen.weekly-email-2'); } );
    Route::get('/recitals',function () { return view('pianote.lead-gen.recitals'); } );
    Route::get('/classical-cohort-1',function () { return view('pianote.lead-gen.classical-cohort-1'); } );
    Route::get('/classical-cohort-2',function () { return view('pianote.lead-gen.classical-cohort-2'); } );
    Route::get('/classical-cohort-3',function () { return view('pianote.lead-gen.classical-cohort-3'); } );
    Route::get('/classical-cohort-4',function () { return view('pianote.lead-gen.classical-cohort-4'); } );
    Route::get('/one-million',function () { return view('pianote.lead-gen.one-million'); } );
    Route::get('/piano-complete-beginners-bootcamp',function () { return view('pianote.lead-gen.piano-complete-beginners-bootcamp.piano-complete-beginners-bootcamp'); } );
    Route::get('/piano-complete-beginners-bootcamp/zoom',function () { return view('pianote.lead-gen.piano-complete-beginners-bootcamp.zoom'); } );
    Route::get('/perfect-practice-bootcamp',function () { return view('pianote.lead-gen.perfect-piano-practice-bootcamp.perfect-piano-practice-bootcamp'); } );
    Route::get('/perfect-practice-bootcamp/zoom',function () { return view('pianote.lead-gen.perfect-piano-practice-bootcamp.zoom'); } );

    Route::group(['prefix' => 'chord-hacks' ],
        function () {
            Route::get('/', function () { return view('pianote.lead-gen.chord-hacks.signup'); });
            Route::get('/piano', function () { return view('pianote.lead-gen.chord-hacks.signup-alt'); });
            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('pianote.lead-gen.chord-hacks.lessons.lessons'); });
                    Route::get('/chord-hacking', function () { return view('pianote.lead-gen.chord-hacks.lessons.chord-hacking'); });
                    Route::get('/inversions', function () { return view('pianote.lead-gen.chord-hacks.lessons.inversions'); });
                    Route::get('/adding-rhythm', function () { return view('pianote.lead-gen.chord-hacks.lessons.adding-rhythm'); });
                    Route::get('/two-hands', function () { return view('pianote.lead-gen.chord-hacks.lessons.two-hands'); });
                    Route::get('/chord-progressions', function () { return view('pianote.lead-gen.chord-hacks.lessons.chord-progressions'); });
                    Route::get('/popular-songs', function () { return view('pianote.lead-gen.chord-hacks.lessons.popular-songs'); });
                });
        }
    );

    Route::group(['prefix' => 'riffs-and-fills' ],
        function () {
            Route::get('/', function () { return view('pianote.products.riffs-and-fills'); });
            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('pianote.lead-gen.riffs-and-fills.pages.lesson-index'); });
                    Route::get('/1', function () { return view('pianote.lead-gen.riffs-and-fills.pages.1'); });
                    Route::get('/2', function () { return view('pianote.lead-gen.riffs-and-fills.pages.2'); });
                    Route::get('/3', function () { return view('pianote.lead-gen.riffs-and-fills.pages.3'); });
                    Route::get('/4', function () { return view('pianote.lead-gen.riffs-and-fills.pages.4'); });
                    Route::get('/5', function () { return view('pianote.lead-gen.riffs-and-fills.pages.5'); });
                    Route::get('/6', function () { return view('pianote.lead-gen.riffs-and-fills.pages.6'); });
                    Route::get('/7', function () { return view('pianote.lead-gen.riffs-and-fills.pages.7'); });
                });
        }
    );
    Route::group(['prefix' => 'shop/riffs-and-fills' ],
        function () {
            Route::get('/', function () { return view('pianote.products.riffs-and-fills'); });
            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('pianote.lead-gen.riffs-and-fills.pages.lesson-index'); });
                    Route::get('/1', function () { return view('pianote.lead-gen.riffs-and-fills.pages.1'); });
                    Route::get('/2', function () { return view('pianote.lead-gen.riffs-and-fills.pages.2'); });
                    Route::get('/3', function () { return view('pianote.lead-gen.riffs-and-fills.pages.3'); });
                    Route::get('/4', function () { return view('pianote.lead-gen.riffs-and-fills.pages.4'); });
                    Route::get('/5', function () { return view('pianote.lead-gen.riffs-and-fills.pages.5'); });
                    Route::get('/6', function () { return view('pianote.lead-gen.riffs-and-fills.pages.6'); });
                    Route::get('/7', function () { return view('pianote.lead-gen.riffs-and-fills.pages.7'); });
                });
        }
    );

    Route::group(['prefix' => 'method' ],
        function () {
            Route::get('/why-people-fail', function () { return view('pianote.lead-gen.method.lessons.1'); });
            Route::get('/play-a-song', function () { return view('pianote.lead-gen.method.lessons.2'); });
            Route::get('/guarantee-success', function () { return view('pianote.lead-gen.method.lessons.3'); });
        }
    );
    Route::group(['prefix' => 'piano-technique-made-easy' ],
        function () {
            Route::get('/10-min', function () { return view('pianote.lead-gen.piano-technique-made-easy.lessons.1'); });
            Route::get('/4-exercises', function () { return view('pianote.lead-gen.piano-technique-made-easy.lessons.2'); });
            Route::get('/scales-sound', function () { return view('pianote.lead-gen.piano-technique-made-easy.lessons.3'); });
        }
    );

    Route::get('/my-lessons',function () { return view('pianote.lead-gen.learn-to-play.pages.index'); } );
    Route::get('/my-lessons/how-to-play-piano',function () { return view('pianote.lead-gen.learn-to-play.pages.how-to-play'); } );
    Route::get('/my-lessons/how-to-play-chords',function () { return view('pianote.lead-gen.learn-to-play.pages.chords'); } );
    Route::get('/my-lessons/strengthening-your-hands',function () { return view('pianote.lead-gen.learn-to-play.pages.your-hands'); } );
    Route::get('/my-lessons/play-g-major',function () { return view('pianote.lead-gen.learn-to-play.pages.g-major'); } );
    Route::get('/my-lessons/play-f-major',function () { return view('pianote.lead-gen.learn-to-play.pages.f-major'); } );
    Route::get('/my-lessons/minor-keys',function () { return view('pianote.lead-gen.learn-to-play.pages.minor-keys'); } );
    Route::get('/my-lessons/chord-inversions',function () { return view('pianote.lead-gen.learn-to-play.pages.chord-inversions'); } );
    Route::get('/my-lessons/other-chords',function () { return view('pianote.lead-gen.learn-to-play.pages.other-chords'); } );
    Route::get('/my-lessons/all-about-arpeggios',function () { return view('pianote.lead-gen.learn-to-play.pages.arpeggios'); } );
    Route::get('/my-lessons/how-to-write-a-song',function () { return view('pianote.lead-gen.learn-to-play.pages.write-a-song'); } );

    Route::get('/getting-started',function () { return view('pianote.lead-gen.getting-started.pages.signup'); } );
    Route::get('/getting-started-piano',function () { return view('pianote.lead-gen.getting-started.pages.signup-alt'); } );
    Route::get('/getting-started/lessons',function () { return view('pianote.lead-gen.getting-started.pages.lessons'); } );
    Route::get('/getting-started/lessons/now-what',function () { return view('pianote.lead-gen.getting-started.pages.now-what'); } );
    Route::get('/getting-started/lessons/scales',function () { return view('pianote.lead-gen.getting-started.pages.scales'); } );
    Route::get('/getting-started/lessons/minor-scale',function () { return view('pianote.lead-gen.getting-started.pages.minor-scale'); } );
    Route::get('/getting-started/lessons/first-song',function () { return view('pianote.lead-gen.getting-started.pages.first-song'); } );
    Route::get('/getting-started/thank-you',function () { return view('pianote.lead-gen.getting-started.thank-you'); } );

    Route::get('/sight-reading-made-simple',function () { return view('pianote.lead-gen.sight-reading-made-simple.signup'); } );
    Route::get('/sight-reading-made-simple/lessons',function () { return view('pianote.lead-gen.sight-reading-made-simple.pages.lesson-index'); } );
    Route::get('/sight-reading-made-simple/lessons/1',function () { return view('pianote.lead-gen.sight-reading-made-simple.pages.1'); } );
    Route::get('/sight-reading-made-simple/lessons/2',function () { return view('pianote.lead-gen.sight-reading-made-simple.pages.2'); } );
    Route::get('/sight-reading-made-simple/lessons/3',function () { return view('pianote.lead-gen.sight-reading-made-simple.pages.3'); } );
    Route::get('/sight-reading-made-simple/lessons/4',function () { return view('pianote.lead-gen.sight-reading-made-simple.pages.4'); } );

    Route::group(['prefix' => 'learn-songs' ],
        function () {
            Route::get('/', function () { return view('pianote.lead-gen.learn-songs.signup'); });
            Route::get('/thank-you', function () { return view('pianote.lead-gen.learn-songs.thank-you'); });
            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('pianote.lead-gen.learn-songs.pages.lesson-index'); });
                    Route::get('/intro', function () { return view('pianote.lead-gen.learn-songs.pages.1'); });
                    Route::get('/someone-you-loved', function () { return view('pianote.lead-gen.learn-songs.pages.2'); });
                    Route::get('/hallelujah', function () { return view('pianote.lead-gen.learn-songs.pages.3'); });
                    Route::get('/love-story', function () { return view('pianote.lead-gen.learn-songs.pages.4'); });
                });
        }
    );

    Route::group(['prefix' => 'christmas-carols' ],
        function () {
            Route::get('/', function () { return view('pianote.lead-gen.christmas-carols.signup'); });
            Route::group(['prefix' => 'songs' ],
                function () {
                    Route::get('/', function () { return view('pianote.lead-gen.christmas-carols.pages.lesson-index'); });
                    Route::get('/deck-the-halls', function () { return view('pianote.lead-gen.christmas-carols.pages.1'); });
                    Route::get('/joy-to-the-world', function () { return view('pianote.lead-gen.christmas-carols.pages.2'); });
                    Route::get('/o-holy-night', function () { return view('pianote.lead-gen.christmas-carols.pages.3'); });
                    Route::get('/silent-night', function () { return view('pianote.lead-gen.christmas-carols.pages.4'); });
                    Route::get('/jingle-bells', function () { return view('pianote.lead-gen.christmas-carols.pages.5'); });
                });
        }
    );
    Route::group(['prefix' => 'classical-piano' ],
        function () {
            Route::get('/', function () { return view('pianote.lead-gen.classical-piano.signup'); });
            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('pianote.lead-gen.classical-piano.pages.lesson-index'); });
                    Route::get('/1', function () { return view('pianote.lead-gen.classical-piano.pages.1'); });
                    Route::get('/2', function () { return view('pianote.lead-gen.classical-piano.pages.2'); });
                    Route::get('/3', function () { return view('pianote.lead-gen.classical-piano.pages.3'); });
                    Route::get('/4', function () { return view('pianote.lead-gen.classical-piano.pages.4'); });
                });
        }
    );

    Route::group(['prefix' => '50-chord-charts' ],
        function () {
            Route::get('/', function () { return view('pianote.lead-gen.50-chord-charts.signup'); });
            Route::get('/unlocked', function () { return view('pianote.lead-gen.50-chord-charts.unlocked'); });
        }
    );

    Route::group(['prefix' => 'piano-in-5-days' ],
        function () {
            Route::get('/', function () { return view('pianote.lead-gen.piano-in-5-days.signup'); });
            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('pianote.lead-gen.piano-in-5-days.pages.lesson-index'); });
                    Route::get('/day-1-welcome-to-the-piano', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-1-welcome-to-the-piano'); });
                    Route::get('/day-1-practice-video-1', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-1-practice-video-1'); });
                    Route::get('/day-1-practice-video-2', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-1-practice-video-2'); });
                    Route::get('/day-2-you-can-play-a-melody', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-2-you-can-play-a-melody'); });
                    Route::get('/day-2-practice-video-1', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-2-practice-video-1'); });
                    Route::get('/day-3-you-can-use-both-hands', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-3-you-can-use-both-hands'); });
                    Route::get('/day-3-practice-video-1', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-3-practice-video-1'); });
                    Route::get('/day-3-practice-video-2', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-3-practice-video-2'); });
                    Route::get('/day-4-reading-music', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-4-reading-music'); });
                    Route::get('/day-4-practice-video-1', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-4-practice-video-1'); });
                    Route::get('/day-4-practice-video-2', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-4-practice-video-2'); });
                    Route::get('/day-4-practice-video-3', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-4-practice-video-3'); });
                    Route::get('/day-5-you-can-play-piano', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-5-you-can-play-piano'); });
                    Route::get('/day-5-practice-video-1', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-5-practice-video-1'); });
                    Route::get('/day-5-practice-video-2', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-5-practice-video-2'); });
                    Route::get('/day-5-practice-video-3', function () { return view('pianote.lead-gen.piano-in-5-days.pages.day-5-practice-video-3'); });
                    Route::get('/tips-for-success', function () { return view('pianote.lead-gen.piano-in-5-days.pages.tips-for-success'); });
                }
            );
        }
    );

    Route::get('/start-here',function () { return view('pianote.lead-gen.start-here'); } );

    Route::group(['prefix' => '7-days-to-sight-reading' ],
        function () {
            Route::get('/', function () { return view('pianote.lead-gen.7-days-to-sight-reading.signup'); });
            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('pianote.lead-gen.7-days-to-sight-reading.lesson-index'); });
                    Route::get('/day-1', function () { return view('pianote.lead-gen.7-days-to-sight-reading.lessons.1'); });
                    Route::get('/day-2', function () { return view('pianote.lead-gen.7-days-to-sight-reading.lessons.2'); });
                    Route::get('/day-3', function () { return view('pianote.lead-gen.7-days-to-sight-reading.lessons.3'); });
                    Route::get('/day-4', function () { return view('pianote.lead-gen.7-days-to-sight-reading.lessons.4'); });
                    Route::get('/day-5', function () { return view('pianote.lead-gen.7-days-to-sight-reading.lessons.5'); });
                    Route::get('/day-6', function () { return view('pianote.lead-gen.7-days-to-sight-reading.lessons.6'); });
                    Route::get('/day-7', function () { return view('pianote.lead-gen.7-days-to-sight-reading.lessons.7'); });
                }
            );
        }
    );

    Route::group(['prefix' => 'personality-quiz' ],
        function () {
            Route::get('/', function () { return view('pianote.lead-gen.personality-quiz.personality-quiz'); });
            Route::get('/result-1', function () { return view('pianote.lead-gen.personality-quiz.result-1'); });
            Route::get('/academic', function () { return view('pianote.lead-gen.personality-quiz.academic'); });
            Route::get('/result-2', function () { return view('pianote.lead-gen.personality-quiz.result-2'); });
            Route::get('/entertainer', function () { return view('pianote.lead-gen.personality-quiz.entertainer'); });
            Route::get('/result-3', function () { return view('pianote.lead-gen.personality-quiz.result-3'); });
            Route::get('/explorer', function () { return view('pianote.lead-gen.personality-quiz.explorer'); });
            Route::get('/result-4', function () { return view('pianote.lead-gen.personality-quiz.result-4'); });
            Route::get('/scientist', function () { return view('pianote.lead-gen.personality-quiz.scientist'); });
        }
    );
});
