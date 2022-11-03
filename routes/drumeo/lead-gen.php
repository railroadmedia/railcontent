<?php

use Illuminate\Support\Facades\Route;

Route::domain('{drumeoDomain}')->group(function () {
    Route::group(['prefix' => '100-songs'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.100-songs.signup'); });
            Route::get('/unlocked', function () { return view('drumeo.lead-gen.100-songs.unlocked'); });
        }
    );
    Route::group(['prefix' => 'coop3rdrumm3r'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.coop3rdrumm3r.signup'); });
            Route::get('/lessons', function () { return view('drumeo.lead-gen.coop3rdrumm3r.lesson-grid'); });
            Route::get('/1-the-drum-set', function () { return view('drumeo.lead-gen.coop3rdrumm3r.lessons.1'); });
            Route::get('/2-drum-theory', function () { return view('drumeo.lead-gen.coop3rdrumm3r.lessons.2'); });
            Route::get('/3-practice', function () { return view('drumeo.lead-gen.coop3rdrumm3r.lessons.3'); });
            Route::get('/4-grooves', function () { return view('drumeo.lead-gen.coop3rdrumm3r.lessons.4'); });
            Route::get('/5-drum-fills', function () { return view('drumeo.lead-gen.coop3rdrumm3r.lessons.5'); });
            Route::get('/keep-getting-better', function () { return view('drumeo.lead-gen.coop3rdrumm3r.lessons.get-better'); });
        }
    );
    Route::get('/destupefying-your-weak-hand', function () { return view('drumeo.lead-gen.destupefy.destupefy'); });

    Route::group(['prefix' => 'drum-fills'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.drum-fills.index'); });
            Route::get('/1', function () { return view('drumeo.lead-gen.drum-fills.lessons.1'); });
            Route::get('/2', function () { return view('drumeo.lead-gen.drum-fills.lessons.2'); });
            Route::get('/3', function () { return view('drumeo.lead-gen.drum-fills.lessons.3'); });
            Route::get('/4', function () { return view('drumeo.lead-gen.drum-fills.lessons.4'); });
            Route::get('/5', function () { return view('drumeo.lead-gen.drum-fills.lessons.5'); });
        }
    );
    Route::group(['prefix' => 'drum-set-maintenance'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.courses.full.drum-set-maintenance.signup'); });
            Route::group(['prefix' => 'course-index'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.courses.full.drum-set-maintenance.lesson-index'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.courses.full.drum-set-maintenance.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.courses.full.drum-set-maintenance.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.courses.full.drum-set-maintenance.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.courses.full.drum-set-maintenance.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.courses.full.drum-set-maintenance.5'); });
                    Route::get('/6', function () { return view('drumeo.lead-gen.courses.full.drum-set-maintenance.6'); });
                    Route::get('/7', function () { return view('drumeo.lead-gen.courses.full.drum-set-maintenance.7'); });
                });
        }
    );
    Route::group(['prefix' => 'drum-technique-made-easy'],
        function () {
            Route::get('/1-five-technique-myths/', function () { return view('drumeo.lead-gen.drum-technique-made-easy.lessons.1'); });
            Route::get('/2-massive-technique-fails/', function () { return view('drumeo.lead-gen.drum-technique-made-easy.lessons.2'); });
            Route::get('/3-the-most-important-technique/', function () { return view('drumeo.lead-gen.drum-technique-made-easy.lessons.3'); });
            Route::get('/testimonials/', function () { return view('drumeo.products.drum-technique-made-easy-testimonials'); });
        }
    );
    Route::group(['prefix' => 'faster'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.faster.signup'); });
            Route::get('/lessons/', function () { return view('drumeo.lead-gen.faster.lesson-grid'); });
            Route::get('/1', function () { return view('drumeo.lead-gen.faster.lessons.1'); });
            Route::get('/2', function () { return view('drumeo.lead-gen.faster.lessons.2'); });
            Route::get('/3', function () { return view('drumeo.lead-gen.faster.lessons.3'); });
            Route::get('/4', function () { return view('drumeo.lead-gen.faster.lessons.4'); });
            Route::get('/5', function () { return view('drumeo.lead-gen.faster.lessons.5'); });
            Route::get('/6', function () { return view('drumeo.lead-gen.faster.lessons.6'); });
            Route::get('/7', function () { return view('drumeo.lead-gen.faster.lessons.7'); });
            Route::get('/8', function () { return view('drumeo.lead-gen.faster.lessons.8'); });
            Route::get('/9', function () { return view('drumeo.lead-gen.faster.lessons.9'); });
            Route::get('/10', function () { return view('drumeo.lead-gen.faster.lessons.10'); });
        }
    );
    Route::group(['prefix' => 'gavins-grooves'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.signup'); });
            Route::group(['prefix' => 'course-index'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.lesson-index'); });
                    Route::get('/1-intro', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.1'); });
                    Route::get('/2-mother-child-divided', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.2'); });
                    Route::get('/3-halo', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.3'); });
                    Route::get('/4-sound-of-muzak', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.4'); });
                    Route::get('/5-futile', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.5'); });
                    Route::get('/6-anesthetize', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.6'); });
                    Route::get('/7-life', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.7'); });
                    Route::get('/8-conclusion', function () { return view('drumeo.lead-gen.courses.full.gavins-grooves.8'); });
                });
        }
    );
    Route::get('/get-faster', function () { return view('drumeo.lead-gen.faster.signup-alt'); });
    Route::get('/get-faster-drums', function () { return view('drumeo.lead-gen.faster.signup-alt'); });
    Route::group(['prefix' => 'getting-started'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.getting-started.signup'); });
            Route::get('/thank-you/', function () { return view('drumeo.lead-gen.getting-started.thank-you'); });
            Route::get('/lessons/', function () { return view('drumeo.lead-gen.getting-started.lesson-grid'); });
            Route::get('/1-setting-up-your-drums', function () { return view('drumeo.lead-gen.getting-started.lessons.1'); });
            Route::get('/2-tuning-your-drums', function () { return view('drumeo.lead-gen.getting-started.lessons.2'); });
            Route::get('/3-holding-your-drumsticks', function () { return view('drumeo.lead-gen.getting-started.lessons.3'); });
            Route::get('/4-reading-drum-notation', function () { return view('drumeo.lead-gen.getting-started.lessons.4'); });
            Route::get('/5-basic-counting', function () { return view('drumeo.lead-gen.getting-started.lessons.5'); });
            Route::get('/6-your-first-beat', function () { return view('drumeo.lead-gen.getting-started.lessons.6'); });
            Route::get('/7-your-first-fill', function () { return view('drumeo.lead-gen.getting-started.lessons.7'); });
            Route::get('/8-using-a-metronome', function () { return view('drumeo.lead-gen.getting-started.lessons.8'); });
            Route::get('/9-your-first-song', function () { return view('drumeo.lead-gen.getting-started.lessons.9'); });
            Route::get('/10-practice-routine', function () { return view('drumeo.lead-gen.getting-started.lessons.10'); });
            Route::get('/10-practice', function () { return view('drumeo.lead-gen.getting-started.lessons.10-alt'); });
            Route::get('/checking-in', function () { return view('drumeo.lead-gen.getting-started.lessons.checking-in'); });
            Route::get('/great-news', function () { return view('drumeo.lead-gen.getting-started.lessons.great-news'); });
        }
    );
    Route::group(['prefix' => 'free-playalongs'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.free-playalongs.signup'); });
            Route::group(['prefix' => 'songs'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.free-playalongs.unlocked'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.free-playalongs.songs.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.free-playalongs.songs.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.free-playalongs.songs.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.free-playalongs.songs.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.free-playalongs.songs.5'); });
                    Route::get('/6', function () { return view('drumeo.lead-gen.free-playalongs.songs.6'); });
                    Route::get('/7', function () { return view('drumeo.lead-gen.free-playalongs.songs.7'); });
                    Route::get('/8', function () { return view('drumeo.lead-gen.free-playalongs.songs.8'); });
                    Route::get('/9', function () { return view('drumeo.lead-gen.free-playalongs.songs.9'); });
                });
        }
    );
    Route::group(['prefix' => 'metal-playalongs'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.metal-playalongs.signup'); });
            Route::group(['prefix' => 'songs'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.metal-playalongs.unlocked'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.metal-playalongs.songs.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.metal-playalongs.songs.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.metal-playalongs.songs.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.metal-playalongs.songs.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.metal-playalongs.songs.5'); });
                    Route::get('/6', function () { return view('drumeo.lead-gen.metal-playalongs.songs.6'); });
                    Route::get('/7', function () { return view('drumeo.lead-gen.metal-playalongs.songs.7'); });
                    Route::get('/8', function () { return view('drumeo.lead-gen.metal-playalongs.songs.8'); });
                    Route::get('/9', function () { return view('drumeo.lead-gen.metal-playalongs.songs.9'); });
                });
        }
    );
    Route::group(['prefix' => 'grooves-of-john-bonham'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.signup'); });
            Route::group(['prefix' => 'lessons'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.unlocked'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.5'); });
                    Route::get('/6', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.6'); });
                    Route::get('/7', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.7'); });
                    Route::get('/8', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.8'); });
                    Route::get('/9', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.9'); });
                    Route::get('/10', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.10'); });
                    Route::get('/11', function () { return view('drumeo.lead-gen.grooves-of-john-bonham.lessons.11'); });
                });
        }
    );
    Route::get('/getting-started-drums', function () { return view('drumeo.lead-gen.getting-started.signup-alt'); });
    Route::group(['prefix' => 'hand-technique'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.hand-technique.signup'); });
            Route::group(['prefix' => 'lessons'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.hand-technique.lesson-grid'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.hand-technique.lessons.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.hand-technique.lessons.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.hand-technique.lessons.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.hand-technique.lessons.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.hand-technique.lessons.5'); });
                    Route::get('/6', function () { return view('drumeo.lead-gen.hand-technique.lessons.6'); });
                });
        }
    );
    Route::group(['prefix' => 'linear-drumming'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.linear-drumming.signup'); });
            Route::get('/lessons', function () { return view('drumeo.lead-gen.linear-drumming.lesson-grid'); });
            Route::get('/1-about', function () { return view('drumeo.lead-gen.linear-drumming.lessons.1'); });
            Route::get('/2-dance-pop', function () { return view('drumeo.lead-gen.linear-drumming.lessons.2'); });
            Route::get('/3-rock-tom', function () { return view('drumeo.lead-gen.linear-drumming.lessons.3'); });
            Route::get('/4-gospel', function () { return view('drumeo.lead-gen.linear-drumming.lessons.4'); });
            Route::get('/5-metal', function () { return view('drumeo.lead-gen.linear-drumming.lessons.5'); });
            Route::get('/next-level', function () { return view('drumeo.lead-gen.linear-drumming.lessons.next-level'); });
        }
    );
    Route::group(['prefix' => 'michael-jackson-grooves'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.signup'); });
            Route::group(['prefix' => 'course-index'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.lesson-index'); });
                    Route::get('/1-intro', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.1'); });
                    Route::get('/2-wannabestartin', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.2'); });
                    Route::get('/3-smoothcriminal', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.3'); });
                    Route::get('/4-billiejean', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.4'); });
                    Route::get('/5-humannature', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.5'); });
                    Route::get('/6-beatit', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.6'); });
                    Route::get('/7-threatened', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.7'); });
                    Route::get('/8-thriller', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.8'); });
                    Route::get('/9-workingdayandnight', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.9'); });
                    Route::get('/10-ontheroad', function () { return view('drumeo.lead-gen.courses.full.michael-jackson-grooves.10'); });
                });
        }
    );
    Route::group(['prefix' => 'must-know-grooves'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.signup'); });
            Route::group(['prefix' => 'course-index'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.lesson-index'); });
                    Route::get('/1-intro', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.1'); });
                    Route::get('/2-shuffle', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.2'); });
                    Route::get('/3-lindybeat', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.3'); });
                    Route::get('/4-motown', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.4'); });
                    Route::get('/5-latin', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.5'); });
                    Route::get('/6-vacationrhythms', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.6'); });
                    Route::get('/7-secondline', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.7'); });
                    Route::get('/8-socalpunk', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.8'); });
                    Route::get('/9-mozambiquesongo', function () { return view('drumeo.lead-gen.courses.full.must-know-grooves.9'); });
                });
        }
    );
    Route::group(['prefix' => 'rock-drumming-masterclass'],
        function () {
            Route::get('/most-underrated-drummer', function () { return view('drumeo.lead-gen.rock-drumming-masterclass.lessons.1'); });
            Route::get('/most-important-rock-drum-tips', function () { return view('drumeo.lead-gen.rock-drumming-masterclass.lessons.2'); });
            Route::get('/epic-drum-video', function () { return view('drumeo.lead-gen.rock-drumming-masterclass.lessons.3'); });
            Route::get('/testimonials/', function () { return view('drumeo.products.rdm-testimonials'); });
        }
    );
    Route::group(['prefix' => 'subdivision-challenge'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.courses.full.subdivision-challenge.signup'); });
            Route::group(['prefix' => 'course-index'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.courses.full.subdivision-challenge.lesson-index'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.courses.full.subdivision-challenge.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.courses.full.subdivision-challenge.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.courses.full.subdivision-challenge.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.courses.full.subdivision-challenge.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.courses.full.subdivision-challenge.5'); });
                });
        }
    );
    Route::group(['prefix' => 'sucherman-sound'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.courses.full.sucherman-sound.signup'); });
            Route::group(['prefix' => 'course-index'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.courses.full.sucherman-sound.lesson-index'); });
                    Route::get('/1-good-sounding', function () { return view('drumeo.lead-gen.courses.full.sucherman-sound.1'); });
                    Route::get('/2-hi-hats', function () { return view('drumeo.lead-gen.courses.full.sucherman-sound.2'); });
                    Route::get('/3-bass-snare', function () { return view('drumeo.lead-gen.courses.full.sucherman-sound.3'); });
                    Route::get('/4-elevating-sound', function () { return view('drumeo.lead-gen.courses.full.sucherman-sound.4'); });
                    Route::get('/5-shift-focus', function () { return view('drumeo.lead-gen.courses.full.sucherman-sound.5'); });
                });
        }
    );
    Route::group(['prefix' => 'ultimate-toolbox'],
        function () {
            Route::get('/', function () { return view('drumeo.lead-gen.ultimate-toolbox.signup'); });
            Route::get('/catalogue', function () { return view('drumeo.lead-gen.ultimate-toolbox.catalogue'); });
            Route::group(['prefix' => 'gsotd'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lesson-grid'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.5'); });
                    Route::get('/6', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.6'); });
                    Route::get('/7', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.7'); });
                    Route::get('/8', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.8'); });
                    Route::get('/9', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.9'); });
                    Route::get('/10', function () { return view('drumeo.lead-gen.ultimate-toolbox.getting-started.lessons.10'); });
                });
            Route::group(['prefix' => '5pa'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lesson-grid'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lessons.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lessons.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lessons.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lessons.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lessons.5'); });
                });
            Route::group(['prefix' => 'bdbc'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lesson-grid'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lessons.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lessons.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lessons.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lessons.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lessons.5'); });
                    Route::get('/6', function () { return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lessons.6'); });
                    Route::get('/7', function () { return view('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lessons.7'); });
                });
            Route::group(['prefix' => 'fwtgf'],
                function () {
                    Route::get('/', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lesson-grid'); });
                    Route::get('/1', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.1'); });
                    Route::get('/2', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.2'); });
                    Route::get('/3', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.3'); });
                    Route::get('/4', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.4'); });
                    Route::get('/5', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.5'); });
                    Route::get('/6', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.6'); });
                    Route::get('/7', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.7'); });
                    Route::get('/8', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.8'); });
                    Route::get('/9', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.9'); });
                    Route::get('/10', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.10'); });
                    Route::get('/11', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.11'); });
                    Route::get('/12', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.12'); });
                    Route::get('/13', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.13'); });
                    Route::get('/14', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.14'); });
                    Route::get('/15', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.15'); });
                    Route::get('/16', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.16'); });
                    Route::get('/17', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.17'); });
                    Route::get('/18', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.18'); });
                    Route::get('/19', function () { return view('drumeo.lead-gen.ultimate-toolbox.fastest-way-to-get-faster.lessons.19'); });
                });
            Route::get('/mcsa', function () { return view('drumeo.lead-gen.ultimate-toolbox.make-cheap-sound-amazing.lesson-page'); });
            Route::get('/urfd', function () { return view('drumeo.lead-gen.ultimate-toolbox.useful-rudiments.lesson-page'); });
            Route::get('/htls', function () { return view('drumeo.lead-gen.ultimate-toolbox.how-to-learn-songs.lesson-page'); });
            Route::get('/dodt', function () { return view('drumeo.lead-gen.ultimate-toolbox.dictionary.lesson-page'); });
        }
    );

    Route::get('/courses/{slug}', function ($root, $slug) { return view('drumeo.lead-gen.courses.' . $slug); });
    Route::get('/shows/{slug}', function ($root, $slug) { return view('drumeo.lead-gen.shows.' . $slug); });

    Route::get('/birthday-gifts/', function () { return view('drumeo.lead-gen.gift-guide.birthday-guide'); });
    Route::get('/christmas-gift-guide/', function () { return view('drumeo.lead-gen.gift-guide.christmas-guide'); });
    Route::get('/click/', function () { return view('drumeo.lead-gen.pages.click'); });
    Route::get('/druminar/coming-back-to-the-drums', function () { return view('drumeo.lead-gen.webinar.coming-back-to-the-drums'); });
    Route::get('/druminar/coming-back-to-the-drums/june-12-live-event', function () { return view('drumeo.lead-gen.webinar.event'); });
    Route::get('/fathers-day-gifts/', function () { return view('drumeo.lead-gen.gift-guide.fathers-day-guide'); });
    Route::get('/for-teachers/teach-drums/', function () { return view('drumeo.lead-gen.pages.teach-drums'); });
    Route::get('/free-drum-lessons/', function () { return view('drumeo.lead-gen.pages.free-drum-lessons'); });
    Route::get('/free-gift/', function () { return view('drumeo.lead-gen.free-gift.free-gift'); });
    Route::get('/gift-guide/', function () { return view('drumeo.lead-gen.gift-guide.new-years-guide'); });
    Route::get('/new-years-gift-guide/', function () { return view('drumeo.lead-gen.gift-guide.new-years-guide'); });
    Route::get('/quick-drummer-survey/', function () { return view('drumeo.lead-gen.pages.quick-drummer-survey'); });
    Route::get('/teach-a-beginner/', function () { return view('drumeo.lead-gen.pages.teach-a-beginner'); });
    Route::get('/teach-a-beginner/lessons/', function () { return view('drumeo.lead-gen.pages.teach-a-beginner-lessons'); });
    Route::get('/thankyou/', function () { return view('drumeo.lead-gen.pages.thank-you'); });
    Route::get('/thank-you/', function () { return view('drumeo.lead-gen.pages.thank-you-alt'); });
    Route::get('/30-day-drummer-unsubscribe/', function () { return view('drumeo.lead-gen.pages.30-day-drummer-unsubscribe'); });
    Route::get('/30-day-drummer-subscribe/', function () { return view('drumeo.lead-gen.pages.30-day-drummer-subscribe'); });
    Route::get('/subscribed/', function () { return view('drumeo.lead-gen.pages.subscribed'); });
    Route::get('/confirming/', function () { return view('drumeo.lead-gen.pages.confirming'); });
    Route::get('/lets-stay-together/', function () { return view('drumeo.lead-gen.pages.lets-stay-together'); });
    Route::get('/welcome-party/', function () { return view('drumeo.lead-gen.pages.welcome-party'); });
    Route::get('/2-million/', function () { return view('drumeo.lead-gen.pages.2-million'); });
    Route::get('/awards-giveaway/', function () { return view('drumeo.lead-gen.pages.awards-giveaway'); });
    Route::get('/recitals/', function () { return view('drumeo.lead-gen.pages.recitals'); });
    Route::get('/lifetime-members-masterclass/', function () { return view('drumeo.lead-gen.pages.lifetime-members-masterclass'); });
    Route::get('/30-day-drummer-live/', function () { return view('drumeo.lead-gen.pages.30-day-drummer-live'); });
    Route::get('/awards/', function () { return view('drumeo.lead-gen.pages.awards'); });
    Route::get('/weeklyemail/', function () { return view('drumeo.lead-gen.blog-forms.weeklyemail'); });
    Route::get('/weekly-email/', function () { return view('drumeo.lead-gen.blog-forms.weekly-email'); });
    Route::get('/fwtgf-blog/', function () { return view('drumeo.lead-gen.blog-forms.fwtgf-blog'); });
    Route::get('/40s-blog/', function () { return view('drumeo.lead-gen.blog-forms.40s-blog'); });
    Route::get('/gsd-blog/', function () { return view('drumeo.lead-gen.blog-forms.gsd-blog'); });
    Route::get('/gojb-blog/', function () { return view('drumeo.lead-gen.blog-forms.gojb-blog'); });
    Route::get('/fpa-blog/', function () { return view('drumeo.lead-gen.blog-forms.fpa-blog'); });
});
