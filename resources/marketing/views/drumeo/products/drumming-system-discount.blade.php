@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>Drumming System</title>
    <meta name="description" content="Turn your drumming goals into reality with video lessons, practice plans, & play-alongs.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Drumming Starts Here">
    <meta property="og:description" content="Turn your drumming goals into reality with video lessons, practice plans, & play-alongs.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <?php \App\Analytics\Tracker::trackProductImpression('DSYS2-DIGI'); ?>
    <link href="{{ asset('/marketing/parcel/drumeo/tripwire.css') }}" rel="stylesheet">
    <style>
        .top-bar .button-wrap .join:nth-child(1) {
            display: none;
        }
    </style>
@stop()

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop()

@section('content')
    @include('drumeo.products.partials.promo-banner', [
                    "name" => "Drumming System",
                    "fullPrice" => Prices::$dsOnlineFull,
                    "price" => Prices::$dsOnlineRegular,
                "noBreadcrumb" => true
                ])
    <header class="header stacked">
        <div class="container mx-auto clearfix xlarge" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/mike-bg.jpg);">
            <img class="px-4 w-auto max-h-20 mx-auto" src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/ds-logo.png">

            <div class="float-left w-full px-3 sm:px-4 video-container">
                <i data-open="previewModal" class="fas fa-play play-button autoplay-video"></i>
            </div>
            <div class="float-left w-full px-3 sm:px-4 text-container">
                <div class="course-logo">
                    <h2>DRUMMING <strong>STARTS HERE</strong></h2>
                </div>
                <p>Turn your drumming goals into reality with <br class="inline sm:hidden">
                    video lessons, practice plans, & play-alongs.</p>
                <a href="/laravel/public/shopping-cart/api/query?products[DSYS2-DIGI]=1" class="join blue">Get Started &raquo;</a>


                <p class="price-info">
                    @if(Prices::$dsOnlineFull > Prices::$dsOnlineRegular)
                        <s>NORMALLY ${{ Prices::$dsOnlineFull }}.</s>
                        <strong>NOW ${{ Prices::$dsOnlineRegular }}</strong>
                        (SAVE {{ round(100 - (100 * (Prices::$dsOnlineRegular / Prices::$dsOnlineFull))) }}%).
                    @else
                        <strong>ONLY ${{ Prices::$dsOnlineRegular }}</strong>
                    @endif
                    <br> <span class="text-blue">90-DAY GUARANTEE.</span></p>
            </div>
        </div>
        <div class="reveal large" id="previewModal" data-reveal data-reset-on-close="false">
            <div class="flex-video widescreen vimeo">
                <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/261505923?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
        </div>
    </header>

    <section class="lesson-breakdown">
        <div class="container mx-auto clearfix">
            <h1>Learn Everything On The Drums... <u>For Just ${{ Prices::$dsOnlineRegular }}</u></h1>
            <h3 class="light"><s>NORMALLY ${{ Prices::$dsOnlineFull }}</s></h3>
            <div class="float-left w-full px-3 sm:px-4 tile-wrap grid grid-cols-2 sm:grid-cols-3 gap-4">
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/1.jpg",
                "tileTitle" => "Play Drums By Ear",
                "tileDescription" => "Start playing drums for the very first time - no sheet music or reading required!",
                "lessonNumber" => "10",
                "lessonDuration" => "1 HR 38",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/2.jpg",
                "tileTitle" => "Practice Efficiently",
                "tileDescription" => "Create the perfect routine to get the most out of your practice time.",
                "lessonNumber" => "8",
                "lessonDuration" => "27",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/3.jpg",
                "tileTitle" => "Theory & Notation",
                "tileDescription" => "Drum theory doesn’t need to be complicated. Get ready to understand music on a whole new level.",
                "lessonNumber" => "20",
                "lessonDuration" => "1 HR 58",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/4.jpg",
                "tileTitle" => "Hand Techniques",
                "tileDescription" => "Get the most out of every single stroke with proper hand technique that will change your playing.",
                "lessonNumber" => "4",
                "lessonDuration" => "1 HR 6",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/5.jpg",
                "tileTitle" => "Drum Rudiments",
                "tileDescription" => "Get valuable insights into the 40 drum rudiments and exactly how to apply them around the kit.",
                "lessonNumber" => "48",
                "lessonDuration" => "1 HR 36",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/6.jpg",
                "tileTitle" => "Foot Techniques",
                "tileDescription" => "Improve your bass drum speed, power, control, and independence.",
                "lessonNumber" => "13",
                "lessonDuration" => "1 HR 42",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/7.jpg",
                "tileTitle" => "Heavy Rock",
                "tileDescription" => "Learn beginner to advanced grooves for punk, heavy metal, speed metal, grunge, prog, and hard rock.",
                "lessonNumber" => "28",
                "lessonDuration" => "1 HR 23",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/8.jpg",
                "tileTitle" => "Mixed Rock",
                "tileDescription" => "Dive into sub genres of rock including folk rock, classic rock, country, and odd-time.",
                "lessonNumber" => "20",
                "lessonDuration" => "1 HR 58",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/9.jpg",
                "tileTitle" => "Groove Rock",
                "tileDescription" => "Play the drums with more groove with blues, funk, reggae, and shuffle beats!",
                "lessonNumber" => "21",
                "lessonDuration" => "1 HR 59",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/10.jpg",
                "tileTitle" => "Jazz & Latin",
                "tileDescription" => "Take your playing to the next level with jazz and latin drumming patterns and play-alongs.",
                "lessonNumber" => "10",
                "lessonDuration" => "58",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/11.jpg",
                "tileTitle" => "Drum Fills",
                "tileDescription" => "Finally play the amazing drum fills that you’ve always wished you could.",
                "lessonNumber" => "8",
                "lessonDuration" => "1 HR 49",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/12.jpg",
                "tileTitle" => "Dynamic Drumming",
                "tileDescription" => "Add dynamics to your playing to make even the simplest of drum beats sound amazing.",
                "lessonNumber" => "6",
                "lessonDuration" => "58",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/13.jpg",
                "tileTitle" => "How To Build Speed",
                "tileDescription" => "Build incredible speed with simple exercises that are proven to work.",
                "lessonNumber" => "7",
                "lessonDuration" => "46",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/14.jpg",
                "tileTitle" => "Setup, Tuning, & Gear",
                "tileDescription" => "Learn everything you need to get your kit setup and sounding great!",
                "lessonNumber" => "8",
                "lessonDuration" => "1 HR 34",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/15.jpg",
                "tileTitle" => "Live Gig & Studio Drumming",
                "tileDescription" => "Want to become a working drummer? Mike shares his best advice from 20+ years in the business.",
                "lessonNumber" => "6",
                "lessonDuration" => "1 HR 2",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/16.jpg",
                "tileTitle" => "Drum Soloing",
                "tileDescription" => "Create unique & musical drum solos that express your personality on the drums.",
                "lessonNumber" => "16",
                "lessonDuration" => "2 HR 37",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/17.jpg",
                "tileTitle" => "Drum Play-Alongs 1",
                "tileDescription" => "28 play-alongs that work well for every style of music covered in the Drumming System.",
                "lessonNumber" => "28",
                "lessonDuration" => "2 HR 5",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/18.jpg",
                "tileTitle" => "Drum Play-Alongs 2",
                "tileDescription" => "20 more play-alongs along so you can apply your skills to real music.",
                "lessonNumber" => "20",
                "lessonDuration" => "2 HR 5",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/19.jpg",
                "tileTitle" => "Writing With A Band",
                "tileDescription" => "See exactly what it takes to write music as a band creates and then performs six new tracks.",
                "lessonNumber" => "13",
                "lessonDuration" => "3 HR 26",
                ])
                @include('drumeo.products.partials.lesson-tile2', [
                "imageURL" => "https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/thumbnails/20.jpg",
                "tileTitle" => "Hand Drumming & Percussion",
                "tileDescription" => "Get more options for creating music with the congas, djembe, cajon, shakers, tambourines, and more!",
                "lessonNumber" => "44",
                "lessonDuration" => "3 HR 10",
                ])
            </div>
            <a class="join blue" href="/laravel/public/shopping-cart/api/query?products[DSYS2-DIGI]=1">Get Everything <span class="show-for-medium">Above </span>For Just ${{ Prices::$dsOnlineRegular }} &raquo;</a>
            <p class="price-info">{{--SAVE {{ round(100 - (100 * (Prices::$dsOnlineRegular / Prices::$dsOnlineFull))) }}% +--}} 90-DAY MONEY BACK GUARANTEE</p>
        </div>
    </section>
    <section class="three-icon">
        <div class="container mx-auto clearfix">
            <h1 class="float-left w-full px-3 sm:px-4">THE ULTIMATE ENCYCLOPEDIA OF DRUM LESSONS</h1>
            <h3 class="float-left w-full px-3 sm:px-4">Learn anything you want on the drums with Mike Michalkow’s best-selling video <br class="hidden lg:inline">
                                lessons that have been trusted by more than 20,000 drummers around the world!</h3>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-signal"></i></div>
                <p><strong>Beginner To Advanced</strong><br>
                    Perfect for drummers of all levels with progressive step-by-step lessons on every topic.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-video"></i></div>
                <p><strong>Guided Video Lessons</strong><br>
                    Learn at your own pace with easy to follow video lessons and online progress tracking.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-music"></i></div>
                <p><strong>100+ Play-Along Songs</strong><br>
                    Half the fun learning the drums is playing with a band, so you’ll get tons of play-alongs to enjoy.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-desktop"></i></div>
                <p><strong>Instant Online Access</strong><br>
                    Start your first lesson today with 24/7 online access from any computer, tablet, or smartphone.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-infinity"></i></div>
                <p><strong>Unlimited Lifetime Access</strong><br>
                    Get the Drumming System for just ${{ Prices::$dsOnlineRegular }} today to get online access to the entire course - for life.</p>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 circle-point">
                <div class="point-icon"><i class="fal fa-shield-check"></i></div>
                <p><strong>Money-Back Guarantee</strong><br>
                    Try the Drumming System risk-free for three months with our 90-day money back guarantee.</p>
            </div>
        </div>
    </section>

    <section class="student-reviews">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/testimonials/geoff-arnold.jpg">
                <p>"Mike Michalkow lays down a very well thought out learning program for you, from your first whack at the skins for the newcomer, on through to a seasoned player."</p>
                <h2>Geoff Arnold <span class="location">- Oregon</span></h2>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/testimonials/matt-denton.jpg">
                <p>"My drumming is transformed. With all of the new patterns I am learning the band I am in are blown away... Thank you, Thank you, Thank you!"</p>
                <h2>Matt Denton <span class="location">- New Jersey</span></h2>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/testimonials/pedro-rios.jpg">
                <p>"...all it took was to play the Drumming System DVD #1, and boy did I improve in less than 1 hour. I only wish this system was available sooner."</p>
                <h2>Pedro Rios <span class="location">- Puerto Rico</span></h2>
            </div>
        </div>
    </section>

    <section class="history-bruce">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-3 sm:px-4 sm:w-7/12 end">
                <h1>Mike Michalkow: 20+ Years <br class="hidden lg:inline"> of World-Class Teaching</h1>
                <p class="hidden sm:inline">"He doesn't assume what you know or don't know; he lays it all out very simply, and lets the viewer determine how to proceed..."</p>
                <div class="float-left w-full px-3 sm:px-4 no-padding steve-details hidden sm:inline">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/omar.jpg">
                    <div class="float-left w-full px-3 sm:px-4 end text">
                        <h2>OMAR ALVARADO</h2>
                        <h3>Georgia</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bruce-bio">
        <div class="container mx-auto clearfix">
            <p class="float-left w-full px-3 sm:px-4">
                <span class="first-letter"><img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/bold-m.png"></span>ike Michalkow has been performing, recording, and teaching drums for more than 20 years -- with a storied career that has him connecting with hundreds of thousands of drumming students and brushing shoulders with many of the most recognized performers in the industry.
                <br><br>
                Mike started playing the drums at 17 years of age under the direction of Mitch Dorge (Crash Test Dummies) and quickly made a name for himself when he started his performing career. Soon after, he attended Grant MacEwan College in Edmonton where he majored in Latin and Jazz and graduated at the top of his class.
                <br><br>
                During the summer of 1993, Mike spent his time in New York City where he took private lessons on the drum set and conga at the “Drummers Collective”. During the evening, he would hang out at local jazz clubs where he could learn and see many of his favorite artists perform including Marvin “Smitty” Smith, Max Roach, and Tony Williams.
                <br><br>
                Mike’s journey then goes in each and every direction: playing in original and cover bands, playing as the orchestra drummer for a popular cruise line, and taking lessons from legendary teachers including John Fisher, Jim Chapin, Chuck Silverman, Peter Magadini, Virgil Donati, and Dom Famularo.
                <br><br>
                Music was no longer just a career, but a way of life. And Mike applied the lessons he learned along the way by recording and playing with bands ranging from progressive rock, latin, jazz, blues, pop, folk, celtic, country, metal, and R&B -- along with performing at drum festivals, playing in symphonies, and sharing the stage with some of the greatest drummers of our time including Chad Smith, John “JR” Robinson, Cindy Blackman, and many others.
                <br><br>
                For the past 10 years, Mike has been committed to sharing the knowledge that he was so grateful to receive from others -- creating popular drum lesson DVDs and online lesson packs including “The Moeller Method Secrets”, “The Jazz Drumming System”, “The Latin Drumming System”, and his newest & largest video project to date: “The Drumming System”.
            </p>
        </div>
    </section>

    <section class="student-reviews">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/testimonials/kevin-gouty.jpg">
                <p>"Mike teaching style is very patient and detailed. I am a veteran drummer of 30+ yrs and I am learning new techniques and things that I never knew"</p>
                <h2>Kevin Gouty <span class="location">- Indiana</span></h2>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/testimonials/dana-meyer.jpg">
                <p>"Mike made it so simple. Learning the fills has been great and after I get them down pat, I'm looking forward to demonstrating what I've learned."</p>
                <h2>Dana Meyer <span class="location">- Nebraska</span></h2>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/testimonials/john-pines.jpg">
                <p>"...Mike keeps it real, you never feel like you are being talked down to. Most importantly, the teaching style makes it easy to learn..."</p>
                <h2>John Pines <span class="location">- Michigan</span></h2>
            </div>
        </div>
    </section>

    <section class="guarantee">
        <div class="container mx-auto clearfix">
            <div class="lg:w-1/4 sm:w-1/3 w-full px-3 sm:px-4 float-right text-center sm:text-right">
                <img src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png" alt="90-Day Money-Back Guarantee">
            </div>
            <div class="lg:w-9/12 sm:w-8/12 float-left w-full px-3 sm:px-4 text-center sm:text-left">
                <h1>90-Day Money-Back Guarantee.</h1>
                <p>More than anything, we want you to enjoy a super-positive experience on the drums. And that means we
                    only want you to pay if you actually LOVE your Drumming System experience. So get started below to
                    try it out risk-free. If it’s not for you, simply <a class="text-white" href="/support">contact us</a> within 90 days for a full refund.</p>
            </div>
        </div>
    </section>

    <section class="final">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-3 sm:px-4 logo">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/ds/ds-logo.png">
            </div>
            <h2 class="float-left w-full px-3 sm:px-4">Get the ultimate encyclopedia of drum lessons <br class="inline sm:hidden">
                                for a one-time payment of just ${{ Prices::$dsOnlineRegular }}.</h2>
            <div class="float-left w-full px-3 sm:px-4"><a href="/laravel/public/shopping-cart/api/query?products[DSYS2-DIGI]=1" class="join blue">Get Started &raquo;</a></div>
            {{--<a class="join sold-out">Sold Out</a>--}}

            <h2 class="float-left w-full px-3 sm:px-4 highlighted">
                @if(Prices::$dsOnlineFull > Prices::$dsOnlineRegular)
                    <s>NORMALLY ${{ Prices::$dsOnlineFull }}.</s>
                    <strong>NOW ${{ Prices::$dsOnlineRegular }}</strong>
                    (SAVE {{ round(100 - (100 * (Prices::$dsOnlineRegular / Prices::$dsOnlineFull))) }}%).
                @else
                    <strong>ONLY ${{ Prices::$dsOnlineRegular }}</strong>
                @endif
                <br> <span class="text-blue">90-DAY GUARANTEE.</span>
            </h2>

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
