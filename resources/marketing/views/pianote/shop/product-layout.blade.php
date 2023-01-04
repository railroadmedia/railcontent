@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>{{ $product->name }}</title>
    <meta property="og:description" content="{{ $product->meta_desc  }}">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    @if(!empty($product->meta_img))
        <meta property="og:image" content="@if(str_contains($product->meta_img, 'amazonaws') || str_contains($product->meta_img, 'cloudfront') || str_contains($product->meta_img, 'vimeocdn')) {{$product->meta_img}} @else https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->meta_img  }}@endif">
    @endif

    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <link href="{{ asset('/marketing/parcel/pianote/shop-product.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/tailwind-helpers.css') }}">

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
    @yield('head')
@stop

@section('global-body')
    @include('pianote._partials._nav',[
         "cartVersion" => true
    ])

{{--    @include('pianote._partials._nav', [--}}
{{--        "cartVersion" => true--}}
{{--    ])--}}

    <div class="clearfix container mx-auto max-w-6xl">
        <div class="lg:flex">
            @include('pianote.shop._partials._slider',[
                "headerText" => $product->header_text,
                "specialText" => $product->subheader_text,
                "videoSrc" => $product->video_src,
                "images" => $product->images,
            ])

            @include('pianote.shop._partials._sidebar',[
                "sku" => $product->sku,
                "logo" => $product->page_logo,
                "fullPrice" => $product->price,
                "price"=> $product->discounted_price,
                "guaranteeBadge" => $product->guaranteed,
                "sizes" => $product->sizes,
                "soldOut" => !empty($products[$product->sku]) ? $products[$product->sku]->getStockAvailability() === 0 : $product->sold_out,
                "specialText" => $product->special_text,
                "freeShipping" => $product->free_shipping,
                "size_case_sensitive" => $product->size_case_sensitive,
                "category" => strtolower($product->productType->name),
                'bundle' => $product->productType->name === 'Bundles' || str_contains($product->sku, 'member') || str_contains($product->sku, 'products') ? true : false,
            ])
        </div>

        <div class="product-wrap px-3 md:px-4 lg:w-2/3">
            <div class="pack-details mx-auto mb-7 pb-5 sm:pb-9 lg:pb-11">
                @if($product->productType->name === 'Lessons' && count($product->benefits) > 0)
                    @include('musora.product.partials.benefits',[
                        'benefits' => $product->benefits
                    ])
                @endif

                @if($product->productType->name === 'Bundles' && !empty($product->spread_img))
                    <div class="text-center">
                        <h3 class="mb-4"><strong>What's included:</strong></h3>
                        <img class="mb-4" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/@if(str_contains($product->spread_img, 'amazonaws') || str_contains($product->spread_img, 'cloudfront')){{$product->spread_img}}@else{{'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$product->spread_img}}@endif" alt="bundle spread image" />
                    </div>
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


                @if($product->productType->name === 'Lessons' && !empty($product->instructor_desc))
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


    @include('pianote._partials._footer')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/shop-product.js') }}"></script>
    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    @include('pianote.shop._partials._promo-countdown')
@stop
