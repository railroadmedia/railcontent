@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $headerData = [
        'type' => 'forums',
        'title' => $brand . ' Forums',
        'description' => null,
        'iconName' => 'messages',
        'ctas' => null
    ];
    if ($brand === 'drumeo') {
        $headerData['description'] = "Connect with drummers from around the world! Our forums help you build social connections and find other students that share your goals and passions.";
    } elseif ($brand === 'pianote') {
        $headerData['description'] = "Connect with piano players from around the world! Our forums help you build social connections and find other students that share your goals and passions.";
    } elseif ($brand === 'guitareo') {
        $headerData['description'] = "Connect with guitarists from around the world! Our forums help you build social connections and find other students that share your goals and passions.";
    } elseif ($brand === 'singeo') {
        $headerData['description'] = "Connect with singers from around the world! Our forums help you build social connections and find other students that share your goals and passions.";
    }

    if ($user['access_level'] === 'team') {
        $headerData['ctas'][] = [
            'type' => 'PageHeaderCta',
            'props' => [
                'text' => 'Create a Forum',
                'faIconClass' => 'fas fa-pencil',
                'url' => url()->route('forums.show-create-category-form'),
                'showAllAlways' => true
            ]
        ];
    }
    $headerData['ctas'][] = [
        'type' => 'PageHeaderCta',
        'props' => [
            'text' => 'Musora Community Guidelines',
            'faIconClass' => 'fas fa-clipboard-list',
            'url' => \App\Modules\Brand\Services\BrandService::getForumsUrl(),
            'showAllAlways' => true
        ]
    ];
    $headerDataJson = json_encode($headerData);
    $headerDataObj = json_decode($headerDataJson);

    $breadcrumbs = [
        [
            'title' => 'Forums',
        ]
    ];
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Forums | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8">
        <breadcrumb :breadcrumbs="{{ json_encode($breadcrumbs) }}"></breadcrumb>
        <page-header
            page-type="{{ $headerDataObj->type }}"
            icon-name="{{ $headerDataObj->iconName }}"
            title="{{ $headerDataObj->title }}"
            description="{{ $headerDataObj->description }}"
            :ctas="{{ json_encode($headerDataObj->ctas) }}"
        ></page-header>
    </div>

    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-8 tw-pb-14">
        <div class="tw-flex tw-flex-col tw-my-3">
            <div class="tw-flex tw-flex-row">
                <forum-threads-table
                    theme-color="{{ $brand }}"
                    brand="{{ $brand }}"
                    :only-followed="true"
                    :pinned-threads="{{ json_encode($pinnedThreads) }}"
                    :threads="{{ json_encode($threads) }}"
                    :forums="{{ json_encode($discussions) }}"
                    :thread-count="{{ $threadCount }}"
                    latest-threads-url="{{ url()->route('forums.show-all-latest-threads') }}"
                    search-json-results-endpoint-url="{{ url()->route('forums.get-search-results-json') }}"
                />
            </div>
        </div>
    </div>

@endsection
