@extends('guitareo.sales.partials._nav')

@section('cart-nav')
    <div class="button-wrap" id="app">
        <a href="/shop" class="join outline-button">Shop</a>

        <nav-cart-button
            cart-data='{{ $cartData }}'
            cart-data-url=''
            checkout-url='/order/guitareo'
            api-domain-url=''
        ></nav-cart-button>
        <cart-sidebar
            brand="guitareo"
            cart-data='{{ $cartData }}'
            cart-data-url=''
            checkout-url='/order/guitareo'
            api-domain-url=''
        ></cart-sidebar>
    </div>
@endsection
