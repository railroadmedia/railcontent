@extends('emails.layout')

@section('page-body')
<style>
</style>
<div>
    <h1>Cancellation Notice</h1>

    <p><span style="font-weight: bold;">{{ $userEmail }}</span> has cancelled their subscription.</p>
    <p>See MusoraCenter page for user {{ $userId }} at
        <a href="https://musora.com/admin#/users/{{ $userId }}">https://musora.com/admin#/users/{{ $userId }}</a>
    </p>

    <p>Cancellation reason:</p>

    <ul>
    @foreach(config('cancellation.reason-map') as $key => $value)
        @if($key == $cancellationReasonKey)
            <li style="font-weight: bold;">☑ {{ $value }}</li>
        @else
            <li>☐ {{ $value }}</li>
        @endif
    @endforeach
    </ul>

    @if(empty($additionalFeedback))
        <p>No additional feedback supplied.</p>
    @else
        <p>Additional feedback:</p>
        <blockquote>{{ $additionalFeedback }}</blockquote>
    @endif
</div>
@stop
