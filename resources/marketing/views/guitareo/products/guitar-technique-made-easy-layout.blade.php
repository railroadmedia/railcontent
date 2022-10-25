@extends('guitareo._partial.global-vue-layout')

<?php \App\Analytics\Tracker::trackGTMEProductImpression(); ?>

@section('meta')
    <title>Guitar Technique Made Easy | Guitareo</title>
    <meta name="description" content="Guitar Technique Made Easy is a 26-week online course with Nate Savage.">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/gtme/og-image.jpg" style="display: none;">
    <meta property="og:description" content="Guitar Technique Made Easy is a 26-week online course with Nate Savage.">
    <meta property="og:url" content="https://www.guitareo.com/guitar-technique-made-easy">
@stop()

@section('styles')
    <link href="{{ asset('/marketing/css/guitareo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css" rel="stylesheet">

    <style>
        body {
            background:#000;
        }

        .infusion-submit div {
            display:none;
        }
    </style>
    <link href="{{ asset('assets/marketing/gtme-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}">
@stop()

@section('scripts')
    <script src="/marketing/js/modal.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
    <script src="/marketing/parcel/guitareo/nav-footer.js"></script>
    <script src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Countdown
            $('.tzcd-full').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).foundation();

            // Dropdown for FAQ section
            $('.question-dropdown').on('click', questionDropdown);

            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }

            //modal video swapping
            $('.play-trailer').on('click', function (ev) {
                $("#vimeo2")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('body').on('click', '.reveal-overlay', function () {
                var newSource2 = $("#vimeo2").attr('src').replace("?autoplay=1", "");
                $("#vimeo2").attr('src', newSource2);
            });

            $('#icon-grid .toggle').on('click', function () {
                $('#icon-grid .lesson-descriptions').addClass('active');
                $(this).addClass('active');
            });

            //scrolls up subscriber count
            $('.count').each(function () {
                var thisCountElement = $(this);
                var options = {
                    useEasing: true,
                    useGrouping: true,
                    separator: ',',
                    decimal: '.',
                    prefix: '',
                    suffix: ''
                };
                var demo = new CountUp(
                    thisCountElement.attr('id'), 0, thisCountElement.data('total-count'), 0, 2.5, options
                );

                $(window).scroll(function () {
                    if ($(window).scrollTop() + $(window)
                        .height() + 200 > (thisCountElement.offset().top)) {
                        demo.start();
                    }
                });
            });
            $(window).trigger('scroll');
        });
    </script>
