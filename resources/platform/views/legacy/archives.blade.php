@extends('partials.layout')

@section('meta')
    <title>Drumeo Archives | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <breadcrumb
            :breadcrumbs="{{ json_encode([ 
                [
                    "title" => "Legacy Resources",
                    "url" => "/drumeo/legacy-resources",
                ],
                [
                    'title' => 'Legacy Archives'
                ]
            ])}}"
        ></breadcrumb>
        <page-header
            page-type="archives"
            title="Legacy Archives"
            icon-name="archives"
            description="Legacy Resources are lessons or tools that are no longer added to or supported. Rather than remove them from the site completely you can access them here."
        ></page-header>

        <div class="tw-flex tw-flex-col tw-py-4">

            <div class="tw-flex tw-flex-row pv-3">
                <h1 class="heading capitalize dark:tw-text-white">Search Archives</h1>
            </div>

            <div class="tw-flex tw-flex-row">
                <content-catalogue
                        content-endpoint="/railcontent/content"
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

