@extends('guitareo._partials.global-layout')

@section('styles')
    @parent
    <title>{{ $product->name }}</title>
    <meta property="og:description" content="{{ $product->meta_desc  }}}">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">
    @if(!empty($product->meta_img))
        <meta property="og:image" content="@if(str_contains($product->meta_img, 'amazonaws') || str_contains($product->meta_img, 'cloudfront')) {{$product->meta_img}} @else https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->meta_img  }}@endif">
    @endif
    <link rel="preload" href="{{ mix('marketing/css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}"></noscript>
    <link href="{{asset('/marketing/css/guitareo/tailwind-helpers.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link href="{{ asset('/marketing/parcel/guitareo/shop-product.css') }}" rel="stylesheet">

    <?php
        if(count($product->sizes) > 0){
            foreach($product->sizes as $size){
                \App\Analytics\Tracker::trackProductImpression($product->sku.'-'.(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code);
            }
        }
        else {
            \App\Analytics\Tracker::trackProductImpression($product->sku);
        }
    ?>

    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
        }

        .big-promo-banner{position:relative;z-index:98;text-align:center;text-transform:uppercase;color:#193b8b}@media (min-width:991px){.big-promo-banner{text-align:left}}.big-promo-banner .noise-wrap{padding:10px 0}.big-promo-banner .row{padding:0 15px;margin:0 auto}@media (min-width:768px){.big-promo-banner .row{display:flex;align-items:center}}.big-promo-banner img{min-width:150px;width:150px;display:inline-block}@media (min-width:991px){.big-promo-banner img{min-width:200px;width:200px}}.big-promo-banner .text-right{flex-grow:1}.big-promo-banner h1.logo{color:#000;margin:0 auto;font-size:25px}@media (min-width:768px){.big-promo-banner h1.logo{font-size:28px}}@media (min-width:991px){.big-promo-banner h1.logo{font-size:35px}}.big-promo-banner p{font:400 17px/1.2em Bebas Neue,sans-serif;text-transform:uppercase;display:inline-block;margin:0 auto}@media (min-width:768px){.big-promo-banner p{font-size:18px}}@media (min-width:991px){.big-promo-banner p{font-size:20px;margin:0 auto;white-space:nowrap}}.big-promo-banner p strong{display:inline-block}.big-promo-banner .tzcd-big{text-transform:uppercase;display:inline-block;vertical-align:middle;margin:0 0 0 7px}@media (min-width:991px){.big-promo-banner .tzcd-big{margin:0 0 0 15px}}.big-promo-banner .tzcd-big div{float:left;text-align:center;padding:0 7px 0 0}@media (min-width:991px){.big-promo-banner .tzcd-big div{padding:0 10px 0 0}}.big-promo-banner .tzcd-big div:last-child{padding-right:0}.big-promo-banner .tzcd-big div h1{margin:0 auto;font:900 21px/1em Open Sans,sans-serif;display:block}@media (min-width:991px){.big-promo-banner .tzcd-big div h1{font-size:28px}}.big-promo-banner .tzcd-big div p{font:800 10px/1em Open Sans,sans-serif;display:block;color:#000;margin:0 auto}
        .promo-banner-shim{display:block;width:100%;height:40px}.promo-banner{display:block;background:#ddf7ff 50%/cover;text-align:center;color:#193b8b;width:100%;transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Bebas Neue,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:#000;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;text-transform:uppercase;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="/marketing/parcel/guitareo/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/guitareo/shop-product.js"></script>
    <script src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Countdown
            $('.tzcd-full').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
    </script>
@endsection

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])

    @yield('banner')

    <div class="clearfix container mx-auto max-w-6xl">
        <div class="lg:flex">
            @include('guitareo.shop._partials.slider',[
                "headerText" => $product->header_text,
                "videoSrc" => $product->video_src,
                "images" => $product->images,
            ])

            @include('guitareo.shop._partials.sidebar',[
                "sku" => $product->sku,
                "logo" => $product->page_logo,
                "fullPrice" => $product->price,
                "price"=> $product->discounted_price === '0.00' || empty($product->discounted_price) ? $product->price : $product->discounted_price,
                "guaranteeBadge" => $product->guaranteed,
                "sizes" => $product->sizes,
                "soldOut" => $product->sold_out,
                "specialText" => $product->special_text,
                "freeShipping" => $product->free_shipping,
                "size_case_sensitive" => $product->size_case_sensitive,
                "category" => strtolower($product->productType->name),
            ])
        </div>

        <div class="product-wrap px-3 md:px-4 lg:w-2/3">
            <div class="pack-details mx-auto mb-7 pb-5 sm:pb-9 lg:pb-11">
                @if($product->productType->name === 'Lessons')
                    @include('musora.product.partials.benefits',[
                        'benefits' => $product->benefits
                    ])
                @endif

                @if(!empty($product->overview))
                    @include('musora.product.partials.overview',[
                        "overview" => $product->overview,
                    ])
                @endif

                @if($product->productType->name === 'Bundles')
                    <hr class="my-8" />

                    <p class="mb-4">
                        <strong>Say hello to your free bonuses:</strong><br>
                        <em style="opacity: 0.5;">All digital bonuses are added to your account instantly with your membership to {{ $theme }}, and they’re yours forever.</em>
                    </p>

                    @include('musora.product.partials.bonuses')
                @else
                    @include('musora.product.partials.specs',[
                        'specList'=> $product->specs,
                        'featureList' => $product->productType->name !== 'Bundles' && $product->productType->name !== 'Lessons' ? $product->features : [],
                    ])
                @endif


                @if($product->productType->name === 'Lessons')
                    @include('musora.product.partials.instructor',[
                        "instructorPhoto" => $product->product_img,
                        "instructorBio" => $product->instructor_desc
                    ])

                    @include('musora.product.partials.topics',[
                        "topicList" => $product->features
                    ])
                @endif

                @if(!empty($product->size_chart_id))
                    <img class="mt-10" src="https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->sizeChart->chart }}" alt="size chart" />
                @endif
            </div>
        </div>
    </div>

    @include("guitareo.sales.partials._footer")
@endsection
