@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout')

@section('meta')
    <title>Create a Forum | {{ $brand }}</title>
@endsection

@section('content')

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14 forum-post">
        @include('partials.bladesora.members.forums.create-forum', [
            "brand" => $brand,
            "forumUrl" => url()->route('forums.show-categories'),
            "formAction" => url()->route('railforums.discussion.store'),
            "method" => 'PUT',
            "topicOptions" => []
        ])
    </div>

@endsection
