@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('forums.forumlayout')

@section('meta')
    <title>Create a Forum | {{ $brand }}</title>
@endsection

@section('content')
    <page-container>

        <div v-cloak>

            <div class="container mv-3 forum-post">
                @include('partials.bladesora.members.forums.create-forum', [
                    "brand" => $brand,
                    "forumUrl" => url()->route('forums.index'),
                    "formAction" => url()->route('railforums.discussion.store'),
                    "method" => 'PUT',
                    "topicOptions" => []
                ])
            </div>

        </div>
        
    </page-container>
@endsection
