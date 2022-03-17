@extends('guitareo.products.500-songs-layout')

@php $productPrice = App\Prices::$songs500Full @endphp

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['500-songs-in-5-days-guitareo' => 1], 'redirect' => '/order']) }}
@endsection

@section('topbar')
    @include('shop.elements.promo-banner', [
                "name" => "500 Songs In 5 Days",
                "fullPrice" => App\Prices::$songs500Full,
                "price" => App\Prices::$songs500Regular,
                "noBreadcrumb" => true
            ])
@endsection

@section('product-json')
    data-product-json='{"500-songs-in-5-days-guitareo": 1}'
@endsection