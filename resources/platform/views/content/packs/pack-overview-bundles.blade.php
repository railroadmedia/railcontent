@extends('partials.layout')

@section('meta')
    <title>{{ $pack->fetch('fields.title') }} | Musora</title>
@endsection

@section('content')
        <div v-cloak>

            @include('partials.bladesora.members.navigation.breadcrumbs', [
                "pages" => [
                    [
                        "title" => 'Home',
                        "url" => url()->route('platform.home', [brand()]),
                    ],
                    [
                        "title" => "Packs",
                        "url" => url()->route('platform.packs'),
                    ],
                    [
                        "title" => $pack->fetch('fields.title'),
                    ]
                ]
            ])

            @component('partials._header-banner', [
                'backgroundImage' => $pack->fetch('data.header_image_url'),
                'hideUser' => true,
            ])
                @slot('content')
                    <div class="tw-flex tw-flex-col pr-1 tw-justify-end tw-items-center">
                        <div class="pv-5"></div>
                        <div class="pv-5 hide-xs-only"></div>
                        <div class="pv-5 hide-md-down"></div>
                        @if($pack['slug'] == 'piano-technique-made-easy')
                            <div
                                class="tw-flex tw-flex-col tw-mb-4 tw-rounded ba-grey-1-2 hover-border-{{ $brand }} tw-text-white hover-text-{{ $brand }} tw-pointer"
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
                            <div id="previewModal" class="modal">
                                <div class="tw-flex tw-flex-col corners-10">
                                    <div class="video-wrap">
                                        <div class="widescreen">
                                            <div class="tw-flex tw-flex-col video-player user-active">
                                                <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/494183465" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <img
                                alt="{{ $pack->fetch('title') }} Logo"
                                src="{{ $pack->fetch('data.logo_image_url') }}"
                                style="width: 100%;max-width:480px;"
                        >
                    </div>
                @endslot
            @endcomponent

            @include('partials.bladesora.members.content.content-info-subheader', [
                "infoData" => $infoData,
                "contentType" => "pack",
                "contentId" => $pack->fetch('id'),
                "resetProgress" => $pack->fetch('progress_state', false) !== false,
                "instructorInfo" => false,
                "downloadableResources" => $pack['resources'] ?? [],
                'addToList' => false,
                'isAdded' => false,
                'brand' => '{{ $brand }}',
            ])

            @if(!empty($pack->fetch('*fields.instructor')) || !empty($pack->fetch('data.description')))
                @include('partials.bladesora.members.content._content-info', [
                    "instructors" => $pack->fetch('*fields.instructor'),
                    "contentDescription" => $pack->fetch('data.description', null),
                ])
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
                                user-id="{{ auth()->id() }}"></content-catalogue>
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

        </div>
@endsection
