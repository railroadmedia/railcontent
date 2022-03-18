@extends('guitareo.sales.partials._nav')

@section('cart-nav')
    <div class="button-wrap" id="app">
        <a href="/shop" class="join outline-button">Shop</a>

        <nav-cart-button
            cart-data='{{ $cartData }}'
        ></nav-cart-button>
        <cart-sidebar
            brand="guitareo"
            cart-data='{{ $cartData }}'
        ></cart-sidebar>
    </div>
@endsection
