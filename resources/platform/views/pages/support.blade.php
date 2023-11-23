@extends('partials.layout')

@section('meta')
    <title>Support | Musora</title>
@endsection

@section('content')
    <support
        email-recipient="'{{ $emailRecipient ? 'support@' . $brand . '.com' : '' }}'"
        email-logo="{{ $logoLink }}"
        email-subject="{{ " Support Request from: " . user()->display_name . " (" . user()->email . ")" }}"
        email-type="'support-contact'"
        email-endpoint="'/mailora/secure/send'"
        email-success-message="'Your email has been sent!'"
    />
@endsection
