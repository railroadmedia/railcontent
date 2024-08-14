@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Win a Yamaha Stage Custom Drum Set | Drumeo</title>
    <meta property="og:title" content="Win a Yamaha Stage Custom Drum Set | Drumeo">

    <meta name="description" content="Want a free drum set? Simply enter your email address before August 15th to secure your chance to win.">
    <meta property="og:description" content="Want a free drum set? Simply enter your email address before August 15th to secure your chance to win.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/lead-gen/giveaway/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <header class="px-4 py-7 sm:py-9 lg:py-12 bg-no-repeat text-white bg-cover bg-center overflow-hidden" style="background:linear-gradient(to right, #022444 50%, #000);">
        <div class="container mx-auto max-w-5xl">
            <div class="flex flex-wrap items-center">
                <img class="mx-auto h-24 sm:hidden lazyload" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/giveaway/drumeo-giveaway-logo.png" alt="logo">
                <div class="flex inline-block sm:hidden my-4 text-sm text-center">
                    <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> No purchase necessary.</p>
                    <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> No age restrictions.</p>
                    <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> No location restrictions.</p>
                </div>
                <div class="w-full sm:w-5/12 sm:order-1 flex mb-5 sm:mb-0">
                    <img class="mx-0 sm:max-w-lg lg:max-w-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/giveaway/header-drum-kit.png">
                </div>
                <div class="w-full sm:w-7/12 mx-auto sm:px-5 lg:pl-0 text-center sm:text-left px-4 sm:px-0">
                    <img class="hidden sm:inline-block h-28 lg:h-32 mb-3 lazyload" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/giveaway/drumeo-giveaway-logo.png" alt="logo">
                    <p class="mb-4">
                        Always wanted to play drums? Ready for a kit upgrade?
                        <br><br>
                        We’re giving away a fully-loaded Yamaha Stage Custom drum kit (with cymbals & hardware). And all you have to enter is take a week of free drum lessons.
                        <br><br>
                        Simply start a FREE 7-day trial of Drumeo between <span class="text-white font-extrabold">August 6-15</span> and you’ll be automatically entered to win.
                    </p>

                    <p class="hidden sm:inline-block mb-3 text-sm">
                        <i class="fas fa-check text-drumeo"></i> No purchase necessary<br class="lg:hidden">
                        <i class="lg:ml-2 fas fa-check text-drumeo"></i> Cancel anytime<br class="lg:hidden">
                        <i class="lg:ml-2 fas fa-check text-drumeo"></i> Worldwide entry</p>
                    @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 8, 6, 0, 0, 0, 'America/Vancouver'))
                        <span class="join sold-out smaller w-full">Opens Aug 6th</span>
                    @elseif(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 8, 16, 0, 0, 0, 'America/Vancouver'))
                        <a class="join smaller w-full" href="/choose-plan">Enter to win »</a>
                    @else
                        <span class="join sold-out smaller w-full">this offer has now ended</span>
                    @endif
{{--                    @include("drumeo.lead-gen.partials.sign-up-form", [--}}
{{--                        "recaptchaKey" => $recaptchaKey,--}}
{{--                        "formId" => "Drumeo - Engagement - Trigger - Drumeo Drumset Giveaway - Web Form",--}}
{{--                        "formName" => 'Drumeo Drumset Giveaway',--}}
{{--                        "nameInput" => true,--}}
{{--                        "stacked" => true,--}}
{{--                        "buttonText" => "I WANT TO WIN!",--}}
{{--                    ])--}}
                </div>
            </div>
        </div>
    </header>

    <section class="px-4 md:px-6 py-12 md:py-20">
        <div class="max-w-md md:max-w-4xl mx-auto">
            <div class="md:flex md:flex-wrap md:items-center">
                <div class="w-full mb-4 sm:mb-8 text-center">
                    <h3 class="font-extrabold leading-normal" style="color:#2A2F34;">
                        5-Piece Drum Kit with Hardware and Cymbals
                    </h3>
                </div>
                <div class="w-full sm:w-5/12 mb-5 sm:mb-0">
                    <p>
                        This kit has you covered.
                        <br><br>
                        From beginner to advanced, the Yamaha Stage Custom has been the go-to drum set for everything from learning your first beats to embarking on your first tour.
                        <br><br>
                        Made from 100% birch wood, these drums offer short decay, quick attack and a versatile sound that suits any genre. You’ll be ready to start jamming along with your favorite songs – and taking your drumming to the next level.
                        <br><br>
                        This kit retails for $799 USD–
                        <br><br>
                        <strong>But you’ll have a chance to win it FREE.</strong>
                    </p>
                </div>
                <div class="w-full sm:w-7/12 justify-center sm:pl-8">
                    <img class="hidden sm:inline-block lazyload" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/giveaway/gallery.png" alt="gallery feature">
                    <img class="sm:hidden inline-block lazyload" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/marketing/drumeo/lead-gen/giveaway/gallery-m.png" alt="gallery feature">

                </div>
            </div>
            <div class="py-5 sm:py-8 px-4 sm:px-10 rounded-xl mt-6 sm:mt-10 max-w-2xl mx-auto" style="background-color:#f6f8fc;">
                <p class="leading-tight text-drumeo tracking-widest mb-3">THE SPECS</p>
                <p><strong>Yamaha Stage Custom Birch Drums:</strong></p>
                <div class="flex flex-wrap sm:flex-nowrap justify-between">
                    <p class="mx-0 w-1/2 sm:w-auto"><strong>Bass Drum:</strong><br> 22x17</p>
                    <p class="mx-0 w-1/2 sm:w-auto"><strong>Snare Drum:</strong><br> 14x5.5</p>
                    <p class="mx-0 w-1/2 sm:w-auto"><strong>Tom 1:</strong><br> 10x7</p>
                    <p class="mx-0 w-1/2 sm:w-auto"><strong>Tom 2:</strong><br> 12x8</p>
                    <p class="mx-0 w-1/2 sm:w-auto"><strong>Tom 3:</strong><br> 14x15</p>
                </div>
                <hr class="my-8">
                <p><strong>Yamaha Hardware Package:</strong></p>
                <div class="flex flex-wrap sm:flex-nowrap justify-between">
                    <p class="mx-0 w-full sm:w-auto"><i class="fas fa-check text-drumeo mr-2"></i> Hi-Hat</p>
                    <p class="mx-0 w-full sm:w-auto"><i class="fas fa-check text-drumeo mr-2"></i> 2 Cymbal Stands</p>
                    <p class="mx-0 w-full sm:w-auto"><i class="fas fa-check text-drumeo mr-2"></i> Kick Pedal</p>
                    <p class="mx-0 w-full sm:w-auto"><i class="fas fa-check text-drumeo mr-2"></i> Drum Throne</p>
                </div>
                <hr class="my-8">
                <p><strong>Sabian B8 Performance Cymbals:</strong></p>
                <div class="flex flex-wrap sm:flex-nowrap justify-between">
                    <p class="mx-0 w-full sm:w-auto"><i class="fas fa-check text-drumeo mr-2"></i> 14” Hi-Hats</p>
                    <p class="mx-0 w-full sm:w-auto"><i class="fas fa-check text-drumeo mr-2"></i> 16” Crash</p>
                    <p class="mx-0 w-full sm:w-auto"><i class="fas fa-check text-drumeo mr-2"></i> 20” Ride</p>
                </div>
                <hr class="my-8">
                <p class="text-drumeo"><em>*Drum color and configuration subject to availability in the winner’s region.</em></p>
            </div>
        </div>
    </section>

    <section class="text-center py-20 px-4 md:px-6" style="background:#f6f8fc;">
        <div class="max-w-4xl container mx-auto">
            <h4 class="font-extrabold leading-tight mb-5" style="color:#2A2F34;">
                You’ve won a drum set. <br>
                Now learn how to play it…
            </h4>
            <div class="max-w-md md:max-w-4xl mx-auto sm:flex md:items-center text-center md:text-left">
                <div class="mb-6 md:mb-0 flex-shrink-0">
                    <img class="lazyload h-80 lg:h-96" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/lead-gen/giveaway/mobile-membership.png" alt="ui image">
                </div>
                <div class="md:w-2/3 flex-grow sm:pl-6">
                    <p class="leading-normal">
                        A drum set isn't just a piece of furniture, you know.
                        <br><br>
                        It's made for playing, creating, and connecting with music on another level. That's why, along with grabbing a free drum set, you'll also score a WHOLE YEAR of drumming lessons from Drumeo.
                        <br><br>
                        You’ll have step-by-step lessons to help you go from a beginner to playing anything you want.
                        <br><br>
                        And even if you don’t land the big prize (but you probably will, right?), you still have a chance to win unlimited drum lessons for a year.
                        <br><br>
                        We’re giving away 5 annual Drumeo Memberships as runner-up prizes. Good luck!
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- diagonal line --}}
    <div class="relative h-5 sm:h-10 -mb-5 sm:-mb-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #f6f8fc calc(50% + 1px));"></div>
    <section class="pb-20 px-5 md:px-6 text-white" style="background: linear-gradient(to bottom, #0b76da, #185691);">
        <div class="max-w-md md:max-w-3xl mx-auto text-center">
            <svg class="inline-block h-28 relative z-10 mb-12" xmlns="http://www.w3.org/2000/svg" width="200" height="200"
                viewBox="0 0 200 200" fill="none">
                <path
                    d="M54.9137 8.23992C60.1889 2.96403 67.3396 0 74.803 0H125.21C132.673 0 139.824 2.96403 145.099 8.23992L191.755 54.9149C197.03 60.19 200 67.3407 200 74.804V125.211C200 132.674 197.03 139.825 191.755 145.1L145.099 191.755C139.824 197.03 132.673 200 125.21 200H74.803C67.3396 200 60.1889 197.03 54.9137 191.755L8.23838 145.1C2.96401 139.825 0 132.674 0 125.211V74.804C0 67.3407 2.96401 60.19 8.23838 54.9149L54.9137 8.23992ZM90.6285 59.0178V102.782C90.6285 108.33 94.8095 112.16 100.007 112.16C105.204 112.16 109.385 108.33 109.385 102.782V59.0178C109.385 54.1725 105.204 49.6398 100.007 49.6398C94.8095 49.6398 90.6285 54.1725 90.6285 59.0178ZM100.007 124.664C93.0902 124.664 87.5025 130.603 87.5025 137.168C87.5025 144.435 93.0902 149.672 100.007 149.672C106.923 149.672 112.511 144.435 112.511 137.168C112.511 130.603 106.923 124.664 100.007 124.664Z"
                    fill="#FFAE00"/>
            </svg>
            <h3 class="font-extrabold leading-normal">
                We don’t believe in fine print, so here’s <br class="hidden sm:inline">everything you need to know:
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-center text-left my-8 md:my-12">
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    <p class="mx-0"><strong>No purchase necessary</strong> <br class="hidden sm:inline">
                    and there are no age restrictions.</p>
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    <p class="mx-0"><strong>No location restrictions.</strong><br class="hidden sm:inline">
                    We’ll ship it anywhere in the world.</p>
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    <p class="mx-0"><strong>No sneaky shipping fees.</strong><br class="hidden sm:inline">
                    We’ll take care of it. (VAT may apply)</p>
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    <p class="mx-0"><strong>One email entry per person.</strong></p>
                </div>
            </div>
            <div class="inline-block italic bg-musora rounded-xl text-black py-4 px-6">
                <h6><strong><em>The winner will be announced during a LIVE event on August 17th!</em></strong></h6>
            </div>
        </div>
    </section>

    <section class="text-center px-6 sm:px-6 py-8 md:py-10 lg:py-12">
        <div class="container mx-auto max-w-3xl">
            <h3 class="mb-5 sm:mb-7"><strong>Why do I need to<br class="inline sm:hidden"> start a trial?</strong></h3>
            <p>We’re on a mission to help people start and STAY playing the drums.
                <br><br>
                And we want the winner of this drum set to be someone who’s serious about using the kit. By starting a trial, you’re showing us that you’re actively looking to learn and improve on the drums.
                <br><br>
                On top of that, we want to show you the awesome lessons we have inside Drumeo. We work super hard to create the BEST online lessons experience, including step-by-step tutorials, play-along workouts, and songs. Starting a free trial lets you see everything we have to offer.
                <br><br>
                And hey, if you like it, we hope you’ll stick around.
            </p>
        </div>
    </section>

    <section class="text-center text-white py-8 md:py-16 lg:py-28 px-5 md:px-7 bg-center bg-cover lazyload" data-bg="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/lead-gen/giveaway/order-bg.jpg">
        <div class="mx-auto max-w-md md:max-w-2xl">
            <img class="h-32 sm:h-36 md:h-44 lg:h-48 mb-5 sm:mb-12 lazyload" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/650x0/filters:quality(95)/marketing/drumeo/lead-gen/giveaway/drumeo-giveaway-logo.png" alt="title image">
            @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 8, 6, 0, 0, 0, 'America/Vancouver'))
                <span class="join sold-out smaller w-full">Opens Aug 6th</span>
            @elseif(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 8, 16, 0, 0, 0, 'America/Vancouver'))
                <a class="join smaller w-full" href="/choose-plan">Enter to win »</a>
            @else
                <span class="join sold-out smaller w-full">this offer has now ended</span>
            @endif
{{--            @include("drumeo.lead-gen.partials.sign-up-form", [--}}
{{--                "recaptchaKey" => $recaptchaKey,--}}
{{--                "formId" => "Drumeo - Engagement - Trigger - Drumeo Drumset Giveaway - Web Form2",--}}
{{--                "formName" => 'Drumeo Drumset Giveaway',--}}
{{--                "nameInput" => true,--}}
{{--                "stacked" => true,--}}
{{--                "buttonText" => "I WANT TO WIN!",--}}
{{--            ])--}}
        </div>
    </section>

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "trailer",
        "vimeoId" => "767456067",
    ])
    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

    @include('_partials.components.countdown',[
    'countdownDate' => '2023-07-10 00:00:00',
    'promoVersion' => false
    ])
@endsection

