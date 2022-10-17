@extends('products.500-songs-layout')

@php $productPrice = PianotePrices::$songs500Regular @endphp

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['500-songs-in-5-days' => 1], 'redirect' => '/order', 'locked' => 'true']) }}
@endsection

@section('topbar')
    @include('pianote._partials._promo-banner', [
                    "name" => "500 Songs In 5 Days",
                    "fullPrice" => PianotePrices::$songs500Full,
                    "price" => PianotePrices::$songs500Regular,
                    "noBreadcrumb" => true
                ])
@endsection

@section('product-json')
    data-product-json='{"500-songs-in-5-days": 1}'
@endsection
