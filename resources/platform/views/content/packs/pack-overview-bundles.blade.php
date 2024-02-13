@extends('partials.layout')

@section('meta')
    <title>{{ $pack->fetch('fields.title') }} | Musora</title>
@endsection

@section('content')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => "Packs",
                "url" => url()->route('platform.packs'),
            ],
            [
                "title" => $pack->fetch('fields.title'),
            ]
        ]
    ])

    {{-- @component('partials._header-banner', [
        'backgroundImage' => $pack->fetch('data.header_image_url'),
        'hideUser' => true,
        'hideBrandGradient' => $pack['slug'] == 'piano-technique-made-easy',
    ])
        @slot('content')
            <div class="tw-flex tw-flex-col pr-1 tw-justify-end tw-items-center tw-w-full tw-min-h-[312px]">

                @if($pack['slug'] == 'piano-technique-made-easy')
                    <div
                        class="tw-flex tw-flex-col tw-mb-4 tw-rounded-full ba-grey-1-2 hover-border-{{ $brand }} tw-text-white hover-text-{{ $brand }} tw-cursor-pointer"
                        data-open-modal="previewModal"
                        style="width:80px;"
                    >
                        <div class="square heading">
                            <i
                                class="fas fa-play absolute-center"
                                style="margin-left:2px"
                            ></i>
                        </div>
                    </div>
                    <div id="previewModal" class="modal vimeo-embedded-player">
                        <div class="tw-flex tw-flex-col corners-10">
                            <div class="video-wrap">
                                <div class="widescreen">
                                    <div class="tw-flex tw-flex-col video-player user-active">
                                        <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/466355774" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <img alt="{{ $pack->fetch('title') }} Logo"
                    class="tw-w-full tw-transition-opacity tw-max-w-[300px] tw-opacity-0"
                    src="{{ $pack->fetch('data.logo_image_url') }}"
                    onload="this.classList.remove('tw-opacity-0')"
                >
            </div>
        @endslot
    @endcomponent --}}

    <packs-header
        title="Packs"
        hero-img="{{ $pack->fetch('data.header_image_url') }}"
        additional-img-src="{{ $pack->fetch('data.logo_image_url') }}"
        dark-mode-logo="{{ $pack->fetch('data.dark_mode_logo_url') }}"
        light-mode-logo="{{ $pack->fetch('data.light_mode_logo_url') }}"
        primary-cta-icon="fa-play"
        primary-cta-text="{{$pack['primary_cta_text']}}"
        primary-cta-url="{{ $pack['primary_cta_url'] }}"
        :info-data="{{ json_encode($infoData) }}"
        {{-- :enable-reset-progress="true"
        content-id="{{ $parentContent->fetch('id') }}" --}}
    >
    </packs-header>


    {{-- @include('partials.bladesora.members.content.content-info-subheader', [
        "infoData" => $infoData,
        "contentType" => "pack",
        "contentId" => $pack->fetch('id'),
        "resetProgress" => $pack->fetch('progress_state', false) !== false,
        "instructorInfo" => false,
        "downloadableResources" => $pack['resources'] ?? [],
        'addToList' => false,
        'isAdded' => false,
        'brand' => '{{ $brand }}',
    ]) --}}

    @if(!empty($pack->fetch('*fields.instructor')) || !empty($pack->fetch('data.description')))
        <content-info
            :instructors="{{ json_encode($pack->fetch('*fields.instructor')) }}"
            :content-description="{{ json_encode($pack->fetch('data.description', null)) }}"
        ></content-info>
    @endif

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-2 tw-mb-3">
        <div class="tw-flex tw-flex-col">

            <div class="tw-flex tw-flex-row pv-3">
                <h1 class="tw-text-[30px] tw-font-bold dark:tw-text-white tw-capitalize">{{ $pack->fetch('fields.title') }}</h1>
            </div>

            <div class="tw-flex tw-flex-row tw-border-b tw-border-[#D4D4D8] dark:tw-border-[#223F57]">
                <content-catalogue
                        brand="{{ $brand }}"
                        catalogue-type="grid"
                        theme-color="{{ $brand }}"
                        :pre-loaded-content="{{ $childContent }}"
                        user-id="{{ auth()->id() }}"
                        :full-width-on-mobile="true"
                ></content-catalogue>
            </div>

            @if($xpBonus > 0)
                @include('partials.bladesora.members.partials._completion-bonus', [
                    "xpBonus" => $xpBonus,
                    "isComplete" => $parentContent->fetch('progress_percent', 0) === 100,
                    "themeColor" => '{{ $brand }}'
                ])
            @endif
        </div>
    </div>

@endsection

@section('layout-scripts')
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
    @parent
@endsection
