@php
  require_once(resource_path('marketing/views/pianote/lead-gen/christmas-carols/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">

    @parent
@endsection

@section('title', 'Beginner Piano Christmas Carols')

@section('meta-description', 'Play these beautiful carols for your loved ones this holiday season.')

@section('meta-img', 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/og-image.jpg')

@section('meta-url', 'https://www.pianote.com/christmas-carols')

@section('lesson-logo', 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/logo.png')

@section('lesson-index-url', '/christmas-carols/songs')

@section('lesson-total-number', 5)

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 md:w-1/3 lg:w-1/5 mb-7',
    ])
@endsection

@section('offers')
    @include('pianote.lead-gen.partials._500-songs-in-5-days-offer')
@endsection

