@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{$discussion['title']}} | Forums | {{ $brand }}</title>
@endsection

@section('breadcrumbs')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => "Forums",
                "url" => url()->route('forums.show-categories'),
            ],
            [
                "title" => $discussion['title'],
            ]
        ]
    ])
@endsection

@section('content')
        <div v-cloak>

            @component('partials._forum-header-banner',[
                "backgroundImage" => 'https://d3fzm1tzeyr5n3.cloudfront.net/headers/'.$brand.'-header.jpg',
                "brand" => "{{ $brand }}",
                "currentUser" =>$user,
                'profileUrl' => user()->getDashboardUrl(),
            ])
                @slot('content')
                    <div class="tw-inline-flex tw-w-full tw-flex-col sm:tw-pr-4 sm:tw-mt-14">
                        <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                            <a href="/{{ $brand }}/forums" class="no-decoration tw-mr-3 back-arrow">
                                <i class="fas fa-arrow-circle-left tw-text-white tw-text-32"></i>
                            </a>
                            @if($discussion['icon'])
                                <i class="fas {{$discussion['icon']}} tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                            @else
                                <i class="fas fa-comments tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                            @endif
                            <span class="tw-text-32 tw-font-bold">{{$discussion['title']}}</span>
                        </h1>

                        <p class="tw-text-white tw-mb-6 sm:tw-mb-4 tw-max-w-4xl sm:tw-pr-12 tw-text-base">
                            {{$discussion['description']}}
                        </p>

                        <div class="tw-inline-flex tw-items-center tw-flex-wrap header-buttons">
                            <a href="{{ url()->route('forums.show-create-thread-form') }}?thread-title={{$discussion['title']}}"
                            class="tw-btn-primary tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600 sm:tw-mr-2 tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto"
                            dusk="create-post-button">
                                <i class="fas fa-pencil tw-mr-2"></i>
                                Create Thread
                            </a>
                            @if($isAdmin)
                                <a href="{{ url()->route('forums.show-update-category-form', $discussion['id']) }}"
                                class="tw-btn-secondary  tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto tw-text-white"
                                dusk="create-post-button">
                                    <i class="fas fa-pencil tw-mr-2"></i>
                                    Edit Forum
                                </a>
                            @endif
                        </div>
                    </div>
                @endslot
            @endcomponent

            <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[30px]">
                <collection-wrapper
                    collection-type="threads"
                    :pre-loaded-content="{{ $threads }}"
                    :tab-options="{{ json_encode([
                        [ 'key' => 'all', 'value' => 'All Threads' ],
                        [ 'key' => 'followed,1', 'value' => 'Followed' ]
                    ]) }}"
                    :endpoint="'{{ url()->route('railforums.thread.index',['category_id' => $discussion['id']])  }}'"
                    :search-endpoint-url="'{{ url()->route('forums.get-search-results-json') }}'"
                    :sort-options="{{ json_encode([
                        [ 'value' => '-last_post_published_on', 'name' => 'Most recent', 'icon' => 'sort-down' ],
                        [ 'value' => 'last_post_published_on', 'name' => 'Oldest', 'icon' => 'sort-up' ],
                        [ 'value' => 'mine', 'name' => 'My threads', 'icon' => '' ]
                    ]) }}"
                    default-sort="-last_post_published_on"
                ></collection-wrapper>
            </div>

{{--            <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-8 tw-pb-14">--}}
{{--                <div class="tw-flex tw-flex-col">--}}
{{--                    <div class="tw-flex">--}}
{{--                        <forum-threads-table--}}
{{--                            theme-color="{{ $brand }}"--}}
{{--                            brand="{{ $brand }}"--}}
{{--                            :only-followed="false"--}}
{{--                            :pinned-threads="{{ json_encode($pinnedThreads) }}"--}}
{{--                            :threads="{{ json_encode($threads) }}"--}}
{{--                            :thread-count="{{ $threadCount }}"--}}
{{--                            search-json-results-endpoint-url="{{ url()->route('forums.get-search-results-json') }}"--}}
{{--                        />--}}
{{--                    </div>--}}
{{--                <!-- <p class="font-bold">{{ json_encode($threads) }}</p> -->--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
@endsection
