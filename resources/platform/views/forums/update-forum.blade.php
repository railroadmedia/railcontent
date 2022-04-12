@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('forums.forumlayout')

@section('meta')
    <title>Update a Forum | {{ $brand }}</title>
@endsection

@section('content')
    <page-container>

        <div v-cloak>

            <div class="container mv-3 forum-post">
                @include('partials.bladesora.members.forums.update-forum', [
                    "brand" => "{{ $brand }}",
                    "forumUrl" => url()->route('forums.index'),
                    "formAction" => url()->route('railforums.discussion.update', $forumId),
                    "method" => 'PATCH',
                ])
            </div>

            <div class="flex flex-row pa mt-5">
                <form action="{{ url()->route('railforums.discussion.delete', [$forumId]) . '?redirect=' . url()->route('forums.index') }}"
                    method="POST"
                    onSubmit="confirm('Are you sure you wish to delete this forum?')"
                    class="flex flex-center pt-5">
                    <input type="hidden" name="_method" value="DELETE">

                    <button class="btn collapse-250 mt-5" type="submit">
                            <span class="bg-error text-white short">
                                Delete Forum
                            </span>
                    </button>
                </form>
            </div>

        </div>

    </page-container>
@endsection
