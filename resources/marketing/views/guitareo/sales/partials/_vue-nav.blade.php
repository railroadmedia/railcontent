@extends('guitareo.sales.partials._nav')

@section('cart-nav')
    <div class="button-wrap" id="app">
        <a href="/shop" class="join outline-button">Shop</a>

        <nav-cart-button
            cart-data='{{ $cartData }}'
            checkout-url='{{ get_legacy_brand_base_url("musora") }}/order/guitareo'
            api-domain-url='{{ get_musora_brand_base_url() }}'
        ></nav-cart-button>
        <cart-sidebar
            brand="guitareo"
            cart-data='{{ $cartData }}'
            checkout-url='{{ get_legacy_brand_base_url("musora") }}/order/guitareo'
            api-domain-url='{{ get_musora_brand_base_url() }}'
        ></cart-sidebar>
    </div>
@endsection
