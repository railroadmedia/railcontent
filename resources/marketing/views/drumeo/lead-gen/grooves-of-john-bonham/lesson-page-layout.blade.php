@php
  require_once(resource_path('views/lead-gen/grooves-of-john-bonham/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>@yield('title') | Grooves Of John Bonham</title>
    <meta property="og:title" content="Grooves Of John Bonham | Drumeo">
    <meta name="description" content="The ultimate breakdown of Led Zeppelin’s famous drum grooves. (FREE)">
    <meta property="og:description" content="The ultimate breakdown of Led Zeppelin’s famous drum grooves. (FREE)">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/grooves-of-john-bonham/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/grooves-of-john-bonham/">
@stop

@section('total-lesson', '11')

@section('lesson-index', '/grooves-of-john-bonham/lessons')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/4')
