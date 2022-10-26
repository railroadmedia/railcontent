@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Faster Fingers | Pianote</title>
    <meta name="description" content="Play faster, make fewer mistakes, and learn songs quickly!">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/og-image.jpg"
            style="display: none;">
    <meta property="og:title" content="Faster Fingers">
    <meta property="og:description" content="Play faster, make fewer mistakes, and learn songs quickly!">
    <meta property="og:url" content="https://www.pianote.com/faster-fingers">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/marketing/parcel/pianote/faster-fingers.css">
@stop

@section('global-body')
    @include('pianote.sales.nav', [
        "cartVersion" => true
    ])

    @include('pianote._partials._promo-banner', [
                    "name" => "Faster Fingers",
                    "fullPrice" => PianotePrices::$fasterFingersFull,
                    "price" => PianotePrices::$fasterFingersRegular,
                    "noBreadcrumb" => true
                ])

    <header class="header text-center">
        <div class="container" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/header.jpg);">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/logo.png">
            <br>
            <i class="fas fa-play play-vimeo autoplay-video" data-toggle="modal" data-target="#trailer"></i>
            <h2>Play <strong>faster</strong>, make <strong>fewer mistakes</strong>, <br
                        class="hidden-sm hidden-md hidden-lg">and <strong>learn songs</strong> quickly!</h2>
            <a
                class="join vue-add-to-cart"
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['faster-fingers' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                data-product-json='{"faster-fingers": 1}'
            >Get Started &raquo;</a>
            <p class="breakdown">
                @if(PianotePrices::$fasterFingersFull > PianotePrices::$fasterFingersRegular)
                    <s>NORMALLY ${{ PianotePrices::$fasterFingersFull }}.</s> &nbsp;
                    <strong><u>ONLY ${{ PianotePrices::$fasterFingersRegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (PianotePrices::$fasterFingersRegular / PianotePrices::$fasterFingersFull))) }}%)
                @else
                    <strong><u>ONLY ${{ PianotePrices::$fasterFingersRegular }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br> <strong
                        class="yellow">** 90-DAY GUARANTEE **</strong></p>
        </div>
    </header>

    <div class="modal fade text-center" id="trailer" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="vimeo" src="//player.vimeo.com/video/371759409" frameborder="0"
                            allowfullscreen allow="autoplay"></iframe>
                </div>
                <a href="{{ url()->route('shopping-cart.add-to-cart',
                ['products' => ['faster-fingers' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                        class="join stop-play" data-dismiss="modal" aria-label="Close">Get Started</a>
            </div>
        </div>
    </div>

    <section class="brief-pitch text-center">
        <div class="container">
            <h1>Increase Your Speed And Finger Strength<br class="hidden-xs hidden-md hidden-lg"> With This<br
                        class="hidden-xs hidden-sm"> Step-By-Step Training Pack.<br class="hidden-xs hidden-md hidden-lg">
                <strong>You WILL Get Faster!</strong></h1>
            @if(PianotePrices::$fasterFingersFull > PianotePrices::$fasterFingersRegular)
                <h3 class="text-red"><em><s>NORMALLY ${{ PianotePrices::$fasterFingersFull }}</s> - JUST ${{ PianotePrices::$fasterFingersRegular }}</em></h3>
            @else
                <h3 class="text-red"><em>ONLY ${{ PianotePrices::$fasterFingersRegular }}</em></h3>
            @endif
            <div class="wrapper">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/lisa.jpg">
                <p>Playing fast on the piano is merely a dream for a lot of people. So many try -- and fail -- to play quicker. Faster Fingers is your roadmap to success for increasing your speed on the keys -- and it will only take 10 minutes a day (or less).
                    <br><br> Why learn to play faster?
                    <br><br>Well, building speed will improve ALL other aspects of your piano playing -- so you’ll learn songs quicker, playing them faster, and play them BETTER.
                    <br><br>But really, you want to play faster because it feels amazing! Because you’ll be sitting at the piano and you’ll KNOW you’ve got this. No imposter syndrome. It’s all you - and everyone listening will know it.
                    <br><br>That’s the cool part.
                    <br><br>And you’ll get there with these exercises. You’ll improve your finger strength, dexterity, keyboard familiarity, control, and overall piano technique.
                    <br><br> This <strong>30-lesson training pack</strong> has been designed to give you real, measurable results. You’ll see (and hear!) exactly how much faster you are at the end.
                    <br><br> And your fingers will thank you.
                </p>
            </div>
        </div>
    </section>

    <section class="three-modal text-center">
        <div class="container">
            <h1>THE METRONOME DOESN’T LIE</h1>
            <p><strong class="text-red">50bpm. 80bpm. 140pm. 200pm.</strong>
                <br><br> These aren’t abstract concepts designed to make you feel better. These are REAL tempos that you can either play -- or you can’t.
                <br><br> This training pack cannot guarantee what speed you’ll reach. That’ll depend on your starting speed, previous experience and the work you’re willing to put in (and it will take work).
                <br><br>But we can guarantee that if you DO put in the work, and are consistent, you WILL get faster.
                <br><br>The metronome doesn’t lie. You’ll be tracking your tempo throughout the entire program and keeping notes.
                <br><br><strong>So what does that sound like?</strong>
                <br><br>Take a listen. Here are four different tempos - 50bpm -- 80bpm --- 140bpm -- 200bpm.
            </p>
            <div class="col-xs-12 col-sm-3 play-vimeo2" data-toggle="modal" data-target="#bpm50">
                <div class="modal-wrap">
                    <i class="fas fa-play"></i> <img
                            src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/50-bpm.jpg">
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 play-vimeo3" data-toggle="modal" data-target="#bpm80">
                <div class="modal-wrap">
                    <i class="fas fa-play"></i> <img
                            src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/80-bpm.jpg">
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 play-vimeo4" data-toggle="modal" data-target="#bpm140">
                <div class="modal-wrap">
                    <i class="fas fa-play"></i> <img
                            src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/140-bpm.jpg">
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 play-vimeo5" data-toggle="modal" data-target="#bpm200">
                <div class="modal-wrap">
                    <i class="fas fa-play"></i> <img
                            src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/200-bpm.jpg">
                </div>
            </div>
            <a
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['faster-fingers' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                class="join smaller vue-add-to-cart"
                data-product-json='{"faster-fingers": 1}'
            >Get Started &raquo;</a>
        </div>
        <img class="bg-icon left-icon" src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/icon-speedo.svg">
        <img class="bg-icon right-icon" src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/icon-metronome.svg">
    </section>
    <div class="modal fade" id="bpm50" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="vimeo2" src="//player.vimeo.com/video/373251537" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bpm80" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="vimeo3" src="//player.vimeo.com/video/373251544" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bpm140" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="vimeo4" src="//player.vimeo.com/video/373251574" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bpm200" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="vimeo5" src="//player.vimeo.com/video/373251586" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>

    <section class="why-speed-matters">
        <div class="container">
            <div class="wrapper">
                <img width="200px" src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/why-speed-matters.png">
                <p>In case you’re thinking, “So what? Why bother?”
                    <br><br>I totally get it. What good is it to play an exercise fast?
                    <br><br>Think about that time you heard someone play an incredible riff or run on the piano and thought… WOW! Maybe you thought, “I’ll never be able to play like that.”
                    <br><br>You can.
                    <br><br>Any piano player who can play fast got there by one way -- practice.
                    <br><br>And that’s what you’ll get through this training pack. You’ll develop the skills to play fast, so YOU can be the one playing those incredible riffs.
                    <br><br>And everyone who hears you will think… WOW!
                </p>
            </div>
        </div>
    </section>

    <section class="day-breakdown text-center">
        <div class="container">
            <img class="stars" width="150px" src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/5-stars.png">
            <h1>YOUR STEPS<br class="hidden-sm hidden-md hidden-lg"> TO SUCCESS</h1>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/thumb1.jpg">
                    <div class="top-badge">WEEK 1</div>
                </div>
                <p>
                    <strong>Waking Up The Fingers</strong><br> This week is all about establishing a baseline tempo, and getting your fingers used to the daily exercises you’ll be doing. You’ll also push to see how fast you can play at the start -- so you’ll be able to see how much better you are the end.
                    <br><span class="calendar">1</span><span class="calendar">2</span><span class="calendar">3</span><span class="calendar">4</span><span class="calendar">5</span>
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/thumb2.jpg">
                    <div class="top-badge">WEEK 2</div>
                </div>
                <p>
                    <strong>Developing Control</strong><br> You’ll see how much easier it is to play songs when you’re the master of your own fingers. In Week 2 you’ll work on getting your fingers to do EXACTLY what you want them to do.
                    <br><span class="calendar">1</span><span class="calendar">2</span><span class="calendar">3</span><span class="calendar">4</span><span class="calendar">5</span>
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/thumb3.jpg">
                    <div class="top-badge">WEEK 3</div>
                </div>
                <p>
                    <strong>Building Endurance</strong><br> Play fast -- for longer. It’s no fun playing fast if you can’t LAST! You’ll build your muscular endurance so you’ll be able to play longer, pain-free.
                    <br><span class="calendar">1</span><span class="calendar">2</span><span class="calendar">3</span><span class="calendar">4</span><span class="calendar">5</span>
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/thumb4.jpg">
                    <div class="top-badge">WEEK 4</div>
                </div>
                <p>
                    <strong>Honing Your Accuracy</strong><br> Play the notes you MEAN to play with pinpoint precision as you learn impressive-looking two-handed crossovers.
                    <br><span class="calendar">1</span><span class="calendar">2</span><span class="calendar">3</span><span class="calendar">4</span><span class="calendar">5</span>
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/thumb5.jpg">
                    <div class="top-badge">WEEK 5</div>
                </div>
                <p>
                    <strong>Rockstar Runs</strong><br> The final week is all about super speed. Learn a run that rock stars use, and realize just how far you’ve come, and how much faster you can play.
                    <br><span class="calendar">1</span><span class="calendar">2</span><span class="calendar">3</span><span class="calendar">4</span><span class="calendar">5</span>
                </p>
            </div>
            <br class="hidden-xs"><br> <a
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['faster-fingers' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                class="join smaller vue-add-to-cart"
                data-product-json='{"faster-fingers": 1}'
            >Get Started &raquo;</a>
        </div>
    </section>

    <section class="play-songs text-center">
        <div class="container">
            <h1>PLAY FASTER --<br class="hidden-sm hidden-md hidden-lg"> THE RIGHT WAY</h1>
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-piano-keyboard"></i>
                <p>
                    <strong>YOUR OWN PRACTICE PARTNER</strong><br> You will get 30 guided video lessons showing you exactly what to do -- at what tempo. No guessing about what comes next, Lisa will be there to show -- and motivate you.
                </p>
            </div>
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-list-ol"></i>
                <p>
                    <strong>NO GUESSWORK</strong><br> You’ll know exactly what to play, and when. Every single day of this training period has been thought of (including the rest days), so you don’t have to worry about WHAT you’ll practice. No guesswork -- only results.
                </p>
            </div>
            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-stopwatch"></i>
                <p>
                    <strong>SHORT PRACTICES</strong><br> Each lesson (and practice) will take just 10-minutes or less to finish. You’ll be practicing efficiently, and have more time to play songs. There’s no wasting time here.
                </p>
            </div>
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-music"></i>
                <p>
                    <strong>PLAY-ALONG AS YOU PRACTICE</strong><br> Specifically designed for you to play along and measure your progress. Practice along with every exercise and set your own tempo.
                </p>
            </div>
            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-chart-line"></i>
                <p>
                    <strong>SEE REAL RESULTS</strong><br> You’ll be able to measure your progress as you go along and SEE how much faster you’re getting. Simply fill in the progress tracker after each lesson.
                </p>
            </div>
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-question"></i>
                <p>
                    <strong>YOUR QUESTIONS ANSWERED</strong><br> Got questions? We’ll be available to answer any you might have. Whether you're struggling with one particular exercise or have a question about technique, we’re here for you.
                </p>
            </div>
            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-users"></i>
                <p>
                    <strong>THE BEST ONLINE COMMUNITY</strong><br> Share your progress and your success with the best online piano community. The Pianote forum is a great place to meet other students and find encouragement and support.
                </p>
            </div>
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-infinity"></i>
                <p>
                    <strong>LIFETIME ACCESS</strong><br> This training is 30 lessons. And you’ll have access to it for life. Come back anytime to brush up on your new-found speed skills. Or keep pushing to see how fast you can get.
                </p>
            </div>

        </div>
    </section>

    <section class="personal-teacher text-right" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/meet-lisa.jpg);">
        <div class="container">
            <h1>LISA WITT</h1>
            <h3 class="text-red">Your Teacher & Practice Planner</h3>
        </div>
    </section>

    <section class="teacher-bio">
        <div class="container">
            <p>
                <span class="first-letter">L</span>isa Witt knows what it’s like to play fast. She’s been teaching the piano for more than 18 years and has helped hundreds of students improve their speed, dexterity, and strength on the piano.
                <br><br> She knows exactly what exercises are guaranteed to increase your speed -- and she’s here to guide you through all of them -- step-by-step so you’ll see success.
                <br><br> “Playing faster is a goal for every pianist. But I’ve seen so many people try -- and fail -- because they went about it the wrong way. You need a plan!” she says.
                <br><br> Lisa has that plan. 30 guided practice sessions to get you flying across the keys.
                <br><br> She’s not only your teacher, but she’s also your practice partner.
                <br><br> “I will be with you EVERY STEP of this journey. I’m here to motivate, encourage and keep you accountable. You’re not doing this on your own.”
                <br><br> Each of the exercises has been hand-selected and developed by Lisa to build your strength and speed. It will only take 10-minutes a day or less to complete, but you’ll notice a difference almost immediately.
                <br><br> “The key is consistency. A little bit each day makes a BIG difference in the long run. That’s why it’s so important that you follow the program and practice WITH me, every day.”
                <br><br> Start playing faster today, with Faster Fingers.
            </p>
        </div>
    </section>

    <div class="testimonials">
        <div class="container">
            <div class="testimonial col-sm-4 col-xs-12">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/bernhard.jpg">
                <p>
                    <em>"Lisa is the perfect teacher. Her cheerful attitude is contagious, and she’s so encouraging, especially when I feel like I’m not making any progress. Her hands-on teaching approach is invaluable to my learning and helps me make progress more easily."</em><br>
                    <strong>BERNHARD ZAISINGER</strong> <em class="red">SWITZERLAND</em></p>
            </div>
            <div class="testimonial col-sm-4 col-xs-12">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/testimonials/daniel.jpg">
                <p>
                    <em>"I was stuck with a particular lesson on the Pianote Foundations course, so I tried Faster Fingers, and it worked! My playing went from 80bpm to 110bpm and continues to improve. If anyone’s got to the point where they’re even considering Faster Fingers, they’re going to want to try it out!"</em><br>
                    <strong>DANIEL MORGAN</strong> <em class="red">UNITED KINGDOM</em></p>
            </div>
            <div class="testimonial col-sm-4 col-xs-12">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/testimonials/dominic.jpg">
                <p>
                    <em>"I tried Faster Fingers because I wanted to improve my technique for playing faster pieces. I most liked the engaging lessons that help you to gradually build your finger speed. It's motivating, as Lisa's teaching method is infectious. To anyone thinking about the course, try it! Your fingers will thank you - so will your neighbours!"</em><br>
                    <strong>DOMINIC MORGAN</strong> <em class="red">UNITED KINGDOM</em></p>
            </div>
        </div>
    </div>

    <section class="guarantee">
        <div class="container">
            <div class="col-md-4 col-sm-5 col-xs-12 pull-right guarantee-icon">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/90-day.png" alt="90-Day Money-Back Guarantee">
            </div>
            <div class="col-md-8 col-sm-7 col-xs-12 guarantee-text">
                <h1>90-Day Money-Back Guarantee.</h1>
                <p>We love our students. More than anything, we want you to enjoy a super-positive experience playing piano. And that means we only want you to pay if you actually LOVE your Pianote experience! So join below to try it out totally risk-free. If it’s not for you, simply cancel your membership within 90 days and contact support for a full refund.</p>
            </div>
        </div>
    </section>

    <section class="final text-center" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/final.jpg);">
        <div class="container">
            {{--<img class="logo edge" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/cyber-monday/logo-blue.png"><br>--}}
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/logo.png">
            <h3>Play <strong>faster</strong>, make <strong>fewer mistakes</strong>, <br
                        class="hidden-sm hidden-md hidden-lg">and <strong>learn songs</strong> quickly!</h3>
            <a
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['faster-fingers' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                class="join vue-add-to-cart"
                data-product-json='{"faster-fingers": 1}'
            >Play Faster Today &raquo;</a>
            <p class="breakdown">
                @if(PianotePrices::$fasterFingersFull > PianotePrices::$fasterFingersRegular)
                    <s>NORMALLY ${{ PianotePrices::$fasterFingersFull }}.</s> &nbsp;
                    <strong><u>ONLY ${{ PianotePrices::$fasterFingersRegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (PianotePrices::$fasterFingersRegular / PianotePrices::$fasterFingersFull))) }}%)
                @else
                    <strong><u>ONLY ${{ PianotePrices::$fasterFingersRegular }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br> <strong
                        class="yellow">** 90-DAY GUARANTEE **</strong></p>

            {{--<div class="countdown columns no-padding">--}}
                {{--<p>HOLIDAY DEALS END IN:</p>--}}
                {{--<div class="tzcd-big">--}}
                    {{--<div><h1>00</h1> <p>days</p></div>--}}
                    {{--<div><h1>00</h1> <p>hrs</p></div>--}}
                    {{--<div><h1>00</h1> <p>mins</p></div>--}}
                    {{--<div><h1>00</h1> <p>secs</p></div>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="credit-cards col-xs-12">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-discover"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
            <div class="col-xs-12 questions">
                <p><strong>Any questions?</strong><br class="hidden-lg hidden-md hidden-sm"> Call us toll-free at <a
                            href="tel:+18004398921">1-800-439-8921</a> <br
                            class="hidden-lg hidden-md hidden-sm"> or directly at <a
                            href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>

    @include('pianote.sales.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            //modal video swapping
            $('.play-vimeo').on('click', function (ev) {

                $("#vimeo")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('.play-vimeo2').on('click', function (ev) {

                $("#vimeo2")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('.play-vimeo3').on('click', function (ev) {

                $("#vimeo3")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('.play-vimeo4').on('click', function (ev) {

                $("#vimeo4")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('.play-vimeo5').on('click', function (ev) {

                $("#vimeo5")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('body').on('click', '.modal, .modal .stop-play', function (e) {
                if (e.target !== this)
                    return;

                var newSource = $("#vimeo").attr('src').replace("?autoplay=1", " ");
                $("#vimeo").attr('src', newSource);

                var newSource2 = $("#vimeo2").attr('src').replace("?autoplay=1", " ");
                $("#vimeo2").attr('src', newSource2);

                var newSource3 = $("#vimeo3").attr('src').replace("?autoplay=1", " ");
                $("#vimeo3").attr('src', newSource3);

                var newSource4 = $("#vimeo4").attr('src').replace("?autoplay=1", " ");
                $("#vimeo4").attr('src', newSource4);

                var newSource5 = $("#vimeo5").attr('src').replace("?autoplay=1", " ");
                $("#vimeo5").attr('src', newSource5);
            });
        });
    </script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script src="{{ asset('marketing/js/pianote/manifest.js') }}"></script>
    <script src="{{ asset('marketing/js/pianote/vendor.js') }}"></script>
    <script src="{{ asset('marketing/js/pianote/cart-sidebar.js') }}"></script>
    <script src="{{ asset('marketing/js/pianote/app.js') }}"></script>
    @include('pianote._partials._promo-countdown')

    {!! inspectlet_embed_script() !!}

    @parent
@stop
