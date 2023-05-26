@extends('guitareo._partials.global-layout')

@section('meta')
    @parent

    <title>Ayla's Top Gear Picks | Guitareo</title>
    <meta property="og:title" content="Ayla's Top Gear Picks | Guitareo">

    <meta name="description" content="You can peruse Ayla’s top gear recommendations with confidence, knowing they’ve passed the test of millions of YouTube views -- and gotten the Guitareo stamp of approval!">
    <meta property="og:description" content="You can peruse Ayla’s top gear recommendations with confidence, knowing they’ve passed the test of millions of YouTube views -- and gotten the Guitareo stamp of approval!">

    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2023/share-image-guitareo.jpg">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">
@stop()

@section('styles')
    @parent
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/shop-guitareo.css') }}" rel="stylesheet">
@stop()

@section('scripts')
    @parent
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
@stop()

@section('content')
    @include('guitareo.sales.partials._nav')

    <header class="relative text-white text-center bg-cover bg-top pb-8 md:pb-12 lg:pb-16 pt-40 md:pt-64 lg:pt-96 px-4 bg-musora-black" style="background-image:url(https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://d122ay5chh2hr5.cloudfront.net/shop/affiliate-header.jpg);">
        <div class="container mx-auto relative z-10">
            <h1 class="lg:mt-10"><strong>Ayla’s Top Gear Picks</strong></h1>
            <h5 class="mt-3 md:mt-5 mb-3 md:mb-4">WE RECOMMEND:</h5>
            <div class="flex flex-wrap items-center justify-center max-w-3xl mx-auto">
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="https://www.sweetwater.com/shop/guitareo/?irgwc=1&utm_source=Impact&utm_medium=Guitareo&utm_campaign=Online%20Tracking%20Link&irclickid=yebUGaXrWxyLRxLSdcy%3AOQDDUkBRwpXtITh7V40"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/sweetwater-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="https://www.amazon.com/shop/guitarlessons"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/amazon-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="https://www.thomann.de/intl/thlpg_wf86p8mhug.html?offid=1&affid=886"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/thomann-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="https://guitar-center.pxf.io/LP200o"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/guitar-center-logo.png"></a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 right-0 top-24 md:top-1/2 left-0 z-0" style="background:linear-gradient(to bottom, transparent, #000C17);"></div>
    </header>
    <section class="py-10 md:py-16 px-2 recommended">
        <div class="container mx-auto max-w-xs md:max-w-5xl">
            <h4 class="px-1 md:px-2 mb-4"><strong>Guitars, Pedals & Amps</strong></h4>
            <div class="flex flex-wrap">
                @php
                    $topics = [
                        [
                        'amazon' => 'https://amzn.to/3xvbEa4',
                        'sweetwater' => 'https://imp.i114863.net/4ergko',
                        'thomann' => 'https://www.thomannmusic.com/fender_duo_sonic_hs_ibm.htm?affid=886&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/5bnke2',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/61rd-IA+RCL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3jlEZyC',
                        'sweetwater' => 'https://imp.i114863.net/zaenL6',
                        'thomann' => 'https://www.thomannmusic.com/fender_am_ultra_strat_mn_texas_tea.htm?affid=886&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/QObYqo',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/719hJ2BiP4L._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/37ipIJh',
                        'sweetwater' => 'https://imp.i114863.net/15DZjm',
                        'thomann' => 'https://www.thomannmusic.com/sterling_by_music_man_valentine_jv60_tbm.htm?affid=886&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/a1eNyR',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71P3bIQsUOL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/2VuaCOe',
                        'sweetwater' => 'https://imp.i114863.net/LPxRbZ',
                        'thomann' => 'https://www.thomannmusic.com/tc_electronic_polytune_3_mini.htm?affid=886&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/e4Nnoz',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/51S8Xll8uuL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3rTzxXn',
                        'sweetwater' => 'https://imp.i114863.net/e4rkVz',
                        'thomann' => 'https://www.thomannmusic.com/boss_dd_8_digital_delay.htm?affid=886&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/DV3WE2',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/516B5CBMcqL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/2TVshOn',
                        'sweetwater' => 'https://imp.i114863.net/7mG1AQ',
                        'thomann' => 'https://www.thomannmusic.com/fender_marine_layer_player_pedal.htm?affid=886&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/kjW4nL',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/91u8uYMflEL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3rVHRWU',
                        'sweetwater' => 'https://imp.i114863.net/OR9yNn',
                        'thomann' => 'https://www.thomannmusic.com/mxr_evh_phase_90.htm?affid=886&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/P0bzLe',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/81BB5eB8zrL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/2VnkXM6',
                        'sweetwater' => 'https://imp.i114863.net/oeXo2m',
                        'thomann' => 'https://redir.love/thoprod/229365?offid=1&affid=886',
                        'guitarcenter' => 'https://guitar-center.pxf.io/Gjgbam',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/51lkrqYpmAL._AC_US640_.jpg',
                        'title' => '',
                        ],
                        [
                        'amazon' => 'https://amzn.to/3ilevxI',
                        'sweetwater' => 'https://imp.i114863.net/Vyb2qE',
                        'thomann' => 'https://www.thomannmusic.com/fender_tone_master_twin_reverb.htm?affid=886&offid=1',
                        'guitarcenter' => 'https://guitar-center.pxf.io/9WEV15',
                        'image' => 'https://images-na.ssl-images-amazon.com/images/I/71XOvwYqiHL._AC_US640_.jpg',
                        'title' => '',
                        ],
                    ]
                @endphp
                @foreach($topics as $topic)
                <div class="p-1 md:p-2 w-full md:w-1/3 lg:w-1/4">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front p-2 md:p-3 border-2 border-gray-200 rounded-lg">
                                <div class="tw-aspect-1:1 bg-cover bg-center hover:opacity-70 transition-opacity duration-500" style="background-image:url({{ $topic['image'] }});">
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
            <h3 class="mb-5 md:mb-8">Shop for more of Ayla’s top <br class="inline md:hidden"> gear at these online stores:</h3>
            <div class="flex flex-wrap items-center justify-center max-w-3xl mx-auto">
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#0074c1;" href="https://www.sweetwater.com/shop/guitareo/?irgwc=1&utm_source=Impact&utm_medium=Guitareo&utm_campaign=Online%20Tracking%20Link&irclickid=yebUGaXrWxyLRxLSdcy%3AOQDDUkBRwpXtITh7V40"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/sweetwater-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1 mb-3 md:mb-0">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#ff9400;" href="https://www.amazon.com/shop/guitarlessons"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/amazon-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#00b8c0;" href="https://www.thomann.de/intl/thlpg_wf86p8mhug.html?offid=1&affid=886"><img class="h-6 md:h-7" style="padding: 1px 0 4px;" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/thomann-logo.png"></a>
                </div>
                <div class="w-1/2 md:w-1/4 px-1">
                    <a target="_blank" class="join with-logo w-full" style="background-color:#cd2418;" href="https://guitar-center.pxf.io/LP200o"><img class="h-6 md:h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/guitar-center-logo.png"></a>
                </div>
            </div>
        </div>
    </section>

    @include('guitareo.sales.partials._footer')
@stop
