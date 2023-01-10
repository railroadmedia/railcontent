@extends($brand.'._partials.layout')

@section('head-includes')
    <title>{{ $product->name }}</title>
    <meta property="og:description" content="{{ $product->meta_desc  }}}">
    <meta property="og:url" content="">
    @if(!empty($product->meta_img))
        <meta property="og:image" content="@if(str_contains($product->meta_img, 'amazonaws') || str_contains($product->meta_img, 'cloudfront')) {{$product->meta_img}} @else https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->meta_img  }}@endif">
    @endif

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/css/drumeo/navigation-sales.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/css/shop-product.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>

    @parent
@stop

@section('layout-body')
    <div class="clearfix mx-auto mx-auto max-w-6xl">
        <div class="lg:flex">
            @include('musora.product.partials.slider',[
                "headerText" => $product->header_text,
                "videoSrc" => $product->video_src,
                "images" => $product->images,
            ])

            @include('musora.product.partials.sidebar',[
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
            ])
        </div>

        <div class="product-wrap lg:w-2/3 px-3 md:px-4">
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
                        <em style="opacity: 0.5;">All digital bonuses are added to your account instantly with your membership to {{ $brand }}, and they’re yours forever.</em>
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
@stop

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/js/drumeo/pack-drumshop.js')  }}"></script>

    <script>
        $(document).ready(function(){

            $('.slick-current img').addClass('border-{{$brand}}');
            $('.slick-current img').removeClass('border-white');

            $(".slick-slide").on('click',function(){
                let slides = $('.slide-img', '.slick-slide');
                slides.addClass('border-white')
                slides.removeClass('border-{{$brand}}');

                $('img', this).removeClass('border-white');
                $('img', this).addClass('border-{{$brand}}');
            })
        })
    </script>
@stop


