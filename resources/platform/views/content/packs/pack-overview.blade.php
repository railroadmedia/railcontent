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
    @if($pack['slug'] == 'piano-technique-made-easy' || $pack['slug'] == 'de-stupefy-your-left-hand')
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
                    "url" => $pack['url'],
                ],
                [
                    "title" => $parentContent->fetch('fields.title'),
                ],
            ]
        ])

    @else
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
                ],
            ]
        ])
    @endif
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
                <img
                        alt="{{ $pack->fetch('title') }} Logo"
                        src="{{ $pack->fetch('data.logo_image_url') }}"
                        style="width: 100%;max-width:480px;"
                >
            </div>
        @endslot
    @endcomponent

    @include('bladesora::members.content.content-info-subheader', [
        "brand" => 'singeo',
        "infoData" => $infoData,
        "contentId" => $parentContent->fetch('id'),
        "contentType" => $parentContent->fetch('type'),
        "resetProgress" => $parentContent->fetch('progress_state', false) !== false,
        "instructorInfo" => false,
        "addToList" => !in_array($parentContent->fetch('type'), ['learning-path', 'pack-bundle']),
        "downloadableResources" => $pack['resources'] ?? [],
        "isAdded" => $parentContent->fetch('is_added_to_primary_playlist')
    ])

    <div class="container mv-3">
        <div class="flex flex-column ">
            <div class="flex flex-row">
                <content-catalogue
                        brand="singeo"
                        catalogue-type="list"
                        theme-color="singeo"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $childContent }}"
                        :show-numbers="true"
                        user-id="{{ auth()->id() }}"
                >
                @for($i = 0; $i < 10; $i++)
                    @include('bladesora::members.skeletons.list-item', [
                        "overview" => false,
                        "showNumbers" => true,
                        "thumbnailType" => false
                    ])
                @endfor
                </content-catalogue>
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
