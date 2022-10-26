@extends('drumeo.products.rock-drumming-masterclass-testimonials')

@section('details-link')
    /drumshop/rock-drumming-masterclass
@stop

@section('order-link')
    /laravel/public/shopping-cart/api/query?products[rock-drumming-masterclass-pack]=1
@stop

@section('pricing')
    ${{ round(Prices::$rdmRegular / 26, 2) }}
@stop

@section('pricing2')
    ${{ Prices::$rdmRegular }}
@stop
