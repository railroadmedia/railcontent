@extends('_partials.layout.global-product-layout')

@section('layout-header')
    @include("singeo.sales.partials._nav", [
        "cartVersion" => true,
        'shopToMusora' => $product->is_seasonal,
    ])
@endsection

@section('layout-body')
    <div class="clearfix container mx-auto max-w-6xl">
        <div class="lg:flex">
            @include('_partials.components.shop.slider',[
                "headerText" => $product->header_text,
                "specialText" => $product->subheader_text,
                "videoSrc" => $product->video_src,
                "images" => $product->images,
            ])

            @include('_partials.components.shop.sidebar',[
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
                'promoCode' => $product->promo_code,
                'bundle' => $product->productType->name === 'Bundles' || str_contains($product->sku, 'member') || str_contains($product->sku, 'products')? true : false,
            ])
        </div>
        <div class="product-wrap lg:w-2/3 px-3 md:px-4">
            <div class="pack-details mx-auto mb-7 pb-5 sm:pb-9 lg:pb-11">
                @if($product->productType->name === 'Lessons' && count($product->benefits) > 0)
                    @include('_partials.components.shop.benefits',[
                        'benefits' => $product->benefits
                    ])
                @endif

                @if($product->productType->name === 'Bundles' && !empty($product->spread_img))
                    <div class="text-center">
                        <h3 class="mb-4"><strong>What's included:</strong></h3>
                        <img class="mb-4" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{$product->spread_img}}@endif" alt="bundle spread image" />
                    </div>
                @endif

                @if(!empty($product->overview))
                    @include('_partials.components.shop.overview',[
                        "overview" => $product->overview,
                    ])
                @endif

                @if($product->productType->name === 'Bundles')
                    <hr class="my-8" />

                    <p class="mb-4">
                        <strong>Say hello to your free bonuses:</strong><br>
                        <em style="opacity: 0.5;">All digital bonuses are added to your account instantly with your membership to {{ $brand }}, and they’re yours forever.</em>
                    </p>

                    @include('_partials.components.shop.bonuses')
                @else
                    @include('_partials.components.shop.specs',[
                        'specList'=> $product->specs,
                        'featureList' => $product->features,
                    ])
                @endif


                @if($product->productType->name === 'Lessons' && !empty($product->instructor_desc))
                    @include('_partials.components.shop.instructor',[
                        "instructorPhoto" => $product->product_img,
                        "instructorBio" => $product->instructor_desc
                    ])

                    @include('_partials.components.shop.topics',[
                        "topicList" => $product->features
                    ])
                @endif

                @if(!empty($product->size_chart_id))
                    <img class="mt-10" src="https://d1fyshwdvi6fth.cloudfront.net/{{ $product->sizeChart->chart }}" alt="size chart" />
                @endif
            </div>
        </div>
    </div>

    @parent
@endsection

@section('layout-footer')
    @include("singeo.sales.partials._footer")
@endsection
