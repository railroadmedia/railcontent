@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/metal-playalongs/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>@yield('title') | 9 Metal Play-Alongs</title>
    <meta property="og:title" content="9 Metal Play-Alongs | Drumeo">
    <meta name="description" content="Add your drumming to nine heavy drum play-along tracks. (FREE).">
    <meta property="og:description" content="Add your drumming to nine heavy drum play-along tracks. (FREE).">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/metal-playalongs/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/metal-playalongs/">
@stop

@section('total-lesson', '9')

@section('lesson-index', '/metal-playalongs/songs')

@section('thumb-width' ,'40%')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/5')

@section('lesson-tile-aspect', 'aspect-1:1')
