@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp
@extends('forums.forumlayout')

@section('meta')
    <title>{{$discussion['title']}} | Forums | {{ $brand }}</title>
@endsection

@section('breadcrumbs')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('home'),
            ],
            [
                "title" => "Forums",
                "url" => url()->route('forums.index'),
            ],
            [
                "title" => $discussion['title'],
            ]
        ]
    ])
@endsection

@section('content')
    <page-container brand="{{ $brand }}">
        <div v-cloak>

            @component('partials._forum-header-banner',[
                "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
                "brand" => "{{ $brand }}",
                "currentUser" =>$user,
                'profileUrl' => url()->route('members.profile.dashboard', [auth()->id()]),
            ])
                @slot('content')
                    <div class="tw-inline-flex tw-w-full tw-flex-col sm:tw-pr-4 sm:tw-mt-14">
                        <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                            <a href="/members/forums" class="no-decoration tw-mr-3 back-arrow">
                                <i class="fas fa-arrow-circle-left tw-text-white tw-text-32"></i>
                            </a>
                            @if($discussion['icon'])
                                <i class="fas {{$discussion['icon']}} tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                            @else
                                <i class="fas fa-comments tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                            @endif
                            <span class="tw-text-32">{{$discussion['title']}}</span>
                        </h1>

                        <p class="tw-text-white tw-mb-6 sm:tw-mb-4 tw-max-w-4xl sm:tw-pr-12 tw-text-base">
                            {{$discussion['description']}}
                        </p>

                        <div class="tw-inline-flex tw-items-center tw-flex-wrap header-buttons">
                            <a href="{{ url()->route('forums.thread.create') }}?thread-title={{$discussion['title']}}"
                            class="tw-btn-primary tw-bg-{{ $brand }} sm:tw-mr-2 tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto"
                            dusk="create-post-button">
                                <i class="fas fa-pencil tw-mr-2"></i> 
                                Create Thread
                            </a>
                            @if($isAdmin)
                                <a href="{{ url()->route('forums.forum.update', $discussion['id']) }}"
                                class="tw-btn-secondary  tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto"
                                dusk="create-post-button">
                                    <i class="fas fa-pencil tw-mr-2"></i> 
                                    Edit Forum
                                </a>
                            @endif
                        </div>
                    </div>
                @endslot
            @endcomponent

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
                <div class="tw-flex tw-flex-col">
                    <div class="tw-flex">
                        <forum-threads-table
                            theme-color="{{ $brand }}"
                            brand="{{ $brand }}"
                            :only-followed="false"
                            :pinned-threads="{{ json_encode($pinnedThreads) }}"
                            :threads="{{ json_encode($threads) }}"
                            :thread-count="{{ $threadCount }}"
                        />
                    </div>
                <!-- <p class="font-bold">{{ json_encode($threads) }}</p> -->
                </div>
            </div>

        </div>
    </page-container>
@endsection
