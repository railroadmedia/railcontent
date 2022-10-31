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

        button.btn.page-button>span {
            border-width: 1px;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')

    @component('partials._header-banner',
        ['backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/' . $brand . '-header.jpg'])
        @slot('content')
            <div class="tw-inline-tw-flex tw-w-full tw-flex-col tw-pr-4">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <musora-icon icon-name="headphones-filled" class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                    <span class="tw-text-32 tw-font-bold">{{ ucfirst($catalogueMeta['name']) }}</span>
                </h1>
                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    {{ $catalogueMeta['description'] }}
                </p>
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

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[10px] dark:tw-text-white">
        <transition appear name="fade">
            <content-catalogue dusk="content-catalogue" brand="{{ $brand }}" theme-color="{{ $brand }}"
                user-id="{{ auth()->id() }}"
                subscription-calendar-id="{{ config('addevent.' . $brand)['uniquekeys']['brand-overview'] ?? null }}"
                catalogue-name="{{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }}"
                :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
                content-endpoint="{{ $endpointOverride ?? '/railcontent/content' }}" :use-theme-color="true"
                :pre-loaded-content="{{ $listLessons }}" :is-admin="{{ json_encode(user()->isAdmin()) }}"
                :statuses="{{ json_encode(user()->isAdmin() ? ['published', 'draft'] : ['published']) }}"
                :use-url-params="true" :lock-unowned="true" :show-loading-animation="true"
                no-results-message="There are no {{ $catalogueMeta['shortname'] ?? $catalogueMeta['name'] }} that match those filters. Please remove some filters."
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
