@extends('guitareo.products.500-songs-layout', [ "altOffer" => true ])

@php $productPrice = 9 @endphp

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['500-songs-in-5-days-guitareo' => 1], 'redirect' => '/order', 'promo-code' => 'special-discount']) }}
@endsection

@section('product-json')
    data-product-json='{"500-songs-in-5-days-guitareo": 1}'
@endsection

@section('topbar')
    <div class="artist-promo-banner-shim"></div>
    <a href="@yield('order-link')" class="artist-promo-banner fixed">
        <div class="noise-wrap">
            <div class="container mx-auto">
                <img class="logo" src="https://www.musora.com/musora-cdn/image/width=448,quality=85/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/logo.png">
                <div class="text">
                    <p><strong>
                            Save {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days-guitareo']->price)))) }}% on 500 Songs in 5 Days</strong><br>
                        Special For students ONLY</p>
                </div>
            </div>
        </div>
    </a>
@endsection

@section('banner')
    <section class="messenger-slice" style="background: #051529;">
        <div class="container mx-auto">
            <a href="@yield('order-link')">
                <h3 style="    margin: 0 auto 15px;">You’ve Learned Skills To Play 1 Song. <br class="inline md:hidden"> Now <strong>Learn 499 More!</strong></h3>
                <h2 class="leading-normal"><strong>Exclusive Offer Only For<br class="inline md:hidden">  <img style="padding: 0 23px;margin: 0 -23px;" class="logo" width="230px" src="https://www.musora.com/musora-cdn/image/width=448,quality=85/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/logo.png"> Students</strong></h2>
            </a>
        </div>
    </section>
@endsection
