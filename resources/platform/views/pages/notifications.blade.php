@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp
@extends('members.layout')

@section('meta')
    <title>Notifications | Singeo</title>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
    @include('members.partials._content-sidebar')

    <div class="container mv-2">
        <notifications-table
             brand="singeo"
             theme-color="singeo"
             :notifications="{{ $notifications }}"
             notifications-endpoint=""
             settings-url="{{ url()->route('members.profile.settings', ['section' => 'settings']) }}"
             notification-count="{{ $notificationCount }}"
             :has-unread-notifications="{{ $hasUnreadNotifications ? 'true' : 'false' }}"></notifications-table>
    </div>
@endsection
