@extends('guitareo.shop.product-layout')

@section('head-includes')
    @parent

    <title>The Beginner Quick-Start Bundle</title>
    <meta name="description" content="Thinking of becoming a guitarist? Start here.">
    <meta property="og:description" content="Thinking of becoming a guitarist? Start here.">
    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/beginner/vid-thumb.jpg" style="display: none;">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">
    <style>
        .side-bar .side-slide .logo {max-height:130px;display:none;}
        @media (min-width: 64em) {  .side-bar .side-slide .logo {display:inline-block;}  }
    </style>
@stop()

@php
    $bonuses = [
        [
            'name' => 'GuitarQuest',
            'price' => 'Normally $' . \App\Prices::$guitarQuestFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Music is a language -- and just like you didn’t start talking by understanding prepositions and nouns, you shouldn’t learn guitar by endlessly studying theory. Instead, let’s just start playing! <br /> Follow famous YouTuber and musician Rob Scallon as he takes you on a 9 mission journey where you’ll write songs, shoot a music video, make commercial jingles, and rock out ridiculously hard! So skip the boring stuff and start having fun with GuitarQuest!',
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => false,
            'img' => 'https://d1923uyy6spedc.cloudfront.net/398-product-thumb--1609436919.jpg',
        ],
        [
            'name' => '500 Songs In 5 Days',
            'price' => 'Normally $' . \App\Prices::$songs500Full,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => '500 Songs In 5 Days is designed to give you the skills and knowledge to quickly learn and play 500 songs from a variety of eras and styles. No memorization needed! Get the tips and tricks for playing almost any popular song, along with downloadable chord charts for 500 songs. So you can play the songs you love as much as you’d like, whenever you want.',
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => false,
            'img' => 'https://guitareo.s3.amazonaws.com/500-songs/cart-image.png',
        ],
        [
            'name' => 'The Guitar System',
            'price' => 'Normally $' . \App\Prices::$guitarSystemFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Transform your guitar playing with the ULTIMATE Encyclopedia of Guitar Lessons. From very beginner to advanced, learn anything you want on the guitar with lessons that have been trusted by thousands of guitarists around the world! Whether you want to learn the basic guitar fundamentals, the ins-and-outs of tone, palm muting, guitar theory, or anything else you could possibly need. The Guitar System has it all!',
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => false,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-system.png',
        ]
    ];

    $accordionImgs = array(
        'https://d1923uyy6spedc.cloudfront.net/398-product-thumb--1609436919.jpg',
        'https://guitareo.s3.amazonaws.com/500-songs/cart-image.png',
        'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-system.png'
    );
@endphp

@section('banner')
    @include('guitareo.shop.elements.promo-banner', [
                "name" => "The Beginner Quick-Start Bundle",
                "fullPrice" => 491,
                "price" => App\Prices::$bundleBeginner,
                "noBreadcrumb" => true
            ])
@endsection

@section('top')
    @include('guitareo.shop.elements.slider', [
        "headerText" => "<strong>Thinking of becoming a guitarist?<br> Start here.</strong>",
        "videoSrc" => "//player.vimeo.com/video/649717515",
        "videoThumb" => "https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/beginner/vid-thumb.jpg",
    ])

    @include('guitareo.shop.elements.sidebar', [
        "bundle" => true,
        "logo" => "https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/beginner/logo-black.png",
        "sku" => "products[guitar-quest]=1&products[500-songs-in-5-days-guitareo]=1&products[GUITAR-SYSTEM]=1&locked=true",
        "fullPrice" => 491,
        "price" => App\Prices::$bundleBeginner,
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
                <img class="w-1/3 p-1 rounded-2xl h-auto" src="{{ $img }}">
            @endforeach
        </div>
        <p class="leading-normal">Have you ever wanted to be able to pick up a guitar and start playing your favorite songs? Or be able to start jamming with your friends? Or maybe you want to pursue your dreams as a professional guitarist. No matter what your reasons are, THE BEGINNER QUICK-START BUNDLE is for you. These three digital lesson packs are designed to get you started on the guitar, playing songs and having fun right away! Go on an adventure, learn hundreds of songs, and build your skills on the guitar so you can reach your goals faster. And you get these lessons for a lifetime, so you can keep growing and learning the guitar as much as you want.
            <br><br>
            <em style="opacity: 0.5;">All digital lessons are added to your account instantly.</em> </p>
        <hr class="my-5">

        @include('guitareo.shop.elements.bonuses')
            </div>
        </div>
    </div>
@endsection

     