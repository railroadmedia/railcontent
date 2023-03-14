@extends('musora._partials.layout')

@section('head-includes')
    <title>Sonor Drummers Free Trial</title>
    <meta property="og:title" content="Musora | Drumeo, Pianote, Singeo, Guitareo">

    <meta name="description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">
    <meta property="og:description" content="You’re eligible for a free 30-day membership to Drumeo (normally $29).">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/promos/sonor-trial/header-background.jpg" style="display: none;">
    <meta property="og:title" content="Sonor Drummers Free Trial">
    <meta property="og:description" content="You’re eligible for a free 30-day membership to Drumeo (normally $29).">
    <meta property="og:url" content="https://www.drumeo.com/sonor/">
    <style>
        [placeholder]:focus::-webkit-input-placeholder {
            color: transparent;
        }

        .thank-you-box{width:100%;max-width:960px;border-radius:5px;height:auto;max-height:0;visibility:hidden;opacity:0;transition:all .4s ease-in;display:block;margin:0 auto;background:#FFF;text-align:center;overflow:hidden;color:#000}.thank-you-box.active{max-height:1000px;visibility:visible;opacity:1;padding:15px}@media (min-width: 40em){.thank-you-box.active{padding:20px}}@media (min-width: 64em){.thank-you-box.active{padding:30px}}.thank-you-box p{font:400 15px/1.4em "Open Sans",sans-serif;margin:0 auto}@media (min-width: 40em){.thank-you-box p{font-size:19px}}@media (min-width: 64em){.thank-you-box p{font-size:23px}}.thank-you-box p em{line-height:1.4em;max-width:550px;display:inline-block;font-size:12px}@media (min-width: 40em){.thank-you-box p em{font-size:14px}}.thank-you-box h2{font:700 30px/1em "Roboto Condensed",sans-serif;margin:15px auto;text-transform:uppercase;color:#0b76db}@media (min-width: 40em){.thank-you-box h2{font-size:37px;margin:20px auto}}@media (min-width: 64em){.thank-you-box h2{font-size:44px}}.thank-you-box .social-media a{background:#000;color:#fff;border-radius:50%;display:inline-block;text-align:center;margin:20px 3px 0;width:50px;height:50px;line-height:50px;font-size:26px}@media (min-width: 64em){.thank-you-box .social-media a{width:70px;height:70px;line-height:70px;font-size:35px;margin:25px 10px 0}}

        .power-pack-signup {
            background: #191B1C url(https://dpwjbsxqtam5n.cloudfront.net/promos/spring/customize-bg.jpg) no-repeat center center;
            color: #fff;
            padding: 40px 0;
        }
        @media (min-width: 40em) {
            .power-pack-signup {
                padding: 70px 0;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup {
                padding: 90px 0;
            }
        }
        .power-pack-signup .logo img {
            width: 100%;
            max-width: 190px;
            margin: 0 auto 15px;
        }
        @media (min-width: 40em) {
            .power-pack-signup .logo img {
                max-width: 260px;
                margin: 0 auto 20px;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup .logo img {
                max-width: 340px;
                margin: 0 auto 25px;
            }
        }
        .power-pack-signup h3 {
            margin: 0 auto 35px;
        }
        @media (min-width: 40em) {
            .power-pack-signup h3 {
                margin: 0 auto 40px;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup h3 {
                margin: 0 auto 55px;
            }
        }
        .power-pack-signup form {
            position: relative;
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
        }
        @media (min-width: 40em) {
            .power-pack-signup form {
                margin: 0 auto 10px;
                max-width: 640px;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup form {
                max-width: 900px;
            }
        }
        .power-pack-signup form input {
            font: 400 18px/50px "Open Sans", sans-serif;
            height: 50px;
            color: #999;
            border-radius: 5px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 15px;
            width: 100%;
            border: none;
        }
        @media (min-width: 40em) {
            .power-pack-signup form input {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup form input {
                font-size: 26px;
                height: 75px;
                line-height: 75px;
            }
        }
        .power-pack-signup form input[type="submit"] {
            font-family: "Roboto Condensed", sans-serif;
            font-weight: 700;
            color: #FFF;
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
        .power-pack-signup form input[type="submit"]:hover {
            background: #258ff4;
        }
        .power-pack-signup .questions p {
            margin: 0;
            opacity: 0.7;
            max-width: 100%;
            font-size: 13px;
        }
        .power-pack-signup .questions p a {
            color: inherit;
            display: inline-block;
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
        .disclaimer p {
            font: 400 12px/1.4em "Open Sans", sans-serif;
            margin: 0 auto;
            width: calc(100% - 40px);
            float: left;
            text-align: left;
        }

        .success, .error  {
            width: 100%;
            max-width: 590px;
            margin: 0 auto 25px;
            background: #fff;
            border-radius: 5px;
            color: #000;
            padding: 30px;
        }
        .success p, .error p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto;
        }

        @media (min-width:40em) {
            .success p, .error p {
                font-size:19px;
            }
        }

        @media (min-width:64em) {
            .success p, .error p {
                font-size:23px;
            }
        }

        .success h2, .error h2 {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#0b76db;
        }

        @media (min-width:40em) {
            .success h2, .error h2 {
                font-size:40px;
                margin:20px auto;
            }
        }

        @media (min-width:64em) {
            .success h2, .error h2 {
                font-size:50px;
            }
        }

        .success p em, .error p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px;
        }

        @media (min-width:40em) {
            .success p em, .error p em {
                font-size:14px;
            }
        }

        .power-pack-signup .text-error {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#d9cf0d;
        }

        @media (min-width:40em) {
            .power-pack-signup .text-error {
                font-size:40px;
                margin:20px auto;
            }
        }

        @media (min-width:64em) {
            .power-pack-signup .text-error {
                font-size:50px;
            }
        }
    </style>
@endsection

@section('body-class', 'dark')

<!-- Main -->
@section('layout-body')

   @if(!empty($errors->all()))
        <div style="padding: 20px;color: #fff;background:#eb4747;text-align: center;text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);">
            <div class="container mx-auto">
                <p><strong>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </strong><a style="color:inherit" data-open="redeem"><u>Try Again &raquo;</u></a></p>
            </div>
        </div>
    @endif

   <section class="sonor-footer content-section text-center">
       <div class="container mx-auto">
           <img class="logo edge" src="https://www.musora.com/musora-cdn/image/quality=100,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
           <img class="logo sonor" src="https://dpwjbsxqtam5n.cloudfront.net/promos/sonor-trial/sonor-logo-white.png">
           <br>
           <h1><strong>The Ultimate Online <br class="inline lg:hidden"> Drum Lessons Experience<sup>&trade;</sup></strong></h1>
           <br>
           <h4 class="px-2 md:px-3"><strong>Sonor Drummers:</strong> You’re eligible for a free 30-day membership to Drumeo (normally $29).<br class="hidden lg:inline">
               Simply use the special access code you received on your flyer to activate your online drum lessons.</h4>
           <a data-open="redeem" class="join blue">REDEEM YOUR FREE LESSONS &raquo;</a>
       </div>
   </section>

    <div class="reveal large" id="redeem" data-reveal data-reset-on-close="false">
        <h3 class="mb-1"><strong>Redeem Your Drumeo Access Pass</strong></h3>

        <p class="change-form uppercase pointer mr-2 mb-1
            {{ old('credentials_type') == 'new' || old('credentials_type') != 'existing' ? 'active' : '' }}"
                data-form="newAccountForm">Create New Account</p>

        <br class="inline md:hidden">

        <p class="change-form uppercase pointer mb-1
            {{ old('credentials_type') == 'existing' ? 'active' : '' }}"
                data-form="existingAccountForm">Add to My Account</p>

        <div id="newAccountForm" class="redemption-form {{ old('credentials_type') == 'new' || old('credentials_type') != 'existing' ? '' : 'hide' }}">
            <div>
                <p class="mb-1">
                    Fill out the form below to start your 30-Day Drumeo Membership.
                </p>

                <form action="{{ get_musora_brand_base_url() }}/ecommerce/access-codes/redeem" method="POST" novalidate>
                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    <input type="hidden" name="credentials_type" value="new">
                    <input type="hidden" name="redirect" value="{{ $redirectUrl ?? '/drumeo' }}">

                    <div class="mb-1">
                        @include('partials.bladesora.members.inputs.text-input', [
                            "brand" => "drumeo",
                            "type" => "text",
                            "inputId" => "accessCodeNew",
                            "inputName" => "access_code",
                            "inputLabel" => "Access Code...",
                            "inputValue" => old('access_code'),
                            "inputErrors" => $errors->get('access_code'),
                            "maxLength" => 24
                        ])
                    </div>

                    <div class="mb-1">
                        @include('partials.bladesora.members.inputs.text-input', [
                            "brand" => "drumeo",
                            "type" => "email",
                            "inputId" => "emailNew",
                            "inputName" => "email",
                            "inputLabel" => "Email Address...",
                            "inputValue" => old('email'),
                            "inputErrors" => $errors->get('email'),
                        ])
                    </div>

                    <div class="mb-1">
                        @include('partials.bladesora.members.inputs.text-input', [
                            "brand" => "drumeo",
                            "type" => "password",
                            "inputId" => "passwordNew",
                            "inputName" => "password",
                            "inputLabel" => "Password...",
                            "inputValue" => "",
                            "inputErrors" => $errors->get('password'),
                        ])
                    </div>

                    <div class="mb-1">
                        @include('partials.bladesora.members.inputs.text-input', [
                            "brand" => "drumeo",
                            "type" => "password",
                            "inputId" => "confirmPasswordNew",
                            "inputName" => "password_confirmation",
                            "inputLabel" => "Confirm Password...",
                            "inputValue" => "",
                            "inputErrors" => $errors->get('password_confirmation'),
                        ])
                    </div>

                    <input type="submit" value="Click To Redeem" class="join blue">
                </form>
            </div>
        </div>

        <div id="existingAccountForm" class="redemption-form {{ old('credentials_type') == 'existing' ? '' : 'hide' }}">
                    <div>
                        <p class="mb-1">
                            Fill out the form below to add 30 days to your Drumeo Membership.
                        </p>

                        <form action="{{ get_musora_brand_base_url() }}/ecommerce/access-codes/redeem" method="POST" novalidate>
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="credentials_type" value="existing">
                            <input type="hidden" name="redirect" value="{{ $redirectUrl ?? '/drumeo' }}">

                            <div class="mb-1">
                                @include('partials.bladesora.members.inputs.text-input', [
                                    "brand" => "drumeo",
                                    "type" => "text",
                                    "inputId" => "accessCodeExisting",
                                    "inputName" => "access_code",
                                    "inputLabel" => "Access Code...",
                                    "inputValue" => old('access_code'),
                                    "inputErrors" => $errors->get('access_code'),
                                    "maxLength" => 24
                                ])
                            </div>

                            @if(!auth()->check())

                                <div class="mb-1">
                                    @include('partials.bladesora.members.inputs.text-input', [
                                        "brand" => "drumeo",
                                        "type" => "email",
                                        "inputId" => "emailExisting",
                                        "inputName" => "user_email",
                                        "inputLabel" => "Email Address...",
                                        "inputValue" => old('user_email'),
                                        "inputErrors" => $errors->get('user_email'),
                                    ])
                                </div>

                                <div class="mb-1">
                                    @include('partials.bladesora.members.inputs.text-input', [
                                        "brand" => "drumeo",
                                        "type" => "password",
                                        "inputId" => "passwordExisting",
                                        "inputName" => "user_password",
                                        "inputLabel" => "Password...",
                                        "inputValue" => '',
                                        "inputErrors" => $errors->get('user_password'),
                                    ])
                                </div>

                            @endif

                                <input type="submit" value="Click To Redeem" class="join blue">
                        </form>
                    </div>
                </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var changeFormButtons = document.querySelectorAll('.change-form');
            var redemptionForms = document.querySelectorAll('.redemption-form');

            Array.from(changeFormButtons).forEach(button => {
                button.addEventListener('click', toggleForms);
            });

            function toggleForms(event) {
                var thisButton = event.target;
                var formToToggleTo = document.getElementById(thisButton.dataset['form']);

                Array.from(redemptionForms).forEach(form => {
                    form.classList.add('hidden');
                });

                Array.from(changeFormButtons).forEach(button => {
                    button.classList.remove('active');
                });

                thisButton.classList.add('active');
                formToToggleTo.classList.remove('hidden');
            }
        });
    </script>
@stop
