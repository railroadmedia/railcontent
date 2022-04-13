@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp
@extends('partials.layout')

@section('meta')
    <title>Update Thread | {{ $brand }}</title>
@endsection

@section('content')
    <page-container>

        <div v-cloak>

            <div class="container mv-3 forum-post">
                @include('partials.bladesora.members.forums.update-thread', [
                    "brand" => "{{ $brand }}",
                    "forumUrl" => url()->route('forums.index'),
                    "formAction" => url()->route('railforums.thread.update', [$thread['id']]),
                    "thread" => $thread,
                    "method" => 'PATCH',
                    "topicOptions" => $categories
                ])

                <div class="flex flex-row pa mt-5">
                    <form action="{{ url()->route('railforums.thread.delete', [$thread['id']]) . '?redirect=' . url()->route('forums.index') }}"
                        method="POST"
                        onSubmit="confirm('Are you sure you wish to delete this thread?')"
                        class="flex flex-center pt-5">
                        <input type="hidden" name="_method" value="DELETE">

                        <button class="btn collapse-250 mt-5" type="submit">
                            <span class="bg-error text-white short">
                                Delete Thread
                            </span>
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </page-container>
@endsection
