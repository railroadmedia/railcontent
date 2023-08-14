@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@section('styles')
    <style>
        /* TODO: Componentize ContentCatalogue and use slots to avoid using so many conditionals, for now let's hide the type filter, to not introduce another conditional */
        .songs-catalogue-container .typeFilterContainer {
            display: none;
        }
    </style>
@endsection

@section('content')

    @component('partials._unified-header', ['backgroundImage' => 'https://i.ibb.co/PQVRRZP/songs-bg-1.png'])
        @slot('content')
            <div class="tw-flex tw-w-full tw-flex-row tw-justify-between">
                <div class="tw-flex tw-flex-col tw-pr-4">
                    <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                        <musora-icon icon-name="headphones-filled" class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}">
                        </musora-icon>
                        <span class="tw-text-32 tw-font-bold">{{ ucfirst($catalogueMeta['name']) }}</span>
                    </h1>
                    <p
                        class="tw-text-white tw-text-[18px] tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base tw-uppercase tw-font-open-sans tw-font-bold">
                        <!-- TODO: GET THIS INFO FROM BACKEND -->
                        {{ $artistsNumber }} ARTISTS | {{ $songsNumber }} SONGS
                    </p>
                </div>
                <div class="tw-flex tw-flex-row tw-items-center tw-justify-center">
                    <!-- <a href="#aboutmoises"
                        class="tw-flex tw-flex-col tw-justify-center tw-items-center hover:tw-underline tw-text-white tw-text-[20px] tw-font-bebas-neue">
                        <svg class="tw-h-[37px] tw-w-[37px]" id="info-icon-header" width="37" height="36" viewBox="0 0 37 36"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.2917 25H18.5V18H16.7083M18.5 11H18.5179M34.625 18C34.625 26.6985 27.4056 33.75 18.5 33.75C9.59441 33.75 2.375 26.6985 2.375 18C2.375 9.30151 9.59441 2.25 18.5 2.25C27.4056 2.25 34.625 9.30151 34.625 18Z"
                                stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="tw-pt-[20px]">ABOUT MOISES</div>
                    </a> -->
                    <song-request brand="{{ $brand }}"></song-request>
                </div>
            </div>
        @endslot

        @slot('interactionSlot')
            @if ($catalogueMeta['name'] == 'Songs' && $brand === 'drumeo')
                <div class="tw-flex tw-mt-4">
                    <a @if (Carbon\Carbon::create(2022, 11, 15, 11, 0, 0, 'America/Vancouver') > Carbon\Carbon::now()) href="/drumeo/forums/drumeo-songs/15/december-2022-song-request-voting-thread/13853?sortby_val=published_on"
                        @else
                            href="/members/forums/threads/drumeo-songs/15" @endif
                        class="tw-btn-primary tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600">
                        Request A Song
                        <span class="tw-text-4xl tw-ml-1 tw-leading-none tw-mt-0.5">»</span>
                    </a>
                </div>
            @endif
        @endslot
    @endcomponent

    @if ($hasStartedLessons)
        <section class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
            <div class="tw-flex tw-items-center tw-mt-5 tw-mb-4 tw-w-full tw-justify-between">
                <a href="/{{ $brand }}/lesson-history/in-progress" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">In Progress</h2>
                </a>
                <a href="/{{ $brand }}/lesson-history/in-progress"
                    aria-label="See All Subscribed Lessons"
                    class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                >
                    See All
                </a>
            </div>

            <div id="inProgress"
                class="tw-flex tw-flex-row tw-pt-5 tw-pb-2 tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457] feature-catalogue six-cards-row">
                <transition appear name="fade">
                    <content-catalogue catalogue-type="grid" theme-color="{{ $brand }}"
                        :pre-loaded-content="{{ $startedLessons }}" user-id="{{ auth()->id() }}"
                        no-results-message="Looks like you haven't started any song. Once you start any, it will show up here for you to access later."
                        :six-wide="true">
                        <div class="flex flex-row nmh-1">
                            @for ($i = 0; $i < 6; $i++)
                                @include('partials.bladesora.members.skeletons.card-item', [
                                    'thumbnailType' => $lessonType === 'song' ? 'square' : 'widescreen',
                                    'cardClass' => 'six-wide',
                                ])
                            @endfor
                        </div>
                    </content-catalogue>
                </transition>
            </div>
        </section>
    @endif
    
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[10px] dark:tw-text-white songs-catalogue-container tw-pt-[30px]">
        <transition appear name="fade">
            <content-catalogue dusk="content-catalogue" brand="{{ $brand }}" theme-color="{{ $brand }}"
                user-id="{{ auth()->id() }}" :search-bar="true"
                search-bar-title="All Songs"
                subscription-calendar-id="{{ config('addevent.' . $brand)['uniquekeys']['brand-overview'] ?? null }}"
                catalogue-name="Songs" :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
                content-endpoint="{{ $endpointOverride ?? '/railcontent/content' }}" :use-theme-color="true"
                :pre-loaded-content="{{ $listLessons }}" :is-admin="{{ json_encode(user()->isAdmin()) }}"
                :statuses="{{ json_encode($statuses ?? ['published']) }}"
                :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"
                :use-url-params="true" :lock-unowned="true" :show-loading-animation="true"
                no-results-message="There are no songs that match those filters. Please remove some filters."
                catalogue-type="list" :infinite-scroll="true" limit="20"
                :included-types="{{ json_encode(is_array($lessonType) ? $lessonType : explode(',', $lessonType)) }}"
                total-results="{{ $songsNumber }}"
                @if (!empty($searchTerm)) search-term="{{ $searchTerm }}" @endif
                @if (!empty($sortOverride)) sort-override="{{ $sortOverride }}" @endif>
                @include('partials.bladesora.members.skeletons.catalog-filters', [
                    'length' => count($catalogueMeta['allowableFilters']),
                ])
                @for ($i = 0; $i < 10; $i++)
                    @include('partials.bladesora.members.skeletons.list-item', [
                        'overview' => false,
                        'showNumbers' => false,
                        'thumbnailType' => $lessonType === 'song' ? 'square' : 'widescreen',
                    ])
                @endfor
            </content-catalogue>
        </transition>
    </div>
@endsection
