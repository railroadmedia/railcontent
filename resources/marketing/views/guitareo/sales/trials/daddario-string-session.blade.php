@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <title>The D’Addario String Session</title>
    <meta property="og:title" content="The D’Addario String Session">

    <meta name="description" content="Get all your burning questions answered as we dive deep into all sorts of guitar accessories."/>
    <meta property="og:description" content="Get all your burning questions answered as we dive deep into all sorts of guitar accessories." />

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/sales/trials/daddario-string-session/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="/assets/marketing/song-in-an-hour.css">

    <style>
        .text-yello {
            color: #FFAE00;
        }

        .text-navy {
            color:#A4AFC7;
        }

        .header {
            background-size: cover;
            background-position-x: center;
        }

        .teacher-section {
            background-position:50% 0;
            background-size: 380px;
            background-color: #000C17;
            background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/trials/daddario-string-session/coach_bg_mobile.jpg');
        }

        @media (min-width: 768px) {
            .teacher-section {
                background-size: 1600px;
                background-position: center;
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/trials/daddario-string-session/coach_bg.jpg');
            }
        }

        @media (min-width: 1024px) {
            .teacher-section {
                background-size: 1800px;
            }

            .header {
                background-size: 1400px;
                background-position:center;
            }
        }
        
    </style>
@stop

@section('layout-scripts')
    @parent
    <script src="/assets/js/sign-up-form.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
@stop

@php
    $day = str_contains(Request::path(), 'ga') ? 7 : 30;
@endphp

