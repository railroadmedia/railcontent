@extends('pianote.products.500-songs-layout')

@php $productPrice = floatval($productPrices['500-songs-in-5-days']->discounted_price) @endphp

@section('order-link')
    /ecommerce/add-to-cart?products[500-songs-in-5-days]=1&redirect=/order&locked=true
@endsection

@section('topbar')
    @include('pianote._partials._promo-banner', [
                    "name" => "500 Songs In 5 Days",
                    "fullPrice" => floatval($productPrices['500-songs-in-5-days']->price),
                    "price" => floatval($productPrices['500-songs-in-5-days']->discounted_price),
                    "noBreadcrumb" => true
                ])
@endsection

@section('product-json')
    data-product-json='{"500-songs-in-5-days": 1}'
@endsection
