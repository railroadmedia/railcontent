@extends('singeo.shop.product-layout')

@section('head-includes')
    @parent

    <title>The Love To Sing Bundle</title>
    <meta name="description" content="Take your voice to the next level!">
    <meta property="og:description" content="Take your voice to the next level!">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/promos/november/bundles/annual-thumb.jpg" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
    <style>
        .side-bar .side-slide .logo {max-height:130px;display:none;}
        @media (min-width: 64em) {  .side-bar .side-slide .logo {display:inline-block;}  }
    </style>
@stop()

@php
    $bonuses = [
        [
            'name' => 'Singeo Annual Membership',
            'price' => '$' . SingeoPrices::$singeoMembershipAnnual . '/yr',
            'priceColor' => 'orange',
            'savedPrice' => '0',
            'desc' => 'Get ready to sing like you’ve never sung before! Find your confident voice with unlimited access to your step-by-step lesson plan, vocal routines, LIVE Q&A sessions with your teachers, and a karaoke song library with hundreds of your favorite songs to practice along with! You’ll be hitting higher notes, sounding stronger with better breath support, See how proper training, fun practice tools, and regular guidance will take your voice to the next level (and beyond)!',
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => false,
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/annual.jpg',
        ],
        [
            'name' => 'Singeo Do-Re-Mi Tumbler',
            'price' => 'Normally $29',
            'priceColor' => 'black',
            'savedPrice' => '0',
            'desc' => 'Stay hydrated while practicing your scales both at home or on the go with the Singeo Do-Re-Mi insulated tumbler. This tumbler holds a full 20 ounces, so you won’t have to worry about interrupting your practice for a refill. And the “do re mi” graphic will be your visual reminder to do some vocal exercises to keep your voice warm throughout the day.',
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/tumbler2.png',
        ],
        [
            'name' => 'Rockstar Mug',
            'price' => 'Normally $12',
            'priceColor' => 'black',
            'savedPrice' => '0',
            'desc' => 'It’s time to stock up on your favorite singer’s tea (have you tried Throat Coat yet?) and protect what is most important to you as a singer - your voice! Staying hydrated is a key factor in keeping your voice healthy and ready to perform - Keep your vocal cords happy and your voice healthy with this super rad rockstar mug.',
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/mug.jpg',
        ],
        [
            'name' => 'Vowel Practice Poster',
            'price' => 'Normally $12',
            'priceColor' => 'black',
            'savedPrice' => '0',
            'desc' => 'Knowing how to use vowel sounds and shapes is a singer’s secret weapon. The Singeo vowel chart is an easy-to-follow diagram demonstrating all the different vowel sounds you will use in your lessons (there’s more than you might think) and how to sing them! This poster will be your new favorite practice tool - and your ticket to hitting higher notes with ease and confidence.',
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/poster2.png',
        ],
        [
            'name' => 'The Singing Starter Kit',
            'price' => 'Normally $19',
            'priceColor' => 'black',
            'savedPrice' => '0',
            'desc' => 'Knowing how to use vowel sounds and shapes is a singer’s secret weapon. The Singeo vowel chart is an easy-to-follow diagram demonstrating all the different vowel sounds you will use in your lessons (there’s more than you might think) and how to sing them! This poster will be your new favorite practice tool - and your ticket to hitting higher notes with ease and confidence.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/singing-starter-kit.jpg',
        ]
    ];

    $accordionImgs = [
        [
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/annual.jpg',
            'type' => 'special',
        ],
        [
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/tumbler2.png',
            'type' => 'normal',
        ],
        [
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/mug.jpg',
            'type' => 'normal',
        ],
        [
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/poster2.png',
            'type' => 'normal',
        ],
        [
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/singing-starter-kit.jpg',
            'type' => 'normal',
        ],
    ];
@endphp

@section('banner')
    @include('singeo.shop.partials.promo-banner', [
                "name" => "The Love To Sing Bundle",
                "fullPrice" => SingeoPrices::$singeoMembershipAnnualFull,
                "price" => SingeoPrices::$singeoMembershipAnnual,
                    "specialText" => "Save 24%",
                "noBreadcrumb" => true
            ])
@endsection

@section('top')
    @include('singeo.shop.partials.slider', [
        "headerText" => "<strong>Take your voice to the next level!</strong>",
        "videoSrc" => "//player.vimeo.com/video/649113599",
        "videoThumb" => "https://singeo.s3.amazonaws.com/sales/promos/november/bundles/annual-thumb.jpg",
        "noSlider" => true
    ])

    @include('singeo.shop.partials.sidebar', [
        "logo" => "https://singeo.s3.amazonaws.com/sales/promos/november/bundles/annual-logo.png",
        "bundle" => true,
        "sku" => "products[singeo-annual-recurring-membership]=1&products[vowel-sounds-poster]=1&products[mouth-mug]=1&products[wallflower-tumbler]=1&products[singing-starter-kit]=1&redirect=/order&locked=true",
        "fullPrice" => SingeoPrices::$singeoMembershipAnnualFull,
        "price" => SingeoPrices::$singeoMembershipAnnual,
        "specialText" => "+$72 In Bonuses",
        "guaranteeBadge" => true,
        "soldOut" => true,
    ])
@endsection

@section('bottom')
    <div class="tw-flex tw-flex-wrap tw-my-7 lg:tw-my-0 lg:tw-mb-7">
        @foreach ($accordionImgs as $img)
            <img class="tw-p-1 tw-rounded-2xl tw-h-auto @if($img['type'] == 'special')tw-w-2/3 md:tw-w-1/3  @else tw-w-1/3 md:tw-w-1/6 @endif " src="{{ $img['img']}}" />
        @endforeach
    </div>
    <p>Find your full potential as a singer - because you LOVE to sing!
        <br><br>
        Hit higher notes, discover new techniques and reveal a sound that is TOTALLY unique to you.
        <br><br>
        Take your voice to the next level (and beyond!) with a 1 year, all-access membership to Singeo - PLUS some amazing bonuses!
        <br><br>
        Scroll down to see everything that’s included:
        <br><br>
        <strong>Say hello to your free bonuses:</strong><br>
        <em style="opacity: 0.5;">All digital bonuses are added to your account instantly with your membership to Singeo and they’re yours forever!</em> </p>
    <hr class="tw-my-5" style="border-color: #CACACA">

    @include('singeo.shop.partials.bonuses')
@endsection
