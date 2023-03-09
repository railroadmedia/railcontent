<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    <meta name="robots" content="noindex">
    <title>Weekly Email | Guitareo</title>
    <meta name="description" content="Enter your email to get fresh lessons, interviews, and content delivered to your inbox every week!">

    <base target="_parent">
    @include('_partials.layout._tailwindcdn')
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <style>
        body {
            height:100vh;
            position:relative;
            color:#fff;
        }
        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h5 {
            font-weight:400;
            line-height:1em;
            font-family:"Open Sans", sans-serif;
            margin:0 auto;
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        .infusion-form input, .infusion-form button {
            font:400 18px/45px "Open Sans", sans-serif;
            height:45px;
            background:#fff;
            color:#999;
            border-radius:100px;
            padding:7px 20px;
            margin:0 auto 10px;
            transition:all .2s ease-in;
            box-shadow:none;
            text-align:inherit;
            border:none
        }

        @media (min-width:640px) {
            .infusion-form input, .infusion-form button {
                font-size:19px;
                margin:0 auto
            }
        }

        @media (min-width:1024px) {
            .infusion-form input, .infusion-form button {
                font-size:23px
            }
        }

        .infusion-form button {
            font-family:"Roboto Condensed", sans-serif;
            font-weight:700;
            text-transform:uppercase;
            margin:0 auto!important;
            text-align:center;
            display:block;
            cursor:pointer;
            border:none;
            width:100%;
            padding:0;
            color:#fff;
            background:#00C9AC
        }

        .infusion-form button:hover {
            background:#00e0bf
        }
    </style>
    <style>
        form input, form button {
            line-height:40px;
            height: 40px;
        }
        @media (min-width: 40em) {
            form input, form button {
                height: 52px;
                line-height: 52px;
            }
        }
        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:10px;
        }
        @media (min-width: 40em) {
            .thank-you-box.active {
                padding: 12px;
            }
        }
    </style>

    @include('_partials.layout.favicons.guitareo-favicons')
    @include('_partials.layout._fonts')

    {!! \App\Analytics\Tracker::trackPageView() !!}

    {!! \App\Analytics\Tracker::headBottom() !!}
</head>

<body class="bg-musora-black">

{!! \App\Analytics\Tracker::bodyTop() !!}

<section class="text-center absolute top-1/2 left-1/2 w-full px-5" style="transform:translate(-50%,-50%)">
    <h5 class="leading-normal mb-3 md:mb-4">
        Enjoying this article? Enter your email to get fresh lessons, <br class="hidden sm:inline">
        interviews, and content delivered to your inbox every week:</h5>
    <form id="GuitareoEngagementTriggerWebsiteSignupWebForm" accept-charset="UTF-8" action="/customer-io/submit-email-form" method="POST"
          class="ajax-form clearfix infusion-form max-w-3xl mx-auto" onsubmit="emailSignUpConversionTrackerForImpactProvider()">
        <input type="hidden" name="form_name" value="Blog Signup">
        <input type="hidden" name="leadtracker_form_name" value="Blog Signup">
        <div class="infusion-field w-full sm:pr-3 float-left sm:w-7/12 md:text-left">
            <input id="inf_form_xid" class="w-full" name="email" type="email" placeholder="Email Address..." required/>
        </div>
        <div class="infusion-submit w-full sm:pl-3 float-left sm:w-5/12">
            <button class="submit" type="submit">Send Me Free Content</button>
        </div>
        <input name="inf_form_xid" type="hidden" value="GuitareoEngagementTriggerWebsiteSignupWebForm">
        <input name="tag_names_to_add[]" type="hidden" value="Guitareo - Engagement - Trigger - Website Signup - Web Form">
        <input name="list_ids_to_subscribe_to[]" type="hidden" value="32">
        <input name="success_redirect" type="hidden" value="/thank-you-white">
    </form>
    <div class="thank-you-box w-full mx-auto text-center text-green-300 max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
        <h5 class="mx-auto"><strong><i class="fas fa-check"></i> Success, Check your email!</strong></h5>
    </div>
</section>

{!! \App\Analytics\Tracker::bodyBottom() !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
</body>
@include("guitareo.lead-gen.partials.impact-email-sign-up-tracker")
</html>
