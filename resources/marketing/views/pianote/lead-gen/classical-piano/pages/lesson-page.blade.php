@php
  require_once(resource_path('marketing/views/pianote/lead-gen/classical-piano/lessons.php'))
@endphp


@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">

    @parent
@endsection

@section('title', 'Classical Piano')

@section('meta-description', 'Start playing beautiful classical piano with 4 easy lessons.')

@section('meta-img', 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/og-image2.jpg')

@section('meta-url', 'https://www.pianote.com/classical-piano')

@section('lesson-logo', 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/logo.png')

@section('lesson-index-url', '/classical-piano/lessons')

@section('lesson-total-number', 4)

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 md:w-1/4',
    ])
@endsection

@section('offers')
    @include('pianote.lead-gen.partials._7-day-trial-offer')
@endsection
