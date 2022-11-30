@extends('guitareo.sales.standard-layout', [
"openVersion" => true,
"trialVersion" => true,
])

@section('meta')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:url" content="https://www.guitareo.com"/>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    <style>
        form.promo-section {
            position: relative;
            width: 100%;
            max-width: 100%;
            margin: 10px auto 0;
        }
        form.promo-section input,
        form.promo-section button {
            border: none;
            outline: none;
            font: 400 16px/45px 'Open Sans', sans-serif;
            height: 45px;
            background: #fff;
            color: #000;
            border-radius: 100px;
            width: 100%;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 7px;
        }
        @media (min-width: 768px) {
            form.promo-section input,
            form.promo-section button {
                margin: 0 auto;
                font-size:18px;
            }
        }
        form.promo-section input[type="submit"],
        form.promo-section button[type="submit"],
        form.promo-section input button,
        form.promo-section button button {
            font-family: 'Bebas Neue', sans-serif;
            background: #00c9ac;
            text-transform: uppercase;
            display: inline-block;
            cursor: pointer;
            text-align: center;
            padding: 0;
            margin: 0;
            color: #fff;
            line-height: 31px;
        }
        form.promo-section input[type="submit"]:hover,
        form.promo-section button[type="submit"]:hover,
        form.promo-section input button:hover,
        form.promo-section button button:hover {
            background:#00e3c1;
        }
        .promo-section.thank-you-box {
            width: 100%;
            max-width: 960px;
            border-radius: 5px;
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all 0.4s ease-in;
            display: block;
            margin: 0 auto;
            text-align: center;
            overflow: hidden;
            background: transparent;
        }
        .promo-section.thank-you-box.active {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            padding: 5px 0 0;
        }
        .promo-section.thank-you-box p {
            font: 400 16px/1.55em 'Open Sans', sans-serif;
            margin: 0 auto;
            color: #fff;
        }
        @media (min-width: 768px) {
            .promo-section.thank-you-box p {
                font-size: 15px;
            }
        }

    </style>
    @parent
@endsection

@section('top-promo-bar')
{{--    @include('_partials.layout.holiday.homepage-top-banner',[--}}
{{--        'text' => 'GET 10 FREE<br class="inline md:hidden"> BONUSES WORTH $1228.94'--}}
{{--    ])--}}
@endsection

