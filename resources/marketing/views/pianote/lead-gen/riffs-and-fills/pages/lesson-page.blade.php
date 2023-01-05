@php
  require_once(resource_path('marketing/views/pianote/lead-gen/riffs-and-fills/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    @parent
@endsection

@section('title', 'Piano Riffs & Fills')

@section('meta-description', 'The Shortcuts To Sounding Great On The Piano')

@section('meta-img', 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/og-image.jpg')

@section('meta-url', 'https://www.pianote.com/riffs-and-fills')

@section('lesson-logo', 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-riffs-fills-logo.png')

@section('lesson-index-url', '/riffs-and-fills/lessons')

@section('lesson-total-number', 7)

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 md:w-1/3',
    ])
@endsection
