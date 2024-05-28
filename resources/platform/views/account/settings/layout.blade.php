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
        'title' => user()->display_name,
        'description' => null,
        'heroImg' => $user->profile_picture_url,
        'heroImgClasses' => 'user-avatar' . ' ' . (in_array($user['access_level'], ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '') . ' ' . $brand . ' ' . $user['access_level'],
        'progress' => null,
        'contentId' => null,
        'infoData' => ['Musora Member Since ' . \Carbon\Carbon::parse(user()->created_at)->format('Y')],
        'ctas' => null
    ];

    $ctaText = $showCompleteYourAccountButton ? 'Complete Your Account' : 'Update Your Account';
    $ctaUrlSuffix = $showCompleteYourAccountButton ? '&update=2' : '';

    $ctaUrl = "/onboarding?brand={$brand}{$ctaUrlSuffix}";

    $headerData['ctas'][] = [
        'type' => 'PageHeaderPrimaryCta',
        'props' => [
            'text' => $ctaText,
            'url' => $ctaUrl,
            'showAllAlways' => true
        ]
    ];

    $headerDataJson = json_encode($headerData);
    $headerDataObj = json_decode($headerDataJson);

    dd(user()->onboardingGear)
@endphp

@extends('partials.layout')

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        {{-- Header --}}
        <breadcrumb
            :breadcrumbs="{{ json_encode([ 
                [
                    "title" => 'Settings',
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


    @if(session()->has('error-message'))
        <div class="form-success-message tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
            <div class="tw-flex tw-flex-col bg-error tw-shadow corners-10 pa">
                <p class="body tw-text-white"><strong>{{ session()->get('error-message') }}</strong></p>
            </div>
        </div>
    @endif

    @if(session()->has('success'))
        <div class="form-success-message tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
            <div class="tw-flex tw-flex-col tw-bg-{{$brand}} tw-shadow corners-10 pa">
                <p class="body tw-text-white">Profile successfully updated!</p>
            </div>
        </div>
    @endif

    @if(session()->has('successes'))
        <div class="form-success-message tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
            <div class="tw-flex tw-flex-col tw-bg-{{$brand}} tw-shadow corners-10 pa">
                @foreach(session()->get('successes')->all() as $message)
                    <p class="body tw-text-white">{{ $message }}</p>
                @endforeach
            </div>
        </div>
    @endif

    @if(session()->has('success-message-unsubscribe'))
        <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-8 tw-pb-14">
            <div class="tw-flex tw-flex-row tw-bg-{{$brand}} tw-text-white tw-shadow corners-10 pa-3">
                <div class="tw-flex tw-flex-col">
                    <h4 class="title tw-mb-3">Membership Canceled</h4>
                    <p class="body tw-mb-2">We're sorry to see you go! Your <span class="tw-capitalize">{{$brand}}</span> membership has been deactivated, and your account will not auto-renew. You can still enjoy Musora until it expires. We exist to help people achieve their musical goals and hope you continue the work to make your dreams happen. If we can help you make the music you want to, we're here to support you whenever you need us.</p>
                </div>
            </div>
        </div>
    @endif

    @if(session()->has('success-message-unsubscribe-contact'))
        <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-8 tw-pb-14">
            <div class="tw-flex tw-flex-row tw-bg-{{$brand}} tw-text-white tw-shadow corners-10 pa-3">
                <div class="tw-flex tw-flex-col">
                    <h4 class="title tw-mb-3">Contact Request Sent.</h4>
                    <p class="body tw-mb-2">Thank you, we'll get in touch with you shortly!</p>
                </div>
            </div>
        </div>
    @endif

    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 tw-pt-8 tw-pb-14">
        <div class="tw-flex tw-flex-row">
            <div class="tw-flex tw-flex-col grow">
                <div class="tw-flex tw-flex-row">
                    <div class="tw-flex tw-flex-col tw-grow tw-w-full">
                        @yield('edit-forms')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

