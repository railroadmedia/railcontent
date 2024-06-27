@php
    require_once(resource_path('marketing/views/musora/_partials/homepage-data.php'));
@endphp

@extends('musora._partials.layout', [
    "hideJoin" => true,
])

@section('head-includes')

    <title>Access Pass Redeem | Drumeo</title>
    <meta name="description" content="To redeem your access pass enter your code below!">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <style>
        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent;
        }

        input::-webkit-input-placeholder,
        textarea::-webkit-input-placeholder {
            color:#AAA;
        }

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            color:#AAA;
        }

        input:-ms-input-placeholder,
        textarea:-ms-input-placeholder {
            color:#AAA;
        }

        input::placeholder,
        textarea::placeholder {
            color:#AAA;
        }

        .error {
            color:red;
            font:500 20px "Open Sans", sans-serif;
        }

        input.jq-couponcode-part {
            width:69px;
        }

        input.jq-couponcode-good {
            background-color:#77ff77;
        }

        input.jq-couponcode-good-nohighlight {
            text-align:center;
            padding:2px 10px;
        }

        input.jq-couponcode-bad {
            background-color:#ff7777;
        }

        .jq-couponcode-sep {
            width:6px;
        }

        .apply {
            background:#00060B;
            border-radius:70px;
            color:#FFF;
            font:400 28px/60px "Bebas Neue", sans-serif;
            text-transform:uppercase;
            height:60px;
            width:100%;
            margin:20px auto 0;
            border:none;
            cursor:pointer;
        }

        input[type="text"],
        input[type="password"] {
            background:#FFF;
            color:#000;
            border:1px solid #ccc;
            font:400 20px/20px "Open Sans", sans-serif;
            margin:0;
            padding:15px 20px;
            box-sizing:border-box;
            box-shadow:none !important;
            border-radius:100px;
        }

        .default-form-field {
            width:100%;
        }

        .help-message {
            color:#666;
            font:400 16px "Open Sans", sans-serif;
            padding:0 0.9375rem;
            margin-bottom:10px;
        }

        .validation-error {
            color: red;
            font: 600 20px/1em "Open Sans", sans-serif;
        }

        #commentform .code-input {
            text-align:center;
            display:inline-block;
            margin:0;
            font-size:10px;
        }

        .redeem-switcher {
            font:400 16px "Open Sans", sans-serif;
            text-align:center;
            display:block;
            margin:0 auto 5px;
        }

        .input-describer {
            font:900 20px "Open Sans", sans-serif;
            margin:15px auto 10px;
        }

        @media only screen and (min-width:40em) {
            .redeem-switcher {
                margin:0 auto 15px;
            }

            #commentform .code-input {
                font-size:16px;
                width:95%;
            }
        }

        .apply {
            background:#ffae00;
            color:#000;
        }

        .apply:hover {
            background:#ffb61a;
            color:#000;
        }
    </style>

    @if(!empty($thomann))
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                n.push=n;n.loaded=!0;n.version='2.0';n.agent='fmc-sunlab';n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                document,'script','//connect.facebook.net/en_US/fbevents.js');
            fbq('init', '520898398018927');
            fbq('track', "PageView");
            fbq('trackCustom', 'FNet', {
                cat1: 'DR'
            });
        </script>
        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id=520898398018927&ev=PageView&noscript=1"
            /></noscript>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-1019120767"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'AW-1019120767');
            gtag('event', 'conversion', {
                'send_to': 'AW-1019120767',
                'cat1': 'DR',
                'arena': 'fnet',
                'fnet': 'drumeo'
            });
        </script>
    @endif
@endsection

@section('body-data')
    x-data ='{
        lazyLoad: false,
    }'
@endsection

