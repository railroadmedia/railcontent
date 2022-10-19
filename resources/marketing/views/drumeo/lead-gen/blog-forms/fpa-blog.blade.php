<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    @include('drumeo._partials._favicons')

    <meta name="robots" content="noindex">
    <title>9 FREE PLAY-ALONGS | Drumeo</title>
    <meta name="description" content="Add your drumming to nine high-quality drum play-along tracks. (FREE).">

    @include('drumeo._partials._fonts')
    <base target="_parent">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="/laravel/public/css/tailwind-helpers.css" rel="stylesheet">
    <style>
        body {
            height:100vh;
            position:relative;
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
            background:#eee;
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
            background:#0b76db
        }

        .infusion-form button:hover {
            background:#258ff4
        }
    </style>

{!! \App\Analytics\Tracker::trackPageView() !!}

{!! \App\Analytics\Tracker::headBottom() !!}
</head>

<body>
{!! \App\Analytics\Tracker::bodyTop() !!}

<section class="text-center absolute top-1/2 left-1/2 w-full px-5" style="transform:translate(-50%,-50%)">
    <form id="DrumeoEngagementTriggerFreePlayAlongsWebForm" accept-charset="UTF-8" action="/laravel/public/customer-io/submit-email-form"
          method="POST" class="ajax-form clearfix infusion-form max-w-3xl mx-auto" onsubmit="emailSignUpConversionTrackerForImpactProvider()">
        <input type="hidden" name="form_name" value="Free Play-Alongs">

        <div class="infusion-field w-full sm:pr-3 float-left sm:w-7/12 md:text-left">
            <input id="sign-up-email" class="w-full" name="email" type="email" placeholder="ENTER YOUR EMAIL" required/>
        </div>
        <div class="infusion-submit w-full sm:pl-3 float-left sm:w-5/12">
            <button class="submit" type="submit">HOOK ME UP</button>
        </div>
        <input name="inf_form_xid" type="hidden" value="DrumeoEngagementTriggerFreePlayAlongsWebForm">
        <input name="tag_names_to_add[]" type="hidden" value="Drumeo - Engagement - Trigger - Free Play-Alongs - Web Form">
        <input name="list_ids_to_subscribe_to[]" type="hidden" value="31">
        <input name="success_redirect" type="hidden" value="/thankyou">
    </form>
    <div class="thank-you-box bg-white rounded-full w-full mx-auto text-center text-green-300 max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
        <h5 class="mx-auto text-xl font-bold"><strong><i class="fas fa-check"></i> Success, Check your email!</strong></h5>
    </div>
</section>

{!! \App\Analytics\Tracker::bodyBottom() !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('/assets/members-area/js/gulp/navigation-sales.js') }}"></script>
</body>
@include("drumeo.lead-gen.partials.impact-email-sign-up-tracker")
</html>
