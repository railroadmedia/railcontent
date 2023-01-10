@extends('guitareo._partials.global-vue-layout')

<?php \App\Analytics\Tracker::trackProductImpression('AGME-JAN-2019-SEMESTER'); ?>

@section('meta')
    <title>Acoustic Guitar Made Easy | Guitareo</title>
    <meta name="description" content="Acoustic Guitar Made Easy is an intimate 26-week online course with Nate Savage.">
    <meta property="og:image" content="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/og-image.jpg" style="display: none;">
    <meta property="og:description" content="Acoustic Guitar Made Easy is an intimate 26-week online course with Nate Savage.">
    <meta property="og:url" content="https://www.guitareo.com/acoustic-guitar-made-easy">
@stop()

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/agme-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}">
@stop()

@section('scripts')
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
    <script>
        $(function () {
            $(document).foundation();

            // Dropdown for FAQ section
            $('.question-dropdown').on('click', questionDropdown);

            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }


            //modal video swapping
            $('.play-button').on('click', function (ev) {

                $("#vimeo2")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('body').on('click', '.reveal-overlay', function (e) {
                if (e.target !== this)
                    return;

                var newSource = $("#vimeo2").attr('src').replace("?autoplay=1", "");
                $("#vimeo2").attr('src', newSource);
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
                "name" => "Acoustic Guitar Made Easy",
                "fullPrice" => floatval($productPrices['AGME-JAN-2019-SEMESTER']->price),
                "price" => floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price),
                "noBreadcrumb" => true
            ])

    <header class="hero-header">
        <div class="row">
            <div class="columns video-wrap">
                <div class="play-video"><i class="fas fa-play play-button" data-open="trailer"></i></div>
                <div class="logo">
                    <p><em>Nate Savage's</em></p>
                    <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/AGME-logo-white.png">
                </div>
            </div>
            {{--<p class="columns">Your 26-week system for getting started on the<br class="hide-for-large">--}}
            {{--acoustic guitar the right way with Nate Savage.</p>--}}
            <div class="columns">
                <p><strong>Get started on the guitar<br class="hide-for-medium"> the  RIGHT way</strong></p>

                <a href="/ecommerce/add-to-cart?products[AGME-JAN-2019-SEMESTER]=1&redirect=/order" class="join made-easy" data-product-json='{"AGME-JAN-2019-SEMESTER": 1}'>Get Started &raquo;</a>

                <p class="price-info">
                    @if(floatval($productPrices['AGME-JAN-2019-SEMESTER']->price) > floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price))
                        <s>NORMALLY ${{ floatval($productPrices['AGME-JAN-2019-SEMESTER']->price) }}.</s> &nbsp;<strong style="color:#00BC75;"><u>ONLY ${{ floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price) }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price) / floatval($productPrices['AGME-JAN-2019-SEMESTER']->price)))) }}%)
                    @else
                        <strong><u>ONLY ${{ floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price) }}</u></strong>
                    @endif
                    <br> <strong>** 90-DAY GUARANTEE **</strong></p>

            </div>
            <div class="reveal large trailer" id="trailer" data-reveal data-reset-on-close="true">
                <div class="flex-video widescreen vimeo">
                    <iframe id="vimeo2" src="//player.vimeo.com/video/335443479" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </header>

    <div class="why-guitar">
        <div class="row">
            <h1>It all starts with a question:<br> <strong>Why do you want to play guitar?</strong></h1>
            <h3>We asked our students, and these <br class="hide-for-medium">
                were their top answers:</h3>
            <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/what-people-say.png">
            <p class="columns"><strong><em>Any of these sound like you?</em></strong>
                <br><br>
                Acoustic Guitar Made Easy was created to give you a crystal-clear pathway to reaching these  <br class="show-for-medium">
                exact life-changing goals -- <u>and here’s how we’ll get there together in just 26 weeks...</u></p>
        </div>
    </div>
    <section class="triple-benefits">
        <div class="row">
            <div class="columns no-padding benefit-row practice">
                <div class="columns medium-6 float-right">
                    <div class="arrow-outline">
                        <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/best-year.jpg">
                    </div>
                </div>
                <div class="columns medium-6 text-wrap">
                    <h1>Learn With Songs<br class="show-for-medium"> You Know & Love</h1>
                    <p>Chords, strumming, technique, and scales are all wonderful things... but the real fun begins when you start playing songs that your family and friends recognize! You’ll see your newfound skills in action as you learn to play the iconic songs “Horse With No Name”, “Brown Eyed Girl”, “Let It Be”, “Jambalaya”, and “Take It Easy”.
                        <br><br>
                        <strong>Learn to play songs along with the high-quality backing tracks so that your playing can shine through and prepare you for playing along with the original track.</strong>
                    </p>
                </div>
            </div>
            <div class="columns no-padding benefit-row support">
                <div class="columns medium-6">
                    <div class="arrow-outline right">
                        <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/coach.jpg">
                    </div>
                </div>
                <div class="columns medium-6 text-wrap">
                    <h1>Always Know Exactly<br class="show-for-medium"> What To Practice</h1>
                    <p>Nate Savage is your personal guide as you learn to play songs on the guitar. Just like a private instructor, you’ll work closely with him and follow his proven process for getting started on the acoustic guitar the right way.
                        <br><br>
                        <strong>With weekly assignments tailored to your personal skill level, you’ll always know exactly what to practice, how long to practice for, and when to move on.</strong>
                    </p>
                </div>
            </div>
            <div class="columns no-padding benefit-row play">
                <div class="columns medium-6 float-right">
                    <div class="arrow-outline">
                        <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/practice.jpg">
                    </div>
                </div>
                <div class="columns medium-6 text-wrap">
                    <h1>No Shortcuts, Cheats,<br class="show-for-medium"> or Hacks</h1>
                    <p>Unlike many other guitar programs that intentionally skip important steps to give you the illusion that you’re making progress, Acoustic Guitar Made Easy helps you build a complete guitar foundation free from any holes or gaps so you can go on to play ANY style of music.
                        <br><br>
                        <strong>Specifically designed for the acoustic guitar, this 26-week course will give you the skills and knowledge to pursue any genre of acoustic music.</strong>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pillars text-center">
        <div class="row">
            <h1>Get Started On The Acoustic<br class="show-for-medium">
                Guitar The Right Way</h1>
            <h3>Learn and master the five pillars of the acoustic guitar to build a <br class="show-for-medium">
                rock-solid foundation so you can play the songs you love.</h3>
            <div class="pillar-wrap small-up-2 medium-up-3 large-up-5">
                <div class="columns text-center pillar">
                    <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/5-pillars/pillar-1.svg">
                    <h3>Pillar #1<br><strong>Strumming</strong></h3>
                </div>
                <div class="columns text-center pillar">
                    <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/5-pillars/pillar-2.svg">
                    <h3>Pillar #2<br><strong>Clean Chords</strong></h3>
                </div>
                <div class="columns text-center pillar">
                    <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/5-pillars/pillar-3.svg">
                    <h3>Pillar #3<br><strong>Changing Chords</strong></h3>
                </div>
                <div class="columns text-center pillar">
                    <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/5-pillars/pillar-4.svg">
                    <h3>Pillar #4<br><strong>Music Theory</strong></h3>
                </div>
                <div class="columns text-center pillar">
                    <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/5-pillars/pillar-5.svg">
                    <h3>Pillar #5<br><strong>Playing Songs</strong></h3>
                </div>
            </div>
        </div>
    </section>

    <section id="icon-grid">
        <div class="row">
            <div class="title-text columns">
                <h1>Your 26-Week Plan</h1>
                <p>Each week, you will have a new video lesson with detailed assignments so<br class="show-for-medium">
                    you can test your skills {{--<br class="show-for-medium">--}}
                    and know exactly when you're ready to move on.</p>
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
                        <p>Learn at your own pace with Nate Savage’s easy-to-follow video lessons.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns no-padding medium-2 icon-wrap">
                        <i class="fas fa-music"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Musical Application</h2>
                        <p>Have fun playing the guitar by applying everything you learn to real music.</p>
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
                "weekTitle" => "Setting Up Your Practice Space",
                "minutes" => 0,
                "weekDescription" => "Having a designated practice space where you can go to do some serious work and make progress is an important part of growing as a musician. In this first pre-lesson, we will walk through some tips for setting up your own little effective practice haven."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "0",
                "weekTitle" => "Practice Planner",
                "minutes" => 0,
                "weekDescription" => "One of the most critical parts of success on the guitar is setting up a practice plan and sticking faithfully to it. This second pre-lesson will walk you through how to set up an effective practice plan and some tips for sticking to it."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "0",
                "weekTitle" => "Changing Strings & Setups",
                "minutes" => 0,
                "weekDescription" => "Knowing how to change your strings on the guitar is like a driver knowing how to change a flat. Every guitarist should be able to do it. It may seem intimidating at first but with a little bit of knowledge and practice, you can apply the methods here to change your own strings."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "1",
                "weekTitle" => "Tuning",
                "minutes" => 0,
                "weekDescription" => "Tuning the guitar is the first step to sounding great. But just like everything else on the guitar, it takes some practice to get good at it! Dig into this important step as you learn a two-step process for tuning your guitar by ear or with an electronic tuner."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "2",
                "weekTitle" => "Strumming Technique",
                "minutes" => 0,
                "weekDescription" => "The first pillar of actually playing the guitar is strumming. This first lesson on strumming addresses some critical technical foundations that will set you up for success as you learn how to build and figure out strumming patterns for yourself."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "3",
                "weekTitle" => "Rhythm",
                "minutes" => 0,
                "weekDescription" => "Understanding how rhythm works and how to read rhythms will set you up for success in a lot of areas of playing the guitar in the future. The first step here is to learn how to identify and count the fundamental note values you will see on a regular basis."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "4",
                "weekTitle" => "Simple Chords - Start Playing!",
                "minutes" => 0,
                "weekDescription" => "The second pillar of playing the guitar is making clean chords. As you learn the two simple chords taught in this lesson, you will also be learning some vital chording techniques that will make all the chords you learn in the future much easier!"
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "5",
                "weekTitle" => "Timing",
                "minutes" => 0,
                "weekDescription" => "Developing good timing is one of the most important parts to sounding great on the guitar. Unfortunately, it's also one of the most overlooked aspects of playing the guitar. Start developing your timing right from the start with some simple yet highly effective exercises and insights."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "6",
                "weekTitle" => "Open Chords 1",
                "minutes" => 0,
                "weekDescription" => "Take your ability to play clean chords to the next level by adding a few new major open chords to your library. The skills and techniques that you've built in the previous lessons will make this much easier than just jumping in cold."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "7",
                "weekTitle" => "Strumming Patterns 1",
                "minutes" => 0,
                "weekDescription" => "Continue to develop your strumming abilities by applying the knowledge and technique you've already built to some new foundational strumming patterns. This will get you one step closer to being able to come up with your own strumming patterns and figure out the ones in your favorite songs."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "8",
                "weekTitle" => "Changing Chords Smoothly",
                "minutes" => 0,
                "weekDescription" => "Learning how to change chords smoothly takes more guitarists out of the game than any other hurdle. That's why it's the third pillar of playing the guitar. There are some simple things that you can do to make switching between chords smoothly much easier. We will go over all of those here so you can see the progress you want on the guitar."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "9",
                "weekTitle" => "Open Chords 2",
                "minutes" => 0,
                "weekDescription" => "Get one step closer to having all of your fundamental open chords down while refining your overall chording technique. This is a big step to being able to play the songs you want on the guitar."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "10",
                "weekTitle" => 'Song 1 - "Horse With No Name"',
                "minutes" => 0,
                "weekDescription" => 'Learning songs is the 4th pillar of playing the guitar and we are getting things started out right by learning the America song "Horse With No Name". It&apos;s a pretty simple song that only uses two chords and one strumming pattern.'
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "11",
                "weekTitle" => "Open Chords 3",
                "minutes" => 0,
                "weekDescription" => "This final lesson on open chords rounds out this part of your chord library by completing your knowledge of the five fundamental major chord shapes, the 3 fundamental minor chord shapes, and your overall chording technique."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "12",
                "weekTitle" => "Strumming Patterns 2",
                "minutes" => 0,
                "weekDescription" => "Strengthen the first pillar of playing the guitar by focusing on one of the most crucial concepts to develop your strumming abilities called the Constant Strumming Technique. Along the way, you will learn some new strumming patterns as well."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "13",
                "weekTitle" => 'Song 2 - "Brown Eyed Girl"',
                "minutes" => 0,
                "weekDescription" => 'Expand your song repertoire by learning the classic tune "Brown Eyed Girl" by Van Morrison. This is a kind of quantum leap where everything covered so far comes together in a big way. This is a great example of how a handful of chords, a strumming pattern, and some basic technique can create some beautiful music.'
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "14",
                "weekTitle" => "Strumming Patterns 3",
                "minutes" => 0,
                "weekDescription" => "Complete your fundamental strumming training by looking at 16th note strumming patterns. Many newer guitar players feel intimidated by 16th notes but there are some very methodical things you can do to make these types of patterns easier on yourself."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "15",
                "weekTitle" => "Oddball Chords",
                "minutes" => 0,
                "weekDescription" => "Bar chords can be the arch nemesis of guitar players but there are some simple alternatives. These simplified chords allow you to play chords like F major, F# major, Bb minor, and B major without worrying about bar chords. This is a big step to playing even more of your favorite songs on the guitar."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "16",
                "weekTitle" => 'Song 3 - "Let It Be"',
                "minutes" => 0,
                "weekDescription" => 'Every guitar player should know how to play at least one Beatles song. Learn the song "Let it Be" and get it to where you can play along to the original recording. Moments like this are why we put in all of the hard work learning new things on the guitar.'
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "17",
                "weekTitle" => "Chord Movement",
                "minutes" => 0,
                "weekDescription" => "Learn how to add some motion and color to your rhythm guitar playing. This is just the first step to learning how to embellish your strumming and chords but it's a vital one."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "18",
                "weekTitle" => 'Song 4 - "Jambalaya"',
                "minutes" => 0,
                "weekDescription" => 'Take your rhythm guitar playing to the next level by seeing how one of the all-time pros did it. The Hank Williams tune "Jambalaya" is a simple but extremely effective way to apply everything you&apos;ve learned about the guitar so far. '
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "19",
                "weekTitle" => "Music Theory 1 - The Major Scale",
                "minutes" => 0,
                "weekDescription" => 'The words "Music Theory" can be scary and intimidating to a lot of newer players. Never fear! There are some things you can do to make learning the basics of music theory very simple. This will be the beginning of helping you to understand how to tell which chords go together.'
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "20",
                "weekTitle" => "Music Theory 2 - Major Keys",
                "minutes" => 0,
                "weekDescription" => "Understanding how major keys work will allow you to learn songs much quicker and even start writing some of your own music! Explore a few simple concepts to demystify music theory a little bit more."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "21",
                "weekTitle" => "Capo",
                "minutes" => 0,
                "weekDescription" => "A capo is a super useful tool that any guitar player can use with simple chords they've memorized to play in any key. Learn about the fundamental concepts involved in using a capo and gain some valuable and practical experience."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "22",
                "weekTitle" => "Music Theory 3 - Major & Minor Chords",
                "minutes" => 0,
                "weekDescription" => "This final music theory session helps you understand exactly how major and minor chords are made. Once you get this down you will have a deeper understanding of why certain chords sound good together. This is a great place to be if you want to springboard into learning more about theory."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "23",
                "weekTitle" => "Strumming Embellishments",
                "minutes" => 0,
                "weekDescription" => "Having the basics of strumming down is great, but dressing it up and making it more expressive is even better. Explore some techniques and elements of strumming that can add a whole new layer of depth to your playing."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "24",
                "weekTitle" => 'Song 5 - "Take It Easy"',
                "minutes" => 0,
                "weekDescription" => 'The song "Take it Easy" by The Eagles is the pinnacle of this entire course. When you can play this song you will have conquered the basic physical parts of playing the guitar! It&apos;s the most challenging song covered here but also the most rewarding.'
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "25",
                "weekTitle" => "Fingerstyle",
                "minutes" => 0,
                "weekDescription" => "Want to take your rhythm guitar playing to a new level beyond strumming? That's exactly what you will do with this fingerstyle session. Learning the fundamental techniques of this style will give you a whole new color pallet to choose from when playing the guitar."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "26",
                "weekTitle" => "Crosspicking",
                "minutes" => 0,
                "weekDescription" => "Crosspicking is another technique that you can add to your bag of rhythm guitar tricks to help take you past simple strumming. It's kind of like fingerstyle guitar but with a whole new set of physical techniques to learn."
                ])
                @include('guitareo.products._week-breakdown', [
                "weekNumber" => "27",
                "weekTitle" => "Wrap Up",
                "minutes" => 0,
                "weekDescription" => "Getting the fundamentals of playing the guitar down is epic and critical. But what do you do once you've already done that? That's exactly what we will discuss here. Setting musical goals with specific due dates is a big part of future success."
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
                <span class="first-letter"><img style="border-radius: 5px;" src="https://guitareo.s3.amazonaws.com/gtme/bold-n.png"></span>ate Savage always knew he wanted to share his love for playing the guitar with others. After earning his Music Degree at San Jacinto College and playing hundreds of shows across Canada, the USA, and Europe -- he wanted to find a better way to help guitarists around the world. So in 2009, he connected with Musora Media to start GuitarLessons.com -- a massive library of free online guitar lessons that has since helped more than 20 million guitar players.

                <br><br>
                “I loved playing shows and touring,” Nate said in 2009. “But my heart has always been set on guitar education. I truly believe that playing the guitar can be a life-changing experience, so having the opportunity to create online lessons and help students around the world felt like such a perfect opportunity.”

                <br class="hide-for-large"><br class="hide-for-large">
                Nate’s most popular videos are built to give beginners an easier way to get started without the friction of private lessons. “8 Guitar Chords You Must Know” has reached more than 4 million views. “Play 10 Songs With 4 Chords”, “5 Essential Strumming Patterns”, and “How To Hold The Guitar” are just a few other examples of videos that have been seen more by more than a million students.

                <br><br>
                Through his online lessons, Nate has been able to reach more guitarists than he’d ever imagined and get feedback from tens of thousands of YouTube comments and personal emails -- gaining a deeper understanding of where students were having issues, what obstacles were getting in the way, and what was creating the fastest breakthroughs for getting to that next level.

                <br><br>
                “A lot of new guitarists end up quitting because they’re missing one of the five major pillars of acoustic guitar: strumming, playing clean chords, changing chords smoothly, music theory, and playing songs,” says Nate. “When even just one of those pillars is missing, your guitar experience can be super frustrating and you’re left with no clear path forward.”

                <br><br>
                Acoustic Guitar Made Easy is Nate’s solution -- giving students a simpler approach to accelerating their skills on the acoustic guitar through weekly lesson plans (where you’ll always know exactly what to do, and in exactly what order).
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

    <section class="drummer-credits text-center">
        <div class="row">
            <h1>"Nate is a <strong>natural<br class="hide-for-medium"> born teacher.</strong>"</h1>

            <div class="columns no-padding small-up-1 medium-up-2 large-up-3 drummer-testimonial">
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/harv-schelter.jpg">
                    <p>"When I first started playing the guitar, I had two 30 minute private lessons which got me nowhere for $60. Next, I went through two great books on my own which were good. I learned to read music, play some chords. But, I really didn't know what to do next.
                        <br><br>
                        After talking with Nate via email, I felt like I could complete Acoustic Guitar Made Easy. And learning to play rhythm to 5 songs would give me some needed direction to follow.
                        <br><br>
                        I'm very happy with what I've accomplished in Acoustic Guitar Made Easy. It gave me the direction I needed and Nate was great. <strong>Nate is the guitar instructor for me!</strong>"</p>
                    <h1>Harv Schelter <br> <span class="band">- Colorado</span></h1>
                </div>
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/james-lee-mcdowell.jpg">
                    <p>"When I first started playing guitar, it was frustrating because of the lack of a path to follow. I felt like stopping altogether. <strong>It was when Nate broke down the song Brown Eyed Girl inside Acoustic Guitar Made Easy when I got it.</strong> I was finally able to get through the entire thing... quite a milestone for me!
                        <br><br>
                        If you’re considering Acoustic Guitar Made Easy, I would say go ahead and go for it. It opened up a lot of things for me. Nate breaks down the songs perfectly for you and he makes it easy for you to just get it."</p>
                    <h1>James McDowell <br> <span class="band">- Washington</span></h1>
                </div>
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/don-mulnix.jpg">
                    <p>"I have never given up easily on anything. However, <strong>I was beginning to think that playing the guitar was out of my reach...</strong>
                        <br><br>
                        It was midway through the lessons in Acoustic Guitar Made Easy and the same sense of dedication and commitment Nate continued to communicate. I really believed he wouldn’t quit on me. And he ALWAYS responds to my comments.
                        <br><br>
                        I continue to practice 2 hours a day. I find the time with the guitar a stress release and I take great satisfaction in the little victories. Without question, Acoustic Guitar Made Easy is the best possible online resource for guitar instruction. So many other sites and instructors seem to want to show off instead of teach."</p>
                    <h1>Don Mulnix <br> <span class="band">- South Carolina</span></h1>
                </div>
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/rob-mckay.jpg">
                    <p>"Before Acoustic Guitar Made Easy, I didn’t have a set lesson plan or guide. I was all over the place trying many different videos with no concentrated focus or practice regime.
                        <br><br>
                        <strong>Then came Acoustic Guitar Made Easy, and I finally found structure!</strong> I loved the lesson layout and the excellent structure of each individual lesson.
                        <br><br>
                        Now that I’ve completed Acoustic Guitar Made Easy I’m no Eric Clapton… But my initial goal was to become a “campfire” guitarists and I’m well on my way!
                        <br><br>
                        Acoustic Guitar Made Easy is great value for money. Excellent lesson structure via a step-by-step progression with in-depth video tutorial and practice guidelines within each lesson - Nate is very personable and easy to relate to as well."</p>
                    <h1>Rob Mckay <br> <span class="band">- New Zealand</span></h1>
                </div>
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/david-raynor.jpg">
                    <p>"As a beginner player, I was frustrated trying to make sense of all the "beginner" information that is out there and easily accessible. I was confused. And although I am generally a self-starter, working out where to begin is often the hardest part to getting started.
                        <br><br>
                        <strong>The big moment it all clicked for me was when I moved from basic technique to applying it to playing songs. I could actually play them with some confidence.</strong>
                        <br><br>
                        Even though I had some of the basic skills before I started on the course, going through the course really did help to hone in on them and improve them. I also feel a lot more confident in being able to apply what I learned to learning more songs on my own. Chords and guitar tab notation are no longer a mystery to me.
                        <br><br>
                        The course is a very good beginner's guitar course, it does what it says it says on the packaging. It takes you from not knowing anything to being able to play songs and gives you the foundation to be able to continue your guitar learning with confidence. But there is one catch, you really do need to do the work; there is no free ride to gaining skills."</p>
                    <h1>David Raynor <br> <span class="band">- New Zealand</span></h1>
                </div>
                <div class="columns">
                    <img class="drummer-pic" src="https://s3.amazonaws.com/guitareo/sales/testimonials/norma-mcintosh.jpg">
                    <p>"Before Acoustic Guitar Made Easy, I felt like I couldn’t learn guitar. But the thing that truly made a difference was Nate. He made me feel like I can learn the guitar, and if I need help all I have to do is watch the videos from Acoustic Guitar Made Easy, and he will be there to help me again.
                        <br><br>
                        Now that I’m done AGME, life looks good. <strong>I have realized a life-long dream and now at the young age of eighty, I can play the guitar.</strong>
                        <br><br>
                        To anyone considering Acoustic Guitar Made Easy… The money saved and the support you will get is so much better than taking private lessons."</p>
                    <h1>Norma McIntosh <br> <span class="band">- Georgia</span></h1>
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
                        <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/macbook.png" class="macbook"><br>
                        <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/AGME-logo-black.png" class="blue-logo">
                    </td>
                    {{--<td class="show-for-medium"><i class="fad fa-sync gray-logo"></i><br>Subscription Sites</td>--}}
                    <td><i class="fad fa-chalkboard-teacher gray-logo"></i><br>Private Lessons</td>
                </tr>
                <tr>
                    <td>Weekly Guitar Lesson</td>
                    <td><i class="fas fa-check"></i></td>
                    {{--<td class="show-for-medium"><i class="fas fa-check"></i></td>--}}
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td>Learn From Home, Anytime</td>
                    <td><i class="fas fa-check"></i></td>
                    {{--<td class="show-for-medium"><i class="fas fa-check"></i></td>--}}
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Re-Watch The Lessons Anytime</td>
                    <td><i class="fas fa-check"></i></td>
                    {{--<td class="show-for-medium"><i class="fas fa-check"></i></td>--}}
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>26-Week Course</td>
                    <td><i class="fas fa-check"></i></td>
                    {{--<td class="show-for-medium"><i class="fas fa-minus"></i></td>--}}
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>100% For Beginners</td>
                    <td><i class="fas fa-check"></i></td>
                    {{--<td class="show-for-medium"><i class="fas fa-minus"></i></td>--}}
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Designed To Get Easier</td>
                    <td><i class="fas fa-check"></i></td>
                    {{--<td class="show-for-medium"><i class="fas fa-minus"></i></td>--}}
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Organized To Save Time</td>
                    <td><i class="fas fa-check"></i></td>
                    {{--<td class="show-for-medium"><i class="fas fa-minus"></i></td>--}}
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Unlimited Access For Life</td>
                    <td><i class="fas fa-check"></i></td>
                    {{--<td class="show-for-medium"><i class="fas fa-minus"></i></td>--}}
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr class="prices">
                    <td>Your Total Investment</td>
                    <td>${{ number_format((floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price) / 26), 2, '.', ',') }}/week</td>
                    {{--<td class="show-for-medium">$2.18/week</td>--}}
                    <td>$30-50/week</td>
                </tr>
                </tbody>
            </table>
            <p class="columns">
                <strong>Normally, Nate Savage charges $50 for a 30-minute private lesson</strong> and is extremely selective on which students he’ll teach. With Acoustic Guitar Made Easy, Nate is your personal guitar coach for 26 weeks, giving you a new exclusive video lesson each week and a clear path to improve your skills -- <u>all for just ${{ number_format((floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price) / 26), 2, '.', ',') }} per week.</u>
                <br><br>
                You can choose a one-time payment, or two or five-time payment plans -- and the entire Acoustic Guitar Made Easy course is <u>yours for life</u> with no recurring subscription or additional fees.
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
                <p>We love our students. More than anything, we want you to enjoy a super-positive experience playing guitar. And that means we only want you to pay if you actually LOVE your Guitareo experience! So join below to try it out totally risk-free. If it’s not for you, simply <a class="text-white" href="{{ get_musora_brand_base_url() }}/contact">contact us</a> within 90 days to request a full refund.</p>
            </div>
        </div>
    </section>

    <div id="order-anchor" class="anchor"></div>
    @yield('final-banner')
    <section class="final">
        <div class="row">
            <div class="columns logo">{{--<img class="edge" src="https://guitareo.s3.amazonaws.com/sales/promos/cyber-monday/logo.png"><br>--}}
                <img src="https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/AGME-logo-white.png"></div>

            <h1 class="columns">26-Week Online Course <br class="hide-for-medium">
                For Just ${{ number_format((floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price) / 26), 2, '.', ',') }} Per Week</h1>

            @if(floatval($productPrices['AGME-JAN-2019-SEMESTER']->price) > floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price))
                <h2 class="columns">(<s>${{ floatval($productPrices['AGME-JAN-2019-SEMESTER']->price) }}</s> <strong>${{ floatval($productPrices['AGME-JAN-2019-SEMESTER']->discounted_price) }}</strong> one-time payment. Or choose <br class="hide-for-medium">a 2-pay or 5-pay plan on the next page.)</h2>
            @else
                <h2 class="columns">(<strong>${{ floatval($productPrices['AGME-JAN-2019-SEMESTER']->price) }}</strong> one-time payment. Or choose <br class="hide-for-medium">a 2-pay or 5-pay plan on the next page.)</h2>
            @endif
            <div class="columns"><a href="/ecommerce/add-to-cart?products[AGME-JAN-2019-SEMESTER]=1&redirect=/order" class="join made-easy" data-product-json='{"AGME-JAN-2019-SEMESTER": 1}'>Get Started &raquo;</a></div>
            <div class="columns cards">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
            <p class="columns final-questions">
                <span><strong>Any questions?</strong></span>
                You can also call us or order by phone<br class="hide-for-large">
                toll-free at <a href="tel:+18004398921">1-800-439-8921</a><br class="hide-for-medium">
                or directly at <a href="tel:+16048557605">1-604-855-7605</a>. <br>
                All prices listed in USD.</p>
        </div>
    </section>
    <section class="questions">
        <div class="row">
            <h1 class="columns upper">Still Have Questions?</h1>
            <div class="columns">
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "When does the course officially start?",
                "desc" => "Acoustic Guitar Made Easy can be started as soon as you purchase it, and all of the lessons will be unlocked as soon as you buy it. This means you can tackle the lessons at your own pace!"
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Do these lessons work for both acoustic and electric guitars?",
                "desc" => "While you’ll still learn a ton with an electric guitar, this course was designed to deliver the best results for acoustic guitar players and players who want to play their favorite songs on their acoustic guitar."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "How much time per week will this course require?",
                "desc" => "For time invested, obviously the more time you practice the faster you’ll get better. But we recommend investing at least 2-3 hours per week to truly benefit from this course."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "What if I can’t follow the lessons EVERY week?",
                "desc" => "You’ll get 26 weekly lessons and exercises. And while they’re intended to be completed week-after-week, we know that everybody’s schedules are different - so we’ve included progress-tracking so you never lose your spot. If you need to miss a week, that’s fine! You might need to review the previous lessons a bit before continuing again, but you’ll never lose your spot and once you’ve registered, you have unlimited access to the entire course for life."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Will I still have full access to the course after 26 weeks?",
                "desc" => "Yes! Even though it’s a week-by-week course, you’ll have LIFETIME online access to everything inside Acoustic Guitar Made Easy, so you can review the materials or re-watch the lessons, anytime."
                ])
            </div>
        </div>
    </section>

    @include("guitareo.sales.partials._footer")
@stop
