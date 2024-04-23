@extends('partials.layout', ['trackingSectionName' => 'coaches'])

@section('meta')
    <title>{{ ucfirst($brand) }} Coaches | Musora</title>
@endsection

@section('content')

    @component('partials.bladesora.members.components.header-banner', [
        'hideUser' => true,
        'backgroundImage' => 'https://d3fzm1tzeyr5n3.cloudfront.net/headers/'.$brand.'-header.jpg',
        'brand' => '{{ $brand }}'
    ])
        @slot('content')
            <div class="tw-flex tw-flex-col tw-pr-1">
                <h1 class="heading tw-text-white tw-flex tw-flex-row tw-justify-start tw-mb-2">
                    <musora-icon icon-name="whistle-filled" class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                    Coaches
                </h1>

                <p class="text-white body tw-max-w-[960px]">
                    @if($brand === "drumeo")
                        Your drumming journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best drummers in the world!
                    @elseif($brand === "pianote")
                        Your piano journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best pianists in the world!
                    @elseif($brand === "guitareo")
                        Tackle your next guitar goal with bite-sized courses from many of the world's best guitarists.
                    @elseif($brand === "singeo")
                        Your singing journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best singers and vocal coaches in the world!
                    @endif
                </p>
            </div>
        @endslot
    @endcomponent

    @if( !empty($coachEvent) )
        <div class=" tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-4">
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

    {{-- Featured Coach --}}
    @component('partials.bladesora.members.components.coach-featured', [
        'hasFeaturedCoaches' => $hasFeaturedCoaches,
        'featuredCoaches' => $featuredCoaches,
        'brand' => $brand,
    ])
    @endcomponent

    {{--  Latest Featured Lessons  --}}
    <div class="tw-px-4 md:tw-px-8 tw-mb-[30px]">
        <mini-catalogue-section
            title="Latest Featured Lessons"
            :pre-loaded-content="{{ json_encode(json_decode($latestLessons)->data) }}"
        ></mini-catalogue-section>
    </div>

    {--  From Subscribed Coaches  --}}
    @if($hasFollowedCoaches)
        <div class="tw-px-4 md:tw-px-8 tw-mb-[30px]">
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

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mb-3">
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

