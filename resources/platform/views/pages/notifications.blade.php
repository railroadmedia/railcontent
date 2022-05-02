@extends('partials.layout')

@section('meta')
    <title>Notifications | Musora</title>
@endsection

@section('content')
    <page-container brand="{{ $brand }}">
        <div v-cloak>

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
                <notifications-table
                    brand="{{ $brand }}"
                    theme-color="{{ $brand }}"
                    :notifications="{{ $notifications }}"
                    notifications-endpoint=""
                    settings-url="{{ url()->route('members.profile.settings', ['section' => 'settings']) }}"
                    notification-count="{{ $notificationCount }}"
                    :has-unread-notifications="{{ $hasUnreadNotifications ? 'true' : 'false' }}"
                />
            </div>

        </div>
    </page-container>
@endsection
