@php
/**
 * @var \Modules\UserManagementSystem\Models\User $user
 */
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ $user->display_name }} | Musora</title>
@endsection

@section('content')
        <div v-cloak>

            @include('partials.bladesora.members.partials._account-header', [
                "backgroundImage" => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
                "userAvatar" => $user->profile_picture_url,
                "userName" => $user->display_name,
                "appName" => 'Musora',
                "memberSince" => $user->created_at,
            ])

            <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white dark:tw-text-white tw-pt-8 tw-pb-14">
                <div class="tw-flex tw-flex-col">
                    
                    {{-- Dashboard Header --}}
                    <div class="tw-flex tw-flex-row tw-border-b tw-border-[#e5e8e8] dark:tw-border-[#223F57] tw-mb-5 md:tw-mb-7">
                        <h1 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-mb-4 md:tw-mb-6">
                            {{ $isCurrentUsersProfile ? 'My' : possessivize($user->display_name) }} Dashboard
                        </h1>
                    </div>

                    {{-- User Stats --}}
                    @if($isSubscriber)
                        <section class="tw-flex tw-flex-col tw-mb-5 md:tw-mb-7 tw-text-[#00101D] dark:tw-text-white tw-w-full">
                            {{-- Title --}}
                            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                                <h2 class="tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">My Stats</h2>
                            </div> 
                            {{-- Metrics --}}
                            <div class="tw-grid tw-grid-rows-2 xl:tw-grid-rows-1 tw-gap-3 tw-auto-cols-fr tw-grid-flow-col">
                                @foreach($userMetrics as $userMetric)                                
                                    @include('partials.bladesora.members.components.user-metric', [
                                        "themeColor" => $brand,
                                        "icon" => $userMetric['icon'],
                                        "value" => $userMetric['value'],
                                        "label" => $userMetric['label'],
                                    ])
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- Completed Lessons --}}
                    <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                        @if($isCurrentUsersProfile)
                            <a href="{{ '' }}" 
                                dusk="see-all-started" 
                                class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                            >
                                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Completed Lessons</h2>
                            </a>
                            <a href="{{ '' }}" 
                                dusk="see-all-started"
                                class="tw-tracking-wider tw-text-base tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                            > 
                                See All 
                            </a>
                        @else                  
                            <h2 class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Completed Lessons</h2>
                        @endif
                    </div>
                    {{-- Completed Catalogue --}}
                    <div class="tw-flex tw-flex-row pb-3 four-cards-row" dusk="completed-lesson-grid">
                        <content-catalogue
                            brand="{{ $brand }}"
                            theme-color="{{ $brand }}"
                            catalogue-type="grid"
                            limit="4"
                            :force-wide-thumbs="true"
                            :use-theme-color="true"
                            :pre-loaded-content="{{ $completedProgressContents }}"
                            no-results-message="{{ $isCurrentUsersProfile ? "Any lessons that you complete will show up here." : "This member has not completed any lessons yet." }}"
                            no-results-icon="{{ $isCurrentUsersProfile ? 'happy' : 'disappointed' }}"
                        />
                    </div>

                    {{-- Started Lessons --}}
                    <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                        @if($isCurrentUsersProfile)
                            <a href="{{ '' }}" 
                                dusk="see-all-started" 
                                class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                            >
                                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Started Lessons</h2>
                            </a>
                            <a href="{{ '' }}" 
                                dusk="see-all-started"
                                class="tw-tracking-wider tw-text-base tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                            > 
                                See All 
                            </a>
                        @else                  
                            <h2 class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Started Lessons</h2>
                        @endif
                    </div>
                    {{-- Started Catalogue --}}
                    <div class="tw-flex tw-flex-row tw-pb-3 four-cards-row" dusk="started-lesson-grid">
                        <content-catalogue
                            brand="{{ $brand }}"
                            theme-color="{{ $brand }}"
                            catalogue-type="grid"
                            limit="4"
                            :force-wide-thumbs="true"
                            :use-theme-color="true"
                            :pre-loaded-content="{{ $startedProgressContents }}"
                            no-results-message="{{ $isCurrentUsersProfile ? "Any lessons that you start will show up here." : "This member has not started any lessons yet." }}"
                            no-results-icon="{{ $isCurrentUsersProfile ? 'happy' : 'disappointed' }}"
                        />
                    </div>

                    {{-- About You --}}
                    <section id="editForm" class="tw-flex tw-flex-row tw-flex-wrap ph" dusk="about-user">
                        <div class="tw-flex tw-flex-column xs-12 tw-mb-3">
                            {{-- Title --}}
                            <div class="tw-flex tw-flex-col tw-mb-4">
                                <h1 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-mb-4 md:tw-mb-6">
                                    About {{ $isCurrentUsersProfile ? 'You' : $user->display_name }}
                                </h1>

                                @if($isCurrentUsersProfile)
                                    <a href="{{ url()->route('platform.profile.settings.profile', [brand(), $user->id]) }}"
                                        class="tw-btn-primary tw-bg-{{ $brand }} tw-w-[330px] tw-text-lg tw-tracking-wide" 
                                        dusk="edit-user">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </section>

                </div>
            </div>

        </div>
@endsection
