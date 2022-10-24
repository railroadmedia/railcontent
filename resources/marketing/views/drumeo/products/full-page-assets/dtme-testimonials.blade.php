@extends('drumeo.products.full-page-assets.drum-technique-made-easy-testimonials')

@section('details-link')
    /drumshop/drum-technique-made-easy
@stop

@section('order-link')
    /laravel/public/shopping-cart/api/query?products[drum-technique-made-easy-pack]=1
@stop

@section('pricing')
    ${{ round(Prices::$dtmeRegular / 26, 2) }}
@stop

@section('pricing2')
    ${{ Prices::$dtmeRegular }}
@stop