@section('promo-banner')
    <section class="py-10 md:py-20 px-2 lg:px-4 text-white text-center bg-center bg-cover bg-no-repeat" style="background-color:#03242b;background-image:url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/footer.jpg')">
        <div class="max-w-2xl mx-auto">
            <h3 class="leading-tight mb-4"><strong>
                    Get the latest news on<br class="inline sm:hidden">
                    Black Friday Deals</strong></h3>
            <form id="GuitareoEngagementTriggerWebsiteSignupWebForm" accept-charset="UTF-8" action="/customer-io/submit-email-form" method="POST"
                class="promo-section ajax-form clearfix infusion-form facebook-track-lead" onsubmit="emailSignUpConversionTrackerForImpactProvider()">
                <input type="hidden" name="form_name" value="Blog Signup">

                <input type="hidden" name="leadtracker_form_name" value="Blog Signup">
                <div class="flex flex-wrap items-center">
                    <div class="infusion-field form-group text-center sm:text-left px-2 w-full sm:w-7/12">
                        <input class="medium-body infusion-field-input-container" id="inf_field_Email" name="email" type="email" placeholder="Email Address..." required="">
                    </div>
                    <div class="infusion-submit form-group px-2 w-full sm:w-5/12">
                        <button class="submit button-red infusion-recaptcha join-form-button " type="submit">
                            <span class="pre-add"> Sign up <i class="fas fa-paper-plane"></i></span>
                            <span class="pending hide hidden">Sending <i class="fas fa-spinner-third fa-spin"></i></span>
                            <span class="success hide hidden">Sent <i class="fas fa-thumbs-up"></i></span>
                            <span class="fail hide hidden">Try Again <i class="fas fa-exclamation-triangle"></i></span>
                        </button>
                    </div>
                </div>
                <input name="inf_form_xid" type="hidden" value="GuitareoEngagementTriggerWebsiteSignupWebForm">
                <input name="tag_names_to_add[]" type="hidden" value="Guitareo - Engagement - Trigger - Website Signup - Web Form">
                <input name="list_ids_to_subscribe_to[]" type="hidden" value="32">
                <input name="success_redirect" type="hidden" value="/thank-you-white">
            </form>
            <div class="thank-you-box promo-section">
                <p><em>You should receive an email from team@guitareo.com within 10 minutes.</em></p>
            </div>
            {{--            <div class="md:flex md:items-center md:gap-6 mb-10 text-center md:text-left">--}}
            {{--                <div class="md:w-3/5 mb-6 md:mb-0">--}}
            {{--                    <img class="h-16 md:h-20 lg:h-24 mb-4" src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/october/scary_logo_coloured.png" alt="scary good lesson logo">--}}
            {{--                    <p class="mb-2 leading-tight">--}}
            {{--                        <b>JOIN GUITAREO + GET 3 TRICK-FREE <br class="md:hidden">TREATS WORTH $441</b>--}}
            {{--                        <br>--}}
            {{--                        <span class="tzcd-full text-coaches uppercase hidden md:inline"></span>--}}
            {{--                        <span class="tzcd-small text-coaches uppercase md:hidden"></span>--}}
            {{--                    </p>--}}
            {{--                    <p>--}}
            {{--                        Don’t let guitar theory haunt you.--}}
            {{--                        When you join today, you’ll get full access to the Guitareo METHOD – a 10-level curriculum designed to eliminate boring theory lessons AND help you to play music right away. <br><br>--}}
            {{--                        You will have loads of fun advancing your guitar skills with resources such as play-along tracks and guitar challenges. <br><br>--}}
            {{--                        Now that’s scary good. <br><br>--}}
            {{--                        And as a special Halloween treat, you’ll also get LIFETIME access to three of the most popular lesson packs in Guitareo – so you can continue to unlock new guitar skills by playing songs you love.--}}
            {{--                    </p>--}}
            {{--                </div>--}}
            {{--                <div class="md:w-2/5">--}}
            {{--                    <img class="h-96 md:h-auto" src="https://cdn.musora.com/image/fetch/w_750,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/october/collage.png" alt="collage">--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="text-center">--}}
            {{--                <a class="join smaller md:w-52 lg:w-60" href="#orderNow" style="color:black;">See the deal</a>--}}
            {{--            </div>--}}
        </div>
    </section>
@endsection

@section('sticky-bar')
{{--    @include('_partials.layout.holiday.homepage-sticky-bar', [--}}
{{--        'text' => 'GET 10 FREE BONUSES <br> WORTH $1228.94'--}}
{{--    ])--}}

{{--   <div class="h-10 relative w-full block"></div>--}}
{{--   <a href="#customize-anchor" --}}{{--style="background-image:url(https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/september/sticky_bar.jpg)"--}}
{{--           class="anchor-slide promo-banner block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap bg-cover bg-center shadow-md z-0 mx-auto -mt-10 text-xs">--}}
{{--       <div class="relative">--}}
{{--        <div class="absolute inset-0" style="background:radial-gradient(50.22% 125.94% at 0% 0%, #00C9AC 0%, #E1FFFB 100%); transform:rotate(-180deg)"></div>--}}
{{--           <div class="inline-block align-middle text-left py-1 relative">--}}
{{--               <div class="inline-block leading-none font-bebas align-middle mx-auto text-2xl mr-2--}}{{--py-0.5 px-1 bg-black rounded-md--}}{{--text-white">--}}
{{--                   <img class="h-7 sm:h-8" src="https://cdn.musora.com/image/fetch/w_220,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/october/scary_logo.png" alt="play-better-solos">--}}
{{--               </div>--}}
{{--                --}}{{----}}{{--<h5 class="leading-none font-bebas inline-block align-middle mx-auto text-2xl mr-2 h-8 py-1.5 px-2 bg-black rounded-md text-white">PLAY BETTER SOLOS</h5>--}}
{{--               <p class="inline-block align-middle mx-auto text-black leading-none text-base font-bebas">GET SCARY GOOD GUITAR LESSONS <br>+ 3 TRICK-FREE TREATS WORTH $441</p>--}}
{{--           </div>--}}
{{--       </div>--}}
{{--   </a>--}}
@endsection

{{--@section('final')--}}
{{--    @include("guitareo.sales.partials._subscribe-options")--}}
{{--@endsection--}}

@section('start-button', '/choose-your-trial/')
@section('final')
     @include("guitareo.sales.partials._final-trial", [ "sevenDay" => true, "url" => "/choose-your-trial/" ])
@endsection
