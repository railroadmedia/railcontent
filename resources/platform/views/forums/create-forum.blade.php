@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.forums.forumlayout')

@section('meta')
    <title>Create a Forum | Singeo</title>
@endsection

@section('inject-components')
    <script src="{{ mix('assets/members/js/forum.js') }}"></script>
@endsection

@section('content')
    @include('members.partials._content-sidebar')

    <div class="container mv-3 forum-post">
        @include('bladesora::members.forums.create-forum', [
            "brand" => "singeo",
            "forumUrl" => url()->route('forums.index'),
            "formAction" => url()->route('railforums.discussion.store'),
            "method" => 'PUT',
            "topicOptions" => []
        ])
    </div>
@endsection
