@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>5 Days to Playing Piano | Pianote</title>
    <meta name="description" content="Start learning how to play the piano in just 5 days!">

    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/piano-in-5-days/og-image.jpg" style="display: none;">
    <meta property="og:title" content="5 Days to Playing Piano | Pianote">
    <meta property="og:description" content="Start learning how to play the piano in just 5 days!">
    <meta property="og:url" content="https://www.pianote.com/piano-in-5-days">

@endsection
@section('head')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    @yield('extra-style')
@endsection
