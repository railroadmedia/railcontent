@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>Jared's Top Gear Picks | Drumeo</title>
    <meta property="og:title" content="Jared's Top Gear Picks | Drumeo">

    <meta name="description" content="You can peruse Jared’s top gear recommendations with confidence, knowing they’ve passed the test of millions of YouTube views — and gotten the Drumeo stamp of approval!">
    <meta property="og:description" content="You can peruse Jared’s top gear recommendations with confidence, knowing they’ve passed the test of millions of YouTube views — and gotten the Drumeo stamp of approval!">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/affiliate-share.jpg">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop.css') }}" rel="stylesheet">
@stop()

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <header class="relative text-white text-center bg-cover bg-top pb-8 md:pb-12 lg:pb-16 pt-40 md:pt-64 lg:pt-96 px-4 bg-musora-black" style="background-image:url(https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/drumeo-header.jpg);">
        <div class="container mx-auto relative z-10">
            <h1 class="lg:mt-10"><strong>Jared’s Top Gear Picks</strong></h1>
            <h5 class="mt-3 md:mt-5 mb-3 md:mb-4">WE RECOMMEND:</h5>
            <div class="flex flex-wrap items-center justify-center max-w-3xl mx-auto">
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="https://www.sweetwater.com/shop/drumeo/?irgwc=1&utm_source=Impact&utm_medium=Musora%20Media%20Inc.&utm_campaign=Online%20Tracking%20Link&irclickid=yebUGaXrWxyLRxLSdcy%3AOQDDUkBy5aVpITh7V40"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/sweetwater-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="https://www.amazon.com/shop/drumeo"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/amazon-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="https://www.thomann.de/intl/thlpg_2etep3mtdg.html?offid=1&affid=857"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/thomann-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="https://guitar-center.pxf.io/za4zxW"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/guitar-center-logo.png"></a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 right-0 top-24 md:top-1/2 left-0 z-0" style="background:linear-gradient(to bottom, transparent, #000C17);"></div>
    </header>
    <section class="py-10 md:py-16 px-2 recommended">
        <div class="container mx-auto max-w-xs md:max-w-5xl">
            <h4 class="px-1 md:px-2 mb-4"><strong>Drum Kits, Mics & Snares</strong></h4>
            <div class="flex flex-wrap">
                @php
                    $topics = [
                        [
                        'amazon' => 'https://www.amazon.com/dp/B00J1MGS54?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/x9ydBy',
                        'thomann' => 'https://www.thomann.de/intl/yamaha_stage_custom_studio_set_rbl.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/2rdRbD',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/81WrWq-bKTL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B07256RLNX?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/P0KGoR',
                        'thomann' => 'https://www.thomann.de/intl/sonor_sq1_rock_gt_cruiser_blue.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/3PEk6v',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/61Y0Sll87ZL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B08RW1HC3P?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/Gjn9a2',
                        'thomann' => 'https://www.thomann.de/intl/tama_starcl._performer_5pcs_car.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/Ryb0g7',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/91ngNubONdL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B084G7KJ3S?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/BXxLjJ',
                        'thomann' => 'https://www.thomann.de/intl/sonor_ssd_13_x575_benny_greb_2.0.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/NKbG1O',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/61DknFZN5cL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B07RFBDFDY?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/ORnAXP',
                        'thomann' => 'https://www.thomann.de/intl/yamaha_recording_custom_14_x8_sfg.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/YgNVEO',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71rODkqGgAL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B00JXI5DQG?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/4eJV33',
                        'guitarcenter' => 'https://guitar-center.pxf.io/7mMXR3',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71-cncptD4L._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B08C9N1JJG?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/151AXz',
                        'guitarcenter' => 'https://guitar-center.pxf.io/mgG49D',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/61oVk5PaezL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B00FCM5CZO?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/ZdXWoz',
                        'thomann' => 'https://www.thomann.de/intl/tama_pcp147_14_starphonic_copper.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/DV3WDy',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/41QvlwBo8XL._AC_US640_.jpg',
                        'title' => '',
                        ],
                    ]
                @endphp
                @foreach($topics as $topic)
                <div class="p-1 md:p-2 w-full md:w-1/3 lg:w-1/4">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front p-2 md:p-3 border-2 border-gray-200 rounded-lg">
                                <div class="aspect-1:1 bg-cover bg-center hover:opacity-70 transition-opacity duration-500" style="background-image:url({{ $topic['image'] }});">
                                    <i class="fas fa-arrow-right hover-icon"></i>
                                </div>
                            </div>
                            <div class="flip-card-back p-2 md:p-3 border-2 border-gray-200 rounded-lg flex flex-col flex-wrap justify-around">
                                @if(!empty($topic['sweetwater']))
                                    <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="{{ $topic['sweetwater'] }}"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/sweetwater-logo.png"></a>
                                @endif
                                @if(!empty($topic['amazon']))
                                    <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="{{ $topic['amazon'] }}"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/amazon-logo.png"></a>
                                @endif
                                @if(!empty($topic['thomann']))
                                    <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="{{ $topic['thomann'] }}"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/thomann-logo.png"></a>
                                @endif
                                @if(!empty($topic['guitarcenter']))
                                    <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="{{ $topic['guitarcenter'] }}"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/guitar-center-logo.png"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4 class="px-1 md:px-2 mt-8 md:mt-12 mb-4"><strong>Cymbals & Accessories</strong></h4>
            <div class="flex flex-wrap">
                @php
                    $topics = [
                        [
                        'amazon' => 'https://www.amazon.com/dp/B000S6TNLI?ref=exp_drumeo_dp_vv_d',
                        'guitarcenter' => 'https://guitar-center.pxf.io/5bnkW2',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/51oE-lhuCRL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B07JQ7Y453?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/6bAZ0m',
                        'thomann' => 'https://redir.love/thoprod/519290?offid=1&affid=857',
                        'guitarcenter' => 'https://guitar-center.pxf.io/LP20Aa',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71gZHM4zSRL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B0093QPZ2U?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/x9ydVR',
                        'thomann' => 'https://redir.love/thoprod/466530?offid=1&affid=857',
                        'guitarcenter' => 'https://guitar-center.pxf.io/qnyW5n',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71lSE%2BZYUzL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B000M3HST6?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/151Anx',
                        'thomann' => 'https://redir.love/thoprod/194510?offid=1&affid=857',
                        'guitarcenter' => 'https://guitar-center.pxf.io/QObYZY',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/419xDlhhP3L._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B07DVM85YN?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/n1Ndr9',
                        'thomann' => 'https://www.thomann.de/intl/paiste_21_medium_twenty_masters.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/9WEV4e',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71da0Y62VCL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B07RLQ8NV3?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/MX5ea2',
                        'thomann' => 'https://www.thomann.de/intl/yamaha_fp9c_single_foot_pedal.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/kjW4DM',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/81wNROR1h8L._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/1577310942?ref=exp_drumeo_dp_vv_d',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/51Bowx8bqWL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B005IW50I2?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/Aom6LN',
                        'thomann' => 'https://www.thomann.de/intl/paiste_22_masters_dark_ride.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/VyNOzR',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/51xhNex9VbL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B00543YJFU?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/KeJ5oy',
                        'thomann' => 'https://www.thomann.de/intl/paiste_18_thin_crash_602_series.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/ZdNVnR',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/615%2BEnIX4ML._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B01DORC5RQ?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/mgzdDa',
                        'thomann' => 'https://www.thomann.de/intl/paiste_19_masters_extra_thin_crash.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/gbGRM5',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/614z-Aw2ojL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B00UI5FIQI?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/gbDdy2',
                        'thomann' => 'https://www.thomann.de/intl/paiste_14_pstx_swiss_hats.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/XxN405',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/715%2BNrEULzL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://www.amazon.com/dp/B000EEHJ2E?ref=exp_drumeo_dp_vv_d',
                        'sweetwater' => 'https://imp.i114863.net/vnydoy',
                        'thomann' => 'https://www.thomann.de/intl/gibraltar_9908_drum_throne.htm?affid=857&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/oeONmg',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/61aJFLfqzdL._AC_US640_.jpg',
                        'title' => '',
                        ],
                    ]
                @endphp
                @foreach($topics as $topic)
                    <div class="p-1 md:p-2 w-full md:w-1/3 lg:w-1/4">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front p-2 md:p-3 border-2 border-gray-200 rounded-lg">
                                    <div class="aspect-1:1 bg-cover bg-center hover:opacity-70 transition-opacity duration-500" style="background-image:url({{ $topic['image'] }});">
                                        <i class="fas fa-arrow-right hover-icon"></i>
                                    </div>
                                </div>
                                <div class="flip-card-back p-2 md:p-3 border-2 border-gray-200 rounded-lg flex flex-col flex-wrap justify-around">
                                    @if(!empty($topic['sweetwater']))
                                        <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="{{ $topic['sweetwater'] }}"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/sweetwater-logo.png"></a>
                                    @endif
                                    @if(!empty($topic['amazon']))
                                        <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="{{ $topic['amazon'] }}"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/amazon-logo.png"></a>
                                    @endif
                                    @if(!empty($topic['thomann']))
                                        <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="{{ $topic['thomann'] }}"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/thomann-logo.png"></a>
                                    @endif
                                    @if(!empty($topic['guitarcenter']))
                                        <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="{{ $topic['guitarcenter'] }}"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/guitar-center-logo.png"></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="opacity-50 mt-6 max-w-2xl"><em>*This article contains affiliate links, which means we might earn a small commission from
                    the product seller if you make a purchase. For more info, check out our <a href="/privacy"><u>privacy page</u></a>.</em></p>
        </div>
    </section>
    <section class="relative text-white text-center py-8 md:py-12 lg:py-16 px-4" style="background-color:#000217;">
        <div class="container mx-auto">
            <h3 class="mb-5 md:mb-8">Shop for more of Jared’s top <br class="inline md:hidden"> gear at these online stores:</h3>
            <div class="flex flex-wrap items-center justify-center max-w-3xl mx-auto">
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="https://www.sweetwater.com/shop/drumeo/?irgwc=1&utm_source=Impact&utm_medium=Musora%20Media%20Inc.&utm_campaign=Online%20Tracking%20Link&irclickid=yebUGaXrWxyLRxLSdcy%3AOQDDUkBy5aVpITh7V40"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/sweetwater-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="https://www.amazon.com/shop/drumeo"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/amazon-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="https://www.thomann.de/intl/thlpg_2etep3mtdg.html?offid=1&affid=857"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/thomann-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="https://guitar-center.pxf.io/za4zxW"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/guitar-center-logo.png"></a>
                </div>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(function () {
            $('.flip-card').click(function (e) {
                e.stopPropagation();
                if (!$(e.target).is('a') && !$(e.target).is('button')) {
                    $(this).toggleClass('flipped');
                }

            });
        });
    </script>
@stop
