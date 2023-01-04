@extends('singeo.products.singing-starter-kit-layout')

@php $productPrice = floatval($productPrices['singing-starter-kit']->discounted_price) @endphp

@section('order-link', '/ecommerce/add-to-cart?products[singing-starter-kit]=1&redirect=/order')
