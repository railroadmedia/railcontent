@extends('musora._partials.layout')

@section('head-includes')
    <title>Access Pass Redeem | Drumeo</title>
    <meta name="description" content="To redeem your access pass enter your code below!">
    @include('_partials.layout._tailwindcdn')
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
            margin:20px auto 5px;
        }

        .redeem-switcher .red {
            font-weight:600;
            color:red;
        }

        .input-describer {
            font:700 14px "Open Sans", sans-serif;
            margin:15px auto 10px;
        }

        @media only screen and (min-width:40em) {
            .redeem-switcher {
                margin:30px auto 15px;
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
@section('layout-body')
    <div class="pt-8 sm:pt-12 px-4 sm:px-6 bg-cover bg-center text-white text-center" style="background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/{{ musora_cdn('redeem/sweetwater/bg.jpg') }});">
        <div class="container mx-auto max-w-sm sm:max-w-xl lg:max-w-3xl">
            @if($theme == 'drumeo')
                <style>
                .text-brand {
                color:#0b76db;
                }
                .apply {
                background:#0b76db;
                }

                .apply:hover {
                background:#258ff4;
                }
                </style>
                <img alt="sweetwater logo" loading="lazy" onload="this.classList.remove('opacity-0')" class="h-8 sm:h-11 lg:h-14 transition-opacity opacity-0" src="{{ musora_cdn('redeem/sweetwater/drumeo-sweetwater.svg') }}">
                <h3 class="leading-tight mt-4 mb-3"><strong>Redeem your membership to Drumeo.</strong></h3>
                <h6 class="leading-normal mb-6 sm:mb-10">Thank you for choosing to become a Drumeo Student through Sweetwater!<br class="hidden sm:inline">
                Please enter the code that they provided you in the form below.</h6>
                <img alt="laptop spread" loading="lazy" onload="this.classList.remove('opacity-0')" class="-mb-4 h-40 sm:h-72 lg:h-96 transition-opacity opacity-0" src="https://www.musora.com/musora-cdn/image/width=1400,quality=85/{{ musora_cdn('redeem/sweetwater/drumeo-spread.png') }}">
            @elseif($theme == 'pianote')
                <style>
                .text-brand {
                color:#F61A30;
                }
                .apply {
                background:#F61A30;
                }

                .apply:hover {
                background:#f53347;
                }
                </style>
                <img alt="sweetwater logo" loading="lazy" onload="this.classList.remove('opacity-0')" class="h-8 sm:h-11 lg:h-14 transition-opacity opacity-0" src="{{ musora_cdn('redeem/sweetwater/pianote-sweetwater.svg') }}">
                <h3 class="leading-tight mt-4 mb-3"><strong>Redeem your membership to Pianote.</strong></h3>
                <h6 class="leading-normal mb-6 sm:mb-10">Thank you for choosing to become a Pianote Student through Sweetwater!<br class="hidden sm:inline">
                Please enter the code that they provided you in the form below.</h6>
                <img alt="laptop spread" loading="lazy" onload="this.classList.remove('opacity-0')" class="-mb-4 h-40 sm:h-72 lg:h-96 transition-opacity opacity-0" src="https://www.musora.com/musora-cdn/image/width=1400,quality=85/{{ musora_cdn('redeem/sweetwater/pianote-spread.png') }}">
            @elseif($theme == 'guitareo')
                <style>
                .text-brand {
                color:#00C9AC;
                }
                .apply {
                background:#00C9AC;
                }

                .apply:hover {
                background:#00e3c5;
                }
                </style>
                <img alt="sweetwater logo" loading="lazy" onload="this.classList.remove('opacity-0')" class="h-8 sm:h-11 lg:h-14 transition-opacity opacity-0" src="{{ musora_cdn('redeem/sweetwater/guitareo-sweetwater.svg') }}">
                <h3 class="leading-tight mt-4 mb-3"><strong>Redeem your membership to Guitareo.</strong></h3>
                <h6 class="leading-normal mb-6 sm:mb-10">Thank you for choosing to become a Guitareo Student through Sweetwater!<br class="hidden sm:inline">
                Please enter the code that they provided you in the form below.</h6>
                <img alt="laptop spread" loading="lazy" onload="this.classList.remove('opacity-0')" class="-mb-4 h-40 sm:h-72 lg:h-96 transition-opacity opacity-0" src="https://www.musora.com/musora-cdn/image/width=1400,quality=85/{{ musora_cdn('redeem/sweetwater/guitareo-spread.png') }}">
            @elseif($theme == 'singeo')
                <style>
                .text-brand {
                color:#8300E9;
                }
                .apply {
                background:#8300E9;
                }

                .apply:hover {
                background:#9000ff;
                }
                </style>
                <img alt="sweetwater logo" loading="lazy" onload="this.classList.remove('opacity-0')" class="h-8 sm:h-11 lg:h-14 transition-opacity opacity-0" src="{{ musora_cdn('redeem/sweetwater/singeo-sweetwater.svg') }}">
                <h3 class="leading-tight mt-4 mb-3"><strong>Redeem your membership to Singeo.</strong></h3>
                <h6 class="leading-normal mb-6 sm:mb-10">Thank you for choosing to become a Singeo Student through Sweetwater!<br class="hidden sm:inline">
                Please enter the code that they provided you in the form below.</h6>
                <img alt="laptop spread" loading="lazy" onload="this.classList.remove('opacity-0')" class="-mb-4 h-40 sm:h-72 lg:h-96 transition-opacity opacity-0" src="https://www.musora.com/musora-cdn/image/width=1400,quality=85/{{ musora_cdn('redeem/sweetwater/singeo-spread.png') }}">
            @else
                <style>
                .text-brand {
                color:#0b76db;
                }
                .apply {
                background:#000C17;
                }

                .apply:hover {
                background:#001930;
                }
                </style>
                <img alt="sweetwater logo" loading="lazy" onload="this.classList.remove('opacity-0')" class="h-8 sm:h-11 lg:h-14 transition-opacity opacity-0" src="{{ musora_cdn('redeem/sweetwater/musora-sweetwater.svg') }}">
                <h3 class="leading-tight mt-4 mb-6 sm:mb-10"><strong>Redeem your membership for<br class="hidden sm:inline"> Drumeo, Pianote, Guitareo & Singeo.</strong></h3>
                <img alt="laptop spread" loading="lazy" onload="this.classList.remove('opacity-0')" class="-mb-4 h-40 sm:h-72 lg:h-96 transition-opacity opacity-0" src="https://www.musora.com/musora-cdn/image/width=1400,quality=85/{{ musora_cdn('redeem/sweetwater/drumeo-spread.png') }}">
            @endif
        </div>
    </div>
    <div class="py-8 sm:py-12 px-3 sm:px-6">
        <div class="container mx-auto max-w-3xl">
             @if($newAccount)
                <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                    <strong><b>Existing Member?</b>
                        <br>
                        <a class="text-brand underline" href="/drumeo/sweetwater/existing">Click here to add to your account.</a>
                    </strong>
                    <br>
                    <em>(The form below is only for new accounts)</em>
                </div>

                @foreach ($errors->all() as $error)
                    <br>
                    <p class="validation-error">{{ $error }}</p>
                @endforeach

                @include('musora.pages.redeem._redeem-form')
             @else
                <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                    <strong> <b>Not already a member?</b>
                        <br>
                        <a class="text-brand underline" href="/redeem">Click here to redeem on a new account.</a>
                    </strong>
                    <br>
                    <em>(The form below is only for existing members)</em>
                </div>

                @foreach ($errors->all() as $error)
                    <br>
                    <p class="validation-error">{{ $error }}</p>
                @endforeach

                @include('musora.pages.redeem._redeem-form', [
                    "existing" => true
                ])
             @endif
            <br>
            <p class="help-message">
                ** If you enter the email of an account that already has an existing valid subscription, your subscription will be extended based on the time associated with your card.
            </p>
            <p class="help-message">
                ** If you enter a new email address, an account will be created for you and your new password will be emailed to you shortly after claiming your card.
            </p>
            <p class="help-message">
                ** Your Access Page may look like it’s only for Drumeo, but this pass will give you access to all four of our communities: Drumeo, Pianote, Guitareo, and Singeo!
            </p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(
            function () {
                $('.code-input').bind(
                    'paste', function (e) {
                        var value = e.originalEvent.clipboardData.getData('text');
                        value = value.toUpperCase().replace(/[^0-9A-Z]/g, "");
                        var chunks = value.match(new RegExp('.{1,4}', 'g'));
                        for (var i = 0; i < chunks.length; i++) {
                            $('.code-input').eq(i).val(chunks[i]);
                        }
                    }
                ).bind(
                    'input',
                    function (e) {
                        console.log($(this).val().length);
                        if ($(this).val().length == 4) {
                            $('.code-input').eq($(this).index('.code-input') + 1).focus();
                        }
                    }
                );
            }
        );
    </script>
@endsection
