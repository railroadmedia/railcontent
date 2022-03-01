@php
  require_once(resource_path('platform/prototyping_data/test_data.php'))
@endphp

@extends('_partials.layout')

@section('content')

    <h1>Hello!</h1>
    <h2>{{ $myString }}</h2>

    @foreach($myArray as $myArrayValue)
        <h2>{{ $myArrayValue }}</h2>
    @endforeach

    @foreach($myJsonObject as $myJsonValue)
        <h2>{{ $myJsonValue }}</h2>
    @endforeach

@endsection