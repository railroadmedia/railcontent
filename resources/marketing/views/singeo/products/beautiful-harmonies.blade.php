@php
    $lessons = [
        [
            'title' => 'Your First Harmony',
            'description' => 'Believe it or not, you’ll be singing a harmony in your very first lesson! Don’t know how? Don’t worry, we’ve got an easy trick that will have you singing a harmony along with Lisa and Julia right away.',
        ],
        [
            'title' => 'The Secret To Finding A Good Harmony',
            'description' => 'Have you ever wondered what note to start on when it comes to finding a harmony? Lisa and Julia will teach you how to find the right note and how to sing a simple harmony using a major third.',
        ],
        [
            'title' => 'Singing Beautiful Harmonies',
            'description' => 'In this lesson we’ll be applying our parallel thirds to a song. Learn our original song “Day Or Night” with us to practice your harmonies.',
        ],
        [
            'title' => 'What If My Harmony Doesn’t Fit?',
            'description' => 'Together we’ll learn what to do when your harmony suddenly doesn’t sound good and that parallel third doesn’t work anymore. In this lesson we’ll become familiar with chords, sharpen our ears and practice singing the notes of a chord.',
        ],
        [
            'title' => 'It Goes Like This (The Fourth, The Fifth… )',
            'description' => 'In this lesson we’ll give you some more options for other intervals that are likely going to make for a beautiful harmony. We’ll also discuss when a harmony should be sung below or above the melody.',
        ],
        [
            'title' => 'The Easiest Harmony In The World',
            'description' => 'We’re going to teach you one of the easiest ways to add a simple harmony line to a song. We like to call it the “One Note Harmony” and you’ll be surprised how fun it is to sing! You’ll get to learn the second part of “Day Or Night” to practice your new harmony!',
        ],
        [
            'title' => 'Learning Harmonies To Songs You Know',
            'description' => 'In this lesson we’ll work through some harmonies together for songs that will be familiar to you. You’ll be able to wow your friends at the next Birthday party.',
        ],
        [
            'title' => 'Tips & Tricks To Become A GREAT Harmony Singer',
            'description' => 'As we wrap up, we’ll highlight the importance of blending when singing with others and we’ll give you our final words of advice to help you become the best harmony singer you can be!',
        ],
    ];
@endphp

@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Harmony Pack | Singeo</title>
    <meta property="og:title" content="Harmony Pack | Singeo">

    <meta name="description" content="Everything you need to start singing in perfect harmony now"/>
    <meta property="og:description" content="Everything you need to start singing in perfect harmony now">

    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/fb-share-image.jpg">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/singeo/sales-page.css') }}" rel="stylesheet">

    <style>

        .dropdown .active {
            height: auto !important;
            visibility: visible !important;
            max-height: 400px !important;
            opacity: 1 !important;
        }

    </style>
    @parent
@endsection

