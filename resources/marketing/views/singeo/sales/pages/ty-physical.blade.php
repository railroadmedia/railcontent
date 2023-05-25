@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Thank You | Singeo</title>
    <meta property="og:title" content="Thank You | Singeo">

    <meta name="description" content="Perfectly structured step by step lessons, with teachers that are fun to watch, and unlimited support - 100% guaranteed. Learn piano online the easy way.">
    <meta property="og:description" content="Perfectly Structured Lessons, Insanely Engaging Teachers, and Unlimited Support - 100% Guaranteed.">

    <meta property="og:url" content="https://www.singeo.com/thank-you-physical" style="display: none;">
    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}" rel="stylesheet">

    <style>
        body {
            background:#fff;
        }
        .hero-header {
            background: url(https://dmmior4id2ysr.cloudfront.net/homepage/jobs-banner2.jpg);
            background-position: 50% 0;
            background-size: cover;
            text-align: center;
            padding: 70px 15px;
        }
        @media (min-width: 40.0625em) {
            .hero-header {
                padding: 100px 15px;
            }
        }
        @media (min-width: 64.0625em) {
            .hero-header {
                padding: 150px 15px;
            }
        }
        .hero-header h1 {
            color: #FFF;
            text-align: center;
            margin: 0 auto;
            font: 700 28px/1em "Roboto Condensed", sans-serif;
            text-transform: uppercase;
        }
        @media (min-width: 40.0625em) {
            .hero-header h1 {
                font-size: 50px;
            }
        }
        @media (min-width: 64.0625em) {
            .hero-header h1 {
                font-size: 70px;
            }
        }
        .hero-header .logos {
            width: 100%;
            max-width: 100%;
            display: inline-block;
            margin: 0 auto;
        }
        @media (min-width: 40.0625em) {
            .hero-header .logos {
                max-width: 403px;
            }
        }
        @media (min-width: 64.0625em) {
            .hero-header .logos {
                max-width: 564px;
            }
        }
        .hero-header .logos img {
            width: 100%;
            max-width: 90%;
        }
        @media (min-width: 40.0625em) {
            .hero-header .logos img {
                max-width: 85px;
            }
        }
        @media (min-width: 64.0625em) {
            .hero-header .logos img {
                max-width: 110px;
            }
        }
        .hero-header .logos img.top-heavy {
            padding-bottom: 3px;
            padding-top: 2px;
        }
        .hero-header .logos img.bottom-heavy {
            padding-top: 5px;
        }

        .contact-info {
            padding: 40px 0;
            text-align: center;
        }
        .contact-info h1 {
            font: 500 16px/1.4em "Open Sans", sans-serif;
            padding: 0 15px;
        }
        @media (min-width: 40.0625em) {
            .contact-info h1 {
                font-size: 19px;
            }
        }
        @media (min-width: 64.0625em) {
            .contact-info h1 {
                font-size: 25px;
            }
        }
        .contact-info h2 {
            font: 700 16px/1.4em "Open Sans", sans-serif;
            margin-bottom: 15px;
            padding: 0 15px;
        }
        @media (min-width: 40.0625em) {
            .contact-info h2 {
                font-size: 19px;
            }
        }
        @media (min-width: 64.0625em) {
            .contact-info h2 {
                font-size: 20px;
            }
        }
        .contact-info ul {
            list-style-type: none;
            background: none;
            border: none;
            margin: 0 auto;
            padding:0;
        }
        .contact-info ul li:nth-child(odd) p {
            background:#eee;
        }
        .contact-info ul .dd-toggle {
            padding: 15px;
            font: 500 15px/1.3em "Open Sans", sans-serif;
            cursor: pointer;
        }
        @media (min-width: 64.0625em) {
            .contact-info ul .dd-toggle {
                font-size: 18px;
            }
        }
        .contact-info ul .dd-toggle i {
            transition: all .3s;
        }
        .contact-info ul .dd-content {
            font: 400 13px/1.3em "Open Sans", sans-serif;
            padding: 0 1.5rem 15px;
            border: none;
            display: none;
        }
        @media (min-width: 64.0625em) {
            .contact-info ul .dd-content {
                font-size: 15px;
            }
        }
        .contact-info p {
            font: 400 21px/24px "Open Sans", sans-serif;
            margin: 0;
            color: #333;
        }
        .contact-info hr {
            float: left;
            width: 100%;
            margin: 50px auto 40px;
        }
        .contact-info .phone-email {
            margin: 0 auto 40px;
        }
        .contact-info .phone-email .float-left {
            padding: 20px 15px;
        }
        .contact-info .phone-email .float-left:nth-child(2) {
            border: 1px solid #DDD;
            border-width: 1px 0;
        }
        @media (min-width: 40.0625em) {
            .contact-info .phone-email .float-left:nth-child(2) {
                border-width: 0 1px;
            }
        }
        .contact-info .phone-email p {
            font: 400 18px/1.4em "Open Sans", sans-serif;
            color: #000;
            margin: 0 auto;
        }
        .contact-info .phone-email a {
            color: #8300e9;
        }
        .contact-info .phone-email a:hover {
            text-decoration: underline;
        }
        @media (min-width: 64.0625em) {
            .contact-info .phone-email p {
                font-size: 20px;
            }
        }

    </style>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav", [
        "joinVersion" => true,
    ])

    <div class="hero-header">
        <div class="container mx-auto">
            <h1>Thank You</h1>
        </div>
    </div>
    <div class="contact-info">
        <div class="container mx-auto clearfix">
            <h1><strong>Your Order Has Been Successfully Processed!</strong><br> If you have any questions, don't hesitate to contact us.</h1>
            <br>
            <br>
            <div class="phone-email w-full">
                <div class="md:w-1/3 float-left px-3 md:px-4 w-full">
                    <p><strong>Contact Us</strong><br>
                        <a class="text-blue-600" href="{{ get_musora_brand_base_url() }}/contact">here</a></p>
                </div>
                <div class="md:w-1/3 float-left px-3 md:px-4 w-full">
                    <p><strong>International</strong><br>
                        <a href="tel:+16048557605">1-604-855-7605</a>
                    </p>
                </div>
                <div class="md:w-1/3 float-left px-3 md:px-4 w-full">
                    <p><strong>USA & Canada</strong><br>
                        <a href="tel:+18004398921">1-800-439-8921</a></p>
                </div>
            </div>
        </div>
    </div>

    @include("singeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    @yield('scripts')
@stop
