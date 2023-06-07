@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <meta property="og:title" content="Chord Hacks">

    <meta name="description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/chord-hacks">
@endsection

@section('head')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
@endsection
