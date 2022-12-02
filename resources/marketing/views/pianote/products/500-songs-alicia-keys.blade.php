@extends('pianote.products.500-songs-layout')

@php $productPrice = 49 @endphp

@section('topbar')
    <div class="artist-promo-banner-shim"></div>
    <a href="@yield('order-link')" class="artist-promo-banner fixed">
        <div class="noise-wrap">
            <div class="container">
                <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg">
                <div class="text">
                    <p><strong class="text-yellow">Alicia Keys Fans</strong><br>Start Today & Save 50%</p>
                </div>
            </div>
        </div>
    </a>
@endsection



@section('albums-url', 'https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/alicia-keys-album-covers.png')

@section('name', 'Alicia Keys')

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['500-songs-in-5-days' => 1], 'redirect' => '/order', 'locked' => 'true', 'promo-code' => 'artist-deal']) }}
@endsection

@section('video')
    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/441468714?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
@endsection
