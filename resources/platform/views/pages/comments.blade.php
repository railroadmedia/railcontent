@extends('partials.layout')

@section('meta')
    <title>{{ $brand }} Comments | Musora</title>
@endsection

@section('content')
        <div v-cloak>

            <div class="tw-container tw-mx-auto">
                <div class="tw-flex tw-flex-col tw-bg-white tw-shadows corners-10 tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
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
@endsection
