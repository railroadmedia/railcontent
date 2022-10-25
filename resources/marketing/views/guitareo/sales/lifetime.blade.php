@extends('guitareo._partial.global-vue-layout')

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
    </style>
    <style>
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
    <script type="text/javascript" src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });

            // Countdown
            $('.tzcd-full').countdown('2022/09/30')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2022/09/30')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
    </script>
@stop

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])
    {{--@include('guitareo._partials.promo-banner', [--}}
                {{--"name" => "The Lifetime Bundle",--}}
                {{--"fullPrice" => GuitareoPrices::$bundleLifetime,--}}
                {{--"price" => GuitareoPrices::$bundleLifetime,--}}
                    {{--"noBreadcrumb" => true,--}}
                    {{--"specialText" => "<strong>Extended for Cyber Monday</strong>",--}}
            {{--])--}}
    <section class="content-section relative overflow-hidden text-white grey text-center upgrade-video-header" style="background:#01050F;">
        <div class="container mx-auto relative z-20">
            <h1 class="font-bebas text-5xl md:text-6xl lg:text-7xl leading-none">
                Get guitar <br class="md:hidden">lessons <span style="color:#FFAE00;">for life</span>
            </h1>
            <h5 class="text-guitareo uppercase mb-5">
                + 6 Bonuses and the Guitareo <br class="md:hidden">Survival Guide for FREE!
            </h5>
            {{--<p class="text-center uppercase px-2" style="color:#FFAE00;">--}}
                {{--AVAILABLE UNTIL SEPTEMBER 30th AT MIDNIGHT<br>--}}
                {{--ONLY--}}
                {{--<span class="hidden md:inline-block font-bold tzcd-full">a limited time</span>--}}
                {{--<span class="inline-block md:hidden font-bold tzcd-small">a limited time</span>--}}
                {{--LEFT!--}}
            {{--</p>--}}
            <div class="w-full mx-auto my-10 px-3 max-w-3xl">
                <div class="aspect-16:9 w-full relative">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/649717537" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>

            <p class="leading-relaxed px-3 mt-10 text-left max-w-2xl mx-auto" style="width: 100%; color:#A4AFC7;">
                <i>“My guitar is not a thing. It is an extension of myself. It is who I am.” – Joan Jett</i> <br><br>

                For some, the guitar isn’t just a hobby – it’s a part of their identity. And if you feel the same way, we want to invite you to make a lifelong commitment to playing guitar. <br><br>

                {{--<b>Until the end of September, Guitareo Lifetime Memberships are back!</b> <br><br>--}}

                This is your chance to make one final payment for your Guitareo Membership and then enjoy unlimited guitar lessons, personal feedback from real teachers, and access to a community of other guitarists like you… for years to come. <br><br>

                <b>And heads up:</b> You can split the payment for 1, 2, or 5 installments. (You’ll see that option upon checkout.) <br><br>

                You’ll also get 6 FREE lifetime bonuses with your membership – plus Guitareo’s Survival Guide book so you can take the essential chords, scales and licks with you anywhere, anytime. With it, you’ll be prepared for any jam session or campfire singalong. <br><br>

                Scroll down to see all the goodies packed with your Guitareo Lifetime Membership – and we’ll see you with your little infinity badge around your name very soon! <br><br><br>

                {{--<a href="/ecommerce/add-to-cart?products[GUITAREO-LIFETIME-MEMBERSHIP]=1&products[survival-guide]=1&products[guitar-quest]=1&products[GTME-OCT-2018-SEMESTER]=1&products[AGME-JAN-2019-SEMESTER]=1&products[500-songs-in-5-days-guitareo]=1&products[GUITAR-SYSTEM]=1&products[rhythm-and-groove]=1&redirect=/order&locked=true" class="join w-full">Become a lifetime member >></a>--}}
            </p>
        </div>
        <div class="absolute w-full h-2/3 bottom-0 left-0" style="background:linear-gradient(to bottom, #01050f, #021225);"></div>
    </section>

     <div id="customize-anchor" class="anchor anchor-slide"></div>
         <section class="content-section relative overflow-hidden text-white grey text-center customize" style="background: linear-gradient(to bottom, #01050f,#010612);">
                 <div class="container mx-auto">
                    <div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-3xl mb-3" style="font-size: 0;">

                        <h3 class="font-extrabold text-white mb-10">Become a Lifetime Member <br class="md:hidden">today and get:</h3>

                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-full">
                            <div class="flip-div special">
                                <div class="flip-inner">
                                    <div class="front ">
                                        {{--<div class="absolute top-0 right-0 border-2 bg-black text-promo rounded-full py-4 px-3 -m-5" style="border-color:#fa153e"><p style="line-height: 1em;">SAVE</p><br><h5 class="leading-none" style="margin-bottom: 0;"><strong>25%</strong></h5></div>--}}
                                        <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://guitareo.s3.amazonaws.com/sales/lifetime/guitareo-membership.jpg);"></div>
                                    </div>
                                    <div class="back">
                                        <div class="text-wrap">
                                            <p>Imagine what it would be like to call yourself a guitarist for the rest of your life… And with a LIFETIME membership to Guitareo -- you can do just that! Get full access to every lesson, song, chord chart, jam track, live Q&A, video review, and real teachers helping you along the way, from now and into the future. And it never expires! You can learn what you want, whenever you want, for the rest of your life.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p><span style="text-transform:uppercase; display:inline-block;margin-top: 7px;"><s>$635</s> <strong class="text-promo">${{ GuitareoPrices::$guitareoMembershipLifetime }}</strong></span>
                                {{--<br>INSTANT ACCESS--}}
                            </p>
                        </div>
                        @php
                            $bonuses = [
                                [
                                'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/july/survival_guide.jpg',
                                'title' => 'Survival Guide',
                                'description' => 'A handy 37-page book with all the essential chords, strumming patterns, scales, and riffs. ',
                                'price' => GuitareoPrices::$survivalGuideFull,
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
                        @foreach($bonuses as $bonus)
                            <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/4">
                                <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif" style="padding-bottom: 132%;">
                                    <div class="flip-inner">
                                        <div class="front @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif">
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
                                    <strong class="font-black leading-tight inline-block mt-2 mb-1">{!!  $bonus['title']  !!}</strong><br>
                                    <span class="text-promo" style="text-transform:uppercase; display:inline-block;"><s>${{ $bonus['price'] }}</s> <strong>FREE</strong></span><br>
                                    {{ $bonus['online-ship'] }}
                                </p>
                            </div>
                        @endforeach

                        <p style="max-width: 500px;color: #aaa;padding:0 15px;"><em>All digital bonuses are added to your account IMMEDIATELY  with your membership to Guitareo, and they’re yours forever. </em></p>
                    </div>
                     <div class="arrow-wrap text-promo mb-3">
                        <i class="fal fa-chevron-down animated infinite pulse"></i>
                        <i class="fal fa-chevron-down animated delay-1s infinite pulse"></i>
                        <i class="fal fa-chevron-down animated delay-2s infinite pulse"></i>
                    </div>

                    {{--<a class="join promo methodcta"--}}
                            {{--href="/ecommerce/add-to-cart?products[GUITAREO-LIFETIME-MEMBERSHIP]=1&products[survival-guide]=1&products[guitar-quest]=1&products[GTME-OCT-2018-SEMESTER]=1&products[AGME-JAN-2019-SEMESTER]=1&products[500-songs-in-5-days-guitareo]=1&products[GUITAR-SYSTEM]=1&products[rhythm-and-groove]=1&redirect=/order&locked=true"--}}
                    {{-->BECOME A LIFETIME MEMBER &raquo;</a>--}}
                     {{--<a class="join sold-out methodcta my-4">SOLD OUT</a> --}}
                 </div>
         </section>

    <section class="content-section text-center px-6" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
        <div class="container mx-auto max-w-4xl">
            <img class="h-28 md:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-guarantee.png" alt="guitareo-guarantee">

            <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Happy student guarantee. </strong><br>
                Test-drive your Lifetime Membership for 90 days. Zero Risk. </h3>
            <p class="text-light-navy leading-normal md:leading-loose">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the guitar. </p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="inline-block tooltip cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></div></h6>
                </div>
            </div>
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
