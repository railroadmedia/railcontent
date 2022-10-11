@extends('layout')

@section('content')

    <div class="">

    {{-- todo: musora logo --}}

    <h2 class="">Will you let us know why you're cancelling?</h2>

    <p class="">We’re sorry to hear that you’re unhappy with your membership.
        <br>If you have a minute, we’d like to know where we went wrong.</p>

    <form method="post"
          action="{{ url()->route('platform.profile.settings.submit-cancel-reason') }}"
          id="cancel-reason-form"
          class="tw-flex tw-flex-col tw-flex-grow">

        {{ csrf_field() }}

        @foreach(config('cancellation.reason-map') as $key => $wording)
            <label for="{{ $key }}" class="">
                <input type="radio" id="{{ $key }}"
                       value="{{ $key }}"
                       name="reason" class="">
                {{ $wording }}
            </label>
        @endforeach

        <textarea placeholder="Type your feedback here..."
                  class=""
                  name="other-reason-text"></textarea>

        <div class="tw-flex tw-flex-col tw-items-center tw-w-full tw-mt-10">
            <p class="tw-text-red-600 tw-mb-4" id="reason-validation-message" style="display: none;">
                <strong>Please select a reason.</strong>
            </p>
            <button
                type="submit"
                class=""
                style="cursor: pointer">
                Cancel Membership
            </button>

            <a href="{{ url()->route('platform.profile.settings.account') }}"
               class="">
                Go Back
            </a>
        </div>

    </form>


    </div>

@endsection
