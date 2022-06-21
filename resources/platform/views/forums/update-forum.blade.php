@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout')

@section('meta')
    <title>Update a Forum | {{ $brand }}</title>
@endsection

@section('content')

    <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14 forum-post">
        @include('partials.bladesora.members.forums.update-forum', [
            "brand" => "{{ $brand }}",
            "forumUrl" => url()->route('forums.show-categories'),
            "formAction" => url()->route('railforums.discussion.update', $forumId),
            "method" => 'PATCH',
        ])
    </div>

    <div class="tw-flex tw-flex-row pa tw-mt-5">
        <form action="{{ url()->route('railforums.discussion.delete', [$forumId]) . '?redirect=' . url()->route('forums.show-categories') }}"
            method="POST"
            onSubmit="confirm('Are you sure you wish to delete this forum?')"
            class="tw-flex tw-flex-center tw-pt-5">
            <input type="hidden" name="_method" value="DELETE">

            <button class="btn collapse-250 tw-mt-5" type="submit">
                    <span class="bg-error tw-text-white short">
                        Delete Forum
                    </span>
            </button>
        </form>
    </div>

@endsection
