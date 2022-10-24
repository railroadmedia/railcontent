@extends('drumeo._partials.layout')

@section('head-includes')
    <title>Drum Technique Made Easy | Drumeo</title>
    <meta name="description" content="Drum Technique Made Easy is a 26-week online course with Bruce Becker.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/og-image.jpg" style="display: none;">
    <meta property="og:description" content="Drum Technique Made Easy is a 26-week online course with Bruce Becker.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @parent

    <link href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-dtme.css') }}" rel="stylesheet">

<!--    --><?php //\App\Analytics\Tracker::trackProductImpression('drum-technique-made-easy'); ?>
@stop()

@section('layout-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).foundation();

            // hide + show buy button
            var buyButton = $('.hidden-buy-slice');


            $(window).on("scroll", function () {
                var buyDisplay = $('.three-benefits').offset().top - 60;
                var buyHide = $('.final').offset().top - 120;

                var scrollPosition = $(window).scrollTop();
                if (scrollPosition > buyDisplay && scrollPosition < buyHide) {
                    buyButton.addClass('active');
                }
                else {
                    buyButton.removeClass('active');
                }
            });

            // Dropdown for FAQ section
            $('.question-dropdown').on('click', questionDropdown);

            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }

            $('#icon-grid .toggle').on('click', function () {
                $('#icon-grid .lesson-descriptions').addClass('active');
                $(this).addClass('active');
            });
        });
    </script>
    <script src="{{ asset('/marketing/parcel/drumeo/modal-autoplay.js') }}"></script>
@stop()

