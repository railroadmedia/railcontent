<?php
$layout = 'books.layout';
if (!empty($user)) {
    $layout = 'partials.layout';
} ?>

@extends($layout)

@section('meta')
    <title>The Drummer's Toolbox | Musora</title>
    <meta name="author" content="Brandon Toews">
    <meta name="description"
        content="Here you will find all the digital resources that pair with the material in
        The Drummer’s Toolbox. These including pre-built Recommended Listening playlists, drumless play-along
        tracks, and tons of Drumeo resources.">

    {{--    <meta property="og:image" content="{{ cdn('books/drummers-toolbox/share-image.png') }}"> --}}
    <meta property="og:description"
        content="Here you will find all the digital resources that pair with the material
        in The Drummer’s Toolbox. These including pre-built Recommended Listening playlists, drumless play-along
        tracks, and tons of Drumeo resources.">
    <meta property="og:title" content="The Drummer's Toolbox">
@endsection

@section('content')
    <drummers-toolbox
        :is-digital="{{ json_encode($isDigital) }}"
        :user="{{ $user }}"
        @if(!empty($user))
            :is-edge="{{ json_encode($isEdge) }}"
            :is-pack-owner="{{ json_encode($isPackOwner) }}"
        @endif
        :chapters="{{ json_encode($chapters) }}"
        redeem-api="{{ url()->route('access-codes.claim') }}"
        trial-url="{{ url()->route('books.drummers-toolbox.trial') }}"
        login-api="{{ url()->route('user_management_system.login.cookie').'?redirect_to='.url()->current() }}"
    ></drummers-toolbox>
@endsection
