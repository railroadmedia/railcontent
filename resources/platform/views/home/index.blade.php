@php
    //Test Data
    $isSubscriber = true;
    $page = Request::segment(1);
    $brand = request()->get('brand');
    //My Stats Data
    $nextLearningPathProgressPercent = "0";
    $nextLearningPathLevel = "1.1";
    $userMetrics = "[]";
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
                    <header-carousel></header-carousel>
                    
                    <!-- Home Card Links -->
                    <home-card-links brand="{{ $brand }}"></home-card-links>
                    
                    {{-- Continue Section --}}
                    <catalog-section
                        title="Continue"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- New Section --}}
                    <catalog-section
                        title="New"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- Popular Conversations --}}
                    <catalog-section
                        title="Popular Conversations"
                        type="forum"
                        brand="{{ $brand }}"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- From Subscribed Coaches --}}
                    <catalog-section
                        title="From Subscribed Coaches"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- Subscribed Coaches --}}
                    <catalog-section
                        title="Subscribed Coaches"
                        type="coach"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- My Playlists --}}
                    <catalog-section
                        title="My Playlists"
                        type="playlist"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- Live Banner --}}


                    {{-- Upcoming Events --}}
                    <catalog-section
                        title="Upcoming Events"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></catalog-section>

                    {{-- My Stats --}}
                    <stats-section
                        brand="{{ $brand }}"
                        :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
                        next-learning-path-level="{{ $nextLearningPathLevel }}"
                        :userMetrics="{{ $userMetrics }}"
                    ></stats-section>
                </div>

            @endif
            
        </div>
        
    </page-container>
@endsection
