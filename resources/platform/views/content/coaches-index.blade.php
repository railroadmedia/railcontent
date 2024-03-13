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
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Coaches | Musora</title>
@endsection

@section('content')

    <page-header
        title="Coaches"
        icon-name="whistle-filled"
        description="{{ $headerDescription }}"
    >
    </page-header>

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

    <div class=" tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-2 tw-mb-[30px]">
        <div class="tw-flex tw-flex-row tw-mb-3">
            <div class="tw-flex tw-flex-col tw-flex-grow">
                <div class="tw-text-[#00101D] dark:tw-text-white tw-pb-1">
                    <h2 class="tw-font-bold tw-text-xl md:tw-text-2xl tw-mb-3">
                        Latest Featured Lessons
                    </h2>
                </div>

                <div class="tw-flex tw-flex-row six-cards-row">
                    <transition appear name="fade">
                        <content-catalogue
                            brand="{{ $brand }}"
                            theme-color="{{ $brand }}"
                            :use-theme-color="true"
                            content-endpoint="/railcontent/content"
                            catalogue-type="grid"
                            limit="16"
                            :lock-unowned="true"
                            :six-wide="true"
                            :force-wide-thumbs="true"
                            :pre-loaded-content="{{ $latestLessons }}"
                        >
                            <div class="tw-flex tw-flex-row nmh-1">
                                @for($i = 0; $i < 6; $i++)
                                    @include('partials.bladesora.members.skeletons.card-item', [
                                        "cardClass" => 'six-wide',
                                    ])
                                @endfor
                            </div>
                        </content-catalogue>
                    </transition>
                </div>
            </div>
        </div>
    </div>

    @if($hasFollowedCoaches)
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-2 tw-mb-[30px]">
            <div class="tw-flex tw-flex-row tw-mb-3">
                <div class="tw-flex tw-flex-col tw-flex-grow">

                    <!-- Section Title -->
                    <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                        <a href="/{{ $brand }}/lessons/subscribed" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                            <h2 class="tw-font-bold tw-text-xl md:tw-text-2xl">From Subscribed Coaches</h2>
                        </a>
                        <a href="/{{ $brand }}/lessons/subscribed"
                            aria-label="See All Subscribed Lessons"
                            class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                        >
                            See All
                        </a>
                    </div>

                    <div class="tw-flex tw-flex-row six-cards-row">
                        <transition appear name="fade">
                            <content-catalogue
                                brand="{{ $brand }}"
                                theme-color="{{ $brand }}"
                                :use-theme-color="true"
                                content-endpoint="/railcontent/content"
                                catalogue-type="grid"
                                limit="16"
                                :lock-unowned="true"
                                :four-wide="true"
                                :force-wide-thumbs="true"
                                :pre-loaded-content="{{ $latestSubscribedLessons }}"
                            >
                                <div class="tw-flex tw-flex-row nmh-1">
                                    @for($i = 0; $i < 6; $i++)
                                        @include('partials.bladesora.members.skeletons.card-item', [
                                            "cardClass" => 'four-wide',
                                        ])
                                    @endfor
                                </div>
                            </content-catalogue>
                        </transition>
                    </div>
                </div>
            </div>
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
{{--        <transition appear name="fade">--}}
{{--            <content-catalogue--}}
{{--                    theme-color="{{ $brand }}"--}}
{{--                    brand="{{ $brand }}"--}}
{{--                    content-endpoint="/railcontent/content?only_subscribed={{$onlySubscribedCoaches}}"--}}
{{--                    catalogue-type="coaches-grid"--}}
{{--                    limit="{{ $limitOverride ?? 18 }}"--}}
{{--                    :infinite-scroll="true"--}}
{{--                    :statuses="{{ json_encode(['published', 'scheduled']) }}"--}}
{{--                    :filterable-values="{{ json_encode(['focus','style']) }}"--}}
{{--                    :included-types="{{ json_encode(['instructor']) }}"--}}
{{--                    :required-fields="{{json_encode(['is_coach,1'])}}"--}}
{{--                    :pre-loaded-content="{{ $coaches->toResponseRawJson() }}"--}}
{{--                    user-id="{{ auth()->id() }}"--}}
{{--                    :is-admin="{{ json_encode(user()->isAdmin()) }}"--}}
{{--                    :use-url-params="true"--}}
{{--                    :lock-unowned="true"--}}
{{--                    :show-loading-animation="true"--}}
{{--                    sort-override="slug"--}}
{{--                    :six-wide="true"--}}

{{--                    @if(!empty($showSearch))--}}
{{--                    :search-bar="true"--}}
{{--                    :total-results="{{ $limitOverride ?? 18 }}"--}}
{{--                    :search-endpoint="{{json_encode(url()->route('content.index'))}}"--}}
{{--                    @endif--}}
{{--            >--}}
{{--                @for($i = 0; $i < ($limitOverride ?? 18); $i++)--}}
{{--                    @include('partials.bladesora.members.skeletons.card-item', [--}}
{{--                    "cardClass" => 'six-wide',--}}
{{--                    ])--}}
{{--                @endfor--}}
{{--            </content-catalogue>--}}
{{--        </transition>--}}
    </div>

@endsection

