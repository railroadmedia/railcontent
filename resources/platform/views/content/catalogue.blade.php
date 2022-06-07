@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@section('layout-styles')
    <style>
        .search-button-col {
            -webkit-box-tw-flex: 0;
            -ms-tw-flex: 0 0 50px;
            tw-flex: 0 0 50px;
            max-width: 50px;
            min-width: 50px;
        }

        button.btn.page-button {
            margin: 0 3px;
        }

        button.btn.page-button > span {
            border-width: 1px;
            font-weight: 500;
        }
    </style>
@endsection

@section('layout-scripts')
    @if($lessonType === 'student-review')
        {{-- todo: script --}}
        {{--        <script src="{{ mix('assets/members/js/student-review-form.js') }}"></script>--}}
    @endif
@endsection

@section('content')
    <div v-cloak>

        @component('partials._header-banner',
            ['backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',])
            @slot('content')
                <div class="tw-inline-tw-flex tw-w-full tw-tw-flex-col tw-pr-4">
                    <h1 class="tw-text-white tw-flex tw-items-center tw-mb-1">
                        @if($catalogueMeta['name'] == 'Q&A')
                            <musora-icon icon-name="light-bulb-filled"
                                         class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'Routines')
                            <musora-icon icon-name="routines"
                                         class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'Quick Tips')
                            <musora-icon icon-name="light-bulb-filled"
                                         class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'Songs')
                            <musora-icon icon-name="headphones-filled"
                                         class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'Bootcamps')
                            <musora-icon icon-name="keys-filled"
                                         class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'The Pianote Podcast')
                            <musora-icon icon-name="podcast-filled"
                                         class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'Student Focus')
                            <musora-icon icon-name="person-plus-filled"
                                         class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'Q & A')
                            <musora-icon icon-name="question-mark-circle"
                                         class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'Student Reviews')
                            <musora-icon icon-name="person-plus-filled"
                                         class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'Chords & Scales')
                            <musora-icon icon-name="guitar-tabs-filled"
                                         class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @elseif($catalogueMeta['name'] == 'Archives')
                            <musora-icon icon-name="archives-filled"
                                         class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @else
                            <musora-icon icon-name="academic-cap-filled"
                                         class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        @endif
                        <span class="tw-text-32">{{ ucfirst($catalogueMeta['name']) }}</span>
                    </h1>
                    <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                        {{ $catalogueMeta['description'] }}
                    </p>
                </div>
            @endslot

            @slot('interactionSlot')
                @if($lessonType === 'student-review' && $brand === 'singeo')
                    @include('partials._student-review-application-singeo')
                @endif

                @if($lessonType === 'student-review' && $brand === 'guitareo')
                    @include('partials._student-review-application-guitareo')
                @endif

                @if($lessonType === 'student-review' && $brand === 'pianote')
                    @include('partials._student-review-application-pianote')
                @endif

                @if($lessonType === 'student-focus' && $brand === 'drumeo')
                    @include('partials._student-focus-application-drumeo')
                @endif

                @if($lessonType === 'question-and-answer')
                    @include('partials._ask-question-form')
                @endif

                @if($lessonType === 'routine')
                    @include('partials._routine-modal')
                @endif
            @endslot
        @endcomponent

        @if(session()->has('success-message'))
            <div class="form-success-message container mt-3">
                <div class="flex flex-column bg-success shadow corners-10 pa">
                    <p class="body text-white">{{ session()->get('success-message') }}</p>
                </div>
            </div>
        @endif

        @if($hasStartedLessons)
            <section class="tw-container tw-mx-auto tw-pt-4 md:tw-pt-5 md:tw-px-8">
                <div class="flex flex-row tw-pt-4">
                    <h1 class="heading capitalize pointer noselect tw-text-black dark:tw-text-white tw-border-b-2 tw-border-{{ $brand }}"
                        data-toggle-catalogue="inProgress">
                        In Progress
                    </h1>
                </div>

                <div id="inProgress"
                    class="tw-flex tw-flex-row tw-pt-5 tw-pb-2 tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457] feature-catalogue six-cards-row">
                    <transition appear name="fade">
                        <content-catalogue
                            catalogue-type="grid"
                            theme-color="{{ $brand }}"
                            :pre-loaded-content="{{ $startedLessons }}"
                            user-id="{{ auth()->id() }}"
                            no-results-message="Looks like you haven't started any lessons.
                Once you watch a video, it will show up here for you to access later."
                            :six-wide="true"
                        >
                            <div class="flex flex-row nmh-1">
                                @for($i = 0; $i < 6; $i++)
                                    @include('partials.bladesora.members.skeletons.card-item', [
                                        "thumbnailType" => $lessonType === 'song' ? 'square' : 'widescreen',
                                        "cardClass" => "six-wide",
                                    ])
                                @endfor
                            </div>
                        </content-catalogue>
                    </transition>
                </div>
            </section>
        @endif

        {{--    @if($catalogueMeta['name'] == 'Routines')--}}
        {{--        <div class="tw-py-8 tw-w-full tw-bg-true-gray-800">--}}
        {{--            <div class="container">--}}
        {{--                <h2 class="tw-text-white"> --}}
        {{--                    <span class="tw-font-black tw-text-2xl">{{ $routinesCount }}</span> --}}
        {{--                    <span class="tw-text-base tw-uppercase tw-font-semibold">Routines</span>    --}}
        {{--                </h2>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    @endif--}}

        @if($lessonType === 'routine' && $hasRecentRoutines)
            <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-4 dark:tw-text-white">
                <div class="tw-flex tw-flex-col tw-flex-grow">
                    <div class="tw-flex tw-flex-row tw-items-center pv-2">
                        <div
                            class="tw-text-black dark:tw-text-white tw-no-underline heading tw-capitalize tw-flex-grow">
                            Recently Viewed
                        </div>
                    </div>
                    <div class="tw-flex tw-flex-row">
                        <transition appear name="fade">
                            <content-catalogue
                                brand="{{ $brand }}"
                                catalogue-type="routines"
                                limit="4"
                                theme-color="{{ $brand }}"
                                :use-theme-color="true"
                                :lock-unowned="true"
                                :pre-loaded-content="{{ $recentRoutines }}"
                                content-endpoint="/laravel/public/railcontent/content"
                            >
                                <div class="tw-flex tw-flex-row nmh-1">
                                    @for($i = 0; $i < 4; $i++)
                                        @include('partials.bladesora.members.skeletons.card-item', [
                                        ])
                                    @endfor
                                </div>
                            </content-catalogue>
                        </transition>
                    </div>
                </div>
            </div>
        @endif

        {{-- todo: readd once cal is working --}}
        {{--    <div class="container ph-1">--}}
        {{--        <div class="tw-flex tw-flex-col mt-3">--}}
        {{--            <div class="tw-flex tw-flex-row tw-flex-wrap pt-3 align-v-center">--}}
        {{--                <div class="tw-flex tw-flex-col xs-12 sm-8 md-9 mb-3">--}}
        {{--                    <h1 class="tw-text-black dark:tw-text-white heading tw-capitalize">All {{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}</h1>--}}
        {{--                </div>--}}
        {{--                <div class="tw-flex tw-flex-col xs-12 sm-4 md-3 mb-3">--}}
        {{--                    <button class="tw-btn-secondary tw-text-{{ $brand }}" data-open-modal="addToCalendarModal">--}}
        {{--                            <i class="fas fa-calendar-plus mr-1"></i>--}}
        {{--                            Subscribe to Calendar--}}
        {{--                    </button>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}

        @if($lessonType === 'student-review' || $lessonType === 'question-and-answer' || !empty($isAllContent))
            <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-4 dark:tw-text-white">
                <div class="tw-flex tw-flex-col tw-mt-3">
                    <div class="tw-flex tw-flex-row tw-flex-wrap pt-3 tw-items-center">
                        <div class="tw-flex tw-flex-col xs-12 sm-8 md-9 tw-mb-3">
                            <h1 class="tw-text-black dark:tw-text-white heading tw-capitalize">
                                All {{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}</h1>
                        </div>
                        <div class="tw-flex tw-flex-col xs-12 sm-4 md-3 tw-mb-3">
                            <button class="tw-btn-secondary tw-text-{{ $brand }}" data-open-modal="addToCalendarModal">
                                <i class="fas fa-calendar-plus mr-1"></i>
                                Subscribe to Calendar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-4 dark:tw-text-white">
            <transition appear name="fade">
                <content-catalogue
                    dusk="content-catalogue"
                    @if($lessonType === 'routine')
                    catalogue-type="routines"
                    :infinite-scroll="false"
                    :paginate="true"
                    limit="12"
                    @else
                    catalogue-type="list"
                    :infinite-scroll="true"
                    limit="20"
                    @endif
                    brand="{{ $brand }}"
                    theme-color="{{ $brand }}"
                    :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
                    @if($lessonType === 'quick-tips')
                    :included-types="{{ json_encode([$lessonType, 'boot-camps']) }}"
                    @else
                    :included-types="{{ json_encode(is_array($lessonType) ? $lessonType : [$lessonType] ) }}"
                    @endif
                    :use-theme-color="true"
                    :pre-loaded-content="{{ $listLessons }}"
                    user-id="{{ auth()->id() }}"
                    :is-admin="{{ json_encode(user()->isAdmin()) }}"
                    :statuses="{{ json_encode(user()->isAdmin() ? ['published', 'draft'] : ['published']) }}"
                    :use-url-params="true"
                    @if($lessonType === 'student-review' || !empty($isAllContent))
                    :force-wide-thumbs="true"
                    @endif
                    @if(!empty($isAllContent))
                    :search-bar="true"
                    search-endpoint="/railcontent/search"
                    total-results="{{ $totalResults }}"
                    @endif
                    @if(!empty($sortOverride))
                    sort-override="{{ $sortOverride }}"
                    @endif
                    subscription-calendar-id="{{ config('addevent.uniquekeys.brand-overview') }}"
                    :lock-unowned="true"
                    :show-loading-animation="true"
                    catalogue-name="{{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}"
                    no-results-message="There are no {{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}
                        that match those filters. Please remove some filters."
                >
                    @include('partials.bladesora.members.skeletons.catalog-filters', [
                        "length" => count($catalogueMeta['allowableFilters']),
                    ])
                    @if($lessonType === 'routine')
                        <div class="tw-flex tw-flex-row nmh-1">
                            @for($i = 0; $i < 4; $i++)
                                @include('partials.bladesora.members.skeletons.card-item', [
                                ])
                            @endfor
                        </div>
                    @else
                        @for($i = 0; $i < 10; $i++)
                            @include('partials.bladesora.members.skeletons.list-item', [
                                "overview" => false,
                                "showNumbers" => false,
                                "thumbnailType" => $lessonType === 'song' ? 'square' : 'widescreen'
                            ])
                        @endfor
                    @endif
                </content-catalogue>
            </transition>
        </div>
    </div>
@endsection
