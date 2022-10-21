@extends('guitareo.products.500-songs-layout')

@php $productPrice = GuitareoPrices::$songs500Regular @endphp

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['500-songs-in-5-days-guitareo' => 1], 'redirect' => '/order']) }}
@endsection

@section('topbar')
    @include('guitareo._partials.promo-banner', [
                "name" => "500 Songs In 5 Days",
                "fullPrice" => GuitareoPrices::$songs500Full,
                "price" => GuitareoPrices::$songs500Regular,
                "noBreadcrumb" => true
            ])
@endsection

@section('product-json')
    data-product-json='{"500-songs-in-5-days-guitareo": 1}'
@endsection
