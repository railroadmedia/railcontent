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

@section('content')

    <div
        id="pageHeader"
        class="fluid tw-py-8 tw-relative tw-bg-cover tw-bg-top tw-bg-no-repeat tw-bg-black"
        dusk="profile-header"
    >
        {{-- Background Image --}}
        <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top">
            <img src="https://musora.com/cdn-cgi/image/width=1000,quality=90/https://musora-web-platform.s3.amazonaws.com/headers/unified_header.jpg" 
                class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
                onload="this.classList.remove('tw-opacity-0')"
            >
        </div>
        {{-- Background Gradient --}}
        <div class="header-gradient-overlay absolute-fill"></div>
    
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 account-header tw-flex tw-flex-col tw-items-center lg:tw-items-end xl:tw-items-center lg:tw-flex-row dark:tw-text-white tw-relative tw-z-10 ">
            
            {{-- Avatar Image --}}
            <div class="header-avatar tw-flex tw-flex-col tw-mb-4 lg:tw-mb-0">
                <div class="user-avatar
                    {{ in_array($user->access_level, ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']) ? 'subscriber' : '' }}
                    {{ $brand }}
                    {{ $user->access_level }}"
                >
                    <div class="no-decoration tw-bg-cover tw-bg-top tw-inline-block tw-rounded-full tw-h-[165px] tw-w-[165px]">
                        @if($user->profile_picture_url)
                            <img class="tw-inline-block tw-rounded-full tw-h-full" 
                                 src="{{ $user->profile_picture_url }}"
                            >
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="tw-flex tw-flex-col xl:tw-flex-row tw-w-full tw-justify-end xl:tw-items-center tw-pl-6">
                {{-- Account Header --}}
                <div class="tw-flex tw-w-full tw-items-center">
                    <div class="tw-flex tw-flex-col tw-w-full tw-items-center lg:tw-items-start tw-mb-4">
                        <h2 class="tw-font-bold tw-text-[36px] tw-leading-none lg:tw-leading-none tw-text-white lg:tw-text-3xl tw-mb-1">
                            @if(!empty($countryCode))
                                <span class="flag flag-{{ strtolower($countryCode) }}"></span>
                            @endif
                            {{ user()->display_name }}
                        </h2>
                        <p class="tw-text-white tw-uppercase tw-font-extralight tw-font-bebas-neue tw-text-[28px]">
                            Musora Member Since {{ \Carbon\Carbon::parse( user()->created_at)->format('Y') }}
                        </p>
                    </div>
                </div>
    
                {{-- Calls To Action --}}
                <div class="tw-flex tw-items-center tw-justify-center lg:tw-justify-start xl:tw-justify-end tw-w-full tw-flex-wrap xl:tw-flex-nowrap">
                    {{-- Complete Your Account / Update Your Account --}}
                    <a href="/onboarding" 
                        class="tw-btn-secondary tw-border-2 tw-text-white tw-w-auto tw-inline-flex tw-max-w-[267px] tw-mx-2"
                    >
                        {{ $showCompleteYourAccountButton ? 'Complete Your Account' : 'Update Your Account' }}
                    </a>
                </div>

            </div>
    
        </div>
    </div>

    @if(session()->has('error-message'))
        <div class="form-success-message tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
            <div class="tw-flex tw-flex-col bg-error tw-shadow corners-10 pa">
                <p class="body tw-text-white"><strong>{{ session()->get('error-message') }}</strong></p>
            </div>
        </div>
    @endif

    @if(session()->has('success'))
        <div class="form-success-message tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
            <div class="tw-flex tw-flex-col tw-bg-{{$brand}} tw-shadow corners-10 pa">
                <p class="body tw-text-white">Profile successfully updated!</p>
            </div>
        </div>
    @endif

    @if(session()->has('successes'))
        <div class="form-success-message tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
            <div class="tw-flex tw-flex-col tw-bg-{{$brand}} tw-shadow corners-10 pa">
                @foreach(session()->get('successes')->all() as $message)
                    <p class="body tw-text-white">{{ $message }}</p>
                @endforeach
            </div>
        </div>
    @endif

    @if(session()->has('success-message-unsubscribe'))
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-8 tw-pb-14">
            <div class="tw-flex tw-flex-row tw-bg-{{$brand}} tw-text-white tw-shadow corners-10 pa-3">
                <div class="tw-flex tw-flex-col">
                    <h4 class="title tw-mb-3">Membership Canceled</h4>
                    <p class="body tw-mb-2">We're sorry to see you go! Your <span class="tw-capitalize">{{$brand}}</span> membership has been deactivated, and your account will not auto-renew. You can still enjoy Musora until it expires. We exist to help people achieve their musical goals and hope you continue the work to make your dreams happen. If we can help you make the music you want to, we're here to support you whenever you need us.</p>
                </div>
            </div>
        </div>
    @endif

    @if(session()->has('success-message-unsubscribe-contact'))
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-8 tw-pb-14">
            <div class="tw-flex tw-flex-row tw-bg-{{$brand}} tw-text-white tw-shadow corners-10 pa-3">
                <div class="tw-flex tw-flex-col">
                    <h4 class="title tw-mb-3">Contact Request Sent.</h4>
                    <p class="body tw-mb-2">Thank you, we'll get in touch with you shortly!</p>
                </div>
            </div>
        </div>
    @endif

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-pt-8 tw-pb-14">
        <div class="tw-flex tw-flex-row">
            <div class="tw-flex tw-flex-col grow">
                <div class="tw-flex tw-flex-row tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    @foreach($sections as $index => $section)
                        <a href="{{ $section['url'] }}" class="tw-z-10 tw-mb-[-2px] tw-w-full tw-flex tw-flex-row tw-items-center tw-justify-center tw-font-bebas-neue tw-pb-2 ph-1 tw-mr-2 tw-transition tw-no-underline hover:tw-text-[#00101D] dark:hover:tw-text-white
                            {{ $section['active'] ? 'tw-border-b-2 tw-border-black dark:tw-border-white tw-text-[#00101D] dark:tw-text-white' : 'visited:tw-text-gray-400 tw-text-gray-400 dark:tw-text-[#80A0B9]' }}">
                            <i class="tw-text-lg {{ $section['icon'] }}"></i>
                            <span class="hide-xs-only tw-ml-2 tw-text-lg xl:tw-text-xl tw-leading-none">{{ $section['title'] }}</span>
                        </a>
                    @endforeach
                </div>
                <div class="tw-flex tw-flex-row">
                    <div class="tw-flex tw-flex-col tw-grow tw-w-full">
                        @yield('edit-forms')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