@stop()

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('guitareo._partials.promo-banner', [
                "name" => "Guitar Technique Made Easy",
                "fullPrice" => GuitareoPrices::$GTMEFull,
                "price" => GuitareoPrices::$GTMERegular,
                "noBreadcrumb" => true
            ])
    @hasSection('topbar')
        @yield('topbar')
    @endif

    <header class="hero-header">
        <div class="row xlarge">
            <div class="columns video-wrap">
                <div class="play-video play-trailer"><i class="fas fa-play play-button" data-open="trailer"></i></div>
                <div class="logo">
                    <p><em>Nate Savage's</em></p>
                    <img src="https://guitareo.s3.amazonaws.com/gtme/logo-white.png">
                </div>
            </div>
            {{--<p>Guitar Technique Made Easy is an intimate<br class="hide-for-large">--}}
                {{--26-week online course with Nate Savage.</p>--}}
            <div class="columns button-wrap">
                <p><strong>Your crystal clear path  <br class="hide-for-medium"> to total guitar confidence</strong></p>
                <p style="margin: 10px auto 0; text-transform:uppercase;"></p>

                @hasSection('button-change')
                    @yield('button-change')
                @else
                    <a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['GTME-OCT-2018-SEMESTER' => 1], 'redirect' => '/order']) }}" class="join made-easy" data-product-json='{"GTME-OCT-2018-SEMESTER": 1}'>Get Started &raquo;</a>
                @endif

                <p class="price-info">
                    @hasSection('custom-price')
                        @yield('custom-price')
                    @else
                        @if(GuitareoPrices::$GTMEFull > GuitareoPrices::$GTMERegular)
                            <s>NORMALLY ${{ GuitareoPrices::$GTMEFull }}.</s> &nbsp;<strong style="color:#00BC75;"><u>ONLY ${{ GuitareoPrices::$GTMERegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (GuitareoPrices::$GTMERegular / GuitareoPrices::$GTMEFull))) }}%)
                        @else
                            <strong><u>ONLY ${{ GuitareoPrices::$GTMERegular }}</u></strong>
                        @endif
                    @endif

                        <br><a href="/" class="text-guitareo">(OR FREE WITH A GUITAREO MEMBERSHIP)</a>
                    {{--<br><strong style="color: #f6bd52;">ONLY <span class="tzcd-med">A LIMITED TIME</span> LEFT</strong>--}}
                    <br> <strong>** 90-DAY GUARANTEE **</strong>
                </p>
            </div>
            <div class="reveal large trailer" id="trailer" data-reveal data-reset-on-close="true">
                <div class="flex-video widescreen vimeo">
                    <iframe id="vimeo2" src="//player.vimeo.com/video/249110334" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </header>


    {{--<section class="featured-product">--}}
        {{--<div class="noise-wrap">--}}
            {{--<div class="row">--}}
                {{--<a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['GTME-OCT-2018-SEMESTER' => 1], 'redirect' => '/order']) }}">--}}
                    {{--<img class="logo animated tada delay-2s" src="https://guitareo.s3.amazonaws.com/sales/promos/april/guitar-month-logo.png">--}}
                    {{--<br>--}}
                    {{--<div class="text">--}}
                        {{--<p class="text-left" style="max-width:510px">Celebrate Guitar Month right and brush up on your techniques.--}}
                            {{--<br><br>--}}
                            {{--Guitar Technique Made Easy will improve your existing skills and help you master new ones, for only <s>${{ GuitareoPrices::$GTMEFull }}</s> ${{ GuitareoPrices::$GTMERegular }}! (Save {{ round(100 - (100 * (GuitareoPrices::$GTMERegular / GuitareoPrices::$GTMEFull))) }}%)--}}
                            {{--<br><br>--}}
                            {{--Your guitar deserves to be played freely and effectively, and especially during its own dedicated month!--}}
                            {{--<br></p>--}}

                        {{--<div class="tzcd-big">--}}
                            {{--<div><h1>00</h1> <p>days</p></div>--}}
                            {{--<div><h1>00</h1> <p>hrs</p></div>--}}
                            {{--<div><h1>00</h1> <p>mins</p></div>--}}
                            {{--<div><h1>00</h1> <p>secs</p></div>--}}
                        {{--</div>--}}
                        {{--<div class="join">Get Started &raquo;</div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

    <section class="triple-benefits">
        <div class="row">
            <h1>Guitar Technique Made Easy gives you a <br class="show-for-medium">
                crystal-clear path to total guitar confidence <br class="show-for-medium">
                <strong>so you can play the music you love.</strong></h1>
            @yield('benefits')
        </div>
    </section>

    <section class="better-technique text-center">
        <div class="row">
            <div class="title-text columns">
                <h1>BETTER TECHNIQUE<br class="hide-for-medium"> STARTS HERE</h1>
                <p>Learn the most important guitar techniques so you can build a rock-solid <br
                            class="show-for-medium"> foundation, break bad habits, and achieve total freedom on the guitar.
                </p>
            </div>

            <div class="columns no-padding large-up-3 medium-up-2 small-up-1">
                <div class="tile columns">
                    <div class="thumb"
                            style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 33%, rgba(0, 0, 0, 0.5) 100%), url(https://s3.amazonaws.com/guitareo/gtme/tiles/acoustic-guitar-player2.jpg)center top/cover;">
                        <h1>Master Fundamental Guitar Mechanics</h1></div>
                    <p>Learn to execute perfect strumming technique, open chords, and other foundational skills.</p>
                </div>
                <div class="tile columns">
                    <div class="thumb"
                            style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 33%, rgba(0, 0, 0, 0.5) 100%), url(https://s3.amazonaws.com/guitareo/gtme/tiles/music-theory2.jpg)center top/cover;">
                        <h1>Understand Music Theory</h1></div>
                    <p>Explore the most important components of music theory that apply directly to the guitar.</p>
                </div>
                <div class="tile columns">
                    <div class="thumb"
                            style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 33%, rgba(0, 0, 0, 0.5) 100%), url(https://s3.amazonaws.com/guitareo/gtme/tiles/acoustic-guitar-player-22.jpg)center top/cover;">
                        <h1>Develop Perfect Rhythm Guitar Technique</h1></div>
                    <p>Hone your rhythm guitar skills by learning strumming embellishments, bar chords, 7th chords, and more.</p>
                </div>
                <div class="tile columns">
                    <div class="thumb"
                            style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 33%, rgba(0, 0, 0, 0.5) 100%), url(https://s3.amazonaws.com/guitareo/gtme/tiles/electric-guitar-player2.jpg)center top/cover;">
                        <h1>Perform Essential Lead Guitar Techniques</h1></div>
                    <p>Dive into the world of lead guitar and learn hammer-ons, pull-offs, picking technique, bending, vibrato, and scales.</p>
                </div>
                <div class="tile columns">
                    <div class="thumb"
                            style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 33%, rgba(0, 0, 0, 0.5) 100%), url(https://s3.amazonaws.com/guitareo/gtme/tiles/electric-guitar-solos2.jpg)center top/cover;">
                        <h1>Improvise Melodic Solos</h1></div>
                    <p>Combine your knowledge of music theory and your new lead guitar skills to improvise beautiful solos on the guitar.</p>
                </div>
                <div class="tile columns">
                    <div class="thumb"
                            style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 33%, rgba(0, 0, 0, 0.5) 100%), url(https://s3.amazonaws.com/guitareo/gtme/tiles/play-real-music2.jpg)center top/cover;">
                        <h1>Play Real Music</h1></div>
                    <p>Apply every skill and concept to music so you actually have fun while you make massive progress on the guitar.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="icon-grid">
        <div class="row">
            <div class="title-text columns">
                <h1>Your 26-Week Plan</h1>
                <p>You’ll get immediate access to the full 26-week course to work through at your own pace -- with hand-picked exercises and detailed instructions on what to practice (and for exactly how long).</p>
            </div>
            <div class="columns small-up-1 medium-up-3">
                <div class="columns no-padding grid-item">
                    <div class="columns no-padding medium-2 icon-wrap">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Weekly Lesson Plans</h2>
                        <p>It’s easy to make progress when you know exactly what to do, and when to do it.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns no-padding medium-2 icon-wrap">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Guided Video Lessons</h2>
                        <p>Each lesson will include tips for all levels - so any guitarist can get fast results.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns no-padding medium-2 icon-wrap">
                        <i class="fas fa-music"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Musical Application</h2>
                        <p>Learn at your own pace with Nate Savage’s easy-to-follow video lessons.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns no-padding medium-2 icon-wrap">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>More Effective Practice</h2>
                        <p>Don’t waste your practice time. Only work on the right exercises, at the right time.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns no-padding medium-2 icon-wrap">
                        <i class="fas fa-question"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Play More Songs</h2>
                        <p>You’ll gain the foundational skills you need to play your favorite songs.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns no-padding medium-2 icon-wrap">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Lifetime Access</h2>
                        <p>Even though it’s a structured 26-week course, you’ll have access for life.</p>
                    </div>
                </div>
            </div>
            <div class="lesson-descriptions columns">
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "0",
                "weekTitle" => "Set Up Your Practice Space",
                "weekDescription" => "Get started by setting up an effective practice space so you’re ready to make the most of your practice time."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "0",
                "weekTitle" => "Practice Planner",
                "weekDescription" => "Create a regimented technique practice schedule to set yourself up for maximum success."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "0",
                "weekTitle" => "Practice Warm-Ups",
                "weekDescription" => "Learn some key warm-up exercises that you can use to start off each of your practice sessions."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "1",
                "weekTitle" => "Critical Strumming Mechanics",
                "weekDescription" => "Start with the fundamentals and build perfect strumming technique from the ground up."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "2",
                "weekTitle" => "The All Important… Timing",
                "weekDescription" => "Develop a rock-solid sense of timing by using specific exercises that target your timing problem areas."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "3",
                "weekTitle" => "5 Fundamental Open Major Chords",
                "weekDescription" => "Learn the 5 most important open major chords that you’ll use for the rest of your guitar career."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "4",
                "weekTitle" => "Changing Chords Smoothly",
                "weekDescription" => "Tackle the most common challenge for guitarists and start nailing perfect chord transitions."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "5",
                "weekTitle" => "3 Fundamental Open Minor Chords",
                "weekDescription" => "Add the most important open minor chords to your toolbelt and round out your chord repertoire."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "6",
                "weekTitle" => "Major Keys",
                "weekDescription" => "Decode the foundational elements of music theory by learning how major keys work."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "7",
                "weekTitle" => "Constant Strumming Technique",
                "weekDescription" => "Unlock your creativity on the guitar by learning how to utilize the constant strumming technique."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "8",
                "weekTitle" => "E Major Bar Chord",
                "weekDescription" => "Dive into the world of bar chords and learn how to use proper bar chording technique with the E major shape."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "9",
                "weekTitle" => "A Major Bar Chord",
                "weekDescription" => "Expand your knowledge of bar chords by learning how to use the A major bar chord shape."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "10",
                "weekTitle" => "Changing Major Bar Chords",
                "weekDescription" => "Bring it all together to execute seamless transitions between different bar chord shapes."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "11",
                "weekTitle" => "E & A Minor Bar Chords",
                "weekDescription" => "Broaden your chord library by learning the essential minor bar chords shapes."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "12",
                "weekTitle" => "Changing Bar Chords 2",
                "weekDescription" => "Continue your technique journey by learning how to change between every chord shape you know."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "13",
                "weekTitle" => "Strumming Embellishments",
                "weekDescription" => "Add feel and emotion to your strumming by utilizing simple strumming embellishments."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "14",
                "weekTitle" => "Chord Scales",
                "weekDescription" => "Further your music theory knowledge by gaining a full understanding of this key concept."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "15",
                "weekTitle" => "CAGED Chords",
                "weekDescription" => "Unlock your fretboard by learning a game-changing guitar navigation system."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "16",
                "weekTitle" => "7th Chords",
                "weekDescription" => "Invigorate your playing by learning to use more interesting and exciting chords."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "17",
                "weekTitle" => "Crosspicking",
                "weekDescription" => "Learn how to use crosspicking to add movement and life to your chord progressions."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "18",
                "weekTitle" => "Fingerstyle",
                "weekDescription" => "Build perfect fingerpicking technique by starting with the basics and building a solid foundation."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "19",
                "weekTitle" => "Picking",
                "weekDescription" => "Move into the world of lead guitar and learn proper picking technique."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "20",
                "weekTitle" => "Major Scales… The Key!",
                "weekDescription" => "Merge technique and music theory to learn the most important scale in music."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "21",
                "weekTitle" => "Legato",
                "weekDescription" => "Learn to effectively use hammer-ons and pull-offs together in your guitar playing."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "22",
                "weekTitle" => "Major Pentatonic",
                "weekDescription" => "Unlock the secret to improvising on the guitar using a simple and iconic 5-note scale."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "23",
                "weekTitle" => "Minor Pentatonic",
                "weekDescription" => "Round out your knowledge of scales by learning the forever-useful minor pentatonic scale."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "24",
                "weekTitle" => "Bending",
                "weekDescription" => "Transform your playing by learning how to execute this unique and expressive technique."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "25",
                "weekTitle" => "Major Triads",
                "weekDescription" => "Combine everything you’ve learned to unlock one of the most important concepts in music."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "26",
                "weekTitle" => "Minor Triads",
                "weekDescription" => "Place the last technique puzzle-piece and finally gain full freedom on the guitar!"
                ])
            </div>
            <a class="join made-easy outline toggle">Show All</a>
        </div>
    </section>

    <section class="meet-instructor">
        <div class="row">
            <div class="columns">
                <h1>The History Of<br class="hide-for-medium"> <strong>Nate Savage</strong></h1>
                <p>& The Art Of Creating Better Guitar Lessons</p>
            </div>
        </div>
    </section>

    <section class="instructor-bio">
        <div class="row">
            <p class="columns">
                <span class="first-letter"><img src="https://guitareo.s3.amazonaws.com/gtme/bold-n.png"></span>ate Savage always knew he wanted to share his love for playing the guitar with others. After earning his Music Degree at San Jacinto College and playing hundreds of shows across Canada, the USA, and Europe -- he wanted to find a better way to help guitarists around the world.
                <br><br>
                So in 2009, he connected with Musora Media to start GuitarLessons.com -- a massive library of free online guitar lessons that has since helped more than 20 million guitar players.
                <br><br>
                “I loved playing shows and touring,” Nate said in 2009. “But my heart has always been set on guitar education. I truly believe that playing the guitar can be a life-changing experience, so having the opportunity to create online lessons and help students around the world felt like such a perfect opportunity.”
                <br><br>
                Nate’s most popular videos are built to give beginners an easier way to get started without the friction of private lessons. “8 Guitar Chords You Must Know” has reached more than 4 million views. “Play 10 Songs With 4 Chords”, “5 Essential Strumming Patterns”, and “How To Hold The Guitar” are just a few other examples of videos that have been seen more by more than a million students.
                <br><br>
                Through his online lessons, Nate was able to reach more guitarists than he’d ever imagined and get personal feedback from tens of thousands of YouTube comments and personal emails -- gaining a deeper understanding of where students were having issues, what obstacles were getting in the way, and what was creating the fastest breakthroughs for getting to that next level.
                <br><br>
                More than anything: <strong>it comes down to better technique.</strong>
                <br><br>
                “If you’re a beginner, technique will help you establish the fundamentals so you can make your playing come alive”, Nate says. “And if you’ve been playing for a while, technique is the tool that will help you fill the gaps in your playing so you can express yourself more creatively and without any limitations.”
                <br><br>
                Nate has authored a best-selling DVD set called The Guitar System and leads the way for Guitareo.com, a membership site with step-by-step lessons, jam tracks, and live events. He has developed a proven formula for helping students get started on the guitar and become more complete musicians.
                <br><br>
                And now, through Guitar Technique Made Easy, you’ll have the opportunity to study directly with Nate through his 26-week course.
            </p>
            <div class="columns no-padding medium-4 benefit-row practice">
                <div class="columns float-right">
                    <div class="arrow-outline">
                        <img src="https://guitareo.s3.amazonaws.com/gtme/bubble-gl.png">
                    </div>
                </div>
                <div class="columns text-wrap">
                    <h1 class="count" id="follower-count" data-total-count="6410000">0</h1>
                    <h2>Guitarlessons.com Students</h2>
                </div>
            </div>
            <div class="columns no-padding medium-4 benefit-row play">
                <div class="column">
                    <div class="arrow-outline">
                        <img src="https://guitareo.s3.amazonaws.com/gtme/bubble-subs.png">
                    </div>
                </div>
                <div class="columns text-wrap">
                    <h1 class="count" id="youtube-count" data-total-count="630000">0</h1>
                    <h2>Youtube Subscribers</h2>
                </div>
            </div>
            <div class="columns no-padding medium-4 benefit-row support">
                <div class="columns float-right">
                    <div class="arrow-outline">
                        <img src="https://guitareo.s3.amazonaws.com/gtme/bubble-views.png">
                    </div>
                </div>
                <div class="columns text-wrap">
                    <h1 class="count" id="likes-count" data-total-count="65500000">0</h1>
                    <h2>Guitar Lesson Views</h2>
                </div>
            </div>
        </div>
    </section>

    <div id="testimonials" class="anchor"></div>
    <section class="drummer-credits text-center">
        <div class="row">
            <h1>"Nate is a <strong>natural<br class="hide-for-medium"> born teacher.</strong>"</h1>

            <div class="columns no-padding small-up-1 medium-up-2 drummer-testimonial">
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/holger-strunk.jpg">
                    <p>"With Guitar Technique Made Easy, it really felt like having a teacher monitoring my learning curve. <strong>I don't think you could find a better way of learning the guitar.</strong> If you have trouble with specific things, you can always ask and watch the video again and again and again. No teacher in the real world would stay so cool when being asked over and over again.
                        <br><br>
                        I am a fan of this weekly concept. Although it is possible in theory to prepare something for myself (dividing a course into weekly sections), I would not get the same results because there is a way to cheat and go on faster or slower. Nate's time-setting is ideal."</p>
                    <h1>Holger Strunk<br> <span class="band">Leimen, Germany</span></h1>
                </div>
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/kathy-mire.jpg">
                    <p>"I highly recommend Guitar Technique Made Easy. Nate is the best guitar instructor I've ever had. Just the passion that he shows and his love of the instrument -- his way of explaining things is great. I especially liked the way he started with the basic topics and then increased the difficulty levels. Also, he didn't pull any punches. <strong>Nate let the students know exactly what was expected of them and what it took for improvement on the guitar, myself included.</strong>
                        <br><br>
                        I have absolutely no negative comments. The course was very informative and multi-topical; utilizing videos, charts, jam tracks, etc. to accelerate the learning process (can you tell I'm a teacher?!). Thank you, Nate, for giving me a new perspective on my guitar playing."</p>
                    <h1>Kathy Mire <br> <span class="band">Texas, United States</span></h1>
                </div>
            </div>

            <div class="columns no-padding small-up-1 medium-up-2 large-up-3 drummer-testimonial">
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/bill-hulme.jpg">
                    <p>"Before signing up, I was concerned about my ability to keep up with the lessons due to family and travel commitments. However, I knew that I needed to improve and the lessons every week provided the focus I was missing.
                        <br><br>
                        I liked the fact that the lessons are recorded and were/are available whenever I had time to catch up. Also, the grading practice for beginner / intermediate / advanced players made sure I didn’t feel left out.
                        <br><br>
                        I would recommend Guitar Technique Made Easy because there is something in it for everyone who wants to improve on the guitar. <strong>It really helped me put structure and focus around practice time to improve effectiveness.</strong>"</p>
                    <h1>Bill Hulme <br> <span class="band">Prestbury, UK</span></h1>
                </div>
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/glenn-hussey.jpg">
                    <p>"Guitar Technique Made Easy provided structure and a well-organized curriculum.  For the first time, I knew what to study and in what order. I liked having challenging yet attainable weekly goals; these provided a real sense of progress.
                        <br><br>
                        <strong>If someone wants to learn guitar, Guitareo and Guitar Technique Made Easy are the first things I would recommend.</strong> I struggled for a couple of years learning from poorly-written books, another learning site provided by a major guitar manufacturer, and YouTube videos with little progress. The real progress I've made is directly attributable to Guitareo and GTME! I'm currently going through GTME again at a snail’s pace to try to absorb and master as much as possible."</p>
                    <h1>Glenn Hussey  <br> <span class="band">Alfred, United States</span></h1>
                </div>
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/simon-hellinger.jpg">
                    <p>"At first, I was unsure about joining Guitar Technique Made Easy because I didn’t know if I could keep up with the course. <strong>It was a leap of faith, and worth it.</strong> As a result, I learned to let go of my perfectionism (I always got hung up on details before) and found that progress is progress!
                        <br><br>
                        I liked that there are tasks for beginners, intermediates, and pro players in every unit, so I can revisit the course in the future and still learn something new. I'd recommend it to people who are into online teaching and struggling with how to proceed with learning."</p>
                    <h1>Simon Hellinger<br> <span class="band">Traun, Austria</span></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="compare-table">
        <div class="row">
            <h1>Personalized Guidance</h1>
            <h3>...to help you achieve your<br class="hide-for-medium"> guitar goals for {{ date('Y') }}</h3>
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>
                        <img src="https://guitareo.s3.amazonaws.com/gtme/macbook.png" class="macbook"><br>
                        <img src="https://guitareo.s3.amazonaws.com/gtme/logo.png" class="blue-logo">
                    </td>
                    <td><i class="fas fa-user gray-logo"></i><br>Private Lessons</td>
                </tr>
                <tr>
                    <td>Weekly Guitar Lesson</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td>Guided 26-Week Course</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>100% Focused On Technique</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Learn From Home, Anytime</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Re-Watch The Lessons Anytime</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Designed To Get Easier</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Organized To Save Time</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Unlimited Access For Life</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr class="prices">
                    <td>Your Total Investment</td>

                    <td>
                        @hasSection('custom-price')
                            @yield('custom-price-2')
                        @else
                            ${{ number_format((GuitareoPrices::$GTMERegular / 26), 2, '.', ',') }}
                        @endif
                            /week
                        </td>

                    <td>$30-50/week</td>
                </tr>
                </tbody>
            </table>
            <p class="columns">
                <strong>Normally, Nate Savage charges $50 for a 30-minute private lesson</strong> and is extremely selective on which students he’ll teach. With Guitar Technique Made Easy, Nate is your personal guitar coach for 26 weeks, giving you a new exclusive video lesson each week and a clear path to improve your skills -- all for just
                <u>
                @hasSection('custom-price-2')
                    @yield('custom-price-2')
                @else
                    ${{ number_format((GuitareoPrices::$GTMERegular / 26), 2, '.', ',') }}
                @endif
                 per week.</u>
                <br><br>
                    You can choose a one-time payment or a three-payment plan -- and the entire Guitar Technique Made Easy course is yours for life with no recurring subscription or additional fees.
            </p>
        </div>
    </section>

    <section class="guarantee">
        <div class="row">
            <div class="large-4 medium-5 columns float-right text-center medium-text-right">
                <img src="https://guitareo.s3.amazonaws.com/gtme/guarantee-green.png" alt="90-Day Money-Back Guarantee">
            </div>
            <div class="large-8 medium-7 columns text-center medium-text-left">
                <h1>90-Day Money-Back Guarantee.</h1>
                <p>We love our students. More than anything, we want you to enjoy a super-positive experience playing guitar. And that means we only want you to pay if you actually LOVE your Guitareo experience! So join below to try it out totally risk-free. If it’s not for you, simply <a class="text-white" href="/support">contact us</a> within 90 days to request a full refund.</p>
            </div>
        </div>
    </section>

    <div id="order-anchor" class="anchor"></div>
    <section class="final">
        <div class="row">
            <div class="columns logo">
                {{--<img class="edge" src="https://guitareo.s3.amazonaws.com/sales/promos/cyber-monday/logo.png"><br>--}}
                <img src="https://guitareo.s3.amazonaws.com/gtme/logo-white.png"></div>


            {{--<div class="outline-box">--}}
                {{--<i class="fas fa-plus show-for-medium"></i>--}}
                {{--<p><strong>BONUS 6-MONTHS OF ACCESS TO GUITAREO MEMBERS AREA</strong> <em>($114 value)</em><br>--}}
                    {{--The perfect companion to Guitar Technique Made Easy! Get the ultimate guitar experience with over 1200 video lessons, weekly live lessons, and a passionate community of guitarists like you.</p>--}}
            {{--</div>--}}


            <h1 class="columns">

                @hasSection('custom-price-3')
                    @yield('custom-price-3')
                @else
                    @if(GuitareoPrices::$GTMEFull > GuitareoPrices::$GTMERegular)
                        <s>Was ${{ GuitareoPrices::$GTMEFull }}.</s> <strong>Only ${{ GuitareoPrices::$GTMERegular }}.</strong>
                    @else
                        <strong>Only ${{ GuitareoPrices::$GTMERegular }}.</strong>
                    @endif
                @endif

                <br class="hide-for-medium"> 90-Day Guarantee</h1>
            <h2 class="columns">Get lifetime access to the full course <br class="hide-for-medium"> for a one-time payment.</h2>

            <div class="columns">
                @hasSection('button-change')
                    @yield('button-change')
                @else
                    <a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['GTME-OCT-2018-SEMESTER' => 1], 'redirect' => '/order']) }}" class="join made-easy" data-product-json='{"GTME-OCT-2018-SEMESTER": 1}'>Get Started &raquo;</a>
                @endif

                <h6 style="margin-top: 15px;">
                    @hasSection('custom-price')
                        @yield('custom-price')
                    @else
                        @if(GuitareoPrices::$GTMEFull > GuitareoPrices::$GTMERegular)
                            <s>NORMALLY ${{ GuitareoPrices::$GTMEFull }}.</s> &nbsp;<strong style="color:#00BC75;"><u>ONLY ${{ GuitareoPrices::$GTMERegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (GuitareoPrices::$GTMERegular / GuitareoPrices::$GTMEFull))) }}%)
                        @else
                            <strong><u>ONLY ${{ GuitareoPrices::$GTMERegular }}</u></strong>
                        @endif
                    @endif

                    <br><a href="/" class="text-guitareo">(OR FREE WITH A GUITAREO MEMBERSHIP)</a>
                    {{--<br><strong style="color: #f6bd52;">ONLY <span class="tzcd-med">A LIMITED TIME</span> LEFT</strong>--}}
                    <br> <strong>** 90-DAY GUARANTEE **</strong>
                </h6>
            </div>


            <div class="columns cards">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
            <p class="columns final-questions">
                <span><strong>Any questions?</strong></span>
                You can also call us or order by phone<br class="hide-for-large"> toll-free at
                <a href="tel:1-800-439-8921">1-800-439-8921</a><br class="hide-for-medium"> or directly at
                <a href="tel:1-604-855-7605">1-604-855-7605</a>. <br>
                All prices listed in USD.</p>
        </div>
    </section>

    <section class="questions">
        <div class="row">
            <h1 class="columns upper">Still Have Questions?</h1>
            <div class="columns">
                @include('guitareo.products._question-dropdown-alt', [
                "question" => "Do these lessons work for electric and acoustic guitars?",
                "answer" => "Yes, the lessons will work on either. Since you’ll be developing your guitar technique, you’ll be gaining skills that will apply to both!"
                ])
                @include('guitareo.products._question-dropdown-alt', [
                "question" => "How much time per week will this course require?",
                "answer" => "For time invested, obviously the more time you practice the faster you’ll get better. But we recommend investing at least 2-3 hours per week to truly benefit from this course."
                ])
                @include('guitareo.products._question-dropdown-alt', [
                "question" => "What if I can’t follow the lessons EVERY week?",
                "answer" => "You’ll get 26 weekly lessons and exercises. And while they’re intended to be completed week-after-week, we know that everybody’s schedules are different - so we’ve included progress-tracking so you never lose your spot. If you need to miss a week, that’s fine! You might need to review the previous lessons a bit before continuing again, but you’ll never lose your spot and once you’ve registered, you have unlimited access to the entire course for life."
                ])
                @include('guitareo.products._question-dropdown-alt', [
                "question" => "Will I still have full access to the course after 26 weeks?",
                "answer" => "Yes! Even though it’s a week-by-week course, you’ll have LIFETIME online access to everything inside Guitar Technique Made Easy, so you can review the materials or re-watch the lessons, anytime."
                ])
            </div>
        </div>
    </section>

    @include("guitareo.sales.partials._footer")
@stop
