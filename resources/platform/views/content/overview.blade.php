@extends('partials.layout')

@section('meta')
    <title>{{ $parentContent->fetch('fields.title') }} | Musora</title>
@endsection

{{-- Page Specific Styles --}}
@section('styles')
    <style>
        .pack-header::after {
            content: '';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            z-index:1;
            background:rgba(0,0,0,.4);
        }
        .pack-header > * {
            z-index:2;
            position:relative;
        }
    </style>
@endsection

{{-- Learning Path JS --}}
@section('layout-scripts')
    @if($parentContent->fetch('type') === 'learning-path' || $parentContent['type'] === 'learning-path-level')
        <script src="{{ mix('platform/js/learning-path-preview.js') }}"></script>
    @endif
@endsection

{{-- Content --}}
@section('content')

    @include('content.breadcrumbs._overview-breadcrumbs')

    @if($parentContent->fetch('type') === 'learning-path')
        @include('partials._learning-path', ['learningPathSlug' => $parentContent->fetch('slug')])
    @else
        {{-- @component('partials.bladesora.members.partials._overview-header', [
                "themeColor" => $brand,
                "pageTitle" => $parentContent->fetch('fields.title'),
                "overviewType" => $parentContent->fetch('type') == 'learning-path' ? ucwords(brand()) : $parentContent->fetch('type'),
                "difficulty" => $parentContent->fetch('difficulty'),
                "backgroundImage" => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
                "avatarImage" => $parentContent->fetch('fields.instructor.data.head_shot_picture_url'),
                "pageDescription" => $parentContent->fetch('data.description'),
            ])
            @slot('interactionSlot')

            @endslot
        @endcomponent --}}
        
        {{-- Overview Headers --}}
        @if($parentContent->fetch('type') === 'pack-bundle')
            @include('partials.content.overview-headers._pack-bundle')
        @elseif($parentContent->fetch('type') === 'learning-path-level')
            @include('partials.content.overview-headers._learning-path-level')
        @elseif($parentContent->fetch('type') === 'learning-path-course')
            @include('partials.content.overview-headers._learning-path-course')
        @else
            @include('partials.content.overview-headers._default')
        @endif

        @include('partials.bladesora.members.content.content-info-subheader', [
            "brand" => $brand,
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


    <div class="tw-w-full fluid tw-bg-{{ $brand }}">
        @include('partials.bladesora.members.content.content-progress', [
            "themeColor" => $brand,
            "brand" => $brand,
            "contentType" => $parentContent->fetch('type'),
            "labelText" => $progressLabelText ?? null,
            "progress" => $parentContent->fetch('progress_percent'),
            "nextLessonUrl" => $nextLessonUrl,
            "backButton" => $backButton,
            "compact" => $parentContent->fetch('type') === 'pack-bundle' && $pack->fetch('bundle_count') <= 1,
            "xpAmount" =>  $parentContent->fetch('total_xp') ?? null,
            "isCompleted" => $parentContent->fetch('completed', false),
            "isStarted" => $parentContent->fetch('started', false),
        ])
    </div>

    @if(!empty($nextLessonJson))
        @include('partials._current-learning-path-lesson', [
            "currentLearningPathLesson" => $nextLessonJson,
        ])
    @endif

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-4">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-w-full tw-flex-row">

                <transition appear name="fade">
                    <content-catalogue
                        brand="{{ $brand }}"
                        catalogue-type="list"
                        theme-color="{{ $brand }}"
                        user-id="{{ user()->id }}"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $childContent }}"
                        :is-admin="<?php echo e(json_encode(user()->isAdmin())); ?>"
                        {{-- :is-admin="{{ json_encode(user()->isAdmin()) }}" --}}
                        @if($parentContent['type'] === 'learning-path'|| $parentContent['type'] === 'learning-path-level')
                            :display-items-as-overview="true"
                            :lock-unowned="true"
                        @endif
                        @if($parentContent['type'] !== 'learning-path')
                            :show-numbers="true"
                            :force-wide-thumbs="false"
                        @endif
                    >
                        @for($i = 0; $i < 10; $i++)
                            @include('partials.bladesora.members.skeletons.list-item', [
                                "overview" => $parentContent['type'] === 'learning-path' || $parentContent['type'] === 'learning-path-level',
                                "showNumbers" => $parentContent['type'] !== 'learning-path',
                                "thumbnailType" => $parentContent['type'] === 'learning-path' ? 'square' : 'widescreen'
                            ])
                        @endfor
                    </content-catalogue>
                </transition>
            </div>

            @if($xpBonus > 0)
                @include('partials.bladesora.members.partials._completion-bonus', [
                    "xpBonus" => $xpBonus,
                    "isComplete" => $parentContent->fetch('progress_percent', 0) === 100,
                    "themeColor" => $brand
                ])
            @endif
        </div>
    </div>

@endsection



