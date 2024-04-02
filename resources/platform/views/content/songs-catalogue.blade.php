@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@section('content')
    @component('partials._unified-header', ['backgroundImage' => 'https://i.ibb.co/PQVRRZP/songs-bg-1.png'])
        @slot('content')
            <div class="tw-flex tw-w-full tw-flex-row tw-justify-between">
                <div class="tw-flex tw-flex-col tw-pr-4">
                    <h1 class="tw-text-white tw-flex tw-items-center">
                        <musora-icon icon-name="headphones-filled" class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}">
                        </musora-icon>
                        <span class="tw-text-[28px] lg:tw-text-32 tw-font-bold">{{ ucfirst($catalogueMeta['name']) }}</span>
                    </h1>
                    <p
                        class="tw-text-white tw-text-sm lg:tw-text-base tw-max-w-4xl tw-pr-12 tw-uppercase tw-font-open-sans tw-font-semibold">
                        <a href="{{ $allArtistUrl }}"> SEE ALL {{ $artistsNumber }} ARTISTS </a>
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
    @endcomponent
    <songs
        continue-url="/{{$brand}}/lesson-history/in-progress"
        :artists-number="{{ json_encode($artistsNumber) }}"
        :songs-number="{{ json_encode($songsNumber) }}"
        :started-content="{{ json_encode($startedLessons) }}"
        :list-lessons="{{ $listLessons }}"
        :tabs="{{ json_encode($catalogueMeta['tabs'] ?? []) }}"
        :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
    >
    </songs>
@endsection
