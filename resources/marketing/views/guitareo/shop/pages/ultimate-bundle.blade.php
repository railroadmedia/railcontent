@extends('guitareo.shop.product-layout')

@section('head-includes')
    @parent

    <title>The Ultimate Lessons Bundle</title>
    <meta name="description" content="Your ULTIMATE way to learn the guitar.">
    <meta property="og:description" content="Your ULTIMATE way to learn the guitar.">
    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/vid-thumb.jpg" style="display: none;">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">
    <style>
        .side-bar .side-slide .logo {max-height:130px;display:none;}
        @media (min-width: 64em) {  .side-bar .side-slide .logo {display:inline-block;}  }
    </style>
@stop()

@php
    $bonuses = [
        [
            'name' => 'Guitareo Annual Membership',
            'price' => '$' . \App\Prices::$guitareoMembershipAnnual . '/yr',
            'priceColor' => 'orange',
            'fullPrice' => \App\Prices::$guitareoMembershipAnnualFull,
            'discountedPrice' => \App\Prices::$guitareoMembershipAnnual,
            'desc' => 'Get inspired, stay motivated, and crush your goals on guitar with a Guitareo Membership. Perfectly structured, step-by-step lessons you can take whenever, wherever. Easily track your progress with access to every lesson, course, chord chart, jam tracks, and Q&A for one full year. And you’ll get access to REAL teachers who will be able to answer any questions you have along the way.',
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/annual.jpg',
        ],
        [
            'name' => 'GuitarQuest',
            'price' => 'Normally $' . \App\Prices::$guitarQuestFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => '500 Songs In 5 Days is designed to give you the skills and knowledge to quickly learn and play 500 songs from a variety of eras and styles. No memorization needed! Get the tips and tricks for playing almost any popular song, along with downloadable chord charts for 500 songs. So you can play the songs you love as much as you’d like, whenever you want.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d1923uyy6spedc.cloudfront.net/398-product-thumb--1609436919.jpg',
        ],
        [
            'name' => '500 Songs In 5 Days',
            'price' => 'Normally $' . \App\Prices::$songs500Full,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => '500 Songs In 5 Days is designed to give you the skills and knowledge to quickly learn and play 500 songs from a variety of eras and styles. No memorization needed! Get the tips and tricks for playing almost any popular song, along with downloadable chord charts for 500 songs. So you can play the songs you love as much as you’d like, whenever you want.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://guitareo.s3.amazonaws.com/500-songs/cart-image.png',
        ],
        [
            'name' => 'Acoustic Guitar Made Easy',
            'price' => 'Normally $' . \App\Prices::$AGMEFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Get started on the acoustic guitar the right way! With Acoustic Guitar Made Easy, you’ll learn and master the five pillars of the acoustic guitar to build a rock-solid foundation so you can play the songs you love. See your newfound skills in action as you learn to play iconic songs like “Horse With No Name,” “Brown Eyed Girl,” “Let It Be,” “Jambalaya,” and “Take It Easy.” This is your crystal-clear pathway to reaching your guitar goals.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/acoustic-guitar-made-easy.png',
        ],
        [
            'name' => 'Guitar Technique Made Easy',
            'price' => 'Normally $' . \App\Prices::$GTMEFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Better technique starts here! Guitar Technique Made Easy is the step-by-step process for learning the most important guitar techniques. Whether you want to focus on acoustic or electric guitar, this 26-week course will give you the skills and knowledge to pursue any genre or style of music. Break bad habits, and achieve total freedom on the guitar with Guitar Technique Made Easy.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-technique-made-easy.png',
        ]
    ];

    $accordionImgs = [
        [
            'img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/annual.jpg',
            'type' => 'special',
        ],
        [
            'img' => 'https://d1923uyy6spedc.cloudfront.net/398-product-thumb--1609436919.jpg',
            'type' => 'normal',
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/500-songs/cart-image.png',
            'type' => 'normal',
        ],
        [
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/acoustic-guitar-made-easy.png',
            'type' => 'normal',
        ],
        [
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-technique-made-easy.png',
            'type' => 'normal',
        ],
        [
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-system.png',
            'type' => 'normal',
        ],
    ];
@endphp

@section('banner')
    @include('guitareo.shop.elements.promo-banner', [
                "name" => "The Ultimate Lessons Bundle",
                "fullPrice" => App\Prices::$guitareoMembershipAnnualFull,
                "price" => App\Prices::$guitareoMembershipAnnual,
                "specialText" => "5 bonuses worth $885",
                "noBreadcrumb" => true
            ])
@endsection

@section('top')
    @include('guitareo.shop.elements.slider', [
        "headerText" => "<strong>Your ULTIMATE way to learn the guitar.</strong>",
        "videoSrc" => "//player.vimeo.com/video/649717422",
        "videoThumb" => "https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/vid-thumb.jpg",
    ])

    @include('guitareo.shop.elements.sidebar', [
        "bundle" => true,
        "sku" => "products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[guitar-quest]=1&products[GTME-OCT-2018-SEMESTER]=1&products[AGME-JAN-2019-SEMESTER]=1&products[500-songs-in-5-days-guitareo]=1&products[GUITAR-SYSTEM]=1&redirect=/order&locked=true",
        "fullPrice" => App\Prices::$guitareoMembershipAnnualFull,
        "price" => App\Prices::$guitareoMembershipAnnual,
        "specialText" => "+$885 In Bonuses",
        "guaranteeBadge" => true,
        "soldOut" => true,
    ])
@endsection

@section('bottom')
    <div class="shop-accordion">
        <div class="accordion" id="instructorAccordion">
            <div class="accordion-content bundle">
            
        <div class="flex flex-wrap my-7 lg:my-0 lg:mb-7">
            @foreach ($accordionImgs as $img)
                <img class="p-1 rounded-2xl h-auto" style="width:@if($img['type'] == 'special') 44%; @else 28%; @endif" src="{{ $img['img']}}" />
            @endforeach
        </div>
        <p class="leading-normal">This is the ULTIMATE bundle for any guitarist. Whether you're just getting started, taking that next step in your playing, or just looking for new creative ways to have fun on the guitar - this is the bundle for you! With LIFETIME access to every digital lesson pack and a 1-year membership to Guitareo, you'll study any technique imaginable, learn hundreds of songs, and explore your creativity the way you've always wanted on the guitar.</p>

        <hr class="my-5">
        <p><strong>Say hello to your free bonuses:</strong><br>
        <em style="opacity: 0.5;">All digital bonuses are added to your account instantly with your membership to Guitareo and they’re yours for life!</em> </p>

        @include('guitareo.shop.elements.bonuses')
            </div>
        </div>
    </div>
@endsection