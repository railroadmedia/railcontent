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
    <link href="{{ asset('/marketing/css/guitareo/tailwind-helpers.css') }}" rel="stylesheet">
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
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="/marketing/parcel/guitareo/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/guitareo/shop-product.js"></script>
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
                "specialText" => $product->subheader_text,
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

    @yield('bottom-banner')
    @include("guitareo.sales.partials._footer")
@endsection
