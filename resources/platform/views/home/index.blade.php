@php
    $isSubscriber = true;
    $page = Request::segment(1);
    $brand = request()->get('brand');
@endphp

@extends('partials.layout')

@section('meta')
    <title>Home | Musora</title>
@endsection

@section('content')
    <page-container>

        {{-- v-cloak: Wait Until Page Container has loaded --}}
        <div v-cloak>

            @if ($isSubscriber)

                <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white">

                    {{-- Carousel --}}

                    
                    {{-- Home Cards --}}
                    <home-card-links brand="{{ $brand }}"/>

                    {{-- Continue Section --}}
                    <content-card-section
                        title="Continue"
                        type="video"
                        isVisible=""
                        data=""
                    >

                    {{-- New Section --}}
                    <content-card-section
                        title="New"
                        type="video"
                        isVisible=""
                        data=""
                    >

                    {{-- Popular Conversations --}}
                    <content-card-section
                        title="From Subscribed Coaches"
                        type="forum"
                        brand="{{ $brand }}"
                        isVisible=""
                        data=""
                    >

                    {{-- From Subscribed Coaches --}}
                    <content-card-section
                        title="From Subscribed Coaches"
                        type="video"
                        isVisible=""
                        data=""
                    >

                    {{-- Subscribed Coaches --}}
                    <content-card-section
                        title="Subscribed Coaches"
                        type="coach"
                        isVisible=""
                        data=""
                    >

                    {{-- My Playlists --}}
                    <content-card-section
                        title="My Playlists"
                        type="playlist"
                        isVisible=""
                        data=""
                    >

                    {{-- Live Banner --}}
                    

                    {{-- Upcoming Events --}}
                    <content-card-section
                        title="Upcoming Events"
                        type="video"
                        isVisible=""
                        data=""
                    >

                    {{-- My Stats --}}

                </div>

            @endif
            
        </div>
        
    </page-container>
@endsection