@section('layout-body')
    <div class="py-8 sm:py-12 px-4 sm:px-6 bg-black bg-cover bg-center text-white text-center" style="background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/{{ musora_cdn('redeem/sweetwater/bg.jpg') }});">
        <div class="container mx-auto max-w-3xl">
            @if(!empty($thomann))
                <div class="mb-2 align-middle flex items-center justify-center w-full">
                    <img class="inline-block h-6 sm:h-8 lg:h-9 transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/musora/membership/redeem/thomann-white.png"
                        alt="spotify logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h2 class="inline-block font-black mx-3 sm:mx-5">+</h2>
                    <img class="inline-block h-12 sm:h-20 transition-opacity opacity-0" src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/Musora-AllBrands.png"
                        alt="spotify logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
                <h3 class="leading-tight my-2"><strong>Redeem your @if(!empty($day90)) 90-Day @endif membership for Musora.</strong></h3>
            @elseif(!empty($spotify))
                <img class="h-7 sm:h-8 lg:h-9 mb-2 transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/musora/membership/redeem/musora-spotify-logo-white.svg"
                    alt="spotify logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                <h3 class="leading-tight my-2"><strong>Redeem your membership for Musora.</strong></h3>
            @else
                <h3 class="leading-tight"><strong>Redeem your membership for Musora.</strong></h3>
            @endif
            <h5 class="leading-tight mt-2 mb-6 sm:mb-8 mx-auto max-w-md">Level up your skills with the lessons, songs, teachers, and practice tools trusted by <strong>thousands of active students.</strong></h5>
            <picture>
                <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1480x0/filters:quality(95)/marketing/musora/membership/redeem/redeem-laptop2.webp">
                <img class="h-40 sm:h-72 lg:h-96 transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/musora/membership/redeem/redeem-laptop2.webp"
                    alt="laptop spread" loading="lazy" onload="this.classList.remove('opacity-0')" >
            </picture>
        </div>
    </div>
    <div class="py-8 sm:py-12 px-4 sm:px-6">
        <div class="container mx-auto max-w-3xl">
             @if($newAccount)
                <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                    <strong><b>Existing Member?</b>
                        <br>
                        <a class="text-drumeo underline"
                            @if(!empty($spotify))
                                href="/redeem-spotify/existing"
                            @elseif(!empty($thomann))
                                href="/thomann/existing"
                            @else
                                href="/redeem/existing"
                            @endif
                        >Click here to add to your account.</a>
                    </strong>
                    <br>
                    <em>(The form below is only for new accounts)</em>
                </div>

                @foreach ($errors->all() as $error)
                    <br>
                    <p class="validation-error">{{ $error }}</p>
                @endforeach

                @include('musora.pages.redeem._redeem-form', [
                    'existing' => !$isNewAccount,
                    'buttonText' => 'Click To Redeem &raquo;',
                    'buttonColor' => 'bg-drumeo text-white',
                ])
             @else
                <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                    <strong> <b>Not already a member?</b>
                        <br>
                        <a class="text-drumeo underline"
                            @if(!empty($spotify))
                                href="/redeem-spotify"
                            @elseif(!empty($thomann))
                                href="/thomann"
                            @else
                                href="/redeem"
                            @endif>Click here to redeem on a new account.</a>
                    </strong>
                    <br>
                    <em>(The form below is only for existing members)</em>
                </div>

                @foreach ($errors->all() as $error)
                    <br>
                    <p class="validation-error">{{ $error }}</p>
                @endforeach

                @include('musora.pages.redeem._redeem-form', [
                    'existing' => !$isNewAccount,
                    'buttonText' => 'Click To Redeem &raquo;',
                    'buttonColor' => 'bg-drumeo text-white',
                ])
             @endif


            <br>
            @if(!$newAccount)
                <p class="help-message">
                    ** If you apply your code to an account that already has an active Membership subscription, your subscription will be extended based on the time associated with your card.
                </p>
            @endif

            <p class="help-message">
                ** Your Access Pass will give you access to all four of our communities: Drumeo, Pianote, Guitareo, and Singeo!
            </p>
        </div>
    </div>

    @php
        $gridItems = $musora['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'seven' => true,
    ])

    @include('_partials.components.forms.redeem-form-script', [
        'api' => empty($existing) ? get_musora_brand_base_url().'/ecommerce/access-codes/redeem' : URL::route('access-codes.form-claim'),
        'existingMember' => !$newAccount,
    ])
@endsection