{{-- 
---------------------------------------------------------------------------------------------------

@section('content')
    @if($parentContent->fetch('type') === 'pack-bundle')
        @include('members.content.partials.overview-headers._pack-bundle')
    @elseif($parentContent->fetch('type') === 'learning-path')
        @include('members.content.partials.overview-headers._learning-path')
    @elseif($parentContent->fetch('type') === 'learning-path-level')
        @include('members.content.partials.overview-headers._learning-path-level')
    @elseif($parentContent->fetch('type') === 'learning-path-course')
        @include('members.content.partials.overview-headers._learning-path-course')
    @else
        @include('members.content.partials.overview-headers._default')
    @endif

    @if($parentContent->fetch('type') !== 'learning-path')
        @include('bladesora::members.content.content-info-subheader', [
            "brand" => "drumeo",
            "infoData" => $infoData,
            "contentId" => $parentContent->fetch('id'),
            "contentType" => $parentContent->fetch('type'),
            "resetProgress" => $parentContent->fetch('progress_state', false) !== false,
            "instructorInfo" => false,
            "addToList" => !in_array($parentContent->fetch('type'), ['learning-path', 'pack-bundle']),
            "isAdded" => $parentContent->fetch('is_added_to_primary_playlist')
        ])

        @if(!empty($parentContent->fetch('*fields.instructor')) || !empty($parentContent->fetch('data.description')))
            @include('bladesora::members.content._content-info', [
                "instructors" => $parentContent->fetch('*fields.instructor'),
                "contentDescription" => $parentContent->fetch('data.description'),
            ])
        @endif
    @endif

    <div
        class="container fluid bg-drumeo"
    >
        @if($parentContent['slug'] == 'drumeo-method' && $parentContent->fetch('completed'))
            <div class="flex flex-column left-column align-v-center align-center pt-2">
                <h3 class="display text-white nowrap">
                    Congratulations!
                </h3>
                <p class="body text-white">
                    Email us about your experience <a class="text-white" href="/support">here</a>
                    and we'll send you a free pair of sticks!
                </p>
            </div>
            @include('bladesora::members.content.content-progress', [
                "brand" => "drumeo",
                "themeColor" => 'drumeo',
                "contentType" => $parentContent->fetch('type'),
                "progress" => $parentContent->fetch('progress_percent'),
                "nextLessonUrl" => $nextLessonUrl ?? '/',
                "xpAmount" => $xpAmount ?? $parentContent->fetch('xp'),
                "showCompleteButton" => false,
                "contentId" => $parentContent->fetch('id'),
                "labelText" => 'COMPLETE!',
                "isCompleted" => $parentContent->fetch('completed'),
                "isStarted" => $parentContent->fetch('started'),
            ])
        @else
            @include('bladesora::members.content.content-progress', [
                "brand" => "drumeo",
                "themeColor" => 'drumeo',
                "contentType" => $parentContent->fetch('type'),
                "progress" => $parentContent->fetch('progress_percent'),
                "nextLessonUrl" => $nextLessonUrl ?? '/',
                "xpAmount" => $xpAmount ?? $parentContent->fetch('xp'),
                "showCompleteButton" => false,
                "contentId" => $parentContent->fetch('id'),
                "labelText" => $progressLabelText ?? null,
                "isCompleted" => $parentContent->fetch('completed'),
                "isStarted" => $parentContent->fetch('started'),
            ])
        @endif

    </div>

    @if(($showNextLearningPathLesson ?? true) && !empty($nextLearningPathLesson) && $parentContent->fetch('started') === true)
        @include('members.home.partials._next-learning-path-lesson', [
            "nextDrumeoMethodLesson" => $nextLearningPathLesson,
            "showLogo" => false,
        ])
    @endif

    <div class="container mt-2 mb-3">
        <div class="flex flex-column">
            <div class="flex flex-row">
                <transition appear name="fade">
                    <content-catalogue
                        catalogue-type="list"
                        theme-color="drumeo"
                        :pre-loaded-content="{{ $childContent }}"
                        @if($parentContent['type'] === 'learning-path'
                            || $parentContent['type'] === 'learning-path-level')
                        :display-items-as-overview="true"
                        @endif
                        @if($parentContent['type'] !== 'learning-path')
                        :show-numbers="true"
                        @endif
                        :lock-unowned="true"
                        data-user-id="{{ auth()->id() }}"
                        :is-admin="{{ json_encode(\App\Services\User\UserAccessService::isAdministrator(auth()->id())) }}"
                    >
                        @for($i = 0; $i < 10; $i++)
                            @include('bladesora::members.skeletons.list-item', [
                                "overview" => $parentContent['type'] === 'learning-path'
                                    || $parentContent['type'] === 'learning-path-level',
                                "showNumbers" => $parentContent['type'] !== 'learning-path',
                                "thumbnailType" => $parentContent['type'] === 'learning-path' ? 'square' : 'widescreen'
                            ])
                        @endfor
                    </content-catalogue>
                </transition>
            </div>

            @include('bladesora::members.partials._completion-bonus', [
                "xpBonus" => $xpBonus,
                "isComplete" => $parentContent->fetch('progress_percent', 0) === 100,
                "themeColor" => 'drumeo'
            ])
        </div>
    </div>
@endsection
 --}}
