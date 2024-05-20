@extends('partials.layout')

@section('meta')
    <title> {{ ucfirst($brand) }} Search | {{ $searchTerm }} | Musora</title>
@endsection

@section('content')

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-py-12">
        <div class="tw-flex tw-flex-col ">

            <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-flex tw-items-center">
                    <a href="javascript:history.back()" class="tw-no-underline tw-inline-flex tw-items-center tw-text-[#00101D] dark:tw-text-white">
                        <i class="fas fa-arrow-circle-left tw-text-2xl tw-mr-2"></i>
                    </a>
                    Search Results
                </h1>
            </div>

            <div class="tw-flex tw-flex-row bb-grey-1-1 dark:tw-border-[#223457] ">
                <content-catalogue
                    search-endpoint="/railcontent/search"
                    brand="{{ $brand }}"
                    catalogue-type="list"
                    limit="20"
                    :included-types="{{ $includedTypes }}"
                    :force-wide-thumbs="true"
                    theme-color="{{ $brand }}"
                    :use-theme-color="true"
                    :pre-loaded-content="{{ $lessons }}"
                    user-id="{{ auth()->id() }}"
                    :search-bar="true"
                    sort-override="-score"
                    :use-url-params="true"
                    :paginate="true"
                    total-results="{{ $totalResults }}"
                    :show-loading-animation="true"></content-catalogue>
            </div>
        </div>
    </div>

@endsection
