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

$hasGoals= user()->onboardingGoals ? true : false;

$showCompleteYourAccountButton = !$hasGear || !$hasTopics || !$hasGenres || !$hasExperience || !$hasGoals;

    $headerData = [
        'title' => $dashboardUser->display_name,
        'description' => null,
        'heroImg' => $dashboardUser->profile_picture_url,
        'heroImgClasses' => 'user-avatar' . ' ' . (in_array($currentUser['access_level'], ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '') . ' ' . $brand . ' ' . $currentUser['access_level'],
        'progress' => null,
        'contentId' => null,
        'infoData' => ['Musora Member Since ' . \Carbon\Carbon::parse($dashboardUser->created_at)->format('Y')],
        'ctas' => null
    ];

    if (!empty($currentUser['avatar'])) {
        $headerData['heroImg'] = $currentUser['avatar'];
    }

    $ctaText = $showCompleteYourAccountButton ? 'Complete Your Account' : 'Update Your Account';
    $ctaUrlSuffix = $showCompleteYourAccountButton ? '&update=2' : '';

    $ctaUrl = "/onboarding?brand={$brand}{$ctaUrlSuffix}";

    $headerData['ctas'][] = [
        'type' => 'PageHeaderPrimaryCta',
        'props' => [
            'text' => $ctaText,
            'url' => $ctaUrl,
            'showAllAlways' => true,
            'isPrimary' => true,
        ]
    ];

    $headerDataJson = json_encode($headerData);
    $headerDataObj = json_decode($headerDataJson);

@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ $dashboardUser->display_name }} | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        {{-- Header --}}
        <breadcrumb
            :breadcrumbs="{{ json_encode([ 
                [
                    "title" => "Dashboard",
                ]
            ])}}"
        ></breadcrumb>
        <page-header
            page-type="dashboard"
            title="{{ $headerDataObj->title }}"
            description="{{ $headerDataObj->description }}"
            hero-img="{{ $headerDataObj->heroImg }}"
            hero-img-classes="{{ $headerDataObj->heroImgClasses ?? '' }}"
            content-id="{{ $headerDataObj->contentId }}"
            :info-data="{{ json_encode($headerDataObj->infoData) }}"
            :ctas="{{ json_encode($headerDataObj->ctas) }}"
        ></page-header>
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-8 tw-pb-14">
        <div class="tw-flex tw-flex-col">

            {{-- Dashboard Header --}}
            <div class="tw-flex tw-flex-row tw-border-b tw-border-[#e5e8e8] dark:tw-border-[#223F57] tw-mb-5 md:tw-mb-7">
                <h1 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-mb-4 md:tw-mb-6">
                    {{ $isCurrentUsersProfile ? 'My' : possessivize($dashboardUser->display_name) }} Dashboard
                </h1>
            </div>

            {{-- User Stats --}}
            <section class="tw-flex tw-flex-col tw-mb-5 md:tw-mb-10 tw-text-[#00101D] dark:tw-text-white tw-w-full">
                {{-- Title --}}
                <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                    <h2 class="tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-text-2xl lg:tw-text-3xl tw-leading-none lg:tw-leading-none">My Stats</h2>
                </div>

                <!-- Method Progress -->
                <div class="tw-flex tw-flex-col lg:tw-flex-row tw-justify-center tw-items-center tw-mb-5 tw-w-full tw-rounded-full tw-min-h-[150px] lg:tw-pr-6 tw-bg-gradient-to-b tw-from-{{ $brand }} tw-to-{{ $brand }}-700">
                    <div class="tw-flex tw-items-center tw-justify-center tw-px-8 tw-w-full lg:tw-w-7/12">
                        <img src="https://d38h3dn806jqj1.cloudfront.net/logos/{{ $brand }}-method.svg" alt="brand" class="tw-max-w-[200px] lg:tw-max-w-[567px] tw-w-full tw-mb-4 lg:tw-mb-0" />
                    </div>
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-px-10 sm:tw-px-8 tw-w-full lg:tw-w-5/12">
                        <div class="tw-text-center tw-w-full tw-max-w-[287px]">
                            <h3 class="text-white tw-text-4xl xl:tw-text-[54px] tw-font-bold tw-leading-none tw-mb-2 tw-uppercase">Level {{ $nextLearningPathLevel }}</h3>
                            <div class="tw-flex">
                                <!-- progress bar -->
                                <div class="tw-bg-white tw-relative tw-w-full tw-h-[26px] tw-rounded-full tw-border-white tw-border-[3px]">
                                    <div class="tw-absolute tw-h-full tw-rounded-full tw-top-0 tw-left-0 tw-bg-{{ $brand }}" style="width: {{ $nextLearningPathProgressPercent }}%;"></div>
                                </div>
                                <!-- Progress percentage -->
                                <span class="tw-font-bold tw-ml-2 tw-text-sm tw-text-white">{{ $nextLearningPathProgressPercent }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Metrics --}}
                <div class="tw-grid tw-grid-rows-2 xl:tw-grid-rows-1 tw-gap-3 tw-auto-cols-fr tw-grid-flow-col">
                    @foreach ($userMetrics as $userMetric)
                        @include('partials.bladesora.members.components.user-metric', [
                            'index' => $loop->index,
                            'themeColor' => $brand,
                            'icon' => $userMetric['icon'],
                            'value' => $userMetric['value'],
                            'label' => $userMetric['label'],
                        ])
                    @endforeach
                </div>
            </section>

            {{-- Completed Lessons --}}
            @if ($isCurrentUsersProfile && count(json_decode($completedProgressContents)->data) > 0)
                <mini-catalogue-section
                    title="Completed Lessons"
                    see-all-url="/{{ $brand }}/lesson-history/completed"
                    seeAllAriaLabel="See All Completed Lessons"
                    :pre-loaded-content="{{ json_encode(json_decode($completedProgressContents)->data) }}"
                ></mini-catalogue-section>
            @endif

            {{-- Started Lessons --}}
            @if ($isCurrentUsersProfile && count(json_decode($completedProgressContents)->data) > 0)
                <mini-catalogue-section
                    title="Started Lessons"
                    see-all-url="/{{ $brand }}/lesson-history/in-progress"
                    seeAllAriaLabel="See All Started Lessons"
                    :pre-loaded-content="{{ json_encode(json_decode($startedProgressContents)->data) }}"
                ></mini-catalogue-section>
            @endif

            {{-- About You --}}
            <section id="editForm" class="tw-flex tw-flex-row tw-flex-wrap tw-pt-[24px]" dusk="about-user">

                {{-- Header --}}
                <div class="tw-flex tw-flex-row tw-w-full tw-items-center tw-mb-8 tw-flex-wrap">
                    <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-my-2">
                        About {{ $isCurrentUsersProfile ? 'You' : $dashboardUser->display_name }}
                    </h2>
                    @if ($isCurrentUsersProfile)
                        <a href="{{ url()->route('platform.profile.settings.profile', [brand(), $dashboardUser->id]) }}"
                           class="tw-btn-secondary tw-mb-0 tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-lg tw-px-8 tw-ml-auto"
                           dusk="edit-user">
                            Edit
                        </a>
                    @endif
                </div>

                <div class="tw-flex tw-flex-col xl:tw-flex-row tw-mb-3 tw-w-full">
                    {{-- User Details --}}
                    <div class="tw-flex tw-flex-col tw-mb-4 lg:tw-max-w-[50%] tw-mr-auto">
                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[12px]">
                            <span class="tw-font-bold">Full Name:&nbsp;</span>
                            <span>{{ $dashboardUser->first_name }}&nbsp;{{ $dashboardUser->last_name }}</span>
                        </div>

                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[12px]">
                            <span class="tw-font-bold">Birthday:&nbsp;</span>
                            <span>{{ $dashboardUser->birthday }}</span>
                        </div>

                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[24px]">
                            <span class="tw-font-bold">Location:&nbsp;</span>
                            <span>{{ $dashboardUser->country }}</span>
                        </div>

                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[24px]">
                            <p class="body">
                                <span class="tw-font-bold">Bio:&nbsp;</span>
                                {!! nl2br($dashboardUser->biography) !!}
                            </p>
                        </div>
                    </div>
                    {{-- User Gear Details --}}
                    <gear-carousel
                        :gear-info="{{ json_encode($dashboardUser) }}"
                        brand="{{ $brand }}"
                        class="tw-flex-grow-0 xl:tw-ml-[36px]"
                    />
                </div>

            </section>
        </div>
    </div>
@endsection
