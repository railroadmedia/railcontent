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
                    'coachId' => $thisCoach->fetch('id')
                ],
                'faIconClass' => 'fa-bell',
                'showAllAlways' => true,
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
@endphp


@extends('partials.layout', ['trackingSectionName' => 'Coaches'])

@section('meta')
    <title>{{ ucfirst($thisCoach->fetch('fields.name')) }} | Musora</title>
@endsection

@section('content')

    @include('partials.bladesora.members.navigation.breadcrumbs', [
        'pages' => [
            [
                'title' => 'Coaches',
                'url' => url()->route('platform.coaches'),
            ],
            [
                'title' => $thisCoach->fetch('fields.name'),
            ]
        ]
    ])

    <page-header
        page-type="{{ $thisCoach->fetch('type') }}"
        :title="'{{ $firstLastName[0] }}' + ' ' + '{{ $firstLastName[1] }}'"
        hero-img="{{ $thisCoach->fetch('data.coach_top_banner_image') }}"
        :info-data="{{ $infoDataStrArrJson }}"
        :ctas="{{ $ctasJson }}"
        description="{{ $headerDescription }}"
    >
    </page-header>

    @if( !empty($coachEvent) )
        <div class=" tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-4">
            {{-- Live Banner --}}
            <coach-event
                brand="{{ $brand }}"
                :preloaded-content='{{ $coachEvent }}'
                current-date-string="{{ $currentDate }}"
                subscription-calendar-id="{{ $currentEventCalendarId }}"
                youtube-event-id="{{ $youtubeId }}"
                :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
                event-coach-profile-url="{{ $eventCoachProfileUrl }}"
            ></coach-event>
        </div>
    @endif

    @if (session()->has('success-message'))
        <div class="form-success-message tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
            <div class="tw-flex tw-flex-col bg-success tw-shadow corners-10 pa">
                <p class="body tw-text-white">{{ session()->get('success-message') }}</p>
            </div>
        </div>
    @endif

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

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[30px] tw-mb-3">
        <collection-wrapper
            :limit="{{ $limitOverride ?? 18 }}"
            :pre-loaded-content="{{ $listLessons }}"
            :required-fields="{{ json_encode($requiredFields) }}"
            :statuses="{{ json_encode(['published', 'scheduled']) }}"
            :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
            title="lessons"
        ></collection-wrapper>
    </div>

    @component('partials.bladesora.members.components.coach-footer', [
        'brandName' => '{{ $brand }}',
        'shortBio' => $thisCoach->fetch('data.long_bio'),
        'focusArray' => $thisCoach->fetch('*fields.focus.value', []),
        'firstName' => $firstLastName[0] ?? '',
        'lastName' => $firstLastName[1] ?? '',
        'nameThree' => $firstLastName[2] ?? '',
        'coachId' => $thisCoach->fetch('id'),
        'headShotPicture' => $thisCoach->fetch('data.head_shot_picture_url'),
        'longBio' => $thisCoach->fetch('data.long_bio'),
        'bandsArray' => $thisCoach->fetch('*fields.bands.value'),
        'endorsementsArray' => $thisCoach->fetch('*fields.endorsements.value'),
        ])
    @endcomponent

@endsection

@section('layout-scripts')
    <script type="application/javascript">
        function hideElement(elId) {
            var element = document.getElementById(elId);
            if (!element.classList.contains("tw-hidden")) {
                element.classList.add("tw-hidden");
            }
        }

        function showElement(elId) {
            var element = document.getElementById(elId);
            element.classList.remove("tw-hidden");
        }

        function switchToSubscribedButton() {
            hideElement("subscribeButton");
            showElement("unsubscribeButton");
        };

        function switchToSubscribeButton() {
            hideElement("unsubscribeButton");
            showElement("subscribeButton");
        };

        function successSubscribeToast() {
            var text = 'You will now receive updates when ' +'{{$firstLastName[0]}}'+ ' releases new content!';
            window.shownotification({
                icon: 'fa-bell',
                text
            });
        };

        function successUnsubscribeToast() {
            var text = 'You will no longer receive updates when ' +'{{$firstLastName[0]}}'+ ' releases new content!';
            window.shownotification({
                icon: 'fa-bell-slash',
                text
            });
        };

        function showErrorToast() {
            window.shownotification({
                isError: true
            });
        };

        function subscribeToCoach(coachId, URL) {
            switchToSubscribedButton();

            fetch(URL, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    referrerPolicy: 'no-referrer',
                    body: JSON.stringify({
                        content_id: coachId
                    })
                })
                .then(response => response.json())
                .then(() => {
                    successSubscribeToast();
                })
                .catch((e) => {
                    switchToSubscribeButton();
                    showErrorToast();
                });
        }

        function unsubscribeToCoach(coachId, URL) {
            switchToSubscribeButton();

            fetch(URL, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    referrerPolicy: 'no-referrer',
                    body: JSON.stringify({
                        content_id: coachId
                    })
                })
                .then(() => {
                    successUnsubscribeToast();
                })
                .catch((e) => {
                    switchToSubscribedButton();
                    showErrorToast();
                });
        }
    </script>
@endsection
