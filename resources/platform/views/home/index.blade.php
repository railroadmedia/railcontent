@php
  require_once(resource_path('platform/views/home/test_data.php'))
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
                    {{-- <onboarding></onboarding> --}}

                    {{-- Carousel --}}
                    <header-carousel 
                        :preloaded-carousel="[]" 
                        brand="{{ $brand }}">
                    </header-carousel>
                    
                    <!-- Home Card Links -->
                    <home-card-links brand="{{ $brand }}"></home-card-links>
                    
                    {{-- Continue Section --}}
                    <catalog-section
                        brand="{{ $brand }}" 
                        title="Continue"
                        type="video"
                        :is-visible="true"
                        url="/members/profile/397822/lists?state=started"
                        :preloaded-content="{{ $startedContent }}"
                        content-endpoint="/railcontent/content"
                    ></catalog-section>

                    {{-- New Section --}}
                    <catalog-section
                        brand="{{ $brand }}" 
                        title="New"
                        type="video"
                        :is-visible="true"
                        url="/members/lessons/all"
                        :preloaded-content="{{ $newContent }}"
                        content-endpoint="/railcontent/content"
                    ></catalog-section>

                    {{-- Popular Conversations --}}
                    <catalog-section
                        title="Popular Conversations"
                        type="forum"
                        brand="{{ $brand }}"
                        :is-visible="true"
                        url="/members/forums"
                        :preloaded-content="{{ $forumPosts }}"
                        content-endpoint="/railcontent/content"
                    ></catalog-section>

                    {{-- From Subscribed Coaches --}}
                    <catalog-section
                        brand="{{ $brand }}" 
                        title="From Subscribed Coaches"
                        type="video"
                        :is-visible="{{ $hasfollowedLessons }}"
                        url="/members/lessons/subscribed"
                        :preloaded-content="{{ $followedLessons }}"
                        content-endpoint="/railcontent/content"
                    ></catalog-section>

                    {{-- Subscribed Coaches --}}
                    <catalog-section
                        brand="{{ $brand }}" 
                        title="Subscribed Coaches"
                        type="coach"
                        :is-visible="{{ $hasSubscribedCoaches }}"
                        url="/members/coaches?only_subscribed=true#coach-section"
                        :preloaded-content="{{ $hasSubscribedCoaches }}"
                        content-endpoint="/railcontent/content"
                    ></catalog-section>

                    {{-- My Playlists --}}
                    <catalog-section
                        brand="{{ $brand }}" 
                        title="My Playlists"
                        type="playlist"
                        :is-visible="true"
                        url="/members/profile/397822/lists"
                        :preloaded-content="{{ $usersListContent }}"
                        content-endpoint="/railcontent/content"
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
                        brand="{{ $brand }}" 
                        title="Upcoming Events"
                        type="video"
                        :is-visible="true"
                        url="/members/live"
                        :preloaded-content="{{ $upcomingEvents }}"
                        content-endpoint="/railcontent/content"
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
