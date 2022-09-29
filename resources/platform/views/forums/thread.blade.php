@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ $threadTitle }} | {{$categoryTitle}} | Forums | {{ $brand }}</title>
@endsection

@section('breadcrumbs')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('platform.home'),
            ],
            [
                "title" => "Forums",
                "url" => url()->route('forums.show-categories'),
            ],
            [
                "title" => $categoryTitle,
                "url" => $categoryUrl,
            ],
            [
                "title" => $threadTitle,
            ]
        ]
    ])
@endsection

@section('content')

    <forum-thread
        theme-color="{{ $brand }}"
        brand="{{ $brand }}"
        :thread="{{ $thread }}"
        :current-user="{{ $currentUser }}"
        previous-page="{{ $categoryUrl }}"
        post-store-form-url="{{ url()->route('railforums.post.store')}}"
        update-post-base-route="{{ url()->route('railforums.post.update',['#####']).'?redirect='.url()->route('forums.jump-to-post',['#####']) }}"
    />

@endsection
