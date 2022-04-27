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
        <script src="{{ mix('assets/members/js/student-review-form.js') }}"></script>
    @endif
@endsection

@section('content')
    <page-container>
        <div v-cloak>

            @component('partials._header-banner',
['backgroundImage' => 'https://dmmior4id2ysr.cloudfront.net/assets/images/drumeo-members-header-background-image.jpg',])
                @slot('content')
                    <div class="tw-inline-tw-flex tw-w-full tw-tw-flex-col tw-pr-4">
                        <h1 class="tw-text-white tw-tw-flex tw-items-center tw-mb-2">
                            @if($catalogueMeta['name'] == 'Q&A')
                                <svg width="32" height="32" class="tw-mr-4" aria-hidden="true" focusable="false">
                                    <use xlink:href="#q-a-singeo-purple"></use>
                                </svg>
                            @elseif($catalogueMeta['name'] == 'Routines')
                                <svg width="32" height="32" class="tw-mr-4" aria-hidden="true" focusable="false"><use xlink:href="#routines-singeo-purple"></use></svg>
                            @elseif($catalogueMeta['name'] == 'Quick Tips')
                                <svg width="32" height="32" class="tw-mr-4" aria-hidden="true" focusable="false"><use xlink:href="#quick-tips-singeo"></use></svg>
                            @else
                                <i class="{{ $catalogueMeta['icon'] }} tw-mr-4 tw-text-singeo tw-text-3xl"></i>
                            @endif
                            <span class="tw-text-32">{{ ucfirst($catalogueMeta['name']) }}</span>
                        </h1>

                        <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                            {{ $catalogueMeta['description'] }}
                        </p>
                    </div>
                @endslot

                @slot('interactionSlot')
                    @if($lessonType === 'student-review')
                        @include('partials._student-review-application')
                    @endif

                    @if($lessonType === 'question-and-answer')
                        @include('partials._ask-question-form')
                    @endif

                    @if($lessonType === 'routine')
                        @include('partials._routine-modal')
                    @endif
                @endslot
            @endcomponent

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
                <div class="tw-container tw-mx-auto tw-px-4 tw-my-4 dark:tw-text-white">
                    <div class="tw-flex tw-flex-col tw-flex-grow">
                        <div class="tw-flex tw-flex-row tw-items-center pv-2">
                            <div class="text-black no-decoration heading tw-capitalize tw-flex-grow">Recently Viewed</div>
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
        {{--                    <h1 class="heading capitalize">All {{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}</h1>--}}
        {{--                </div>--}}
        {{--                <div class="tw-flex tw-flex-col xs-12 sm-4 md-3 mb-3">--}}
        {{--                    <button class="btn" data-open-modal="addToCalendarModal">--}}
        {{--                        <span class="text-singeo bg-singeo inverted">--}}
        {{--                            <i class="fas fa-calendar-plus mr-1"></i>--}}
        {{--                            Subscribe to Calendar--}}
        {{--                        </span>--}}
        {{--                    </button>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}
            @if(!empty($isAllContent))
                <div class="tw-container tw-mx-auto tw-px-4 tw-my-4 dark:tw-text-white">
                    <div class="tw-flex tw-flex-col tw-mt-3">
                        <div class="tw-flex tw-flex-row tw-flex-wrap pt-3 tw-items-center">
                            <div class="tw-flex tw-flex-col xs-12 sm-8 md-9 tw-mb-3">
                                <h1 class="heading tw-capitalize">All {{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}</h1>
                            </div>
                            <div class="tw-flex tw-flex-col xs-12 sm-4 md-3 tw-mb-3">
                                <button class="btn" data-open-modal="addToCalendarModal">
                                    <span class="tw-text-{{ $brand }} tw-bg-{{ $brand }} inverted">
                                        <i class="fas fa-calendar-plus tw-mr-1"></i>
                                        Subscribe to Calendar
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="tw-container tw-mx-auto tw-px-4 tw-my-4 dark:tw-text-white">
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
    </page-container>
@endsection
