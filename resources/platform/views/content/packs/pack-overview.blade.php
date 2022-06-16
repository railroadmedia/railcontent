@extends('partials.layout')

@section('meta')
    <title>{{ $pack->fetch('fields.title') }} | Musora</title>
@endsection

@section('content')
        <div v-cloak>

        @if($pack['slug'] == 'piano-technique-made-easy' || $pack['slug'] == 'de-stupefy-your-left-hand')
            @include('partials.bladesora.members.navigation.breadcrumbs', [
                "pages" => [
                    [
                        "title" => 'Home',
                        "url" => url()->route('members.home'),
                    ],
                    [
                        "title" => "Packs",
                        "url" => url()->route('members.packs.index'),
                    ],
                    [
                        "title" => $pack->fetch('fields.title'),
                        "url" => $pack['url'],
                    ],
                    [
                        "title" => $parentContent->fetch('fields.title'),
                    ],
                ]
            ])
    
        @else
            @include('partials.bladesora.members.navigation.breadcrumbs', [
                "pages" => [
                    [
                        "title" => 'Home',
                        "url" => url()->route('members.home'),
                    ],
                    [
                        "title" => "Packs",
                        "url" => url()->route('members.packs.index'),
                    ],
                    [
                        "title" => $pack->fetch('fields.title'),
                    ],
                ]
            ])
        @endif

        @component('partials._header-banner', [
            'backgroundImage' => $pack->fetch('data.header_image_url'),
            'hideUser' => true,
        ])
            @slot('content')
                <div class="tw-flex tw-flex-col pr-1 tw-justify-end tw-items-center tw-w-full">
                    <div class="pv-5"></div>
                    <div class="pv-5 hide-xs-only"></div>
                    <div class="pv-5 hide-md-down"></div>
                    <img
                        alt="{{ $pack->fetch('title') }} Logo"
                        src="{{ $pack->fetch('data.logo_image_url') }}"
                        style="width: 100%;max-width:480px;"
                    >
                </div>
            @endslot
        @endcomponent

        @include('partials.bladesora.members.content.content-info-subheader', [
            "brand" => '{{ $brand }}',
            "infoData" => $infoData,
            "contentId" => $parentContent->fetch('id'),
            "contentType" => $parentContent->fetch('type'),
            "resetProgress" => $parentContent->fetch('progress_state', false) !== false,
            "instructorInfo" => false,
            "addToList" => !in_array($parentContent->fetch('type'), ['learning-path', 'pack-bundle']),
            "downloadableResources" => $pack['resources'] ?? [],
            "isAdded" => $parentContent->fetch('is_added_to_primary_playlist')
        ])

        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 mv-3">
            <div class="tw-flex tw-flex-col">
                <div class="tw-flex tw-flex-row">
                    <content-catalogue
                        brand="{{ $brand }}"
                        catalogue-type="list"
                        theme-color="{{ $brand }}"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $childContent }}"
                        :show-numbers="true"
                        user-id="{{ auth()->id() }}"
                    >
                    @for($i = 0; $i < 10; $i++)
                        @include('partials.bladesora.members.skeletons.list-item', [
                            "overview" => false,
                            "showNumbers" => true,
                            "thumbnailType" => false
                        ])
                    @endfor
                    </content-catalogue>
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
