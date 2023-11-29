@extends('guitareo.products.500-songs-layout')

@php $productPrice = floatval($productPrices['500-songs-in-5-days-guitareo']->discounted_price) @endphp

@section('order-link', '/ecommerce/add-to-cart?products[500-songs-in-5-days-guitareo]=1')

@section('topbar')
    @include('guitareo._partials.promo-banner', [
                "name" => "500 Songs In 5 Days",
                "fullPrice" => floatval($productPrices['500-songs-in-5-days-guitareo']->price),
                "price" => floatval($productPrices['500-songs-in-5-days-guitareo']->discounted_price),
                "noBreadcrumb" => true
            ])
@endsection

@section('product-json')
    data-product-json='{"500-songs-in-5-days-guitareo": 1}'
@endsection
