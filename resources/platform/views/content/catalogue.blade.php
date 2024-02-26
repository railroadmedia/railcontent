@php
    $showInProgress = false;
    if($hasStartedLessons && $lessonType !== 'routine'){
        $showInProgress = true;
    }
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
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

@section('review-modal-section')
    @if($lessonType === 'student-review' || $lessonType === 'student-focus')
        @include('partials._review-modal', ['brand' => $brand])
    @endif
@endsection

@section('content')
    
    @component('partials._header-banner',
        ['backgroundImage' => 'https://d3fzm1tzeyr5n3.cloudfront.net/headers/'.$brand.'-header.jpg',])
        @slot('content')
            <div class="tw-inline-tw-flex tw-w-full tw-flex-col tw-pr-4">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    @if($catalogueMeta['name'] == 'Q&A')
                        <musora-icon icon-name="light-bulb-filled"
                                        class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                    @elseif($catalogueMeta['name'] == 'Routines')
                        <musora-icon icon-name="routines-filled"
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
                    @elseif($catalogueMeta['name'] == 'Play Alongs')
                        <musora-icon icon-name="eigth-notes-filled"
                                    class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}">
                        </musora-icon>
                    @elseif($catalogueMeta['name'] == 'New Content')
                        <i class="fas fa-star tw-text-{{ $brand }} tw-mr-2 tw-text-2xl"></i>
                    @elseif($catalogueMeta['name'] == 'Subscribed')
                        <i class="fas fa-bell tw-text-{{ $brand }} tw-mr-2 tw-text-2xl"></i>
                    @elseif($catalogueMeta['name'] == 'Song Tutorials')
                        <musora-icon icon-name="play-progress-filled"
                                class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}">
                        </musora-icon>
                    @elseif($catalogueMeta['name'] == 'Rudiments')
                        <musora-icon icon-name="drum-filled"
                                    class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}">
                        </musora-icon>
                    @else
                        <musora-icon icon-name="academic-cap-filled"
                                        class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                    @endif
                    <span class="tw-text-32 tw-font-bold">{{ ucfirst($catalogueMeta['name']) }}</span>
                </h1>
                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    {{ $catalogueMeta['description'] }}
                </p>
            </div>
        @endslot
    @endcomponent
    

    @if(session()->has('success-message'))
        <div class="form-success-message container mt-3">
            <div class="flex flex-column bg-success shadow corners-10 pa">
                <p class="body text-white">{{ session()->get('success-message') }}</p>
            </div>
        </div>
    @endif

    @if($showInProgress)
        <section class="tw-container tw-mx-auto dark:tw-text-white lg:tw-px-8">
            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mt-[30px] tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                <a href="/{{ $brand }}/lesson-history/in-progress" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">In Progress</h2>
                </a>
                <a href="/{{ $brand }}/lesson-history/in-progress"
                    aria-label="See All Subscribed Lessons"
                    class="tw-text-sm md:tw-text-base md:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                >
                    See All
                </a>
            </div>
            <div>
                <transition appear name="fade">
                    <catalogue-card-container
                        theme-color="{{ $brand }}"
                        catalogue-type="grid"
                        no-results-message="Looks like you haven't started any lessons.
            Once you watch a video, it will show up here for you to access later."
                        :six-wide="true"
                        :pre-loaded-content="{{ json_encode(json_decode($startedLessons)->data) }}"
                    >
                    </catalogue-card-container>
                </transition>
            </div>
        </section>
    @endif

