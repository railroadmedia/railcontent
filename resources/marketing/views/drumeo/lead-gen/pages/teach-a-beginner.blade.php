@extends('drumeo._partials.global-layout')

@section('global-head')

    <title>Drumeo - How To Teach A Beginner Drummer</title>
    <meta name="description"
          content="Five FREE videos to help you make a powerful impact on your beginner drumming students!">
    <meta property="og:url" content="https://www.drumeo.com/teach-a-beginner/">
    <meta property="og:image" content="https://dzryyo1we6bm3.cloudfront.net/sales/teachers/fb5.jpg"
          style="display: none;">
    <meta property="og:title" content="How To Teach A Beginner Drummer">
    <meta property="og:description"
          content="Five FREE videos to help you make a powerful impact on your beginner drumming students!">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    @include('drumeo._partials._fonts')

    <style>
        body {
            background: #fff;
        }

        .anchor {
            display: block;
            position: relative;
            top: -100px;
            visibility: hidden;
        }

        .big-header {
            color: #1B1B1B;
            text-align: center;
        }

        .sub-header {
            color: #666;
            text-align: center;
        }

        .member-form {
            background: #1EB3A5;
            color: #fff;
            padding: 11px;
            text-align: center;
        }

        .member-form .dashed-outline {
            background: #343434;
            padding: 16px 0;
        }

        .member-form .form-title {
            display: inline-block;
            margin: 0 auto;
            color: #FFF;
            text-align: center;
            border-bottom: 1px solid #666;
        }

        .member-form .image-point {
            width: 90%;
            margin: 0 5%;
            float: left;
            text-align: left;
        }

        .member-form .form-points {
            margin: 0 auto;
            color: #FFF;
            width: 75%;
        }

        .member-form .form-enter {
            margin: 0 auto;
            color: #FFFF99;
            letter-spacing: 0.05em;
            text-align: center;
        }

        form {
            margin: 0;
        }

        .member-form input {
            width: 85%;
            border-radius: 5px;
            margin: 0 auto 10px;
            color: #585858;
            text-align: center;
        }

        .member-form [type="email"] {
            font-style: italic;
        }

        .member-form input[type="submit"] {
            display: block;
            background: #1EB3A5;
            border: none;
            cursor: pointer;
            color: #fff;
            font-weight: 500;
            padding: 0;
        }

        .member-form input[type="submit"]:hover {
            background: #1ec6b8;
        }

        .gsotd-nav {
            background: #1c1c1c;
            height: 50px;
            overflow: hidden;
            width: 100%;
        }

        .gsotd-nav a {
            font: 300 14px/50px "Open Sans", sans-serif;
            color: #CCC;
            text-align: center;
            float: left;
        }

        .gsotd-nav .grey-arrows {
            background: url("https://dzryyo1we6bm3.cloudfront.net/gsotd/white-arrows.png") center center no-repeat;
            background-size: contain;
            height: 50px;
            float: right;
        }

        .grey-contain {
            background: #FFF;
            padding: 40px 0;
        }

        .grey-contain .overview-border {
            border-bottom: 1px solid #fff;
        }

        .grey-contain .red-title {
            color: #B6453C;
            margin: 0 auto 10px;
            font: 700 20px/1em "Open Sans", sans-serif;
        }

        .grey-contain .sub-red {
            font: 400 16px/1.5em "Open Sans", sans-serif;
            color: #666;
            padding: 0 0 20px;
        }

        .grey-contain .faq .sub-red {
            padding: 0 0 10px;
        }

        .overview-video {
            padding: 20px 0;
            border-bottom: 1px solid #fff;
            float: left;
        }

        .overview-video.last {
            padding: 20px 0 40px;
        }

        .overview-video .thumb {
            float: left;
            width: 31.4%;
        }

        .overview-video .title {
            font: 700 18px/1em "Open Sans", sans-serif;
        }

        .overview-video .sub-title {
            font: 300 14px/1.2em "Open Sans", sans-serif;
            margin: 0 auto;
        }

        .overview-video .clock {
            padding-left: 0.9375rem;
            float: left;
        }

        .overview-video .time {
            float: left;
            font: 400 16px/22px "Open Sans", sans-serif;
            margin-left: 7px;
        }

        .grey-contain .instructor {
            padding: 40px 0 0;
        }

        .grey-contain .instructor-border {
            border-bottom: 1px solid #fff;
        }

        .grey-contain .social-link {
            padding: 15px 0;
            margin: -5px 15px 40px 0;
            width: 150px;
            text-align: center;
            background: #1c1c1c;
            color: #fff;
            font: 400 18px/1em "Open Sans", sans-serif;
            -webkit-appearance: none;
            display: inline-block;
        }

        .grey-contain .social-link:hover {
            color: #fff;
            background: #1E7DA7;
        }

        .grey-contain .about {
            padding: 40px 0 0;
        }

        .grey-contain .faq {
            padding: 40px 0 0;
        }

        @media only screen {
            .big-header {
                font: 600 34px/1em "Open Sans", sans-serif;
                margin: 15px auto 5px;
            }

            .sub-header {
                font: 300 16px/1em "Open Sans", sans-serif;
                margin: 5px auto 20px;
            }

            .member-account {
                height: 190px;
            }

            .flex-video {
                min-height: initial;
                margin: 0;
            }

            .member-form {
                height: inherit;
                margin: 20px auto;
            }

            .member-form-container {
                width: 100%;
            }

            .member-form .form-title {
                font: 500 22px/1em "Open Sans", sans-serif;
                margin: 0 auto 15px;
                padding: 0 0 15px;
            }

            .member-form .image-point img {
                width: 35px;
            }

            .member-form .form-points {
                font: 300 15px/1.3em "Helvetica Neue", sans-serif;
                margin: 0 0 5% 5%;
                min-height: 45px;
            }

            .member-form .form-enter {
                font: italic 400 16px/1.1em "Helvetica Neue", sans-serif;
                margin: 0 15px 10px;
            }

            .member-form input {
                height: 40px;
                font: 300 16px "Helvetica Neue", sans-serif;
            }

            .member-form input[type="submit"] {
                font-size: 18px;
            }

            .gsotd-nav a {
                font: 300 14px/50px "Open Sans", sans-serif;
                width: 25%;
            }

            .overview-video .title {
                font: 700 17px/1em "Open Sans", sans-serif;
                margin: 0 auto 5px;
            }

            .overview-video .sub-title {
                min-height: 48px;
            }

            .overview-video .time {
                margin-top: 15px;
            }

            .overview-video .clock {
                margin-top: 15px;
            }

            .grey-contain .social-link {
                width: 125px;
            }
        }

        @media only screen and (min-width: 40.063em) {
            .big-header {
                font: 600 41px/1em "Open Sans", sans-serif;
                margin: 30px auto 10px;
            }

            .sub-header {
                font: 300 16px/1.3em "Open Sans", sans-serif;
                margin: 0px auto 35px;
            }

            .member-account {
                height: 350px;
            }

            .member-form {
                height: initial;
                margin: 0;
            }

            .flex-video {
                min-height: 335px;
                margin: 0 0 15px;
            }

            .member-form-container {
                width: 33%;
            }

            .member-form .dashed-outline {
                padding: 10px 0 5px;
            }

            .member-form .form-title {
                font: 500 19px/1.1em "Helvetica Neue", sans-serif;
                margin: 0 10px 15px;
                padding: 0 0 12px;
            }

            .member-form .image-point img {
                width: 35px;
            }

            .member-form .form-points {
                width: 72%;
            }

            .member-form .form-enter {
                font: italic 400 15px/1.1em "Helvetica Neue", sans-serif;
                margin: 0 5px 10px;
            }

            .member-form input {
                height: 40px;
                font: 300 13px "Helvetica Neue", sans-serif;
            }

            .member-form input[type="submit"] {
                font-size: 13px;
            }

            .gsotd-nav a {
                font: 300 16px/50px "Open Sans", sans-serif;
                width: 15%;
            }

            .gsotd-nav .faq {
                width: 10.5%;
            }

            .gsotd-nav .grey-arrows {
                width: 40%;
                margin: 0;
                background-size: cover;
                background-position: left center;
            }

            .overview-video .title {
                min-height: 34px;
                margin: 5px auto 7px;
            }

            .overview-video .sub-title {
                min-height: 64px;
            }

            .grey-contain .social-link {
                width: 150px;
            }
        }

        @media only screen and (min-width: 64.063em) {
            .big-header {
                font: 600 50px/1em "Open Sans", sans-serif;
            }

            .sub-header {
                font: 300 24px/1.3em "Open Sans", sans-serif;
                margin: 0px auto 35px;
            }

            .member-account {
                height: 405px;
            }

            .member-form {
                height: 121%
            }

            .flex-video {
                min-height: initial;
            }

            .member-form-container {
                width: 32%;
            }

            .member-form .dashed-outline {
                padding: 16px 0;
            }

            .member-form .form-title {
                font: 500 23px/1.1em "Helvetica Neue", sans-serif;
                margin: 0 auto 20px;
                padding: 0 0 17px;
                width: 90%;
            }

            .member-form .image-point img {
                width: 36px;
                margin-left: 3%;
            }

            .member-form .form-points {
                min-height: none;
                width: 72%;
            }

            .member-form .form-enter {
                font: italic 400 17px/1.1em "Helvetica Neue", sans-serif;
                margin: 0 auto 18px;
            }

            .member-form input {
                height: 50px;
                font: 300 19px "Helvetica Neue", sans-serif;
            }

            .member-form input[type="submit"] {
                font-size: 19px;
            }

            .gsotd-nav a {
                font: 300 19px/50px "Open Sans", sans-serif;
                width: 15.5%;
            }

            .gsotd-nav .grey-arrows {
                width: 42%;
                margin: 0px -4% 0 0;
                background-size: contain;
                background-position: center center;
            }

            .overview-video .sub-title {
                min-height: inherit;
            }

            .overview-video .time {
                margin-top: 10px;
            }

            .overview-video .clock {
                margin-top: 10px;
            }

        }

        .fixedSlider {
            position: fixed;
            top: 80px;
            height: initial;
        }
    </style>

