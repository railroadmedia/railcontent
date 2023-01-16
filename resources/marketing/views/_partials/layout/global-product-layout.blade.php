@extends('_partials.layout.global-template')

@section('meta')
    <title>{{ $product->name }} || {{ ucfirst($theme) }}</title>
    <meta property="og:description" content="{{ $product->meta_desc }}}">
    @if(!empty($product->meta_img))
        <meta property="og:image" content="@if(str_contains($product->meta_img, 'amazonaws') || str_contains($product->meta_img, 'cloudfront') || str_contains($product->meta_img, 'vimeocdn')) {{$product->meta_img}} @else https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->meta_img  }}@endif">
    @endif
@endsection

@section('layout-styles')
    <link href="{{ asset('marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
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

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/shop-product.js') }}"></script>


    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
@endsection
