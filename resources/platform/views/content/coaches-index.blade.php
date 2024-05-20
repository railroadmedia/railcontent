@php
    $headerDescription = "";
    if ($brand === "drumeo") {
        $headerDescription = "Your drumming journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best drummers in the world!";
    } elseif ($brand === "pianote") {
        $headerDescription = "Your piano journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best pianists in the world!";
    } elseif ($brand === "guitareo") {
        $headerDescription = "Tackle your next guitar goal with bite-sized courses from many of the world's best guitarists.";
    } elseif ($brand === "singeo") {
        $headerDescription = "Your singing journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best singers and vocal coaches in the world!";
    }

    $breadcrumbs = [
        [
            'title' => 'Coaches',
        ]
    ];
@endphp

@extends('partials.layout', ['trackingSectionName' => 'coaches'])

@section('meta')
    <title>{{ ucfirst($brand) }} Coaches | Musora</title>
@endsection

@section('content')
    <coach-index
        :breadcrumbs="{{ json_encode($breadcrumbs) }}"
        header-description="{{ $headerDescription }}"
        :coach-event="{{ json_encode($coachEvent) }}"
        @if(!empty($coachEvent))
            current-date="{{ $currentDate }}"
            subscription-calendar-id="{{ $currentEventCalendarId }}"
            youtube-event-id="{{ $youtubeId }}"
            time-cutoff-minutes="{{ $timeCutoffMinutes }}"
            event-coach-profile-url="{{ $eventCoachProfileUrl }}"
        @endif
        :has-featured-coaches=""
    ></coach-index>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <breadcrumb :breadcrumbs="{{ json_encode($breadcrumbs) }}"></breadcrumb>
        <page-header
            title="Coaches"
            icon-name="whistle"
            description="{{ $headerDescription }}"
        >
        </page-header>
    </div>
    @if( !empty($coachEvent) )
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mt-4">
            {{-- Live Banner --}}
            <coach-event
                brand="{{ $brand }}"
                :preloaded-content='{{ $coachEvent }}'
                current-date-string="{{ $currentDate }}"
                subscription-calendar-id="{{ $currentEventCalendarId }}"
                youtube-event-id="{{ $youtubeId }}"
                :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
                event-coach-profile-url="{{ $eventCoachProfileUrl }}"
            ></coach-event>
        </div>
    @endif

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">

        {{-- Featured Coach --}}
        @component('partials.bladesora.members.components.coach-featured', [
            'hasFeaturedCoaches' => $hasFeaturedCoaches,
            'featuredCoaches' => $featuredCoaches,
            'brand' => $brand,
        ])
        @endcomponent

        {{--  Latest Featured Lessons  --}}
        <div class="tw-mb-[30px]">
            <mini-catalogue-section
                title="Latest Featured Lessons"
                :pre-loaded-content="{{ json_encode(json_decode($latestLessons)->data) }}"
            ></mini-catalogue-section>
        </div>

        {{--  From Subscribed Coaches  --}}
        @if($hasFollowedCoaches)
            <div class="tw-mb-[30px]">
                <mini-catalogue-section
                    title="From Subscribed Coaches"
                    see-all-url="/{{ $brand }}/lessons/subscribed"
                    seeAllAriaLabel="See All From Subscribed Coaches"
                    :pre-loaded-content="{{ json_encode(json_decode($latestSubscribedLessons)->data) }}"
                ></mini-catalogue-section>
            </div>
        @endif

        <!-- Upcoming Coaches -->
        @component('partials.bladesora.members.components.coach-upcoming', [
            'hasUpcomingCoaches' => $hasUpcomingCoaches,
            'upcomingCoaches' => $upcomingCoaches,
            'brand' => '{{ $brand }}',
        ])
        @endcomponent

        <!-- Active Coaches -->
        @component('partials.bladesora.members.components.coach-active', [
            'hasActiveCoaches' => $hasActiveCoaches,
            'activeCoaches' => $activeCoaches,
            'brand' => '{{ $brand }}'
        ])
        @endcomponent

        <collection-wrapper
            collection-type="coach"
            :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
            :included-types="{{ json_encode(['instructor']) }}"
            :limit="{{ $limitOverride ?? 18 }}"
            :pre-loaded-content="{{ $coaches->toResponseRawJson() }}"
            :required-fields="{{json_encode(['is_coach,1'])}}"
            :statuses="{{ json_encode(['published', 'scheduled']) }}"
            :tab-options="{{ json_encode([
                [ 'key' => 'allCoaches', 'value' => 'All Coaches' ],
                [ 'key' => 'subscribedCoaches', 'value' => 'Subscribed Coaches' ]
            ]) }}"
            default-sort="slug"
            :show-progress-filters="{{ json_encode(false) }}"
        ></collection-wrapper>
    </div>

@endsection

