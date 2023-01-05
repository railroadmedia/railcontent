@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Beginner Piano Christmas Carols | Pianote</title>
    <meta property="og:title" content="Beginner Piano Christmas Carols | Pianote">
    <meta name="description" content="Play these beautiful carols for your loved ones this holiday season.">
    <meta property="og:description" content="Play these beautiful carols for your loved ones this holiday season.">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/christmas-carols">

@endsection
@section('head')
    <style>
        .color-pale-yellow {
            color:#f8dea3;
        }
    </style>
    <link href="{{ asset('/marketing/parcel/pianote/lead-gen-learn-songs.css') }}" rel="stylesheet">
@endsection
