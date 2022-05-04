@extends('partials.layout')

@section('meta')
    <title>{{ $parentContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('content')
        <div v-cloak>

            @include('content.breadcrumbs._overview-breadcrumbs')

            @if($parentContent->fetch('type') === 'learning-path')
                @include('partials._learning-path', ['learningPathSlug' => $parentContent->fetch('slug')])
            @else
                @component('partials.bladesora.members.partials._overview-header', [
                        "themeColor" => $brand,
                        "pageTitle" => $parentContent->fetch('fields.title'),
                        "overviewType" => $parentContent->fetch('type') == 'learning-path' ? ucwords(brand()) : $parentContent->fetch('type'),
                        "difficulty" => $parentContent->fetch('difficulty'),
                        "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
                        "avatarImage" => $parentContent->fetch('fields.instructor.data.head_shot_picture_url'),
                        "pageDescription" => $parentContent->fetch('data.description'),
                    ])
                    @slot('interactionSlot')

                    @endslot
                @endcomponent

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

            <div class="tw-container tw-mx-auto tw-px-4 mv-3">
                <div class="tw-flex tw-flex-column">
                    <div class="tw-flex tw-w-full tw-flex-row">
                        <content-catalogue
                            brand="{{ $brand }}"
                            catalogue-type="list"
                            theme-color="{{ $brand }}"
                            :use-theme-color="true"
                            :pre-loaded-content="{{ $childContent }}"
                            :is-admin="<?php echo e(json_encode(user()->isAdmin())); ?>"
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
                            user-id="{{ user()->id }}"
                            :is-admin="{{ json_encode(user()->isAdmin()) }}"
                        >
                            @for($i = 0; $i < 10; $i++)
                                @include('partials.bladesora.members.skeletons.list-item', [
                                    "overview" => $parentContent['type'] === 'learning-path',
                                    "showNumbers" => $parentContent['type'] !== 'learning-path',
                                    "thumbnailType" => $parentContent['type'] === 'learning-path' ? 'square' : 'widescreen'
                                ])
                            @endfor
                        </content-catalogue>
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

        </div>
@endsection
