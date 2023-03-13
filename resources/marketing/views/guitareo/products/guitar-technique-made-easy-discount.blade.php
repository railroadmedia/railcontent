@extends('guitareo.products.guitar-technique-made-easy-layout')
@section('styles')
    @parent

    <style>
        .special-promo-banner-shim {
            display:block;
            width:100%;
            height:44px
        }
        @media (min-width: 40em) {
            .special-promo-banner-shim {
                height:46px
            }
        }

        .special-promo-banner {
            display:block;
            background:#444;
            text-align:center;
            color:#fff;
            width:100%;
            transition:opacity .5s, background-color .3s;
            overflow:hidden;
            position:relative;
            box-shadow:0 0 10px rgba(0, 0, 0, .2);
            z-index:1;
            padding:7px 0;
        }
        @media (min-width: 40em) {
            .special-promo-banner.fixed {
                top:56px;
                position:fixed;
                z-index:97;
                margin:0 auto
            }
        }

        .special-promo-banner:active,
        .special-promo-banner:hover {
            background:#555;
            color:#eee;
            text-decoration:none
        }

        .special-promo-banner p {
            font:400 13px/1.2em Roboto Condensed, sans-serif;
            margin:0 auto;
            text-align:center;
            display:inline-block;
            vertical-align:middle
        }
        @media (min-width: 40em) {
            .special-promo-banner p {
                font-size:14px;
            }

        }
        .special-promo-banner p .text-green {
            color:#00BC75;
        }
    </style>
    @stop
@section('topbar')
    <div class="special-promo-banner-shim show-for-medium"></div>
    <a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['GTME-OCT-2018-SEMESTER' => 1], 'redirect' => '/order', 'promo-code' => 'special-discount']) }}" class="special-promo-banner fixed">
        <p><strong>STARTER KIT STUDENTS:</strong> YOUR $100 DISCOUNT IS<br>
            AUTOMATICALLY APPLIED ON THIS PAGE. <strong class="text-green">GET STARTED &raquo;</strong></p>
    </a>
@stop
@section('button-change')
    <a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['GTME-OCT-2018-SEMESTER' => 1], 'redirect' => '/order', 'promo-code' => 'special-discount']) }}" class="join made-easy">Get Started &raquo;</a>
@stop

@section('custom-price')
    <s>NORMALLY ${{ floatval($productPrices['GTME-OCT-2018-SEMESTER']->price) }}.</s> &nbsp;<strong style="color:#00BC75;"><u>ONLY $97</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (97 / floatval($productPrices['GTME-OCT-2018-SEMESTER']->price)))) }}%)
@stop

@section('custom-price-2')
    ${{ number_format((97 / 26), 2, '.', ',') }}
@stop

@section('custom-price-3')
    <s>Was ${{ floatval($productPrices['GTME-OCT-2018-SEMESTER']->price) }}.</s> <strong>Only $97.</strong>
@stop

@section('benefits')
    <div class="columns no-padding benefit-row">
        <div class="columns medium-6 float-right">
            <div class="arrow-outline">
                <img src="https://d122ay5chh2hr5.cloudfront.net/gtme/bubble1.jpg">
            </div>
        </div>
        <div class="columns medium-6 text-wrap">
            <h1>Your Weekly Guitar Coach</h1>
            <p>Guitar Technique Made Easy is a 26-week course where you’ll follow Nate Savage’s proven step-by-step process for learning the most important guitar techniques.
                <br><br>
                <strong>Each week, you will have a new lesson with very specific instructions on exactly what to practice, how long to practice for, and when to mark it as complete.</strong>
            </p>
        </div>
    </div>
    <div class="columns no-padding benefit-row">
        <div class="columns medium-6">
            <div class="arrow-outline right">
                <img src="https://d122ay5chh2hr5.cloudfront.net/gtme/bubble2.jpg">
            </div>
        </div>
        <div class="columns medium-6 text-wrap">
            <h1>No Shortcuts, Cheats, or Hacks</h1>
            <p>Unlike many other guitar programs that intentionally skip important steps to give you the illusion that you’re making progress, Guitar Technique Made Easy gives you a complete guitar foundation free of any holes or gaps so you can go on to play ANY style of music.
                <br><br>
                <strong>Whether you want to focus on acoustic or electric guitar, this 26-week course will give you the skills and knowledge to pursue any genre of music.</strong>
            </p>
        </div>
    </div>
    <div class="columns no-padding benefit-row">
        <div class="columns medium-6 float-right">
            <div class="arrow-outline">
                <img src="https://d122ay5chh2hr5.cloudfront.net/gtme/bubble3.jpg">
            </div>
        </div>
        <div class="columns medium-6 text-wrap">
            <h1>Always Know Exactly What To Practice</h1>
            <p>Guitar Technique Made Easy is the ONLY course on technique that will get easier to complete as you go along - making it easier to stay motivated, easier to enjoy your practice time again, and easier to actually COMPLETE the course and experience massive improvements in your playing for once and for all!
                <br><br>
                <strong>With assignments for every skill level in each lesson, you’ll have everything you need to build up positive momentum and make faster progress each week no matter where your playing is at.</strong>
            </p>
        </div>
    </div>
@stop
