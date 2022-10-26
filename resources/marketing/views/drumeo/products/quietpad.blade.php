@extends('drumeo.products.quietpad-layout')

@section('button')
    <a href="/laravel/public/shopping-cart/api/query?products[quietpad]=1" class="join blue">Get Yours &raquo;</a>
    {{--<a class="join sold-out">Sold Out &raquo;</a>--}}
@stop

@section('prelaunch-text')
    <p class="dense" style="opacity: 0;"><strong class="text-yellow">LAUNCH SPECIAL</strong><br>
        <s>NORMALLY ${{ Prices::$quietPadFull }}.</s> <strong>ONLY ${{ Prices::$quietPadRegular }}</strong> (SAVE {{ round(100 - (100 * (Prices::$quietPadRegular / Prices::$quietPadFull))) }}%)</p>
@stop

@section('chart-price')
    @if(Prices::$quietPadFull > Prices::$quietPadRegular)
            <s>${{ Prices::$quietPadFull }}</s>@endif
        <strong>${{ Prices::$quietPadRegular }}</strong><br>+ SHIPPING
@stop

@section('bottom-price')
    <h3>
        @if(Prices::$quietPadFull > Prices::$quietPadRegular)
            <s>NORMALLY ${{ Prices::$quietPadFull }}.</s><br class="hide-for-medium">
            <strong>NOW ${{ Prices::$quietPadRegular }}</strong><br class="hide-for-medium">
            (SAVE {{ round(100 - (100 * (Prices::$quietPadRegular / Prices::$quietPadFull))) }}%).
        @else
            <strong>ONLY ${{ Prices::$quietPadRegular }}</strong>
        @endif
    </h3>
@stop