@section('layout-body')
    <header class="hero-header">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <div class="video-wrap autoplay-video" data-open="trailer">
                <div class="play-icon"><i class="fas fa-play"></i></div>
                <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/logo-white.png">
            </div>
            <h3>Drum Technique Made Easy is a 26-week
                <br class="inline lg:hidden">online course with Bruce Becker & Jared Falk.</h3>

            <div>
{{--                <a href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[drum-technique-made-easy-pack]=1" class="join">Get Started &raquo;</a>--}}
            </div>

            <p class="uppercase price">
{{--                @if(Prices::$dtmeFull > Prices::$dtmeRegular)--}}
{{--                    <s>Normally ${{ Prices::$dtmeFull }}.</s> <strong>Only ${{ Prices::$dtmeRegular }}.</strong> (Save {{ round(100 - (100 * (Prices::$dtmeRegular / Prices::$dtmeFull))) }}%)--}}
{{--                @else--}}
{{--                    <strong>Now ${{ Prices::$dtmeRegular }}.</strong>--}}
{{--                @endif--}}
                <br>
                <u class="text-green"><a href="/" style="color:inherit;">(Or get it free with Drumeo)</a></u>
                <br>
                <strong class="text-yellow">** 90-Day Guarantee **</strong>
            </p>
            <div class="reveal large trailer" id="trailer" data-reveal data-reset-on-close="false">
                <div class="flex-video widescreen vimeo">
                    <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/400749789?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
                <br>
{{--                <a href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[drum-technique-made-easy-pack]=1" class="join">Get Started &raquo;</a>--}}
            </div>
        </div>
    </header>

    <section class="three-benefits">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <h1>The Easiest Way To Improve<br class="hidden sm:inline">
                Your Hands & Feet</h1>
            <h3>…so you can play <u>ANYTHING</u> <br class="inline sm:hidden"> you want on the drums!</h3>
            <div class="float-left benefit-row practice">
                <div class="sm:w-1/2 float-right">
                    <div class="arrow-outline">
                        <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/bubble1.jpg">
                    </div>
                </div>
                <div class="sm:w-1/2 text-wrap">
                    <h1>Your Weekly Drum Coach</h1>
                    <p>Drum Technique Made Easy is an intimate 26-week course where you’ll follow Bruce Becker’s proven process for improving your drum technique, developing more speed and control around the kit, and rapidly improving your drumming just like when you first started playing.
                        <br><br>
                        <strong>You will get immediate access to 26 weekly lessons with very specific instructions on exactly what to practice, how long to practice for, and when to mark it as complete.</strong>
                    </p>
                </div>
            </div>
            <div class="float-left benefit-row play">
                <div class="sm:w-1/2 float-left">
                    <div class="arrow-outline right">
                        <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/bubble2.jpg">
                    </div>
                </div>
                <div class="sm:w-1/2 text-wrap float-right">
                    <h1>Better Practice, Better Results</h1>
                    <p>Drum Technique Made Easy is the ONLY course on technique that will actually get easier to complete as you go along - making it easier to stay motivated, easier to enjoy your practice time again, and easier to actually COMPLETE the course and make massive improvements to your technique for once and for all!
                        <br><br>
                        <strong>Unlike a drum book or DVD, this course is designed to deliver cumulative improvements. You’ll experience the best results when you’re able to follow the plan each week.</strong>
                    </p>
                </div>
            </div>
            <div class="float-left benefit-row support">
                <div class="sm:w-1/2 float-right">
                    <div class="arrow-outline">
                        <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/bubble3.jpg">
                    </div>
                </div>
                <div class="sm:w-1/2 text-wrap">
                    <h1>Drumming Without Limits</h1>
                    <p>Drum Technique Made Easy is all about having a clear vision for improving your drumming, and a simplified plan to get there! It’s your path to playing the drums faster with more fluidity, getting the tools to create better sounding beats and fills, and your opportunity to play whatever you want, whenever you want.
                        <br><br>
                        <strong>It doesn’t matter whether you’re a beginner, intermediate, or advanced drummer, you will get tips for each skill level and insights that will have a positive impact on your playing.</strong>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="icon-grid">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <div class="title-text">
                <h1>Your 26-Week Plan</h1>
                <p>Get 26 weekly lessons with hand-picked exercises so you always<br class="hidden sm:inline">
                    know exactly what to practice (and for exactly how long).
                </p>
            </div>
            <div class="grid sm:grid-cols-3">
                <div class="grid-item">
                    <div class="float-left w-full sm:w-1/6 icon-wrap">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="float-right px-3 md:px-4 w-full sm:w-5/6 text-wrap">
                        <h2>Weekly Lesson Plans</h2>
                        <p>It’s easy to make progress when you know exactly what to do, and when to do it.</p>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="float-left w-full sm:w-1/6 icon-wrap">
                        <i class="fas fa-signal-alt"></i>
                    </div>
                    <div class="float-right px-3 md:px-4 w-full sm:w-5/6 text-wrap">
                        <h2>All Skill Levels</h2>
                        <p>Each lesson will include tips for all levels - so any drummer can get fast results.</p>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="float-left w-full sm:w-1/6 icon-wrap">
                        <i class="fas fa-play"></i>
                    </div>
                    <div class="float-right px-3 md:px-4 w-full sm:w-5/6 text-wrap">
                        <h2>Guided Video Lessons</h2>
                        <p>Learn at your own pace with Bruce Becker’s easy-to-follow video lessons.</p>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="float-left w-full sm:w-1/6 icon-wrap">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="float-right px-3 md:px-4 w-full sm:w-5/6 text-wrap">
                        <h2>More Effective Practice</h2>
                        <p>Don’t waste your practice time. Only work on the right exercises, at the right time.</p>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="float-left w-full sm:w-1/6 icon-wrap">
                        <i class="fas fa-question"></i>
                    </div>
                    <div class="float-right px-3 md:px-4 w-full sm:w-5/6 text-wrap">
                        <h2>Personalized Support</h2>
                        <p>Need help? No problem! Get your biggest questions answered every step of the way.</p>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="float-left w-full sm:w-1/6 icon-wrap">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <div class="float-right px-3 md:px-4 w-full sm:w-5/6 text-wrap">
                        <h2>Lifetime Access</h2>
                        <p>Even though it’s a structured 26-week course, you’ll have access for life.</p>
                    </div>
                </div>
            </div>

            <div class="lesson-descriptions">
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => " 0",
                "weekTitle" => "Overview of Each Grip",
                "weekDate" => "10 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => " 0",
                "weekTitle" => "Ergonomic Drum Setup",
                "weekDate" => "5 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => " 0",
                "weekTitle" => "Practice Space",
                "weekDate" => "2 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "1",
                "weekTitle" => "Setting Up The Choreography",
                "weekDate" => "23 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "2",
                "weekTitle" => "Hand To Hand Triplets",
                "weekDate" => "17 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "3",
                "weekTitle" => "Hand To Hand 16th Notes",
                "weekDate" => "12 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "4",
                "weekTitle" => "Four Note Groupings In Triplets",
                "weekDate" => "9 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "5",
                "weekTitle" => "Five Note Groupings In 16th Notes",
                "weekDate" => "9 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "6",
                "weekTitle" => "Five Note Groupings In Triplets",
                "weekDate" => "7 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "7",
                "weekTitle" => "The Motions Applied To Rudiments",
                "weekDate" => "22 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "8",
                "weekTitle" => "Working With Paradiddles",
                "weekDate" => "17 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "9",
                "weekTitle" => "The Moeller Technique",
                "weekDate" => "23 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "10",
                "weekTitle" => "Moeller Motion With Opposite Hand Filling In",
                "weekDate" => "15 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "11",
                "weekTitle" => "Applying Paradiddles To Grooves",
                "weekDate" => "14 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "12",
                "weekTitle" => "Paradiddle Grooves With Displaced Accents",
                "weekDate" => "11 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "13",
                "weekTitle" => "Bass Drum Technique",
                "weekDate" => "16 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "14",
                "weekTitle" => "Hand To Foot Combinations",
                "weekDate" => "18 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "15",
                "weekTitle" => "Applying Bass Drum In Patterns",
                "weekDate" => "16 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "16",
                "weekTitle" => "Analysis Of French Grip",
                "weekDate" => "13 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "17",
                "weekTitle" => "Identifying The Move For The Jazz Ride Pattern",
                "weekDate" => "25 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "18",
                "weekTitle" => "Combining French & German Grip (Part I)",
                "weekDate" => "14 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "19",
                "weekTitle" => "Combining French & German Grip (Part II)",
                "weekDate" => "14 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "20",
                "weekTitle" => "The Push-Pull Technique",
                "weekDate" => "24 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "21",
                "weekTitle" => "Drags, Ruffs & Diddles",
                "weekDate" => "17 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "22",
                "weekTitle" => "The 3 Stroke Ruff",
                "weekDate" => "23 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "23",
                "weekTitle" => "Moving Paradiddles To The Tips For Speed",
                "weekDate" => "30 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "24",
                "weekTitle" => "Applying Movements To Different Drums",
                "weekDate" => "18 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "25",
                "weekTitle" => "Time Concepts",
                "weekDate" => "25 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "26",
                "weekTitle" => "Afro-Cuban Applications",
                "weekDate" => "34 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "bonusNumber" => "1",
                "weekTitle" => "Traditional Grip",
                "weekDate" => "9 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "bonusNumber" => "2",
                "weekTitle" => "Clarifying The Motions & Traditional Grip Expansion",
                "weekDate" => "9 min",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "bonusNumber" => "3",
                "weekTitle" => "Pivoting Over The Middle Finger",
                "weekDate" => "3 min",
                ])
            </div>
            <a class="join outline toggle">Show All</a>
        </div>
    </section>

    <section class="personal-letter text-center">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <h1 class="upper">Your clear path frustration-free<br class="hidden lg:inline"> guide to better drumming!</h1>
            <div class="float-left w-full half-padding sm:w-1/3">
                <div class="path-point">
                    <img class="mx-auto" src="https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/path-1.png">
                    <h3><strong>ALWAYS KNOW EXACTLY WHAT TO PRACTICE</strong></h3>
                    <p>...with weekly video lessons, tips, and exercises that are structured to give you a clear-path for making real improvements and achieving measurable results.</p>
                </div>
            </div>
            <div class="float-left w-full half-padding sm:w-1/3">
                <div class="path-point">
                    <img class="mx-auto" src="https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/path-2.png">
                    <h3><strong>ENJOY UNLIMITED PERSONAL SUPPORT</strong></h3>
                    <p>...with personalized feedback along the way. You will have direct access to a community of students and teachers who’ll be available to you every step of the way.</p>
                </div>
            </div>
            <div class="float-left w-full half-padding sm:w-1/3">
                <div class="path-point">
                    <img class="mx-auto" src="https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/path-3.png">
                    <h3><strong>GET BETTER AT DRUMS EVERY DAY</strong></h3>
                    <p>...with more enjoyable practice routines and exercises that are structured for rapid improvement. (Remember, just like when you first started playing drums!)</p>
                </div>
            </div>
        </div>
    </section>


    <section class="meet-instructor">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <div>
                <h1>Bruce Becker</h1>
                <p>Is Your Drum Teacher</p>
            </div>
            <div class="play-icon autoplay-video" data-open="trailer2"><i class="fas fa-play"></i></div>
        </div>
        <div class="reveal large trailer" id="trailer2" data-reveal data-reset-on-close="false">
            <div class="flex-video widescreen vimeo">
                <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/248236311?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
        </div>
    </section>

    <section class="bruce-bio">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <p class="px-3 md:px-4">
                <span class="first-letter"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/bold-b.png"></span> ruce Becker’s story begins in 1977, where he began his drumming studies under the instruction of the legendary Freddie Gruber -- who has often been referred to as the “zen master” of teaching.
                <br><br> Freddie had a rare insight that was spurred on by his close 40 year friendship with Buddy Rich, and many of the best drummers in the world turned to him to perfect their individual techniques and styles -- including Neil Peart, Steve Smith, and Dave Weckl.
                <br><br> Bruce not only benefited from Freddie’s instruction for eight years, but he also developed a close personal relationship.
                <br><br> “I became as close as one could become with him. I became Freddie’s go-to guy, house sitter, and airport runner,” Bruce told Modern Drummer in 2013. “I am the only guy I know of that actually did five clinics with him. There are too many stories to tell.”
                <br><br> Freddie would have Bruce available when he’d teach other pupils, getting Bruce to demonstrate the techniques as he would teach. They spent many late nights discussing drum technique and the mind-body connection, and exactly how it applies to music.
                <br><br> Through this incredible relationship, Bruce was able to watch the evolution and changes Freddie made in response to musical styles and drum innovations at the time -- gaining a deeper understanding of how the body should function in all sorts of musical situations and the importance of mastering a loose technical style that is built on natural ergonomic playing.
                <br><br> Bruce has since gone on to build his own thoughts and concepts based on all that Freddie had shared with him -- offering the most comprehensive insights into the teachings of Freddie Gruber and applying these lessons to his own all-star cast of drum students including Daniel Glass, David Garibaldi, and Mark Schulman.
                <br><br> Bruce Becker’s conceptual approach to the drums is defined as “Balance + Motion = Emotion”. And through Drum Technique Made Easy, you’ll have the opportunity to study with Bruce and gain his best insights for improving your technique through 26 weekly lessons.
            </p>
            <div class="px-3 md:px-4 timeline-pic">
                <img class="hidden lg:inline-block" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/timeline.jpg">
                <img class="hidden lg:hidden sm:inline-block" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/timeline-tablet.jpg">
                <img class="inline-block sm:hidden" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/timeline-mobile.jpg">
            </div>
        </div>
    </section>

    <section class="drummer-credits text-center">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <h1>What Drummers Are<br> Saying About Bruce Becker</h1>
            <div class="drummer-testimonial featured-testimonial">
                <div class="float-left w-full px-3 md:px-4 sm:w-5/12 picture">
                    <img class="drummer-pic" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/jojo-mayer.jpg">
                </div>
                <div class="float-right px-3 md:px-4 sm:w-7/12 text">
                    <h1>JoJo Mayer <span class="band">(Nerve)</span></h1>
                    <p>"Not only does Bruce make an effort to pass along a true understanding of drumming technique and some of its most vital 'secrets', he can also provide a profound insight into the artistic and mental aspects of the craft which, unfortunately, are too often ignored and overlooked by many teaching facilities. This has proven to be essential in the development and growth of any successful artist. Bruce knows what's up!"</p>
                </div>
            </div>
            <div class="float-left drummer-testimonial">
                <div class="float-left px-3 md:px-4 sm:w-1/3">
                    <img class="drummer-pic" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/steve-smith.jpg">
                    <h1>Steve Smith<br> <span class="band">(Journey, Vital Information)</span></h1>
                    <p>"Bruce has managed to distill many of Fred Gruber’s essential teachings into manageable portions. Combining Freddie’s ideas with his own teaching discoveries and methods, Bruce has created a program that is vital viewing for all serious students of the drumset."</p>
                </div>
                <div class="float-left px-3 md:px-4 sm:w-1/3">
                    <img class="drummer-pic" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/mark-schulman.jpg">
                    <h1>Mark Schulman<br> <span class="band">(Pink, Cher, Foreigner)</span></h1>
                    <p>"Bruce is not only one of my best friends and the most analytical and progressive drum teacher on the planet, he is also MY teacher! I do success coaching music lessons and when any of my students want to study on a regular basis, I always refer them to Bruce no matter what their level. I tell them: Don’t waste any more time, just study with the best!"</p>
                </div>
                <div class="float-left px-3 md:px-4 sm:w-1/3">
                    <img class="drummer-pic" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/david-garibaldi.jpg">
                    <h1>David Garibaldi<br> <span class="band">(Tower of Power)</span></h1>
                    <p>"Bruce is a tremendous educator. His years as an understudy to the late great Freddie Gruber are now serving him well. He fully understands and teaches all aspects of hand/foot technique, and is very adept at assessing what the student needs. I'm currently studying with him and look forward to where this will take me."</p>
                </div>
            </div>
            <div class="float-left drummer-testimonial featured-testimonial">
                <div class="float-right sm:float-left w-full px-3 md:px-4 sm:w-5/12 picture">
                    <img class="drummer-pic" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/dave-weckl.jpg">
                </div>
                <div class="float-right px-3 md:px-4 sm:w-7/12 text">
                    <h1>Dave Weckl <span class="band">(The Dave Weckl Band, Chick Corea)</span></h1>
                    <p>"Bruce’s many years studying with the now legendary Freddie Gruber has gained him the ability to not only become a wonderful player, but has also helped him as a teacher to construct a very effective and easy to understand curriculum for the student to develop at their own pace, with all of the fundamental aspects of Freddie’s natural approach to drumming being applied."</p>
                </div>
            </div>
            <div class="float-left drummer-testimonial">
                <div class="float-left px-3 md:px-4 sm:w-1/3">
                    <img class="drummer-pic" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/daniel-glass.jpg">
                    <h1>Daniel Glass<br> <span class="band">(Royal Crown Revue)</span></h1>
                    <p>"Not only is Bruce a fantastic player, but a master teacher in his own right. Having worked intensively with Freddie Gruber for nearly two decades, Bruce is in a unique position to not only pass along Freddie's teachings, but take them to his own place as well. He has a thorough knowledge of fundamental concepts such as balance, control, and developing the "internal clock" - key information that will dramatically enhance any drummers ability, no matter what style or skill level."</p>
                </div>
                <div class="float-left px-3 md:px-4 sm:w-1/3">
                    <img class="drummer-pic" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/ralph-johnson.jpg">
                    <h1>Ralph Johnson<br> <span class="band">(Earth, Wind, & Fire)</span></h1>
                    <p>"The study of a musical instrument is a lifetime study. Having said that, it’s absolutely essential to find a teacher who can convey the ideas and concepts that will allow you to become a confident, technical, proficient musician. Teaching is a very special gift and Bruce Becker has it. The time that I’ve spent with Bruce has been highly informative and very edifying. I always look forward to our time together. Here’s to great teachers!"</p>
                </div>
                <div class="float-left px-3 md:px-4 sm:w-1/3">
                    <img class="drummer-pic" src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/tris-imboden.jpg">
                    <h1>Tris Imboden<br> <span class="band">(Chicago)</span></h1>
                    <p>"Bruce Becker has the uncanny ability to break down and explain those subtle things that have always before eluded me in proper hand technique. Being primarily self taught, this has been of immeasurable help to me. He demystifies the mysteries in such a clear, concise, and understandable way."</p>
                </div>
            </div>
        </div>
    </section>

    <section class="compare-table">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <h1>UNLOCK YOUR UNFAIR ADVANTAGE</h1>
            <h3>
                while saving
{{--                {{ round(100 - (100 * (round(Prices::$dtmeRegular / 26, 2) / 30))) }}--}}
                % or more <br class="inline sm:inline">
                compared to private lessons.
            </h3>

            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>
                        <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/macbook.png" class="macbook"><br>
                        <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/logo-black.png" class="blue-logo">
                    </td>
                    <td><i class="fas fa-user gray-logo"></i><br>Private Lessons</td>
                </tr>
                <tr>
                    <td>Weekly Drum Lesson</td>
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
                <tr>
                    <td>Connect With Other Students</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>World-Class Student Support</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Money Back Guarantee</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr class="prices">
                    <td>Your Total Investment</td>
                    <td>
                        $
{{--                        {{ round(Prices::$dtmeRegular / 26, 2) }}--}}
                        /week
                    </td>
                    <td>$30-50/week</td>
                </tr>
                </tbody>
            </table>
            <p>
                <strong>You can unlock the full 26-week course today</strong> to get Bruce Becker’s curriculum for improving your technique on the drums -- <u>all for just
{{--                    {{ round(Prices::$dtmeRegular / 26, 2) }} --}}
                    per week</u> (billed at $
{{--                {{ Prices::$dtmeRegular }} --}}
                for the entire course).
                <br><br> You can choose a one-time payment, a two-payment plan, or a five-payment plan -- and the entire course is yours for life with no recurring subscription or additional fees.
            </p>
        </div>
    </section>


    <section class="student-reviews">
        <div class="testimonial-section">
            <div class="container clearfix lg:mx-auto max-w-6xl">
                <h1><strong>What past students are saying</strong> about<br class="hidden sm:inline"> Bruce & Drum Technique Made Easy.</h1>

                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/KenBrashear.jpg",
                "testimonialHighlight" => "I broke through a 5-year impasse!",
                "fullTestimonial" => "As a self-taught drummer, I was struggling for years to achieve the speed and precision I wanted on the drums. Bruce helped me modify my finger positioning and hand technique -- it felt like I’d broke through a 5-year impasse! Regardless of your skill level, if you have issues playing what you want to play and getting that onto the kit, this course is for you!",
                "name" => "Ken Brashear",
                "location" => "North Carolina, USA"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/PaulSquires.jpg",
                "testimonialHighlight" => "I was trying to take shortcuts, but they weren’t working.",
                "fullTestimonial" => "This is my technique bible. I took up the drums again at 56 years old and for the past six years I was trying to take shortcuts, but they weren’t working. This course basically taught me drum technique from scratch. It has helped immensely and now I’m much more relaxed while drumming, more confident in my abilities, and my band is playing more gigs while growing our following!",
                "name" => "Paul Squires",
                "location" => "London, United Kingdom"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/TitoMartinez.jpg",
                "testimonialHighlight" => "This is the best explanation of technique I’ve seen in my 40+ years of drumming.",
                "fullTestimonial" => "My drumming speed and fluidity was hitting a wall and I just couldn’t break through. Drum Technique Made Easy gave me the tools to start working out my problems and develop those skills. I’m still not exactly where I’d like to be, but my technique has improved significantly and I have a pathway to get there through application and practice. This is the best explanation of technique I’ve seen in my 40+ years of drumming. I highly recommend it.",
                "name" => "Tito Martinez",
                "location" => "Arizona, USA"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/ElizaGagnon.jpg",
                "testimonialHighlight" => "It gave me a new fluency and fluidity for playing grooves!",
                "fullTestimonial" => "I was a beginner and had very little technique at all, so everything was new. Bruce broke things down very clearly and all of the exercises progressed logically and smoothly -- and they weren’t boring to practice!<br><br> Drum Technique Made Easy helped me get in the habit of having the sticks in my hands every day and to be satisfied with slow and steady progress. It gave me a new fluency and fluidity for playing grooves. My partner actually noticed it before I did and commented on how much better my playing sounded.",
                "name" => "Eliza Gagnon",
                "location" => "Massachusetts, USA"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/MagnusSkarstedt.jpg",
                "testimonialHighlight" => "I started playing more musically with the band.",
                "fullTestimonial" => "The 26 weeks made me take the time to actually work in a structured way to take me from point a-b-c-d. And I realized Drum Technique Made Easy was working when I started playing more musically with the band. I had more self-confidence and played more relaxed. This comes slowly, it doesn't happen suddenly. It is small steps and it takes the time it needs to change the way you are used to playing.<br><br> No matter how good a player you are today, you will be even better after a course like this. It is definitely worth the money if you are willing to put in the time.",
                "name" => "Magnus Skarstedt",
                "location" => "Sweden"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/testimonials/WilliamHoyt.jpg",
                "testimonialHighlight" => "The drum set has become much more fun!",
                "fullTestimonial" => "It’s just amazing to feel the difference in playing things that were difficult before Drum Technique Made Easy. It almost seemed to sneak up on me from nowhere. Bruce is such a brilliant musician and teacher. It was a pleasure to get new great lessons every week that were explained so well.<br><br> The drum set has become much more fun, with ease and fluidity naturally coming through my motions. Take the course! If you stick with it, it will forever change your playing for the better!",
                "name" => "C. William Hoyt",
                "location" => "New Hampshire, USA"
                ])
            </div>
        </div>
    </section>

    <section class="text-center guarantee">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <img class="guarantee-badge inline-block sm:hidden" style="filter: hue-rotate(305deg) brightness(1.13);" src="https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png">
            <div class="flex-container">
                <img class="guarantee-badge hidden sm:inline-block" style="filter: hue-rotate(305deg) brightness(1.13);" src="https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png">
                <div class="text-wrap text-left">
                    <h1>90-Day Money-Back Guarantee</h1>
                    <p><strong>OUR PROMISE TO YOU:</strong> More than anything, we want you to enjoy a super-positive experience on the drums. And that means we only want you to pay if you actually LOVE your Drum Technique Made Easy experience. So click any of the big buttons on this page to get started risk-free. If it’s not for you, simply <a class="text-white" href="/support">contact us</a> within 90 days for a full refund.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="final">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <div class="logo"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/logo-white.png"></div>

            <h1>
                Bruce Becker’s 26-Week Online <br class="inline lg:hidden">
                Course For Just $
{{--                {{ round(Prices::$dtmeRegular / 26, 2) }} --}}
                Per Week
            </h1>

            <div>
{{--                <a href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[drum-technique-made-easy-pack]=1" class="join">Get Started &raquo;</a>--}}
            </div>

            <h2 class="uppercase">
{{--                @if(Prices::$dtmeFull > Prices::$dtmeRegular)--}}
{{--                    <s>Normally ${{ Prices::$dtmeFull }}.</s> <strong>Only ${{ Prices::$dtmeRegular }}.</strong> (Save {{ round(100 - (100 * (Prices::$dtmeRegular / Prices::$dtmeFull))) }}%)--}}
{{--                @else--}}
{{--                    <strong>Now ${{ Prices::$dtmeRegular }}.</strong>--}}
{{--                @endif--}}
                <br>
                <u class="text-green"><a href="/" style="color:inherit;">(Or get it free with Drumeo)</a></u>
                <br>
                <strong class="text-yellow">** 90-Day Guarantee **</strong>
            </h2>

            <div class="cards">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <p class="final-questions">
                <span><strong>Any questions?</strong></span> You can also call us or order by phone<br class="inline lg:hidden"> toll-free at
                <a href="tel:1-800-439-8921">1-800-439-8921</a><br class="inline sm:hidden"> or directly at
                <a href="tel:1-604-855-7605">1-604-855-7605</a>.<br> All prices listed in USD.</p>
        </div>
    </section>

    <section class="questions">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <h1 class="upper">Still Have Questions?</h1>
            <div>
                @include('drumeo.products.partials.question-dropdown', [
                "question" => "When does the course officially start?",
                "answer" => "You’ll get the entire 26-week course immediately, so you can start on your own schedule."
                ])
                @include('drumeo.products.partials.question-dropdown', [
                "question" => "Do these lessons work for electronic and acoustic drum-sets?",
                "answer" => "Yes, the lessons will work on both electric and acoustic drum-sets. Since you'll be developing your drum technique, you can even use a practice pad."
                ])
                @include('drumeo.products.partials.question-dropdown', [
                "question" => "How much time per week will this course require?",
                "answer" => "For time invested, obviously the more time you practice the faster you’ll get better. But we recommend investing at least 2-3 hours per week to truly benefit from this course."
                ])
                @include('drumeo.products.partials.question-dropdown', [
                "question" => "Will I still have full access to the course after 26 weeks?",
                "answer" => "Yes! Even though it’s a week-by-week course, you’ll have LIFETIME online access to everything inside Drum Technique Made Easy, so you can review the materials or re-watch the lessons, anytime."
                ])
                @include('drumeo.products.partials.question-dropdown', [
                "question" => "What if I can’t follow the lessons EVERY week?",
                "answer" => "You’ll get 26 weekly lessons and exercises. And while they’re intended to be completed week-after-week, we know that everybody’s schedules are different - so we’ve included progress-tracking so you never lose your spot. If you need to miss a week, that’s fine! You might need to review the previous lessons a bit before continuing again, but you’ll never lose your spot and once you’ve registered, you have unlimited access to the entire course for life."
                ])
            </div>
        </div>
    </section>
@stop
