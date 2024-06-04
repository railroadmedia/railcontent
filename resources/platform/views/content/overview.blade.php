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
    if ($parentContent->fetch('type') === 'course' || $parentContent->fetch('type') === 'challenge' || $parentContent->fetch('type') === 'song-tutorial') {
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
                    'faIconClass' => 'fa-play',
                    'isPrimary' => true,
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

    $breadcrumbs = [];
    if($parentContent->fetch('type') === 'learning-path'){
        $breadcrumbs = [
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    } elseif($parentContent->fetch('type') === 'learning-path-level'){
        $breadcrumbs = [
            [
                "title" => ucwords(brand()) . ' Method',
                "url" => url()->route('platform.content.first-level', [$primaryPage, $firstSlug, $firstId]),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    } elseif($parentContent->fetch('type') === 'learning-path-course'){
        $breadcrumbs = [
            [
                "title" => ucwords(brand()) . ' Method',
                "url" => url()->route('platform.content.first-level', [$primaryPage, $firstSlug, $firstId]),
            ],
            [
                "title" => $secondContent->fetch('fields.title'),
                "url" => $secondContent->fetch('url'),
            ],
            [
                "title" => $thirdContent->fetch('fields.title'),
            ]
        ];
    } elseif ($parentContent->fetch('type') === 'unit'){
        $breadcrumbs = [
            [
                "title" => $learningPath->fetch('fields.title'),
                "url" => $learningPath->fetch('url'),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    }
    elseif($parentContent->fetch('type') === 'challenge'){
        $breadcrumbs = [
            [
                "title" => 'Workouts',
                "url" => url()->route('platform.workouts'),
            ],
            [
                "title" => 'Challenges',
                "url" => url()->route('platform.workouts.challenges'),
            ],
            [
                 "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    } elseif($parentContent->fetch('type') === 'pack-bundle'){
        if($pack->fetch('bundle_count') > 1){
            $breadcrumbs = [
                [
                    "title" => "Packs",
                    "url" => url()->route('platform.packs'),
                ],
                [
                    "title" => $pack->fetch('fields.title'),
                    "url" => $pack->fetch('url'),
                ],
                [
                    "title" => $parentContent->fetch('fields.title')
                ]
            ];
        } elseif($pack->fetch('bundle_count') <= 1){
            $breadcrumbs = [
                [
                    "title" => "Packs",
                    "url" => url()->route('platform.packs'),
                ],
                [
                    "title" => $pack->fetch('fields.title')
                ]
            ];
        }
    } else {
        $breadcrumbs = [
            [
                "title" => parse_lesson_type_readable($parentContent->fetch('type'), true),
                "url" => url()->route('platform.content-type-catalog', ["contentTypeName" => parse_lesson_type_readable($parentContent->fetch('type'), true)]),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    }

@endphp

{{-- Content --}}
@section('content')
    <overview
        :breadcrumbs="{{ json_encode($breadcrumbs) }}"
        :header-data="{{ json_encode($headerDataObj) }}"
        page-type="{{ $parentContent->fetch('type') }}"
        @if(!empty($nextLessonJson))
            :next-lesson="{{ $nextLessonJson }}"
        @endif
        user-id="{{ user()->id }}"
        :is-admin="{{ json_encode(user()->isAdmin()) }}"
        :child-content="{{ $childContent }}"
        @if($displayItemAsOverview ?? false)
            :child-content-display-items-as-overview="true"
        @endif
        @if($parentContent['type'] !== 'learning-path')
            :child-content-show-numbers="true"
            :child-content-force-wide-thumbs="false"
        @endif
        {{-- New learning Paths? --}}
        @if(!empty($classicalMethodPackJson)) {{-- Check for Branch Path Content --}}
            :child-content-branch-path-index="4" {{-- Where does the branched content begin? (0 based) --}}
            :child-content-branch-path-content="{{ $classicalMethodPackJson }}"
        @endif
        @if($xpBonus > 0 && (empty($pack) || $pack['slug'] !== '500-songs-in-5-days'))
            :show-completion-bonus="true"
            :xp-bonus="{{ $xpBonus }}"
        @endif
        @if($parentContent['slug'] == 'pianote-method')
            :show-pianote-foundations="true"
        @endif
        @if(!empty($songsPdfs))
            :songs-pdfs="{{ $songsPdfs }}"
        @endif
    ></overview>
@endsection
