@extends('partials.layout')

@section('meta')
    <title>Student Focus | Musora</title>
@endsection

@section('content')

        @component('partials._header-banner', ['backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg'])
            @slot('content')
                <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4">
                    <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                        <musora-icon icon-name="person-plus-filled" class="tw-w-[33px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                        <span class="tw-text-32 tw-font-bold">Student Focus</span>
                    </h1>

                    <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                        Want to customize your learning? Within Student Focus you will find all the extra features you need to help you focus on the areas that mean most to you! Student Focus includes Quick Tip lessons, Student Reviews and a library of our live Q&A lessons so that you can create the learning experience that best suits your needs and interests.
                    </p>
                </div>
            @endslot
        @endcomponent

        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8">
            <div class="tw-flex tw-flex-col mv-3">
                <div class="tw-flex tw-flex-row tw-flex-wrap">
                    @foreach($lessonTypes as $lessonType)
                        <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => $lessonType['type']]) }}"
                        class="tw-flex tw-flex-col xs-6 sm-3 pa-1"
                        dusk="{{$lessonType['type']}}">
                            <div class="show-index-card square corners-10 bg-grey-2 dark:tw-bg-[#081825] relative">
                                <img
                                    src="https://musora.com/cdn-cgi/image/width=650,height=650,quality=90/{{ $lessonType['thumbnail'] }}"
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
