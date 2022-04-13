@php
    $bodyClass = ($bodyClass ?? '') . 'tw-bg-gray-50  sidebar';
    $leftSidebar = true;
@endphp
@extends('forums.forumlayout')

@section('meta')
    <title>{{ $threadTitle }} | {{$categoryTitle}} | Forums | {{ $brand }}</title>
@endsection

@section('breadcrumbs')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('home'),
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
    <page-container>

        <div v-cloak>

            <forum-thread
                theme-color="{{ $brand }}"
                brand="{{ $brand }}"
                :thread="{{ $thread }}"
                :current-user="{{ $currentUser }}"
                previous-page="{{ $categoryUrl }}"
                update-post-base-route={{ url()->route('railforums.post.update',['#####']).'?redirect='.url()->route('forums.post.jump-to',['#####']) }}
            />

        </div>

    </page-container>
@endsection