@section('layout-body')
    <header class="header tw-text-white tw-text-center tw-bg-no-repeat tw-px-3 tw-pt-2 tw-pb-10 sm:tw-py-2 lg:tw-py-8 tw-relative lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://guitareo.s3.amazonaws.com/sales/trials/daddario-string-session/header_bg.jpg" style="background-color:#000C17;">
        <div class="tw-container tw-mx-auto tw-relative tw-z-10">
            <p class="tw-flex tw-items-center tw-justify-center tw-mt-12 md:tw-mt-8 lg:tw-mt-0 tw-mb-2"><em class="text-navy">Hosted by</em> <img class="tw-h-6 md:tw-h-8 lg::tw-h-10 tw-pl-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_640,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png" /></p>
            <h1 class="tw-uppercase font-bebas">The <span class="text-guitareo">D’Addario</span> String Session</h1>
            <p class="tw-leading-normal tw-uppercase tw-tracking-wider text-yellow tw--mt-2 md:tw--mt-3 tw-mb-64 lg:tw-mb-60">Live Q&A With D’Addario’s<br class="tw-inline sm:tw-hidden"> Brian Vance</p>
            
            

            <h3 class="font-bebas tw-uppercase"><span class="text-yello">LIVE</span> | <span class="text-yello">March 25th @ 12:00 PST</span> | <br class="tw-inline sm:tw-hidden">Free For Player Circle Members</h3>
            <em class="text-navy">
                Get all your burning questions answered as we dive deep into strings,<br class="tw-hidden sm:tw-inline"> capos, tuners, and all sorts of guitar accessories. 
            </em>
            <p class="tw-my-4 tw-leading-tight">
                Join Guitareo FREE for {{ $day }} days and get access to this exclusive <br class="tw-hidden sm:tw-inline">
                LIVE Q&A only for D’Addario Player Circle Members.
            </p>
            <a class="join" href="@if(str_contains(Request::path(), 'ga')) /ecommerce/add-to-cart?products[GUITAREO-7-DAY-TRIAL-ONE-TIME]=1&redirect=/order&locked=true @else /ecommerce/add-to-cart?products[guitareo_access_30-days]=1&redirect=/order&locked=true&promo-code=daddario @endif">Reserve Your Free Spot &raquo;</a>
            <p class="tw-uppercase font-bebas tw-leading-none tw-mt-4">
                <span class="text-guitareo">JOIN GUITAREO FREE FOR {{ $day }} DAYS</span><br>
                <span class="text-navy">(@if(!str_contains(Request::path(), 'ga')) NO AUTO-RENEWALS, @endif NO HIDDEN CHARGES )</span>
            </p>
        </div>
    </header>
    @if(!str_contains(Request::path(), 'ga'))
    @include('lead-gen.partials._meet-your-teacher2',[
        "headLine" => '<h3 class="tw-font-bold tw-mb-1">You Love Your Guitar.</h3>
        <em class="lg:tw-text-lg text-yellow">
            So prove it with the best knowledge and accessories.
        </em>',
        "description" => 'Your guitar is so much more than wood and steel. But you already know that. <br><br>
        Learn how to care for and get the most out of your guitar from <strong>D’Addario’s VP of Strings and Accessories, Brian Vance, in this live masterclass.</strong><br><br>
        You’ll learn the correct strings for any guitar or style, what matters (and what doesn’t) when shopping for accessories, and you’ll get the exclusive chance to ask Brian your biggest guitar-related questions.<br><br>
        A little bit of knowledge goes a long way.<br>
        So take your guitar to new places, and join the D’Addario String Session.<br><br>
        Click any button to begin a free, non-recurring Guitareo Membership and save your spot. <br><br>
        No hidden charges, no sneaky auto-renewals, just a free membership…<br><br>
        …only for Player’s Circle Members.',
        "gradient" => '<div class="tw-absolute tw-bottom-0 tw-left-0 tw-right-0 tw-h-28" style="background:linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, rgba(3, 37, 70, 0.5) 100%);"></div>'
    ])
    @else
        @include('lead-gen.partials._meet-your-teacher2',[
            "headLine" => '<h3 class="tw-font-bold tw-mb-1">You Love Your Guitar.</h3>
            <em class="lg:tw-text-lg text-yellow">
                So prove it with the best knowledge and accessories.
            </em>',
            "description" => 'Your guitar is so much more than wood and steel. But you already know that. <br><br>
            Learn how to care for and get the most out of your guitar from <strong>D’Addario’s VP of Strings and Accessories, Brian Vance, in this live masterclass.</strong><br><br>
            You’ll learn the correct strings for any guitar or style, what matters (and what doesn’t) when shopping for accessories, and you’ll get the exclusive chance to ask Brian your biggest guitar-related questions.<br><br>
            A little bit of knowledge goes a long way.<br>
            So take your guitar to new places, and join the D’Addario String Session.<br><br>
            Click any button to begin a free, Guitareo Membership and save your spot. <br><br>
            No hidden charges, just a free membership…<br><br>
            …only for Player’s Circle Members.',
            "gradient" => '<div class="tw-absolute tw-bottom-0 tw-left-0 tw-right-0 tw-h-28" style="background:linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, rgba(3, 37, 70, 0.5) 100%);"></div>'
        ])

    @endif

    <section class="tw-text-center tw-text-white tw-bg-no-repeat tw-bg-cover tw-bg-center tw-py-24 lazyload" style="background-color: black;" data-bg="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://guitareo.s3.amazonaws.com/sales/trials/daddario-string-session/order_bg.jpg">
        <p class="tw-flex tw-items-center tw-justify-center tw-mb-2"><em class="text-navy">Hosted by</em> <img class="tw-h-6 md:tw-h-8 lg::tw-h-10 tw-pl-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_640,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png" /></p>
        <h1 class="tw-uppercase font-bebas">The <span class="text-guitareo">D’Addario</span> String Session</h1>
        <p class="tw-leading-normal tw-uppercase tw-tracking-wider text-yellow tw--mt-2 tw-mb-6">Live Q&A With D’Addario’s<br class="tw-inline sm:tw-hidden"> Brian Vance</p>
        <a class="join" style="background:#00C9AC;" href="@if(str_contains(Request::path(), 'ga')) /ecommerce/add-to-cart?products[GUITAREO-7-DAY-TRIAL-ONE-TIME]=1&redirect=/order&locked=true @else /ecommerce/add-to-cart?products[guitareo_access_30-days]=1&redirect=/order&locked=true&promo-code=daddario @endif">Reserve Your Free Spot &raquo;</a>
        <p class="tw-uppercase tw-leading-none font-bebas tw-mt-3">
            <span class="text-guitareo">Join guitareo free for {{ $day }} days</span><br>
            <span class="text-navy">(@if(!str_contains(Request::path(), 'ga')) NO AUTO-RENEWALS, @endif no hidden charges )</span>
        </p>
    </section>
@stop