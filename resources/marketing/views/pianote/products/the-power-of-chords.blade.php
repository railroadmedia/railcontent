@extends('pianote.products.the-power-of-chords-layout')

@php
    if(number_format(floatval($productPrices['the-power-of-chords']->discounted_price), 2) == intval(floatval($productPrices['the-power-of-chords']->discounted_price))) {
        $productPrice = floatval($productPrices['the-power-of-chords']->discounted_price);
    }
    else {
         $productPrice = number_format(floatval($productPrices['the-power-of-chords']->discounted_price), 2);
    }
@endphp

@section('order-link', '/ecommerce/add-to-cart?products[the-power-of-chords]=1')

@section('topbar')
    @include('_partials.components.shop.promo-banner-2', [
        "name" => "The Power of Chords",
        "fullPrice" => floatval($productPrices['the-power-of-chords']->price),
        "price" => floatval($productPrices['the-power-of-chords']->discounted_price),
                    "noBreadcrumb" => true
    ])
@endsection

@section('product-json')
    data-product-json='{"the-power-of-chords": 1}'
@endsection
