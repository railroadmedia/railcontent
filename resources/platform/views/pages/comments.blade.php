@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Comments | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <div class="tw-flex tw-flex-col tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
            <comments-catalogue
                theme-color="{{ $brand }}"
                brand="{{ $brand }}"
                user-id="{{ current_user()->getId() }}"
                user-name="{{ user()->display_name }}"
                user-avatar="{{ user()->profile_picture_url }}"
                user-xp="{{ Railroad\Points\Services\UserPointsService::fetchPoints(current_user()->getId()) }}"
                user-access-level="{{ user()->isAdmin() ? 'team' : 'piano' }}"
                profile-base-route="/members/profile/"
                :is-admin="{{ json_encode(user()->isAdmin()) }}"
            />
        </div>
    </div>
@endsection
