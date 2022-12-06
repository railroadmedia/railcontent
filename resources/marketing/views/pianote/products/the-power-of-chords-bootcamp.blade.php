@extends('pianote.products.the-power-of-chords-layout')

@php $productPrice = 5 @endphp

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['the-power-of-chords' => 1], 'redirect' => '/order', 'promo-code' => 'bootcamp']) }}
@endsection

@section('topbar')
    <style>
    .promo-banner-shim{display:block;width:100%;height:40px}.promo-banner{display:block;text-align:center;color:#073c90;width:100%;transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Roboto Condensed,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:#000;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;text-transform:uppercase;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner p .permanent{line-height:1em;font-size:19px}@media (min-width:768px){.promo-banner p .permanent{font-size:21px}}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}
    </style>
    <div class="promo-banner-shim"></div>
    <a href="#orderNow" class="promo-banner anchor-slide fixed text-black" style="background: linear-gradient(to bottom, #dfeef2, #f9e4d3);">
        <div class="noise-wrap">
            <div class="container tw-container mx-auto tw-mx-auto">
                <div class="text text-center">
                    <p><strong>Exclusive Bootcamp Discount<br>
                            ONLY <s class="opacity-60">$97</s> $5 (95% Off)</strong></p>
                </div>
            </div>
        </div>
    </a>
@endsection

@section('countdown')

@endsection

@section('product-json')
    data-product-json='{"the-power-of-chords": 1}'
@endsection
