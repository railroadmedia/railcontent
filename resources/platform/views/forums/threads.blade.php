@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout', ['trackingSectionName' => 'forums'])

@section('meta')
    <title>{{$discussion['title']}} | Forums | {{ $brand }}</title>
@endsection

@section('content')
    <forum-threads 
        discussion-title="{{ $discussion['title'] }}"
        discussion-description="{{ $discussion['description'] }}"
        discussion-icon-name="{{ $discussion['icon'] ?? 'fa-comments' }}"
        :show-create-thread-form-url="'{{ url()->route('forums.show-create-thread-form') }}'"
        :is-admin="{{ json_encode($isAdmin) }}"
        :show-categories-url="'{{ url()->route('forums.show-categories') }}'"
        :threads="{{ $threads }}"
        :endpoint-url="'{{ url()->route('railforums.thread.index', ['category_id' => $discussion['id']]) }}'"
        :search-endpoint-url="'{{ url()->route('forums.get-search-results-json') }}'"
        :show-update-category-form-url="'{{ url()->route('forums.show-update-category-form', $discussion['id']) }}'"
    ></forum-threads>
@endsection
