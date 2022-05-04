@extends('partials.layout')

@section('meta')
    <title>Search: {{ $searchTerm }} | Musora</title>
@endsection

@section('layout-styles')
    <style>
        .search-button-col {
            flex: 0 0 50px;
            max-width:50px;
            min-width:50px;
        }
    </style>
@endsection

@section('content')
        <div v-cloak>

            <div class="tw-container tw-mx-auto mv-3">
                <div class="tw-flex tw-flex-col ">

                    <div class="tw-flex tw-flex-row pv-3">
                        <h1 class="heading tw-capitalize">
                            <a href="javascript:history.back()" class="tw-no-underline">
                                <i class="fas fa-arrow-circle-left text-grey-2 tw-mr-1"></i>
                            </a>
                            Search Results
                        </h1>
                    </div>

                    <div class="tw-flex tw-flex-row bb-grey-1-1">
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

        </div>
@endsection
