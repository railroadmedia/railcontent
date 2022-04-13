@extends('partials.layout')

@section('meta')
    <title>{{ $user->getDisplayName() }} | Singeo</title>
@endsection

@section('content')
    <page-container>
        <div v-cloak>

            @include('partials.bladesora.members.partials._account-header', [
                "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
                "userAvatar" => $user->getProfilePictureUrl(),
                "userName" => $user->getDisplayName(),
                "appName" => 'Singeo',
                "memberSince" => $user->getCreatedAt(),
            ])

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
                <div class="tw-flex tw-flex-col">

                    <div class="tw-flex tw-flex-row pv-3 ph {{ $isSubscriber ? 'bb-grey-1-1' : '' }}">
                        <h1 class="heading grow">{{ $isCurrentUsersProfile ? 'My' : possessivize($user->getDisplayName()) }} Dashboard</h1>
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
                            <a href="{{ url()->route('members.profile.lists', ['state' => 'started']) }}"
                                    class="tw-text-black subheading tw-grow tw-no-underline"
                                    dusk="see-all-started">
                                Started Lessons
                            </a>
                            <a href="{{ url()->route('members.profile.lists', ['state' => 'started']) }}"
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
                            no-results-message="{{ $isCurrentUsersProfile ? "Any lessons that you start will show up here. Check out the <a href=\"" . url()->route('members.learning-paths.show', ['singeo-method', 308514]) . "\">Singeo Method</a> to get started." : "This member has not started any lessons yet." }}"
                            no-results-icon="{{ $isCurrentUsersProfile ? 'happy' : 'disappointed' }}"
                        />
                    </div>

                    <div class="tw-flex tw-flex-row pv-3 ph bt-grey-1-1 align-v-center" dusk="completed-lessons">

                        @if($isCurrentUsersProfile)
                            <a href="{{ url()->route('members.profile.lists', ['state' => 'completed']) }}"
                                    class="text-black subheading grow tw-no-underline"
                                    dusk="see-all-completed">
                                Completed
                            </a>
                            <a href="{{ url()->route('members.profile.lists', ['state' => 'completed']) }}"
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
                            no-results-message="{{ $isCurrentUsersProfile ? "Any lessons that you complete will show up here. Check out our <a href=\"" . url()->route('members.learning-paths.index') . "\">Learning Paths</a> to get started." : "This member has not completed any lessons yet." }}"
                            no-results-icon="{{ $isCurrentUsersProfile ? 'happy' : 'disappointed' }}"
                        />
                    </div>

                    <div id="editForm" class="tw-flex tw-flex-row tw-flex-wrap ph bt-grey-1-1" dusk="about-user">
                        <div class="tw-flex tw-flex-column xs-12 tw-mb-3 pv-3">
                            <div class="tw-flex tw-flex-row">
                                <h1 class="subheading grow">About {{ $isCurrentUsersProfile ? 'You' : $user->getDisplayName() }}</h1>

                                @if($isCurrentUsersProfile)
                                    <a href="{{ url()->route('members.profile.settings') }}"
                                    class="tiny text-grey-3 tw-uppercase dense tw-font-bold tw-flex-auto tw-no-underline" dusk="edit-user">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="tw-flex tw-flex-column xs-12 md-7 tw-mb-2 tw-pr-2">
                            @include('partials.bladesora.members.account.partials._text-fields', [
                                "fields" => [
                                    "Name" => !empty($user->getFirstName()) && !empty($user->getFirstName()) ? $user->getFirstName() . ' ' . $user->getLastName() : null,
                                    "Birthday" => !empty($user->getBirthday()) ? \Carbon\Carbon::parse($user->getBirthday())->format('F j, Y') : '',
                                ]
                            ])

                            @if($user->getBiography())
                                <p class="body">{!! nl2br($user->getBiography()) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </page-container>
@endsection
