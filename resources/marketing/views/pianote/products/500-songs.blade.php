@extends('pianote.products.500-songs-layout')

@php
    if(number_format(floatval($productPrices['500-songs-in-5-days']->discounted_price), 2) == intval(floatval($productPrices['500-songs-in-5-days']->discounted_price))) {
        $productPrice = floatval($productPrices['500-songs-in-5-days']->discounted_price);
    }
    else {
         $productPrice = number_format(floatval($productPrices['500-songs-in-5-days']->discounted_price), 2);
    }
@endphp

@section('order-link', '/ecommerce/add-to-cart?products[500-songs-in-5-days]=1')

@section('topbar')
    @include('_partials.components.shop.promo-banner-3', [
                    "name" => "500 Songs In 5 Days",
                    "fullPrice" => floatval($productPrices['500-songs-in-5-days']->price),
                    "price" => floatval($productPrices['500-songs-in-5-days']->discounted_price),
                    "noBreadcrumb" => true
                ])
@endsection

@section('product-json')
    data-product-json='{"500-songs-in-5-days": 1}'
@endsection
