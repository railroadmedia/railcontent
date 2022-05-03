@extends('partials.layout')

@section('meta')
    <title>Home | Musora</title>
@endsection

@section('content')


        {{-- v-cloak: Wait Until Page Container has loaded --}}
        <div v-cloak>

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
                @if($startedContentCount > 0)
                    @component('partials.bladesora.members.components.home._continue-section', [
                        'brand' => brand(),
                        'hasStartedContent' => $startedContentCount > 0,
                        'contentEndpoint' => '/railcontent/content',
                        'continueUrl' => '', // todo: need url
                        'seeAllUrl' => '', // todo: need url
                        'startedContentJson' => $startedContentJson,
                        ])
                    @endcomponent
                @endif

                {{-- New Section --}}
                @component('partials.bladesora.members.components.home._new-section', [
                    'brand' => brand(),
                    'contentEndpoint' => '/laravel/public/railcontent/content',
                    'allLessonsUrl' => '', // todo: need url
                    'newContentJson' => $newContentJson,
                    ])
                @endcomponent

                {{-- Popular Conversations --}}
                @if(count($hotForumTopics) > 0)
                    @component('partials.bladesora.members.components.home._conversations-section', [
                        'brand' => brand(),
                        'forumUrl' => brand() . '/forums',
                        'forumPosts' => $hotForumTopics,
                        ])
                    @endcomponent
                @endif

                {{-- From Subscribed Coaches --}}
                @if($hasfollowedLessons)
                    @component('partials.bladesora.members.components.home._followed-section', [
                        'brand' => brand(),
                        'subscribedLessons' => '', // todo: need url
                        'contentEndpoint' => '/laravel/public/railcontent/content',
                        'followedLessons' => $followedLessons,
                        'hasfollowedLessons' => $hasfollowedLessons,
                        ])
                    @endcomponent
                @endif

                {{-- Subscribed Coaches --}}
                @component('partials.bladesora.members.components.home._coaches-section', [
                    'brand' => 'drumeo',
                    'hasSubscribedCoaches' => $hasSubscribedCoaches,
                    'subscribedCoaches' => $subscribedCoaches,
                    'subscribedCoachesUrl' => '', // todo: url
                    'allCoachesUrl' => '', // todo: url
                    ])
                @endcomponent

                {{-- My Playlists --}}
                @component('partials.bladesora.members.components.home._list-section', [
                    'brand' => brand(),
                    'myListUrl' => '', // todo: need url
                    'contentEndpoint' => '/laravel/public/railcontent/content',
                    'usersList' => $usersList,
                    ])
                @endcomponent

                {{-- Live Banner --}}
                <coach-event
                    brand="{{ $brand }}"
                    :preloaded-content='{{ json_encode($coachEvent) }}'
                    current-date-string="{{ $currentDate }}"
                    subscription-calendar-id="{{ $calendarId }}"
                    youtube-event-id="{{ $youtubeId }}"
                    :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
                    event-coach-profile-url="{{ $eventCoachProfileUrl }}"
                ></coach-event>

                {{-- Upcoming Events --}}
                @if($hasUpcomingEvents)
                    @component('partials.bladesora.members.components.home._upcoming-section', [
                        'brand' => brand(),
                        'upcomingUrl' => '', // todo: url
                        'upcomingEvents' => $upcomingEvents,
                        'contentEndpoint' => '/laravel/public/railcontent/content',
                        ])
                    @endcomponent
                @endif

                {{-- My Stats --}}
                <stats-section
                    brand="{{ $brand }}"
                    :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
                    next-learning-path-level="{{ $nextLearningPathLevel }}"
                    :userMetrics="{{ json_encode($userMetrics) }}"
                ></stats-section>
            </div>
        </div>

@endsection



