@extends('singeo.products.singing-starter-kit-layout')

@php $productPrice = SingeoPrices::$singingStarterKit @endphp

@section('order-link', '/ecommerce/add-to-cart?products[singing-starter-kit]=1&redirect=/order')
