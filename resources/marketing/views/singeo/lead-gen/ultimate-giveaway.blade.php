@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Win The Ultimate Singer’s Toolkit</title>
    <meta property="og:title" content="Win The Ultimate Singer’s Toolkit">

    <meta name="description" content="Win $2,000 in prizes and have everything you need to transform your voice with the ULTIMATE Singer’s Toolkit.">
    <meta property="og:description" content="Win $2,000 in prizes and have everything you need to transform your voice with the ULTIMATE Singer’s Toolkit.">

    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/header_bg.jpg" style="display: none;">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/tailwind-helpers.css') }}">
    <link href="{{ asset('/assets/marketing/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/marketing/lead-gen.css') }}">

    <style>

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li, p {
            font-family:Open Sans, sans-serif;
            font-weight:400;
            line-height:1em;
            margin:0 auto
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:1024px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:1024px) {
            h2 {
                font-size:36px
            }
        }

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:1024px) {
            h3 {
                font-size:30px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:1024px) {
            h4 {
                font-size:24px
            }
        }

        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:1024px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:1024px) {
            li, p {
                font-size:16px
            }
        }
        .reveal-overlay .reveal.coach-wrap {
            user-select: none;
            border-radius: 10px;
            overflow: visible;
            max-width: 310px;
            top: 40px !important;
        }
        @media (min-width: 768px) {
            .reveal-overlay .reveal.coach-wrap {
                max-width: 450px;
                top: 96px !important;
            }
        }

        .join.white {
            background:#fff;
            color:#000
        }

        .join.white:hover, .join.white:focus {
            background:#eee;
            color:#000
        }

        header {
            background-image:url(https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/header_bg_m.jpg);
            background-size:cover;
            background-position:50% 0;
        }

        @media (min-width:768px) {
            header {
                background-image:url(https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/header_bg.jpg);
            }
        }

        .final-bg {
            background-image:url(https://cdn.musora.com/image/fetch/w_750,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/footer_bg_m.jpg);
            background-position:50% 0;
            background-size:cover;
        }

        @media (min-width:768px) {
            .final-bg {
                background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/footer_bg.jpg);
            }
        }
    </style>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav")

    <header class="relative text-center text-white bg-no-repeat py-5 md:py-6 lg:py-10 px-3 sm:px-5 lg:px-7 lazyload" style="background-color:#5639a3;">
        <div class="container relative z-10 mx-auto max-w-5xl md:mt-0">
            <div class="flex flex-wrap">
                <div class="w-full md:w-5/12 lg:w-1/2 pt-48 sm:pt-96 sm:order-1 relative">
                    {{--<i class="fas fa-play play-button absolute left-1/2 top-3/4 transform translate--1/2 autoplay-video" data-open="trailer"></i>--}}
                </div>
                <div class="w-full md:w-7/12 lg:w-1/2 sm:text-left">
                    <img class="inline-block sm:hidden h-32  lazyload" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/logo_center_align.svg" alt="title image">
                    <img class="hidden sm:inline-block h-28 lg:h-36 lazyload" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/logo_left_align.svg" alt="title image">
                    {{--<p class="my-2 sm:my-3">Enter your email for your chance to win a microphone, audio interface, and a LIFETIME of singing lessons from Singeo.</p>--}}
                    <p class="leading-tight sm:leading-normal my-2 sm:my-5" style="color:#d0e2e7">

                        <strong class="text-white uppercase">Win $2,000 in prizes</strong> and have everything you need to transform your voice with the ULTIMATE Singer’s Toolkit.
                        <br><br>
                        PLUS, get the Singing Starter Kit FOR FREE by just signing up and kickstart your journey to the singing voice you’ve always wanted.</p>
                    <div class="p-4 rounded-xl shadow-sm" style="background-color:#3e296f;">
                        <p style="color:#d0e2e7">
                            <i class="fas fa-check" style="color:#eb4ef7"></i> No purchase necessary. <br class="inline sm:hidden"> &nbsp; <i class="fas fa-check" style="color:#eb4ef7"></i> No age restrictions. <br>
                            <i class="fas fa-check" style="color:#eb4ef7"></i> No location restrictions.<br class="inline sm:hidden"> &nbsp; <i class="fas fa-check" style="color:#eb4ef7"></i> No sneaky shipping fees.
                        </p>
                    </div>
                    <p class="leading-tight sm:leading-normal my-2 sm:my-5" style="color:#d0e2e7"><strong>You’ll also get instructions via email on how to get a TON more bonus entries!</strong></p>
                    @include("lead-gen.partials._sign-up-form-cio", [
                    "formId" => "Singeo - Engagement - Trigger - Ultimate Giveaway - Web Form",
                    "formName" => 'Ultimate Giveaway',
                        "buttonText" => "I WANT TO WIN THE $2,000 PRIZE",
                        "stacked" => true
                        ])
                </div>
            </div>
        </div>
        <div class="absolute z-0 inset-0 inline sm:hidden" style="background:linear-gradient(to bottom, transparent 25%, #302465 66%);"></div>
    </header>

    <div class="sticky-trigger block"></div>
    <section class="text-center py-8 md:py-10 lg:py-20 px-5 md:px-4 text-white" style="background-color:#2e1e56;">
        <div class="container mx-auto max-w-4xl">
            <h3 class="leading-tight"><strong>The tools every singer needs</strong></h3>

            <p class="mt-3 mb-6" style="color:#d0e2e7">Get everything you need to transform your singing from the comfort of your own home.
                <br><br> From keeping your vocal cords strong and healthy - to recording yourself with studio quality to track your progress, if you LOVE music and have always dreamed of having an amazing singing voice, then The Ultimate Singer's Toolkit has everything you need.
                <br><br> Plus, with your Lifetime Singeo Membership, you can access unlimited step-by-step singing lessons and personal support from REAL vocal coaches to guide your journey to a better voice.
                <br><br> This is what your singing has been missing.</p>
            <h3 class="leading-tight mb-3"><strong>What's inside?</strong></h3>
            <img class="rounded-xl lazyload" data-src="https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/lifetime.png">
            <div class="flex flex-col sm:flex-row flex-wrap items-end mt-5">
                <div class="w-full sm:w-1/2 lg:w-1/3 mb-7 sm:mb-2 md:px-1">
                    <div class="flex flex-col flex-auto rounded-xl p-6" style="background:linear-gradient(to bottom, #c956d5, #9b1dac);">
                        <h5 class="leading-tight w-full"><strong>
                                ICON USB Studio<br> Microphone
                            </strong></h5>
                        <p class="rounded-md px-5 my-3 py-1.5 leading-none" style="background-color:#21173b;">Value of <strong>$340</strong></p>
                        <img class="mx-auto h-28 md:h-36 lg:h-44 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/Mic.png" alt="logo">
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 mb-7 sm:mb-2 md:px-1">
                    <div class="flex flex-col flex-auto rounded-xl p-6" style="background:linear-gradient(to bottom, #c956d5, #9b1dac);">
                        <h5 class="leading-tight w-full"><strong>
                                Eikon H1000 <br>Hi-End Headphones
                            </strong></h5>
                        <p class="rounded-md px-5 my-3 py-1.5 leading-none" style="background-color:#21173b;">Value of <strong>$180</strong></p>
                        <img class="mx-auto h-28 md:h-36 lg:h-44 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/Headphones.png" alt="logo">
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 mb-7 sm:mb-2 md:px-1">
                    <div class="flex flex-col flex-auto rounded-xl p-6" style="background:linear-gradient(to bottom, #c956d5, #9b1dac);">
                        <h5 class="leading-tight w-full"><strong>
                                VocalMist<br> Mister
                            </strong></h5>
                        <p class="rounded-md px-5 my-3 py-1.5 leading-none" style="background-color:#21173b;">Value of <strong>$166</strong></p>
                        <img class="mx-auto h-28 md:h-36 lg:h-44 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/VocalMist.png" alt="logo">
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 mb-7 sm:mb-2 md:px-1">
                    <div class="flex flex-col flex-auto rounded-xl p-6" style="background:linear-gradient(to bottom, #c956d5, #9b1dac);">
                        <h5 class="leading-tight w-full"><strong>
                                Singeo Do Re Mi<br> Hoodie
                            </strong></h5>
                        <p class="rounded-md px-5 my-3 py-1.5 leading-none" style="background-color:#21173b;">Value of <strong>$59</strong></p>
                        <img class="mx-auto h-28 md:h-36 lg:h-44 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/Hoodie.png" alt="logo">
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 mb-7 sm:mb-2 md:px-1">
                    <div class="flex flex-col flex-auto rounded-xl p-6" style="background:linear-gradient(to bottom, #c956d5, #9b1dac);">
                        <h5 class="leading-tight w-full"><strong>
                                Singeo Chorus<br> T-Shirt
                            </strong></h5>
                        <p class="rounded-md px-5 my-3 py-1.5 leading-none" style="background-color:#21173b;">Value of <strong>$29</strong></p>
                        <img class="mx-auto h-28 md:h-36 lg:h-44 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/Shirt.png" alt="logo">
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 mb-7 sm:mb-2 md:px-1">
                    <div class="flex flex-col flex-auto rounded-xl p-6" style="background:linear-gradient(to bottom, #c956d5, #9b1dac);">
                        <h5 class="leading-tight w-full"><strong>
                                Singeo Do Re Mi<br> Tumbler
                            </strong></h5>
                        <p class="rounded-md px-5 my-3 py-1.5 leading-none" style="background-color:#21173b;">Value of <strong>$29</strong></p>
                        <img class="mx-auto h-28 md:h-36 lg:h-44 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/Tumbler.png" alt="logo">
                    </div>
                </div>
            </div>
            <a class="join smaller anchor-slide w-full sm:w-2/3 mb-10" href="#final">I WANT TO WIN THE $2,000 PRIZE &raquo;</a>

        </div>
    </section>

    <div class="relative h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>
    <section class="px-4 py-12 sm:py-20">
        <div class="max-w-md sm:max-w-2xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center text-center">
                <img class="sm:order-1 rounded-md h-72 sm:h-80 lg:h-96 mb-7 sm:mb-0 mx-auto lazyload" data-src="https://cdn.musora.com/image/fetch/w_660,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/UI.png" alt="intro image">
                <div class="text-left sm:pr-6">
                    <h4 class="font-extrabold mb-1 sm:mb-2 leading-tight text-left mx-0">Everyone’s a winner</h4>
                    <p class="leading-normal">Even if you don’t win the main prize - although, who are we kidding? You probably will ;) - we won’t leave you empty-handed. <strong>When you sign up, you’ll receive FREE ACCESS to The Singing Starter Kit ($19).</strong>
                        <br><br>
                        So you’ll be able to kickstart your singing journey the right way... Get rid of all the guesswork and frustration as you follow along with 6 step-by-step lessons to discover your beautiful, unique voice. Use “The Most Important Vocal Exercise” to warm up your voice, and unlock the “Singer’s Secret Weapon” that will instantly make you sound better. Plus, you’ll have support and feedback from real teachers to help you at every turn.</p>
                </div>

            </div>
        </div>
    </section>
    <div class="relative h-5 sm:h-10 -mb-5 sm:-mb-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>

    <div id="final" class="anchor"></div>
    <section class="text-center text-white py-8 md:py-14 lg:py-20 px-5 md:px-7 bg-center bg-cover final-bg">
        <div class="container mx-auto max-w-2xl">
            <img class="h-24 sm:h-28 lg:h-44 lazyload mb-4 sm:mb-6" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ultimate/logo_center_align.svg" alt="title image">
            @include("lead-gen.partials._sign-up-form-cio", [
                "formId" => "Singeo - Engagement - Trigger - Ultimate Giveaway - Web Form",
                "formName" => 'Ultimate Giveaway',
                "buttonText" => "I WANT TO WIN!",
                "oneLineLg" => true,
                ])
        </div>
    </section>
    <section class="flex items-center text-center text-white" style="background:linear-gradient(180deg, #8300E9 0%, #3F0071 100%);">
        <img class="lazyload w-2/12 hidden md:inline" data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/mic-icon.png" alt="mic icon" />
        <div class="container mx-auto max-w-3xl px-6 sm:px-0 lg:px-4 py-8 md:py-10 lg:py-12">
            <h3 class="mb-5 sm:mb-7"><strong>Why do I need to give<br class="inline sm:hidden"> my email address?</strong></h3>
            <p>Well, we want the winner to be someone who really wants and will use this equipment. <br class="hidden lg:inline">So it’s our way of making sure you’re a real person!
                <br><br>
                On top of that, we want to start a relationship with you. It’s our way of saying, “Hey, we create awesome singing lessons and we’d love to show you.” Don’t worry, we won’t send you spam or share your email address with anybody else. You’ll get free ongoing vocal lessons and some special offers. And if you don’t like our emails, you can unsubscribe at any time.</p>
        </div>
        <img class="lazyload w-2/12 hidden md:inline" data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/email-icon.png" alt="email icon" />
    </section>

    @php
        $specs = [
            [
            'modalImage' => 'https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/intro_giveaway.jpg',
            'name' => 'EIKON STUDIO BOX 3',
            'subtitle' => 'Retail price: $215 USD',
            'info' => '<ul class="list-disc ml-10">
    <li>CM14USB microphone equipped with a 96 Khz 24 bit USB audio interface for plug-and-play simplicity.</li>
    <li>Small-diaphragm condenser capsule captures lifelike vocals</li>
    <li>Direct Monitoring control with independent Volume available on the microphone</li>
    <li>H1000 Professional Hi-End Stereo Headphones</li>
    <li>DST60TL Desktop Microphone Stand</li>
    </ul>',
            'modal' => 'focusrite',
            'prev' => false,
            'next' => false,
            ],

        ]
    @endphp
    @foreach($specs as $spec)
        <div class="reveal large relative coach-wrap rounded-xl select-none max-w-xs md:max-w-md" id="{{ $spec['modal'] }}" data-reveal data-reset-on-close="false">
            {{--@if($spec['prev'] != false)--}}
            {{--<i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10" data-close data-open="{{ $spec['prev'] }}"></i>--}}
            {{--@else--}}
            {{--<i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10 opacity-50"></i>--}}
            {{--@endif--}}
            <div class="relative rounded-t-lg pb-44 md:pb-60 bg-top bg-cover bg-black lazyload" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $spec['modalImage'] }}"></div>
            <div class="p-4 md:p-5">
                <h2 class="leading-none font-bebas">{!!  str_replace('<br>', ' ', $spec['name'])  !!}</h2>
                <p class="text-singeo uppercase mx-auto mb-3 md:mb-2">{!!  str_replace('<br>', ' ', $spec['subtitle'])  !!}</p>
                <p class="mx-auto text-left leading-normal md:leading-normal">{!! $spec['info'] !!}</p>
            </div>
            {{--@if($spec['next'] != false)--}}
            {{--<i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10" data-close data-open="{{ $spec['next'] }}"></i>--}}
            {{--@else--}}
            {{--<i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10 opacity-50"></i>--}}
            {{--@endif--}}
        </div>
    @endforeach


    @include("singeo.sales.partials._footer")


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/js/modal.js"></script>
    <script type="text/javascript" src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script>
        $(function () {
            $(document).foundation();

            // sticky topbar before orderSection
            var stickyBar = $('.promo-banner');
            $(window).scroll(function () {
                var stickTrigger = $('.sticky-trigger').offset().top;
                if ($(this).scrollTop()) {
                    stickyBar.removeClass('fixed');
                }
                if ($(this).scrollTop() < stickTrigger - 115) {
                    stickyBar.removeClass('fixed');
                }
                if ($(this).scrollTop() > stickTrigger - 115) {
                    stickyBar.addClass('fixed');
                }
            });
        });
    </script>
    <script type="text/javascript" src="/marketing/parcel/singeo/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
