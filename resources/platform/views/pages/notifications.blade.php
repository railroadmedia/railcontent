@extends('partials.layout')

@section('meta')
    <title>Notifications | Singeo</title>
@endsection

@section('content')
    <page-container>

        <div v-cloak>

            <div class="tw-container tw-mx-auto mv-2">
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
