@extends('partials.layout')

@section('meta')
    <title>Lesson History | Musora</title>
@endsection

@section('content')

    <lesson-history
        collection-type="history"
        :pre-loaded-content="{{ $listLessons }}"
        :included-types="{{ json_encode($allowedTypes) }}"
        :hide-search="true"
        :hide-sort-icon="true"
        @if($resetProgress)
            :show-reset-progress="{{ json_encode(true) }}"
        @endif
    ></lesson-history>

{{--                <content-catalogue--}}
{{--                    catalogue-type="list"--}}
{{--                    brand="{{ $brand }}"--}}
{{--                    theme-color="{{ $brand }}"--}}
{{--                    limit="20"--}}
{{--                    :included-types="{{ json_encode($allowedTypes) }}"--}}
{{--                    :use-theme-color="true"--}}
{{--                    :pre-loaded-content="{{ $listLessons }}"--}}
{{--                    user-id="{{ auth()->id() }}"--}}
{{--                    :is-playlists="true"--}}
{{--                    :paginate="true"--}}
{{--                    no-results-message="{{ $noResultsMessage }}"--}}
{{--                    no-results-icon="happy"--}}
{{--                    :destroy-on-list-removal="true"--}}
{{--                    initial-page="{{ $initialPage }}"--}}
{{--                    :force-wide-thumbs="true"--}}
{{--                    :lock-unowned="true"--}}
{{--                    :is-admin="<?php echo e(json_encode(user()->isAdmin())); ?>"--}}
{{--                    @if($resetProgress)--}}
{{--                    :reset-progress="true"--}}
{{--                    @endif--}}
{{--                    :show-loading-animation="true"--}}
{{--                />--}}
@endsection
