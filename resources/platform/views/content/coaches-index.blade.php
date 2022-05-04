@extends('partials.layout')

@section('meta')
    <title>Coaches | Musora</title>
@endsection

@section('content')
        <div v-cloak>

            @component('partials.bladesora.members.components.header-banner', [
                'hideUser' => true,
                'backgroundImage' => 'https://dmmior4id2ysr.cloudfront.net/assets/images/singeo-members-header-background-image.jpg',
                'brand' => '{{ $brand }}'
            ])
                @slot('content')
                    <div class="tw-flex tw-flex-col tw-pr-1">
                        <h1 class="heading tw-text-white tw-flex tw-flex-row tw-justify-start">
                            <span class="svg-icon tw-text-{{ $brand }} tw-mr-1">
                                <svg width="36" height="36" aria-hidden="true" fill="currentColor" focusable="false">
                                    <use href="#whistle"></use>
                                </svg>
                            </span>
                            Coaches
                        </h1>

                        <p
                            class="text-white body"
                            style="max-width:960px"
                        >
                            Every month, you’ll have new opportunities to learn from your coaches. You can choose the topics
                            that you need help with OR follow the coach that works with your style and what you want to achieve
                            with your voice. And you’ll always get the full recording so you never miss that ‘aha’ moment you’ve
                            been waiting for.
                        </p>
                    </div>
                @endslot
            @endcomponent

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

            <!-- Featured Coaches -->
            @component('partials.bladesora.members.components.coach-featured', [
                'hasFeaturedCoaches' => $hasFeaturedCoaches,
                'featuredCoaches' => $featuredCoaches,
                'brand' => '{{ $brand }}',
            ])
            @endcomponent

            <div class="tw-container tw-mx-auto tw-mt-2 tw-mb-3">
                <div class="tw-flex tw-flex-row tw-mb-3">
                    <div class="tw-flex tw-flex-col tw-flex-grow">
                        <div class="tw-flex tw-flex-row tw-items-center pv-2">
                                <span class="tw-rounded tw-bg-{{ $brand }} tw-text-white icon-bg-circle body tw-mr-1">
                                    <i class="fas fa-bolt"></i>
                                </span>

                            <h2 class="heading tw-capitalize tw-flex-grow">
                                Latest Featured Lessons
                            </h2>
                        </div>

                        <div class="tw-flex tw-flex-row six-cards-row">
                            <transition appear name="fade">
                                <content-catalogue
                                    brand="{{ $brand }}"
                                    theme-color="{{$themeColor}}"
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
                <div class="tw-container tw-mx-auto tw-mt-2 tw-mb-3">
                    <div class="tw-flex tw-flex-row tw-mb-3">
                        <div class="tw-flex tw-flex-col tw-flex-grow">
                            <div class="tw-flex tw-flex-row tw-items-center pv-2">
                                <span class="tw-rounded tw-bg-{{ $brand }} tw-text-white icon-bg-circle body tw-mr-1">
                                    <i class="fas fa-star"></i>
                                </span>

                                <h2 class="heading tw-capitalize tw-flex-grow">
                                    From Subscribed Coaches
                                </h2>
                            </div>

                            <div class="tw-flex tw-flex-row six-cards-row">
                                <transition appear name="fade">
                                    <content-catalogue
                                            brand="{{ $brand }}"
                                            theme-color="{{$themeColor}}"
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

            <div class="tw-container tw-mx-auto tw-mb-3">
                <transition appear name="fade">
                    <content-catalogue
                            theme-color="{{$themeColor}}"
                            brand="{{ $brand }}"
                            content-endpoint="/railcontent/content?only_subscribed={{$onlySubscribedCoaches}}"
                            catalogue-type="coaches-grid"
                            limit="{{ $limitOverride ?? 18 }}"
                            :infinite-scroll="true"
                            :statuses="{{ json_encode(['published', 'scheduled']) }}"
                            :filterable-values="{{ json_encode(['focus','style']) }}"
                            :included-types="{{ json_encode(['instructor']) }}"
                            :required-fields="{{json_encode(['is_coach,1'])}}"
                            :pre-loaded-content="{{ $coaches->toResponseRawJson() }}"
                            user-id="{{ auth()->id() }}"
                            :is-admin="{{ json_encode(user()->isAdmin()) }}"
                            :use-url-params="true"
                            :lock-unowned="true"
                            :show-loading-animation="true"
                            sort-override="slug"
                            :six-wide="true"

                            @if(!empty($showSearch))
                            :search-bar="true"
                            :total-results="{{ $limitOverride ?? 18 }}"
                            :search-endpoint="{{json_encode(url()->route('content.index'))}}"
                            @endif
                    >
                        @for($i = 0; $i < ($limitOverride ?? 18); $i++)
                            @include('partials.bladesora.members.skeletons.card-item', [
                            "cardClass" => 'six-wide',
                            ])
                        @endfor
                    </content-catalogue>
                </transition>
            </div>

        </div>
@endsection

