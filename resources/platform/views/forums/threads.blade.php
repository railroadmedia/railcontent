@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $headerData = [
        'type' => 'forums',
        'title' => $discussion['title'],
        'description' => $discussion['description'],
        'iconName' => $discussion['icon'] ?? 'fa-comments',
        'ctas' => null
    ];

    $headerData['ctas'][] = [
        'type' => 'PageHeaderCta',
        'props' => [
            'text' => 'Create Thread',
            'faIconClass' => 'fa-pencil',
            'url' => url()->route('forums.show-create-thread-form'),
            'showAllAlways' => true
        ]
    ];
    if ($isAdmin) {
        $headerData['ctas'][] = [
            'type' => 'PageHeaderCta',
            'props' => [
                'text' => 'Edit Forum',
                'faIconClass' => 'fa-pencil',
                'url' => url()->route('forums.show-update-category-form', $discussion['id']),
                'showAllAlways' => true
            ]
        ];
    }
    $headerDataJson = json_encode($headerData);
    $headerDataObj = json_decode($headerDataJson);

    $breadcrumbs = [
            [
                "title" => "Forums",
                "url" => url()->route('forums.show-categories'),
            ],
            [
                "title" => $discussion['title'],
            ]
    ];
@endphp

@extends('partials.layout', ['trackingSectionName' => 'forums'])

@section('meta')
    <title>{{$discussion['title']}} | Forums | {{ $brand }}</title>
@endsection

@section('content')
        <div v-cloak>
            <breadcrumb
                :breadcrumbs="{{ json_encode($breadcrumbs) }}"
            ></breadcrumb>
            <page-header
                page-type="{{ $headerDataObj->type }}"
                icon-name="{{ $headerDataObj->iconName }}"
                title="{{ $headerDataObj->title }}"
                description="{{ $headerDataObj->description }}"
                :ctas="{{ json_encode($headerDataObj->ctas) }}"
            ></page-header>

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
                        [ 'value' => 'mine', 'name' => 'My threads', 'icon' => 'my-threads' ]
                    ]) }}"
                    default-sort="-last_post_published_on"
                    :hide-filter-icon="{{ json_encode(true) }}"
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
