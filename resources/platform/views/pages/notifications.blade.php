@extends('partials.layout')

@section('meta')
    <title>Notifications | Musora</title>
@endsection

@section('content')

    <notifications-table
        brand="{{ $brand }}"
        theme-color="{{ $brand }}"
        :notifications="{{ $notifications }}"
        settings-url="{{ url()->route('platform.profile.settings.notifications', ['userId' => user()->id]) }}"
        notification-count="{{ $notificationCount }}"
        :has-unread-notifications="{{ $hasUnreadNotifications ? 'true' : 'false' }}"
    />
    
@endsection
