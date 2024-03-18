@extends('partials.layout')

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
                            :force-wide-thumbs="true"
                            :pre-loaded-content="{{ $latestLessons }}"
                        >
                            <div class="tw-flex tw-flex-row nmh-1">
                                @for($i = 0; $i < 6; $i++)
                                    @include('partials.bladesora.members.skeletons.card-item')
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
    </div>

@endsection

