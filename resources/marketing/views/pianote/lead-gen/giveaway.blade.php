@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Win a Roland FP-30X Digital Piano | Pianote</title>
    <meta property="og:title" content="Win a Roland FP-30X Digital Piano | Pianote">

    <meta name="description" content="Want a free piano? Simply enter your email address before September 13th to secure your chance to win.">
    <meta property="og:description" content="Want a free piano? Simply enter your email address before September 13th to secure your chance to win.">

    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/roland-share.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <style>
        header {
            background-image:url('https://www.musora.com/musora-cdn/image/width=800,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/header-m.jpg');
        }

        @media (min-width:768px) {
            header {
                background-image:url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/header.jpg');
            }
        }

    </style>
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav')

    <header class="py-8 sm:py-12 bg-no-repeat text-white bg-cover bg-center" style="background-color:#00101D;">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap">
                <div class="w-full md:w-4/12 lg:w-4/12 md:order-1 flex justify-center items-center mt-20 sm:mt-0">

                </div>
                <div class="w-full md:w-8/12 lg:w-8/12 mx-auto sm:pl-8 lg:pl-0 text-center md:text-left px-4 sm:px-0">
                    <div class="sm:px-3">
                        <img class="h-36 md:h-40 lg:h-44" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/logo.png" alt="logo">

                        <p class="mx-0 my-4" style="color:#D0E2E7; max-width: 450px;">
                            At Pianote, it’s our mission to help everyone play this beautiful instrument. Simply start a free 7-day trial of Pianote from now until <span class="text-white font-extrabold">September 12th</span> and you’ll automatically be entered to win a Roland FP-30X Digital Piano.
                        </p>

                        <p class="mt-3 mb-6 text-sm">
                            <i class="fas fa-check-circle text-pianote"></i> No purchase necessary.<br class="lg:hidden">
                            <i class="fas fa-check-circle text-pianote lg:ml-2"></i> Cancel anytime.</p>
                    </div>
                    @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 9, 6, 0, 0, 0, 'America/Vancouver'))
                        <span class="join sold-out smaller w-full">Opens September 6th</span>
                    @elseif(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 9, 13, 8, 0, 0, 'America/Vancouver'))
                        <a class="join smaller w-full" href="/choose-plan">Start your free trial »</a>
                    @else
                        <span class="join sold-out smaller w-full">this offer has now ended</span>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <section class="px-4 md:px-6 py-12 md:py-20">
        <div class="max-w-md md:max-w-4xl mx-auto">
            <div class="md:flex md:flex-wrap md:items-center mb-6 md:mb-20">
                <div class="w-full mb-4 md:mb-8 text-center">
                    <h4 class="font-extrabold leading-normal" style="color:#2A2F34;">
                        Compact size. Premium Performance.
                    </h4>
                    <p><em>Go beyond the basics with this beautiful at-home digital piano. With authentic <br class="hidden lg:inline-block">
                            touch sensitivity, the FP-30X offers big performance in a little package.</em></p>

                </div>
                <div class="md:w-7/12 md:pr-7">
                    <img class="md:hidden rounded-xl mb-6" src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/intro-m.jpg" alt="intro image">
                    <p>
                        This is not your beginner piano.
                        <br><br>
                        The beautiful Roland FP-30X delivers exceptional performance and easily outshines other instruments in its class. Roland’s unrivaled sound and feel deliver an authentic piano experience for maximum expression, providing a solid foundation for proper learning and the detailed articulation and response that experienced players demand.
                        <br><br>
                        The advanced SuperNATURAL Piano engine combined with the premium touch of the Ivory Feel keys found in high-end home pianos will have you coming back to the piano again and again, always with a smile.
                        <br><br>
                        And all this performance comes wrapped in a compact case that will fit any living situation while being light enough to move easily when needed.
                        <br><br>
                        The Roland FP-30X retails for $699. But it can be yours for FREE.
                    </p>
                </div>
                <div class="w-5/12 justify-center pl-8">
                    <img class="rounded-xl hidden md:inline-block" src="https://www.musora.com/musora-cdn/image/width=450,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/intro.jpg" alt="intro image">
                </div>
            </div>

            <picture>
                <source media="(min-width:768px)" srcset="https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery-feature.jpg">
                <img class="rounded-xl mb-6" src="https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery-feature.jpg" alt="gallery feature">
            </picture>

            <img class="hidden md:inline-block rounded-xl shadow-md" src="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery.jpg" alt="gallery">

            <div class="md:hidden">
                <img class="rounded-xl shadow-md mb-4" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery-01-m.jpg" alt="gallery 1">
                <img class="rounded-xl shadow-md mb-4" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery-02-m.jpg" alt="gallery 2">
                <img class="rounded-xl shadow-md mb-4" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery-03-m.jpg" alt="gallery 3">
                <img class="rounded-xl shadow-md" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery-04-m.jpg" alt="gallery 4">
            </div>
        </div>
    </section>

    <section class="py-20 px-4 md:px-6" style="background:#FFF7F7;">
        <div class="max-w-md md:max-w-4xl mx-auto md:flex md:items-center">
            <div class="md:order-1 md:w-5/12 md:pl-12 text-center md:text-left mb-6 md:mb-0">
                <img class="h-96" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/ui.png" alt="ui image">
            </div>
            <div class="md:w-7/12 lg:pr-6">
                <h4 class="font-extrabold leading-snug mb-4" style="color:#2A2F34;">
                    You’ve won a piano. <br>
                    Now learn how to play it…
                </h4>
                <p class="leading-normal" style="color:#2A2F34;">
                    A piano is not a piece of furniture. <br><br>
                    It’s designed to be played, enjoyed, treasured, and used for life. That’s why, as well as getting a free piano, you’ll also get a FREE YEAR of piano lessons from Pianote! <br><br>
                    Step-by-step lessons from REAL teachers to guarantee your progress. Play your favorite songs, get support and feedback on your journey, and connect with the best online community of piano players around. <br><br>
                    It’s all included with your prize. <br><br>
                    But that’s not all…
                </p>
                <h4 class="font-extrabold my-4" style="color:#2A2F34;">More than one chance to win!</h4>
                <p class="leading-normal" style="color:#2A2F34;">
                    Because even if you don't win the main prize (but you probably will, right?), you might snag one of 5 annual Pianote memberships as our runner-up prizes.
                </p>
            </div>
        </div>
    </section>

    {{-- diagonal line --}}
    <div class="relative h-5 sm:h-10 -mb-5 sm:-mb-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #FFF7F7 calc(50% + 1px));"></div>
    <section class="pb-20 px-5 md:px-6" style="background: #010C15;">
        <div class="max-w-md sm:max-w-3xl mx-auto text-center">
            <img class="h-28 relative z-10 mb-12" src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/caution_icon.svg" alt="caution icon">
            <h3 class="text-white font-extrabold leading-normal">
                We don’t believe in fine print, so here’s <br class="hidden sm:inline">everything you need to know:
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-center text-left my-8 md:my-12" style="color:#D0E2E7;">
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    Start a Free 7-Day Trial of Pianote to enter.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    One entry per person.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    No purchase necessary. Cancel anytime.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    No shipping fees (VAT may apply).
                </div>
            </div>
            <div class="inline-block italic text-pianote py-4 px-6" style="background:#111F29;">
                The winner will be announced during a LIVE event on September 13th!
            </div>
        </div>
    </section>

    <section class="flex items-center text-center text-white" style="background:linear-gradient(180deg, #F61A30 0%, #590C13 100%);">
        <img class="w-2/12 hidden md:inline" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/piano_qa.png" alt="piano icon" />
        <div class="container mx-auto max-w-3xl px-6 sm:px-4 py-8 md:py-10 lg:py-12">
            <h3 class="mb-5 sm:mb-7"><strong>Why do I need to give<br class="inline sm:hidden"> my email address?</strong></h3>
            <p>
                We want the winner to be someone who really wants and will use this free piano. After all, that’s what it’s for. So getting an email address lets us know you’re a real person! <br><br>
                On top of that, we want to start a relationship with you. It’s our way of saying, “Hey, we create awesome piano lessons, and we’d love to show you.” Don’t worry. We won’t send you spam or share your email address with anybody else. You’ll get free ongoing piano lessons and some special offers. And if you don’t like our emails, you can unsubscribe anytime.
            </p>
        </div>
        <img class="w-2/12 hidden md:inline" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/email_qa.png" alt="email icon" />
    </section>

    <section class="text-center text-white py-8 md:py-16 lg:py-28 px-5 md:px-7 bg-center bg-cover"
        style='background-image:url("https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/footer.jpg");'>
        <div class="mx-auto max-w-md md:max-w-2xl">
            <img class="h-32 sm:h-36 md:h-44 lg:h-52 mb-6" src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/logo.png" alt="title image">


            @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 9, 6, 0, 0, 0, 'America/Vancouver'))
                <span class="join sold-out smaller w-full">Opens September 6th</span>
            @elseif(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 9, 13, 8, 0, 0, 'America/Vancouver'))
                <a class="join smaller w-full" href="/choose-plan">Start your free trial »</a>
            @else
                <span class="join sold-out smaller w-full">this offer has now ended</span>
            @endif
        </div>
    </section>

    @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@endsection

