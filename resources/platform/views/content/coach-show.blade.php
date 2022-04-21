@php
    $firstLastName = preg_split('/\s+/', $thisCoach->fetch('fields.name'));
    $currentUserSubscribed = $thisCoach->fetch('current_user_is_subscribed');
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($thisCoach->fetch('fields.name')) }} | Musora</title>
@endsection

@section('content')
    <page-container>
        <div v-cloak>

            @include('partials.bladesora.members.navigation.breadcrumbs', [
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

            @component('partials.bladesora.members.components.coach-header-banner', [
                'brandName' => '{{ $brand }}',
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
                    <coach-event brand="{{ $brand }}" :preloaded-content='{{ $coachEvent }}' current-date-string="{{ $currentDate }}"
                        subscription-calendar-id="{{ $currentEventCalendarId }}" youtube-event-id="{{ $youtubeId }}"
                        :time-cutoff-minutes="{{ $timeCutoffMinutes }}" event-coach-profile-url="{{ $eventCoachProfileUrl }}">
                    </coach-event>
                </section>
            @endif

            @if (session()->has('success-message'))
                <div class="form-success-message tw-container tw-mx-auto tw-mt-3">
                    <div class="tw-flex tw-flex-col bg-success tw-shadow corners-10 pa">
                        <p class="body tw-text-white">{{ session()->get('success-message') }}</p>
                    </div>
                </div>
            @endif

            @if ($hasFeaturedLessons)
                <div class="tw-container tw-mx-auto tw-mt-2 tw-mb-3">
                    <div class="tw-flex tw-flex-row tw-mb-3">
                        <div class="tw-flex tw-flex-col tw-flex-grow">
                            <div class="tw-flex tw-flex-row align-v-center pv-2">
                                <span class="tw-rounded tw-bg-{{ $brand }} tw-text-white icon-bg-circle body tw-mr-1">
                                    <i class="fas fa-graduation-cap"></i>
                                </span>

                                <h2 class="heading tw-capitalize tw-flex-grow">
                                    Featured Lessons
                                </h2>
                            </div>

                            <div class="tw-flex tw-flex-row six-cards-row">
                                <transition appear name="fade">
                                    <content-catalogue brand="{{ $brand }}" theme-color="{{ $brand }}" :use-theme-color="true"
                                        content-endpoint="/railcontent/content" catalogue-type="coach-grid" limit="16"
                                        :lock-unowned="true" :four-wide="true" :force-wide-thumbs="true"
                                        :pre-loaded-content="{{ $featuredLessons }}">
                                        <div class="tw-flex tw-flex-row nmh-1">
                                            @for ($i = 0; $i < 4; $i++)
                                                @include('partials.bladesora.members.skeletons.card-item', [
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
                    $catalogueProps['fourWide'] = true;
                }
            @endphp

            <div class="tw-container tw-mx-auto tw-mt-3 tw-mb-3">
                <content-catalogue-container brand="{{ $brand }}" :catalogue-props="{{ json_encode($catalogueProps) }}">
                    @for ($i = 0; $i < ($limitOverride ?? 16); $i++)
                        @include('partials.bladesora.members.skeletons.card-item', [
                            "cardClass" => 'four-wide',
                        ])
                    @endfor
                </content-catalogue-container>
            </div>

            @component('partials.bladesora.members.components.coach-subscribe-toasts', [
                'brandName' => '{{ $brand }}',
                'firstName' => $firstLastName[0],
                ])
            @endcomponent

            @component('partials.bladesora.members.components.coach-footer', [
                'brandName' => '{{ $brand }}',
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

        </div>
    </page-container>
@endsection
