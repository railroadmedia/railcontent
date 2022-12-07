@extends('guitareo._partials.global-vue-layout')

@section('meta')
    <title>Lifetime Membership To Guitareo | Guitareo</title>
    <meta property="og:title" content="Lifetime Membership To Guitareo">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">

    <meta name="description" content="With the LIFETIME bundle, you'll get everything you need to pursue and develop your skills on the guitar.">
    <meta property="og:description" content="With the LIFETIME bundle, you'll get everything you need to pursue and develop your skills on the guitar.">
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/guitareo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/sales-page.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">

    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }
        .text-yellow {
            color: #FFAE00;
        }
        .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special p {
            max-width:100%;
        }

        .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
            max-width:240px;
            padding-bottom: 52%;
        }
        @media (min-width: 768px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:290px;
                padding-bottom: 34%;
            }
        }
        @media (min-width: 1024px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:330px;
                padding-bottom: 29%;
            }
        }
    </style>
@stop
@section('scripts')
    <script type="text/javascript" src="/marketing/parcel/guitareo/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>
@stop

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])

    <section class="content-section relative overflow-hidden text-white grey text-center upgrade-video-header" style="background:#01050F;">
        <div class="container mx-auto relative z-20">
            <h1 class="font-bebas text-5xl md:text-6xl lg:text-7xl leading-none">
                Become a <span class="text-yellow">lifelong learner of music.</span>
            </h1>
            <h5 class="uppercase mb-5">
                Get access to Guitareo for LIFE + 6 guitar bonuses worth $924
            </h5>
            <h5 class="uppercase text-yellow">
                You’ll also get unlimited access to Drumeo, Pianote, and Singeo lessons to <br>expand your musicality throughout your life.
            </h5>
            <div class="w-full mx-auto my-10 px-3 max-w-3xl">
                <div class="aspect-16:9 w-full relative">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/774475100" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>

            <p class="leading-relaxed px-3 mt-10 text-left max-w-2xl mx-auto" style="width: 100%; color:#A4AFC7;">
                <i>“My goal is to be one with the music. I just dedicate my whole life to this art.” - Jimi Hendrix</i> <br><br>

                Playing music is more than a hobby for a handful of people – it’s a part of their identity. If you can relate, you’re invited to commit yourself to learning and playing guitar with this special membership. <br><br>

                You’ll have the chance to make one final payment to your Guitareo membership and then enjoy unlimited guitar lessons, real support from teachers, and being part of a community of other guitarists like you. <br><br>

                PLUS, you’ll receive the Guitarist’s Survival Kit in the mail as a thank you – where you’ll get seven gear essentials to keep you sounding (and looking) good on the guitar. <br><br>

                The best thing about this membership is that you’ll get more than just guitar lessons. You’ll also have forever-access to online music lessons with Drumeo, Pianote, and Singeo, too. <br><br>

                You can become the musician you’ve always dreamed of – and have a lifetime to learn music without worrying about extra membership fees. <br><br>

                So I encourage you to keep growing your musicianship for years to come. <br><br>

                And a heads up: You can split this payment into 1, 2, or 5 installments at checkout to make this payment easier for you. <br><br>

                Scroll down to see all your goodies with your Lifetime Membership (including $924 worth of guitar bonuses) – and we hope to see you with your infinity badge on your profile very soon! <br><br><br>

                {{--                <a href="/ecommerce/add-to-cart?products[GUITAREO-LIFETIME-MEMBERSHIP]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&redirect=/order&locked=true" class="join w-full">Become a lifetime member >></a>--}}
            </p>
        </div>
        <div class="absolute w-full h-2/3 bottom-0 left-0" style="background:linear-gradient(to bottom, #01050f, #021225);"></div>
    </section>

     <div id="customize-anchor" class="anchor anchor-slide"></div>
         <section class="content-section relative overflow-hidden text-white grey text-center customize" style="background: linear-gradient(to bottom, #01050f,#010612);">
                 <div class="container mx-auto">
                    <div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-3xl mb-3" style="font-size: 0;">

                        <h3 class="font-extrabold text-white mb-10">Become a Lifetime Member <br class="md:hidden">today and get:</h3>

