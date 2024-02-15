@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Book Bag | Pianote</title>
    <meta property="og:title" content="BookBag | Pianote">

    <meta name="description" content="A handcrafted premium leather satchel for your music books, laptop, and life.">
    <meta property="og:description" content="Leather satchel for your music books, laptop, and life.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/pianote/products/book-bag/book-bag-share-image.webp">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join.outline.red {
            border-color: #F61A30;
            color: #0b76db;
        }

        .join.smaller.outline {
            padding: 12px 7%;
            border-color: #F61A30;
            background-color: rgb(18, 18, 6, 0.3);
        }

        .join.smaller.outline:hover {
            background-color: #F61A30;
            color: #FFFFFF;
        }

        .join i {
            transition: all .3s;
            position: relative;
            right: 0;
        }

        .translate-x-2 {
            transform: translateX(0.2rem);
        }

        .playfair {
            font-family: "Playfair Display", serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
        }

        .playfair-light {
            font-family: "Playfair Display", serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .content-section table.comparison.eardrums tr td:nth-child(1) {
            width: 1%;
            font-weight: 700;
            text-align: left;
        }

        .content-section table.comparison.eardrums tr td:nth-child(2) {
            color: #5B6068;
            background-color: #F1EFED;
        }

        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(2) {
            background-color: #D7D3CF;
        }

        .content-section table.comparison.eardrums tr td:nth-child(2),
        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            width: 27.33%;
            border: none;
        }

        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            color: #5B6068;
            background-color: #DBE1E9;
        }

        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(3),
        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(4) {
            background-color: #CDD4DC;
        }

        .content-section table.comparison tr:hover td:nth-child(3),
        .content-section table.comparison tr:hover td:nth-child(4),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(3),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(4) {
            background-color: #CDD4DC;
        }

        .content-section table.comparison tr:hover td:nth-child(2),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(2),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color: #D7D3CF;
        }

        .content-section table.comparison.eardrums tr td {
            color: black;
            padding: 15px 7px;
            font-size: 12px;
            text-transform: capitalize;
        }

        .content-section table.comparison.eardrums tr:last-child td {
            padding: 15px 7px 30px;
        }

      

        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td {
                font-size: 16px;
            }
            .content-section table.comparison.eardrums tr:nth-child(2n) td strong {
                font-size: 28px;
                color: #5B6068;
            }
            .content-section table.comparison.eardrums tr:last-child td strong {
            font-size: 40px;
        }

        .content-section table.comparison.eardrums tr:last-child td s {
            font-size: 40px;
            color: rgb(0, 0 ,0, 0.4); 
            font-weight:400;

        }
        }

        .content-section table.comparison.eardrums tr td:nth-child(1) {
            text-transform: capitalize;
        }

        @media (max-width: 767px) {
            table tr td:nth-child(3),
            table tr td:nth-child(4) {
                cursor: pointer;
            }

            .earbuds tr td:nth-child(3) {
                display: table-cell;
            }

            .earbuds tr td:nth-child(4) {
                display: none;
            }

            .headphones tr td:nth-child(4) {
                display: table-cell;
            }

            .headphones tr td:nth-child(3) {
                display: none;
            }
        }

        table.comparison {
            border-spacing: 15px 0;
            cursor: pointer;
            @media (max-width: 767px) {
                border-spacing: 7px 0;
            }
        }
    </style>
@stop

@section('body-data')
    x-data="{
    trailer: false,
    trailerM: false,
    }"
@endsection

@section('global-body')
    @include("pianote.sales.partials._nav", [
        "cartVersion" => true
    ])
    <!-- @include('_partials.components.shop.promo-banner', [
        "name" => "Drumeo StickBag",
        "fullPrice" => floatval($productPrices['stickbag']->price),
        "price" => floatval($productPrices['stickbag']->discounted_price),
        "noBreadcrumb" => true
    ]) -->


    @include('pianote.products.partials._book-bag-part')

    @include("pianote.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
