@extends('partials.layout', ['trackingSectionName' => $parentContent->fetch('fields.title')])

@section('meta')
    <title>{{ $parentContent->fetch('fields.title') }} | Musora</title>
@endsection

{{-- Learning Path JS --}}
@section('layout-scripts')
    @if($parentContent->fetch('type') === 'learning-path' || $parentContent['type'] === 'learning-path-level')
        {{-- Typeform Embed --}}
        <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
    @endif
@endsection

@php
    $headerData = [
        'iconName' => null,
        'title' => null,
        'description' => null,
        'heroImg' => null,
        'progressLabelText' => null,
        'progress' => null,
        'contentId' => null,
        'infoData' => null,
        'ctas' => null,
        'darkModeLogo' => null,
        'lightModeLogo' => null,
    ];

    $infoDataStrArr = [];
    if ($parentContent->fetch('type') === 'challenge'){
        $headerData['darkModeLogo'] = $parentContent->fetch('data.dark_mode_logo_url');
        $headerData['lightModeLogo'] = $parentContent->fetch('data.light_mode_logo_url');
    }
    if ($parentContent->fetch('type') === 'course' || $parentContent->fetch('type') === 'challenge') {
        if (isset($infoData['lessons'])) {
            $infoDataStrArr[] = $infoData['lessons'] . ' Lessons';
        }
        if (isset($infoData['xp'])) {
            $infoDataStrArr[] = $infoData['xp'] . ' XP';
        }

        $headerData['title'] = $parentContent->fetch('fields.title');
        $headerData['description'] = $parentContent->fetch('data.description');
        $headerData['heroImg'] = $parentContent->fetch('fields.instructor.data.head_shot_picture_url');
        $headerData['progress'] = $parentContent->fetch('progress_percent', 0);
        $headerData['contentId'] = $parentContent->fetch('id');
        $headerData['infoData'] = $infoDataStrArr;
        $headerData['ctas'] = [
            [
                'type' => 'PageHeaderPrimaryCta',
                'props' => [
                    'text' => 'Start first lesson',
                    'url' => $nextLessonUrl,
                    'faIconClass' => 'fa-play'
                ]
            ],
            [
                'type' => 'ResetProgressCta',
                'props' => [
                    'contentId' => $parentContent->fetch('id'),
                    'progress' => $parentContent->fetch('progress_percent', 0),
                ]
            ],
            [
                'type' => 'DownloadResourcesCta',
                'props' => [
                    'resources' => $parentContent['resources'] ?? []
                ]
            ]
        ];
    }
    elseif ($parentContent->fetch('type') === 'learning-path') {
        
        $headerData['iconName'] = 'method';
        if(!Str::contains(request()->path(), 'foundations-2019')) {
            $headerData['title'] = 'Method';
        } else {
            $headerData['title'] = 'Foundations';
        }
        $headerData['description'] = $parentContent->fetch('data.description');
        $headerData['progress'] = $parentContent->fetch('progress_percent', 0);
        $headerData['progressLabelText'] = $progressLabelText;
        $headerData['contentId'] = $parentContent->fetch('id');
        $headerData['infoData'] = $infoDataStrArr;
        $headerData['ctas'] = [];

        $vimeoVideoId = $parentContent->fetch('fields.video.fields.vimeo_video_id');
        if (!empty($vimeoVideoId)) {
            $headerData['ctas'][] = [
                'type' => 'PreviewLessonCta',
                'props' => [
                    'contentId' => $parentContent->fetch('id'),
                    'videoId' => $vimeoVideoId,
                    'castTitle' => $parentContent->fetch('fields.title'),
                    'poster' => $parentContent['video_poster_image_url'] ?? '',
                    'sources' => $parentContent['video_playback_endpoints'],
                    'nextLessonUrl' => $nextLessonUrl,
                ],
            ];
        }
        if ($brand === 'drumeo' || $brand === 'pianote' && !Str::contains(request()->path(), 'foundations-2019')) {
            $headerData['ctas'][] = [
                'type' => 'WhereToBeginCta',
            ];
        }
        if (Str::contains(request()->path(), 'foundations-2019')) {
            $headerData['ctas'][] = [
                'type' => 'PageHeaderCta',
                'props' => [
                    'text' => 'FOUNDATIONS BOOK RESOURCES',
                    'url' => '/pianote/resources',
                    'showAllAlways' => true
                ]
            ];
        }
    }
    elseif ($parentContent->fetch('type') === 'learning-path-level' || $parentContent->fetch('type') === 'learning-path-course' || $parentContent->fetch('type') === 'challenge'){
        if (isset($infoData['courses'])) {
            $infoDataStrArr[] = $infoData['courses'] . ' Courses';
        }
        if (isset($infoData['lessons'])) {
            $infoDataStrArr[] = $infoData['lessons'] . ' Lessons';
        }
        if (isset($infoData['xp'])) {
            $infoDataStrArr[] = $infoData['xp'] . ' XP';
        }
        if($parentContent->fetch('type') === 'learning-path-level'){
            $headerData['title'] = 'Level ' . $parentContent->fetch('level_number', 0) . ' - ' . $parentContent->fetch('fields.title');
        }
        else if($parentContent->fetch('type') === 'learning-path-course') {
            $headerData['title'] = 'Level ' . $secondContent->fetch('level_number', 0) . '.' . $parentContent->fetch('course_position', 0) . ' - ' . $parentContent->fetch('fields.title');
        }
        $headerData['progress'] = $parentContent->fetch('progress_percent', 0);
        $headerData['description'] = $parentContent->fetch('data.description');
        $headerData['progressLabelText'] = $progressLabelText;
        $headerData['contentId'] = $parentContent->fetch('id');
        $headerData['infoData'] = $infoDataStrArr;
        $headerData['ctas'] = [
            [
                'type' => 'ResetProgressCta',
                'props' => [
                    'contentId' => $parentContent->fetch('id'),
                    'progress' => $parentContent->fetch('progress_percent', 0),
                ]
            ],    
        ];

    }

    $headerDataJson = json_encode($headerData);
    $headerDataObj = json_decode($headerDataJson);

