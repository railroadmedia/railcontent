@extends('guitareo._partials.global-layout')

@section('meta')
    @parent
    <title>Add Guitareo To Your Phone or Tablet | Guitareo.com</title>
    <meta name="description" content=""/>

    <meta property="og:url" content="https://www.guitareo.com/welcome/3"/>
    <meta property="og:title" content="Add Guitareo To Your Phone or Tablet"/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/og-image3.jpg"/>
@stop()

@section('styles')
    @parent
    @include('_partials.layout._tailwindcdn')
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}" rel="stylesheet">
    <style>
        .expired {
            padding:30px 0 70px;
        }
        @media (min-width:40em) {
            .expired {
                padding:80px 0;
            }
        }
        @media (min-width:64em) {}
        .expired h1 {
            font:700 25px/1.2em "Open Sans", sans-serif;
            margin:0 auto 15px;
        }

        @media (min-width:40em) {
            .expired h1 {
                font-size:31px;
            }
        }

        @media (min-width:64em) {
            .expired h1 {
                font-size:40px;
                margin:0 auto 25px;
            }
        }

        .expired p, .expired li {
            font:400 16px/1.5em "Open Sans", sans-serif;
            margin:0 auto 10px;
        }

        @media (min-width:40em) {
            .expired p, .expired li {
                margin:0 auto 15px;
            }
        }

        @media (min-width:64em) {
            .expired p, .expired li {
                font-size:19px;
                margin:0 auto 20px;
            }
        }
        .expired li {
            margin-bottom:10px;
        }
        .expired .join {
            display:inline-block;
            font:700 20px/1em "Bebas Neue", sans-serif;
            text-transform:uppercase;
            background:#00C9AC;
            border-radius:5px;
            color:#FFF;
            padding:17px 7%;
            cursor:pointer;
        }

        @media (min-width:40em) {
            .expired .join {
                font-size:28px;
            }
        }

        .expired .join:hover {
            background:#00e0bf;
        }
    </style>
@stop()

@section('scripts')
    @parent
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop()

@section('content')
    @include("guitareo.sales.partials._nav")

    <section class="expired text-center">
        <div class="container mx-auto">
            <h1>Add Guitareo To Your<br class="inline md:hidden">
                Phone or Tablet</h1>
            <div class="tw-aspect-16:9 w-full relative mt-5 mb-7">
                <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/282035607" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
            <div class="text-left px-2 md:px-3 w-full" style="max-width: 820px; margin: 0 auto;">
                <p>Guitareo is designed to look great on any device.  Here's how you can quickly add it to the homepage on your iPhone or iPad.  Perhaps someone with an Android phone/tablet can reply with instructions for doing the same on that platform.</p>
            <ol>
                <li>Open Safari and visit <a href="/">guitareo.com</a></li>
                <li><a href="/login">Log into your account</a> and visit the homepage.</li>
                <li>Click the <i class="fa-light fa-arrow-square-up" style="color:#0060ff;"></i> share icon at the bottom of Safari. You may need to scroll to the top of the browser page to display the Safari toolbar.</li>
                <li>Select "Add To Home Screen" from the available options (may need to scroll sideways).</li>
                <li>Enter a short name like "Lessons" and click "Add".</li>
            </ol>
                <p>That's it! The mobile site will now be listed on your iOS home screen, so you can quickly access it anytime.  We hope to add a mobile app in the future, but until then this is the best way to use the site on iOS.<br><br></p>
            </div>
            <a href="{{ get_musora_brand_base_url() }}/guitareo/forums" class="join">Ask A Question On The Forums &raquo;</a>
        </div>
    </section>

    @include("guitareo.sales.partials._footer")
@stop
