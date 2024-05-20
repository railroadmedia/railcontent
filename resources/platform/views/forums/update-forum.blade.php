@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout')

@section('meta')
    <title>Update a Forum | {{ $brand }}</title>
@endsection

@section('content')

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14 forum-post">
        @include('partials.bladesora.members.forums.update-forum', [
            "brand" => "{{ $brand }}",
            "forumUrl" => url()->route('forums.show-categories'),
            "formAction" => url()->route('railforums.discussion.update', $forumId),
            "method" => 'PATCH',
        ])
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <form action="{{ url()->route('railforums.discussion.delete', [$forumId]) . '?redirect=' . url()->route('forums.show-categories') }}"
            method="POST"
            onSubmit="confirm('Are you sure you wish to delete this forum?')"
            class="tw-flex tw-flex-center tw-pt-3 tw-justify-center">
            <input type="hidden" name="_method" value="DELETE">

            <button class="tw-btn-primary tw-bg-red-600 hover:tw-bg-red-800" type="submit">
                Delete Forum
            </button>
        </form>
    </div>

@endsection
