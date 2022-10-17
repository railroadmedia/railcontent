@php
  require_once(resource_path('marketing/views/pianote/lead-gen/getting-started/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">

    @parent
@endsection

@section('title', 'Getting-Started')

@section('meta-description', 'Go from absolute beginner to playing your first song in four easy lessons!')

@section('meta-img', cdn('chord-hacks/bg.jpg'))

@section('meta-url', 'https://www.pianote.com/getting-started')

@section('lesson-logo', cdn('lead-gen/getting-started/logo-2.svg'))

@section('lesson-index-url', '/getting-started/lessons')

@section('lesson-total-number', 4)

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 md:w-1/4',
    ])
@endsection

@section('offers')
    @include('pianote.lead-gen.learn-to-play.elements.red-signup')
@endsection
