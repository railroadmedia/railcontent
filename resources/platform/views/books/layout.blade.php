<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    @include('partials.google-optimize')

    @yield('meta')

    <link rel="stylesheet" href="https://dpwjbsxqtam5n.cloudfront.net/fonts/font-awesome-5/fontawesome-all.min.css">
    <link rel="stylesheet" href="{{ mix('assets/members/css/app.css') }}">

    <!-- Tailwind -->
    <link rel="stylesheet" href="{{ mix('tailwindcss/tailwind.css') }}">

    @include('members.partials._favicons')

    @yield('styles')

    @if($hasAccess)
        @php
            $bodyClass = ($bodyClass ?? '') . ' sidebar';
            $leftSidebar = true;
        @endphp
    @endif

    {!! \App\Analytics\Tracker::trackPageView() !!}

    {!! \App\Analytics\Tracker::headBottom() !!}
</head>
<body class="pianote {{ isLive() ? 'live' : '' }} {{ $bodyClass ?? '' }} {{ !empty($_COOKIE['collapsed']) ? 'sidebar-collapsed' : '' }} {{ !empty($_COOKIE['darkmode']) ? 'dark-mode' : '' }}">
<div id="app">
    @if(!empty(current_user()))
        <input id="currentUserId" type="hidden" value="{{ current_user()->getId() }}">
    @endif

    {!! \App\Analytics\Tracker::bodyTop() !!}

    @if($hasAccess)
        @include('bladesora::members.navigation.nav', [
            "logo" => "https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png",
            "themeColor" => "pianote",
            "accountUrl" => url()->route('members.profile.dashboard', [auth()->id()]),
            "userAvatar" => current_user()->getProfilePictureUrl(),
            "userName" => 'Pianote User',
            "searchUrl" => isPackOnly() ? null : url()->route('members.search'),
            "mainSections" => [],
            "links" => [],
            "supportUrl" => url()->route('members.support'),
            "logoutUrl" => url()->route('usora.deauthenticate'),
            "stretch" => $leftSidebar ?? false,
            "userName" => current_user()->getDisplayName(),
            "userXp" => \Railroad\Points\Services\UserPointsService::fetchPoints(current_user()->getId()),
            "userLevel" => \App\Services\User\UserContentProgressService::getLevelRank(current_user()->getId()),
        ])

            @include('members.partials._content-sidebar')
        @else
        @include('bladesora::members.navigation.public-nav', [
            "logo" => "https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png",
            "themeColor" => "pianote",
            "links" => [
            "Member Login" => [
                    "icon" => "fas fa-sign-in",
                    "url" => url()->route('members.home'),
                ],
                "Contact" => [
                    "icon" => "fas fa-phone",
                    "url" => '/contact',
                ],
                "Pianote" => [
                    "icon" => "fas fa-home",
                    "url" => '/',
                ],
                "Blog" => [
                    "icon" => "fas fa-comment-alt-lines",
                    "url" => '/blog',
                ],
                "500 Songs In 5 Days" => [
                    "icon" => "fas fa-music",
                    "url" => '/500-songs',
                ],
                "Merch" => [
                    "icon" => "fas fa-tshirt",
                    "url" => '/t-shirt',
                ],
                "Free Resources" => [
                    "icon" => "fas fa-play-circle",
                    "children" => [
                        "Sight Reading Made Simple" => [
                            "url" => '/sight-reading-made-simple',
                        ],
                        "Getting Started On The Pianote"=> [
                            "url" => "/getting-started",
                        ],
                        "Chord Hacks"=> [
                            "url" => "/chord-hacks",
                        ],
                        "Piano Improv for Beginners"=> [
                            "url" => "/piano-improv",
                        ],
                    ],
                ],
            ]
        ])
    @endif

    @yield('content')

        @include('bladesora::members.navigation.footer', [
            "termsUrl" => "/terms",
            "privacyUrl" => "/privacy",
            "logoutUrl" => url()->route('usora.deauthenticate'),
            "supportUrl" => url()->route('members.support'),
            "logoImage" => "https://dmmior4id2ysr.cloudfront.net/logos/pianote-by-musora-grey.png",
        ])
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.2.5/polyfill.js"></script>

<script src="{{ mix('assets/members/js/manifest.js') }}"></script>
<script src="{{ mix('assets/members/js/vendor.js') }}"></script>
@yield('inject-components')
<script src="{{ mix('assets/members/js/books.js') }}"></script>
<script src="{{ mix('assets/members/js/app.js') }}"></script>

@yield('scripts')

@include('helpscout::helpscout-tracking-beacon-script', ['email' => !empty(current_user()) ? current_user()->getEmail() : null])
<script type="text/javascript">
    Beacon('on', 'ready', () => {
        document.querySelector('.BeaconFabButtonFrame').style.bottom = "50px";
    });
</script>
{!! \App\Analytics\Tracker::bodyBottom() !!}

</body>
</html>
