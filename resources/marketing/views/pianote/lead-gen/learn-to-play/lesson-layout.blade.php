@php
  require_once(resource_path('marketing/views/pianote/lead-gen/learn-to-play/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">

    @parent
@endsection

@section('title', 'Learn-To-Play-Piano')

@section('meta-description', 'Ever wanted to learn the piano?  This video series will get you playing in no time!')

@section('meta-img', cdn('quick-start/learn-piano.jpg'))

@section('meta-url', 'https://www.pianote.com/learn-piano')

@section('lesson-logo', 'https://d2vyvo0tyx8ig5.cloudfront.net/learn-piano/logo.png')

@section('lesson-index-url', '/my-lessons')

@section('lesson-total-number', 10)

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 md:w-1/3',
    ])
@endsection

@section('offers')
    @include('pianote.lead-gen.learn-to-play.elements.red-signup')
@endsection
