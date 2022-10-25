@extends('guitareo._partial.global-vue-layout')

@section('meta')
    @parent
    <title>The Guitar System  - Online Guitar Lessons With Nate Savage</title>
    <meta name="description" content="The Guitar System is a complete and comprehensive collection of online guitar lessons featuring Nate Savage.  The step-by-step video lessons are designed to produce rapid results for students of all skill levels.">

    <meta property="og:image" content="https://guitarsystem-com.s3.amazonaws.com/media/social/gs-1200x630.jpg" style="display: none;">
    <meta property="og:description" content="The Guitar System is a complete and comprehensive collection of online guitar lessons featuring Nate Savage.  The step-by-step video lessons are designed to produce rapid results for students of all skill levels.">
    <meta property="og:url" content="https://www.guitareo.com/guitar-system">
@stop()

@section('styles')
    @parent
    <link href="{{ asset('/marketing/parcel/guitareo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css" rel="stylesheet">
    <link href="{{ asset('marketing/parcel/guitareogs.css') }}" rel="stylesheet">
    <link href="{{ asset('marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
    <style>
        .text-yellow {
            color: #ffe200;
        }
    </style>
@stop()

@section('scripts')
    @parent
    <script src="/marketing/js/modal.js"></script>
    <script src="{{ asset('marketing/parcel/guitareo/nav-footer.js') }}"></script>
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

            $('.autoplay').on('click', function (ev) {
                $("#vimeo")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('body').on('click', '.reveal-overlay', function () {
                var newSource2 = $("#vimeo").attr('src').replace("?autoplay=1", "");
                $("#vimeo").attr('src', newSource2);
            });
        });
    </script>
@stop()


