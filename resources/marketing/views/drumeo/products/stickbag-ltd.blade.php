@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>StickBag | Drumeo</title>
    <meta property="og:title" content="StickBag | Drumeo">

    <meta name="description" content="Pack like a pro.">
    <meta property="og:description" content="Pack like a pro.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/stickbag/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/stickbag/">

    @include('_partials.layout._fonts')
    <?php \App\Analytics\Tracker::trackProductImpression('Drumeo-VaterSticks'); ?>

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join.outline.blue {
            border-color:#0b76db;
            color:#0b76db;
        }

        .content-section table.comparison.eardrums tr td:nth-child(1),
        .content-section table.comparison.eardrums tr td:nth-child(2),
        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            width: 25%;
        }
        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td:nth-child(1),
            .content-section table.comparison.eardrums tr td:nth-child(2),
            .content-section table.comparison.eardrums tr td:nth-child(3),
            .content-section table.comparison.eardrums tr td:nth-child(4) {
                width: 26%;
            }
        }
        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            color: #3E4145;
            background-color: #A2AEBD;
        }
        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(3),
        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(4) {
            background-color:#8996A5;
        }
        .content-section table.comparison tr:hover td:nth-child(3),
        .content-section table.comparison tr:hover td:nth-child(4),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(3),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(4) {
            background-color:#abb8c7;
        }
        .content-section table.comparison.eardrums tr td {
            color:#fff;
            padding:15px 7px;
            font-size:12px;
            text-transform:none;

        }
        .content-section table.comparison.eardrums tr:last-child td strong {
            font-size: 16px;
        }
        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td {
                font-size:16px;
            }
            .content-section table.comparison.eardrums tr:last-child td strong {
                font-size: 28px;
            }
        }
        .content-section table.comparison.eardrums tr td:nth-child(1) {
            text-transform:uppercase;
        }
        @media (max-width: 767px) {
            table tr td:nth-child(3),
            table tr td:nth-child(4) {
                cursor:pointer;
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
    </style>

    @php $memberPrice = floatval($productPrices['Drumeo-VaterSticks']->discounted_price) @endphp
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
                "name" => "StickBag",
                "fullPrice" => floatval($productPrices['Drumeo-VaterSticks']->price),
                "price" => $memberPrice,
                "noBreadcrumb" => true
            ])

    @include('drumeo.products.partials._stickbag',[
    "blackBag" => true,
])

    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}" defer></script>
    <script>
        $(document).ready(function () {
            $('table tr td:nth-child(3)').on('click', function(){
                $(this).parents().find('table').removeClass('earbuds');
                $(this).parents().find('table').addClass('headphones');
            });
            $('table tr td:nth-child(4)').on('click', function(){
                $(this).parents().find('table').removeClass('headphones');
                $(this).parents().find('table').addClass('earbuds');
            });
        });
    </script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" defer></script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js" defer></script>
@stop
