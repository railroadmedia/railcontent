@extends('sales.standard-layout', [
    "trialVersion" => true
])

@section('meta')
    <title>Pianote Trial</title>
    <meta property="og:title" content="Pianote Trial">
    <meta property="og:url" content="https://www.pianote.com/trial/">
@endsection

@section('final')
    @include('pianote.sales.trials._final-trial', [ "url" => "/choose-your-trial-month/" ])
@stop
