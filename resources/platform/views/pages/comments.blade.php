@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Singeo Comments | Singeo</title>
@endsection

@section('content')
    @include('members.partials._content-sidebar')

    <div class="container">
        <div class="flex flex-column bg-white shadows corners-10 mv-3">
            <comments-catalogue
                    theme-color="singeo"
                    brand="singeo"
                    user-id="{{ current_user()->getId() }}"
                    user-name="{{ current_user()->getDisplayName() }}"
                    user-avatar="{{ current_user()->getProfilePictureUrl() }}"
                    user-xp="{{ Railroad\Points\Services\UserPointsService::fetchPoints(current_user()->getId()) }}"
                    user-access-level="{{ current_user()->getPermissionLevel() === 'administrator' ? 'team' : 'piano' }}"
                    profile-base-route="/members/profile/"
                    :is-admin="{{ json_encode(current_user()->getPermissionLevel() === 'administrator') }}"></comments-catalogue>
        </div>
    </div>
@endsection
