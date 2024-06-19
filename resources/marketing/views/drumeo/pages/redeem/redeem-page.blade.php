@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Access Pass Redeem | Drumeo</title>
    <meta name="description" content="To redeem your access pass enter your code below!">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
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
            font:500 16px "Open Sans", sans-serif;
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
            font:400 12px/23px "Open Sans", sans-serif;
            margin:0;
            padding:10px;
            box-sizing:border-box;
            box-shadow:none !important;
            height:45px;
            border-radius:70px;
        }

        .default-form-field {
            width:100%;
        }

        .help-message {
            color:#666;
            font:400 14px "Open Sans", sans-serif;
            padding:0 0.9375rem;
            margin-bottom:10px;
        }

        .validation-error {
            color: red;
            font: 600 16px/1em "Open Sans", sans-serif;
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
            font:700 14px "Open Sans", sans-serif;
            margin:15px auto 10px;
        }

        @media only screen and (min-width:40em) {
            .redeem-switcher {
                margin:0 auto 15px;
            }

            input[type="text"],
            input[type="password"] {
                font-size:16px;
                width:99%;
                padding:10px 15px;
            }

            #commentform .code-input {
                font-size:16px;
                width:95%;
            }
        }

        .apply {
            background:#0b76db;
        }

        .apply:hover {
            background:#258ff4;
        }
    </style>
@endsection

<!-- Main -->
@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "trialVersion" => true,
        "joinUrl" => '/choose-plan',
    ])

    <div class="py-8 sm:py-12 px-4 sm:px-6 bg-black bg-cover bg-center text-white text-center"
        style="background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/{{ musora_cdn('redeem/sweetwater/bg.jpg') }});">
        <div class="container mx-auto max-w-sm sm:max-w-xl lg:max-w-3xl">
            @if(!empty($alesisNitro) || !empty($alesisCrimson) || !empty($alesisStrata) || !empty($alesisStrataCore))
                @php
                    $logoMapping = [
                        'alesisNitro' => [
                            'name' => 'Nitro Max',
                            'video' => 'https://www.youtube-nocookie.com/embed/iZ3CL7nMOpc'
                        ],
                        'alesisCrimson' => [
                            'name' => 'Crimson III',
                            'video' => '//player.vimeo.com/video/915243228'
                        ],
                        'alesisStrata' => [
                            'name' => 'Strata Prime',
                            'video' => '//player.vimeo.com/video/915243228'
                        ],
                        'alesisStrataCore' => [
                            'name' => 'Strata Core',
                            'video' => '//player.vimeo.com/video/915243228'
                        ],
                    ];

                    $key = !empty($alesisNitro) ? 'alesisNitro' : (!empty($alesisCrimson) ? 'alesisCrimson' : (!empty($alesisStrata) ? 'alesisStrata' : 'alesisStrataCore'));
                    $nameSrc = $logoMapping[$key]['name'];
                    $videoSrc = $logoMapping[$key]['video'];
                @endphp
                <img alt="alesis logo" loading="lazy" onload="this.classList.remove('opacity-0')" class="h-6 sm:h-10 transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1060x0/filters:quality(95)/marketing/drumeo/products/kit/alesis-with-drumeo.png">
                <h1 class="leading-none font-lexend uppercase mt-2 mb-5">{{ $nameSrc }}</h1>
                <h3 class="leading-tight mb-6 sm:mb-10"><strong>Redeem your membership<br class="sm:hidden"> to Drumeo.</strong></h3>
                <div class="aspect-16:9 w-full relative border-2 rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full" src="{{ $videoSrc }}" frameborder="0" allowfullscreen allow="autoplay" title="10year-video"></iframe>
                </div>
            @endif
        </div>
    </div>

    <div class="py-8 sm:py-12 px-4 sm:px-6">
        <div class="container mx-auto max-w-3xl">
            @php
                $isNewAccount = $newAccount;
                $accountTypes = [
                    'alesisNitro' => '/alesis',
                    'alesisCrimson' => '/alesis-crimson-iii',
                    'alesisStrata' => '/alesis-strata',
                    'alesisStrataCore' => '/alesis-strata-core'
                ];

                $membershipLink = '';
                foreach ($accountTypes as $type => $link) {
                    if (!empty($$type)) {
                        $membershipLink = $isNewAccount ? $link . '/existing' : $link;
                        break;
                    }
                }

                $membershipMessage = $isNewAccount
                    ? 'Click here to add to your account.'
                    : 'Click here to redeem on a new account.';
            @endphp

            <div class="redeem-switcher rounded-xl py-4 bg-gray-300" x-data="{
                        membershipLink: '{{ $membershipLink }}',
                        init() {
                            const params = new URLSearchParams(window.location.search);
                            const code = params.get('code');
                            if (code && !this.membershipLink.includes(`code=${code}`)) {
                                this.membershipLink += (this.membershipLink.includes('?') ? '&' : '?') + `code=${code}`;
                            }
                        }
                    }" x-init="init()">
                <strong>{{ $isNewAccount ? 'Existing Member?' : 'Not already a member?' }}</strong>
                <br>
                <a :href="membershipLink" class="text-drumeo underline">{{ $membershipMessage }}</a>
                <br>
                <em>(The form below is only for {{ $isNewAccount ? 'new accounts' : 'existing members' }})</em>
            </div>

            @foreach ($errors->all() as $error)
                <br>
                <p class="validation-error">{{ $error }}</p>
            @endforeach

            @include('musora.pages.redeem._redeem-form', [
                'existing' => !$isNewAccount,
                'buttonText' => 'Click To Redeem &raquo;',
                'buttonColor' => 'bg-drumeo text-white',
                'accessCodeArray' => $accessCodeArray,
            ])

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


    @include("drumeo.sales.partials._footer")

    @include('_partials.components.forms.redeem-form-script', [
        'api' => empty($existing) ? get_musora_brand_base_url().'/ecommerce/access-codes/redeem' : URL::route('access-codes.form-claim'),
        'existingMember' => !$newAccount,
    ])
@endsection
