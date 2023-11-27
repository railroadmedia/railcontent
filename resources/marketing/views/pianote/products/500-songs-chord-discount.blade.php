@extends('pianote.products.500-songs-layout')

@php $productPrice = 39 @endphp

@section('order-link', '/ecommerce/add-to-cart?products[500-songs-in-5-days]=1&redirect=/order&locked=true&promo-code=lead-discount2')

@section('header-text')
    Learn 100s more <strong>real songs</strong> on the piano. <br class="hidden-xs">
    Take your skills to the next level with <strong>500 Songs in 5 Days</strong>.
@endsection
@section('video')
    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/567534487?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
@endsection

@section('topbar')
    <div class="artist-promo-banner-shim"></div>
    <a href="@yield('order-link')" class="artist-promo-banner fixed">
        <div class="noise-wrap">
            <div class="container">
                <img class="logo hidden-xs" src="https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/logo.png" alt="White decorative text “Chord Hacks.”">
                <div class="text">
                    <p><strong>Save {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days']->price)))) }}% on 500 Songs in 5 Days</strong><br>
                        Special for Students Only</p>
                </div>
            </div>
        </div>
    </a>
@endsection

@section('banner')
    <section class="messenger-slice" style="background: #051529;">
        <div class="container">
            <a href="@yield('order-link')">
                <h2>Exclusive Offer Only For<br class="hidden-sm hidden-md hidden-lg">  <img class="logo" width="190px" src="https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/logo.png"> Students</h2>
            </a>
        </div>
    </section>
@endsection
