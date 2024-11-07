<?php
$layout = 'books.layout';
if (!empty($user)) {
    $layout = 'partials.layout';
} ?>

@extends($layout)

@section('meta')
    <title>The Best Beginner Drum Book | Musora</title>
@endsection
    
@section('content')
    <best-beginner-drum-book
        :is-digital="{{ json_encode($isDigital) }}"
        :user="{{ $user }}"
        @if(!empty($user))
            :is-member="{{ json_encode($user->isAMember()) }}"
            :is-pack-only-owner="{{ json_encode($user->isPackOnlyOwner()) }}"
            :is-expired-member="{{ json_encode($user->isAnExpiredMember()) }}"
            :renew-url="{{ json_encode(url()->route('platform.profile.settings.payments',['brand' => 'drumeo','userId' => $user->id])) }}"
        @endif
        :chapters="{{ json_encode($chapters) }}"
        :has-access="{{ json_encode($hasAccess) }}"
        redeem-api="{{ URL::route('access-codes.form-claim') }}"
        login-api="{{ url()->route('user_management_system.login.cookie').'?redirect_to='.$redirectUrl }}"
    ></best-beginner-drum-book>
@endsection
