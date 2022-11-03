@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('partials.layout')

@section('meta')
    <title>Update Thread | {{ $brand }}</title>
@endsection

@section('content')

    <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14 forum-post">
        @include('partials.bladesora.members.forums.update-thread', [
            "brand" => "{{ $brand }}",
            "forumUrl" => url()->route('forums.show-categories'),
            "formAction" => url()->route('railforums.thread.update', [$thread['id']]),
            "thread" => $thread,
            "method" => 'PATCH',
            "topicOptions" => $categories
        ])

        <div class="tw-flex tw-flex-row pa tw-w-full">
            <form action="{{ url()->route('railforums.thread.delete', [$thread['id']]) . '?redirect=' . url()->route('forums.show-categories') }}"
                method="POST"
                onSubmit="confirm('Are you sure you wish to delete this thread?')"
                class="tw-flex tw-items-center tw-pt-5 tw-w-full">
                <input type="hidden" name="_method" value="DELETE">

                <button class="tw-btn-primary tw-bg-red-500 hover:tw-bg-red-800 tw-w-full sm:tw-w-auto" type="submit">
                    Delete Thread
                </button>
            </form>
        </div>
    </div>

@endsection
