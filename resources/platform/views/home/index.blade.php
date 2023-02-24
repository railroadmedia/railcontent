@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@section('content')
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        @if(!$hasGear || !$hasTopics || !$hasGenres || !$hasExperience)
            {{-- On Boarding TriggerBanner --}}
            <trigger-banner brand="{{ $brand }}">
            </trigger-banner>
        @endif

        {{-- Carousel --}}
        <header-carousel
            :preloaded-carousel="{{ $carousel }}"
            brand="{{ $brand }}"
        >
        </header-carousel>

        {{-- Invite Email Message --}}
        @if(session()->has('email-invite-message'))
            <div class="tw-container tw-mx-auto tw-rounded tw-px-4 md:tw-px-8 tw-my-4">
                <div class="tw-flex tw-flex-col tw-p-[20px] tw-bg-[#c7ff9b] tw-border tw-border-[#3fd525]">
                    <h3 class="tw-text-[#00101D] tw-font-bold no-decoration grow">Your invite was emailed successfully!</h3>
                </div>
            </div>
        @endif
        {{-- Access Code Message --}}
        @if(session()->has('access-code-claimed-success') && session()->get('access-code-claimed-success') == true)
            <div class="tw-container tw-mx-auto tw-rounded tw-px-4 md:tw-px-8 tw-my-4">
                <div class="tw-flex tw-flex-col tw-p-[20px] tw-bg-[#eee]">
                    <h3 class="tw-text-[#00101D] tw-font-bold no-decoration grow">Your access code has been claimed successfully!</h3>
                </div>
            </div>
        @endif

        <!-- Home Card Links -->
        <home-card-links
            brand="{{ $brand }}"
            :has-started-method="{{ isset($hasStartedMethod) && $hasStartedMethod ? 'true' : 'false' }}"
            :has-completed-method="{{ isset($hasCompletedMethod) && $hasCompletedMethod ? 'true' : 'false' }}"
            completed-levels-url="{{ $completedLevelsUrl }}"
            method-url="{{ $methodUrl }}"
            next-learning-path-lesson-title="{{ !empty($nextLearningPathLesson) ? $nextLearningPathLesson->fetch('fields.title') : '' }}"
            next-learning-path-level="{{ $nextLearningPathLevel }}"
        ></home-card-links>

        {{-- Continue Section --}}
        @if($startedContentCount > 0)
            @component('partials.bladesora.members.components.home._continue-section', [
                'brand' => brand(),
                'hasStartedContent' => $startedContentCount > 0,
                'contentEndpoint' => '/railcontent/content',
                'continueUrl' => url()->route('platform.lists.in-progress'),
                'seeAllUrl' => url()->route('platform.lists.in-progress'),
                'startedContentJson' => $startedContentJson,
                ])
            @endcomponent
        @endif

        {{-- New Section --}}
        @component('partials.bladesora.members.components.home._new-section', [
            'brand' => brand(),
            'contentEndpoint' => '/railcontent/content',
            'allLessonsUrl' => url()->route('platform.new-lessons'),
            'newContentJson' => $newContentJson,
            ])
        @endcomponent

        {{-- Popular Conversations --}}
        @if(count($hotForumTopics) > 0)
            @component('partials.bladesora.members.components.home._conversations-section', [
                'brand' => brand(),
                'forumUrl' => brand() . '/forums',
                'forumPosts' => $hotForumTopics,
                ])
            @endcomponent
        @endif

        {{-- From Subscribed Coaches --}}
        @if($hasfollowedLessons)
            @component('partials.bladesora.members.components.home._followed-section', [
                'brand' => brand(),
                'subscribedLessons' => '/'.$brand.'/lessons/subscribed', // todo: need url
                'contentEndpoint' => '/railcontent/content',
                'followedLessons' => $followedLessons,
                'hasfollowedLessons' => $hasfollowedLessons,
                ])
            @endcomponent
        @endif

        {{-- Subscribed Coaches --}}
        @component('partials.bladesora.members.components.home._coaches-section', [
            'brand' => brand(),
            'hasSubscribedCoaches' => $hasSubscribedCoaches,
            'subscribedCoaches' => $subscribedCoaches,
            'subscribedCoachesUrl' => route('platform.coaches', ['only_subscribed'=>'true']).'#coach-section',
            'allCoachesUrl' => route('platform.coaches'),
            ])
        @endcomponent

        {{-- My Playlists --}}
        @component('partials.bladesora.members.components.home._list-section', [
            'brand' => brand(),
            'myListUrl' => url()->route('platform.user.playlists',['brand'=>brand()]),
            'usersList' => $usersList,
            ])
        @endcomponent

        {{-- Live Banner --}}
        @if( !empty($coachEvent) )
            <coach-event
                brand="{{ $brand }}"
                class="tw-mb-6"
                :preloaded-content='{{ $coachEvent }}'
                current-date-string="{{ $currentDate }}"
                subscription-calendar-id="{{ $calendarId }}"
                youtube-event-id="{{ $youtubeId }}"
                :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
                event-coach-profile-url="{{ $eventCoachProfileUrl }}"
            ></coach-event>
        @endif

        {{-- Upcoming Events --}}
        @if($hasUpcomingEvents)
            @component('partials.bladesora.members.components.home._upcoming-section', [
                'brand' => brand(),
                'upcomingUrl' => '/'.$brand.'/live', // todo: url
                'upcomingEvents' => $upcomingEvents,
                'contentEndpoint' => '/railcontent/content',
                ])
            @endcomponent
        @endif

        {{-- My Stats --}}
        @if(user()->isAMember())
        	<stats-section
            	brand="{{ $brand }}"
            	account-url="{{ user()->getDashboardUrl() }}"
            	:next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
            	next-learning-path-level="{{ user()->getMethodLevel() }}"
            	:user-metrics="{{ json_encode($userMetrics) }}"
        	></stats-section>
        @endif

    </div>

    @include('partials._railanalytics-brand-tracking-iframe')

@endsection



