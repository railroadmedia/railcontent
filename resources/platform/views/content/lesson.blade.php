@php
    $hasQAVideo = !empty($lessonContent['qna_video_playback_endpoints']);
    $hasRelatedLessons = false;
    if (
        count(json_decode($relatedLessons)->data) > 1
    ) {
        $hasRelatedLessons = true;
    }

    if (!empty($lessonContent->fetch('fields.video.fields.youtube_video_id'))) {
        $videoProps = [
            'ref' => 'mediaElementVueInstance',
            'videoId' => $lessonContent->fetch('fields.video.fields.youtube_video_id'),
            'currentSecond' => $lessonContent->fetch('last_watch_position_in_seconds', 0),
            'totalDuration' => $lessonContent->fetch('fields.video.fields.length_in_seconds', 0),
            'videoLength' => $lessonContent->fetch('fields.video.fields.length_in_seconds'),
            'progressState' => $lessonContent->fetch('progress_state'),
            'contentId' => $lessonContent->fetch('id'),
            'useIntersectionObserver' => true,
            'videoType' => 'youtube',
            'useLegacyPlayer' => false,
            'chapters' => $lessonContent['chapters'] ?? [],
        ];
    } elseif (user()->use_legacy_video_player ?? false || $agent->isSamsung()) {
        $videoProps = [
            'ref' => 'mediaElementVueInstance',
            'elementId' => 'lessonPlayer',
            'poster' => $lessonContent['video_poster_image_url'] ?? '',
            'sources' => $lessonContent['video_playback_endpoints'] ?? [],
            'hlsManifestUrl' => $lessonContent['hlsManifestUrl'] ?? '',
            'videoId' => $lessonContent->fetch('fields.video.fields.vimeo_video_id'),
            'contentId' => $lessonContent->fetch('id'),
            'currentSecond' => $lessonContent->fetch('last_watch_position_in_seconds', 0),
            'progressState' => $lessonContent->fetch('progress_state'),
            'videoLength' => $lessonContent->fetch('fields.video.fields.length_in_seconds'),
            'chapters' => $lessonContent['chapters'] ?? [],
            'userId' => user()->id,
            'likeCount' => $lessonContent['like_count'] ?? 0,
            'isLiked' => $lessonContent['is_liked_by_current_user'] ?? false,
            'checkForTimecode' => true,
            'videoType' => 'vimeo',
            'useLegacyPlayer' => true,
            'thumbnailUrl' => $lessonContent->fetch('data.thumbnail_url'),
        ];
    } elseif (!empty($lessonContent->fetch('fields.video.fields.vimeo_video_id'))) {
        $videoProps = [
            'title' => $lessonContent->fetch('fields.title'),
            'lessonType' => $lessonType,
            'thumbnailUrl' => $lessonContent->fetch('data.thumbnail_url'),
            'description' => $lessonContent->fetch('data.description'),
            'instructors' => $lessonContent['coaches'] ?? [],
            'parentTitle' => isset($parent) ? $parent->fetch('fields.title') : null,
            'isLiked' => $lessonContent['is_liked_by_current_user'] ?? false,
            'likeCount' => $lessonContent['like_count'] ?? 0,
            'isAdded' => $lessonContent->fetch('is_added_to_primary_playlist') ?? false,
            'contentId' => $lessonContent->fetch('id'),
            'userId' => user()->id,
            'sources' => $lessonContent['video_playback_endpoints'] ?? [],
            'resources' => array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? []),
            'showAddToList' => $lessonType != 'song',
            'showInfoButton' =>
                !empty($lessonContent->fetch('*fields.instructor')) ||
                !empty($lessonContent->fetch('data.description')) ||
                !empty($lessonContent['chapters']),
            'reportUserEmail' => user()->email,
            'reportUserName' => user()->display_name,
            'reportRecipient' => config('mailora.' . $brand . '.ask-question-recipient'),
            'reportLogo' => config('mailora.' . $brand . '.logo-link'),
            'videoId' => $lessonContent->fetch('fields.video.fields.vimeo_video_id'),
            'videoType' => 'vimeo',
            'useLegacyPlayer' => false,
            'hlsManifestUrl' => $lessonContent['hlsManifestUrl'] ?? '',
            'chapters' => $lessonContent['chapters'] ?? [],
            'totalDuration' => $lessonContent->fetch('fields.video.fields.length_in_seconds', 0),
        ];
    } else {
        $videoProps = [];
    }
    $videoResources = [
        'themeColor' => $brand,
        'brand' => $brand,
        'title' => $lessonContent->fetch('fields.title'),
        'lessonType' => $lessonType,
        'thumbnailUrl' => $lessonContent->fetch('data.thumbnail_url'),
        'description' => $lessonContent->fetch('data.description'),
        'instructors' => $lessonContent['coaches'] ?? [],
        'parentTitle' => isset($parent) ? $parent->fetch('fields.title') : null,
        'isLiked' => $lessonContent['is_liked_by_current_user'] ?? false,
        'likeCount' => $lessonContent['like_count'] ?? 0,
        'isAdded' => $lessonContent->fetch('is_added_to_primary_playlist') ?? false,
        'contentId' => $lessonContent->fetch('id'),
        'userId' => user()->id,
        'resources' => array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? []),
        'showAddToList' => $lessonType != 'song',
        'showInfoButton' =>
            !empty($lessonContent->fetch('*fields.instructor')) ||
            !empty($lessonContent->fetch('data.description')) ||
            !empty($lessonContent['chapters']),
        'reportUserEmail' => user()->email,
        'reportUserName' => user()->display_name,
        'reportRecipient' => config('mailora.' . $brand . '.ask-question-recipient'),
        'reportLogo' => config('mailora.' . $brand . '.logo-link'),
        'difficulty' => $lessonContent->fetch('difficulty'),
    ];
    $videoProps['need_access'] = $lessonContent->fetch('need_access') ?? false;
    $videoButtons = [
        'prevLessonUrl' => !empty($previousChild) ? $previousChild->fetch('url') : null,
        'nextLessonUrl' => !empty($nextChild) ? $nextChild->fetch('url') : null,
        'hasQAVideo' => !empty($lessonContent['qna_video_playback_endpoints']),
        'isCompleted' => $lessonContent->fetch('completed'),
        'contentId' => $lessonContent->fetch('id'),
        'xpAmount' => $lessonContent->fetch('fields.xp'),
    ];

    $commentsProps = [
        'themeColor' => $brand, // Assuming $brand is a variable
        'brand' => $brand,
        'contentId' => $lessonContent->fetch('id'),
        'userId' => user()->id,
        'userName' => user()->display_name,
        'userAvatar' => user()->profile_picture_url,
        'userXp' => user()->totalXP(),
        'userAccessLevel' => user()->access_level,
        'profileBaseRoute' => '/profile/',
        'isAdmin' => json_encode(user()->isAdmin()),
    ];

    $contentBreadCrumb = new stdClass();
    $contentBreadCrumb->pages = [];
    $contentBreadCrumb->breadcrumbClassOverride = '';

    if ($lessonType === 'student-focus') {
        $contentBreadCrumb->pages[] = (object) [
            'title' => 'Student Focus',
            'url' => url()->route('platform.student-focus'),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => $lessonContent->fetch('fields.title'),
        ];
    } elseif ($lessonType === 'unit-part') {
        $contentBreadCrumb->pages[] = (object) [
            'title' => $firstContent->fetch('fields.title'),
            'url' => $firstContent->fetch('url'),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => $parent->fetch('fields.title'),
            'url' => $parent->fetch('url'),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => $lessonContent->fetch('fields.title'),
        ];
        $contentBreadCrumb->breadcrumbClassOverride = $breadcrumbClassOverride ?? '';
    } elseif ($lessonType === 'challenge-part') {
        $contentBreadCrumb->pages[] = (object) [
            'title' => 'Workouts',
            'url' => url()->route('platform.workouts'),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => 'Challenges',
            'url' => url()->route('platform.workouts.challenges'),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => $parent->fetch('fields.title'),
            'url' => $parent->fetch('url'),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => $lessonContent->fetch('fields.title'),
        ];
        $contentBreadCrumb->breadcrumbClassOverride = $breadcrumbClassOverride ?? '';
    } elseif ($lessonType === 'learning-path-lesson') {
        $contentBreadCrumb->pages[] = (object) [
            'title' => $brand . ' Method',
            'url' => url()->route('platform.content.first-level', [
                'method',
                $firstContent['slug'],
                $firstContent['id'],
            ]),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => $parent->fetch('fields.title'),
            'url' => $parent->fetch('url'),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => $lessonContent->fetch('fields.title'),
        ];
        $contentBreadCrumb->breadcrumbClassOverride = $breadcrumbClassOverride ?? '';
    } elseif ($lessonType === 'coach-stream') {
        $contentBreadCrumb->pages[] = (object) [
            'title' => 'Coaches',
            'url' => url()->route('platform.coaches'),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => !empty($coach->fetch('fields.title'))
                ? $coach->fetch('fields.title')
                : $coach->fetch('fields.name'),
            'url' => $coach->fetch('url'),
        ];
        $contentBreadCrumb->pages[] = (object) [
            'title' => $lessonContent->fetch('fields.title'),
        ];
        $contentBreadCrumb->breadcrumbClassOverride = $breadcrumbClassOverride ?? '';
    } elseif (!empty($pack)) {
        $pages = [
            (object) [
                'title' => 'Packs',
                'url' => url()->route('platform.packs'),
            ],
            (object) [
                'title' => $pack->fetch('fields.title'),
                'url' => $pack->fetch('url'),
            ],
            (object) [
                'title' => $lessonContent->fetch('fields.title'),
            ],
        ];

        if ($theme ?? '' === 'made-easy' || $pack->fetch('bundle_count') <= 1) {
            $contentBreadCrumb->pages = $pages;
            $contentBreadCrumb->breadcrumbClassOverride = 'tw-px-4 md:tw-px-8 tw-max-w-[1703px]';
        } else {
            $packParent = (object) [
                'title' => $parent->fetch('fields.title'),
                'url' => $parent->fetch('url'),
            ];
            array_splice($pages, -1, 0, [$packParent]);

            $contentBreadCrumb->pages = $pages;
            $contentBreadCrumb->breadcrumbClassOverride = $breadcrumbClassOverride ?? '';
        }
    } else {
        if (isset($parent)) {
            if ($parent->fetch('type') === 'pack-bundle') {
                $contentBreadCrumb->pages[] = (object) [
                    'title' => 'Packs',
                    'url' => url()->route('platform.packs'),
                ];
                $contentBreadCrumb->pages[] = (object) [
                    'title' => $pack->fetch('fields.title'),
                    'url' => url()->route('platform.packs.first-level', [
                        'packSlug' => $pack->fetch('slug'),
                        'packId' => $pack->fetch('id'),
                    ]),
                ];
                $contentBreadCrumb->pages[] = (object) [
                    'title' => $lessonContent->fetch('fields.title'),
                ];
                $contentBreadCrumb->breadcrumbClassOverride = $breadcrumbClassOverride ?? '';
            } else {
                $contentBreadCrumb->pages[] = (object) [
                    'title' => parse_lesson_type_readable($parent->fetch('type'), true),
                    'url' => url()->route('platform.content-type-catalog', [
                        'contentTypeName' => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[
                            $parent->fetch('type')
                        ],
                    ]),
                ];
                $contentBreadCrumb->pages[] = (object) [
                    'title' => $parent->fetch('fields.title'),
                    'url' => $parent->fetch('url'),
                ];
                $contentBreadCrumb->pages[] = (object) [
                    'title' => $lessonContent->fetch('fields.title'),
                ];
                $contentBreadCrumb->breadcrumbClassOverride = $breadcrumbClassOverride ?? '';
            }
        } else {
            $contentBreadCrumb->pages[] = (object) [
                'title' => parse_lesson_type_readable($lessonContent->fetch('type'), true),
                'url' => url()->route('platform.content-type-catalog', [
                    'contentTypeName' => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[
                        $lessonContent->fetch('type')
                    ],
                ]),
            ];
            $contentBreadCrumb->pages[] = (object) [
                'title' => $lessonContent->fetch('fields.title'),
            ];
            $contentBreadCrumb->breadcrumbClassOverride = $breadcrumbClassOverride ?? '';
        }
    }
