@extends('pianote.products.500-songs-layout')

@php $productPrice = 39 @endphp

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['500-songs-in-5-days' => 1], 'redirect' => '/order', 'locked' => 'true', 'promo-code' => 'learn-3-songs']) }}
@endsection
@section('header-text')
    Learn 100s more <strong>real songs</strong> on the piano. <br class="hidden-xs">
    Take your skills to the next level with <strong>500 Songs in 5 Days</strong>.
@endsection

@section('topbar')
    <div class="artist-promo-banner-shim"></div>
    <a href="@yield('order-link')" class="artist-promo-banner fixed">
        <div class="noise-wrap">
            <div class="container">
                <img class="logo" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/logo.png">
                <div class="text">
                    <p><strong>Save {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days']->price)))) }}% on<br> 500 Songs in 5 Days</strong></p>
                </div>
            </div>
        </div>
    </a>
@endsection
