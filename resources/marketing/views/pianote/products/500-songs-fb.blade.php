@extends('pianote.products.500-songs-layout')

@php $productPrice = floatval($productPrices['500-songs-in-5-days']->discounted_price) @endphp

@section('topbar')
    <div class="messenger-banner-shim hidden-xs"></div>
    <a href="@yield('order-link')" class="messenger-banner fixed">
        <div class="container">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg"> <p>Facebook Messenger  <br>Discount - Save {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days']->price)))) }}%</p>
        </div>
    </a>
@endsection

@section('badge')
    <strong><u><i class="fab fa-facebook-messenger"></i> MESSENGER DISCOUNT ${{ $productPrice }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days']->price)))) }}%)
@endsection

@section('banner')
    <section class="messenger-slice">
        <div class="container">
            <a href="@yield('order-link')">
                <h1><i class="fab fa-facebook-messenger"></i> Facebook Messenger Discount <i class="fab fa-facebook-messenger"></i><br>
                    <em>Save {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days']->price)))) }}%</em></h1>
                <p>You’ve already watched the first lesson -- and we want to make it insanely easy for you to continue your journey towards playing 500 songs on the piano. So we’re giving you a 50% discount when you register before November 15th @ Midnight.</p>
            </a>
        </div>
    </section>
@endsection

@section('lesson-watched', true)

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['500-songs-in-5-days' => 1], 'redirect' => '/order', 'locked' => 'true', 'promo-code' => 'facebook']) }}
@endsection
