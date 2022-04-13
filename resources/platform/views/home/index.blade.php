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
                    
                    {{-- On Boarding TriggerBanner --}}
                    <trigger-banner :v-if="true"></trigger-banner>

                    {{-- Carousel --}}
                    <header-carousel 
                        :preloaded-carousel="[]" 
                        brand="{{ $brand }}">
                    </header-carousel>
                    
                    <!-- Home Card Links -->
                    <home-card-links brand="{{ $brand }}"></home-card-links>
                    
                    {{-- Continue Section --}}
                    {{-- @component('partials.bladesora.members.components.home._continue-section', [
                        'hasStartedContent' => !empty($startedContentArray),
                        'contentEndpoint' => '/railcontent/content',
                        'continueUrl' => url()->route('members.profile.lists', ['state' => 'started']),
                        'seeAllUrl' => url()->route('members.profile.lists', ['state' => 'started']),
                        'brand' => 'pianote',
                        'startedContent' => $startedContentJson,
                        ])
                    @endcomponent --}}

                    {{-- New Section --}}
                    {{-- @component('partials.bladesora.members.components.home._new-section', [
                        'brand' => 'drumeo',
                        'contentEndpoint' => '/laravel/public/railcontent/content',
                        'allLessonsUrl' => url()->route('members.lessons.all'),
                        'newContent' => $newContent,
                        ])
                    @endcomponent --}}

                    {{-- Popular Conversations --}}
                    {{-- @component('partials.bladesora.members.components.home._conversations-section', [
                        'brand' => 'drumeo',
                        'forumUrl' => 'https://forums.drumeo.com',
                        'forumPosts' => $hotForumTopics,
                        ])
                    @endcomponent --}}

                    {{-- From Subscribed Coaches --}}
                    {{-- @component('partials.bladesora.members.components.home._followed-section', [
                        'brand' => 'drumeo',
                        'subscribedLessons' => url()->route('members.lessons.subscribed'),
                        'contentEndpoint' => '/laravel/public/railcontent/content',
                        'followedLessons' => $followedLessons,
                        'hasfollowedLessons' => $hasfollowedLessons,
                        ])
                    @endcomponent --}}

                    {{-- Subscribed Coaches --}}
                    {{-- @component('partials.bladesora.members.components.home._coaches-section', [
                        'brand' => 'drumeo',
                        'hasSubscribedCoaches' => $hasSubscribedCoaches,
                        'subscribedCoaches' => $subscribedCoaches,
                        'subscribedCoachesUrl' => '/members/coaches?only_subscribed=true#coach-section',
                        'allCoachesUrl' => '/members/coaches?only_subscribed=true#coach-section"',
                        ])
                    @endcomponent --}}

                    {{-- My Playlists --}}
                    {{-- @component('partials.bladesora.members.components.home._list-section', [
                        'brand' => 'drumeo',
                        'myListUrl' => url()->route('user.lists', ['id' => auth()->id()]),
                        'contentEndpoint' => '/laravel/public/railcontent/content',
                        'usersList' => $usersList,
                        ])
                    @endcomponent --}}
                    
                    {{-- Live Banner --}}
                    <coach-event 
                        brand="{{ $brand }}" 
                        :preloaded-content='{{ $coachEvent }}'
                        current-date-string="{{ $currentDate }}" 
                        subscription-calendar-id="{{ $calendarId }}"
                        youtube-event-id="{{ $youtubeId }}" 
                        :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
                        event-coach-profile-url="{{ $eventCoachProfileUrl }}"
                    ></coach-event>

                    {{-- Upcoming Events --}}
                    {{-- @component('partials.bladesora.members.components.home._upcoming-section', [
                        'brand' => 'drumeo',
                        'upcomingUrl' => url()->route('members.live'),
                        'upcomingEvents' => $upcomingEvents,
                        'contentEndpoint' => '/laravel/public/railcontent/content',
                        ])
                    @endcomponent --}}

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



