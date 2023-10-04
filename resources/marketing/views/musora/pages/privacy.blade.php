@extends('musora._partials.layout')

@section('head-includes')
    <title>Privacy Policy | Musora</title>
    <meta property="og:title" content="Privacy Policy">
    <meta name="description" content="Below is a list of the standard policies we use on this website.">
@stop

<!-- Main -->
@section('layout-body')
    @include('musora._partials._privacy', [
        'headerBg' => 'background-color:#0c1524;'
    ])
@stop
