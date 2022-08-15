@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Archives | Drumeo</title>
@endsection

@section('content')
    @include('members.partials._drumeo-sidebar')

    <header id="pageHeader" class="container fluid pv-4" style="background-image:url({{ cdn('headers/members-header-background-image.jpg') }});">
        <div class="container text-center">
            <h1 class="heading text-white mb-2">
                <i class="icon-legacy text-drumeo"></i> Lesson Archives
            </h1>
            <p class="body text-white">Legacy Resources are lessons or tools that are no longer added to or supported.</p>
            <p class="body text-white">Rather than remove them from the site completely you can access them here.</p>
        </div>
    </header>

    <div class="container mv-3">
        <div class="flex flex-column">

            <div class="flex flex-row pv-3">
                <h1 class="heading capitalize">Search Archives</h1>
            </div>

            <div class="flex flex-row bb-grey-1-1">
                <content-catalogue
                        content-endpoint="/laravel/public/railcontent/content"
                        catalogue-type="list"
                        limit="20"
                        theme-color="drumeo"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $lessons }}"
                        user-id="{{ auth()->id() }}"
                        :search-bar="true"
                        :use-url-params="true"
                        :paginate="true"
                        :statuses="['archived']"
                        total-results="{{ $totalResults }}"
                        :show-loading-animation="true"></content-catalogue>
            </div>
        </div>
    </div>
@endsection

