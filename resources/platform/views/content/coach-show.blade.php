@php
    $firstLastName = preg_split('/\s+/', $thisCoach->fetch('fields.name'));
    $currentUserSubscribed = $thisCoach->fetch('current_user_is_subscribed');
    $headerDescription = $thisCoach->fetch('data.short_bio');

    $ctas = [
        [
            'type' => 'PageHeaderCta',
            'props' => [
                'text' => $currentUserSubscribed ? 'Unsubscribe' : 'Subscribe',
                'contentFunction' => $currentUserSubscribed ? 'unfollowCoach' : 'followCoach',
                'payload' => [
                    'coachId' => $thisCoach->fetch('id'),
                    'firstName' => $firstLastName[0],
                ],
                'faIconClass' => 'fa-bell',
                'showAllAlways' => true,
                'isPrimary' => true,
            ]
        ]
    ];

    $infoDataStrArr = [];
    if ($thisCoach->fetch('data.focus_text','')) {
        $infoDataStrArr = [
            $thisCoach->fetch('data.focus_text','')
        ];
    }

    $ctasJson = json_encode($ctas);
    $infoDataStrArrJson = json_encode($infoDataStrArr);
    $breadcrumbs = [
        [
            'title' => 'Coaches',
            'url' => url()->route('platform.coaches'),
        ],
        [
            'title' => $thisCoach->fetch('fields.name'),
        ]
    ];
@endphp


@extends('partials.layout', ['trackingSectionName' => 'Coaches'])

@section('meta')
    <title>{{ ucfirst($thisCoach->fetch('fields.name')) }} | Musora</title>
@endsection

@section('content')
    @php
        $catalogueProps = [];
        $catalogueProps['themeColor'] = $brand;
        $catalogueProps['brand'] = $brand;
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
        }
    @endphp

    <coach-show
        :coach-data="{{ json_encode($thisCoach) }}"
        :breadcrumbs="{{ json_encode($breadcrumbs) }}"
        :header-info-data="{{ $infoDataStrArrJson }}"
        :header-ctas="{{ $ctasJson }}"
        header-description="{{ $headerDescription }}"
        :coach-event="{{ $coachEvent }}"
        @if(!empty($coachEvent))
            coach-event-current-date-string="{{ $currentDate }}"
            coach-event-subscription-calendar-id="{{ $currentEventCalendarId }}"
            coach-event-youtube-event-id="{{ $youtubeId }}"
            :coach-event-time-cutoff-minutes="{{ $timeCutoffMinutes }}"
            event-coach-profile-url="{{ $eventCoachProfileUrl }}"
        @endif
        :collection-limit="{{ $limitOverride ?? 18 }}"
        :collection-data="{{ $listLessons }}"
        :collection-required-fields="{{ json_encode($requiredFields) }}"
        :collection-statuses="{{ json_encode(['published', 'scheduled']) }}"
        :collection-filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
    ></coach-show>
    
@endsection