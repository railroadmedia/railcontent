@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <meta property="og:title" content="Chord Hacks">

    <meta name="description" content="The easier way to learn piano chords so you can play popular songs!">
    <meta property="og:description" content="The easier way to learn piano chords so you can play popular songs!">

    <meta property="og:image" content="https://pianote.s3.amazonaws.com/chord-hacks/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/chord-hacks">
@endsection

@section('head')
    <link href="{{ asset('/marketing/parcel/pianote/lead-gen-learn-songs.css') }}" rel="stylesheet">
@endsection