@endphp

{{-- Content --}}
@section('content')

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        @include('content.breadcrumbs._overview-breadcrumbs')
        
        <page-header
            page-type="{{ $parentContent->fetch('type') }}"
            icon-name="{{ $headerDataObj->iconName }}"
            title="{{ $headerDataObj->title }}"
            description="{{ $headerDataObj->description }}"
            hero-img="{{ $headerDataObj->heroImg }}"
            progress-label-text="{{ $headerDataObj->progressLabelText }}"
            progress="{{ $headerDataObj->progress }}"
            content-id="{{ $headerDataObj->contentId }}"
            :info-data="{{ json_encode($headerDataObj->infoData) }}"
            :ctas="{{ json_encode($headerDataObj->ctas) }}"
            dark-mode-logo="{{ $headerDataObj->darkModeLogo  }}"
            light-mode-logo="{{ $headerDataObj->lightModeLogo }}"
        ></page-header>

        @if(!empty($nextLessonJson))
            @include('partials._current-learning-path-lesson', [
                "currentLearningPathLesson" => $nextLessonJson,
            ])
        @endif
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-my-[30px]">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-w-full tw-flex-row">

                <transition appear name="fade">
                    <content-catalogue
                        brand="{{ $brand }}"
                        @if(!empty($pack) && $pack['slug'] == '500-songs-in-5-days')
                        catalogue-type="grid"
                        @else
                        catalogue-type="list"
                        @endif
                        theme-color="{{ $brand }}"
                        user-id="{{ user()->id }}"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $childContent }}"
                        :is-admin="<?php echo e(json_encode(user()->isAdmin())); ?>"
                        {{-- :is-admin="{{ json_encode(user()->isAdmin()) }}" --}}
                        @if($displayItemAsOverview ?? false)
                            :display-items-as-overview="true"
                        @endif
                        @if(!user()->isAdmin())
                            :lock-unowned="true"
                        @endif
                        @if($parentContent['type'] !== 'learning-path')
                            :show-numbers="true"
                            :force-wide-thumbs="false"
                        @endif
                        {{-- New learning Paths? --}}
                        @if(!empty($classicalMethodPackJson)) {{-- Check for Branch Path Content --}}
                            :branch-path-index="4" {{-- Where does the branched content begin? (0 based) --}}
                            :branch-path-content="{{ $classicalMethodPackJson }}"
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

            @if($xpBonus > 0 && (empty($pack) || $pack['slug'] !== '500-songs-in-5-days'))
                @include('partials.bladesora.members.partials._completion-bonus', [
                    "xpBonus" => $xpBonus,
                    "isComplete" => $parentContent->fetch('progress_percent', 0) === 100,
                    "themeColor" => $brand
                ])
            @endif

            {{-- Pianote Foundations --}}
            @if($parentContent['slug'] == 'pianote-method')
                <a href="/pianote/method/foundations-2019/215952"
                class="flex flex-row no-decoration hover-bg-grey-7 dark:hover:tw-bg-[#002039] tw-relative text-grey-3 hover-text-black content-overview pv-2">

                    <div class="flex flex-column">
                        <p class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl tw-font-bold tw-mt-[5px]">Pianote Foundations</p>
                    </div>

                    <div class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl tw-font-bold tw-flex tw-flex-col tw-justify-center tw-text-center hide-sm-down tw-mr-2">
                        10 Levels
                    </div>

                    <div class="flex flex-column icon-col align-v-center hide-xs-only">
                        <div class="body">
                            <i class="fas flex-center tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D] rounded fa-play-circle"></i>
                        </div>
                    </div>
                </a>
            @endif
        </div>
    </div>

    {{-- for guitareo 500 songs special page --}}
    @if(!empty($songsPdfs))
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-my-3">
            <collection-wrapper
                collection-type="song-pdf"
                :pre-loaded-content="{{ $songsPdfs }}"
                title="Songs"
            ></collection-wrapper>
        </div>
    @endif

@endsection
