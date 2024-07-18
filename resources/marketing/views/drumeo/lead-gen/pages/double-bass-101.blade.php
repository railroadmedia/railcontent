@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Getting Started On The Drums | Drumeo</title>
    <meta property="og:title" content="Getting Started On The Drums | Drumeo">

    <meta name="description" content="Go from a total beginner to playing your first drum beats in this FREE series.">
    <meta property="og:description" content="Go from a total beginner to playing your first drum beats in this FREE series.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/updated/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/getting-started/">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">

    <style>
        h3 {
            font-size: 21px;
        }

        @media (min-width: 768px){
            h3 {
                font-size:24px;
            }
        }

        @media (min-width: 1024px) {
            h3 {
                font-size: 30px;
            }
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <header class="py-12 sm:py-20 text-white relative overflow-hidden" style="background: #020f1b;">
        <img class="absolute top-0 left-0 w-full h-full transition-opacity opacity-0 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header-bg.webp" alt="order-bg" loading="lazy" onload="this.classList.remove('opacity-0')" />
        <div class="max-w-5xl relative z-10 mx-auto sm:flex items-center container px-4 text-center sm:text-left">
            <div class="w-full sm:w-1/2 max-w-xl mx-auto sm:max-w-full">
                <div class="px-2 sm:pl-3 sm:pr-4 lg:pr-6 xl:pr-20">
                    <img
                        class="h-24 sm:h-28 lg:h-36 mb-1"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header-logo.webp"
                        alt="GSOTD logo"
                        fetchpriority="high"
                    />
                    <h3 class="leading-tight mb-3 sm:mb-5">Learn your first double bass grooves <strong>and play along with REAL music.</strong></h3>
                    <div class="max-w-xs px-4 mx-auto sm:hidden mb-5">
                        <img
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header.webp"
                            alt="header hero image mobile"
                            fetchpriority="high"
                        />
                    </div>
                    <h6 class="mb-4">Enter your email below for your 6 free lessons:</h6>
                </div>
                <div class="lg:pr-6 xl:pr-20">
                @include("drumeo.lead-gen.partials.sign-up-form", [
                    "formId" => "Drumeo - Engagement - Trigger - DB101 - Web Form",
                    "formName" => 'Double Bass 101',
                    "buttonText" => "Get started for free",
                    'stacked' => true,
                    "redirectURL" => "/thankyou",
                    "recaptchaKey" => $recaptchaKey
                ])
                </div>
            </div>
            <div class="w-full sm:w-1/2 hidden sm:block">
                <img
                    class="transition-opacity opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header.webp"
                    alt="header hero image"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
        </div>
    </header>

    <section class="py-12 sm:py-20 px-4 text-center">
        <div class="container max-w-4xl mx-auto">
            <h2 class="font-extrabold mb-4">6 free videos to help you<br> get started and beyond.</h2>
            <p class="mb-10">
                Double Bass 101 includes everything you need to coordinate your feet,<br class="hidden sm:inline">
                setup your kit, and draw inspiration from iconic double kick players:
            </p>
            <div class="flex flex-wrap justify-center max-w-sm mx-auto md:max-w-full text-left">
                @php
                    $lessons = [
                        [
                        "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/videos-01.webp",
                        "desc" => "<strong>Warm Up.</strong> Get started coordinating both of your feet and play smooth, even strokes.",
                        ],
                        [
                        "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/videos-02b.webp",
                        "desc" => "<strong>Setup & Technique.</strong> Set yourself up for success with fundamental foot techniques.",
                        ],
                        [
                        "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/videos-03b.webp",
                        "desc" => "<strong>16th Note Groove.</strong> Learn the double bass pattern that will unlock hundreds of songs.",
                        ],
                        [
                        "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/videos-04b.webp",
                        "desc" => "<strong>Double Bass Fills.</strong> You’re ready to incorporate double kick to create powerful fills.",
                        ],
                        [
                        "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/videos-05b.webp",
                        "desc" => "<strong>Breakdowns.</strong> Get choppy with broken rhythms to fuel your next heavy breakdown.",
                        ],
                        [
                        "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/videos-06b.webp",
                        "desc" => "<strong>Listening Recommendations.</strong> Samus gives you a list of double-kick drummers you need to know.",
                        ]
                    ];
                @endphp
                @foreach($lessons as $key => $lesson)
                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-6">
                        <img class="w-full rounded-lg" src="{{ $lesson['thumb'] }}" alt="video thumbnail" loading="lazy">
                        <p class="mt-3">{!! $lesson['desc'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-20" style="background: #F1F7FE;">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8 sm:px-4 lg:px-0">
            <div class="-mb-16 sm:mb-0 sm:mt-10 sm:-mr-8 relative">
                <picture>
                    <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/coach-profile.webp">
                    <source media="(min-width: 640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/510x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/coach-profile.webp">
                    <img
                        class="w-52 sm:w-72 md:w-96 relative z-40 transition-opacity opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/coach-profile.webp"
                        alt="profile picture"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </picture>

                <picture class="w-80 sm:w-80 lg:w-96 -left-14 sm:left-0 sm:-top-6 md:top-0 absolute md:-top-7 lg:-top-10 md:-left-10">
                    <source media="(min-width: 640px)" srcset="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/updated/coach-splash.png">
                    <img class="transition-all opacity-0" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/updated/coach-splash-m.png" alt="splash" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </picture>

            </div>
            <div class="mx-4 sm:mx-0 text-white text-left rounded-xl pt-20 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:pl-20 sm:mt-8 w-full sm:w-auto sm:flex-grow max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl z-30" style="background-color:#00101d;">
                <h6 class="uppercase text-drumeo leading-normal text-[#15C5FD]">MEET YOUR TEACHER</h6>
                <h2><strong>Samus Paulicelli (aka “66Samus”)</strong></h2>
                <p class="leading-normal mt-4 lg:mt-6">
                    66Samus is the hero the metal community deserves.
                    <br><br>
                    His world-class double bass work and infectious sense of humor have inspired millions of drummers and garnered +200 million views on his YouTube Channel. And more than entertainment, Samus is a renowned educator.
                    <br><br>
                    His beginner double bass videos have become go-to resources for drummers of all levels looking to learn drumming’s most coveted skill.
                    <br><br>
                    You’re in good feet hands with 66Samus.
                </p>
                <div class="flex justify-between text-center mt-7 lg:mt-10">
                    <div class="">
                        <img class="h-6 sm:h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg" alt="tiktok icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <h3 class="mt-2"><strong>449K</strong></h3>
                        <p class="uppercase opacity-70 text-sm">Followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <h3 class="mt-2"><strong>817K</strong></h3>
                        <p class="uppercase opacity-70 text-sm">Subscribers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <h3 class="mt-2"><strong>361K</strong></h3>
                        <p class="uppercase opacity-70 text-sm">followers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions', [
        'textColor' => 'white',
        'bgColor' => 'linear-gradient(to bottom, #01050F 0%, #02152a 100%);'
    ])

    <section class="py-8 sm:py-14 text-center relative text-white" style="background: #020f1b;">
        <img class="absolute top-0 left-0 w-full h-full transition-opacity opacity-0 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header-bg.webp" alt="order-bg" loading="lazy" onload="this.classList.remove('opacity-0')" />
        <div class="max-w-3xl mx-auto z-50 relative">
            <img class="h-32 sm:h-56 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/order-logo.webp" alt="GSTOD logo" loading="lazy" onload="this.classList.remove('opacity-0')" />
            <h5 class="my-5 sm:my-7 font-black">Enter your email to receive 6 free lessons.</h5>
            <div class="max-w-sm mx-auto sm:max-w-none px-4">
            @include("drumeo.lead-gen.partials.sign-up-form", [
                    "formId" => "Drumeo - Engagement - Trigger - DB101 - Web Form2",
                    "formName" => 'Double Bass 101',
                "buttonText" => "Get started for free ",
                    "redirectURL" => "/thankyou",
                    "recaptchaKey" => $recaptchaKey
            ])
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script defer src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script defer src="{{ asset('/marketing/js/drumeo/form-tracking.js') }}"></script>
@stop
