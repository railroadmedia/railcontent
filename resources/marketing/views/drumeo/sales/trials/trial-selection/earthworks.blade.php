@extends('drumeo.sales.trials.trial-selection.trial-selection-layout')

@section('badge-text', 'Earthworks Special Offer')
@section('annual-url')
    href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM-Trial-Annual-30-Day]=1&promo-code=coach-discount&locked=true"
@endsection
@section('extra-savings', '$200')
@section('extra-savings-divided', '$16.67')
@section('extra-savings-amount', '$148')
