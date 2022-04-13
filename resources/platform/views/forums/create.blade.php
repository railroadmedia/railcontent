@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('forums.forumlayout')

@section('meta')
    <title>Create a Discussion | {{ $brand }}</title>
@endsection

@section('content')
    <page-conatiner>

        <div v-cloak>

            <div class="container mv-3 forum-post">
                @include('partials.bladesora.members.forums.create-thread', [
                    "brand" => $brand,
                    "userAvatar" => $user->getProfilePictureUrl(),
                    "forumUrl" => url()->route('forums.index'),
                    "formAction" => url()->route('railforums.thread.store'),
                    "method" => 'PUT',
                    "topicOptions" => $categories
                ])
            </div>

        </div>
        
    </page-conatiner>
@endsection
