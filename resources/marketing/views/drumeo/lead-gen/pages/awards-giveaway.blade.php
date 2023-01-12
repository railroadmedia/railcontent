@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>The Drumeo Awards | Drumeo</title>
    <meta property="og:title" content="The Drumeo Awards LIVE Show">

    <meta name="description" content="Drumeo Awards Live Show Presented By Yamaha">
    <meta property="og:description" content="Drumeo Awards Live Show Presented By Yamaha">

    <meta property="og:url" content="https://www.drumeo.com/awards-giveaway/">
     <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/january/awards.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js"></script>
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
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

    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <section class="text-center text-white pb-5 md:pb-10 px-3 md:px-4" style="background:linear-gradient(to bottom, #000 65%, #06488F);">
        <div class="container mx-auto max-w-5xl">
            <a href="https://www.youtube.com/watch?v=p2FVUMYO-6k" target="_blank"><img class="inline-block h-48 md:h-96" src="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/january/awards.jpg"></a>
{{--            <h1 class="md:tracking-widest -mt-4 md:-mt-8 lg:-mt-12">The Drumeo Awards LIVE Show</h1>--}}
            <h6 class="leading-normal my-3 md:my-5 lg:my-8">
                Enter your email for your chance to win a prize <br class="hidden md:inline lg:hidden">
                during the Drumeo Awards live stream celebration.</h6>
            <form id="ajaxForm1" accept-charset="UTF-8" action="/customer-io/submit-email-form" class="ajax-form clearfix infusion-form facebook-track-lead mx-auto" method="POST">
                <div class="infusion-field w-full px-2 float-left md:w-7/12 md:text-left">
                    <input class="w-full" name="email" type="email" placeholder="Email Address..." required="">
                </div>
                <div class="infusion-submit w-full px-2 float-left md:w-5/12">
                    <button class="submit " type="submit">
                        <span class="pre-add"> Enter Now <i class="fad fa-paper-plane"></i></span>
                        <span class="pending hidden">Sending <i class="fad fa-spinner-third fa-spin"></i></span>
                        <span class="success hidden">Sent <i class="fad fa-thumbs-up"></i></span>
                        <span class="fail hidden">Try Again <i class="fad fa-exclamation-triangle"></i></span>
                    </button>
                </div>
                <input name="form_name" type="hidden" value="Drumeo Awards Giveaway 2">
                <input name="inf_form_xid" type="hidden" value="DrumeoEngagementTriggerDrumeoAwardsGiveaway2WebForm">
                <input name="tag_names_to_add[]" type="hidden" value="Drumeo - Engagement - Trigger - Drumeo Awards Giveaway 2 - Web Form">
                <input name="list_ids_to_subscribe_to[]" type="hidden" value="31">
                <input name="success_redirect" type="hidden" value="/thankyou">
            </form>
            <div class="disclaimer opacity-70 mx-auto inline-block">
                <i class="fal fa-info-circle float-left leading-none"></i>
                <span class="mx-auto text-left float-left leading-tight">By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</span>
            </div>
            <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl">
                <p><strong><i class="fas fa-check"></i> Success!</strong></p>
                <h2 class="text-guitareo my-4 md:my-5"><strong> CHECK YOUR EMAIL </strong></h2>
                <p><em> You should receive an email from team@drumeo.com within 10 minutes.
                        If you don’t, then check your spam folder or re-enter your email address again. </em>
                </p>
                <div class="social-media">
                    <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                    <a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <h5 class="leading-normal text-yellow-400"><strong>Drumeo Awards Live Show Presented By Yamaha</strong><br>
                January 27, 2023<br>
                <a target="_blank" href="https://www.google.com/search?q=1:30+pm+pdt">1:30 PM (PT) / 4:30 PM (ET) <i class="fas fa-info-circle"></i></a> </h5>
        </div>
    </section>
    <section class="py-8 px-3">
        <div class="container mx-auto max-w-2xl">
            <h2 class="leading-normal mb-4 md:mb-7" style="background: linear-gradient(to bottom, #007aff, #014590);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>Drum roll, please...</strong></h2>
            <p>You voted for your favorite drummers.
                <br><br>
                And you’re about to find out who the winners are.
                <br><br>
                During the Drumeo Awards live stream on January 27, we’ll be announcing your Drummer Of The Year, along with 19 other category winners.
                <br><br>
                Not only is it important to recognize drummers’ accomplishments, but we want to recognize YOU for taking the time to vote and share.
                <br><br>
                Thanks to our generous sponsors, <strong>we’re giving away over $10,000 in prizes</strong> during the live awards show this year, including:</p>
            <ul class="list-disc ml-10 my-4">
                <li>A Yamaha Tour Custom acoustic drum kit</li>
                <li>A GEWA electronic drum kit</li>
                <li>A full set of Earthworks DK7 drum mics</li>
                <li>A Roland SPD-SX Pro sample pad (courtesy of Sweetwater)</li>
                <li>A Sabian AAX cymbal set</li>
                <li>A 5-piece set of Gator drum cases</li>
                <li>A DW 5000 double kick pedal</li>
                <li>5 Vater drumstick packs</li>
                <li>And your favorite Drumeo products, including memberships, practice pads and in-ear monitors.</li>
            </ul>
            <div class="flex flex-wrap">
                <div class="w-full sm:w-1/2">
                    <img src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/january/prizesyamaha.jpg">
                </div>
                <div class="w-full sm:w-1/2">
                    <img src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/january/prizesall.jpg">
                </div>
            </div>
            <p>Drop your email address at the top of this page to be entered into the random draws we’ll be doing throughout the live stream.
                <br><br>
                If you win, we’ll contact you within 72 hours. Make sure you check your junk folder - you’ll have a week to get back to us to collect your prize!
                <br><br>
                Click the big button at the bottom of this page to join the party on January 27. See you there!
                <br><br>
                <a target="_blank" href="https://www.youtube.com/watch?v=p2FVUMYO-6k" class="join blue smaller">WATCH NOW &raquo;</a>
            </p>
        </div>
    </section>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/pre-form-submit-facebook-lead.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
@stop
