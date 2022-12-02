@php
    require_once(resource_path('views/lead-gen/getting-started/lessons.php'))
@endphp

@extends('pianote.lead-gen.getting-started.layout')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>Getting Started On The Piano | Pianote</title>
@stop()

@section('page-body')
    @include('pianote.lead-gen.partials.header2',[
        "bg" => 'url("https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/bg.jpg") center center/cover no-repeat',
        "imgSrc" => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/logo-2.svg',
        "text" => '<div class="medium-body mt-4"><em>Go from absolute beginner to playing your first song in four easy lessons!</em></div>'
    ])

    @include('pianote.lead-gen.partials.series1',[
        "customSize" => "w-full md:w-1/3"
    ])

    @include('lead-gen.partials._7-day-trial-offer')
@stop
