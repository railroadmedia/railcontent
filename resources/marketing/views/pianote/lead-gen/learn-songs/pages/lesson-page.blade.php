@php
  require_once(resource_path('marketing/views/pianote/lead-gen/learn-songs/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">

    @parent
@endsection

@section('title', 'Learn 3 Songs On Piano')

@section('meta-description', 'Start playing REAL songs today!')

@section('meta-img', 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/share-image.jpg')

@section('meta-url', 'https://www.pianote.com/learn-songs')

@section('lesson-logo', 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/logo-horizontal.png')

@section('lesson-index-url', '/learn-songs/lessons')

@section('lesson-total-number', 4)

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 lg:w-1/4',
    ])
@endsection

@section('offers')
    @include('pianote.lead-gen.partials._500-songs-in-5-days-offer')
@endsection

