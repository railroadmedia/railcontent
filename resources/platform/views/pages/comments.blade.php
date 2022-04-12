@extends('partials.layout')

@section('meta')
    <title>{{ $brand }} Comments | Musora</title>
@endsection

@section('content')
    <page-container>

        <div v-cloak>

            <div class="container">
                <div class="flex flex-column bg-white shadows corners-10 mv-3">
                    <comments-catalogue
                        theme-color="{{ $brand }}"
                        brand="{{ $brand }}"
                        user-id="{{ current_user()->getId() }}"
                        user-name="{{ current_user()->getDisplayName() }}"
                        user-avatar="{{ current_user()->getProfilePictureUrl() }}"
                        user-xp="{{ Railroad\Points\Services\UserPointsService::fetchPoints(current_user()->getId()) }}"
                        user-access-level="{{ current_user()->getPermissionLevel() === 'administrator' ? 'team' : 'piano' }}"
                        profile-base-route="/members/profile/"
                        :is-admin="{{ json_encode(current_user()->getPermissionLevel() === 'administrator') }}"
                    />
                </div>
            </div>
    
        </div>

    </page-container>
@endsection