@section('global-body')
    @include("singeo.sales.partials._nav", [
        "cartVersion" => true
    ])

    {{--@include('shop.partials.promo-banner', [--}}
    {{--"name" => "Beautiful Harmonies",--}}
    {{--"fullPrice" => floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->price),--}}
    {{--"price" => floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->discounted_price),--}}
    {{--"noBreadcrumb" => true--}}
    {{--])--}}
    @yield('topbar')

    <header class="py-12 md:py-20" style="background:linear-gradient(180deg, #00101D 0%, #23053A 100%);">
        <div class="max-w-md md:max-w-4xl mx-auto md:flex md:items-center text-white md:gap-10 px-6 lg:px-0">
            <div class="md:w-1/2 text-center md:text-left">
                <picture>
                    <source media="(min-width: 768px)" srcset="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/logo_left_light.png">
                    <img class="h-24 lg:h-32 rounded-b-md lazyload mb-3" data-src="https://www.musora.com/musora-cdn/image/width=460,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/logo_center_light.png" alt="logo">
                </picture>
                <div class="relative md:hidden">
                    <img class="rounded-xl mb-4" src="https://www.musora.com/musora-cdn/image/width=650,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/header_thumb_m.jpg" alt="header thumb">
{{--                    <div class="absolute uppercase bg-white text-black rounded-full pb-1 pt-1.5 px-4 font-bebas bottom-6 left-2 cursor-pointer autoplay-video text-sm" data-open="trailer">--}}
{{--                        <i class="fa-solid fa-play mr-1"></i> play video--}}
{{--                    </div>--}}
                </div>
                <h3 class="font-extrabold leading-tight mb-2 md:mb-8 text-center md:text-left">Everything you need <br class="md:hidden">to start singing in <br class="md:hidden">perfect harmony now</h3>
                <div class="md:w-72 lg:w-2/3 text-center">
                    <a class="join smaller w-full tracking-tighter mb-2" href="/ecommerce/add-to-cart?products[the-essential-guide-to-beautiful-harmonies]=1&redirect=/order">get started for ${{ floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->discounted_price) }}</a>
                    <p>**90-DAY GUARANTEE**</p>
                </div>
            </div>
            <div class="md:w-1/2 hidden md:block relative">
                <img class="rounded-xl" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/header_thumb.jpg" alt="header thumb">
{{--                <div class="absolute uppercase bg-white text-black rounded-full pb-1 pt-2 px-6 font-bebas bottom-3 lg:bottom-4 left-4 lg:left-6 autoplay-video cursor-pointer" data-open="trailer">--}}
{{--                    <i class="fa-solid fa-play mr-1"></i> play video--}}
{{--                </div>--}}
            </div>
        </div>
    </header>
    <section class="pt-12 pb-40 md:py-20 relative">
        <div class="max-w-md md:max-w-4xl mx-auto md:flex md:items-center md:gap-6 px-6 lg:px-0 relative">
            <div class="md:w-3/5">
                <h3 class="mb-4 font-extrabold">Create the extraordinary</h3>
                <p class="leading-tight mb-6">
                    Something extraordinary happens when two voices are matched in perfect harmony. It’s like the vocal performance is taken to a whole new level.
                    <br><br>
                    Unfortunately, for many singers - and maybe this is the case for you - harmonies don’t come naturally.
                    <br><br>
                    But here’s good news!
                    <br><br>
                    Because singing beautiful harmonies only requires a few things…
                    <br><br>
                    Time. Practice. And most of all…
                    <br><br>
                    The right guidance.
                    <br><br>
                    With those 3 things - ANYONE can learn to sing beautiful harmonies. Even you. It doesn’t matter what your vocal range is. Or what style you like to sing.
                    <br><br>
                    So if you dream of singing beautiful harmonies and creating something extraordinary, then you need The Essential Guide To Beautiful Harmonies.
                </p>
                <div class="md:w-80 lg:w-2/3 mb-6 md:mb-0">
                    <a class="join smaller w-full tracking-tighter mb-2" href="/ecommerce/add-to-cart?products[the-essential-guide-to-beautiful-harmonies]=1&redirect=/order">get started for ${{ floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->discounted_price) }}</a>
                </div>
            </div>
            <div class="absolute md:relative left-0 right-0 md:w-2/5 flex justify-center md:block">
                <img class="h-72 md:h-auto lazyload" data-src="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/notepad.png" alt="note pad">
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-7 " style="background: linear-gradient(to top left, #F7ECFF calc(50% - 1px), transparent, transparent calc(50% + 1px));"></div>

    <section class="pt-40 pb-12 md:py-20" style="background:#F7ECFF;">
        <div class="max-w-md md:max-w-4xl mx-auto md:text-center px-6 lg:px-0">
            <h3 class="font-extrabold mb-8 md:mb-12 text-center">With this course, you'll learn:</h3>
            <div class="md:flex md:flex-wrap md:gap-6 lg:gap-10">
                <div class="md:flex-1 flex md:block mb-6 md:mb-0">
                    <img class="h-9 md:h-12 mb-6 mr-4 md:mr-0 lazyload" data-src="https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/music_icon.svg" alt="music icon">
                    <div>
                        <h6 class="font-extrabold mb-1 md:mb-4 leading-normal">The SECRET to finding <br class="md:hidden">ANY harmony (high or low)</h6>
                        <p>Use a simple technique to know exactly which notes are the right ones to elevate a vocal performance.</p>
                    </div>
                </div>
                <div class="md:flex-1 flex md:block mb-6 md:mb-0">
                    <img class="h-9 md:h-12 mb-6 mr-3 md:mr-0 lazyload" data-src="https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/understanding_icon.svg" alt="understanding icon">
                    <div>
                        <h6 class="font-extrabold mb-1 md:mb-4 leading-normal">How to make your harmony fit ANY melody</h6>
                        <p>Have a comprehensive understanding of how harmonies work and apply this knowledge to any song.</p>
                    </div>
                </div>
                <div class="md:flex-1 flex md:block">
                    <img class="h-9 md:h-12 mb-6 mr-3 md:mr-0 lazyload" data-src="https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/mic_icon.svg" alt="mic icon">
                    <div>
                        <h6 class="font-extrabold mb-1 md:mb-4 leading-normal">The easiest harmony <br class="hidden md:inline">in the world.</h6>
                        <p>That also sounds incredible. You can be singing your first harmony 10 minutes from NOW!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-12 pb-16 md:pt-20 md:pb-28">
        <div class="max-w-md md:max-w-4xl mx-auto text-center px-6 lg:px-0">
            <h3 class="font-extrabold mb-4">How does it work?</h3>
            <p class="md:max-w-lg lg:max-w-xl mb-6">
                It’s simple. You’ll get 8 step-by-step video lessons from us that will show you exactly what to do -- and better still… <br><br>
                Exactly HOW TO PRACTICE. You’ll be able to sing along with hand-picked practice exercises after every lesson. You just have to press play.
            </p>
            @foreach($lessons as $key => $lesson)
                <div
                    x-data = "{ open: false }"
                    x-on:click="open = !open;"
                    class="dropdown text-center border border-singeo rounded-md overflow-hidden flex cursor-pointer mb-3 select-none"
                >
                    <div class="bg-singeo py-5 px-2 sm:px-3 text-white">
                        <h5 class="leading-tight whitespace-nowrap">
                            <span class="text-xs hidden md:inline mr-1"> Lesson</span>
                            <strong>{{ $key+1 }}</strong>
                        </h5>
                    </div>
                    <div class="py-5 px-3 md:px-4 text-left flex-grow">
                        <div class="flex items-center text-left flex-col sm:flex-row relative">
                            <h5 class="text-singeo leading-tight flex-grow w-full sm:w-auto"><strong>{!! $lesson['title'] !!}</strong></h5>
                        </div>
                        <p
                            x-bind:class="open && 'active'"
                            class="description leading-normal transition-all duration-500 overflow-hidden h-0 invisible max-h-0 opacity-0"
                            style="color:#1B1B1B;"
                        >
                            <br>
                            {!! nl2br( $lesson['description']) !!}
                        </p>
                    </div>
                    <div class="py-5 px-2 sm:px-3 ml-auto">
                        <i x-bind:class="open && 'rotate-180'" class="text-sm sm:text-xl fas fa-chevron-down transform transition-all duration-500 text-singeo font-extrabold"></i>
                    </div>

                </div>
            @endforeach
        </div>
    </section>

    <div class="relative h-5 sm:h-7 " style="background: linear-gradient(to top left, #00101D calc(50% - 1px), transparent, transparent calc(50% + 1px));"></div>

    <section class="pb-12 pt-20 md:pb-20 md:pt-24 relative" style="background:#00101D;">
        <div class="absolute flex justify-center left-0 right-0 -top-12 md:-top-20 lg:-top-24">
            <img class="h-24 md:h-32 lg:h-36 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=280,quality=85/https://d21xeg6s76swyd.cloudfront.net/sales/2022/singeo-guarantee.png" alt="guarantee badge">
        </div>
        <div class="max-w-md md:max-w-3xl mx-auto text-center text-white px-6 lg:px-0">
            <h3 class="leading-snug mb-4">
                <b>100% of the benefits</b><br>
                None of the risk
            </h3>
            <p class="mb-6">
                You’ll have 90 days to try it 100% risk-free. So if you’re not happy with your progress, let us know within the first three months of having the course, and we’ll give you your money back. No questions asked.
            </p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-singeo border-singeo border-2 rounded-full inline-block py-2.5 px-3.5 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-singeo border-singeo border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <h5 class="text-singeo border-singeo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <span class="tooltip cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle" aria-hidden="true"></i></span></h6>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20 text-center" style="background:#F7ECFF;">
        <img class="h-20 md:h-24 lg:h-32 mb-2 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-pack/logo_center_dark.png" alt="logo">
        <h3 class="font-extrabold leading-snug md:leading-normal mb-4">
            Everything you need to <br class="md:hidden">start singing <br class="hidden md:inline">in perfect <br class="md:hidden">harmony now
        </h3>
        <a class="join smaller w-60 md:w-96 mb-2" href="/ecommerce/add-to-cart?products[the-essential-guide-to-beautiful-harmonies]=1&redirect=/order">Get started for ${{ floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->discounted_price) }}</a>
        <p style="color:#747474;">**90-DAY GUARANTEE**</p>
    </section>

    @include('singeo.lead-gen.partials._video-player',[
        "id" => "trailer",
        "code" => "738333190"
    ])
    @include("singeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@endsection
