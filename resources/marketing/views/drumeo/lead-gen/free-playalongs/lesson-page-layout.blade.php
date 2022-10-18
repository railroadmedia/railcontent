@php
  require_once(resource_path('views/lead-gen/free-playalongs/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>@yield('title') | 9 FREE PLAY-ALONGS</title>
    <meta property="og:title" content="9 FREE PLAY-ALONGS | Drumeo">
    <meta name="description" content="Add your drumming to nine high-quality drum play-along tracks. (FREE).">
    <meta property="og:description" content="Add your drumming to nine high-quality drum play-along tracks. (FREE).">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/free-playalongs/">
@stop

@section('total-lesson', '9')

@section('lesson-index', '/free-playalongs/songs')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/5')

@section('thumb-width', '40%')

@section('lesson-tile-aspect', 'aspect-1:1')

