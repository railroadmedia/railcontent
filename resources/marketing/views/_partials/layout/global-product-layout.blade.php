@extends('_partials.layout.global-template')

@section('meta')
    <title>{{ $product->name }} || {{ ucfirst($theme) }}</title>
    <meta property="og:title" content="{{ $product->name }} || {{ ucfirst($theme) }}">
    <meta property="description" content="{{ $product->meta_desc }}">
    <meta property="og:description" content="{{ $product->meta_desc }}">
    <meta property="og:url" content="{{ get_legacy_brand_base_url($theme)}}/{{ Request::path() }}"/>
    @if(!empty($product->meta_img))
        <meta property="og:image" content="@if(str_contains($product->meta_img, 'amazonaws') || str_contains($product->meta_img, 'cloudfront') || str_contains($product->meta_img, 'vimeocdn')) {{$product->meta_img}} @else https://d1fyshwdvi6fth.cloudfront.net/{{ $product->meta_img  }}@endif">
    @endif
@endsection

@section('layout-styles')
    <link href="{{ asset('marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="preload" href="{{ mix('marketing/css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}"></noscript>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-product.css') }}" rel="stylesheet">
    <style>
        .pack-details .slider-container .slider-nav .slick-slide.slick-current img {
            border-color: @php
                            if($theme === 'drumeo'){
                                echo '#0b76db';
                            }
                            elseif($theme === 'pianote'){
                                echo '#f61a30';
                            }
                            elseif($theme === 'guitareo'){
                                echo '#00c9ac';
                            }
                            elseif($theme === 'singeo'){
                                echo '#8300e9';
                            }
                          @endphp
                          !important;
        }
    </style>

    <?php
        if(count($product->sizes) > 0){
            foreach($product->sizes as $size){
                \App\Analytics\Tracker::trackProductImpression($product->sku.'-'.(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code);
            }
        }
        else{
            if($product->productType->name !== 'Bundles') {
                \App\Analytics\Tracker::trackProductImpression($product->sku);
            }
        }
    ?>
@endsection

@section('body-data')
    x-data="{
        orderModal: false,
    }"
@endsection

@section('layout-body')
    @component('_partials.components.modal', ['name' => 'orderModal'])
        @slot('content')
            <div class="max-w-2xl mx-auto">
                <div class="info-wrap shipping-info bg-white rounded-xl overflow-hidden text-center">
                    <div class="bg-drumeo py-10">
                        <img class="h-16" src="https://musora.s3.us-east-2.amazonaws.com/shipping-icon.svg" alt="shoppping icon" />
                    </div>
                    <div class="py-10 px-4 md:px-20">
                        <h4 class="font-bold mb-2">Just a heads up!</h4>
                        <p class="mb-4">
                            I understand that these items are preorders<br class="hidden md:inline-block"> and will not ship until <b>March 1st, 2023</b>.
                        </p>
                        <div class="flex gap-2">
                            <span class="flex-1 rounded-full border-2 border-black uppercase text-black py-2 font-bold uppercase text-sm md:text-base" @click="orderModal = false">Cancel</span>
                            <span class="understand-button flex-1 rounded-full border-2 border-drumeo bg-drumeo uppercase text-white py-2 font-bold uppercase text-sm md:text-base" href="">I understand</span>
                        </div>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
@endsection

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    @if($product->is_seasonal)
        <script type="text/javascript" src="{{ asset('/marketing/js/musora/shop-product.js') }}"></script>
    @else
        <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/shop-product.js') }}"></script>
    @endif


    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
@endsection
