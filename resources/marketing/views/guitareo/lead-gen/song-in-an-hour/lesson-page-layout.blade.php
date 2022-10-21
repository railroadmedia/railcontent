@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>@hasSection('title') @yield('title') @endif | 1-Hour Challenge</title>
    <meta name="description" content="Rob Scallon will lead you on a guitar adventure with 9 free videos to gain the fundamentals, transition between chords, and play a full song from start to finish. Are you up for the challenge?"/>

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/og-image.jpg">
    <meta property="og:title" content="Play Your First Song On The Guitar | 1-Hour Challenge">
    <meta property="og:description" content="Play your first song on the guitar, start to finish, in an hour -- even if you’ve never played before.">
    <meta property="og:url" content="https://www.guitareo.com/song-in-an-hour/">
    <link rel="stylesheet" href="/marketing/parcel/guitareo/song-in-an-hour.css">
    <style>
        .reveal-overlay {background: linear-gradient(180deg, rgba(1, 7, 19, 0.9), #10052b);}
    </style>
@stop

@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function (e) {

            $(document).foundation();

            console.log(Cookies.get('song_in_an_hour_progress'));

            var songInAnHourProgress = {};

            if (Cookies.get('song_in_an_hour_progress') !== undefined) {
                songInAnHourProgress = JSON.parse(Cookies.get('song_in_an_hour_progress'))
            }

            if (songInAnHourProgress.seconds_passed === undefined) {
                songInAnHourProgress.seconds_passed = 0;
            }

            updateProgressPercent(songInAnHourProgress);

            console.log(songInAnHourProgress);

            // lesson dropdown
            $('.assignment-row .fa-angle-down').click(function() {
                $(this).parent().parent().toggleClass('active');
            });

            // start button
            $('.start-challenge-button').click(function() {
                songInAnHourProgress.song_in_an_hour_challenge = 'started';
                $(this).addClass('hidden');
                $('.trophy-progress-bar').removeClass('hidden');

                saveCookie(songInAnHourProgress);
            });

            // on page load, if the challenge is started or paused, start/continue the timer
            $('.countdown-timer-minutes').html(pad(Math.floor(songInAnHourProgress.seconds_passed / 60), 2));
            $('.countdown-timer-seconds').html(pad(songInAnHourProgress.seconds_passed % 60, 2));

            // second timer
            var secondsTimer = setInterval(function () {
                if (songInAnHourProgress.song_in_an_hour_challenge === 'paused' ||
                    songInAnHourProgress.song_in_an_hour_challenge === 'completed' ||
                    songInAnHourProgress.song_in_an_hour_challenge === undefined) {
                    return;
                }

                songInAnHourProgress.seconds_passed += 1;

                saveCookie(songInAnHourProgress);

                $('.countdown-timer-minutes').html(pad(Math.floor(songInAnHourProgress.seconds_passed / 60), 2));
                $('.countdown-timer-seconds').html(pad(songInAnHourProgress.seconds_passed % 60, 2));
                $('.share-time').attr("href", ("https://twitter.com/intent/tweet?url=https://www.guitareo.com/song-in-an-hour/&text=I%20played%20my%20first%20song%20on%20the%20guitar%20--%20and%20it%20only%20took%20me%20" + pad(Math.floor(songInAnHourProgress.seconds_passed / 60), 2) + ":" + pad(songInAnHourProgress.seconds_passed % 60, 2) + ".%20Now%20it%E2%80%99s%20your%20turn.%20Try%20the%20Song%20In%20An%20Hour%20Challenge!"));
            }, 1000);

            // pause
            $('#pausePlayButton').click(function() {
                var pause = $(this).hasClass('fa-pause');

                if (pause) {
                    $(this).toggleClass('fa-play fa-pause');

                    songInAnHourProgress.song_in_an_hour_challenge = 'paused';
                } else {
                    $(this).toggleClass('fa-pause fa-play');

                    songInAnHourProgress.song_in_an_hour_challenge = 'started';
                }

                saveCookie(songInAnHourProgress);
            });

            // complete assignment
            $('.complete-button').click(function (ev) {
                ev.preventDefault();
                ev.stopPropagation();

                if (songInAnHourProgress[$(this).data('content-id')] === 'completed') {
                    delete songInAnHourProgress[$(this).data('content-id')];
                    $(this).removeClass('active');
                } else {
                    songInAnHourProgress[$(this).data('content-id')] = 'completed';
                    $(this).addClass('active');
                }

                // if the timer is not already started, start it
                if (songInAnHourProgress.song_in_an_hour_challenge === 'paused' ||
                    songInAnHourProgress.song_in_an_hour_challenge === undefined) {

                    $('.start-challenge-button').trigger('click');
                }

                saveCookie(songInAnHourProgress);
            });

            // complete lesson
            $('.complete-lesson').click(function (ev) {
                ev.preventDefault();
                ev.stopPropagation();

                if ($(this).data('content-id') === 'lesson_7' && songInAnHourProgress[$(this).data('content-id')] !== 'completed') {
                    songInAnHourProgress['lesson_1'] = 'completed';
                    songInAnHourProgress['lesson_2'] = 'completed';
                    songInAnHourProgress['lesson_3'] = 'completed';
                    songInAnHourProgress['lesson_4'] = 'completed';
                    songInAnHourProgress['lesson_5'] = 'completed';
                    songInAnHourProgress['lesson_6'] = 'completed';
                    songInAnHourProgress['lesson_7'] = 'completed';

                    $(this).find('.button').addClass('complete').find('.complete-button-text').text('Completed!');
                    $(this).find('.button i.fa-check').removeClass('opacity-0');

                    $('.next-lesson-button a').removeClass('inactive');
                } else if (songInAnHourProgress[$(this).data('content-id')] === 'completed') {
                    delete songInAnHourProgress[$(this).data('content-id')];

                    $(this).find('.button').removeClass('complete').find('.complete-button-text').text('Mark As Complete');
                    $(this).find('.button i.fa-check').addClass('opacity-0');

                    $('.next-lesson-button a').addClass('inactive');
                } else {
                    songInAnHourProgress[$(this).data('content-id')] = 'completed';

                    $(this).find('.button').addClass('complete').find('.complete-button-text').text('Completed!');
                    $(this).find('.button i.fa-check').removeClass('opacity-0');

                    $('.next-lesson-button a').removeClass('inactive');

                    // if the timer is not already started, start it
                    if (songInAnHourProgress.song_in_an_hour_challenge === 'paused' ||
                        songInAnHourProgress.song_in_an_hour_challenge === undefined) {

                        $('.start-challenge-button').trigger('click');
                    }
                }

                console.log(songInAnHourProgress);

                saveCookie(songInAnHourProgress);

                updateProgressPercent(songInAnHourProgress);

                // also mark all the assigments on the page complete
                $('.complete-button').each(function(index, element) {
                    if (songInAnHourProgress[$(element).data('content-id')] !== 'completed') {
                        $(element).trigger('click').addClass('active');
                    }
                });

                // if complete, setup and open the complete modal
                if (getProgressPercent(songInAnHourProgress) === 100 &&
                    window.location.pathname !== '/song-in-an-hour/writing-a-melody' &&
                    window.location.pathname !== '/song-in-an-hour/next-steps') {

                    // pause
                    $('#pausePlayButton').toggleClass('fa-play fa-pause');

                    songInAnHourProgress.song_in_an_hour_challenge = 'completed';

                    saveCookie(songInAnHourProgress);

                    if (getProgressPercent(songInAnHourProgress.seconds_passed) <= 3600) {
                        $('.completed-in-time-message').removeClass('hidden');
                    } else {
                        $('.completed-after-time-message').removeClass('hidden');
                    }

                    // open modal
                    $('#complete').foundation('open');

                    var challengeDuration = songInAnHourProgress.seconds_passed / 60;
                    dataLayer.push({
                        'event': 'challengeDuration',
                        'minutes': challengeDuration
                    });
                }
            });

            // reset challenge
            $('.reset-challenge-button').click(function (ev) {
                songInAnHourProgress = {};

                saveCookie(songInAnHourProgress);
            });
        });

        function pad(num, size) {
            num = num.toString();
            while (num.length < size) num = "0" + num;
            return num;
        }

        function saveCookie(songInAnHourProgressObject) {
            Cookies.set(
                'song_in_an_hour_progress',
                JSON.stringify(songInAnHourProgressObject),
                { expires: 30, path: '/'}
            );
        }

        function updateProgressPercent(songInAnHourProgressObject) {
            var percentComplete = getProgressPercent(songInAnHourProgressObject);

            $('.progress-percent-number').text(percentComplete);
            if (percentComplete > 10) {
                $('.trophy-progress').css({"-webkit-transform":"translateX(" + (percentComplete - 100) +"%)"});
            } else {
                $('.trophy-progress').css({"-webkit-transform":"translateX(" + (12 - 100) +"%)"});
            }
        }

        function getProgressPercent(songInAnHourProgressObject) {
            var totalToComplete = 7;
            var totalCompleted = 0;

            if (songInAnHourProgressObject.lesson_1 === 'completed') totalCompleted++;
            if (songInAnHourProgressObject.lesson_2 === 'completed') totalCompleted++;
            if (songInAnHourProgressObject.lesson_3 === 'completed') totalCompleted++;
            if (songInAnHourProgressObject.lesson_4 === 'completed') totalCompleted++;
            if (songInAnHourProgressObject.lesson_5 === 'completed') totalCompleted++;
            if (songInAnHourProgressObject.lesson_6 === 'completed') totalCompleted++;
            if (songInAnHourProgressObject.lesson_7 === 'completed') totalCompleted++;

            return Math.round(totalCompleted / totalToComplete * 100);
        }
    </script>
    <script src="/marketing/parcel/guitareo/modal-autoplay.js"></script>
@stop

@section('body')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7" style="background-image: url(https://cdn.musora.com/image/fetch/w_300,q_60,q_auto:best/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/star-pattern.svg);background-color:#000718;">
        <div class="container mx-auto clearfix" style="max-width:940px">
            <div class="text-center sm:px-3">
                <img class="logo mx-auto inline-block w-40 sm:w-56" src="https://cdn.musora.com/image/fetch/w_448,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/logo-purple.png">
                <div class="video-row relative my-4 sm:my-7">
                    @hasSection('prev-thumb')
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translate(-100%, -50%); left: -10%;width: 80%;" src="@yield('prev-thumb')">
                    @endif

                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full inset-0" src="//player.vimeo.com/video/@yield('video')" frameborder="0" allowfullscreen></iframe>
                    </div>

                    @hasSection('next-thumb')
                        <img class="hidden lg:block absolute top-1/2 opacity-30" style="transform: translateY(-50%);left: 110%;width: 80%;" src="@yield('next-thumb')">
                    @endif
                </div>
            </div>
            <div class="title-header-interaction text-center">
                <div class="px-2 md:px-3">
                    <h3><strong>@hasSection('title') @yield('title') @endif</strong></h3>
                    @hasSection('lesson-number')
                        <p class="text-yellow mt-1 sm:mt-2">@yield('lesson-number')</p>
                    @endif
                </div>
            </div>
            <div class="text-center mt-3 sm:mt-7 clearfix lesson-buttons">
                <div class="mb-2 sm:mb-0 w-full sm:w-1/4 float-left px-2 md:px-3">
                    @hasSection('previous')
                        <a class="button outline block" href="@yield('previous')">
                            <i class="fas fa-chevron-left"></i> Prev
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>

                @php
                    $lessonNumberString = 'lesson_' . $lessonNumber;
                @endphp

                <div class="complete-lesson @if($lessonNumber === '7') complete-all @endif mb-2 sm:mb-0 w-full sm:w-2/4 float-left px-2 md:px-3"
                     data-content-id="lesson_{{ $lessonNumber }}">
                    @hasSection('lesson-number')
                        <a class="button block {{ ($songInAnHourProgress->$lessonNumberString ?? null) == 'completed' ? 'complete' : '' }}" href="#">
                            @if(($songInAnHourProgress->$lessonNumberString ?? null) == 'completed')
                                <span class="complete-button-text">Completed!</span>
                            @else
                                @if($lessonNumber === '7')
                                    <span class="complete-button-text">Complete Challenge</span>
                                @else
                                    <span class="complete-button-text">Mark As Complete</span>
                                @endif
                            @endif
                            <i class="fas fa-check @if(($songInAnHourProgress->$lessonNumberString ?? null) == 'completed') opacity-100 @else opacity-0 @endif "></i>
                        </a>
                    @endif
                </div>
                <div class="w-full sm:w-1/4 float-left px-2 md:px-3 next-lesson-button">
                    @hasSection('next')
                        <a class="button outline block {{ ($songInAnHourProgress->$lessonNumberString ?? null) == 'completed' ? '' : 'inactive' }}" href="@yield('next')">
                            @hasSection('next-text')
                                @yield('next-text')
                            @else
                                Next
                            @endif
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="hidden sm:inline">&nbsp;</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="px-3 py-6 sm:py-10">
        <div class="container mx-auto clearfix" style="max-width:920px">
            <div class="text-left lesson-text">
                @hasSection('assignments')
                    <h4 class="mb-1 sm:mb-3"><strong>Assignments</strong></h4>
                    @yield('assignments')
                @endif
                @hasSection('assets')
                    <h4 class="mb-1 sm:mb-3 mt-12"><strong>Assets</strong></h4>
                    @yield('assets')
                @endif
            </div>
        </div>
    </div>
    <div class="w-full text-white px-2 sm:px-3 py-3 sm:py-4 text-center sticky bottom-0 bg-purple" style="z-index: 2147483002;">
        <div class="container mx-auto" style="max-width:890px">
            @if(!empty($bonus))
                {{-- completed --}}

                <div class="py-1">
                    <p class="leading-tight inline-block align-middle lg:w-full"><strong class="font-black">CONTINUE YOUR JOURNEY <i class="fas fa-long-arrow-right text-yellow mx-1"></i><br class="inline lg:hidden"> SAVE 40% ON GUITARQUEST</strong></p>
                    <a href="/guitar-quest-discount" class="button inline-block align-middle lg:mt-3 px-4 sm:px-5 md:px-12">Click Here &raquo;</a>
                </div>
            @else
                {{-- started --}}

                <div class="flex items-center">

                    <img class="hidden sm:inline-block w-36 mr-6" src="https://cdn.musora.com/image/fetch/w_290,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/logo-white.png">
                    <span class="text-center countdown-timer whitespace-nowrap">
                        <span class="countdown-timer-minutes">00</span>:<span class="countdown-timer-seconds">00</span>
                    </span>
                    <i id="pausePlayButton" class="fas {{ ($songInAnHourProgress->song_in_an_hour_challenge ?? null) == 'started' ? 'fa-pause' : 'fa-play' }} text-yellow ml-4 sm:ml-6 mr-3 sm:mr-4 cursor-pointer"></i>
                    <i data-open="resetModal" class="fas fa-undo mr-2 sm:mr-5 cursor-pointer text-yellow"></i>

                    {{-- progress bar --}}
                    <div class="flex flex-row trophy-progress-bar rounded-full overflow-hidden flex-row items-stretch w-full {{ !empty($songInAnHourProgress->song_in_an_hour_challenge ?? null) ? '' : 'hidden' }}">
                        <div class="flex flex-col trophy-progress-cutoff border-4 sm:border-8 overflow-hidden z-10 rounded-full relative w-full sm:w-11/12 border-purple">
                            <span class="rounded-full border-4 w-full h-full absolute top-0 left-0 z-10 border-purple-dark"></span>

                            @hasSection('lesson-number')
                                <div data-current-progress="0" class="trophy-progress transition-transform duration-200 ease-in-out rounded-full relative bg-yellow" style="transform: translateX(-99%);">
                                    <p class="progress-percent absolute top-1/2 right-0 px-1 sm:px-2 lg:px-3 text-purple-dark opacity-0 md:opacity-100">
                                        <strong><span class="progress-percent-number"></span>%</strong>
                                    </p>
                                </div>
                            @endif
                        </div>
                        <div class="hidden sm:flex flex-col trophy relative px-5 items-center justify-center">
                            <i class="fas fa-trophy-alt z-10 text-2xl transform rotate-12 text-yellow"></i>
                        </div>
                    </div>

                    {{-- start button --}}
                    <a class="button w-full start-challenge-button cursor-pointer block {{ empty($songInAnHourProgress->song_in_an_hour_challenge ?? null) ? '' : 'hidden' }}">
                        Start Challenge
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="reveal-overlay">
        <div class="reveal complete-modal" id="complete" data-reveal data-reset-on-close="true">
            <div class="container mx-auto text-center text-white">

                {{-- if completed under 1 hour --}}
                <div class="completed-in-time-message hidden">
                    <h2>
                        <i class="fas fa-trophy-alt transform rotate-12 text-yellow"></i>
                        <strong>Success!</strong>
                    </h2>
                    <p class="mt-3 mb-4 sm:mt-5 sm:mb-8">
                        Congratulations on completing<br class="inline sm:hidden"> the song in an hour challenge!
                    </p>
                </div>

                {{-- if completed after 1 hour --}}
                <div class="completed-after-time-message hidden">
                    <h2>
                        <i class="fas fa-trophy-alt transform rotate-12 text-yellow"></i>
                        <strong>Mission Complete</strong>
                    </h2>
                    <p class="mt-3 mb-4 sm:mt-5 sm:mb-8">
                        It took a bit extra, but you did it!<br class="inline sm:hidden">
                        Congratulations on playing your first song!
                    </p>
                </div>

                <p>My time:</p>
                <span class="text-center countdown-timer whitespace-nowrap">
                    <span class="countdown-timer-minutes">00</span>:<span class="countdown-timer-seconds">00</span>
                </span>

                <a href="/song-in-an-hour/success" class="button inline-block mt-5 sm:mt-12 mb-7 sm:mb-28 px-5 sm:px-12">Next Step: Get 2 Free Bonus Videos</a>
                <h5><strong>Share the challenge:</strong></h5>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://www.guitareo.com/song-in-an-hour/" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble twitter share-time" href="" style="background:#1DA1F2;"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
    <div class="reveal-overlay">
        <div class="reveal complete-modal" id="resetModal" data-reveal data-reset-on-close="true">
            <div class="container mx-auto text-center text-white">
                <h2><i class="fas fa-exclamation-triangle transform text-yellow"></i> <strong>Restart?</strong></h2>
                <p class="my-3 sm:my-5">
                    Please confirm that you'd like to re-start the Song In<br class="hidden sm:inline">
                    An Hour Challenge. Clicking the button below will reset <br class="hidden sm:inline">
                    the timer and restart the challenge at lesson one.</p>
                <a href="/song-in-an-hour/your-challenge/1" class="button reset-challenge-button inline-block px-5 sm:px-12"><i class="fas fa-undo"></i> RESTART THE CHALLENGE</a>
            </div>
        </div>
    </div>
@stop
