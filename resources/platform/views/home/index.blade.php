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
                    
                    <!-- Home Card Links -->
                    <home-card-links brand="{{ $brand }}"></home-card-links>
                    
                    {{-- Continue Section --}}
                    <card-section
                        title="Continue"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></card-section>

                    {{-- New Section --}}
                    <card-section
                        title="New"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></card-section>

                    {{-- Popular Conversations --}}
                    <card-section
                        title="From Subscribed Coaches"
                        type="forum"
                        brand="{{ $brand }}"
                        isVisible=""
                        :data="[]"
                    ></card-section>

                    {{-- From Subscribed Coaches --}}
                    <card-section
                        title="From Subscribed Coaches"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></card-section>

                    {{-- Subscribed Coaches --}}
                    <card-section
                        title="Subscribed Coaches"
                        type="coach"
                        isVisible=""
                        :data="[]"
                    ></card-section>

                    {{-- My Playlists --}}
                    <card-section
                        title="My Playlists"
                        type="playlist"
                        isVisible=""
                        :data="[]"
                    ></card-section>

                    {{-- Live Banner --}}


                    {{-- Upcoming Events --}}
                    <card-section
                        title="Upcoming Events"
                        type="video"
                        isVisible=""
                        :data="[]"
                    ></card-section>

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
