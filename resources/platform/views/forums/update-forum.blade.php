@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.forums.forumlayout')

@section('meta')
    <title>Update a Forum | Singeo</title>
@endsection

@section('inject-components')
    <script src="{{ mix('assets/members/js/forum.js') }}"></script>
@endsection

@section('content')
    @include('members.partials._content-sidebar')

    <div class="container mv-3 forum-post">
        @include('bladesora::members.forums.update-forum', [
            "brand" => "singeo",
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
@endsection
