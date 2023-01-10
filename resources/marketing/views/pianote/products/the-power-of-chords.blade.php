@extends('pianote.products.the-power-of-chords-layout')

@php $productPrice = floatval($productPrices['the-power-of-chords']->discounted_price) @endphp

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['the-power-of-chords' => 1], 'redirect' => '/order']) }}
@endsection

@section('topbar')
    @include('pianote._partials._promo-banner-no-tw', [
        "name" => "The Power of Chords",
        "fullPrice" => floatval($productPrices['the-power-of-chords']->price),
        "price" => floatval($productPrices['the-power-of-chords']->discounted_price),
                    "noBreadcrumb" => true
    ])
@endsection

@section('product-json')
    data-product-json='{"the-power-of-chords": 1}'
@endsection
