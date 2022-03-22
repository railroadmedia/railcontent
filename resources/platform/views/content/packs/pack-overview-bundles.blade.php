@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>{{ $pack->fetch('fields.title') }} | Singeo</title>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection

@section('breadcrumbs')
    @include('bladesora::members.navigation.breadcrumbs', [
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
            ]
        ]
    ])
@endsection

@section('content')

    @include('members.partials._content-sidebar')

    @component('members.partials._header-banner', [
        'backgroundImage' => $pack->fetch('data.header_image_url'),
        'hideUser' => true,
    ])
        @slot('content')
            <div class="flex flex-column pr-1 align-v-bottom align-h-center">
                <div class="pv-5"></div>
                <div class="pv-5 hide-xs-only"></div>
                <div class="pv-5 hide-md-down"></div>
                @if($pack['slug'] == 'piano-technique-made-easy')
                    <div
                            class="flex flex-column mb-4 rounded ba-grey-1-2 hover-border-singeo text-white hover-text-singeo pointer"
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
                        <div class="flex flex-column corners-10">
                            <div class="video-wrap">
                                <div class="widescreen">
                                    <div class="flex flex-column video-player user-active">
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

    @include('bladesora::members.content.content-info-subheader', [
        "infoData" => $infoData,
        "contentType" => "pack",
        "contentId" => $pack->fetch('id'),
        "resetProgress" => $pack->fetch('progress_state', false) !== false,
        "instructorInfo" => false,
        "downloadableResources" => $pack['resources'] ?? [],
        'addToList' => false,
        'brand' => 'singeo',
    ])

    @if(!empty($pack->fetch('*fields.instructor')) || !empty($pack->fetch('data.description')))
        @include('bladesora::members.content._content-info', [
            "instructors" => $pack->fetch('*fields.instructor'),
            "contentDescription" => $pack->fetch('data.description', null),
        ])
    @endif

    <div class="container mt-2 mb-3">
        <div class="flex flex-column">

            <div class="flex flex-row pv-3">
                <h1 class="heading capitalize">{{ $pack->fetch('fields.title') }}</h1>
            </div>

            <div class="flex flex-row bb-grey-1-1">
                <content-catalogue
                        brand="singeo"
                        catalogue-type="grid"
                        theme-color="singeo"
                        :pre-loaded-content="{{ $childContent }}"
                        user-id="{{ auth()->id() }}"></content-catalogue>
            </div>

            @if($xpBonus > 0)
                @include('bladesora::members.partials._completion-bonus', [
                    "xpBonus" => $xpBonus,
                    "isComplete" => $parentContent->fetch('progress_percent', 0) === 100,
                    "themeColor" => 'singeo'
                ])
            @endif
        </div>
    </div>
@endsection
