@extends('pianote._partials.global-layout')

@section('global-head')
    @parent

    <title>Lisa's Top Gear Picks | Pianote</title>
    <meta property="og:title" content="Lisa's Top Gear Picks | Pianote">

    <meta name="description" content="You can peruse Lisa’s top gear recommendations with confidence, knowing they’ve passed the test of millions of YouTube views -- and gotten the Pianote stamp of approval!">
    <meta property="og:description" content="You can peruse Lisa’s top gear recommendations with confidence, knowing they’ve passed the test of millions of YouTube views -- and gotten the Pianote stamp of approval!">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/og-image.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/shop.css') }}" rel="stylesheet">
@stop()

@section('global-body')
    @include('pianote._partials._nav')

    <header class="relative text-white text-center bg-cover bg-top pb-8 md:pb-12 lg:pb-16 pt-40 md:pt-64 lg:pt-96 px-4" style="background-color:#000c18;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://pianote.s3.amazonaws.com/shop/affiliate-header.jpg);">
        <div class="container mx-auto relative z-10">
            <h1 class="lg:mt-10"><strong>Lisa’s Top Gear Picks</strong></h1>
            <h5 class="mt-3 md:mt-5 mb-3 md:mb-4">WE RECOMMEND:</h5>
            <div class="flex flex-wrap items-center justify-center max-w-3xl mx-auto">
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="https://www.sweetwater.com/shop/pianote/?irgwc=1&utm_source=Impact&utm_medium=Pianote&utm_campaign=Online%20Tracking%20Link&irclickid=yebUGaXrWxyLRxLSdcy%3AOQDDUkBU9-19ITh7V40"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/sweetwater-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="https://www.amazon.com/shop/pianote"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/amazon-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="https://www.thomann.de/gb/thlpg_co74pz1xgm.html?offid=1&affid=882"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/thomann-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="https://guitar-center.pxf.io/a1eNNb"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/guitar-center-logo.png"></a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 right-0 top-24 md:top-1/2 left-0 z-0" style="background:linear-gradient(to bottom, transparent, #000c18);"></div>
    </header>
    <section class="py-10 md:py-16 px-2 recommended">
        <div class="container mx-auto max-w-xs md:max-w-5xl">
            <h4 class="px-1 md:px-2 mb-4"><strong>Keyboards, Digital Pianos, & Synthesizers</strong></h4>
            <div class="flex flex-wrap">
                @php
                    $topics = [
                        [
                        'amazon' => 'https://amzn.to/3yd1Ke6',
                        'sweetwater' => 'https://imp.i114863.net/P0jQzY',
                        'thomann' => 'https://www.thomannmusic.com/roland_rd_2000.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/Eay0QX',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71+at47tUhS._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/2UWCdYl',
                        'sweetwater' => 'https://imp.i114863.net/Gj0Xj9',
                        'thomann' => 'https://www.thomannmusic.com/yamaha_p_125_bk_home_bundle.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/n1y4Dx',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71KGs51Nd9L._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3xdL2dg',
                        'sweetwater' => 'https://imp.i114863.net/zaegaW',
                        'thomann' => 'https://redir.love/thoprod/416906?offid=1&affid=882',
                        'guitarcenter' => 'https://guitar-center.pxf.io/b3VkRB',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/51czQZt9AfL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3ibIJmE',
                        'sweetwater' => 'https://imp.i114863.net/2rQk1a',
                        'thomann' => 'https://redir.love/thoprod/368216?offid=1&affid=882',
                        'guitarcenter' => 'https://guitar-center.pxf.io/6bEk2N',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/719nf+ugZ8L._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3l9MATg',
                        'sweetwater' => 'https://imp.i114863.net/QONPyx',
                        'thomann' => 'https://www.thomannmusic.com/roland_fp_90_bk_home_bundle.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/ORbYGA',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/618r6gGMP3L._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3rDkIIz',
                        'sweetwater' => 'https://imp.i114863.net/x92Ekd',
                        'thomann' => 'https://www.thomannmusic.com/yamaha_p_515_b.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/2rdRnD',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71Y4ssYh0GL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'sweetwater' => 'https://imp.i114863.net/9WMGg0',
                        'thomann' => 'https://www.thomannmusic.com/roland_fa_07.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/3PEkbv',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71O-33u1guL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3f5tFW6',
                        'sweetwater' => 'https://imp.i114863.net/n1RkXo',
                        'thomann' => 'https://www.thomannmusic.com/yamaha_reface_cp.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/vnVDeA',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71ITiwU0t4L._AC_US640_.jpg',
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
                                    <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="{{ $topic['sweetwater'] }}"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/sweetwater-logo.png"></a>
                                @endif
                                @if(!empty($topic['amazon']))
                                    <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="{{ $topic['amazon'] }}"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/amazon-logo.png"></a>
                                @endif
                                @if(!empty($topic['thomann']))
                                    <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="{{ $topic['thomann'] }}"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/thomann-logo.png"></a>
                                @endif
                                @if(!empty($topic['guitarcenter']))
                                    <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="{{ $topic['guitarcenter'] }}"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/guitar-center-logo.png"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4 class="px-1 md:px-2 mt-8 md:mt-12 mb-4"><strong>Recording & Accessories</strong></h4>
            <div class="flex flex-wrap">
                @php
                    $topics = [
                        [
                        'amazon' => 'https://amzn.to/3iWn5SO',
                        'sweetwater' => 'https://imp.i114863.net/jWnXev',
                        'thomann' => 'https://www.thomannmusic.com/focusrite_scarlett_2i2_3rd_gen.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/yRkZGD',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71kKNb0QcGL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3zQqSIh',
                        'sweetwater' => 'https://imp.i114863.net/oeXRNn',
                        'thomann' => 'https://www.thomannmusic.com/akg_c414_xlii.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/YgNVWO',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71Wiv8FV-KL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3x4OaIs',
                        'sweetwater' => 'https://imp.i114863.net/b3DbkP',
                        'thomann' => 'https://redir.love/thoprod/426325?offid=1&affid=882',
                        'guitarcenter' => 'https://guitar-center.pxf.io/MXbKaP',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/61YD1V1z5RL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3iUoidq',
                        'sweetwater' => 'https://imp.i114863.net/NKQBGv',
                        'thomann' => 'https://redir.love/thoprod/508045?offid=1&affid=882',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/91K9z2bZgkL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/2VlKq8s',
                        'sweetwater' => 'https://imp.i114863.net/gbAPor',
                        'thomann' => 'https://www.thomannmusic.com/maudio_sp2.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/KezBka',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/717SHMIhP9L._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3ibKNLq',
                        'sweetwater' => 'https://imp.i114863.net/0JxQYM',
                        'thomann' => 'https://www.thomannmusic.com/millenium_kb2006.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/7mMX33',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/31OaFXi0SuL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3iZkrM8',
                        'sweetwater' => 'https://imp.i114863.net/NKQBN7',
                        'thomann' => 'https://www.thomannmusic.com/thomann_orchesterpult.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/mgG4xD',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/61V7QUNKulS._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3ynrPHm',
                        'sweetwater' => 'https://imp.i114863.net/x92EnA',
                        'thomann' => 'https://www.thomannmusic.com/akg_k240_mkii.htm?affid=882&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/LP20za',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/512FeHRlzxL._AC_US640_.jpg',
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
                                        <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="{{ $topic['sweetwater'] }}"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/sweetwater-logo.png"></a>
                                    @endif
                                    @if(!empty($topic['amazon']))
                                        <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="{{ $topic['amazon'] }}"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/amazon-logo.png"></a>
                                    @endif
                                    @if(!empty($topic['thomann']))
                                        <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="{{ $topic['thomann'] }}"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/thomann-logo.png"></a>
                                    @endif
                                    @if(!empty($topic['guitarcenter']))
                                        <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="{{ $topic['guitarcenter'] }}"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/guitar-center-logo.png"></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <p class="opacity-50 mt-6 max-w-2xl"><em>*This article contains affiliate links, which means we might earn a small commission from
                        the product seller if you make a purchase. For more info, check out our <a href="/privacy"><u>privacy page</u></a>.</em></p>
            </div>
        </div>
    </section>
    <section class="relative text-white text-center py-8 md:py-12 lg:py-16 px-4" style="background-color:#000217;">
        <div class="container mx-auto">
            <h3 class="mb-5 md:mb-8">Shop for more of Lisa’s top <br class="inline md:hidden"> gear at these online stores:</h3>
            <div class="flex flex-wrap items-center justify-center max-w-4xl mx-auto">
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="https://www.sweetwater.com/shop/pianote/?irgwc=1&utm_source=Impact&utm_medium=Pianote&utm_campaign=Online%20Tracking%20Link&irclickid=yebUGaXrWxyLRxLSdcy%3AOQDDUkBU9-19ITh7V40"><img class="h-6 md:h-7"src="https://drumeo-assets.s3.amazonaws.com/drum-shop/sweetwater-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="https://www.amazon.com/shop/pianote"><img class="h-6 md:h-7"src="https://drumeo-assets.s3.amazonaws.com/drum-shop/amazon-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="https://www.thomann.de/gb/thlpg_co74pz1xgm.html?offid=1&affid=882"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/thomann-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="https://guitar-center.pxf.io/a1eNNb"><img class="h-6 md:h-7" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/guitar-center-logo.png"></a>
                </div>
            </div>
        </div>
    </section>



    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>

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
