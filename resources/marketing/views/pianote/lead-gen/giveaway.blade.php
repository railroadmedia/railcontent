@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Win a Roland FP-30X Digital Piano | Pianote</title>
    <meta property="og:title" content="Win a Roland FP-30X Digital Piano | Pianote">

    <meta name="description" content="Want a free piano? Simply enter your email address before November 21st to secure your chance to win.">
    <meta property="og:description" content="Want a free piano? Simply enter your email address before November 21st to secure your chance to win.">

    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://pianote.s3.amazonaws.com/giveaways/roland-share.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/giveaway">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <style>
        header {
            background-image:url('https://www.musora.com/musora-cdn/image/width=800,quality=85/https://pianote.s3.amazonaws.com/giveaways/header-m.jpg');
            background-size: cover;
            background-position: center;
        }

        @media (min-width:768px) {
            header {
                background-image:url('https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://pianote.s3.amazonaws.com/giveaways/header.jpg');
                background-size: cover;
                background-position: center;
            }
        }

        @media (min-width:1024px) {
            header {
                background-size: 1700px;
            }
        }

    </style>
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav')

    <header class="py-12 sm:py-20 bg-no-repeat" style="background-color:#00101D;">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap">
                <div class="w-full md:w-4/12 lg:w-5/12 md:order-1 flex justify-center items-center">
                    <i class="fas fa-play play-button autoplay-video my-20 md:mt-0" data-open="trailer"></i>
                </div>
                <div class="w-full md:w-8/12 lg:w-7/12 mx-auto sm:pl-8 md:pl-14 lg:pl-0 text-center md:text-left px-4 sm:px-0">
                    <img class="h-36 md:h-40 lg:h-44 mb-2 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://pianote.s3.amazonaws.com/giveaways/logo.png" alt="logo">
                    <div class="md:max-w-md">
                        <p class="mb-4" style="color:#D0E2E7;">
                            Want a free piano? Simply enter your email address before <span class="text-white font-extrabold">November 21st</span> to secure your chance to win. No purchase necessary. No age restrictions. No location restrictions.
                        </p>
{{--                        @include('pianote._partials._sign-up-form', [--}}
{{--                            "formId" => 'Pianote - Engagement - Trigger - FP30 Giveaway - Web Form',--}}
{{--                            "formName" => 'FP30 Giveaway',--}}
{{--                            'buttonText' => 'I WANT TO WIN!',--}}
{{--                            'stacked' => true,--}}
{{--                            'disclaimerColor' => '#B3B3B9'--}}
{{--                        ])--}}
                    </div>
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
                    <img class="lazyload md:hidden rounded-xl mb-6" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://pianote.s3.amazonaws.com/giveaways/november/intro-m.jpg" alt="intro image">
                    <p>
                        This is not your beginner piano.
                        <br><br>
                        The beautiful Roland FP-30X delivers exceptional performance and easily outshines other instruments in its class. Roland’s unrivaled sound and feel deliver an authentic piano experience for maximum expression, providing a solid foundation for proper learning and the detailed articulation and response that experienced players demand.
                        <br><br>
                        The advanced SuperNATURAL Piano engine combined with the premium touch of the Ivory Feel keys found in high-end home pianos will have you coming back to the piano again and again, always with a smile.
                        <br><br>
                        And all this performance comes wrapped in a compact case that will fit any living situation while being light enough to move easily when needed.
                        <br><br>
                        The Roland FP-30X retails for $899.99. But it can be yours for FREE.
                    </p>
                </div>
                <div class="w-5/12 justify-center pl-8">
                    <img class="rounded-xl lazyload hidden md:inline-block" data-src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://pianote.s3.amazonaws.com/giveaways/november/intro.jpg" alt="intro image">
                </div>
            </div>

            <picture>
                <source media="(min-width:768px)" srcset="https://pianote.s3.amazonaws.com/giveaways/november/gallery-feature.jpg">
                <img class="rounded-xl mb-6 lazyload" data-src="https://pianote.s3.amazonaws.com/giveaways/november/gallery-feature.jpg" alt="gallery feature">
            </picture>

            <img class="hidden md:inline-block rounded-xl mb-10 shadow-md lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1000,quality=85/https://pianote.s3.amazonaws.com/giveaways/november/gallery.jpg" alt="gallery">

            <div class="md:hidden">
                <img class="rounded-xl shadow-md mb-4" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://pianote.s3.amazonaws.com/giveaways/november/gallery-01-m.jpg" alt="gallery 1">
                <img class="rounded-xl shadow-md mb-4" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://pianote.s3.amazonaws.com/giveaways/november/gallery-02-m.jpg" alt="gallery 2">
                <img class="rounded-xl shadow-md mb-4" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://pianote.s3.amazonaws.com/giveaways/november/gallery-03-m.jpg" alt="gallery 3">
                <img class="rounded-xl shadow-md mb-8" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://pianote.s3.amazonaws.com/giveaways/november/gallery-04-m.jpg" alt="gallery 4">
            </div>

            <div class="rounded-xl py-6 md:py-10 shadow-md px-8" style="background: #FFF6F6;">
                <div class="justify-center mx-auto md:flex md:items-center text-center md:text-left">
                    <img class="mb-2 sm:mb-0 h-10 sm:h-14 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=85/https://pianote.s3.amazonaws.com/giveaways/roland_logo.svg">
                    <p class="w-full sm:w-auto leading-tight pl-3 sm:pl-5 m-0"><strong>This free Roland FP-30X digital piano has been<br> generously donated by our partners at Roland.</strong></p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 px-4 md:px-6" style="background:#FFF7F7;">
        <div class="max-w-md md:max-w-4xl mx-auto md:flex md:items-center">
            <div class="md:order-1 md:w-5/12 md:pl-12 text-center md:text-left mb-6 md:mb-0">
                <img class="lazyload h-96" data-src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://pianote.s3.amazonaws.com/giveaways/ui.png" alt="ui image">
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
    <section class="pb-20 px-4 md:px-6" style="background: #010C15;">
        <div class="max-w-md md:max-w-4xl mx-auto text-center">
            <img class="h-28 relative z-10 mb-12 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://pianote.s3.amazonaws.com/giveaways/caution_icon.svg" alt="caution icon">
            <h3 class="text-white font-extrabold leading-normal mb-6">
                We don’t believe in fine print, so here’s <br class="hidden sm:inline">everything you need to know:
            </h3>
            <div class="flex flex-wrap justify-center text-left mb-10 md:mb-16">
                <div class="flex w-full sm:w-1/2 px-4 md:px-6 mb-4 md:mb-6" style="color:#D0E2E7;">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    No purchase necessary and there are no age restrictions.
                </div>
                <div class="flex w-full sm:w-1/2 px-4 md:px-6 mb-4 md:mb-6" style="color:#D0E2E7;">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    No location restrictions. We’ll ship it anywhere in the world.
                </div>
                <div class="flex w-full sm:w-1/2 px-4 md:px-6 mb-4 md:mb-6" style="color:#D0E2E7;">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    No sneaky shipping fees. We’ll take care of it.
                </div>
                <div class="flex w-full sm:w-1/2 px-4 md:px-6" style="color:#D0E2E7;">
                    <i class="fas fa-check pt-1 mr-2" style="color:#D7182B"></i>
                    One email entry per person.
                </div>
            </div>
            <div class="inline-block italic text-pianote py-4 px-6" style="background:#111F29;">
                The winner will be announced during a LIVE event on November 22nd!
            </div>
        </div>
    </section>

    <section class="flex items-center text-center text-white" style="background:linear-gradient(180deg, #F61A30 0%, #590C13 100%);">
        <img class="lazyload w-2/12 hidden md:inline" data-src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://pianote.s3.amazonaws.com/giveaways/piano_qa.png" alt="piano icon" />
        <div class="container mx-auto max-w-3xl px-6 sm:px-4 py-8 md:py-10 lg:py-12">
            <h3 class="mb-5 sm:mb-7"><strong>Why do I need to give<br class="inline sm:hidden"> my email address?</strong></h3>
            <p>
                We want the winner to be someone who really wants and will use this free piano. After all, that’s what it’s for. So getting an email address lets us know you’re a real person! <br><br>
                On top of that, we want to start a relationship with you. It’s our way of saying, “Hey, we create awesome piano lessons, and we’d love to show you.” Don’t worry. We won’t send you spam or share your email address with anybody else. You’ll get free ongoing piano lessons and some special offers. And if you don’t like our emails, you can unsubscribe anytime.
            </p>
        </div>
        <img class="lazyload w-2/12 hidden md:inline" data-src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://pianote.s3.amazonaws.com/giveaways/email_qa.png" alt="email icon" />
    </section>

    <section class="text-center text-white py-8 md:py-16 lg:py-28 px-5 md:px-7 bg-center bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://pianote.s3.amazonaws.com/giveaways/footer.jpg">
        <div class="mx-auto max-w-md md:max-w-2xl">
            <img class="h-32 sm:h-36 md:h-44 lg:h-52 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=85/https://pianote.s3.amazonaws.com/giveaways/logo.png" alt="title image">
{{--            @include("pianote._partials._sign-up-form", [--}}
{{--                    "formId" => 'Pianote - Engagement - Trigger - FP30 Giveaway - Web Form',--}}
{{--                    "formName" => 'FP30 Giveaway',--}}
{{--                "buttonText" => "I WANT TO WIN!",--}}
{{--                "oneLineLg" => true,--}}
{{--                'disclaimerColor' => '#B3B3B9'--}}
{{--            ])--}}
        </div>
    </section>

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "trailer",
        "vimeoId" => "767456067",
    ])
    @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@endsection

