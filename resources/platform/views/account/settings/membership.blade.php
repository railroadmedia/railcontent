@extends('account.settings.layout')

@section('meta')
    <title>Membership | Musora</title>
@endsection

@section('edit-forms')
    <div id="editForm" class="tw-flex tw-flex-col">

        {{-- <div class="tw-flex tw-flex-row pa-3 tw-pb-0 tw-flex-auto">
            <h1 class="tw-text-2xl tw-font-bold tw-text-[#00101D] dark:tw-text-white">Account Details</h1>
        </div> --}}

        {{-- Coming Soon Message --}}
        <div class="tw-flex tw-flex-col pa-3 tw-pb-0">
            <h2 class="tw-text-3xl tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-mb-4">Coming Soon</h2>
            <p class="tw-text-base tw-text-[#00101D] dark:tw-text-white">
                This page is currently under construction. If you'd like to update your account details please visit 
                <a class="tw-underline tw-text-drumeo" href="https://www.{{ $brand }}.com/members/settings/access" alt="Go to {{ $brand }} payment page">https://www.{{ $brand }}.com/members/settings/access</a>
            </p>
        </div>

    </div>
@endsection
