@extends('partials.layout')

@section('meta')
    <title>Musora | Invite A Friend</title>
@endsection

@section('content')
    <invite-friend
        :referrals-per-user="{{ json_encode($referralsPerUser) }}"
        :user-referrals-performed="{{ json_encode($userReferralsPerformed) }}"
        user-referral-link="{{ $userReferralLink }}"
        :can-refer="{{ json_encode($canRefer) }}"
        email-invite-url="{{ url()->route('referral.email-invite') }}"
        link-copy-url="{{ url()->route('musora-api.v1.referral.link_copied') }}"
        invite-url="{{ url()->route('referral.email-invite') }}"
    ></invite-friend>
@endsection
