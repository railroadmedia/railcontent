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
                "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
                "userAvatar" => $user->profile_picture_url,
                "userName" => $user->display_name,
                "appName" => 'Musora',
                "memberSince" => $user->created_at,
            ])

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
                <div class="tw-flex tw-flex-col">

                    <div class="tw-flex tw-flex-row pv-3 ph {{ $isSubscriber ? 'bb-grey-1-1' : '' }}">
                        <h1 class="heading grow">{{ $isCurrentUsersProfile ? 'My' : possessivize($user->display_name) }} Dashboard</h1>
                    </div>

                    @if($isSubscriber)
                        <div class="tw-flex tw-flex-row tw-flex-wrap nmh-1 pv-3">
                            @foreach($userMetrics as $userMetric)
                                <div class="tw-flex tw-flex-column xs-6 sm-3 tw-no-underline">
                                    @include('partials.bladesora.members.components.user-metric', [
                                        "themeColor" => '{{ $brand }}',
                                        "icon" => $userMetric['icon'],
                                        "value" => $userMetric['value'],
                                        "label" => $userMetric['label'],
                                    ])
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="tw-flex tw-flex-row pv-3 ph bt-grey-1-1 tw-items-center" dusk="started-lessons">
                        @if($isCurrentUsersProfile)
                            <a href="{{ '' }}"
                                    class="tw-text-black subheading tw-grow tw-no-underline"
                                    dusk="see-all-started">
                                Started Lessons
                            </a>
                            <a href="{{ '' }}"
                            class="tiny text-grey-3 tw-uppercase dense tw-font-bold tw-flex-auto tw-no-underline"
                            dusk="see-all-started">
                                See All &raquo;
                            </a>
                        @else
                            <h1 class="subheading grow">Started Lessons </h1>
                        @endif
                    </div>
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

                    <div class="tw-flex tw-flex-row pv-3 ph bt-grey-1-1 align-v-center" dusk="completed-lessons">

                        @if($isCurrentUsersProfile)
                            <a href="{{ '' }}"
                                    class="text-black subheading grow tw-no-underline"
                                    dusk="see-all-completed">
                                Completed
                            </a>
                            <a href="{{ '' }}"
                            class="tiny text-grey-3 tw-uppercase dense tw-font-bold tw-flex-auto tw-no-underline"
                            dusk="see-all-completed">
                                See All &raquo;
                            </a>
                        @else
                            <h1 class="subheading grow">Completed Lessons</h1>
                        @endif
                    </div>
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

                    <div id="editForm" class="tw-flex tw-flex-row tw-flex-wrap ph bt-grey-1-1" dusk="about-user">
                        <div class="tw-flex tw-flex-column xs-12 tw-mb-3 pv-3">
                            <div class="tw-flex tw-flex-row">
                                <h1 class="subheading grow">About {{ $isCurrentUsersProfile ? 'You' : $user->display_name }}</h1>

                                @if($isCurrentUsersProfile)
                                    <a href="{{ url()->route('platform.profile.settings.profile', [brand(), $user->id]) }}"
                                    class="tiny text-grey-3 tw-uppercase dense tw-font-bold tw-flex-auto tw-no-underline" dusk="edit-user">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="tw-flex tw-flex-column xs-12 md-7 tw-mb-2 tw-pr-2">
                            @include('partials.bladesora.members.account.partials._text-fields', [
                                "fields" => [
                                    "Name" => !empty($user->first_name) && !empty($user->first_name) ? $user->first_name . ' ' . $user->last_name : null,
                                    "Birthday" => !empty($user->birthday) ? \Carbon\Carbon::parse($user->birthday)->format('F j, Y') : '',
                                ]
                            ])

                            @if($user->biography)
                                <p class="body">{!! nl2br($user->biography) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
