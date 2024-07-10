@extends('pianote.products.the-power-of-chords-layout')

@php $productPrice = floatval($productPrices['the-power-of-chords']->discounted_price) @endphp

@section('order-link', '/ecommerce/add-to-cart?products[the-power-of-chords]=1')

@section('topbar')
    @include('_partials.components.shop.promo-banner-3', [
        "name" => "The Power of Chords",
        "fullPrice" => floatval($productPrices['the-power-of-chords']->price),
        "price" => floatval($productPrices['the-power-of-chords']->discounted_price),
                    "noBreadcrumb" => true
    ])
@endsection

@section('product-json')
    data-product-json='{"the-power-of-chords": 1}'
@endsection
