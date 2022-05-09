@extends('partials.layout')

@section('content')
    <div v-cloak>

        @include('partials.bladesora.members.partials._account-header', [
            "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
            "userAvatar" => user()->profile_picture_url,
            "userName" => user()->display_name,
            "appName" => $brand,
            "memberSince" => user()->created_at,
        ])

        @if(session()->has('error-message'))
            <div class="form-success-message tw-container tw-mx-auto tw-mt-3">
                <div class="tw-flex tw-flex-col bg-error tw-shadow corners-10 pa">
                    <p class="body tw-text-white"><strong>{{ session()->get('error-message') }}</strong></p>
                </div>
            </div>
        @endif

        @if(session()->has('success'))
            <div class="form-success-message tw-container tw-mx-auto tw-mt-3">
                <div class="tw-flex tw-flex-col tw-bg-{{$brand}} tw-shadow corners-10 pa">
                    <p class="body tw-text-white">Profile successfully updated!</p>
                </div>
            </div>
        @endif

        @if(session()->has('successes'))
            <div class="form-success-message tw-container tw-mx-auto tw-mt-3">
                <div class="tw-flex tw-flex-col tw-bg-{{$brand}} tw-shadow corners-10 pa">
                    @foreach(session()->get('successes')->all() as $message)
                        <p class="body tw-text-white">{{ $message }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        @if(session()->has('success-message-unsubscribe'))
            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
                <div class="tw-flex tw-flex-row tw-bg-{{$brand}} tw-text-white tw-shadow corners-10 pa-3">
                    <div class="tw-flex tw-flex-col">
                        <h4 class="title tw-mb-3">Membership Canceled</h4>
                        <p class="body tw-mb-2">We're sorry to see you go! Your <span class="tw-capitalize">{{$brand}}</span> membership has been deactivated, and your account will not auto-renew. You can still enjoy Musora until it expires. We exist to help people achieve their musical goals and hope you continue the work to make your dreams happen. If we can help you make the music you want to, we're here to support you whenever you need us.</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session()->has('success-message-unsubscribe-contact'))
            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
                <div class="tw-flex tw-flex-row tw-bg-{{$brand}} tw-text-white tw-shadow corners-10 pa-3">
                    <div class="tw-flex tw-flex-col">
                        <h4 class="title tw-mb-3">Contact Request Sent.</h4>
                        <p class="body tw-mb-2">Thank you, we'll get in touch with you shortly!</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
            <div class="tw-flex tw-flex-row mt-4">
                <div class="tw-flex tw-flex-col grow">
                    <div class="tw-flex tw-flex-row bb-grey-1-1">
                        @foreach($sections as $index => $section)
                            <a href="{{ $section['url'] }}" class="tw-flex tw-flex-row align-center body tw-pb-2 ph-1 tw-mr-2 tw-no-underline tw-text-black
                            {{ $section['active'] ? 'bb-singeo-3 tw-font-bold' : '' }}">
                                <i class="{{ $section['icon'] }} {{ $section['active'] ? 'tw-text-singeo' : '' }}"></i>
                                <span class="hide-xs-only">&nbsp; {{ $section['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                    <div class="tw-flex tw-flex-row">
                        <div class="tw-flex tw-flex-col tw-grow">
                            @yield('edit-forms')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
