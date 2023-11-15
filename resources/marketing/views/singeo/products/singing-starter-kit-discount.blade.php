@extends('singeo.products.singing-starter-kit-layout')

@php $productPrice = 9 @endphp

@section('order-link', '/ecommerce/add-to-cart?products[singing-starter-kit]=1&redirect=/order&promo-code=lead-discount4')

@section('topbar')
    <div class="artist-promo-banner-shim"></div>
    <a href="@yield('order-link')" class="artist-promo-banner fixed">
        <div class="noise-wrap">
            <div class="container mx-auto">
                <div class="text">
                    <p><strong>Improve Any Voice Students</strong><br>
                        Exclusive Discount - Save {{ round(100 - (100 * ($productPrice / floatval($productPrices['singing-starter-kit']->price)))) }}%
                    </p>
                </div>
            </div>
        </div>
    </a>
@endsection

@section('banner')
    <section class="messenger-slice" style="background: #051529;">
        <div class="container mx-auto">
            <a href="@yield('order-link')">
                <h3 class="leading-tight">Exclusive Offer Only For <br class="inline sm:hidden"><strong>Improve Any Voice</strong> Students</h3>
            </a>
        </div>
    </section>
@endsection
