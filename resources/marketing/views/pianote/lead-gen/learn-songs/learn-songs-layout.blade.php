@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Learn 3 Songs On Piano | Pianote</title>
    <meta name="description" content="Start playing REAL songs today!">

    <meta property="og:image" content="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/share-image.jpg" style="display: none;">
    <meta property="og:title" content="Learn 3 Songs On Piano | Pianote">
    <meta property="og:description" content="Start playing REAL songs today!">
    <meta property="og:url" content="https://www.pianote.com/learn-songs">

@endsection
@section('head')
    <link href="{{ asset('/marketing/parcel/pianote/lead-gen-learn-songs.css') }}" rel="stylesheet">
@endsection
