@extends('drumeo.products.misc-products-layout')


@section('meta')
    @parent

    <title>Tony Royster Jr. Masterclass</title>
    <meta name="description"
            content="In three hours of exclusive video, Tony teaches you everything he has learned for becoming a seasoned musician.">

    <meta property="og:image" content="https://dzryyo1we6bm3.cloudfront.net/trj/final-pitch.jpg" style="display: none;">
    <meta property="og:description"
            content="In three hours of exclusive video, Tony teaches you everything he has learned for becoming a seasoned musician.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

@stop()

@section('head')
    @parent
    <style>
        body {
            background:#000;
        }

        .register-cd {
            background:#111;
            padding:20px 15px;
            margin:0 auto;
            text-align:center;
        }

        .register-cd p {
            font:600 16px/1.2em "Open Sans", sans-serif;
            color:#fff;
            margin:0 auto 7px;
        }

        .register-cd .start-class {
            display:inline-block;
            background:#13B3D7;
            color:#fff;
            font:500 20px/40px "Open Sans", sans-serif;
            height:40px;
            text-transform:uppercase;
            padding:0 20px;
            text-align:center;
            transition:background .3s;
            border-radius:200px;
        }

        .hours-bonuses {
            text-align:center;
            margin:0 auto 30px;
        }

        .hours-bonuses .columns {
            padding:0 2%;
            margin:12px auto;
        }

        .hours-bonuses .icon {
            float:left;
            width:15%;
        }

        .hours-bonuses .icon i {
            color:#fff;
            font-size:40px;
            line-height:40px;
        }


        .hours-bonuses .text {
            float:right;
            width:80%;
            text-align:left;
        }

        .hours-bonuses .title {
            font:400 21px/1.2em "Open Sans", sans-serif;
            color:#fff;
            margin:0 auto;
        }

        .hours-bonuses .description {
            font:400 16px/1.4em "Open Sans", sans-serif;
            color:#999;
            margin:0 auto;
        }

        .white-slices .columns {
            background:#fff center center/cover no-repeat;
            margin:0 auto 20px;
            padding:0 15px 10px;
        }

        .white-slices .columns:nth-child(4) p {
            float:right;
        }

        .white-slices .columns p {
            font:500 14px/1.4em "Open Sans", sans-serif;
            margin:0;
            color:#101010;
            text-shadow:0 0 6px #fff;
            width:100%;
        }

        .white-slices .columns p strong {
            font:500 20px/2em "Open Sans", sans-serif;
        }

        .white-slices .float-left {
            height:160px;
            background-position:center 20%;
            background-size:cover;
            margin:-10px auto 0;
        }

        .white-slices .float-left:nth-child(1) {
            background-image:url(https://dzryyo1we6bm3.cloudfront.net/trj/tony-1s.jpg);
        }

        .white-slices .float-left:nth-child(3) {
            background-image:url(https://dzryyo1we6bm3.cloudfront.net/trj/tony-2s.jpg);
        }

        .white-slices .float-left:nth-child(5) {
            background-image:url(https://dzryyo1we6bm3.cloudfront.net/trj/tony-3s.jpg);
        }

        .trj-icon-grid {
            text-align:center;
            margin:0 auto 30px;
        }

        .trj-icon-grid-item {
            margin:5px auto;
            padding:0 2.5%;
        }


        .trj-icon-grid-item .icon {
            float:left;
            width:15%;
            margin:20px 0 0;
            color:#fff;
            font-size:40px;
            line-height:40px;
        }

        .trj-icon-grid-item .text {
            float:right;
            width:80%;
            text-align:left;
        }

        .trj-icon-grid-item .title {
            font:400 19px/1.2em "Open Sans", sans-serif;
            color:#fff;
            letter-spacing:-0.04em;
            margin:20px 0 4px;
        }

        .trj-icon-grid-item .description {
            font:400 16px/1.2em "Open Sans", sans-serif;
            color:#999;
            margin:0 auto;
        }

        .final-pic-pitch {
            text-align:center;
            background:url("https://dzryyo1we6bm3.cloudfront.net/trj/final-pitch.jpg");
            padding:100px 0 130px;
            box-shadow:0 -30px 30px #000 inset;
            background-position:70% 8%;
        }

        .final-pic-pitch h2 {
            font:500 19px/1.2em "Open Sans", sans-serif;
            color:#fff;
            margin:0 auto;
            text-shadow:1px 1px 2px #000;
        }

        .final-pic-pitch p {
            font:italic 400 16px/1.2em "Open Sans", sans-serif;
            color:#fff;
            margin:5px auto 25px;
            text-shadow:1px 1px 3px #000;
        }

        .final-pic-pitch .start-class {
            border-radius:200px;
            background:#13B3D7;
            color:#fff;
            font:400 18px/45px "Open Sans", sans-serif;
            height:45px;
            text-transform:uppercase;
            padding:0 4%;
            display:inline-block;
            transition:all .3s;
        }

        .sub-footer-section {
            text-align:center;
            margin:0 auto 20px;
        }

        .sub-footer-section .columns {
            padding:0 20px;
            margin:12px auto;
        }

        .sub-footer-section .icon {
            float:left;
            width:15%;
        }

        .sub-footer-section .text {
            float:right;
            width:80%;
            text-align:left;
        }

        .sub-footer-section .title {
            font:400 21px/1.2em "Open Sans", sans-serif;
            color:#fff;
            margin:0 auto;
        }

        .sub-footer-section .description {
            font:400 16px/1.2em "Open Sans", sans-serif;
            color:#999;
            margin:0 auto;
        }

        .start-class:hover {
            background:#32c8e6;
        }

        @media only screen and (min-width:40em) {

            .register-cd {
                padding:20px 25px;
            }

            .register-cd p {
                font-size:15px;
            }

            .register-cd .start-class {
                font-size:16px;
                padding:0 40px;
            }

            .hours-bonuses {
                margin:40px auto;
            }

            .hours-bonuses .columns {
                margin:0 auto;
            }

            .hours-bonuses .medium-4:nth-child(2) {
                border:1px solid #999;
                border-width:0 1px;
            }

            .hours-bonuses .icon {
                float:left;
                width:100%;
            }

            .hours-bonuses .text {
                float:right;
                width:100%;
                text-align:center;
            }

            .hours-bonuses .title {
                font-size:24px;
                margin:20px auto 10px;
            }

            .white-slices .float-left {
                margin:-20px auto 0;
            }

            .white-slices .columns {
                padding:0 20px 20px;
                background-position:right center;
                background-size:inherit;
            }

            .white-slices .columns:nth-child(2) {
                background-image:url("https://dzryyo1we6bm3.cloudfront.net/trj/tony-1.png");
            }

            .white-slices .columns:nth-child(4) {
                background-image:url("https://dzryyo1we6bm3.cloudfront.net/trj/tony-2.png");
                background-position:left center;
            }

            .white-slices .columns:nth-child(6) {
                background-image:url("https://dzryyo1we6bm3.cloudfront.net/trj/tony-3.png");
            }

            .white-slices .columns p {
                font-size:17px;
                width:66%;
            }

            .white-slices .columns p strong {
                font-size:36px;
                white-space:nowrap;
            }

            .trj-icon-grid {
                margin:0 auto 25px;
            }

            .trj-icon-grid-item {
                margin:25px auto;
            }

            .trj-icon-grid-item .icon {
                float:left;
                width:100%;
                margin:0;
            }

            .trj-icon-grid-item .text {
                float:right;
                width:100%;
                text-align:center;
            }

            .trj-icon-grid-item .title {
                font-size:24px;
                margin:20px 0 0;
                min-height:50px;
                line-height:24px;
            }

            .trj-icon-grid-item .description {
                min-height:76px;
                line-height:19px;
            }

            .final-pic-pitch {
                padding:190px 0 135px;
                box-shadow:0 -50px 100px #000 inset;
            }

            .final-pic-pitch h2 {
                font-size:31px;
                font-weight:400;
            }

            .final-pic-pitch p {
                font-size:20px;
            }

            .final-pic-pitch .start-class {
                font-size:30px;
                padding:0 3%;
                line-height:60px;
                height:60px;
            }

            .sub-footer-section {
                margin:0 auto 60px;
            }

            .sub-footer-section .columns {
                margin:0 auto;
            }

            .sub-footer-section .medium-4:nth-child(2) {
                border:1px solid #999;
                border-width:0 1px;
            }

            .sub-footer-section .icon {
                float:left;
                width:100%;
            }

            .sub-footer-section .text {
                float:right;
                width:100%;
                text-align:center;
            }

            .sub-footer-section .title {
                font-size:21px;
                margin:20px auto 10px;
            }
        }

        @media only screen and (min-width:64em) {
            .register-cd p {
                font-size:17px;
            }

            .register-cd .start-class {
                font-size:20px;
            }

            .white-slices .columns p strong {
                font-size:42px;
            }

            .trj-icon-grid-item .title {
                min-height:inherit;
                margin:20px 0 10px;
            }

            .trj-icon-grid-item .description {
                min-height:inherit;
            }

            .sub-footer-section .title {
                font-size:24px;
            }
        }
    </style>

@stop()

@section('content')
    <div class="row your-teacher">
        <div class="columns">
            <div class="flex-video vimeo widescreen">
                <iframe src="//player.vimeo.com/video/188367491?title=0&amp;byline=0&amp;portrait=0"
                        frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
        </div>
        <div class="columns register-cd">
            <p>Sorry, registration is now closed.</p>
            <a class="start-class" href="/beat/tony-royster-jr-drum-lessons/">Watch Tony's Free Lesson &raquo;</a>
        </div>
    </div>
    <div class="row hours-bonuses">
        <div class="medium-4 columns">
            <div class="icon"><i class="fa-light fa-video"></i></div>
            <div class="text">
                <p class="title">3 HOURS</p>

                <p class="description">In three hours of exclusive video, Tony teaches you everything he has learned for becoming a seasoned musician.</p>
            </div>
        </div>
        <div class="medium-4 columns">
            <div class="icon"><i class="fa-light fa-star"></i></div>
            <div class="text">
                <p class="title">$97 BONUS</p>

                <p class="description">Included with the masterclass, you'll also get a six-month access pass for Drumeo, valued at $97.</p>
            </div>
        </div>
        <div class="medium-4 columns">
            <div class="icon"><i class="fa-light fa-infinity"></i></div>
            <div class="text">
                <p class="title">LIFETIME ACCESS</p>

                <p class="description">You’ll get lifetime online access, so you can watch on your computer, tablet, or smart phone - anywhere, anytime.</p>
            </div>
        </div>
    </div>
    <div class="row white-slices">
        <div class="small-12 float-left hide-for-medium"></div>
        <div class="columns">
            <p>
                <strong>Jump-start your drumming.</strong><br> Tony Royster Jr. was proclaimed to be a child prodigy at the age of 12 - astounding the entire drum community with his sense of groove and amazing chops. This is your opportunity to hear how Tony was able to fast-track his development, and hear his best insights for improving your hands and feet to become a more well-rounded drummer.
            </p>
        </div>
        <div class="small-12 float-left hide-for-medium"></div>
        <div class="columns">
            <p>
                <strong>Build better habits.</strong><br> Listen to Tony as he explores the key ideas that helped him transition from a good musician, to a great musician, and ultimately become a seasoned musician - including his approach for developing a sense of time, arranging his drum set, and applying rudiments within grooves.
            </p>
        </div>
        <div class="small-12 float-left hide-for-medium"></div>
        <div class="columns">
            <p>
                <strong>Develop your musicianship.</strong><br> Playing with a band is one of the most rewarding experiences for any drummer. Watch Tony play with other musicians that he’s meeting for the very first time - as he guides you through developing a connection with the bass player, listening closely to others, and creating drum parts that enhance the musical experience.
            </p>
        </div>
    </div>
    <div class="row trj-icon-grid">
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-hourglass-start"></i></div>
            <div class="text">
                <p class="title">GETTING STARTED</p>

                <p class="description">Tony shares how he started on the drums, and his best advice for beginner drummers.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-user-graduate"></i></div>
            <div class="text">
                <p class="title">INDEPENDENCE</p>

                <p class="description">Every limb needs to work independently, and you’ll get Tony’s ‘mind-bending’ exercises.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-user-cog"></i></div>
            <div class="text">
                <p class="title">BASS DRUM TECHNIQUE</p>

                <p class="description">See what technique Tony favors, and how he uses it for more power and control on the bass drum.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-shoe-prints"></i></div>
            <div class="text">
                <p class="title">DOUBLE BASS DRUMMING</p>

                <p class="description">Explore Tony’s approach to double bass, and how he uses it to add color to his grooves.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-hand-paper"></i></div>
            <div class="text">
                <p class="title">HAND TECHNIQUE</p>

                <p class="description">Speed, power, precision. See Tony’s best advice for improving your hand technique.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-chart-line"></i></div>
            <div class="text">
                <p class="title">THE MUSIC BUSINESS</p>

                <p class="description">How to get noticed, build key relationships, and prepare your mindset to be a working drummer.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-stopwatch"></i></div>
            <div class="text">
                <p class="title">BETTER TIMING</p>

                <p class="description">It’s not always about counting. See how to use a metronome to embed timing into your playing.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-signal"></i></div>
            <div class="text">
                <p class="title">LINEAR DRUMMING</p>

                <p class="description">See how Tony uses three linear patterns within his playing for new ideas and combinations.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-drum"></i></div>
            <div class="text">
                <p class="title">RUDIMENTS</p>

                <p class="description">Explore Tony’s go-to rudiments, and how he practices them to develop consistency and feel.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-music"></i></div>
            <div class="text">
                <p class="title">MUSICIANSHIP</p>

                <p class="description">Tony shares his best advice for progressing from a good musician to a seasoned musician.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-user-friends"></i></div>
            <div class="text">
                <p class="title">PLAYING W/ A BASSIST</p>

                <p class="description">See how Tony locks-in with a bass player to become a unit while building a groove.</p>
            </div>
        </div>
        <div class="trj-icon-grid-item medium-4 columns">
            <div class="icon"><i class="fa-light fa-users"></i></div>
            <div class="text">
                <p class="title">PLAYING W/ A BAND</p>

                <p class="description">Watch Tony meet a band for the first time, and his advice for building music together.</p>
            </div>
        </div>
    </div>
    <div class="row final-pic-pitch">
        <div class="columns">
            <h2>Sorry, registration is now closed.</h2>

            <p></p>
            <a class="start-class" href="/beat/tony-royster-jr-drum-lessons/">Watch Tony's Free Lesson &raquo;</a>
        </div>
    </div>
    <div class="row sub-footer-section">
        <div class="medium-4 columns">
            <div class="text">
                <p class="title">QUESTIONS? CALL US. </p>

                <p class="description">Call us and we’ll answer any questions you might have.<br>
                    <strong>1-800-439-8921</strong> or <br> <strong>604-855-7605</strong>.</p>
            </div>
        </div>
        <div class="medium-4 columns">
            <div class="text">
                <p class="title">100% GUARANTEE</p>

                <p class="description">Your masterclass is backed by our extended 90-day guarantee, so you can try it risk-free for three full months.</p>
            </div>
        </div>
        <div class="medium-4 columns">
            <div class="text">
                <p class="title">SAFE & SECURE</p>

                <p class="description">Your order is securely encrypted with world-class SSL protection. We never share your personal information.</p>
            </div>
        </div>
    </div>
@stop
