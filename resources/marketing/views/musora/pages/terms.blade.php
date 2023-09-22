@extends('musora._partials.layout')

@section('head-includes')
    <title>Terms Of Use | Musora</title>
    <meta property="og:title" content="Terms Of Use">
    <meta name="description" content="Please read this agreement carefully before accessing or using this web site.">
@stop

<!-- Main -->
@section('layout-body')
    @include('musora._partials._terms', [
        'headerBg' => 'background-color:#0c1524;'
    ])
@stop
