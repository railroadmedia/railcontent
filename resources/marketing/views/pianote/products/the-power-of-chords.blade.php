@extends('products.the-power-of-chords-layout')

@php $productPrice = App\Prices::$powerOfChords @endphp

@section('order-link')
    {{ url()->route('shopping-cart.add-to-cart', ['products' => ['the-power-of-chords' => 1], 'redirect' => '/order']) }}
@endsection

@section('topbar')
    @include('shop.partials._promo-banner', [
        "name" => "The Power of Chords",
        "fullPrice" => \App\Prices::$powerOfChordsFull,
        "price" => \App\Prices::$powerOfChords,
                    "noBreadcrumb" => true
    ])
@endsection

@section('product-json')
    data-product-json='{"the-power-of-chords": 1}'
@endsection