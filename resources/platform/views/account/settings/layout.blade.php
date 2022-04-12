@extends('partials.layout')

@section('content')
    <page-container>

        <div v-cloak>

            @include('partials.bladesora.adesora.partials._account-header', [
                "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
                "userAvatar" => current_user()->getProfilePictureUrl(),
                "userName" => current_user()->getDisplayName(),
                "appName" => 'Singeo',
                "memberSince" => current_user()->getCreatedAt(),
            ])

            @if(session()->has('error-message'))
                <div class="form-success-message container mt-3">
                    <div class="flex flex-column bg-error shadow corners-10 pa">
                        <p class="body text-white"><strong>{{ session()->get('error-message') }}</strong></p>
                    </div>
                </div>
            @endif

            @if(session()->has('success'))
                <div class="form-success-message container mt-3">
                    <div class="flex flex-column bg-singeo shadow corners-10 pa">
                        <p class="body text-white">Profile successfully updated!</p>
                    </div>
                </div>
            @endif

            @if(session()->has('successes'))
                <div class="form-success-message container mt-3">
                    <div class="flex flex-column bg-singeo shadow corners-10 pa">
                        @foreach(session()->get('successes')->all() as $message)
                            <p class="body text-white">{{ $message }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(session()->has('success-message-unsubscribe'))
                <div class="container mv-3">
                    <div class="flex flex-row bg-singeo text-white shadow corners-10 pa-3">
                        <div class="flex flex-column">
                            <h4 class="title mb-3">Membership Canceled</h4>
                            <p class="body mb-2">We're sorry to see you go! Your Singeo membership has been deactivated, and your account will not auto-renew. You can still enjoy Singeo until it expires. We exist to help people achieve their musical goals and hope you continue the work to make your dreams happen. If we can help you make the music you want to, we're here to support you whenever you need us.</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session()->has('success-message-unsubscribe-contact'))
                <div class="container mv-3">
                    <div class="flex flex-row bg-singeo text-white shadow corners-10 pa-3">
                        <div class="flex flex-column">
                            <h4 class="title mb-3">Contact Request Sent.</h4>
                            <p class="body mb-2">Thank you, we'll get in touch with you shortly!</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="container mv-3">
                <div class="flex flex-row mt-4">
                    <div class="flex flex-column grow">
                        <div class="flex flex-row bb-grey-1-1">
                            @foreach($sections as $index => $section)
                                <a href="{{ $section['url'] }}" class="flex flex-row align-center body pb-2 ph-1 mr-2 no-decoration text-black
                                {{ $section['active'] ? 'bb-singeo-3 font-bold' : '' }}">
                                    <i class="{{ $section['icon'] }} {{ $section['active'] ? 'text-singeo' : '' }}"></i>
                                    <span class="hide-xs-only">&nbsp; {{ $section['title'] }}</span>
                                </a>
                            @endforeach
                        </div>
                        <div class="flex flex-row">
                            <div class="flex flex-column grow">
                                @yield('edit-forms')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </page-container>
@endsection
