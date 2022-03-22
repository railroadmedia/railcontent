@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Search: {{ $searchTerm }} | Singeo</title>
@endsection

@section('styles')
    <style>
        .search-button-col {
            flex: 0 0 50px;
            max-width:50px;
            min-width:50px;
        }
    </style>
@endsection

@section('scripts')

@endsection

@section('content')
    @include('members.partials._content-sidebar')

    <div class="container mv-3">
        <div class="flex flex-column ">

            <div class="flex flex-row pv-3">
                <h1 class="heading capitalize">
                    <a href="javascript:history.back()" class="no-decoration">
                        <i class="fas fa-arrow-circle-left text-grey-2 mr-1"></i>
                    </a>
                    Search Results
                </h1>
            </div>

            <div class="flex flex-row bb-grey-1-1">
                <content-catalogue
                        search-endpoint="/railcontent/search"
                        brand="singeo"
                        catalogue-type="list"
                        limit="20"
                        :included-types="{{ $includedTypes }}"
                        :force-wide-thumbs="true"
                        theme-color="singeo"
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
