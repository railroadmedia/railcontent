@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>{{ $user->getDisplayName() }} | Singeo</title>
@endsection

@section('styles')
@endsection

@section('scripts')

@endsection

@section('content')
    @include('members.partials._content-sidebar')

    @include('bladesora::members.partials._account-header', [
        "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
        "userAvatar" => $user->getProfilePictureUrl(),
        "userName" => $user->getDisplayName(),
        "appName" => 'Singeo',
        "memberSince" => $user->getCreatedAt(),
    ])

    <div class="container mv-3">
        <div class="flex flex-column">

            <div class="flex flex-row pv-3 ph {{ $isSubscriber ? 'bb-grey-1-1' : '' }}">
                <h1 class="heading grow">{{ $isCurrentUsersProfile ? 'My' : possessivize($user->getDisplayName()) }} Dashboard</h1>
            </div>

            @if($isSubscriber)
                <div class="flex flex-row flex-wrap nmh-1 pv-3">
                    @foreach($userMetrics as $userMetric)
                        <div class="flex flex-column xs-6 sm-3 no-decoration">
                            @include('bladesora::members.components.user-metric', [
                                "themeColor" => 'singeo',
                                "icon" => $userMetric['icon'],
                                "value" => $userMetric['value'],
                                "label" => $userMetric['label'],
                            ])
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="flex flex-row pv-3 ph bt-grey-1-1 align-v-center" dusk="started-lessons">
                @if($isCurrentUsersProfile)
                    <a href="{{ url()->route('members.profile.lists', ['state' => 'started']) }}"
                            class="text-black subheading grow no-decoration"
                            dusk="see-all-started">
                        Started Lessons
                    </a>
                    <a href="{{ url()->route('members.profile.lists', ['state' => 'started']) }}"
                       class="tiny text-grey-3 uppercase dense font-bold flex-auto no-decoration"
                    dusk="see-all-started">
                        See All &raquo;
                    </a>
                @else
                    <h1 class="subheading grow">Started Lessons </h1>
                @endif
            </div>
            <div class="flex flex-row pb-3 four-cards-row" dusk="started-lesson-grid">
                <content-catalogue
                        brand="singeo"
                        theme-color="singeo"
                        catalogue-type="grid"
                        limit="4"
                        :force-wide-thumbs="true"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $startedProgressContents }}"
                        no-results-message="{{ $isCurrentUsersProfile ? "Any lessons that you start will show up here. Check out the <a href=\"" . url()->route('members.learning-paths.show', ['singeo-method', 308514]) . "\">Singeo Method</a> to get started." : "This member has not started any lessons yet." }}"
                        no-results-icon="{{ $isCurrentUsersProfile ? 'happy' : 'disappointed' }}"></content-catalogue>
            </div>

            <div class="flex flex-row pv-3 ph bt-grey-1-1 align-v-center" dusk="completed-lessons">

                @if($isCurrentUsersProfile)
                    <a href="{{ url()->route('members.profile.lists', ['state' => 'completed']) }}"
                            class="text-black subheading grow no-decoration"
                            dusk="see-all-completed">
                        Completed
                    </a>
                    <a href="{{ url()->route('members.profile.lists', ['state' => 'completed']) }}"
                       class="tiny text-grey-3 uppercase dense font-bold flex-auto no-decoration"
                       dusk="see-all-completed">
                        See All &raquo;
                    </a>
                @else
                    <h1 class="subheading grow">Completed Lessons</h1>
                @endif
            </div>
            <div class="flex flex-row pb-3 four-cards-row" dusk="completed-lesson-grid">
                <content-catalogue
                        brand="singeo"
                        theme-color="singeo"
                        catalogue-type="grid"
                        limit="4"
                        :force-wide-thumbs="true"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $completedProgressContents }}"
                        no-results-message="{{ $isCurrentUsersProfile ? "Any lessons that you complete will show up here. Check out our <a href=\"" . url()->route('members.learning-paths.index') . "\">Learning Paths</a> to get started." : "This member has not completed any lessons yet." }}"
                        no-results-icon="{{ $isCurrentUsersProfile ? 'happy' : 'disappointed' }}"></content-catalogue>
            </div>

            <div id="editForm" class="flex flex-row flex-wrap ph bt-grey-1-1" dusk="about-user">
                <div class="flex flex-column xs-12 mb-3 pv-3">
                    <div class="flex flex-row">
                        <h1 class="subheading grow">About {{ $isCurrentUsersProfile ? 'You' : $user->getDisplayName() }}</h1>

                        @if($isCurrentUsersProfile)
                            <a href="{{ url()->route('members.profile.settings') }}"
                               class="tiny text-grey-3 uppercase dense font-bold flex-auto no-decoration" dusk="edit-user">
                                Edit
                            </a>
                        @endif
                    </div>
                </div>
                <div class="flex flex-column xs-12 md-7 mb-2 pr-2">
                    @include('bladesora::members.account.partials._text-fields', [
                        "fields" => [
                            "Name" => !empty($user->getFirstName()) && !empty($user->getFirstName()) ? $user->getFirstName() . ' ' . $user->getLastName() : null,
                            "Birthday" => !empty($user->getBirthday()) ? \Carbon\Carbon::parse($user->getBirthday())->format('F j, Y') : '',
                        ]
                    ])

                    @if($user->getBiography())
                        <p class="body">{!! nl2br($user->getBiography()) !!}</p>
                    @endif
                </div>

{{--                <div id="gearImageModal" class="modal">--}}
{{--                    <div class="flex flex-column pa bg-white shadow corners-10">--}}
{{--                        <img src="{{ $user->getPianoGearPhoto() }}" alt="" style="width:100%;height:auto;">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="flex flex-column xs-12 md-5 mb-2">--}}
{{--                    @if(!empty($user->getPianoGearPhoto()))--}}
{{--                        <div class="mb-2 widescreen bg-center corners-10 pointer"--}}
{{--                             data-open-modal="gearImageModal"--}}
{{--                             style="background-image:url({{ $user->getPianoGearPhoto() }})">--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    @include('bladesora::members.account.partials._text-fields', [--}}
{{--                        "fields" => [--}}
{{--                            "Played Piano Since" => $user->getPianoPlayingSinceYear(),--}}
{{--                            "Piano" => $user->getPianoGearPianoBrands(),--}}
{{--                            "Keyboard" => $user->getPianoGearKeyboardBrands(),--}}
{{--                        ]--}}
{{--                    ])--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