@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <div class="row contact-title">
        <p class="small-12 columns big-header">How To Teach A Beginner Drummer</p>

        <p class="small-12 columns sub-header">Five FREE videos to help you make a powerful impact on your
            beginner drumming students!</p>
    </div>

    <div class="row member-account">
        <div class="columns member-video">
            <div class="flex-video vimeo widescreen">
                <iframe src="//player.vimeo.com/video/114826998?title=0&amp;byline=0&amp;portrait=0"
                        frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
        </div>

    </div>

    <div class="gsotd-nav">
        <div class="row">
            <a href="#overview">OVERVIEW</a> <a href="#instructor">INSTRUCTOR</a> <a href="#about">ABOUT
                US</a> <a href="#faq" class="faq">FAQS</a>
        </div>
    </div>

    <div class="grey-contain">
        <div id="overview" class="anchor"></div>
        <div class="row overview">
            <div class="medium-8 small-12 columns">
                <div class="overview-border">
                    <p class="red-title">What you'll learn in this video series:</p>

                    <p class="sub-red">Teaching beginner drummers can be a lot of fun. They haven’t developed
                        any bad habits,
                        and there’s tons of potential for rapid progress! This video series will give you
                        everything you need
                        to help a beginner drumming student grasp the basic concepts they need to get started
                        on the drums.</p>
                </div>
                <div class="overview-video">

                    <p class="small-8 columns title">Introduction To The Drum Kit and Stick Grips</p>

                    <p class="small-8 columns sub-title">Discover a great way to help your students become
                        familiar with the
                        drum kit, and the most efficient way to set up their kit to get started!</p>
                    <i class="clock fas fa-clock"></i>

                    <p class="time">5 min</p>
                </div>
                <div class="overview-video">

                    <p class="small-8 columns title">Quarter Note Beats & Fills</p>

                    <p class="small-8 columns sub-title">It’s time for their first drum beat! You’ll learn a
                        great way for
                        your students to learn a beat within 5 minutes, and play around with it so they can
                        see their potential.</p>
                    <i class="clock fas fa-clock"></i>

                    <p class="time">8 min</p>
                </div>
                <div class="overview-video">

                    <p class="small-8 columns title">The Four Basic Rudiments</p>

                    <p class="small-8 columns sub-title">“Rudiments” can be a scary term. I’ll show you the
                        four most
                        important rudiments to start with and how to remove the intimidation factor so it’s
                        more fun!</p>
                    <i class="clock fas fa-clock"></i>

                    <p class="time">4 min</p>
                </div>
                <div class="overview-video">

                    <p class="small-8 columns title">Eighth Notes & 16th Notes</p>

                    <p class="small-8 columns sub-title">Help your students learn the importance of 8th note
                        and 16th note
                        beats and fills, so they can slowly improve their skills and timing towards playing
                        their favorite songs.</p>
                    <i class="clock fas fa-clock"></i>

                    <p class="time">7 min</p>
                </div>
                <div class="overview-video">

                    <p class="small-8 columns title">Triplets, Shuffles, & Review</p>

                    <p class="small-8 columns sub-title">Avoid the confusion. I’ll show you a great way to
                        introduce your
                        students to triplets and shuffles so they can start rocking the drums sooner than
                        later!</p>
                    <i class="clock fas fa-clock"></i>

                    <p class="time">8 min</p>
                </div>
                <div class="overview-video last">

                    <p class="small-8 columns title"><u>BONUS:</u> 5 Tips To Attract More Students</p>

                    <p class="small-8 columns sub-title">If you want to build a successful teaching business,
                        this is the
                        video for you! I'll show you my best marketing techniques for attracting new students
                        and making
                        sure you're always booked solid!</p>
                    <i class="clock fas fa-clock"></i>

                    <p class="time">12 min</p>
                </div>
            </div>
        </div>
        <div id="instructor" class="anchor"></div>
        <div class="row instructor">
            <div class="medium-8 columns">
                <div class="instructor-border">
                    <p class="red-title">About Your Instructor</p>

                    <p class="sub-red">Mike Michalkow has been teaching the drums for over 20 years, helping
                        hundreds of
                        students privately plus nearly 20,000 drummers with his Drumming System curriculum
                        that was designed
                        to help them learn the drums from home.</p>
                    <a href="//facebook.com/drum.michalkow" class="social-link">Facebook</a>
                    <a href="//twitter.com/MikeMichalkow" class="social-link">Twitter</a>
                </div>
            </div>
        </div>
        <div id="about" class="anchor"></div>
        <div class="row about">
            <div class="medium-8 columns">
                <div class="instructor-border">
                    <p class="red-title">About Drumeo</p>

                    <p class="sub-red">Drumeo.com was voted the “Best Drum Educational Website” for 2014 by
                        the readers of
                        DRUM! Magazine, offering an online educational program with daily live lessons,
                        on-demand video
                        courses, student reviews and lesson plans, play-along songs, and an interactive
                        community of
                        students and instructors from around the world. Learn more at <a href="/"
                                                                                         target="_blank">www.Drumeo.com.</a>
                    </p>
                </div>
            </div>
        </div>
        <div id="faq" class="anchor"></div>
        <div class="row faq">
            <div class="medium-8 columns">
                <p class="red-title">Frequently Asked Questions</p>

                <p class="sub-red"><strong>How long will I have access to these lessons?</strong><br>
                    Your Drumeo For Teachers videos come with full, lifetime access! We'll email you special
                    access links to
                    the videos, and they're yours to keep - forever! <br><br>
                    <strong>What internet speed is required to watch these videos?</strong><br>
                    This video series was built to work on any standard internet connection! For standard
                    definition videos,
                    a download speed of 400 kilobits per second will work great. For high definition, you’ll
                    want at least 1
                    megabit per second. <a href="//speedtest.net/" target="_blank"> Click here</a> to test
                    your internet! <br><br>
                    <strong>Do the video lessons work on my phone/tablet/computer?</strong><br>
                    Yes, the videos are compatible with both Windows and Mac computers. They are also designed
                    to be
                    compatible with mobile devices like the iPad, iPhone, as well as Android phones and
                    tablets. <br><br>
                    <strong>Will I ever be charged for this video series?</strong><br>
                    No. Consider these free videos our gift to you! We hope you'll love them, and just maybe
                    choose to join
                    us in the future when we launch our official Drumeo For Teachers platform. But we'll tell
                    you more about
                    that later!</p>
            </div>
        </div>
    </div>


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>

    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
