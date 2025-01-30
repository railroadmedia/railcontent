<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    {!! \App\Analytics\Tracker::trackPageView() !!}

    <script src="https://www.googleoptimize.com/optimize.js?id=GTM-WP9MPV8"></script>

    <title>Musora | Musicians start here. </title>
    <meta property="og:title" content="Musora | Musicians start here. ">

    <meta name="description" content="Learn your favorite instruments with step-by-step lessons, popular songs, and unlimited personal support. ">
    <meta property="og:description" content="Learn your favorite instruments with step-by-step lessons, popular songs, and unlimited personal support. ">

    <meta property="og:url" content="https://www.musora.com">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image.jpg">

    @include('_partials.layout._fonts')
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind.css') }}" />
    <link rel="stylesheet" href="{{ asset('/marketing/css/app.css') }}" />

    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet"> -->
    <style>
        .top-bar .button-wrap .join.outline-button {
            color:#fff;
        }
    </style>

    @include('_partials.layout._fonts')
    @include('_partials.layout.favicons.musora-favicons')

    {!! \App\Analytics\Tracker::headBottom() !!}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>     <!-- Alpine Plugin -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
</head>

<body @hasSection('body-class') class="@yield('body-class')" @endif @yield('body-data')>
{!! \App\Analytics\Tracker::bodyTop() !!}

{{-- Notifications Container --}}
<div id="notifications-container"></div>

{{-- Confirmation Modal Container --}}
<div id="confirmation-container"></div>

@include("musora._partials._nav", [
    "checkoutVersion" => true,
    "whiteNav" => true,
])

<div id="app">
    @if(!empty(user()))
        <input id="currentUserId" type="hidden" value="{{ user()->id }}">
    @endif
    @if(session()->has('toast-success-message-data') && is_array(session()->get('toast-success-message-data')))
        @php
            $toastData = session()->has('toast-success-message-data');
        @endphp

        <input id="on-page-load-toast-data" type="hidden" data-icon="{{ $toastData['icon'] ?? 'happy' }}" data-title="{{ $toastData['title'] ?? '' }}" data-message="{{ $toastData['message'] ?? '' }}">
    @endif
    <div class="container order-form mv-3">
        <order-form
            theme-color="musora"
            brand="musora"
            :cart="{{ json_encode($cart) }}"
            cart-data-url='{{ get_musora_brand_base_url() }}'
            :billing-address="{{ json_encode($billingAddress) }}"
            :shipping-address="{{ json_encode($shippingAddress) }}"
            :user="{{ json_encode($user) }}"
            :login-url="{{ json_encode($loginUrl) }}"
            :logout-url="{{ json_encode($logoutUrl) }}"
            :stripe-publishable-key="{{ json_encode($stripePublishableKey) }}"
            :countries="{{ $countries }}"
            :banned-countries="{{ $bannedCountries }}"
            :provinces="{{ $provinces }}"
            :bonuses="{{ $bonuses }}"
            :payment-methods="{{ $paymentMethodsJson }}"
            :shipping-addresses = "{{ $shippingAddressesJson }}"
            :all-membership-product-skus = "{{ json_encode($allMembershipProductSkus) }}"
            :lifetime-membership-product-skus = "{{ json_encode($lifetimeMembershipProductSkus) }}"
            :memberships-number-of-free-days= "{{ json_encode($membershipsNumberOfFreeDays) }}"
        >
        </order-form>
    </div>
    <div class="container fluid bg-grey-4">
        <div class="container collapsed-h">
            <div class="flex flex-row flex-wrap text-center features">
                <div class="flex flex-column xs-12 sm-4 align-center pa-3">
                    <i
                        class="fa-light fa-mobile text-white mb-2"
                        style="font-size:40px;"
                    ></i>

                    <p class="tiny font-bold text-white">
                        We're always here to help
                    </p>
                    <p class="x-tiny text-white">
                        <a target="_blank" class="text-white" href="https://help.musora.com/">See our FAQs & answers</a>, or<br>
                        <a target="_blank" class="text-white" href="{{ get_musora_brand_base_url() }}/contact">click here to contact us directly</a>.
                    </p>
                </div>

                <div class="flex flex-column xs-12 sm-4 display pa-3 align-center">
                    <img
                        src="https://dmmior4id2ysr.cloudfront.net/icons/icon-trusted.png"
                        style="height:40px;width:auto;"
                    >

                    <p class="tiny font-bold text-white mt-2">
                        Your Information is Secure
                    </p>
                    <p class="x-tiny text-white">
                        This page is securely encrypted <br>
                        with world-class SSL protection.
                    </p>
                </div>

                <div class="flex flex-column xs-12 sm-4 pa-3 pv-2 align-center">
                    <i
                        class="fa-light fa-check-circle text-white mb-2"
                        style="font-size:40px;"
                    ></i>
                    <p class="tiny font-bold text-white">
                        100% Money Back Guarantee
                    </p>
                    <p class="x-tiny text-white">
                        Order risk-free with our 90-day, <br>
                        100% money back guarantee.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cookie-notice hide">
    <div class="text-wrap">
        <p>We use cookies for traffic data and advertising. <a href="/cookie" aria-label="Cookie Policy">Cookie Policy &raquo;</a></p>
        <div class="text-center">
            <div id="accept-cookies" role="button" tabindex="0">OKAY GOT IT</div>

        </div>
    </div>
