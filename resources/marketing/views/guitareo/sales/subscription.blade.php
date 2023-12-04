@php
    require_once(resource_path('marketing/views/guitareo/_partials/homepage-data.php'));
@endphp

@extends('guitareo._partials.global-layout')

@section('global-head')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    <meta property="og:url" content="https://www.guitareo.com"/>

    <meta name="description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee." />
    <meta property="og:description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee."/>

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/membership/homepage/webp-format/share-image-guitareo.webp"/>
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-guitareo.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
        .tool:after, .tool:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
        }
        .tool:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tool:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tool:hover, .tool:active, .tool:focus {
            z-index: 100;
        }
        .tool:hover:after, .tool:hover:before, .tool:active:after, .tool:active:before, .tool:focus:after, .tool:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 10px !important;
            opacity: 1 !important;
        }

        @media (min-width: 768px) {
            .splide__pagination__page {
                margin: 3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill: #00c9ac !important;
        }

        .bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: black;
            border-bottom: 0;
            margin-left: -5px;
            margin-bottom: -5px;
        }

        .header-slide-btn {
            display: none !important;
        }

        @if(!empty($trialVersion))
            .option-buttons.active {
                border-color:#00c9ac!important;
                background-color:#0c4a41 !important;
            }
            .option-buttons.active .radio-check {
                border-color:#00c9ac!important;
                background-color:#00c9ac!important;
            }
            .option-buttons.active .radio-check i {
                display:block!important;
            }
        @endif
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])

    @elseif(!empty($month))
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
    @endif

    @php
        $bubbles= $guitareo['bubbles']; // from homepage-data.php
        $features = $guitareo['features'];;
        $slides = $guitareo['slides'];
    @endphp
    @include('musora.sales.components.header-section', [
        'header' => 'Online guitar lessons<br> for all skill levels.',
            'underline' => true,
        'desc' => 'Learn the guitar faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
        'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/guitareo/membership/homepage/webp-format/header-thumb.webp',
        'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/guitareo/membership/homepage/webp-format/jan-thumb.webp',
        'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/guitareo/membership/homepage/webp-format/jan-thumb-m.webp',
        'pointOne' => 'Improve Your Skills',
        'pointTwo' => 'World-Class Teachers',
        'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
        'cta' => 'SEE YOUR DEAL &raquo',
    ])

    @php
        $gridItems = $guitareo['gridItems'];
    @endphp
    @include('musora.sales.components.trailer-grid-section', [
        'header' => 'Your guitar goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Learn to play guitar online with a fluff-free curriculum that’ll<br class="hidden sm:inline">  take your skills from zero to guitar hero – with step-by-step<br class="hidden sm:inline">  lessons designed around playing songs faster. ',
    ])

    @php
        $buttons = $guitareo['buttons'];
        $courses = $guitareo['courses'];
    @endphp
    @include('musora.sales.components.coaches-section', [
        'header' => 'Real Teachers,  <br class="sm:hidden">Real Results.',
        'desc' => 'Amplify your skills with exclusive artist <br class="hidden md:inline"> courses + live events with special guests.'
    ])

    @php
        $songItems = $guitareo['songItems'];
    @endphp
    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a note.',
        'video' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/guitareo/membership/homepage/webp-format/device.webp',
        'brandName' => 'Guitareo',
        'bannerDesc' => 'Powered by Musora, Guitareo includes full access to our communities for voice, piano, and drums.',
    ])
    @include('musora.sales.components.learn-by-playing-section', [
        'header' => 'Learn the guitar by<br class="inline sm:hidden"> <u>playing the guitar</u>.',
        'desc' => 'With Guitareo, you’ll play more, you’ll fall in love with your progress, <br class="hidden sm:inline lg:hidden"> and you’ll have personalized support every step of the way.',
                'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314551/rendition/540p/file.mp4?loc=external&signature=49333e2b437f90a4af69eb5b19468b68f5185729516f735cd390a6ce8b673516',
    ])

    @php
        $testimonials = $guitareo['testimonials'];
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by guitarists<br class="inline-block sm:hidden">  everywhere.',
        'reviewText' => 'Check out the reviews and meet some of our friendly students.',
        'youtubeLink' => 'https://www.youtube.com/guitarlessonscom/',
        'youtube' => '1M',
        'facebookLink' => 'https://facebook.com/guitareoofficial/',
        'facebook' => '330K',
        'instagramLink' => 'https://instagram.com/guitareoofficial/',
        'instagram' => '19K',
    ])
    @if(empty($trialVersion))
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/350x0/filters:quality(95)/marketing/guitareo/membership/homepage/webp-format/guitareo-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the guitar.',
    ])
    @endif
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    
    @if(!empty($trialVersion))
        @include('musora.sales.components.card-selection-section', [
            "noSelector" => true,
            "plusLogo" => "https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/guitareo/membership/homepage/2023/guitareo-plus-logo-light.svg",
            "logo" => "https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/guitareo/membership/homepage/webp-format/guitareo-logo.webp",
            "songs" => "1000+ popular songs.",
            "firstPoint" => "Unlimited guitar lessons.",
            "thirdPoint" => "Direct access to real teachers.",
            "fifthPoint" => "Lesson access for singing, piano, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[guitareo-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[GUITAREO-7-DAY-TRIAL-ONE-TIME]=1&redirect=/order&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[guitareo-base-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "monthlyLink" => "/ecommerce/add-to-cart?products[guitareo-base-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'guitar',
        ])

    @elseif(!empty($promoVersion))
        @php
        $productSkus = ['guitarists-survival-kit', 'guitar-quest', 'rhythm-and-groove'];
        $products = App\Models\Product::whereIn('sku', $productSkus)->get()->sort(function ($a, $b) use ($productSkus) {
            return array_search($a->sku, $productSkus) - array_search($b->sku, $productSkus);
        });
        $bonuses = [];
        foreach ($products as $product) {
            $bonuses[] = [
                'image' => $product['bundle_img'],
                'description' => $product['short_desc'],
                'price' => floatval($productPrices[$product['sku']]->price),
                'shipping' => boolval($product['bundle_free_shipping']), 
                'title' => $product['name'], 
            ];
        }
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/membership/homepage/webp-format/guitareo-annual-2w-card.webp',
        'header' => 'Online guitar lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 3 bonuses<br class="inline sm:hidden"> worth $333',
        'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
        'buttonLink' => '/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&redirect=/order&locked=true&promo-code=FREE-W-ANNUAL-6702,special',
        'altButtonLink' => '/ecommerce/add-to-cart?products[GUITAREO-1-MONTH-MEMBERSHIP]=1&redirect=/order&locked=true',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/guitareo/membership/homepage/webp-format/guitareo-logo-green.webp',
        'header' => 'Unlimited guitar lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Online guitar lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, piano, and drum lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/guitareo/membership/homepage/2023/guitareo-collage.png',
        ])

    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/guitareo/membership/homepage/webp-format/devices.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=e92a296a-7aeb-40ec-85eb-aaf891c3e6c1',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=guitareo_previews',
    ])

    @include('guitareo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => 'Mnmkc',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314408',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("guitareo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("guitareo.sales.partials._footer")
    @endif


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
