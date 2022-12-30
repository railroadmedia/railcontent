@extends('drumeo._partials.layout-template')

@section('global-head')
    @yield('meta')

    <title>Join Drumeo</title>
    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    @endif

    @include('drumeo._partials._fonts')
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind.css') }}" />
    <link rel="stylesheet" href="{{ asset('/marketing/css/app.css') }}" />

    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet"> -->
@stop

@section('global-body')
    {{-- Notifications Container --}}
    <div id="notifications-container"></div>

    @include("drumeo.sales.partials._nav", [
        "checkoutVersion" => true,
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
                theme-color="drumeo"
                brand="drumeo"
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
                            class="fal fa-mobile text-white mb-2"
                            style="font-size:40px;"
                        ></i>

                        <p class="tiny font-bold text-white">
                            We're always here to help
                        </p>
                        <p class="x-tiny text-white">
                            <a target="_blank" class="text-white" href="https://help.drumeo.com/">See our FAQs & answers</a>, or<br>
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
                            class="fal fa-check-circle text-white mb-2"
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
    @include("drumeo.sales.partials._footer")

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

@stop
