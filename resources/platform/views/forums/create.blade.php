@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
@endphp

@extends('forums.forumlayout')

@section('meta')
    <title>Create a Discussion | {{ $brand }}</title>
@endsection

@section('content')

        <div v-cloak>

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14 forum-post">
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
        
@endsection
