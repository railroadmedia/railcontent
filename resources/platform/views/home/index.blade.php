@php
    //Test Data
    $isSubscriber = true;
    $page = Request::segment(1);
    $brand = request()->get('brand');
    //My Stats Data
    $nextLearningPathProgressPercent = "0";
    $nextLearningPathLevel = "1.1";
    $userMetrics = "[]";
    //Coach Event
    $coachEvent = "{}";
    $currentDate = "2022-04-06";
    $calendarId = "12";
    $youtubeId = "fuvdhzGy3fo";
    $timeCutoffMinutes = "10";
    $eventCoachProfileUrl = "";
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

                    {{-- On Boarding --}}

                    {{-- Carousel --}}
                    <header-carousel 
                        :preloaded-carousel="[]" 
                        brand="{{ $brand }}">
                    </header-carousel>
                    
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
                    <coach-event 
                        brand="{{ $brand }}" 
                        v-if="{{ !empty($coachEvent) }}"
                        :preloaded-content='{{ $coachEvent }}'
                        current-date-string="{{ $currentDate }}" 
                        subscription-calendar-id="{{ $calendarId }}"
                        youtube-event-id="{{ $youtubeId }}" 
                        :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
                        event-coach-profile-url="{{ $eventCoachProfileUrl }}"
                    ></coach-event>

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