@endphp

@extends('partials.layout', ['forceHideSidebar' => false])

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('inject-components')
    <script src="{{ mix('platform/js/lesson-page.js') }}"></script>
    @if ($hasQAVideo)
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
    @endif
@endsection

@section('content')
    {{-- Session Token for Railtracker progress tracking --}}
    <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">
    {{-- TODO: RT integration --}}

    <lesson-playback
        :breadcrumb-last-level-title="{{ json_encode($lessonContent->fetch('fields.title')) }}"
        :video-props="{{ json_encode($videoProps) }}" :related-lessons="{{ $relatedLessons }}"
        :video-resources="{{ json_encode($videoResources) }}"
        :video-buttons="{{ json_encode($videoButtons) }}"
        :comments-props="{{ json_encode($commentsProps) }}"
        :content-breadcrumb="{{ json_encode($contentBreadCrumb) }}"
        :content-description="{{ json_encode($lessonContent->fetch('data.description', null)) }}"
        :has-related-lessons="{{ json_encode($hasRelatedLessons) }}"
        :assignments="{{ json_encode($lessonContent->fetch('*assignments', [])) }}"
        :lesson-data="{{ json_encode($lessonContent) }}"
        :progress-xp="{{ json_encode($lessonContent->fetch('total_xp', $lessonContent->fetch('xp', 0)),) }}"
        :this-lesson-json="{{ $thisLessonJson }}"
        :next-lesson-json="{{ !empty($nextChild) ? $nextLessonJson : null }}"
        @if(!empty($lessonContent->fetch('soundslice_slug')))
            :soundslice-slug={{ json_encode($lessonContent->fetch('soundslice_slug')) }}
        @endif
    >
    </lesson-playback>
@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
@endsection
