@extends('partials.layout')
@section('meta')
    <title>Musora | Invite A Friend</title>
@endsection
@section('content')
    <invite-friend
        :can-refer="{{ json_encode($canRefer) }}"
        invite-url="{{ url()->route('referral.email-invite') }}"
    ></invite-friend>
@endsection