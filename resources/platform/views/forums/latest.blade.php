@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp
@extends('members.forums.forumlayout')

@section('meta')
    <title>All latest threads  | Forums | Singeo</title>
@endsection

@section('styles')
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ mix('tailwindcss/tailwind.css') }}">
@endsection

@section('inject-components')
    <script src="{{ mix('assets/members/js/forum.js') }}"></script>
@endsection

@section('breadcrumbs')
    @include('bladesora::members.navigation.breadcrumbs', [
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
    @include('members.partials._content-sidebar')

    @component('members.partials._forum-header-banner',[
     "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
     "brand" => "singeo",
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
                <p class="text-white body tw-mb-6 sm:tw-mb-4 tw-max-w-4xl sm:tw-pr-12">
                    Checkout all the latest threads from all our forums!
                </p>
                <div class="tw-inline-flex align-v-center flex-wrap header-buttons">
                    <a href="{{ url()->route('forums.thread.create') }}"
                       class="tw-btn-primary tw-bg-singeo sm:tw-mr-2 tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto"
                       dusk="create-post-button">
                        <i class="fas fa-pencil tw-mr-2"></i> Create Thread
                    </a>
                </div>
            </div>
        @endslot
    @endcomponent

    <div class="container tw-px-4 tw-pt-8 tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex">
                <forum-threads-table
                        theme-color="singeo"
                        brand="singeo"
                        :only-followed="false"
                        :show-tabs="false"
                        :threads="{{ json_encode($threads) }}"
                        :thread-count="{{ $threadCount }}"
                />
            </div>
        <!-- <p class="font-bold">{{ json_encode($threads) }}</p> -->
        </div>
    </div>
@endsection
