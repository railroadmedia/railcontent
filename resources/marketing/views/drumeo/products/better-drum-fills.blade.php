@extends('drumeo.products.better-drum-fills-layout')

@php
    $price = $productPrices['four-weeks-to-better-drum-fills']->discounted_price;
    $orderUrl = '/ecommerce/add-to-cart?products[four-weeks-to-better-drum-fills]=1';
@endphp
