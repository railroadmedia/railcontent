@php
/**
 * @var \Modules\UserManagementSystem\Models\User $user
 */
$hasGear =
    count(
        user()->onboardingGear->filter(function ($item) {
            return $item->brand == brand();
        }),
    ) > 0;
$hasTopics =
    count(
        user()->onboardingTopics->filter(function ($item) {
            return $item->brand == brand();
        }),
    ) > 0;
$hasGenres =
    count(
        user()->onboardingGenres->filter(function ($item) {
            return $item->brand == brand();
        }),
    ) > 0;

$hasExperience = user()->onboardingExperience ? true : false;

$showCompleteYourAccountButton = !$hasGear || !$hasTopics || !$hasGenres || !$hasExperience;
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ $dashboardUser->display_name }} | Musora</title>
@endsection

@section('content')
    @include('partials.bladesora.members.partials._account-header', [
        'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/' . $brand . '-header.jpg',
        'userAvatar' => $dashboardUser->profile_picture_url,
        'userName' => $dashboardUser->display_name,
        'appName' => 'Musora',
        'memberSince' => $dashboardUser->created_at,
        'isCurrentUsersProfile' => $isCurrentUsersProfile,
        'showCompleteYourAccountButton' => $showCompleteYourAccountButton,
    ])

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white dark:tw-text-white tw-pt-8 tw-pb-14">
        <div class="tw-flex tw-flex-col">

            {{-- Dashboard Header --}}
            <div class="tw-flex tw-flex-row tw-border-b tw-border-[#e5e8e8] dark:tw-border-[#223F57] tw-mb-5 md:tw-mb-7">
                <h1 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-mb-4 md:tw-mb-6">
                    {{ $isCurrentUsersProfile ? 'My' : possessivize($dashboardUser->display_name) }} Dashboard
                </h1>
            </div>

            {{-- User Stats --}}
            <section class="tw-flex tw-flex-col tw-mb-5 md:tw-mb-7 tw-text-[#00101D] dark:tw-text-white tw-w-full">
                {{-- Title --}}
                <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                    <h2 class="tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-text-2xl lg:tw-text-3xl tw-leading-none lg:tw-leading-none">My Stats</h2>
                </div>
                {{-- Metrics --}}
                <div class="tw-grid tw-grid-rows-2 xl:tw-grid-rows-1 tw-gap-3 tw-auto-cols-fr tw-grid-flow-col">
                    @foreach ($userMetrics as $userMetric)
                        @include('partials.bladesora.members.components.user-metric', [
                            'themeColor' => $brand,
                            'icon' => $userMetric['icon'],
                            'value' => $userMetric['value'],
                            'label' => $userMetric['label'],
                        ])
                    @endforeach
                </div>
            </section>

            {{-- Completed Lessons --}}
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                @if ($isCurrentUsersProfile)
                    <a href="/{{ $brand }}/lists/completed" dusk="see-all-started"
                        class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                        <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Completed
                            Lessons</h2>
                    </a>
                    <a href="/{{ $brand }}/lists/completed" dusk="see-all-started"
                        class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                        See All
                    </a>
                @endif
            </div>

            {{-- Completed Catalogue --}}
            @if ($isCurrentUsersProfile)
                <div class="tw-flex tw-flex-row pb-3 four-cards-row" dusk="completed-lesson-grid">
                    <content-catalogue brand="{{ $brand }}" theme-color="{{ $brand }}" catalogue-type="grid"
                        limit="4" :force-wide-thumbs="true" :use-theme-color="true"
                        :pre-loaded-content="{{ $completedProgressContents }}"
                        no-results-message="{{ $isCurrentUsersProfile ? 'Any lessons that you complete will show up here.' : 'This member has not completed any lessons yet.' }}"
                        no-results-icon="{{ $isCurrentUsersProfile ? 'happy' : 'disappointed' }}" />
                </div>
            @endif

            {{-- Started Lessons --}}
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                @if ($isCurrentUsersProfile)
                    <a href="/{{ $brand }}/lists/in-progress" dusk="see-all-started"
                        class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                        <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Started
                            Lessons</h2>
                    </a>
                    <a href="/{{ $brand }}/lists/in-progress" dusk="see-all-started"
                        class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                        See All
                    </a>
                @endif
            </div>
            {{-- Started Catalogue --}}

            @if ($isCurrentUsersProfile)
                <div class="tw-flex tw-flex-row tw-pb-3 four-cards-row" dusk="started-lesson-grid">
                    <content-catalogue brand="{{ $brand }}" theme-color="{{ $brand }}" catalogue-type="grid"
                        limit="4" :force-wide-thumbs="true" :use-theme-color="true"
                        :pre-loaded-content="{{ $startedProgressContents }}"
                        no-results-message="{{ $isCurrentUsersProfile ? 'Any lessons that you start will show up here.' : 'This member has not started any lessons yet.' }}"
                        no-results-icon="{{ $isCurrentUsersProfile ? 'happy' : 'disappointed' }}" />
                </div>
            @endif

            {{-- About You --}}
            <section id="editForm" class="tw-flex tw-flex-row tw-flex-wrap tw-pt-[24px]" dusk="about-user">
                <div class="tw-flex tw-flex-col xl:tw-flex-row tw-justify-between tw-mb-3 tw-w-full">
                    {{-- User Details --}}
                    <div class="tw-flex tw-flex-col tw-mb-4 tw-mr-[36px] lg:tw-max-w-[50%]">
                        <h1
                            class="tw-font-bold tw-text-[24px] tw-leading-none tw-mb-[19px]">
                            About {{ $isCurrentUsersProfile ? 'You' : $dashboardUser->display_name }}
                        </h1>

                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[12px]">
                            <span class="tw-font-bold">Full Name:&nbsp;</span>
                            <span>{{ $dashboardUser->first_name }}&nbsp;{{ $dashboardUser->last_name }}</span>
                        </div>

                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[25px]">
                            <span class="tw-font-bold">Birthday:&nbsp;</span>
                            <span>{{ $dashboardUser->birthday }}</span>
                        </div>

                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[25px]">
                            <p class="body">{!! nl2br($dashboardUser->biography) !!}</p>
                        </div>
                    </div>
                    {{-- User Gear Details --}}
                    <gear-carousel :gear-info="{{ json_encode($dashboardUser) }}" />
                </div>
                @if ($isCurrentUsersProfile)
                    <a href="{{ url()->route('platform.profile.settings.profile', [brand(), $dashboardUser->id]) }}"
                        class="tw-btn-primary tw-bg-{{ $brand }} tw-w-[330px] tw-text-lg" dusk="edit-user">
                        Edit
                    </a>
                @endif
            </section>
        </div>
    </div>
@endsection
