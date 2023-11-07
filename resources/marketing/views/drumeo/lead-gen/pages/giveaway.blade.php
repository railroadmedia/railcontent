@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Win a Roland FP-30X Digital Piano | Pianote</title>
    <meta property="og:title" content="Win a Roland FP-30X Digital Piano | Pianote">

    <meta name="description" content="Want a free piano? Simply enter your email address before November 20th to secure your chance to win.">
    <meta property="og:description" content="Want a free piano? Simply enter your email address before November 20th to secure your chance to win.">

    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/share-image2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">


    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
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
    @include("drumeo.sales.partials._nav")

    <header class="py-8 sm:py-12 bg-no-repeat text-white bg-cover bg-center" style="background-color:#00101D;">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap">
                <div class="w-full md:w-4/12 lg:w-4/12 md:order-1 flex justify-center items-center mt-20 sm:mt-0">

                </div>
                <div class="w-full md:w-8/12 lg:w-8/12 mx-auto sm:pl-8 md:pl-14 lg:pl-0 text-center md:text-left px-4 sm:px-0">
                    <img class="h-36 md:h-40 lg:h-44 mb-2 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/logo.png" alt="logo">
                    <div class="md:max-w-lg">
                        <p class="mb-4" style="color:#D0E2E7;">
                            Want a free drum set? Simply enter your email address before <span class="text-white font-extrabold">November 20th</span> to secure your chance to win.
                        </p>

                        <p class="hidden lg:inline">
                            <i class="fas fa-check text-drumeo"></i> No purchase necessary.
                            <i class="ml-2 fas fa-check text-drumeo"></i> No age restrictions.
                            <i class="ml-2 fas fa-check text-drumeo"></i> No location restrictions.</p>
                        <div class="flex inline lg:hidden">
                            <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> No purchase necessary.</p>
                            <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> No age restrictions.</p>
                            <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> No location restrictions.</p>
                        </div>
                        @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                        "formId" => "Pianote - Engagement - Trigger - FP30 Giveaway - Web Form2",
                        "formName" => 'FP30 Giveaway',
                            "stacked" => true,
                            "buttonText" => "I WANT TO WIN!",
                        ])
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
                        5-Piece Drum Kit with Hardware and Cymbals
                    </h4>
                </div>
                <div class="w-full md:w-7/12 md:pr-7">
                    <img class="lazyload md:hidden rounded-xl mb-6" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/intro-m.jpg" alt="intro image">
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
                <div class="w-full md:w-5/12 justify-center md:pl-8">
                    <picture>
                        <source media="(min-width:768px)" srcset="https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery-feature.jpg">
                        <img class="rounded-xl mb-6 lazyload" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery-feature.jpg" alt="gallery feature">
                    </picture>

                    <img class="rounded-xl shadow-md lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/november/gallery.jpg" alt="gallery">

                </div>
            </div>
        </div>
    </section>

    <section class="text-center py-20 px-4 md:px-6" style="background:#f6f8fc;">
        <div class="max-w-4xl container mx-auto">
            <h4 class="font-extrabold leading-tight mb-5" style="color:#2A2F34;">
                You’ve won a drum set. <br>
                Now learn how to play it…
            </h4>
            <div class="max-w-md md:max-w-4xl mx-auto md:flex md:items-center text-center md:text-left">
                <div class="md:w-1/3 mb-6 md:mb-0">
                    <img class="lazyload h-96" data-src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/ui.png" alt="ui image">
                </div>
                <div class="md:w-2/3 lg:pl-6">
                    <p class="leading-normal">
                        A drum set isn't just a piece of furniture, you know.
                        <br><br>
                        It's made for playing, creating, and connecting with music on another level. That's why, along with grabbing a free drum set, you'll also score a WHOLE YEAR of drumming lessons from Drumeo.
                        <br><br>
                        You’ll have step-by-step lessons to help you go from a beginner to playing anything you want. Plus, you’ll have a library of 5000+ popular songs to play along with and personalized support every step of the way.
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
    <section class="pb-20 px-5 md:px-6" style="background: linear-gradient(to bottom, #0b76da, #185691);">
        <div class="max-w-md md:max-w-3xl mx-auto text-center">
            <svg class="inline-block h-28 relative z-10 mb-12" xmlns="http://www.w3.org/2000/svg" width="200" height="200"
                viewBox="0 0 200 200" fill="none">
                <path
                    d="M54.9137 8.23992C60.1889 2.96403 67.3396 0 74.803 0H125.21C132.673 0 139.824 2.96403 145.099 8.23992L191.755 54.9149C197.03 60.19 200 67.3407 200 74.804V125.211C200 132.674 197.03 139.825 191.755 145.1L145.099 191.755C139.824 197.03 132.673 200 125.21 200H74.803C67.3396 200 60.1889 197.03 54.9137 191.755L8.23838 145.1C2.96401 139.825 0 132.674 0 125.211V74.804C0 67.3407 2.96401 60.19 8.23838 54.9149L54.9137 8.23992ZM90.6285 59.0178V102.782C90.6285 108.33 94.8095 112.16 100.007 112.16C105.204 112.16 109.385 108.33 109.385 102.782V59.0178C109.385 54.1725 105.204 49.6398 100.007 49.6398C94.8095 49.6398 90.6285 54.1725 90.6285 59.0178ZM100.007 124.664C93.0902 124.664 87.5025 130.603 87.5025 137.168C87.5025 144.435 93.0902 149.672 100.007 149.672C106.923 149.672 112.511 144.435 112.511 137.168C112.511 130.603 106.923 124.664 100.007 124.664Z"
                    fill="#FFAE00"/>
            </svg>
            <h3 class="text-white font-extrabold leading-normal">
                We don’t believe in fine print, so here’s <br class="hidden sm:inline">everything you need to know:
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-center text-left my-8 md:my-12" style="color:#D0E2E7;">
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    No purchase necessary <br class="hidden sm:inline">
                    and there are no age restrictions.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    No location restrictions.<br class="hidden sm:inline">
                    We’ll ship it anywhere in the world.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    No sneaky shipping fees.<br class="hidden sm:inline">
                    We’ll take care of it. (VAT may apply)
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    One email entry per person.
                </div>
            </div>
            <div class="inline-block italic bg-musora rounded-xl text-black py-4 px-6">
                <h6><strong><em>The winner will be announced during a LIVE event on November 20th!</em></strong></h6>
            </div>
        </div>
    </section>

    <section class="text-center px-6 sm:px-4 py-8 md:py-10 lg:py-12">
        <div class="container mx-auto max-w-3xl">
            <h3 class="mb-5 sm:mb-7"><strong>Why do I need to give<br class="inline sm:hidden"> my email address?</strong></h3>
            <p>We want the winner to be someone who really wants and will use this free drum set. After all, that’s what it’s for. So getting an email address lets us know you’re a real person!
                <br><br>
                On top of that, we want to start a relationship with you. It’s our way of saying, “Hey, we create awesome drum lessons, and we’d love to show you.” Don’t worry. We won’t send you spam or share your email address with anybody else. You’ll get free ongoing lessons and some special offers. And if you don’t like our emails, you can unsubscribe anytime.
            </p>
        </div>
    </section>

    <section class="text-center text-white py-8 md:py-16 lg:py-28 px-5 md:px-7 bg-center bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/footer.jpg">
        <div class="mx-auto max-w-md md:max-w-2xl">
            <img class="h-32 sm:h-36 md:h-44 lg:h-52 mb-12 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/logo.png" alt="title image">

            @include("drumeo.lead-gen.partials.sign-up-form", [
            "recaptchaKey" => $recaptchaKey,
            "formId" => "Pianote - Engagement - Trigger - FP30 Giveaway - Web Form",
            "formName" => 'FP30 Giveaway',
                "buttonText" => "I WANT TO WIN!",
            ])

        </div>
    </section>

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "trailer",
        "vimeoId" => "767456067",
    ])
    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-04-01 00:00:00',
        'promoVersion' => false
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

