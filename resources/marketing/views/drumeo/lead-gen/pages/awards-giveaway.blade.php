@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>The Drumeo Awards | Drumeo</title>
    <meta property="og:title" content="The Drumeo Awards LIVE Show">

    <meta name="description" content="Celebrate your favorite drummers on February 4, 2022.">
    <meta property="og:description" content="Celebrate your favorite drummers on February 4, 2022.">

    <meta property="og:url" content="https://www.drumeo.com/awards-giveaway/">
     <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/january/awards.jpg" style="display: none;">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js"></script>
    <link href="{{ asset('marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen.css') }}" rel="stylesheet">

    <style>

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li, p {
            font-family:Open Sans, sans-serif;
            font-weight:400;
            line-height:1em;
            margin:0 auto
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:991px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:991px) {
            h2 {
                font-size:36px
            }
        }

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:991px) {
            h3 {
                font-size:30px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:991px) {
            h4 {
                font-size:24px
            }
        }

        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:991px) {
            h5 {
                font-size:20px
            }
        }

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:991px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:991px) {
            li, p {
                font-size:16px
            }
        }


        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        form {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        @media (min-width: 768px) {
            form {
                margin: 0 auto 10px;
            }
        }

        form input, form button {
            font: 400 18px/50px 'Open Sans', sans-serif;
            height: 50px;
            color: #999;
            border-radius: 100px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 15px;
        }
        @media (min-width: 768px) {
            form input, form button {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
            }
        }
        form input[type="submit"], form button[type="submit"], form input button, form button button {
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: 700;
            color: #fff;
            background: #0b76db;
            text-transform: uppercase;
            margin: 0 auto 15px;
            display: block;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
            padding: 0;
        }
        form input[type="submit"]:hover, form button[type="submit"]:hover, form input button:hover, form button button:hover {
            background: #258ff4;
        }
        .disclaimer {
            display: inline-block;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }
        .disclaimer i {
            width: 40px;
            font-size: 29px;
            line-height: 1em;
            float: left;
        }
        .disclaimer span {
            font: 400 12px/1.4em 'Open Sans', sans-serif;
            margin: 0 auto;
            width: calc(100% - 40px);
            float: left;
            text-align: left;
        }

        .join.smaller {
            font-size: 13px;
            padding: 7px 12px;
        }

        @media (min-width: 768px) {
            .join.smaller {
                font-size: 14px;
                padding: 13px 30px;
            }
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <section class="text-center text-white pb-5 md:pb-10 px-3 md:px-4" style="background:linear-gradient(to bottom, #000 65%, #06488F);">
        <div class="container mx-auto max-w-5xl">
            <a href="todo" target="_blank"><img class="inline-block h-48 md:h-96" src="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/january/awards.jpg"></a>
            {{--<h1 class="md:tracking-widest -mt-4 md:-mt-8 lg:-mt-12">The Drumeo Awards LIVE Show</h1>--}}
            <h6 class="leading-normal my-3 md:my-5 lg:my-8">
                Enter your email for your chance to win<br class="hidden md:inline lg:hidden">
                a prize LIVE at the February 4th awards celebration.</h6>
            {{--<form id="ajaxForm1" accept-charset="UTF-8" action="/laravel/public/customer-io/submit-email-form" class="ajax-form clearfix infusion-form facebook-track-lead mx-auto" method="POST">--}}
                {{--<div class="infusion-field w-full px-2 float-left md:w-7/12 md:text-left">--}}
                    {{--<input class="w-full" name="email" type="email" placeholder="Email Address..." required="">--}}
                {{--</div>--}}
                {{--<div class="infusion-submit w-full px-2 float-left md:w-5/12">--}}
                    {{--<button class="submit " type="submit">--}}
                        {{--<span class="pre-add"> Enter Now <i class="fad fa-paper-plane"></i></span>--}}
                        {{--<span class="pending hidden">Sending <i class="fad fa-spinner-third fa-spin"></i></span>--}}
                        {{--<span class="success hidden">Sent <i class="fad fa-thumbs-up"></i></span>--}}
                        {{--<span class="fail hidden">Try Again <i class="fad fa-exclamation-triangle"></i></span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                {{--<input name="form_name" type="hidden" value="Drumeo Awards Giveaway">--}}
                {{--<input name="inf_form_xid" type="hidden" value="DrumeoEngagementTriggerDrumeoAwardsGiveawayWebForm">--}}
                {{--<input name="tag_names_to_add[]" type="hidden" value="Drumeo - Engagement - Trigger - Drumeo Awards Giveaway - Web Form">--}}
                {{--<input name="list_ids_to_subscribe_to[]" type="hidden" value="31">--}}
                {{--<input name="success_redirect" type="hidden" value="/thankyou">--}}
            {{--</form>--}}
            {{--<div class="disclaimer opacity-70 mx-auto inline-block">--}}
                {{--<i class="fal fa-info-circle float-left leading-none"></i>--}}
                {{--<span class="mx-auto text-left float-left leading-tight">By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</span>--}}
            {{--</div>--}}
            {{--<div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl">--}}
                {{--<p><strong><i class="fas fa-check"></i> Success!</strong></p>--}}
                {{--<h2 class="text-guitareo my-4 md:my-5"><strong> CHECK YOUR EMAIL </strong></h2>--}}
                {{--<p><em> You should receive an email from team@drumeo.com within 10 minutes.--}}
                        {{--If you don’t, then check your spam folder or re-enter your email address again. </em>--}}
                {{--</p>--}}
                {{--<div class="social-media">--}}
                    {{--<a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>--}}
                    {{--<a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>--}}
                    {{--<a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            <h5 class="leading-normal text-yellow-400"><strong>Drumeo Awards Live Show</strong><br>
                February 4, 2022<br>
                <a target="_blank" href="https://www.google.com/search?q=1+pm+pdt">1 PM (PT) / 4 PM (ET) <i class="fas fa-info-circle"></i></a> </h5>
        </div>
    </section>
    <section class="py-8 px-3">
        <div class="container mx-auto max-w-2xl">
            <h2 class="leading-normal mb-4 md:mb-7" style="background: linear-gradient(to bottom, #007aff, #014590);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>Drum roll, please...</strong></h2>
            <p>The votes have been tallied.
                <br><br>
                And the winners of the first-ever Drumeo Awards will be announced LIVE on February 4th.</p>

                {{--<div class="my-2 mx-1 addeventatc" id="addeventatc1" style="z-index: 50 !important;">--}}
                    {{--ADD TO CALENDAR <i class="fas fa-caret-down"></i>--}}
                    {{--<span class="hide start">2022/02/04 13:00:00</span>--}}
                    {{--<span class="hide end">2022/02/04 14:00:00</span>--}}
                    {{--<span class="hide timezone">America/Vancouver</span>--}}
                    {{--<span class="hide title">Drumeo Awards Live Show</span>--}}
                    {{--<span class="hide description">Celebrate your favorite drummers on February 4, 2022. </span>--}}
                    {{--<span class="hide location">--}}{{-- todo --}}{{--</span>--}}
                    {{--<span class="hide all_day_event">false</span>--}}
                    {{--<span class="hide date_format">MM/DD/YYYY</span>--}}
                    {{--<span class="hide alarm_reminder">15</span>--}}
                    {{--<span class="addeventatc_icon atc_node notranslate"></span>--}}
                {{--</div>--}}

                <p>You won’t want to miss this for TWO reasons:
                <br><br>
                Firstly, drummers don’t always get the recognition they deserve. The Drumeo Awards hopes to change that by celebrating outstanding performances & recordings by drummers of all styles in 2021.
                <br><br>
                And secondly… YOU can win free stuff!
                <br><br>
                <strong>We’ll be giving away prizes during the show, including:</strong></p>
                <ul class="list-disc ml-10 my-4">
                    <li>Drumeo memberships</li>
                    <li>A Roland SPD-20 Pro </li>
                    <li>A Yamaha bass drum pedal</li>
                    <li>2 Pairs of the NEW Drumeo EarDrums</li>
                </ul>
                <p>And a grand prize Dunnett snare drum in custom Drumeo blue!
                <br><br>
                Drop your email address at the top of this page to be entered into the random draws we’ll be doing throughout the live stream. The winners will be contacted immediately after -- it’s that simple.
                <br><br>
                Click the big button at the bottom of this page to join the party on February 4 and we’ll see you there!
                {{--<br><br>--}}
                {{--<a target="_blank" href="todo" class="join blue smaller">DRUMEO AWARDS LIVE</a>--}}
            </p>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/pre-form-submit-facebook-lead.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
@stop