{{--                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-full">--}}
{{--                            <div class="flip-div special">--}}
{{--                                <div class="flip-inner">--}}
{{--                                    <div class="front ">--}}
{{--                                        --}}{{--<div class="absolute top-0 right-0 border-2 bg-black text-promo rounded-full py-4 px-3 -m-5" style="border-color:#fa153e"><p style="line-height: 1em;">SAVE</p><br><h5 class="leading-none" style="margin-bottom: 0;"><strong>25%</strong></h5></div>--}}
{{--                                        <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://guitareo.s3.amazonaws.com/sales/lifetime/guitareo-membership.jpg);"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="back">--}}
{{--                                        <div class="text-wrap">--}}
{{--                                            <p>Imagine what it would be like to call yourself a guitarist for the rest of your life… And with a LIFETIME membership to Guitareo -- you can do just that! Get full access to every lesson, song, chord chart, jam track, live Q&A, video review, and real teachers helping you along the way, from now and into the future. And it never expires! You can learn what you want, whenever you want, for the rest of your life.</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <p><strong class="text-promo">${{ GuitareoPrices::$guitareoMembershipLifetime }}</strong></span>--}}
{{--                                --}}{{--<br>INSTANT ACCESS--}}
{{--                            </p>--}}
{{--                        </div>--}}
                        @php
                            $bonuses = [
                                [
                                    'image' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/guitareo-lifetime.jpg',
                                    'description' => 'Get guitar lessons for LIFE with a Guitareo Lifetime Membership'
                                ],
                                [
                                    'image' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/drumeo-lifetime.jpg',
                                    'description' => 'Get drumming lessons for LIFE with a Drumeo Lifetime Membership',
                                ],
                                [
                                    'image' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/pianote-lifetime.jpg',
                                    'description' => 'Get piano lessons for LIFE with a Pianote Lifetime Membership',
                                ],
                                [
                                    'image' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/singeo-lifetime.jpg',
                                    'description' => 'Get singing lessons for LIFE with a Singeo Lifetime Membership',
                                ],
                                [
                                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/november/survival-kit-narrow-card-sale-site.jpg',
                                    'title' => 'Survival Kit',
                                    'description' => 'Get the gear essentials to start sounding better on the guitar.',
                                    'price' => GuitareoPrices::$survivalKitFull,
                                    'online-ship' => "Free Shipping"
                                ],
                                [
                                'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gq.jpg',
                                'title' => 'GuitarQuest',
                                'description' => 'Skip the boring stuff and start having fun! Your journey starts here.',
                                'price' => GuitareoPrices::$guitarQuestFull,
                                'online-ship' => "Lifetime Access"
                                ],
                                [
                                'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/500s.jpg',
                                'title' => '500 Songs In 5 Days',
                                'description' => 'Build the skills and knowledge to play 500 songs on the guitar. Comes with downloadable chord charts.',
                                'price' => GuitareoPrices::$songs500Full,
                                'online-ship' => "Lifetime Access"
                                ],
                                [
                                'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/agme.jpg',
                                'title' => 'Acoustic Guitar Made Easy',
                                'description' => 'Build a rock-solid foundation and get started on the acoustic guitar the right way.',
                                'price' => GuitareoPrices::$AGMEFull,
                                'online-ship' => "Lifetime Access"
                                ],
                                [
                                'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gtme.jpg',
                                'title' => 'Guitar Technique Made Easy',
                                'description' => 'Learn the most important guitar techniques and reach total guitar freedom.',
                                'price' => GuitareoPrices::$GTMEFull,
                                'online-ship' => "Lifetime Access"
                                ],
                                [
                                'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gs.jpg',
                                'title' => 'The Guitar System',
                                'description' => 'Transform your guitar playing with the ultimate encyclopedia of guitar lessons.',
                                'price' => GuitareoPrices::$guitarSystemFull,
                                'online-ship' => "Lifetime Access"
                                ],
                                [
                                'image' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/rhythm-groove.jpg',
                                'title' => 'Rhythm & Groove',
                                'description' => 'Go beyond simple strumming on the guitar.',
                                'price' => GuitareoPrices::$rhythmAndGrooveFull,
                                'online-ship' => "Lifetime Access"
                                ],
                            ]
                        @endphp
                        @foreach($bonuses as $key => $bonus)
                            <div class="bonus-wrap relative inline-block align-top mx-auto mb-5 md:mb-8 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/4">
                                <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif" style="padding-bottom: 132%;">
                                    <div class="flip-inner">
                                        <div class="front @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif" style="border-color:#df0032;">
                                            <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                                            <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"></div>
                                        </div>
                                        <div class="back">
                                            <div class="text-wrap">
                                                <p class="text-xs">{!!  $bonus['description']  !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="uppercase">
                                    {{-- <strong class="font-black leading-tight inline-block mt-2 mb-1">{!!  $bonus['title']  !!}</strong><br> --}}
                                    <span class="text-promo mt-1" style="text-transform:uppercase; display:inline-block;">{{--<s>${{ $bonus['price'] }}</s>--}} <strong style="color:#df0032;">@if(!empty($bonus['online-ship']))FREE @else INCLUDED @endif</strong></span><br>
                                    @if(!empty($bonus['online-ship'])){{ $bonus['online-ship'] }}@endif
                                </p>
                            </div>
                            @if($key === 6) <br class="hidden sm:inline"> @endif
                        @endforeach

{{--                        <p style="max-width: 500px;color: #aaa;padding:0 15px;"><em>All digital bonuses are added to your account IMMEDIATELY  with your membership to Guitareo, and they’re yours forever. </em></p>--}}
                    </div>
{{--                     <div class="arrow-wrap text-promo mb-3">--}}
{{--                        <i class="fal fa-chevron-down animated infinite pulse"></i>--}}
{{--                        <i class="fal fa-chevron-down animated delay-1s infinite pulse"></i>--}}
{{--                        <i class="fal fa-chevron-down animated delay-2s infinite pulse"></i>--}}
{{--                    </div>--}}

                    {{--<a class="join methodcta"--}}
                     {{--                        href="/ecommerce/add-to-cart?products[GUITAREO-LIFETIME-MEMBERSHIP]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&redirect=/order&locked=true"--}}
                    {{-->BECOME A LIFETIME MEMBER &raquo;</a>--}}
                     <a class="join sold-out methodcta my-4">SOLD OUT</a>
                 </div>
         </section>

    <section class="px-4 sm:px-6 py-12 md:py-20" style="background: #01050F;">
        <div class="max-w-5xl mx-auto text-center px-4 md:px-0">
            <p style="color:#ABB5C2;">
                If you need any further information about becoming a Lifetime Member, email our amazing support team at <b>support@guitareo.com</b>
                <br class="md:hidden"><br class="md:hidden">
                A friendly and knowledgeable support team member will get back to you right away.
            </p>
            <div class="inline-block w-full px-3 md:px-4 mt-5 text-light-navy">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @include("guitareo.sales.partials._footer")
@stop
