@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Win a Casio Privia PX-S1100 | Pianote</title>
    <meta property="og:title" content="Win a Casio Privia PX-S1100 | Pianote">

    <meta name="description" content="Want a free piano? Simply enter your email address to secure your chance to win.">
    <meta property="og:description" content="Want a free piano? Simply enter your email address to secure your chance to win.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/logo.png" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <style>
        header {
            background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/header-bg-m.jpg');
        }

        @media (min-width:768px) {
            header {
                background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/header-bg.jpg');
            }
        }

    </style>
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav')

    <header class="px-5 sm:px-6 py-8 sm:py-12 bg-no-repeat text-white bg-cover bg-center" style="background-color:#00101D;">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap sm:flex-nowrap">
                <div class="mx-auto text-center lg:text-left px-4 sm:px-0">
                    <div class="sm:px-3">
                        <img class="h-28 lg:h-32" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/470x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/logo.png" alt="logo">
                        <img class="h-52 sm:hidden mt-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/510x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/header-image.png" alt="title image">
                        <p class="mx-0 my-4" style="max-width: 450px;">
                            At Pianote, it’s our mission to help everyone play this beautiful instrument. So we’re giving away a Casio Privia Digital Piano!
                            <br><br>
                            Simply enter your name and email address before October 14th and you’ll be entered to win.
                        </p>
                        <p class="mt-3 mb-6 text-sm">
                            <i class="fas fa-check-circle text-pianote"></i> No purchase necessary.<br class="lg:hidden">
                            <i class="fas fa-check-circle text-pianote lg:ml-2"></i> One entry per person.</p>

                    </div>
{{--                    @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 4, 0, 0, 0, 'America/Vancouver'))--}}
{{--                        <span class="join sold-out smaller w-full">Opens Oct. 4th</span>--}}
                    @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 14, 8, 0, 0, 'America/Vancouver'))
                        @include('pianote._partials.sign-up-form', [
                        "recaptchaKey" => $recaptchaKey,
                        "stacked" => true,
                        "nameInput" => true,
                        "formId" => "Pianote - Engagement - Trigger - Casio Privia Giveaway - Web Form",
                        "formName" => 'Casio Privia Giveaway',
                        "buttonText" => "I WANT TO WIN!",
                        ])
                    @else
                        <span class="join sold-out smaller w-full">this offer has now ended</span>
                    @endif
                </div>
                <div class="hidden sm:block flex-shrink-0">
                    <img class="h-72 lg:h-80" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/780x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/header-image.png" alt="title image">
                </div>
            </div>
        </div>
    </header>

    <section class="px-4 md:px-6 py-12 md:py-20">
        <div class="max-w-md md:max-w-4xl mx-auto">
            <div class="md:flex md:flex-wrap">
                <div class="w-full mb-4 md:mb-8 text-center">
                    <h2 class="font-extrabold leading-normal mb-2" style="color:#2A2F34;">
                        Good Things Come in Red Packages
                    </h2>
                    <h6 class="leading-tight"><strong><em>
                                A stunning piano sound, expressive touch, and powerful<br class="hidden sm:inline">
                                speakers make this the perfect home piano.</em></strong></h6>

                </div>
                <div class="md:w-7/12 md:pr-7">
                    <img class="lazyload md:hidden rounded-xl mb-6" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/collage-m.png" alt="intro image">
                    <p>
                        <strong>Picture it…</strong>
                        <br><br>
                        You sit down to play your new Casio digital piano and as you touch the keys, your fingers feel the weighted hammer action that has been designed to mirror a grand piano. Action like this means you can play expressively and dynamically.
                        <br><br>
                        But it’s the sound that takes your breath away.
                        <br><br>
                        Casio has painstakingly modeled the piano sound from a German concert grand piano. You’ll even hear the dampers lifting from the strings as you press the sustain pedal.
                        <br><br>
                        And that sound will fill your space thanks to powerful speakers that feature a strengthened diaphragm for cleaner high-end and an improved inner structure to handle the deep, rich bass notes.
                        <br><br>
                        This piano features Bluetooth MIDI connectivity and is lightweight and portable so you can take it wherever the music takes you.
                        <br><br>
                        The Casio Privia PX-S1100 retails for $699.99 USD. But it can be yours for <strong>FREE</strong>.
                        <br><br>
                        <em class="opacity-60">* Stand not included</em>
                    </p>
                </div>
                <div class="w-5/12 justify-center pl-8">
                    <img class="rounded-xl lazyload hidden md:inline-block" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/450x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/collage.png" alt="intro image">
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-20 px-4 md:px-6" style="background:#F1EFED;">
        <div class="max-w-md md:max-w-5xl mx-auto md:flex md:items-center">
            <div class="md:pr-8 text-center md:text-left mb-6 md:mb-0 flex-shrink-0">
                <img class="lazyload h-72 lg:h-96" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/prizes2.webp" alt="ui image">
            </div>
            <div class="lg:pl-6">
                <h4 class="font-extrabold leading-snug mb-4" style="color:#2A2F34;">
                    More Prizes.<br>
                    More Chances to Win…
                </h4>
                <p class="leading-normal" style="color:#2A2F34;">
                    We’re also giving away <strong>3 Annual Pianote Memberships</strong>.
                    <br><br>
                    Dive in and explore unlimited piano lessons, weekly live streams, exclusive resources, and personalized feedback from real teachers.
                    <br><br>
                    Sign up today and get everything you need to start your piano journey!
                </p>
            </div>
        </div>
    </section>

    {{-- diagonal line --}}
    <div class="relative h-5 sm:h-10 -mb-5 sm:-mb-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #F1EFED calc(50% + 1px));"></div>
    <section class="pb-20 px-5 md:px-6" style="background:linear-gradient(180deg, #F61A30 0%, #590C13 100%);">
        <div class="max-w-md md:max-w-3xl mx-auto text-center">
            <svg class="inline-block h-28 relative z-10 mb-5 sm:mb-12" xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150" fill="none">
                <path d="M41.1853 6.17994C45.1417 2.22302 50.5047 0 56.1023 0H93.9075C99.5051 0 104.868 2.22302 108.824 6.17994L143.816 41.1862C147.773 45.1425 150 50.5055 150 56.103V93.908C150 99.5055 147.773 104.868 143.816 108.825L108.824 143.816C104.868 147.773 99.5051 150 93.9075 150H56.1023C50.5047 150 45.1417 147.773 41.1853 143.816L6.17879 108.825C2.22301 104.868 0 99.5055 0 93.908V56.103C0 50.5055 2.22301 45.1425 6.17879 41.1862L41.1853 6.17994ZM67.9714 44.2633V77.0862C67.9714 81.2477 71.1071 84.1197 75.0049 84.1197C78.9026 84.1197 82.0384 81.2477 82.0384 77.0862V44.2633C82.0384 40.6294 78.9026 37.2298 75.0049 37.2298C71.1071 37.2298 67.9714 40.6294 67.9714 44.2633ZM75.0049 93.4977C69.8177 93.4977 65.6268 97.9522 65.6268 102.876C65.6268 108.327 69.8177 112.254 75.0049 112.254C80.1921 112.254 84.383 108.327 84.383 102.876C84.383 97.9522 80.1921 93.4977 75.0049 93.4977Z" fill="#FFAE00"/>
            </svg>
            <h3 class="text-white font-extrabold leading-normal">
                We don’t believe in fine print, so here’s <br class="hidden sm:inline">everything you need to know:
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-center text-left my-8 md:my-12 text-white">
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    Enter your name and email address.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    One entry per person.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    No purchase necessary.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    No age restrictions.
                </div>
            </div>
            <div class="inline-block italic text-black py-4 px-6 bg-musora">
                The winner will be announced on our socials on <strong>October 14th</strong>!
            </div>
        </div>
    </section>

    <section class="flex items-center text-center px-6 sm:px-6 pt-8 sm:pt-12 pb-20 md:pb-24">
        <div class="container mx-auto max-w-3xl">
            <h3 class="mb-5 sm:mb-7"><strong>Why do I need to give my email address?</strong></h3>
            <p>
                We want the winner to be someone who really wants and will use this free piano. After all, that’s what it’s for. So getting your name and email address lets us know you’re a real person!
                <br><br>
                On top of that, we want to start a relationship with you. It’s our way of saying, “Hey, we create awesome piano lessons, and we’d love to show you.” Don’t worry. We won’t send you spam or share your email address with anybody else. You’ll get free ongoing piano lessons and some special offers. And if you don’t like our emails, you can unsubscribe anytime.
            </p>
        </div>
    </section>

    <section class="text-center pb-8 md:pb-12 lg:pb-14 px-5 md:px-7" style="background-color:#F1EFED;">
        <div class="mx-auto max-w-md md:max-w-3xl">
            <div class="flex flex-wrap sm:flex-nowrap">
                <div class="w-full sm:w-auto sm:order-1 flex-shrink-0">
                    <img class="h-64 sm:h-80 lg:h-96 -mt-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/order-image.png" alt="title image">
                </div>
                <div class="mx-auto text-center lg:text-left px-4 sm:px-0 pt-4 md:pt-10">
                    <div class="sm:px-3">
                        <img class="h-28 lg:h-32" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/470x0/filters:quality(95)/marketing/pianote/lead-gen/giveaway/logo.png" alt="logo">
                        <h4 class="font-black mx-0 my-4" style="max-width: 450px;">
                            Win a Casio Privia<br class="hidden sm:inline">
                            PX-S1100 Digital Piano
                        </h4>
                    </div>

{{--                    @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 4, 0, 0, 0, 'America/Vancouver'))--}}
{{--                        <span class="join sold-out smaller w-full">Opens Oct. 4th</span>--}}
                    @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 14, 8, 0, 0, 'America/Vancouver'))
                        @include('pianote._partials.sign-up-form', [
                        "recaptchaKey" => $recaptchaKey,
                        "stacked" => true,
                        "nameInput" => true,
                        "formId" => "Pianote - Engagement - Trigger - Casio Privia Giveaway - Web Form2",
                        "formName" => 'Casio Privia Giveaway',
                        "buttonText" => "I WANT TO WIN!",
                        ])
                    @else
                        <span class="join sold-out smaller w-full">this offer has now ended</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@endsection

