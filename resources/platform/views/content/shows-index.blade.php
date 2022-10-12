@extends('partials.layout')

@section('meta')
    <title>Shows | Drumeo</title>
@endsection

@section('content')

    @component('partials._header-banner',
        ['backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg'])
        @slot('content')
            <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <musora-icon icon-name="shows-filled" class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                    <span class="tw-text-32 tw-font-bold">Shows</span>
                </h1>

                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    @if($brand === 'drumeo')
                        Whether you’re looking for drumming inspiration, entertainment, or education, Drumeo Shows has something for everyone. 
                    @endif
                </p>
            </div>
        @endslot
    @endcomponent

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 mv-2">
        <div class="flex flex-row flex-wrap nmh-1">
            @foreach($shows as $type=>$show)
                <a href="{{ url()->route('platform.content-type-catalog', ['contentTypeName' => $type]) }}"
                    class="flex flex-column xs-6 sm-3 lg-2 pa-1">
                    <div class="show-index-card square corners-10 bg-grey-2 dark:tw-bg-[#081825] relative">
                        <img
                            src="{{ $show['thumbnailUrl'] }}"
                            class="corners-10 tw-transition-opacity tw-opacity-0"
                            alt="{{ $type }} Show Card"
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

@endsection
