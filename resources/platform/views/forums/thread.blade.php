@php
    $bodyClass = ($bodyClass ?? '') . 'tw-bg-gray-50  sidebar';
    $leftSidebar = true;
@endphp
@extends('members.forums.forumlayout')

@section('meta')
    <title>{{ $threadTitle }} | {{$categoryTitle}} | Forums | Singeo</title>
@endsection

@section('styles')
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ mix('tailwindcss/tailwind.css') }}">
@endsection

@section('inject-components')
    <script src="{{ mix('assets/members/js/forum.js') }}"></script>
@endsection

@section('breadcrumbs')
    @include('bladesora::members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('members.home'),
            ],
            [
                "title" => "Forums",
                "url" => url()->route('forums.index'),
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
    @include('members.partials._content-sidebar')

    <forum-thread
            theme-color="singeo"
            brand="singeo"
            :thread="{{ $thread }}"
            :current-user="{{ $currentUser }}"
            previous-page="{{ $categoryUrl }}"
            update-post-base-route={{ url()->route('railforums.post.update',['#####']).'?redirect='.url()->route('forums.post.jump-to',['#####']) }}></forum-thread>
@endsection
