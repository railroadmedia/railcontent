@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>Successful Drumming</title>
    <meta name="description" content="Successful Drumming is a complete beginner-to-advanced drum curriculum that produces rapid results.">
    <meta property="og:image" content="https://i.vimeocdn.com/video/707999377-b145eeb6979d0f2efeb622f108bf2f4c6ce798dfa6513032ec476cd932af57e1-d_1200" style="display: none;">
    <meta property="og:description" content="Successful Drumming: The Fastest Way To Improve Your Drumming. Guaranteed.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <?php \App\Analytics\Tracker::trackProductImpression('SD-DIGI'); ?>
    <link href="{{ asset('/marketing/parcel/drumeo/tripwire.css') }}" rel="stylesheet">
@stop()

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {

            $(document).foundation();
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop()

@section('content')
    @include('drumeo.products.partials.promo-banner', [
                    "name" => "Successful Drumming",
                    "fullPrice" => Prices::$sdOnlineFull,
                    "price" => Prices::$sdOnlineRegular,
                "noBreadcrumb" => true
                ])
    <header class="header stacked">
        <div class="container mx-auto clearfix xlarge" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/header-bg.jpg);">
            <img class="px-4 w-auto max-h-20 mx-auto" src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/sd-logo.png">

            <div class="float-left w-full px-3 sm:px-4 video-container">
                <i data-open="previewModal" class="fas fa-play play-button autoplay-video"></i>
            </div>
            <div class="float-left w-full px-3 sm:px-4 text-container">
                <div class="course-logo">
                    <h2>SUCCESS <strong>STARTS HERE</strong></h2>
                </div>
                <p>Jared Falk’s step-by-step plan for building a rock-solid <br class="hidden sm:inline">
                    drumming foundation for achieving any musical goals. </p>
                {{--<a class="join sold-out">Sold Out</a>--}}
                <a href="/laravel/public/shopping-cart/api/query?products[SD-DIGI]=1" class="join blue">Get Started &raquo;</a>
                <p class="price-info">
                    <s>NORMALLY ${{ Prices::$sdOnlineFull }}.</s> <strong>NOW ${{ Prices::$sdOnlineRegular }}</strong> (SAVE {{ round(100 - (100 * (Prices::$sdOnlineRegular / Prices::$sdOnlineFull))) }}%).
                    <br> <span class="text-blue">90-DAY GUARANTEE.</span>
                </p>
            </div>
        </div>

        <div class="reveal large" id="previewModal" data-reveal data-reset-on-close="false">
            <div class="flex-video widescreen vimeo">
                <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/275665270?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
        </div>
    </header>

    <section class="lesson-breakdown">
        <div class="container mx-auto clearfix">
            <h1>The Faster Way To Improve  <br class="hidden sm:inline lg:hidden">
                Your Skills… <u>For Just ${{ Prices::$sdOnlineRegular }}</u></h1>
            <h3 class="light"><s>NORMALLY ${{ Prices::$sdOnlineFull }}</s></h3>
            <div class="float-left w-full px-3 sm:px-4 tile-wrap grid grid-cols-2 sm:grid-cols-3 gap-4">
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/1.jpg",
                "tileTitle" => "THE FOUNDATION",
                "tileDescription" => "Build a solid foundation on topics like technique, notation, and your first beats and fills!",
                "lessonNumber" => "32",
                "lessonDuration" => "3 HR 44",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/2.jpg",
                "tileTitle" => "THE TECHNIQUES",
                "tileDescription" => "Take your drumming to the next level with step-by-step lessons on essential technical topics.",
                "lessonNumber" => "11",
                "lessonDuration" => "2 HR 25",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/3.jpg",
                "tileTitle" => "THE GROOVES",
                "tileDescription" => "Get time-saving tools and video guides for composing your own beats and fills for any musical style.",
                "lessonNumber" => "14",
                "lessonDuration" => "2 HR 19",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/4.jpg",
                "tileTitle" => "THE BREAKDOWN",
                "tileDescription" => "Get three unique tools to simplify your favorite songs so you can apply your skills to real music.",
                "lessonNumber" => "4",
                "lessonDuration" => "1 HR 12",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/5.jpg",
                "tileTitle" => "THE BASSIST",
                "tileDescription" => "The three keys to locking-in with a bass guitar player to make the band sound and perform better.",
                "lessonNumber" => "6",
                "lessonDuration" => "42",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/6.jpg",
                "tileTitle" => "THE BAND",
                "tileDescription" => "Watch the creation of 5 original songs and get a 10 step process for establishing your band’s goals.",
                "lessonNumber" => "12",
                "lessonDuration" => "3 HR 57",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/7.jpg",
                "tileTitle" => "THE SHOWS",
                "tileDescription" => "You’ll get detailed interviews with professional gigging drummers and a checklist for your next gig.",
                "lessonNumber" => "6",
                "lessonDuration" => "2 HR 27",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/8.jpg",
                "tileTitle" => "THE MUSIC",
                "tileDescription" => "Enjoy 10 fun play-along songs that you can jam along with to challenge yourself and build experience.",
                "lessonNumber" => "10",
                "lessonDuration" => "39",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/9.jpg",
                "tileTitle" => "THE LIFESTYLE",
                "tileDescription" => "Three tools for focusing on your goals, staying excited about the drums, and connecting with other musicians.",
                "lessonNumber" => "5",
                "lessonDuration" => "43",
                ])
            </div>
        </div>
    </section>

    <section class="three-icon">
        <div class="container mx-auto clearfix">
            <h1 class="float-left w-full px-3 sm:px-4">YOUR TOOLBOX FOR SUCCESS ON THE DRUMS</h1>
            <h3 class="float-left w-full px-3 sm:px-4">
                Get Jared’s personal toolbox for learning songs faster, locking-in with other musicians,<br class="hidden lg:inline">
                  preparing for gigs, and setting yourself up for a successful experience on the drums, <br class="hidden lg:inline">
                 whatever that might mean to you.</h3>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-tree"></i></div>
                <p><strong>THE DRUMMING TREE</strong><br>
                    Perfect for drummers of all levels with progressive step-by-step lessons on every topic.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/drum-icon.png"></div>
                <p><strong>THE EASY BEAT SYSTEM </strong><br>
                    A simple three-step formula for writing original drum beats and expressing your ideas.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/stick-icon.png"></div>
                <p><strong>THE DRUM FILL BUILDER</strong><br>
                    A simple three-step formula for unlocking your creativity while creating your own drum fills.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-list"></i></div>
                <p><strong>THE STYLE SELECTOR </strong><br>
                    Explore a variety of musical styles including rock, jazz, latin, funk, country, metal, and more.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-file-alt"></i></div>
                <p><strong>THE DRUMMING CHEAT SHEET </strong><br>
                    The easier way to create personalized charts for learning and remembering song structures.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-music"></i></div>
                <p><strong>THE DRUMMING SONG SIMPLIFIER</strong><br>
                    A fast and effective way to play-along to virtually any song without learning every drum part.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-lock"></i></div>
                <p><strong>THE LOCKED-IN SYSTEM </strong><br>
                    A simple three-phase approach for working with a bassist to create a better musical foundation.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-headphones"></i></div>
                <p><strong>THE SUCCESSFUL BAND METHOD </strong><br>
                    A list of 10 important guidelines for bands to follow to improve your chance of success.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-check"></i></div>
                <p><strong>THE DRUMMER’S CHECKLIST </strong><br>
                    A comprehensive list of everything drummers should bring to the practice room, studio, or live gig.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-calendar-alt"></i></div>
                <p><strong>THE HABITUAL DRUMMER </strong><br>
                    Five steps to maintaining the habits you need to achieve consistent drumming progress.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-lightbulb"></i></div>
                <p><strong>THE INSPIRED DRUMMER </strong><br>
                    Ten sources of drumming inspiration to help you stay motivated as a musician.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-users"></i></div>
                <p><strong>THE CONNECTED DRUMMER </strong><br>
                    Ten unique ways you can connect with other musicians for support and encouragement.</p>
            </div>
        </div>
    </section>

    <section class="student-reviews">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/fred-rose.jpg">
                <p>"I’ve used several other packs online, I’ve taken private lessons, and nothing gives you this clear sense of accomplishment and goals and direction..."</p>
                <h2>Fred Rose <span class="location">- California</span></h2>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/rich-behe.jpg">
                <p>"One of the biggest frustrations for me has been trying to keep track of where I am within different video lessons. I would forget where I left off..."</p>
                <h2>Rich Behe <span class="location">- Germany</span></h2>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/ken-voller.jpg">
                <p>"The way that 'Successful Drumming', particularly the Foundation, sets out goals and achievements in small, bite size, chunks is so good!"</p>
                <h2>Ken Voller <span class="location">- UK</span></h2>
            </div>
        </div>
    </section>

    <section class="history-bruce sd-tripwire" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/meet-jared.jpg);">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-3 sm:px-4 sm:w-7/12 end">
                <h1>Jared Falk: The World’s Most<br class="hidden lg:inline">
                     Watched Drum Teacher</h1>
                <p class="hidden sm:inline">
                    "He puts the lessons together so beginners or advanced <br class="hidden lg:inline">
                    students can understand and simply get better..."
                </p>
                <div class="float-left w-full steve-details hidden sm:inline">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/dave-mccoy.jpg">
                    <div class="float-left w-full px-3 sm:px-4 end text">
                        <h2>Dave McCoy</h2>
                        <h3>California</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bruce-bio">
        <div class="container mx-auto clearfix">
            <p class="float-left w-full px-3 sm:px-4">
                <span class="first-letter smaller"><img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/bold-j.png"></span>ared Falk has been creating online drum lessons since before YouTube even existed!
                <br><br>
                Back in 2003, Jared partnered with one of his private drum students to create simple websites with drum articles, video tutorials, and community discussion forums. As online drum lessons transitioned to becoming a full-time job, Jared launched several step-by-step DVD packs including the One-Handed Drum Roll, Bass Drum Secrets, and The Rock Drumming System.
                <br><br>
                As video streaming started to improve and websites like YouTube gained traction, Jared launched FreeDrumLessons.com in 2007 and built a massive library of drum lessons on YouTube. And through these platforms, Jared has become the world’s most-watched drum teacher with his YouTube lessons alone reaching more than 50 million views -- including his “How To Play Drums” video that has helped more than 4 million drummers.
                <br class="hidden lg:inline"><br><br>
                In 2012, Jared co-founded Drumeo.com as “The Ultimate Online Drum Lessons Experience”, giving drum students the opportunity to learn from the best drummers and teachers in the world through step-by-step courses, live video drum lessons, play-along songs, personalized lesson plans, and community support.
                <br><br>
                Drumeo has since been voted as “The Best Educational Website” by the readers of DRUM! Magazine for three consecutive years, “The Best Educational Product” by the readers of Modern Drummer magazine, and Jared was awarded “The Best Drum Educator” by Rhythm Magazine.
                <br><br>
                Successful Drumming is Jared’s step-by-step curriculum to help drummers of all levels build a rock solid foundation on the drums -- to achieve “success” in any definition they choose. You’ll get the foundational skills you need for playing proficiently to music and you’ll get deeper insights into playing with a band, what it takes to be a gigging drummer, and staying motivated as you continue to progress as a musician.
            </p>
        </div>
    </section>

    <section class="student-reviews">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/michael-peraza.jpg">
                <p>"I hit a wall very quickly and got very frustrated. The band ended up splitting up. I felt at fault because my timing was horrible..."</p>
                <h2>Michael Peraza <span class="location">- California</span></h2>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/robert-kidd.jpg">
                <p>"I started playing drums in school when I was in 6th grade. I stopped playing for a number of years and just recently started back up..."</p>
                <h2>Robert Kidd <span class="location">- Maryland</span></h2>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/jim-olson.jpg">
                <p>"A few years ago, after more than 30 years away, I'm back playing with a band in my spare time..."</p>
                <h2>Jim Olson <span class="location">- California</span></h2>
            </div>
        </div>
    </section>

    <section class="guarantee">
        <div class="container mx-auto clearfix">
            <div class="lg:w-3/12 sm:w-5/12 w-full px-3 sm:px-4 float-right text-center sm:text-right">
                <img src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png" alt="90-Day Money-Back Guarantee">
            </div>
            <div class="lg:w-9/12 sm:w-7/12 float-left w-full px-3 sm:px-4 text-center sm:text-left">
                <h1>90-Day Money-Back Guarantee.</h1>
                <p>More than anything, we want you to enjoy a super-positive experience on the drums. And that means we
                    only want you to pay if you actually LOVE your Successful Drumming experience. So get started below
                    to try it out risk-free. If it’s not for you, simply <a class="text-white" href="{{ get_musora_brand_base_url() }}/contact">contact us</a> within 90 days for
                    a full refund.</p>
            </div>
        </div>
    </section>

    <section class="final">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-3 sm:px-4 logo">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/sd-logo.png">
            </div>
            <h2 class="float-left w-full px-3 sm:px-4">Get Jared Falk’s trusted step-by-step curriculum <br class="inline sm:hidden">
                for a one-time payment of just ${{ Prices::$sdOnlineRegular }}.</h2>
            {{--<div class="float-left w-full px-3 sm:px-4"><a class="join sold-out">Sold Out</a></div>--}}
            <div class="float-left w-full px-3 sm:px-4"><a href="/laravel/public/shopping-cart/api/query?products[SD-DIGI]=1" class="join blue">Get Started &raquo;</a></div>

            <h2 class="float-left w-full px-3 sm:px-4 highlighted"><s>NORMALLY ${{ Prices::$sdOnlineFull }}.</s> <strong><u>ONLY ${{ Prices::$sdOnlineRegular }}</u></strong> (SAVE {{ round(100 - (100 * (Prices::$sdOnlineRegular / Prices::$sdOnlineFull))) }}%).
                <br> <span class="text-blue">90-DAY GUARANTEE.</span>
                {{--<br><span class="countdown">ONLY <strong class="tzcd2">a limited time</strong> LEFT!</span>--}}</h2>

            <div class="credit-cards float-left w-full px-3 sm:px-4">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <div class="float-left w-full px-3 sm:px-4 questions">
                <p><strong>Any questions?</strong><br class="inline sm:hidden">
                    Call us toll-free at <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline sm:hidden">
                    or directly at <a href="tel:+16048557605">1-604-855-7605</a>.<br>
                    All prices listed in USD. </p>
            </div>
        </div>
    </section>
    <span class="pack-details float-left mx-auto mb-7 px-2 pb-5 sm:px-0 sm:pb-9 lg:pb-11 hide"></span>
@stop
