<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guitareo\SalesController;

Route::domain('{guitareoDomain}')->group(function () {
    Route::get('/thank-you-white', function () { return view('guitareo.lead-gen.pages.thank-you'); });
    Route::get('/welcome-party', function () { return view('guitareo.lead-gen.pages.welcome-party'); });
    Route::get('/welcome-party-carlos', function () { return view('guitareo.lead-gen.pages.welcome-party-carlos'); });
    Route::get('/confirming', function () { return view('guitareo.lead-gen.pages.confirming'); });
    Route::get('/subscribed', function () { return view('guitareo.lead-gen.pages.subscribed'); });
    Route::get('/weekly-email',function () { return view('guitareo.lead-gen.pages.weekly-email'); } );
    Route::get('/weeklyemail',function () { return view('guitareo.lead-gen.pages.weekly-email-2'); } );
    Route::get('/recitals',function () { return view('guitareo.lead-gen.pages.recitals'); } );
    Route::get('/fretboard-cheatsheet',function () { return view('guitareo.lead-gen.pages.fretboard-cheatsheet'); } );
    Route::get('/back-to-basics',function () { return view('guitareo.lead-gen.back-to-basics.back-to-basics'); } );
    Route::get('/back-to-basics/zoom',function () { return view('guitareo.lead-gen.back-to-basics.zoom'); } );
    Route::get('/clean-up-chords',function () { return view('guitareo.lead-gen.clean-up-your-chord-changes.clean-up-your-chord-changes'); } );
    Route::get('/clean-up-chords/zoom',function () { return view('guitareo.lead-gen.clean-up-your-chord-changes.zoom'); } );

    Route::group(['prefix' => 'song-in-an-hour' ],
        function () {
            Route::get('/', function () { return view('guitareo.lead-gen.song-in-an-hour.signup'); });
            Route::get('/thank-you', function () { return view('guitareo.lead-gen.song-in-an-hour.thank-you'); });
            Route::get('/success', function () { return view('guitareo.lead-gen.song-in-an-hour.success'); });
            Route::get('/writing-a-melody', function () {
                return view('guitareo.lead-gen.song-in-an-hour.lessons.writing-a-melody',
                    [
                        'songInAnHourProgress' => json_decode(request()->cookie('song_in_an_hour_progress')),
                        'lessonNumber' => 8,
                    ]);
            });
            Route::get('/next-steps', function () {
                return view('guitareo.lead-gen.song-in-an-hour.lessons.next-steps',
                    [
                        'songInAnHourProgress' => json_decode(request()->cookie('song_in_an_hour_progress')),
                        'lessonNumber' => 9,
                    ]);
            });

            /*
             * seconds_passed is second passed since they hit 'start challenge'
             *
             * content_id can be either 'song_in_an_hour_challenge' which represents the entire challenge,
             * or a lesson id, or assignment id
             *
             * song_in_an_hour_challenge can be undefined, started, paused, completed
             *
             * songInAnHourProgress (JSON ENCODED COOKIE, OBJECT) => {
             *     'seconds_passed' => 0
             *     'song_in_an_hour_challenge' => 'complete'
             *     'content_id' => 'complete'
             *     ...
             * }
             */
            Route::group(['prefix' => 'your-challenge'],
                function () {
                    Route::get('/{lessonNumber}', function ($lessonNumber) {
                        return view(
                            'guitareo.lead-gen.song-in-an-hour.lessons.' . $lessonNumber,
                            [
                                'songInAnHourProgress' => json_decode(request()->cookie('song_in_an_hour_progress')),
                                'lessonNumber' => $lessonNumber,
                            ]
                        );
                    });
                });
    });

    Route::group(['prefix' => 'free-acoustic-guitar-lessons' ],
        function () {
            Route::get('/', function () { return view('guitareo.lead-gen.free-acoustic-guitar-lessons.signup'); });
            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('guitareo.lead-gen.free-acoustic-guitar-lessons.lesson-index'); });
                    Route::get('/1', function () { return view('guitareo.lead-gen.free-acoustic-guitar-lessons.lessons.1'); });
                    Route::get('/2', function () { return view('guitareo.lead-gen.free-acoustic-guitar-lessons.lessons.2'); });
                    Route::get('/3', function () { return view('guitareo.lead-gen.free-acoustic-guitar-lessons.lessons.3'); });
                    Route::get('/4', function () { return view('guitareo.lead-gen.free-acoustic-guitar-lessons.lessons.4'); });
                    Route::get('/5', function () { return view('guitareo.lead-gen.free-acoustic-guitar-lessons.lessons.5'); });
                    Route::get('/6', function () { return view('guitareo.lead-gen.free-acoustic-guitar-lessons.lessons.6'); });
            });
    });

    Route::group(['prefix' => 'free-electric-guitar-lessons' ],
        function () {
            Route::get('/', function () { return view('guitareo.lead-gen.free-electric-guitar-lessons.signup'); });
            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('guitareo.lead-gen.free-electric-guitar-lessons.lesson-index'); });
                    Route::get('/1', function () { return view('guitareo.lead-gen.free-electric-guitar-lessons.lessons.1'); });
                    Route::get('/2', function () { return view('guitareo.lead-gen.free-electric-guitar-lessons.lessons.2'); });
                    Route::get('/3', function () { return view('guitareo.lead-gen.free-electric-guitar-lessons.lessons.3'); });
                    Route::get('/4', function () { return view('guitareo.lead-gen.free-electric-guitar-lessons.lessons.4'); });
                    Route::get('/5', function () { return view('guitareo.lead-gen.free-electric-guitar-lessons.lessons.5'); });
                    Route::get('/6', function () { return view('guitareo.lead-gen.free-electric-guitar-lessons.lessons.6'); });
                });
    });

    Route::group(['prefix' => 'guitar-tricks' ],
        function () {
            Route::get('/', function () { return view('guitareo.lead-gen.guitar-tricks.signup'); });

            Route::group(['prefix' => 'your-videos' ],
                function () {
                    Route::get('/', function () { return view('guitareo.lead-gen.guitar-tricks.lesson-index'); });
                    Route::get('/1-intro', function () { return view('guitareo.lead-gen.guitar-tricks.lessons.1'); });
                    Route::get('/2-vibrato', function () { return view('guitareo.lead-gen.guitar-tricks.lessons.2'); });
                    Route::get('/3-shampoo', function () { return view('guitareo.lead-gen.guitar-tricks.lessons.3'); });
                    Route::get('/4-palm-muting', function () { return view('guitareo.lead-gen.guitar-tricks.lessons.4'); });
                    Route::get('/5-truck', function () { return view('guitareo.lead-gen.guitar-tricks.lessons.5'); });
                    Route::get('/6-whats-next', function () { return view('guitareo.lead-gen.guitar-tricks.lessons.6'); });
                });
    });

    Route::group(['prefix' => 'solo-in-an-hour' ],
        function () {
            Route::get('/', function () { return view('guitareo.lead-gen.solo-in-an-hour.signup'); });

            Route::group(['prefix' => 'lessons' ],
                function () {
                    Route::get('/', function () { return view('guitareo.lead-gen.solo-in-an-hour.lesson-index'); });
                    Route::get('/1', function () { return view('guitareo.lead-gen.solo-in-an-hour.lessons.1'); });
                    Route::get('/2', function () { return view('guitareo.lead-gen.solo-in-an-hour.lessons.2'); });
                    Route::get('/3', function () { return view('guitareo.lead-gen.solo-in-an-hour.lessons.3'); });
                    Route::get('/4', function () { return view('guitareo.lead-gen.solo-in-an-hour.lessons.4'); });
                    Route::get('/5', function () { return view('guitareo.lead-gen.solo-in-an-hour.lessons.5'); });
                    Route::get('/6', function () { return view('guitareo.lead-gen.solo-in-an-hour.lessons.6'); });
                    Route::get('/7', function () { return view('guitareo.lead-gen.solo-in-an-hour.lessons.7'); });
                });
    });

    Route::group(['prefix' => 'acoustic-guitar-jumpstart'],
        function () {
            Route::get('/', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.signup'); });
            Route::group(['prefix' => 'course-index'],
                function () {
                    Route::get('/', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.lesson-index'); });
                    Route::get('/1', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.1'); });
                    Route::get('/2', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.2'); });
                    Route::get('/3', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.3'); });
                    Route::get('/4', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.4'); });
                    Route::get('/5', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.5'); });
                    Route::get('/6', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.6'); });
                    Route::get('/7', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.7'); });
                    Route::get('/8', function () { return view('guitareo.lead-gen.acoustic-guitar-jumpstart.8'); });
                });
    });

    Route::group(['prefix' => 'starter-kit'],
        function () {
            Route::get('/', function () { return view('guitareo.lead-gen.starter-kit.signup'); });
            Route::group(['prefix' => 'lessons'],
                function () {
                    Route::get('/', function () { return view('guitareo.lead-gen.starter-kit.lesson-grid'); });
                    Route::get('/using-a-tuner', function () { return view('guitareo.lead-gen.starter-kit.using-a-tuner.lesson'); });
                    Route::get('/whats-next', function () { return view('guitareo.lead-gen.starter-kit.whats-next.lesson'); });
                    Route::group(['prefix' => 'open-chords'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.starter-kit.open-chords.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.starter-kit.open-chords.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.starter-kit.open-chords.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.starter-kit.open-chords.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.starter-kit.open-chords.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.starter-kit.open-chords.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.starter-kit.open-chords.6'); });

                        });
                    Route::group(['prefix' => 'fundamentals'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.starter-kit.fundamentals.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.starter-kit.fundamentals.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.starter-kit.fundamentals.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.starter-kit.fundamentals.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.starter-kit.fundamentals.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.starter-kit.fundamentals.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.starter-kit.fundamentals.6'); });
                            Route::get('/7', function () { return view('guitareo.lead-gen.starter-kit.fundamentals.7'); });

                        });
                    Route::group(['prefix' => 'heartbreak-avenue'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.starter-kit.heartbreak.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.starter-kit.heartbreak.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.starter-kit.heartbreak.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.starter-kit.heartbreak.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.starter-kit.heartbreak.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.starter-kit.heartbreak.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.starter-kit.heartbreak.6'); });
                            Route::get('/7', function () { return view('guitareo.lead-gen.starter-kit.heartbreak.7'); });

                        });
                    Route::group(['prefix' => 'strumming'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.starter-kit.strumming.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.starter-kit.strumming.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.starter-kit.strumming.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.starter-kit.strumming.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.starter-kit.strumming.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.starter-kit.strumming.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.starter-kit.strumming.6'); });
                            Route::get('/7', function () { return view('guitareo.lead-gen.starter-kit.strumming.7'); });

                        });
                });
    });

    Route::group(['prefix' => 'toolbox'],
        function () {
            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.signup'); });
            Route::group(['prefix' => 'lessons'],
                function () {
                    Route::get('/', function () { return view('guitareo.lead-gen.toolbox.lesson-grid'); });
                    Route::group(['prefix' => 'changing-chords-smoothly'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.changing-chords.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.toolbox.changing-chords.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.toolbox.changing-chords.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.toolbox.changing-chords.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.toolbox.changing-chords.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.toolbox.changing-chords.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.toolbox.changing-chords.6'); });
                            Route::get('/7', function () { return view('guitareo.lead-gen.toolbox.changing-chords.7'); });

                        });
                    Route::group(['prefix' => 'exploring-guitar-rhythms'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.exploring-rhythms.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.toolbox.exploring-rhythms.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.toolbox.exploring-rhythms.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.toolbox.exploring-rhythms.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.toolbox.exploring-rhythms.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.toolbox.exploring-rhythms.5'); });

                        });
                    Route::group(['prefix' => 'how-to-tune-a-guitar'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.tune-guitar.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.toolbox.tune-guitar.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.toolbox.tune-guitar.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.toolbox.tune-guitar.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.toolbox.tune-guitar.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.toolbox.tune-guitar.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.toolbox.tune-guitar.6'); });
                            Route::get('/7', function () { return view('guitareo.lead-gen.toolbox.tune-guitar.7'); });

                        });
                    Route::group(['prefix' => 'legato-hammer-ons-pull-offs'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.legato.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.toolbox.legato.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.toolbox.legato.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.toolbox.legato.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.toolbox.legato.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.toolbox.legato.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.toolbox.legato.6'); });
                            Route::get('/7', function () { return view('guitareo.lead-gen.toolbox.legato.7'); });
                            Route::get('/8', function () { return view('guitareo.lead-gen.toolbox.legato.8'); });
                        });
                    Route::group(['prefix' => 'making-chords-sound-clean'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.clean-chords.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.toolbox.clean-chords.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.toolbox.clean-chords.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.toolbox.clean-chords.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.toolbox.clean-chords.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.toolbox.clean-chords.5'); });
                        });
                    Route::group(['prefix' => 'playing-your-first-guitar-solo'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.first-solo.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.toolbox.first-solo.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.toolbox.first-solo.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.toolbox.first-solo.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.toolbox.first-solo.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.toolbox.first-solo.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.toolbox.first-solo.6'); });
                            Route::get('/7', function () { return view('guitareo.lead-gen.toolbox.first-solo.7'); });
                            Route::get('/8', function () { return view('guitareo.lead-gen.toolbox.first-solo.8'); });
                        });
                    Route::group(['prefix' => 'playing-your-first-song'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.first-song.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.toolbox.first-song.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.toolbox.first-song.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.toolbox.first-song.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.toolbox.first-song.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.toolbox.first-song.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.toolbox.first-song.6'); });
                            Route::get('/7', function () { return view('guitareo.lead-gen.toolbox.first-song.7'); });
                            Route::get('/8', function () { return view('guitareo.lead-gen.toolbox.first-song.8'); });
                            Route::get('/9', function () { return view('guitareo.lead-gen.toolbox.first-song.9'); });
                        });
                    Route::group(['prefix' => 'sight-reading-essentials'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.sight-reading.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.toolbox.sight-reading.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.toolbox.sight-reading.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.toolbox.sight-reading.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.toolbox.sight-reading.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.toolbox.sight-reading.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.toolbox.sight-reading.6'); });
                        });
                    Route::group(['prefix' => 'soloing-with-minor-pentatonic-scales'],
                        function () {
                            Route::get('/', function () { return view('guitareo.lead-gen.toolbox.soloing-pentatonic.overview'); });
                            Route::get('/1', function () { return view('guitareo.lead-gen.toolbox.soloing-pentatonic.1'); });
                            Route::get('/2', function () { return view('guitareo.lead-gen.toolbox.soloing-pentatonic.2'); });
                            Route::get('/3', function () { return view('guitareo.lead-gen.toolbox.soloing-pentatonic.3'); });
                            Route::get('/4', function () { return view('guitareo.lead-gen.toolbox.soloing-pentatonic.4'); });
                            Route::get('/5', function () { return view('guitareo.lead-gen.toolbox.soloing-pentatonic.5'); });
                            Route::get('/6', function () { return view('guitareo.lead-gen.toolbox.soloing-pentatonic.6'); });
                            Route::get('/7', function () { return view('guitareo.lead-gen.toolbox.soloing-pentatonic.7'); });
                            Route::get('/8', function () { return view('guitareo.lead-gen.toolbox.soloing-pentatonic.8'); });
                        });
                });
    });




});
