@extends('members.layout')

@section('meta')
    <title>Home | Singeo</title>
@endsection

@section('content')
    @include('members.partials._content-sidebar')

    @if ($isSubscriber)

        <!-- Coach Of The Month -->
        @component('partials.bladesora.members.components.members-index-banner', [
            'coachOfTheMonth' => $coachOfTheMonth,
            'brand' => '{{ $brand }}',
            ])
        @endcomponent

        <!-- Coach Event -->
        @if (!empty($coachEvent))
            <section class="tw-flex tw-py-2 tw-bg-gray-100 tw-mb-6 md:tw-mb-10">
                <coach-event brand="{{ $brand }}" :preloaded-content='{{ $coachEvent }}'
                    current-date-string="{{ $currentDate }}" subscription-calendar-id="{{ $calendarId }}"
                    youtube-event-id="{{ $youtubeId }}" :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
                    event-coach-profile-url="{{ $eventCoachProfileUrl }}" />
                <div style="margin-top: 35px;"></div>
            </section>
        @endif
        @if(session()->has('email-invite-message'))
            <div class="tw-container tw-mx-auto tw-mt-4 tw-mb-4">
                <div class="tw-flex tw-flex-column" style="padding: 20px; background-color: #c7ff9b; border: 1px solid #3fd525">
                    <h3 class="tw-text-black tw-no-underline tw-grow">Your invite was emailed successfully!</h3>
                </div>
            </div>
        @endif

        <div class="tw-container tw-mx-auto tw-mb-24">
            <div class="tw-flex tw-flex-column">
                <!-- Page Links -->
                @component('partials.bladesora.members.components.home._card-links', [
                    'hasStartedMethod' => $hasStartedMethod,
                    'hasCompletedMethod' => $hasCompletedMethod,
                    'completedLevelsUrl' => $completedLevelsUrl,
                    'methodUrl' => !empty($nextLearningPathLesson)?$nextLearningPathLesson->fetch('url'):'/members/learning-paths/singeo-method',
                    'methodTitle' => 'Step-by-step curriculum.',
                    'methodDescription' => "Exclusive curriculum so you'll always know what to work on for maximum results.",
                    'songsTitle' => 'Popular songs in all genres.',
                    'songsDescription' => 'Full transcriptions, loops, and practice tools for music by popular bands of all eras
                    and styles.',
                    'songsUrl' => '/members/songs',
                    'coachCardTitle' => 'Learn with the legends.',
                    'coachCardDescription' => 'Vocal legends sharing their best advice and guiding your singing journey.',
                    'coachCardUrl' => '/members/coaches',
                    'methodBgImg' => 'https://singeo.s3.amazonaws.com/singeoMethodLinkBG.png',
                    'methodIcon' => 'https://singeo.s3.amazonaws.com/SingeoMethodIcon.svg',
                    'nextLearningPathLessonTitle' => !empty($nextLearningPathLesson) ? $nextLearningPathLesson->fetch('fields.title') : '',
                    'nextLearningPathLevel' => $nextLearningPathLevel,
                    'songsBgImg' => 'https://drumeo.s3.amazonaws.com/homepage/songsLinkBG.png',
                    'songsLogo' =>
                    'https://cdn.musora.com/image/fetch/https://dpwjbsxqtam5n.cloudfront.net/logos/SongsLogo.svg',
                    'coachCardBg' => 'https://drumeo.s3.amazonaws.com/homepage/coachesLinkBG.png',
                    'coachCardIcon' =>
                    'https://cdn.musora.com/image/fetch/https://dpwjbsxqtam5n.cloudfront.net/logos/CoachesLogo.svg',
                    'brand' => '{{ $brand }}',
                ])
                @endcomponent

                <!-- Continue Section -->
                @component('partials.bladesora.members.components.home._continue-section', [
                    'hasStartedContent' => !empty($startedContentArray),
                    'continueUrl' => url()->route('members.profile.lists', ['state' => 'started']),
                    'seeAllUrl' => url()->route('members.profile.lists', ['state' => 'started']),
                    'brand' => '{{ $brand }}',
                    'startedContent' => $startedContentJson,
                    'contentEndpoint' => '/laravel/public/railcontent/content',
                ])
                @endcomponent

                <!-- New Section -->
                @component('partials.bladesora.members.components.home._new-section', [
                    'brand' => '{{ $brand }}',
                    'contentEndpoint' => '/laravel/public/railcontent/content',
                    'allLessonsUrl' => url()->route('members.catalogues.all'),
                    'newContent' => $newContent,
                ])
                @endcomponent

                <!-- Popular Conversations from Forums -->
                @component('partials.bladesora.members.components.home._conversations-section', [
                    'brand' => '{{ $brand }}',
                    'forumUrl' => 'https://forums.drumeo.com',
                    'forumPosts' => $forumPosts,
                ])
                @endcomponent

                <!-- Followed Lessons -->
                @component('partials.bladesora.members.components.home._followed-section', [
                    'brand' => '{{ $brand }}',
                    'subscribedLessons' => url()->route('members.lessons.subscribed'),
                    'contentEndpoint' => '/laravel/public/railcontent/content',
                    'followedLessons' => $followedLessons,
                    'hasfollowedLessons' => $hasfollowedLessons,
                ])
                @endcomponent

                <!-- Subscribed Coaches Section -->
                @component('partials.bladesora.members.components.home._coaches-section', [
                    'brand' => '{{ $brand }}',
                    'hasSubscribedCoaches' => $hasSubscribedCoaches,
                    'subscribedCoaches' => $subscribedCoaches,
                    'subscribedCoachesUrl' => '/members/coaches?only_subscribed=true#coach-section',
                    'allCoachesUrl' => '/members/coaches?only_subscribed=true#coach-section"',
                ])
                @endcomponent

                <!-- My List -->
                @component('partials.bladesora.members.components.home._list-section', [
                    'brand' => '{{ $brand }}',
                    'myListUrl' => url()->route('members.profile.lists', ['id' => auth()->id()]),
                    'contentEndpoint' => '/laravel/public/railcontent/content',
                    'usersList' => $usersListContentJson,
                ])
                @endcomponent

                <!-- Upcomming Events -->
                @component('partials.bladesora.members.components.home._upcoming-section', [
                    'brand' => '{{ $brand }}',
                    'upcomingUrl' => url()->route('members.live.show'),
                    'upcomingEvents' => $upcomingEvents,
                    'contentEndpoint' => '/laravel/public/railcontent/content',
                ])
                @endcomponent

                <!-- My Stats -->
                @component('partials.bladesora.members.components.home._stats-section', [
                    'brand' => '{{ $brand }}',
                    'userDashboardUrl' => url()->route('members.profile.dashboard'),
                    'nextLearningPathProgressPercent' => $nextLearningPathProgressPercent,
                    'nextLearningPathLevel' => $nextLearningPathLevel,
                    'userMetrics' => $userMetrics,
                    'methodLogo' =>
                    'https://musora.imgix.net/https%3A%2F%2Fmusora-ui.s3.amazonaws.com%2Flogos%2Fsingeo-method.svg?ixlib=php-1.2.1&q=80&w=540&s=0c1843495a73e9d12870be6aeb30f26f',
                ])
                @endcomponent
            </div>
        </div>

    @elseif($isCourseOnlyOwner)
        @if (!empty($courses))
            <div class="tw-container tw-mx-auto tw-mb-24">
                <div class="tw-flex tw-flex-column">

                    <!-- Continue Section -->
                    @component('partials.bladesora.members.components.home._continue-section', [
                        'hasStartedContent' => !empty($startedContentArray),
                        'continueUrl' => url()->route('members.profile.lists', ['state' => 'started']),
                        'seeAllUrl' => url()->route('members.profile.lists', ['state' => 'started']),
                        'brand' => '{{ $brand }}',
                        'startedContent' => $startedContentJson,
                        'contentEndpoint' => '/laravel/public/railcontent/content',
                        ])
                    @endcomponent

                    @include(
                        'members.partials.content._list',
                        [
                            'sectionLabel' => 'Your Courses',
                            'sectionIconClasses' => 'icon-courses',
                            'sectionUrl' => url()->route('members.catalogues.show', ['lessonType' => 'courses']),
                            'sectionUrlLabel' => 'See All Courses',
                            'preLoadedContent' => $courses
                        ]
                    )

                    <!-- Popular Conversations from Forums -->
                    @component('partials.bladesora.members.components.home._conversations-section', [
                        'brand' => '{{ $brand }}',
                        'forumUrl' => 'https://forums.drumeo.com',
                        'forumPosts' => $forumPosts,
                    ])
                    @endcomponent

                </div>
            </div>
        @endif
    @endif
@endsection