{{--    @if($lessonType === 'student-review' || $lessonType === 'question-and-answer' || !empty($isAllContent)--}}
{{--        && !empty(config('addevent.'.$brand)['uniquekeys']['by-type'][$lessonType]))--}}
{{--        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[10px] dark:tw-text-white">--}}
{{--            <div class="tw-flex tw-flex-col @if($showInProgress) tw-mt-[14px] lg:tw-mt-[6px] @else tw-mt-[30px] @endif">--}}
{{--                <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center">--}}
{{--                    <div class="tw-flex tw-flex-col tw-mb-3 md:tw-mb-0 tw-mr-auto">--}}
{{--                        <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">--}}
{{--                            All {{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}</h1>--}}
{{--                    </div>--}}
{{--                    <div class="tw-flex tw-flex-col xs-12 sm-4 md-3 tw-mb-0">--}}
{{--                        <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white" data-open-modal="addToCalendarModal">--}}
{{--                            <i class="fas fa-calendar-plus mr-1"></i>--}}
{{--                            Subscribe to Calendar--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <add-event-modal--}}
{{--                modal-id="addToCalendarModal"--}}
{{--                subscription-calendar-id="{{ config('addevent.'.$brand)['uniquekeys']['by-type'][$lessonType] ?? null }}"--}}
{{--                theme-color="{{ $brand }}"--}}
{{--                toggleSubscribe="toggleSubscribe"--}}
{{--            ></add-event-modal>--}}
{{--        </div>--}}
{{--    @else--}}
{{--        @if( $catalogueMeta['name'] !== "Play Alongs" || $catalogueMeta['name'] === "Play Alongs" && $brand === "guitareo" )--}}
{{--            <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">--}}
{{--                <div class="tw-flex tw-flex-col @if($showInProgress) tw-mt-[14px] lg:tw-mt-[6px] @else tw-mt-[30px] @endif">--}}
{{--                    <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center">--}}
{{--                        <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">--}}
{{--                            <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">--}}
{{--                                All--}}
{{--                                @if( !empty($catalogueMeta['shortname']) && $catalogueMeta['shortname'] === 'Podcast')--}}
{{--                                    Episodes --}}{{-- Change Podcast Name}} --}}
{{--                                @else--}}
{{--                                    {{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}--}}
{{--                                @endif--}}
{{--                            </h1>--}}
{{--                        </div>--}}
{{--                        @if( $catalogueMeta['name'] !== "Songs" && !empty(config('addevent.'.$brand)['uniquekeys']['by-type'][$lessonType]) )--}}
{{--                            <div class="tw-flex tw-flex-col">--}}
{{--                                <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white" data-open-modal="addToCalendarModal">--}}
{{--                                    <i class="fas fa-calendar-plus mr-1"></i>--}}
{{--                                    Subscribe to Calendar--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <add-event-modal--}}
{{--                                modal-id="addToCalendarModal"--}}
{{--                                subscription-calendar-id="{{ config('addevent.'.$brand)['uniquekeys']['by-type'][$lessonType] }}"--}}
{{--                                theme-color="{{ $brand }}"--}}
{{--                                toggleSubscribe="toggleSubscribe"--}}
{{--                            ></add-event-modal>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @endif--}}

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[10px] dark:tw-text-white">
        @if( $catalogueMeta['name'] === "Play Alongs" && $brand === "drumeo" )
            <play-alongs
                ref="playAlongsVueInstance"
                content-endpoint="/railcontent/content"
                theme-color="{{ $brand }}"
                brand="{{ $brand }}"
                :pre-loaded-content="{{ $listLessons }}"
                :session-token="{{ json_encode(railtracker_session_token()) }}"
                @play="handlePlayAlongsPlay"
                @pause="handlePlayAlongsPause"
            ></play-alongs>
        @else
                <collection-wrapper
                    :brand="{{ json_encode($brand) }}"
                    :collection-type="{{ json_encode($lessonType) }}"
                    :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
                    :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"
                    :included-types="{{ json_encode(['course']) }}"
                    :pre-loaded-content="{{ $listLessons }}"
                    :statuses="{{ json_encode($statuses ?? ['published']) }}"
                    :title="{{ json_encode($catalogueMeta['shortname'] ?? $catalogueMeta['name']) }}"
                    :tabs="{{ json_encode($catalogueMeta['tabs'] ?? []) }}"
                ></collection-wrapper>
        @endif

        {{-- Play Alongs Catalogue for Drumeo --}}
{{--        @if( $catalogueMeta['name'] === "Play Alongs" && $brand === "drumeo" )--}}

{{--            <play-alongs--}}
{{--                ref="playAlongsVueInstance"--}}
{{--                content-endpoint="/railcontent/content"--}}
{{--                theme-color="{{ $brand }}"--}}
{{--                brand="{{ $brand }}"--}}
{{--                :pre-loaded-content="{{ $listLessons }}"--}}
{{--                :session-token="{{ json_encode(railtracker_session_token()) }}"--}}
{{--                @play="handlePlayAlongsPlay"--}}
{{--                @pause="handlePlayAlongsPause"--}}
{{--            ></play-alongs>--}}

{{--        @else--}}

{{--            <transition appear name="fade">--}}
{{--                <content-catalogue--}}
{{--                    dusk="content-catalogue"--}}
{{--                    brand="{{ $brand }}"--}}
{{--                    theme-color="{{ $brand }}"--}}
{{--                    user-id="{{ auth()->id() }}"--}}
{{--                    subscription-calendar-id="{{ config('addevent.'.$brand)['uniquekeys']['brand-overview'] ?? null }}"--}}
{{--                    catalogue-name="{{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}"--}}
{{--                    :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"--}}
{{--                    content-endpoint="{{ $endpointOverride ?? '/railcontent/content' }}"--}}
{{--                    :use-theme-color="true"--}}
{{--                    :pre-loaded-content="{{ $listLessons }}"--}}
{{--                    :is-admin="{{ json_encode(user()->isAdmin()) }}"--}}
{{--                    :statuses="{{ json_encode($statuses ?? ['published']) }}"--}}
{{--                    :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"--}}
{{--                    :use-url-params="true"--}}
{{--                    :lock-unowned="true"--}}
{{--                    :show-loading-animation="true"--}}
{{--                    no-results-message="There are no {{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }} that match those filters. Please remove some filters."--}}
{{--                    @if($lessonType === 'routine')--}}
{{--                        catalogue-type="routines"--}}
{{--                        :infinite-scroll="false"--}}
{{--                        :paginate="true"--}}
{{--                        limit="12"--}}
{{--                    @else--}}
{{--                        catalogue-type="{{ $lessonType === 'chord-and-scale' ? 'grid' : 'list' }}"--}}
{{--                        :infinite-scroll="true"--}}
{{--                        limit="20"--}}
{{--                    @endif--}}
{{--                    @if($lessonType === 'quick-tips')--}}
{{--                        :included-types="{{ json_encode([$lessonType, 'boot-camps']) }}"--}}
{{--                    @else--}}
{{--                        :included-types="{{ json_encode(is_array($lessonType) ? $lessonType : explode(',', $lessonType) ) }}"--}}
{{--                    @endif--}}
{{--                    @if($lessonType === 'student-review' || !empty($isAllContent))--}}
{{--                        :force-wide-thumbs="true"--}}
{{--                    @endif--}}
{{--                    @if(!empty($isAllContent))--}}
{{--                        :search-bar="true"--}}
{{--                        search-endpoint="/railcontent/search"--}}
{{--                        total-results="{{ $totalResults }}"--}}
{{--                    @endif--}}
{{--                    @if(!empty($searchTerm))--}}
{{--                        search-term="{{ $searchTerm }}"--}}
{{--                    @endif--}}
{{--                    @if(!empty($sortOverride))--}}
{{--                        sort-override="{{ $sortOverride }}"--}}
{{--                    @endif--}}
{{--                >--}}
{{--                    @include('partials.bladesora.members.skeletons.catalog-filters', [--}}
{{--                        "length" => count($catalogueMeta['allowableFilters']),--}}
{{--                    ])--}}
{{--                    @if($lessonType === 'routine')--}}
{{--                        <div class="tw-flex tw-flex-row nmh-1">--}}
{{--                            @for($i = 0; $i < 4; $i++)--}}
{{--                                @include('partials.bladesora.members.skeletons.card-item', [--}}
{{--                                ])--}}
{{--                            @endfor--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        @for($i = 0; $i < 10; $i++)--}}
{{--                            @include('partials.bladesora.members.skeletons.list-item', [--}}
{{--                                "overview" => false,--}}
{{--                                "showNumbers" => false,--}}
{{--                                "thumbnailType" => $lessonType === 'song' ? 'square' : 'widescreen'--}}
{{--                            ])--}}
{{--                        @endfor--}}
{{--                    @endif--}}
{{--                </content-catalogue>--}}
{{--            </transition>--}}

{{--        @endif--}}
    </div>

@endsection
