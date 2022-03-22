@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>{{ $parentContent->fetch('fields.title') }} | Singeo</title>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection

@section('breadcrumbs')
    @include('members.content.breadcrumbs._overview-breadcrumbs')
@endsection

@section('content')
    @include('members.partials._content-sidebar')

    @if($parentContent->fetch('type') === 'learning-path')
        @include('members.partials._learning-path', ['learningPathSlug' => $parentContent->fetch('slug')])
    @else
        @component('bladesora::members.partials._overview-header', [
                "themeColor" => 'singeo',
                "pageTitle" => $parentContent->fetch('fields.title'),
                "overviewType" => $parentContent->fetch('type') == 'learning-path' ? 'Singeo' : $parentContent->fetch('type'),
                "difficulty" => $parentContent->fetch('difficulty'),
                "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
                "avatarImage" => $parentContent->fetch('fields.instructor.data.head_shot_picture_url'),
                "pageDescription" => $parentContent->fetch('data.description'),
            ])
            @slot('interactionSlot')

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
            "downloadableResources" => $parentContent['resources'] ?? [],
            "isAdded" => $parentContent->fetch('is_added_to_primary_playlist')
        ])
    @endif


    <div class="container fluid bg-singeo">
        @include('bladesora::members.content.content-progress', [
            "themeColor" => 'singeo',
            "brand" => "singeo",
            "contentType" => $parentContent->fetch('type'),
            "labelText" => $progressLabelText ?? null,
            "progress" => $parentContent->fetch('progress_percent'),
            "nextLessonUrl" => $nextLessonUrl,
            "backButton" => $backButton,
            "compact" => $parentContent->fetch('type') === 'pack-bundle' &&
    $pack->fetch('bundle_count') <= 1,
            "xpAmount" =>  $parentContent->fetch('total_xp') ?? null,
            "isCompleted" => $parentContent->fetch('completed', false),
            "isStarted" => $parentContent->fetch('started', false),
        ])
    </div>

    @if(!empty($nextLessonJson))
        @include('members.partials._current-learning-path-lesson', [
            "currentLearningPathLesson" => $nextLessonJson,
        ])
    @endif

    <div class="container mv-3">
        <div class="flex flex-column">
            <div class="flex flex-row">
                <content-catalogue
                    brand="singeo"
                    catalogue-type="list"
                    theme-color="singeo"
                    :use-theme-color="true"
                    :pre-loaded-content="{{ $childContent }}"
                    :is-admin="<?php echo e(json_encode(current_user()->getPermissionLevel() === 'administrator')); ?>"
                    @if($parentContent['type'] !== 'learning-path')
                    :show-numbers="true"
                    @endif
                    @if($parentContent['type'] === 'learning-path')
                    :display-items-as-overview="true"
                    :lock-unowned="true"
                    :force-wide-thumbs="false"
                    @endif
                    @if($parentContent['type'] === 'learning-path-level')
                    :lock-unowned="true"
                    @endif
                    user-id="{{ auth()->id() }}"
                    :is-admin="{{ json_encode(current_user()->getPermissionLevel() === 'administrator') }}"
                >
                    @for($i = 0; $i < 10; $i++)
                        @include('bladesora::members.skeletons.list-item', [
                            "overview" => $parentContent['type'] === 'learning-path',
                            "showNumbers" => $parentContent['type'] !== 'learning-path',
                            "thumbnailType" => $parentContent['type'] === 'learning-path' ? 'square' : 'widescreen'
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
