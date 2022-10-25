@extends('drumeo._partials.layout-template')

@section('global-head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>Sonor Drummers Free Trial</title>
    <meta name="description" content="You’re eligible for a free 30-day membership to Drumeo (normally $29).">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/promos/sonor-trial/header-background.jpg" style="display: none;">
    <meta property="og:title" content="Sonor Drummers Free Trial">
    <meta property="og:description" content="You’re eligible for a free 30-day membership to Drumeo (normally $29).">
    <meta property="og:url" content="https://www.drumeo.com/sonor/">

    @include('_partials.layout.favicons.drumeo-favicons')
    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-sonor.css') }}" rel="stylesheet">

@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "edgeVersion" => true
    ])
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

    <header class="sonor-header content-section text-center" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/promos/sonor-trial/header-background.jpg);">
        <div class="container mx-auto">
            <img class="logo edge" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
            <img class="logo sonor" src="https://dpwjbsxqtam5n.cloudfront.net/promos/sonor-trial/sonor-logo-white.png">
            <br>
            <h1><strong>The Ultimate Online <br class="inline lg:hidden"> Drum Lessons Experience<sup>&trade;</sup></strong></h1>
            <i class="fas fa-play play-button autoplay-video" data-open="trailer"></i>
            <br>
            <h4 class="px-2 md:px-3"><strong>Sonor Drummers:</strong> You’re eligible for a free 30-day membership to Drumeo (normally $29).<br class="hidden lg:inline">
                Simply use the special access code you received on your flyer to activate your online drum lessons.</h4>
            <a data-open="redeem" class="join blue">REDEEM YOUR FREE LESSONS &raquo;</a>
        </div>
    </header>

    <div class="reveal large trailer text-center" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/381368019?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>

    <section class="learn-play-watch text-center">
        <div class="container mx-auto">
            <div class="topic-wrap learn">
                <h1>Learn</h1>
                <h2>Improve your drumming with<br class="inline lg:hidden">
                    the best teachers in the world.</h2>
                <img class="hidden md:inline-block" src="https://dpwjbsxqtam5n.cloudfront.net/app/learn-spread.png">
                <img class="inline-block md:hidden" src="https://dpwjbsxqtam5n.cloudfront.net/app/learn-spread-mobile.png">
                <br>
                <div class="clearfix">
                    <div class="float-left px-2 md:px-3 w-full md:w-1/3">
                        <p><strong>Learn anything<br class="hidden md:inline-block lg:hidden"> on the drums.</strong><br>
                            Get unlimited access to 2000+ hours of video drum lessons covering every topic, for every level, and every style of music. </p>
                    </div>
                    <div class="float-left px-2 md:px-3 w-full md:w-1/3">
                        <p><strong>World-class teaching,<br class="hidden md:inline-block lg:hidden"> every time.</strong><br>
                            Study with 100+ world-class drummers including Grammy Award winners, touring clinicians, published authors, and more.</p>
                    </div>
                    <div class="float-left px-2 md:px-3 w-full md:w-1/3">
                        <p style="margin-bottom: 0;"><strong>More efficient<br class="hidden md:inline-block lg:hidden"> practice sessions.</strong><br>
                            Gain clarity with organized courses and helpful progress-tracking tools, so you always know where you left off and what to learn next. </p>
                    </div>
                </div>
            </div>
            <div class="topic-wrap play">
                <h1>Play</h1>
                <h2>Learn your favorite songs,<br class="inline md:hidden">  wherever you are.</h2>
                <img class="hidden md:inline-block" src="https://dpwjbsxqtam5n.cloudfront.net/app/play-spread.png">
                <img class="inline-block md:hidden" src="https://dpwjbsxqtam5n.cloudfront.net/app/play-spread-mobile.png">
                <p>Nothing is better than playing to real music. So you’ll love our play-alongs for applying your new<br class="hidden md:inline">
                    skills to music - and detailed song breakdowns for music by popular bands of all eras and styles. </p>
            </div>
            <div class="topic-wrap watch">
                <h1>Watch</h1>
                <h2>Drumming isn’t limited <br class="inline md:hidden">to the practice room.</h2>
                <img src="https://dpwjbsxqtam5n.cloudfront.net/app/watch-spread-2.png">
                <p>Enjoy entertaining shows and documentaries from the most talented content creators in the <br class="hidden md:inline">
                    drum space -- including Carson Gant’s “Exploring Beats”, Aaron Edgar’s “Rhythms From Another <br class="hidden md:inline">
                    Planet”, and exclusive episodes of Austin Burcham’s “Study The Greats”. </p>
            </div>
        </div>
    </section>

    <section class="sonor-footer content-section text-center">
        <div class="container mx-auto">
            <img class="logo edge" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
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

                <form action="{{ url()->route('access-codes.form-claim') }}" method="POST" novalidate>
                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    <input type="hidden" name="credentials_type" value="new">
                    <input type="hidden" name="redirect" value="/members">

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

                        <form action="{{ url()->route('access-codes.form-claim') }}" method="POST" novalidate>
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="credentials_type" value="existing">
                            <input type="hidden" name="redirect" value="/members">

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


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('input[value!=""]').addClass('has-input');

            $('input').blur(function() {
                if($(this).val()) {
                    $(this).addClass('has-input');
                }
                else {
                    $(this).removeClass('has-input');
                }
            });
        });

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
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
