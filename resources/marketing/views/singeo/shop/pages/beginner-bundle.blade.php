@extends('singeo.shop.product-layout')

@section('head-includes')
    @parent

    <title>The Beginner Bundle</title>
    <meta name="description" content="You CAN Sing! And this is the perfect place to start.">
    <meta property="og:description" content="You CAN Sing! And this is the perfect place to start.">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/promos/november/bundles/beginner-thumb.jpg" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
    <style>
        .side-bar .side-slide .logo {max-height:130px;display:none;}
        @media (min-width: 64em) {  .side-bar .side-slide .logo {display:inline-block;}  }
    </style>
@stop()

@php
    $bonuses = [
        [
            'name' => '6-Month Singeo Membership',
            'price' => '$90/six months',
            'priceColor' => 'orange',
            'fullPrice' => SingeoPrices::$singeoMembership6Month,
            'discountedPrice' => 90,
            'desc' => 'Take your voice to new levels without the huge commitment (and the extra cost). Get unlimited access to singing lessons, routines, and a karaoke library with hundreds of your favorite songs for fun practice. Submit performance videos and receive feedback from your teachers during our weekly Live Q&A sessions, or reach out to our support team any time you have questions.',
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/6mo.jpg',
        ],
        [
            'name' => 'The Singing Starter Kit',
            'price' => 'Normally $19',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => '0',
            'desc' => 'Have the basics at your fingertips with lifetime access to the Singing Starter Kit. This 6-lesson mini-course will show you the "must-know" basics of singing, and how to practice so you reach your singing goals faster. Whether you’re using it for the very first time or the 100th time, the Singing Starter Kit will keep your voice healthy and strong.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/singing-starter-kit.jpg',
        ]
    ];
@endphp

@section('banner')
    @include('singeo.shop.partials.promo-banner', [
                "name" => "The Beginner Bundle",
                "fullPrice" => SingeoPrices::$singeoMembership6MonthFull,
                "price" => SingeoPrices::$singeoMembership6Month,
                "noBreadcrumb" => true
            ])
@endsection

@section('top')
    @include('singeo.shop.partials.slider', [
        "headerText" => "<strong>You CAN Sing! And this is the perfect place to start.</strong>",
        "videoSrc" => "//player.vimeo.com/video/649113554",
        "videoThumb" => "https://singeo.s3.amazonaws.com/sales/promos/november/bundles/beginner-thumb.jpg",
        "noSlider" => true
    ])

    @include('singeo.shop.partials.sidebar', [
        "logo" => "https://singeo.s3.amazonaws.com/sales/promos/november/bundles/beginner-logo.png",
        "bundle" => true,
        "sku" => "products[singeo-6-month-recurring-membership]=1&products[singing-starter-kit]=1&locked=true",
        "fullPrice" => SingeoPrices::$singeoMembership6MonthFull,
        "price" => SingeoPrices::$singeoMembership6Month,
        "specialText" => "+$19 In Bonuses",
        "guaranteeBadge" => true,
        "soldOut" => true,
    ])
@endsection

@section('bottom')
    {{--<div class="flex-images two">--}}
    {{--<img class="special" src="https://singeo.s3.amazonaws.com/sales/promos/november/6mo.jpg">--}}
    {{--<img src="https://singeo.s3.amazonaws.com/sales/promos/november/singing-starter-kit.jpg">--}}
    {{--</div>--}}
    <p>You already have everything you need to learn how to sing - YOUR VOICE!
        <br><br>
        You can sing anywhere, anytime - no expensive instruments required.
        <br><br>
        And you most likely already have some experience with singing (Happy Birthday qualifies as “some experience”). So you can already feel confident about your first lesson!
        <br><br>
        The Beginner Bundle will set you up with the “must-know” basics of singing - while helping you develop a stronger, more confident singing voice.</p>
    {{--<br><br>--}}
    {{--<strong>Say hello to your free bonuses:</strong><br>--}}
    {{--<em style="opacity: 0.5;">All digital bonuses are added to your account instantly with your membership to Singeo and they’re yours forever!</em>--}}
    <hr class="tw-my-5">

    @include('singeo.shop.partials.bonuses')
@endsection
