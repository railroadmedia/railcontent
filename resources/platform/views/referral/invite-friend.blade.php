@extends('partials.layout')

@section('meta')
    <title>Musora | Invite A Friend</title>
@endsection

@section('content')

    @include('partials.bladesora.members.referral.invite',
        [
            'referralsPerUser' => $referralsPerUser,
            'userReferralsPerformed' => $userReferralsPerformed,
            'userReferralLink' => $userReferralLink,
            'canRefer' => $canRefer,
            'emailInviteUrl' => url()->route('referral.email-invite'),
            'brand' => $brand,
            'showToast' => session()->has('email-invite-message'),
            'toastMessage' => session()->get('email-invite-message'),
        ]
    )

@endsection