</div>
<footer id="footer" class="bottom-footer clearfix relative sales-footer">
    <div class="footer-bottom" style="border-top: 0;padding-top: 0;">
        <div class="row">
            <img class="logo" src="https://www.musora.com/cdn-cgi/image/quality=95,width=250,metadata=none/https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png" alt="Musora Logo">
            @if(empty($minimal))
                <p><a href="https://goo.gl/maps/c4JxakSmnjB2" rel="noopener" target="_blank">107-31265 Wheel Ave. Abbotsford,<br class="mobile-only"> BC, V2T 6H2 Canada</a><br>
                    <a href="tel:+18004398921">Toll Free: 1-800-439-8921</a> / <br class="mobile-only"><a href="tel:+16048557605">Direct: 1-604-855-7605</a> / <br class="mobile-only"><a href="{{ get_musora_brand_base_url() }}/contact" aria-label="Contact Us">Contact Us</a></p>

                <a rel="noopener" href="https://www.youtube.com/freedrumlessons/" target="_blank" class="inline-flex items-center justify-center social-media youtube" aria-label="youtube"><i class="fab fa-youtube"></i></a>
                <a rel="noopener" href="https://facebook.com/drumeo/" target="_blank" class="inline-flex items-center justify-center social-media facebook" aria-label="facebook"><i class="fab fa-facebook-f"></i></a>
                <a rel="noopener" href="https://instagram.com/drumeoofficial/" target="_blank" class="inline-flex items-center justify-center social-media instagram" aria-label="instagram"><i class="fab fa-instagram"></i></a>
                <a rel="noopener" href="https://www.tiktok.com/@drumeoofficial" target="_blank" class="inline-flex items-center justify-center social-media tiktok" aria-label="tiktok"><i class="fab fa-tiktok"></i></a>
                <a rel="noopener" href="https://pod.link/1657251884" target="_blank" class="inline-flex items-center justify-center social-media podcast" aria-label="podcast"><i class="fas fa-podcast"></i></a>
            @endif

            <p class="tiny">Musora Media, Inc. &copy; {{ date('Y') }} - &nbsp; <a href="/terms/" aria-label="Terms of Service">Terms</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="/privacy/" aria-label="Privacy Policy">Privacy</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/careers" aria-label="Careers at Musora">Careers</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/brand" aria-label="Musora Brand Guide">Brand Guide</a></p>
        </div>
    </div>
</footer>
@include("drumeo.lead-gen.partials.impact-email-sign-up-tracker")


@include('partials._brand-set-authentication-cookies-iframe')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
<script src="{{ mix('/platform/js/manifest.js') }}"></script>
<script src="{{ mix('/platform/js/vendor.js') }}"></script>
<script src="{{ mix('/platform/js/app.js') }}"></script>

<script>
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.shipping-trigger')) return;

        document.querySelector('.shipping-info').classList.add("active");
        document.querySelector('.delay-overlay').classList.add("active");

    }, false);
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.close-modal')) return;

        document.querySelector('.shipping-info').classList.remove("active");
        document.querySelector('.delay-overlay').classList.remove("active");

    }, false);
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.delay-overlay')) return;

        document.querySelector('.shipping-info').classList.remove("active");
        document.querySelector('.delay-overlay').classList.remove("active");

    }, false);
</script>

{!! \App\Analytics\Tracker::bodyBottom() !!}

<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
<script type="text/javascript">
    window.Beacon('init', '14d9d94c-d89d-42e7-93ad-15ff13964974')
    Beacon('on', 'ready', () => {
        document.querySelector('.BeaconFabButtonFrame').style.bottom = "50px";
    });
</script>
</body>
</html>
