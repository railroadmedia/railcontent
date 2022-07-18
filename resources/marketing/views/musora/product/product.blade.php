@extends($theme.'._partials.layout')

@section('head-includes')
    <title>{{ $product->name }}</title>
    <meta property="og:description" content="{{ $product->meta_desc  }}}">
    <meta property="og:url" content="">
    <meta property="og:image" content="@if(str_contains($product->meta_img, 'amazonaws') || str_contains($product->meta_img, 'cloudfront')) {{$product->meta_img}} @else https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->meta_img  }}@endif" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/css/navigation-sales.css') }}">
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
                "price"=> $product->price,
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
                @if($product->productType->name === 'Lesson')
                    @include('musora.product.partials.features',[
                        'features' => [
                            [
                                "icon" => "fa-trophy",
                                "heading" => "Study With ". $product->instructor_name,
                                "text" => $product->study_text,
                            ],
                            [
                                "icon" => "fa-users",
                                "heading" => "Drumeo Interactive Edition",
                                "text" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience.",
                            ],
                            [
                                "icon" => "fa-smile",
                                "heading" => "100% Happiness Guaranteed",
                                "text" => "We think you’ll love these lessons, and that’s why you can try them risk-free with our 90-day guarantee!"
                            ],
                        ]
                    ])

                    @include('musora.product.partials.overview',[
                        "overview" => $product->overview,
                        "interactive" => true,
                    ])

                    @include('musora.product.partials.specs',[
                        'specList'=> $product->specs,
                    ])

                    @include('musora.product.partials.instructor',[
                        "instructorPhoto" => $product->product_img,
                        "instructorBio" => $product->instructor_desc
                    ])

                    @include('musora.product.partials.topics',[
                        "topicList" => $product->features
                    ])

                @elseif($product->productType->name === 'Bundle')
                    <img class="mb-4" src="@if(str_contains($product->bundle_img, 'amazonaws') || str_contains($product->bundle_img, 'cloudfront')) {{$product->bundle_img}} @else https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->bundle_img  }}@endif" />

                    @include('musora.product.partials.overview',[
                        "overview" => $product->overview,
                        "interactive" => false,
                    ])

                    <hr class="my-8" />

                    <p class="mb-4">
                        <strong>Say hello to your free bonuses:</strong><br>
                        <em style="opacity: 0.5;">All digital bonuses are added to your account instantly with your membership to {{ $theme }}, and they’re yours forever.</em>
                    </p>


                    @include('musora.product.partials.bonuses')
                @else
                    @if(!empty($product->overview))
                        <p><x-markdown>{!! nl2br($product->overview) !!}</x-markdown></p>
                    @endif

                        @if(!empty($product->product_img))
                            <img class="my-4" src="@if(str_contains($product->product_img, 'amazonaws') || str_contains($product->product_img, 'cloudfront')) {{$product->product_img}} @else https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->product_img  }}@endif" alt="product image" />
                        @endif

                    @include('musora.product.partials.specs',[
                        'specList'=> $product->specs,
                        'featureList' => $product->features
                    ])
                @endif

                @if(!is_null($product->size_chart_id))
                    <img src="https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->sizeChart->chart }}" alt="bundle image" />
                @endif

            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('marketing/parcel/js/pack-drumshop.js')  }}"></script>
    <script>
        $(document).ready(function(){

            $('.slick-current img').addClass('border-{{$theme}}');
            $('.slick-current img').removeClass('border-white');

            $(".slick-slide").on('click',function(){
                let slides = $('.slide-img', '.slick-slide');
                slides.addClass('border-white')
                slides.removeClass('border-{{$theme}}');

                $('img', this).removeClass('border-white');
                $('img', this).addClass('border-{{$theme}}');
            })
        })
    </script>
@stop

