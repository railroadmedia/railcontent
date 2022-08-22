@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout')

@section('meta')
    <title>Forums | {{ $brand }}</title>
@endsection

@section('content')

    @component('partials._forum-header-banner',[
        "backgroundImage" => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
        "brand" => $brand,
        "currentUser" =>$user,
        'profileUrl' => user()->getDashboardUrl(),
    ])
        @slot('content')
            <div class="tw-container tw-mx-auto dark:tw-text-white">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <musora-icon icon-name="messages-filled" 
                                    class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                    <span class="tw-text-32 tw-font-bold"><span class="tw-capitalize">{{ $brand }}</span> Forums</span>
                </h1>

                <p class="tw-text-white tw-mb-6 sm:tw-mb-4 tw-max-w-4xl sm:tw-pr-12 tw-text-base">
                    @if($brand === "drumeo")
                        Connect with drummers from around the world! Our forums help you build social connections and find other students that share your goals and passions. 
                    @elseif($brand === "pianote")
                        Connect with piano players from around the world! Our forums help you build social connections and find other students that share your goals and passions. 
                    @elseif($brand === "guitareo")
                        Connect with guitarists from around the world! Our forums help you build social connections and find other students that share your goals and passions.
                    @elseif($brand === "singeo")
                        Connect with singers from around the world! Our forums help you build social connections and find other students that share your goals and passions.
                    @endif
                </p>

                <div class="tw-inline-flex tw-items-center tw-flex-wrap header-buttons">
                    @if($user['access_level'] === 'team')
                        <a href="{{ url()->route('forums.show-create-category-form') }}"
                            class="tw-btn-primary tw-bg-{{ $brand }} sm:tw-mr-2 tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto"
                            dusk="create-post-button">
                            <i class="fas fa-pencil tw-mr-2"></i>
                            <span>Create a Forum</span>
                        </a>
                    @endif

                    <a href="{{ \App\Modules\Brand\Services\BrandService::getForumsUrl() }}"
                        class="tw-btn-secondary sm:tw-mr-2 tw-mb-3 tw-px-16 tw-w-full sm:tw-w-auto tw-text-white">
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
