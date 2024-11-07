@extends('partials.layout')

@section('meta')
    <title>Musora | Invite A Friend</title>
@endsection

@php
    \Railroad\LeadTracker\Services\LeadTrackerService::getRequestTrackingInputsHtmlFromRequest(
        'Musora Referral',
        route('customer-io.submit-email-form', [], false),
        'post',
        null,
        null,
        null
    );
@endphp

@section('content')
    <invite-friend
        {{-- :can-refer="{{ json_encode($canRefer) }}" --}}
        {{-- invite-url="{{ url()->route('referral.email-invite') }}" --}}
    ></invite-friend>
@endsection