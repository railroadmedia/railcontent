@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp
@extends('partials.layout')

@section('meta')
    <title>Update Thread | {{ $brand }}</title>
@endsection

@section('content')
    <page-container>
        <div v-cloak>

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14 forum-post">
                @include('partials.bladesora.members.forums.update-thread', [
                    "brand" => "{{ $brand }}",
                    "forumUrl" => url()->route('forums.index'),
                    "formAction" => url()->route('railforums.thread.update', [$thread['id']]),
                    "thread" => $thread,
                    "method" => 'PATCH',
                    "topicOptions" => $categories
                ])

                <div class="tw-flex tw-flex-row pa tw-mt-5">
                    <form action="{{ url()->route('railforums.thread.delete', [$thread['id']]) . '?redirect=' . url()->route('forums.index') }}"
                        method="POST"
                        onSubmit="confirm('Are you sure you wish to delete this thread?')"
                        class="tw-flex tw-items-center tw-pt-5">
                        <input type="hidden" name="_method" value="DELETE">

                        <button class="btn collapse-250 tw-mt-5" type="submit">
                            <span class="bg-error tw-text-white short">
                                Delete Thread
                            </span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </page-container>
@endsection