@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('guitareo._partials.promo-banner', [
                "name" => "Guitar System",
                "fullPrice" => GuitareoPrices::$guitarSystemFull,
                "price" => GuitareoPrices::$guitarSystemRegular,
                "noBreadcrumb" => true
            ])

    <header class="header stacked">
        <div class="row header-row">
            <div class="columns drumeo-free">
                <img src="https://guitareo.s3.amazonaws.com/tripwire/gs-logo.png">
            </div>
            <div class="columns video-container">
                <i class="fas fa-play play-button autoplay" data-open="previewModal"></i>
            </div>
            <div class="columns text-container">
                {{--<div class="course-logo">--}}
                    {{--<h2>THE <strong>FASTER WAY</strong><br class="hide-for-medium"> TO LEARN GUITAR</h2>--}}
                {{--</div>--}}
                <p><strong>Transform your guitar playing with the <br class="show-for-medium">ULTIMATE Encyclopedia of Guitar Lessons</strong></p>
                <a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['GUITAR-SYSTEM' => 1],'redirect' => '/order']) }}" class="join" data-product-json='{"GUITAR-SYSTEM": 1}'>Get Started &raquo;</a>
                <p class="price-info">
                    @if(GuitareoPrices::$guitarSystemFull > GuitareoPrices::$guitarSystemRegular)
                        <s>NORMALLY ${{ GuitareoPrices::$guitarSystemFull }}.</s> &nbsp;<strong><u>ONLY ${{ GuitareoPrices::$guitarSystemRegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (GuitareoPrices::$guitarSystemRegular / GuitareoPrices::$guitarSystemFull))) }}%)
                    @else
                        <strong><u>ONLY ${{ GuitareoPrices::$guitarSystemRegular }}</u></strong>
                    @endif
                    <br><a href="/" class="text-guitareo">(OR FREE WITH A GUITAREO MEMBERSHIP)</a>
                        <br> <strong>** 90-DAY GUARANTEE **</strong>

                </p>

            </div>
        </div>
        <div class="reveal large" id="previewModal" data-reveal data-reset-on-close="true">
            <div class="flex-video widescreen vimeo">
                <iframe id="vimeo" src="//player.vimeo.com/video/80979282" frameborder="0" allowfullscreen allow="autoplay"></iframe>

            </div>
        </div>
    </header>


    {{--<section class="featured-product">--}}
        {{--<div class="noise-wrap">--}}
            {{--<div class="row">--}}
                {{--<a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['GUITAR-SYSTEM' => 1], 'redirect' => '/order']) }}">--}}
                    {{--<img class="logo animated tada delay-2s" src="https://guitareo.s3.amazonaws.com/sales/promos/april/guitar-month-logo.png">--}}
                    {{--<br>--}}
                    {{--<div class="text">--}}
                        {{--<p class="text-left" style="max-width:510px">It’s Guitar Month! And we’re celebrating by giving you a {{ round(100 - (100 * (GuitareoPrices::$guitarSystemRegular / GuitareoPrices::$guitarSystemFull))) }}% discount on our most popular training pack where you’ll learn ANYTHING you want on guitar.--}}
                            {{--<br><br>--}}
                            {{--Yes, anything!--}}
                            {{--<br><br>--}}
                            {{--The Guitar System is the ultimate encyclopedia of guitar lessons -- and it’s an affordable solution to reach your goals. So hey, why not join us and reach your goals?--}}
                            {{--<br><br>--}}
                            {{--<u>Just click here to get started</u> -- and join in the celebration by playing and creating the music you love.--}}
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

    <section class="lesson-breakdown">
        <div class="row">
            <h1>Learn How To Play Anything On Guitar... <u>For Just ${{ GuitareoPrices::$guitarSystemRegular }}</u></h1>
            {{--<h3 class="light"><em><s>NORMALLY ${{ GuitareoPrices::$guitarSystemFull }}</s></em></h3>--}}
            <h3 class="light">&nbsp;</h3>
            <div class="columns tile-wrap small-up-2 medium-up-3">
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/1.jpg",
                "tileTitle" => "Guitar Fundamentals",
                "lessonNumber" => "14",
                "lessonDuration" => "1 HR 26",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/2.jpg",
                "tileTitle" => "Guitar Gear & Tone",
                "lessonNumber" => "13",
                "lessonDuration" => "1 HR 37",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/3.jpg",
                "tileTitle" => "Power Chords",
                "lessonNumber" => "13",
                "lessonDuration" => "1 HR 4",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/4.jpg",
                "tileTitle" => "Palm Muting & Theory",
                "lessonNumber" => "29",
                "lessonDuration" => "1 HR 9",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/5.jpg",
                "tileTitle" => "Open Chords & Strumming",
                "lessonNumber" => "21",
                "lessonDuration" => "1 HR 21",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/6.jpg",
                "tileTitle" => "Minor Chords & Walk Downs",
                "lessonNumber" => "11",
                "lessonDuration" => "49",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/7.jpg",
                "tileTitle" => "Bar Chords",
                "lessonNumber" => "19",
                "lessonDuration" => "1 HR 35",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/8.jpg",
                "tileTitle" => "Into The World Of Lead Guitar",
                "lessonNumber" => "29",
                "lessonDuration" => "1 HR 30",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/9.jpg",
                "tileTitle" => "More Pentatonic Scales & The Blues",
                "lessonNumber" => "24",
                "lessonDuration" => "59",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/10.jpg",
                "tileTitle" => "Essential Guitar Scales & Lead Techniques",
                "lessonNumber" => "33",
                "lessonDuration" => "1 HR 10",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/11.jpg",
                "tileTitle" => "Riffs & Cross Picking",
                "lessonNumber" => "13",
                "lessonDuration" => "1 HR 5",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/12.jpg",
                "tileTitle" => "Major Keys & More Chords",
                "lessonNumber" => "25",
                "lessonDuration" => "1 HR 29",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/13.jpg",
                "tileTitle" => "Scales & Sequencing",
                "lessonNumber" => "23",
                "lessonDuration" => "56",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/14.jpg",
                "tileTitle" => "More Scales & Lead Techniques",
                "lessonNumber" => "32",
                "lessonDuration" => "1 HR 10",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/15.jpg",
                "tileTitle" => "Intervals & Arpeggios",
                "lessonNumber" => "20",
                "lessonDuration" => "48",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/16.jpg",
                "tileTitle" => "The Blues",
                "lessonNumber" => "28",
                "lessonDuration" => "1 HR 33",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/17.jpg",
                "tileTitle" => "Strumming, Riffs, Chords, & Minor Keys",
                "lessonNumber" => "22",
                "lessonDuration" => "1 HR 16",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/18.jpg",
                "tileTitle" => "Alternate Tunings & Advanced Chords",
                "lessonNumber" => "19",
                "lessonDuration" => "58",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/19.jpg",
                "tileTitle" => "Lead Techniques, Scales, & Fretboard Layout",
                "lessonNumber" => "34",
                "lessonDuration" => "1 HR 29",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/20.jpg",
                "tileTitle" => "Scales, Sequencing & Sweep Picking",
                "lessonNumber" => "24",
                "lessonDuration" => "1 HR 19",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/21.jpg",
                "tileTitle" => "Knowing Your Fretboard",
                "lessonNumber" => "26",
                "lessonDuration" => "1 HR 17",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/22.jpg",
                "tileTitle" => "Advanced Lead Concepts",
                "lessonNumber" => "36",
                "lessonDuration" => "1 HR 19",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/23.jpg",
                "tileTitle" => "7th Arpeggios & Modal Playing",
                "lessonNumber" => "22",
                "lessonDuration" => "54",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/24.jpg",
                "tileTitle" => "Chops & Metal",
                "lessonNumber" => "28",
                "lessonDuration" => "1 HR 33",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/25.jpg",
                "tileTitle" => "Fingerstyle & Classical",
                "lessonNumber" => "19",
                "lessonDuration" => "1 HR 35",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/26.jpg",
                "tileTitle" => "Bluegrass & Country",
                "lessonNumber" => "25",
                "lessonDuration" => "1 HR 47",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/27.jpg",
                "tileTitle" => "Jazz",
                "lessonNumber" => "26",
                "lessonDuration" => "1 HR 22",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/28.jpg",
                "tileTitle" => "Music Theory & Reading Music",
                "lessonNumber" => "34",
                "lessonDuration" => "1 HR 34",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/29.jpg",
                "tileTitle" => "Ear Training & Playing By Ear",
                "lessonNumber" => "35",
                "lessonDuration" => "48",
                ])
                @include('guitareo.products._lesson-tile', [
                "imageURL" => "https://guitareo.s3.amazonaws.com/tripwire/thumbnails/30.jpg",
                "tileTitle" => "Play-Alongs",
                "lessonNumber" => "12",
                "lessonDuration" => "38",
                ])
            </div>
            <a href="#order-section" class="join anchor-slide">Get Started &raquo;</a>
            <p class="price-info">{{--SAVE {{ round(100 - (100 * (GuitareoPrices::$guitarSystemRegular / GuitareoPrices::$guitarSystemFull))) }}% +--}} 90-DAY MONEY BACK GUARANTEE</p>
        </div>
    </section>

    <section class="three-icon">
        <div class="row">
            <h1 class="columns">THE ULTIMATE ENCYCLOPEDIA OF GUITAR LESSONS</h1>
            <h3 class="columns">Learn anything you want on the guitar with Nate Savage’s best-selling video <br class="show-for-large">
                                lessons that have been trusted by thousands of guitarists around the world!</h3>
            <div class="columns medium-6 circle-point">
                <div class="point-icon"><i class="fal fa-signal"></i></div>
                <p><strong>Beginner To Advanced</strong><br>
                    Perfect for guitarists of all levels with progressive step-by-step lessons on every topic.</p>
            </div>
            <div class="columns medium-6 circle-point">
                <div class="point-icon"><i class="fal fa-video"></i></div>
                <p><strong>Guided Video Lessons</strong><br>
                    Learn at your own pace with easy to follow video lessons and online progress tracking.</p>
            </div>
            <div class="columns medium-6 circle-point">
                <div class="point-icon"><i class="fal fa-music"></i></div>
                <p><strong>85+ Guitar Jam Tracks</strong><br>
                    Half the fun learning the guitar is playing along to music, so you’ll get tons of jam tracks to enjoy.</p>
            </div>
            <div class="columns medium-6 circle-point">
                <div class="point-icon"><i class="fal fa-laptop"></i></div>
                <p><strong>Instant Online Access</strong><br>
                    Start your first lesson today with 24/7 online access from any computer, tablet, or smartphone.</p>
            </div>
            <div class="columns medium-6 circle-point">
                <div class="point-icon"><i class="fal fa-id-card"></i></div>
                <p><strong>Unlimited Lifetime Access</strong><br>
                    Get The Guitar System for just ${{ GuitareoPrices::$guitarSystemRegular }} today to get online access to the entire course - for life.</p>
            </div>
            <div class="columns medium-6 circle-point">
                <div class="point-icon"><i class="fal fa-thumbs-up"></i></div>
                <p><strong>Money-Back Guarantee</strong><br>
                    Try The Guitar System risk-free for three months with our 90-day money back guarantee.</p>
            </div>
        </div>
    </section>

    <section class="student-reviews">
        <div class="row">
            <div class="columns medium-4 testimonial-wrap">
                <img src="https://s3.amazonaws.com/guitareo/sales/testimonials/erick-kahlenberg.jpg">
                <p>"I had lessons for 5 or 6 years. I learned more in the 1st year of taking lessons from Nate than I learned in those lessons or the last 20 years of learning on my own."</p>
                <h2>Erick Kahlenberg <span class="location">- Wisconsin</span></h2>
            </div>
            <div class="columns medium-4 testimonial-wrap">
                <img src="https://s3.amazonaws.com/guitareo/sales/testimonials/bill-bailey.jpg">
                <p>"I've not had this much fun with the guitar since that Christmas many years ago. I enjoy the lessons and I'm learning things quickly. That motivates me to continue..."</p>
                <h2>Bill J. Bailey <span class="location">- Louisiana</span></h2>
            </div>
            <div class="columns medium-4 testimonial-wrap">
                <img src="https://s3.amazonaws.com/guitareo/sales/testimonials/tom-perry.jpg">
                <p>"Nate is a natural born teacher. He’s patient, thorough, clearly explains new material, builds a solid foundation for any technique and progresses one step at a time."</p>
                <h2>Tom Perry <span class="location">- Texas</span></h2>
            </div>
        </div>
    </section>

    <section class="meet-nate">
        <div class="row">
            <div class="columns large-5 medium-6 end">
                <h2>LETTER FROM</h2>
                <h1>NATE SAVAGE</h1>
                <p>&nbsp;</p>
            </div>
        </div>
    </section>

    <section class="nate-bio">
        <div class="row">
            <p class="columns paragraph-split">
                <span class="first-letter"><img src="https://guitareo.s3.amazonaws.com/tripwire/bold-p.png"></span>laying the guitar is both fun and rewarding. So, why is it difficult to make steady and consistent progress? Why do some students seem to learn much faster than others? Do they just have a natural skill advantage or is there something more to it than that?
                <br><br>
                I’ve spent the last 17 years teaching the guitar to students around the world. From what I’ve seen, the most successful students have one thing in common. That is, they have clarity on the exact steps they need to take in order to get better. They don’t spend their time wondering what to do next, while playing the same old riffs over and over again.
                <br><br>
                Now, there are thousands of video guitar lessons available online, but the unfortunate reality is that these lessons are inconsistent, disorganized, and often unqualified. This can really stall out your progress and even lead to bad habits that will set you back.
                <br><br>
                With this in mind, I created The Guitar System training pack. It provides you with a complete roadmap so you’ll know exactly what to do in order to learn rock, blues, reggae, metal, punk, jazz, fingerstyle, classical, country, bluegrass, and more. The step-by-step video lessons, fun play-along songs, and unique training tools make learning easier than ever.
            </p>
            <hr class="columns no-padding">
            <div class="columns signature"><img src="https://www.guitarsystem.com/includes/images/nate-signature.png"></div>
            <p class="columns">
                P.S. - The Guitar System is backed by my 90 day money-back guarantee. That means you have three full months to try it out with absolutely nothing to lose. If you are unhappy for any reason whatsoever, simply return it for a prompt and courteous refund.
            </p>
        </div>
    </section>

    <section class="student-reviews">
        <div class="row">
            <div class="columns medium-4 testimonial-wrap">
                <img src="https://s3.amazonaws.com/guitareo/sales/testimonials/doug-j-d.jpg">
                <p>"I was glad that I did sign up form the program. The program starts out teaching you how to hold the guitar and pick and the first thing you play is a practice lesson."</p>
                <h2>Kevin Gouty <span class="location">- Indiana</span></h2>
            </div>
            <div class="columns medium-4 testimonial-wrap">
                <img src="https://s3.amazonaws.com/guitareo/sales/testimonials/wayne-saverud.jpg">
                <p>"I'm amazed as to how quickly you respond to questions on your website. I know that the money I spent on your Guitar System was well worth it…"</p>
                <h2>Wayne Saverud <span class="location">- Washington</span></h2>
            </div>
            <div class="columns medium-4 testimonial-wrap">
                <img src="https://s3.amazonaws.com/guitareo/sales/testimonials/john-williams.jpg">
                <p>"I was not sure if online lessons would work for me, so when I started the online lessons I also decided to take one on one lessons with an instructor…"</p>
                <h2>John Williams <span class="location">- Michigan</span></h2>
            </div>
        </div>
    </section>

    <section class="guarantee">
        <div class="row">
            <div class="large-4 medium-5 columns float-right text-center medium-text-right">
                <img src="https://guitareo.s3.amazonaws.com/sales/90-day.png" alt="90-Day Money-Back Guarantee">
            </div>
            <div class="large-8 medium-7 columns text-center medium-text-left">
                <h1>90-Day Money-Back Guarantee.</h1>
                <p>We love our students. More than anything, we want you to enjoy a super-positive experience playing guitar. And that means we only want you to pay if you actually LOVE your Guitareo experience! So join below to try it out totally risk-free. If it’s not for you, simply <a class="text-white" href="/support">contact us</a> within 90 days to request a full refund.</p>
            </div>
        </div>
    </section>

    <div id="order-section" class="anchor anchor-slide"></div>
    <section class="final text-center">
        <div class="row">
            {{--<img class="logo edge" src="https://guitareo.s3.amazonaws.com/sales/promos/cyber-monday/logo.png"><br>--}}
            <img class="logo" src="https://guitareo.s3.amazonaws.com/tripwire/gs-logo.png">
            <h2>The Ultimate Encyclopedia <br>Of Guitar Lessons</h2>
            <a href="{{ url()->route('shopping-cart.add-to-cart',
                ['products' => ['GUITAR-SYSTEM' => 1], 'redirect' => '/order']) }}" class="join" data-product-json='{"GUITAR-SYSTEM": 1}'>Get Started &raquo;</a>
            <p class="breakdown">
                @if(GuitareoPrices::$guitarSystemFull > GuitareoPrices::$guitarSystemRegular)
                    <s style="opacity: 0.6;">NORMALLY ${{ GuitareoPrices::$guitarSystemFull }}.</s> &nbsp;<strong><u>ONLY ${{ GuitareoPrices::$guitarSystemRegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (GuitareoPrices::$guitarSystemRegular / GuitareoPrices::$guitarSystemFull))) }}%)
                @else
                    <strong><u>ONLY ${{ GuitareoPrices::$guitarSystemRegular }}</u></strong>
                @endif
                <br><a href="/" class="text-guitareo">(OR FREE WITH A GUITAREO MEMBERSHIP)</a>
                <br><strong>** 90-DAY GUARANTEE **</strong></p>
            <div class="credit-cards columns">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
            <div class="columns questions">
                <p><strong>Any questions?</strong><br class="hide-for-medium">
                    Call us toll-free at <a href="tel:+18004398921">1-800-439-8921</a> <br class="hide-for-medium">
                    or directly at <a href="tel:+16048557605">1-604-855-7605</a>.<br>
                    All prices listed in USD. </p>
            </div>
        </div>
    </section>
    @include("guitareo.sales.partials._footer")
@stop
