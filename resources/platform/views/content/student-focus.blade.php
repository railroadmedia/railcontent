@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Student Focus | Musora</title>
@endsection

@section('content')

        @component('partials._header-banner', ['backgroundImage' => 'https://d3fzm1tzeyr5n3.cloudfront.net/headers/'.$brand.'-header.jpg'])
            @slot('content')
                <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4">
                    <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                        <musora-icon icon-name="person-plus-filled" class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        <span class="tw-text-32 tw-font-bold">Student Focus</span>
                    </h1>

                    <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                        @if($brand === 'pianote' || $brand === 'guitareo')
                            Submit your playing for personalized and direct feedback, or look at the archive to see what challenges our instructors have already addressed.
                        @elseif($brand === 'singeo')
                            Submit your singing for personalized and direct feedback, or look at the archive to see what challenges our instructors have already addressed.
                        @endif
                    </p>
                </div>
            @endslot
        @endcomponent

        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8">
            <div class="tw-flex tw-flex-col mv-3">
                <div class="tw-grid tw-gap-2 xl:tw-gap-4 tw-grid-cols-2 md:tw-grid-cols-3 xl:tw-grid-cols-4 2xl:tw-grid-cols-5 3xl:tw-grid-cols-6">
                    @foreach($lessonTypes as $lessonType)
                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => $lessonType['type']]) }}"
                        class="tw-flex tw-flex-col tw-w-full pa-1"
                        dusk="{{$lessonType['type']}}">
                            <div class="show-index-card square corners-10 bg-grey-2 dark:tw-bg-[#081825] relative">
                                <img
                                    src="https://www.musora.com/musora-cdn/image/width=650,height=650,quality=90/{{ $lessonType['thumbnail'] }}"
                                    class="corners-10 tw-transition-opacity tw-opacity-0"
                                    alt="{{ $lessonType['type'] }} Show Card"
                                    loading="lazy"
                                    onload="this.classList.remove('tw-opacity-0')"
                                >

                                <span class="box-hover heading corners-10">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

@endsection
