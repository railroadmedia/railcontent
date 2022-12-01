@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Win A Vocal Studio Kit</title>
    <meta property="og:title" content="Win A Vocal Studio Kit">

    <meta name="description" content="Get A Professional Recording Studio At Home">
    <meta property="og:description" content="Get A Professional Recording Studio At Home">

    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/share_image.jpg" style="display: none;">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/singeo/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}">

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
            background-size:1250px;
            background-position: 70% 0;
        }

        @media (min-width:768px) {
            header {
                background-size:1460px;
                background-position: 56% 50%;
            }
        }

        @media (min-width:1024px) {
            header {
                background-size:1690px;
                background-position: 50% 50%;
            }
        }
    </style>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav")
    <header class="relative text-center text-white bg-no-repeat py-5 md:py-8 lg:py-14 px-3 sm:px-5 lg:px-7 lazyload" style="background-color:#5639a3;" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/header_giveaway.jpg">
        <div class="container relative z-10 mx-auto max-w-5xl md:mt-0">
            <div class="flex flex-wrap">
                <div class="w-full md:w-5/12 lg:w-1/2 pt-48 sm:pt-96 sm:order-1 relative">
                    {{--<i class="fas fa-play play-button absolute left-1/2 top-3/4 transform translate--1/2 autoplay-video" data-open="trailer"></i>--}}
                </div>
                <div class="w-full md:w-7/12 lg:w-1/2 sm:text-left">
                    <img class="h-32 md:h-28 lg:h-40 lazyload" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/logo_giveaway.png" alt="title image">
                    {{--<p class="my-2 sm:my-3">Enter your email for your chance to win a microphone, audio interface, and a LIFETIME of singing lessons from Singeo.</p>--}}
                    <p class="leading-tight sm:leading-normal my-2 sm:my-5" style="color:#d0e2e7">
                        Win an Eikon Studio Box 3. You’ll also get instructions via email on how to get a TON more bonus entries!<br><br>
                        <i class="fas fa-check" style="color:#eb4ef7"></i> No purchase necessary. <br class="inline sm:hidden"> &nbsp; <i class="fas fa-check" style="color:#eb4ef7"></i> No age restrictions. <br>
                        <i class="fas fa-check" style="color:#eb4ef7"></i> No location restrictions.<br class="inline sm:hidden"> &nbsp; <i class="fas fa-check" style="color:#eb4ef7"></i> No sneaky shipping fees.
                            <br><br>
                            <strong>The winner will be announced<br class="inline sm:hidden"> on October the 10th!</strong></p>
                    @include("singeo._partials._sign-up-form", [
                    "formId" => "Singeo - Engagement - Trigger - Eikon Giveaway - Web Form",
                    "formName" => 'Eikon Giveaway',
                        "buttonText" => "I WANT TO WIN!",
                        "stacked" => true
                        ])
                </div>
            </div>
        </div>
        <div class="absolute z-0 inset-0 inline sm:hidden" style="background:linear-gradient(to bottom, transparent 25%, #302465 66%);"></div>
    </header>

    <div class="sticky-trigger block"></div>
    <section class="text-center py-8 md:py-10 lg:py-20 px-5 md:px-4 bg-white">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="mb-7 sm:mb-0 sm:pr-5 lg:pr-7 w-full sm:w-1/2 text-left">
                    <h4 class="leading-tight"><strong>
                            Get a professional recording studio at home
                            </strong></h4>

                    <p class="my-3 sm:my-4">This Vocal Studio Kit includes every bit of gear you need to dive into home recording and live streaming with professional studio quality.
                        <br><br>
                        The Eikon Studio Box 3 retails for $215, and it can be yours <strong>FOR FREE. Just sign up with your email below.</strong>
                    </p>
                    <a href="#final" class="anchor-slide join smaller w-full sm:w-2/3">Sign Up</a>
                </div>

                <div class="rounded-xl overflow-hidden w-full sm:w-1/2 pb-72 sm:pb-96 bg-cover bg-center lazyload relative cursor-pointer" style="background-color:#5e321a;" data-open="focusrite"
                        data-bg="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/intro_giveaway.jpg">
                    <div class="join white smaller absolute bottom-5 right-5">SEE SPECS</div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-end my-5 ">
                <div class="flex flex-col flex-auto w-full sm:w-1/2 lg:w-1/4 mb-7 sm:mb-0 md:px-1">
                    <div class="leading-tight py-3 px-3 w-full rounded-t-md text-sm text-white" style="background-color:#170426;"><strong>Condenser microphone with USB interface</strong></div>
                    <picture>
                        <source media="(min-width: 640px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/mic_giveaway.jpg">
                        <img class="h-auto w-full md:w-auto md:h-56 lg:h-72 rounded-b-md lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/mic_giveaway_m.jpg" alt="logo">
                    </picture>
                </div>
                <div class="flex flex-col flex-auto w-full sm:w-1/2 lg:w-1/4 mb-7 sm:mb-0 md:px-1">
                    <div class="leading-tight py-3 px-3 w-full rounded-t-md text-sm text-white" style="background-color:#170426;"><strong>Desktop<br class="hidden md:inline"> microphone stand</strong></div>
                    <picture>
                        <source media="(min-width: 640px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/stand_giveaway.jpg">
                        <img class="h-auto w-full md:w-auto md:h-56 lg:h-72 rounded-b-md lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/stand_giveaway_m.jpg" alt="logo">
                    </picture>
                </div>
                <div class="flex flex-col flex-auto w-full sm:w-1/2 lg:w-1/4 mb-7 sm:mb-0 md:px-1">
                    <div class="leading-tight py-3 px-3 w-full rounded-t-md text-sm text-white" style="background-color:#170426;"><strong>Nylon screen professional pop filter</strong></div>
                    <picture>
                        <source media="(min-width: 640px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/filter_giveaway.jpg">
                        <img class="h-auto w-full md:w-auto md:h-56 lg:h-72 rounded-b-md lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/filter_giveaway_m.jpg" alt="logo">
                    </picture>
                </div>
                <div class="flex flex-col flex-auto w-full sm:w-1/2 lg:w-1/4 md:px-1">
                    <div class="leading-tight py-3 px-3 w-full rounded-t-md text-sm text-white" style="background-color:#170426;"><strong>Professional Hi-End stereo headphones</strong></div>
                    <picture>
                        <source media="(min-width: 640px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/headphones_giveaway.jpg">
                        <img class="h-auto w-full md:w-auto md:h-56 lg:h-72 rounded-b-md lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/headphones_giveaway_m.jpg" alt="logo">
                    </picture>
                </div>
            </div>
            <a class="join smaller w-full sm:w-2/3" data-open="focusrite">See Specs</a>
            <div class="text-black text-center sm:text-left shadow-md rounded-xl p-3 sm:p-7 mt-8 md:mt-10 lg:mt-20" style="background-color:#f4e5ff;">
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-center mx-auto">
                    <img class="mb-2 sm:mb-0 h-5 sm:h-8 lazyload" data-src="https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/eikon_logo.svg">
                    <p class="w-full sm:w-auto leading-tight pl-3 sm:pl-5 m-0"><strong>EIKON Studio Box 3 <br class="inline sm:hidden">kindly provided by Eikon.</strong><br>
                        Visit <a class="text-singeo" rel="noopener" target="_blank" href="https://www.eikon-audio.com/"><strong><u>Eikon</u></strong></a>  for all your<br class="inline sm:hidden"> recording gear needs.</p>
                </div>
            </div>
            {{--<p class="my-7"><em>(Laptop not included, you’ll need your own)</em></p>--}}
            {{--<div class="flex flex-col-reverse sm:flex-row rounded-lg items-center p-5 sm:p-10 mb-7" style="background-color:#170426;">--}}
                {{--<img class="w-1/2 mb-6 sm:mb-0 sm:w-4/12 lg:w-3/12 order-1 lazyload rounded-lg" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/ui-screen.jpg" alt="ui screen image">--}}
                {{--<div class="w-full sm:w-8/12 lg:w-9/12 sm:pr-8 text-left">--}}
                    {{--<h3><strong>More than just the equipment…</strong></h3>--}}
                    {{--<div class="mt-3 lg:mt-7 text-navy">--}}
                        {{--<p class="mb-3">--}}
                            {{--You know that equipment alone doesn’t make a good singer.--}}
                        {{--</p>--}}
                        {{--<p class="mb-3">--}}
                            {{--Which is why you’ll also win a LIFETIME Singeo membership. That’s a lifetime of unlimited singing lessons from some of the best vocal coaches around.--}}
                        {{--</p>--}}
                        {{--<p class="mb-3">--}}
                            {{--Learn whenever, wherever, on any device. You’ll have access to a complete step-by-step singing curriculum to help develop your voice so you can sing your favorite songs. Get connected with singers all over the world and learn from some incredible touring musicians, GRAMMY winners, and pro vocal coaches.--}}
                        {{--</p>--}}
                        {{--And if you’re not lucky enough to win (but you probably will right?), you might snag one of 5 annual Singeo memberships as our runner-up prizes.--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="flex flex-col sm:flex-row sm:items-center rounded-lg items-end">--}}
                {{--<div class="w-full sm:w-1/2 lg:w-7/12 relative flex justify-center items-center cursor-pointer autoplay-video" data-open="performance">--}}
                    {{--<i class="fas fa-play play-button absolute"></i>--}}
                    {{--<img class="lazyload rounded-lg mb-6 sm:mb-0" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/coach-image.jpg" alt="coach image" />--}}
                {{--</div>--}}

                {{--<div class="w-full sm:w-1/2 lg:w-5/12 sm:pl-5 lg:pl-10 text-left">--}}
                    {{--<h3><strong>Cate Canning’s Go-To Recording Rig</strong></h3>--}}
                    {{--<div class="mt-3 lg:mt-7 text-navy">--}}
                        {{--<p class="mb-3">Cate Canning knows what it takes to capture that studio sound.</p>--}}
                        {{--<p class="mb-3">The London-based Canadian Indie artist has been lighting up TikTok, Instagram, and Spotify with her catchy, soulful hits.</p>--}}
                        {{--<p class="mb-3">So how does she record herself?</p>--}}
                        {{--<p class="mb-3">With this exact setup. In fact, it’s what she used when she visited the Singeo Studios recently to record her special masterclass on “Defining Yourself As A Singer”</p>--}}
                        {{--If it’s good enough for Cate. It’s good enough for us.--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </section>
    <section class="px-4 py-12 sm:py-20" style="background-color:#faf5ff;">
        <div class="max-w-md sm:max-w-3xl lg:max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center text-center">
                <img class="sm:order-1 rounded-md h-72 sm:h-80 lg:h-96 mb-7 sm:mb-0 mx-auto lazyload" data-src="https://cdn.musora.com/image/fetch/w_660,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/phone_screen.png" alt="intro image">
                <div class="text-left sm:pr-6">
                    <h4 class="font-extrabold mb-1 sm:mb-2 leading-tight text-left mx-0">More than just a microphone…</h4>
                    <p class="leading-normal mb-2">A good mic does not a good singer make!
                        <br><br>
                        That's why you'll also win a LIFETIME Singeo membership. <strong>That's a lifetime of unlimited step-by-step singing lessons and personal feedback and support from REAL vocal coaches to guide your progress.</strong>
                        <br><br>
                        Learn whenever, wherever, on any device. As a Singeo member, you can access our structured singing curriculum and on-demand vocal exercise routines to strengthen your voice, fix your pitch and increase your range. Plus, you'll be able to connect with a community of THOUSANDS of other students on the same journey as you are.</p>
                    <h4 class="font-extrabold mb-1 sm:mb-2 leading-tight text-left mx-0">More than one chance to win!</h4>
                    <p class="leading-normal">And even if you don't win the main prize (but…you probably will, right?), you might snag one of 5 annual Singeo memberships as our runner-up prizes.</p>
                </div>

            </div>
        </div>
    </section>

    <div id="final" class="anchor"></div>
    <div class="relative h-5 sm:h-10 -mb-5 sm:-mb-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #faf5ff calc(50% + 1px));"></div>
    <section class="text-center text-white py-8 md:py-16 lg:py-28 px-5 md:px-7 bg-center bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/footer_giveaway.jpg">
        <div class="container mx-auto max-w-2xl">
            <img class="h-32 sm:h-36 md:h-44 lg:h-52 lazyload mb-4 sm:mb-6" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/giveaway/eikon/logo_giveaway.png" alt="title image">
            @include("singeo._partials._sign-up-form", [
                "formId" => "Singeo - Engagement - Trigger - Eikon Giveaway - Web Form",
                "formName" => 'Eikon Giveaway',
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
