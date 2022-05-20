@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout')

@section('meta')
    <title>Forums | {{ $brand }}</title>
@endsection

@section('content')

        <div v-cloak>

            @component('partials._forum-header-banner',[
                "backgroundImage" => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
                "brand" => $brand,
                "currentUser" =>$user,
                'profileUrl' => url()->route('members.profile.dashboard', [auth()->id()]),
            ])
                @slot('content')
                    <div class="tw-inline-flex tw-w-full tw-flex-col sm:tw-pr-4 sm:tw-mt-10">
                        <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                            <i class="fas fa-comments tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                            <span class="tw-text-32"><span class="tw-capitalize">{{ $brand }}</span> Forums</span>
                        </h1>

                        <p class="tw-text-white tw-mb-6 sm:tw-mb-4 tw-max-w-4xl sm:tw-pr-12 tw-text-base">
                            The <span class="tw-capitalize">{{ $brand }}</span> Forum is a great place for members and instructors alike to hang out, chat singing,
                            and just get to know each other
                        </p>

                        <div class="tw-inline-flex tw-items-center tw-flex-wrap header-buttons">
                            @if($user['access_level'] === 'team')
                                <a href="{{ url()->route('forums.forum.create') }}"
                                   class="tw-btn-primary tw-bg-{{ $brand }} sm:tw-mr-2 tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto"
                                   dusk="create-post-button">
                                    <i class="fas fa-pencil tw-mr-2"></i>
                                    <span>Create a Forum</span>
                                </a>
                            @endif

                            <a href="/members/forums/platform-update-feedback-discussion/5/forum-rules/3" 
                               class="tw-btn-secondary sm:tw-mr-2 tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto">
                                <i class="fas fa-clipboard-list tw-mr-2"></i> 
                                <span>Forum Rules</span>
                            </a>
                        </div>
                    </div>
                @endslot
            @endcomponent

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
                <div class="tw-flex tw-flex-col tw-my-3">
                    <div class="tw-flex tw-flex-row">
                        <forum-threads-table
                            theme-color="{{ $brand }}"
                            brand="{{ $brand }}"
                            :only-followed="true"
                            latest-threads-url="{{ url()->route('forums.index.latest') }}"
                            :pinned-threads="{{ json_encode($pinnedThreads) }}"
                            :threads="{{ json_encode($threads) }}"
                            :forums="{{ json_encode($discussions) }}"
                            :thread-count="{{ $threadCount }}"
                        />
                    </div>
                </div>
            </div>

        </div>
@endsection
