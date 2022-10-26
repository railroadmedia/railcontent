@extends('drumeo.products.comfort-cover-layout')

@section('pricing')
    @if(Prices::$comfortCoverFull > Prices::$comfortCoverRegular)
        <s style="opacity: 0.6;">NORMALLY ${{ Prices::$comfortCoverFull }}</s>
        <strong class="text-yellow">
            ONLY ${{ number_format(Prices::$comfortCoverRegular, 2) }}
        </strong>
    @else
        <strong class="text-yellow">ONLY ${{ number_format(Prices::$comfortCoverRegular, 2) }}.</strong>
    @endif
    <br><a href="/laravel/public/shopping-cart/api/query?products[comfort-cover]=1&products[DLM]=1,year,1&locked=true" class="text-blue smaller"><em><u>Or free with Drumeo</u></em></a>
@endsection

@section('buy-link')
    /laravel/public/shopping-cart/api/query?products[comfort-cover]=1
@endsection
@section('simple-price')
    @if(Prices::$comfortCoverFull > Prices::$comfortCoverRegular)
        <s>${{ Prices::$comfortCoverFull }}</s><br>
    @endif
    ${{ number_format(Prices::$comfortCoverRegular, 2) }}
@endsection
