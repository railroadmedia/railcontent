@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp
@extends('drumeo.sales.subscription', [
    "promoVersion" => true,
    "shopNav" => true,
    "hideHeader" => true,
])
@section('body-data')
    x-data ='{
    demoVid : false,
    trailer : false,
    lazyLoad: false,
    videoLoaded: false,
    keyTrailer : false,
    @foreach($drumeo['packs'] as $modalData)
        {{ $modalData['name'] }}: false,
    @endforeach
    }'
@endsection

@section('top-bar')
    @include('musora.sales.components.header-section', [
        'ascension' => true,
        'noSubHeader' => true,
        'noTrailer' => true,
        'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header.mp4',
        'header' => 'SAVE <u style="text-decoration-color: #0B76DB;">$300</u> COMPARED TO<br class="hidden sm:inline"> A MONTHLY MEMBERSHIP',
        'pointOne' => 'Song Breakdowns',
        'pointTwo' => 'Unlimited Drum Lessons',
        'pointThree' => 'Legendary Instructors',
        'pointFour' => '24/7 Support',
        'featured' => [
            [
                'url' => 'https://www.nytimes.com/2024/10/22/arts/music/amplifier-newsletter-music-social-media-accounts.html',
                'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
            ],
            [
                'url' => 'https://www.rollingstone.com/music/music-features/phil-collins-in-the-air-tonight-drum-fill-videos-1106780/',
                'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
            ],
            [
                'url' => 'https://www.nme.com/news/music/dream-theater-mike-potnoy-play-pull-me-under-first-time-13-years-3563614',
                'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
            ],
        ],
    ])

@endsection

@section('final')
    <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background: linear-gradient(68deg, #07233E 0%, #0C1524 100%);">
        <div class="container mx-auto relative z-50  max-w-3xl ">
            <div class="w-full px-4 md:px-0">
                <img class="h-10 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/september/logo-white.webp">
                <h2 class="leading-tight my-3 sm:my-4 font-black">
                    Get unlimited drum lessons for a year<br class="hidden sm:inline">
                    + $100 to Guitar Center</h2>
                <p class="text-sm leading-normal">
                    <i class="fas fa-check text-{{ $theme }}"></i> Drumeo Membership
                    <br class="sm:hidden">
                    <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> $50 Online/In-Person Gift Card
                    <br class="sm:hidden">
                    <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> $50 In-Person Lessons Gift Card
                </p>
            </div>
            <img class="h-24 sm:h-48 lg:h-56 my-5 sm:my-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/september/order-image.webp">

            <a role="link" aria-label=" Get Started" class="join {{ $theme }} w-full max-w-xs md:max-w-lg lg:max-w-2xl" style="padding: 20px 10px;" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[guitar-center-store-gift-card]=1&products[guitar-center-lessons-gift-card]=1&locked=true">GET Started &raquo;</a>
        </div>
    </section>
@endsection
