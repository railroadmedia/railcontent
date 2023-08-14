@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora Mentors</title>
    <meta property="og:title" content="Musora Mentors">

    <meta name="description" content="Our music lesson communities have always valued relationships before technology.">
    <meta property="og:description" content="Our music lesson communities have always valued relationships before technology.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/musora_mentors_logo.png">
@endsection

@section('layout-body')
    @include('musora._partials._mentors')
@stop
