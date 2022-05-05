@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp
@extends('members.forums.forumlayout')

@section('meta')
    <title>All latest threads  | Forums | {{ $brand }}</title>
@endsection

@section('breadcrumbs')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('members.home'),
            ],
            [
                "title" => "Forums",
                "url" => url()->route('forums.index'),
            ],
            [
                "title" => "All latest threads",
            ]
        ]
    ])
@endsection

@section('content')
        <div v-cloak>

            @component('partials._forum-header-banner',[
                        "backgroundImage" => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
                        "brand" => "{{ $brand }}",
                        "currentUser" => $user,
                        'profileUrl' => url()->route('members.profile.dashboard', [auth()->id()]),
            ])
                @slot('content')
                    <div class="tw-inline-flex tw-w-full tw-flex-col sm:tw-pr-4 sm:tw-mt-14">
                        <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                            <a href="/members/forums" class="no-decoration tw-mr-3 back-arrow">
                                <i class="fas fa-arrow-circle-left tw-text-white tw-text-32"></i>
                            </a>

                            <span class="tw-text-32">All Latest Threads</span>
                        </h1>
                        <p class="tw-text-white body tw-mb-6 sm:tw-mb-4 tw-max-w-4xl sm:tw-pr-12">
                            Checkout all the latest threads from all our forums!
                        </p>
                        <div class="tw-inline-flex tw-items-center tw-flex-wrap header-buttons">
                            <a href="{{ url()->route('forums.thread.create') }}"
                            class="tw-btn-primary tw-bg-{{ $brand }} sm:tw-mr-2 tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto"
                            dusk="create-post-button">
                                <i class="fas fa-pencil tw-mr-2"></i> Create Thread
                            </a>
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
                            :show-tabs="false"
                            :threads="{{ json_encode($threads) }}"
                            :thread-count="{{ $threadCount }}"
                        />
                    </div>
                <!-- <p class="font-bold">{{ json_encode($threads) }}</p> -->
                </div>
            </div>

        </div>
@endsection
