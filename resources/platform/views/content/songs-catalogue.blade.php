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
                    <p class="tw-text-white tw-text-[18px] tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base tw-uppercase tw-font-open-sans tw-font-bold">
                        <!-- TODO: GET THIS INFO FROM BACKEND -->
                        813 ARTISTS | 23,327 SONGS test
                    </p>
                </div>
                <div class="tw-flex tw-flex-row">
                    <a href="#aboutmoises" class="tw-flex tw-flex-col tw-justify-center tw-items-center hover:tw-underline tw-text-white tw-text-[20px] tw-font-bebas-neue">
                        <svg class="tw-h-[37px] tw-w-[37px]" id="info-icon-header" width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.2917 25H18.5V18H16.7083M18.5 11H18.5179M34.625 18C34.625 26.6985 27.4056 33.75 18.5 33.75C9.59441 33.75 2.375 26.6985 2.375 18C2.375 9.30151 9.59441 2.25 18.5 2.25C27.4056 2.25 34.625 9.30151 34.625 18Z"
                                stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="tw-pt-[20px]">ABOUT MOISES</div>
                    </a>
                    <a href="#requestasong" class="tw-flex tw-flex-col tw-justify-center tw-items-center lg:tw-ml-[64px] tw-ml-[12px] hover:tw-underline tw-text-white tw-text-[20px] tw-font-bebas-neue">
                        <svg class="tw-h-[37px] tw-w-[37px]" id="music-icon-header" width="31" height="32" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.8982 0.20752C10.0509 0.20752 9.36416 0.914633 9.36416 1.78676V22.9346C8.44361 22.5329 7.38912 22.317 6.29616 22.317C4.76473 22.317 3.30891 22.7403 2.19113 23.5076C1.08408 24.2671 0.160156 25.4901 0.160156 27.0547C0.160156 28.6193 1.08408 29.8423 2.19113 30.6018C3.30891 31.3691 4.76473 31.7924 6.29616 31.7924C7.82758 31.7924 9.2834 31.3691 10.4012 30.6018C11.5082 29.8423 12.4322 28.6193 12.4322 27.0547V9.68299H27.7722V22.9346C26.8516 22.5329 25.7971 22.317 24.7042 22.317C23.1727 22.317 21.7169 22.7403 20.5991 23.5076C19.4921 24.2671 18.5682 25.4901 18.5682 27.0547C18.5682 28.6193 19.4921 29.8423 20.5991 30.6018C21.7169 31.3691 23.1727 31.7924 24.7042 31.7924C26.2356 31.7924 27.6914 31.3691 28.8092 30.6018C29.9162 29.8423 30.8402 28.6193 30.8402 27.0547V1.78676C30.8402 0.914633 30.1534 0.20752 29.3062 0.20752H10.8982ZM27.7722 6.5245V3.36601H12.4322V6.5245H27.7722ZM8.69935 26.1355C9.25789 26.5188 9.36416 26.875 9.36416 27.0547C9.36416 27.2344 9.25789 27.5906 8.69935 27.9739C8.15153 28.3502 7.30635 28.6339 6.29616 28.6339C5.28596 28.6339 4.44078 28.3502 3.89296 27.9739C3.33442 27.5906 3.22816 27.2344 3.22816 27.0547C3.22816 26.875 3.33442 26.5188 3.89296 26.1355C4.44078 25.7592 5.28596 25.4754 6.29616 25.4754C7.30635 25.4754 8.15153 25.7592 8.69935 26.1355ZM27.1074 26.1355C27.6659 26.5188 27.7722 26.875 27.7722 27.0547C27.7722 27.2344 27.6659 27.5906 27.1074 27.9739C26.5595 28.3502 25.7144 28.6339 24.7042 28.6339C23.694 28.6339 22.8488 28.3502 22.301 27.9739C21.7424 27.5906 21.6362 27.2344 21.6362 27.0547C21.6362 26.875 21.7424 26.5188 22.301 26.1355C22.8488 25.7592 23.694 25.4754 24.7042 25.4754C25.7144 25.4754 26.5595 25.7592 27.1074 26.1355Z"
                                fill="white" />
                        </svg>
                        <div class="tw-pt-[20px]">REQUEST A SONG</div>
                    </a>
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

    @if (session()->has('success-message'))
        <div class="form-success-message container mt-3">
            <div class="flex flex-column bg-success shadow corners-10 pa">
                <p class="body text-white">{{ session()->get('success-message') }}</p>
            </div>
        </div>
    @endif

    @if ($hasStartedLessons)
        <section class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
            <div class="flex flex-row tw-pt-4">
                <h1 class="heading capitalize pointer noselect tw-text-[#00101D] dark:tw-text-white tw-border-b-2 tw-border-{{ $brand }}"
                    data-toggle-catalogue="inProgress">
                    In Progress
                </h1>
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

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <div class="tw-flex tw-flex-col mt-3">
            <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center">
                <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                    <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2">
                        All Songs
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[10px] dark:tw-text-white songs-catalogue-container">
        <transition appear name="fade">
            <content-catalogue dusk="content-catalogue" brand="{{ $brand }}" theme-color="{{ $brand }}"
                user-id="{{ auth()->id() }}" :search-bar="true"
                subscription-calendar-id="{{ config('addevent.' . $brand)['uniquekeys']['brand-overview'] ?? null }}"
                catalogue-name="Songs" :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
                content-endpoint="{{ $endpointOverride ?? '/railcontent/content' }}" :use-theme-color="true"
                :pre-loaded-content="{{ $listLessons }}" :is-admin="{{ json_encode(user()->isAdmin()) }}"
                :statuses="{{ json_encode(user()->isAdmin() ? ['published', 'draft'] : ['published']) }}"
                :use-url-params="true" :lock-unowned="true" :show-loading-animation="true"
                no-results-message="There are no songs that match those filters. Please remove some filters."
                catalogue-type="list" :infinite-scroll="true" limit="20"
                :included-types="{{ json_encode(is_array($lessonType) ? $lessonType : explode(',', $lessonType)) }}"
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
