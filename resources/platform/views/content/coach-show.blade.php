@php
$bodyClass = ($bodyClass ?? '') . ' sidebar';
$leftSidebar = true;
$firstLastName = preg_split('/\s+/', $thisCoach->fetch('fields.name'));
$currentUserSubscribed = $thisCoach->fetch('current_user_is_subscribed');
@endphp

@extends('members.layout')

@section('meta')
    <title>{{ ucfirst($thisCoach->fetch('fields.name')) }} | Singeo</title>
@endsection

@section('breadcrumbs')
    @include('members.partials._content-sidebar')
    @include('bladesora::members.navigation.breadcrumbs', [
    'pages' => [
    [
    'title' => 'Coaches',
    'url' => url()->route('members.coaches.index'),
    ],
    [
    'title' => $thisCoach->fetch('fields.name'),
    ]
    ]
    ])
@endsection

@section('content')
    @component('bladesora::members.components.coach-header-banner', [
        'brandName' => 'singeo',
        'hideUser' => true,
        'backgroundImage' => $thisCoach->fetch('data.coach_top_banner_image'),
        'shortBio' => $thisCoach->fetch('data.short_bio'),
        'focusArray' => [$thisCoach->fetch('data.focus_text','')],
        'firstName' => $firstLastName[0] ?? '',
        'lastName' => $firstLastName[1] ?? '',
        'isUserSubscribed' => $currentUserSubscribed,
        'coachId' => $thisCoach->fetch('id'),
        'vimeoVideo' => $thisCoach->fetch('fields.video.fields.vimeo_video_id', null),
        'forumUrl' => $thisCoach->fetch('fields.forum_thread_id')?$thisCoach['forum_thread']['url']:'',
        'subscribeUrl' => url()->route('content.follow',['content_id'=>$thisCoach->fetch('id')]),
        'unsubscribeUrl' => url()->route('content.unfollow',['content_id'=>$thisCoach->fetch('id')])
        ])
    @endcomponent

    <!-- Coach Event -->
    @if(!empty($currentEvent))
        <section class="tw-flex tw-py-2 tw-bg-gray-100">
            <coach-event brand="singeo" :preloaded-content='{{ $coachEvent }}' current-date-string="{{ $currentDate }}"
                subscription-calendar-id="{{ $currentEventCalendarId }}" youtube-event-id="{{ $youtubeId }}"
                :time-cutoff-minutes="{{ $timeCutoffMinutes }}" event-coach-profile-url="{{ $eventCoachProfileUrl }}">
            </coach-event>
        </section>
    @endif

    @if (session()->has('success-message'))
        <div class="form-success-message container mt-3">
            <div class="flex flex-column bg-success shadow corners-10 pa">
                <p class="body text-white">{{ session()->get('success-message') }}</p>
            </div>
        </div>
    @endif

    @if ($hasFeaturedLessons)
        <div class="container mt-2 mb-3">
            <div class="flex flex-row mb-3">
                <div class="flex flex-column grow">
                    <div class="flex flex-row align-v-center pv-2">
                        <span class="rounded bg-singeo text-white icon-bg-circle body mr-1">
                            <i class="fas fa-graduation-cap"></i>
                        </span>

                        <h2 class="heading capitalize grow">
                            Featured Lessons
                        </h2>
                    </div>

                    <div class="flex flex-row six-cards-row">
                        <transition appear name="fade">
                            <content-catalogue brand="singeo" theme-color="singeo" :use-theme-color="true"
                                content-endpoint="/railcontent/content" catalogue-type="coach-grid" limit="16"
                                :lock-unowned="true" :four-wide="true" :force-wide-thumbs="true"
                                :pre-loaded-content="{{ $featuredLessons }}">
                                <div class="flex flex-row nmh-1">
                                    @for ($i = 0; $i < 4; $i++)
                                        @include('bladesora::members.skeletons.card-item', [
                                        "cardClass" => 'four-wide',
                                        ])
                                    @endfor
                                </div>
                            </content-catalogue>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @php
    $catalogueProps = [];
    $catalogueProps['themeColor'] = 'singeo';
    $catalogueProps['brand'] = 'singeo';
    $catalogueProps['contentEndpoint'] = '/railcontent/content';
    $catalogueProps['catalogueType'] = 'list';
    $catalogueProps['limit'] = $limitOverride ?? 16;
    $catalogueProps['infiniteScroll'] = false;
    $catalogueProps['statuses'] = ['published', 'scheduled'];
    $catalogueProps['includedTypes'] = $includedTypes;
    $catalogueProps['requiredFields'] = $requiredFields;
    $catalogueProps['includedFields'] = $includedFields;
    $catalogueProps['preLoadedContent'] = json_decode($listLessons);
    $catalogueProps['userId'] = auth()->id();
    $catalogueProps['useUrlParams'] = true;
    $catalogueProps['lockUnowned'] = true;
    $catalogueProps['showLoadingAnimation'] = true;
    $catalogueProps['isCoach'] = true;
    $catalogueProps['coachId'] = $thisCoach->fetch('id');

    if (!empty($showSearch)) {
        $catalogueProps['searchBar'] = true;
        $catalogueProps['totalResults'] = $totalResults;
        $catalogueProps['paginate'] = true;
        $catalogueProps['fourWide'] = true;
    }
    @endphp

    <div class="container mt-3 mb-3">
        <content-catalogue-container brand="singeo" :catalogue-props="{{ json_encode($catalogueProps) }}">
            @for ($i = 0; $i < ($limitOverride ?? 16); $i++)
                @include('bladesora::members.skeletons.card-item', [
                "cardClass" => 'four-wide',
                ])
            @endfor
        </content-catalogue-container>
    </div>

    @component('bladesora::members.components.coach-subscribe-toasts', [
        'brandName' => 'singeo',
        'firstName' => $firstLastName[0],
        ])
    @endcomponent

    @component('bladesora::members.components.coach-footer', [
        'brandName' => 'singeo',
        'shortBio' => $thisCoach->fetch('data.long_bio'),
        'focusArray' => $thisCoach->fetch('*fields.focus.value'),
        'firstName' => $firstLastName[0] ?? '',
        'lastName' => $firstLastName[1] ?? '',
        'coachId' => $thisCoach->fetch('id'),
        'headShotPicture' => $thisCoach->fetch('data.head_shot_picture_url'),
        'longBio' => $thisCoach->fetch('data.long_bio'),
        'bandsArray' => $thisCoach->fetch('*fields.bands.value'),
        'endorsementsArray' => $thisCoach->fetch('*fields.endorsements.value'),
        ])
    @endcomponent
@endsection
