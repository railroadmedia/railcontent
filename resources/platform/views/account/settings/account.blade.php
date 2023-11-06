@php use App\Http\Controllers\Platform\ProfileSettingsPagesController; @endphp
@extends('account.settings.layout')

@section('meta')
    <title>Profile | Musora</title>
@endsection

@section('layout-scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="{{ mix('platform/js/profile.js') }}"></script>
    <script>
        // console.log('hooray');

        document.addEventListener('DOMContentLoaded', function () {

            // class="mu-modal-open"
            // id="modal-upgrade"

            // https://github.com/railroadmedia/drumeo/blob/master/laravel/resources/assets/members/js/profile.js#L194
            var openmodal = document.querySelectorAll('.mu-modal-open');

            console.log(openmodal.length);

            for (var i = 0; i < openmodal.length; i++) {
                openmodal[i].addEventListener('click', function (event) {
                    event.preventDefault();
                    openModal(event);
                });
            }

            const overlay = document.querySelectorAll('.mu-modal-overlay');
            for (var i = 0; i < overlay.length; i++) {
                overlay[i].addEventListener('click', closeModal);
            }

            var closemodal = document.querySelectorAll('.mu-modal-close');
            for (var i = 0; i < closemodal.length; i++) {
                closemodal[i].addEventListener('click', closeModal);
            }

            // https://github.com/railroadmedia/drumeo/blob/master/laravel/resources/assets/members/js/profile.js#L231
            function openModal(event) {
                console.log(event);
                console.log('openModal triggered :D');
                const body = document.querySelector('body');
                const targetModalClass = event.target.id;
                const targetModal = document.querySelector('.' + targetModalClass);

                targetModal.classList.remove('tw-opacity-0');
                targetModal.classList.remove('tw-pointer-events-none');
                targetModal.classList.add('mu-modal-is-open');
                body.classList.add('mu-modal-active');
            }

            function closeModal(event) {
                console.log('closeModal triggered :D');
                const body = document.querySelector('body');
                const targetModal = document.querySelector('.mu-modal-is-open');

                targetModal.classList.add('tw-opacity-0');
                targetModal.classList.add('tw-pointer-events-none');
                targetModal.classList.remove('mu-modal-is-open');
                body.classList.remove('mu-modal-active');
            }

        });
    </script>
    <script src="https://static.rechargecdn.com/assets/storefront/recharge-client-1.12.0.min.js"></script>
    <script type="text/javascript">
        recharge.init({
            // optional when in a shopify environment
            storeIdentifier: '{{ config('shopify.hostName') }}',
            // required for API access
            storefrontAccessToken: '{{ config('shopify.rechargeStoreFrontAccessToken') }}',
            // retry middleware function if/when Recharge session expires
            loginRetryFn: () => {
                return recharge.auth.loginShopifyApi(
                    '{{ config('shopify.SHOPIFY_APP_STOREFRONT_ACCESS_TOKEN') }}',
                    '{{ $shopifyCustomerAccessToken }}'
                )
                    .then(session => {
                        console.log(session);
                        return session;
                    });
            },
        });

        recharge.auth.loginShopifyApi(
            '{{ config('shopify.SHOPIFY_APP_STOREFRONT_ACCESS_TOKEN') }}',
            '{{ $shopifyCustomerAccessToken }}'
        )
            .then(session => {
                console.log(session);
                recharge.customer.getCustomerPortalAccess(session).then(portal => {
                    console.log(portal);
                })
            });
    </script>
@endsection

@if(!empty($subscription))
    @php
        switch ($subscription->getIntervalCount()) {
            case 2:
                $intervalCountAsWord = 'two';
                break;
            case 3:
                $intervalCountAsWord = 'three';
                break;
            case 4:
                $intervalCountAsWord = 'four';
                break;
            case 5:
                $intervalCountAsWord = 'five';
                break;
            case 6:
                $intervalCountAsWord = 'six';
                break;
        }

        $annualPriceMultiplicationFactor = 12 / $subscription->getIntervalCount();

        /*
         * Make subscription price pretty
         * ------------------------------
         *
         * This does two things. In cases where there is only one decimal place, it forces the trailing zero to be
         * shown, as is standard for pricing. For example where a price might initially be formatted as double `29.9`,
         * we ensure at appears as a string "29.90". But in cases where the decimal numbers are two zeros
         * (ex: "$29.00") it doesn't enforce that two-decimal-place rule, but rather transforms it to a much cleaner
         * "$29".
         */
        $subcriptionPrice = $subscription->getTotalPrice();
        $isDecimal = floor($subcriptionPrice) != $subcriptionPrice;

        /** @var string $subscriptionPriceFormatted */
        if($isDecimal) {
            $subscriptionPriceFormatted = number_format((float) $subcriptionPrice, 2, '.', ''); // returns a string
        } else {
            $subscriptionPriceFormatted = (string) $subcriptionPrice;
        }

    @endphp
@endif

@section('edit-forms')

    <div class="tw-flex tw-flex-row">

        <div class="tw-flex tw-flex-col tw-grow tw-w-full ">

            <div class="tw-flex tw-flex-col tw-w-full ">

                {{-- Account Title --}}
                <div class="tw-flex tw-flex-row tw-flex-auto pa-3 tw-pb-3">
                    <h1 class="tw-text-2xl tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                        Account Details
                    </h1>
                </div>

                {{-- ================================= Owned products ================================= --}}

                @if( !empty($userProductsDigitalAccessTypeSpecific))
                    <div class="tw-flex tw-flex-col body tw-pt-0 pa-3">
                        <div
                            class="tw-flex tw-flex-row tw-flex-auto tw-py-2 tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                            <h2 class="tw-font-bold tw-text-lg dark:tw-text-white">Your Access Levels</h2>
                        </div>

                        <div
                            class="tw-flex tw-flex-row tw-flex-auto tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                            <div class="tw-flex tw-flex-col">
                                <ul class="tw-mt-3 tw-space-y-1 tw-list-disc tw-ml-6">
                                    @foreach($userProductsDigitalAccessTypeSpecific as $product)
                                        <li>{{ $product->getName() }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif($mostRecentSubscriptionCancelledOn && $activeAllContentAccessExpiryDate)

                    <div>
                        <h2 class="tw-text-[#00101D] dark:tw-text-white">Musora Special Offer</h2>
                        @if($activeAllContentAccessExpiryDate < \Carbon\Carbon::now())
                            <p class="tw-text-[#00101D] dark:tw-text-white">Your subscription to Musora has been
                                canceled and your access ended
                                on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}. Please contact support or
                                reorder on <a
                                    href="/">www.Musora.com</a> to continue your membership.</p>
                        @else
                            <p class="tw-text-[#00101D] dark:tw-text-white">Your subscription to Musora has been
                                canceled and your access will be
                                removed on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}. Please contact
                                support
                                or reorder at <a
                                    href="/">www.Musora.com</a> to continue your membership.</p>
                        @endif
                    </div>

                @endif


                {{-- ============================================================================================= --}}
                {{-- ================================= Subscription Info Section ================================= --}}
                {{-- ============================================================================================= --}}

                <div
                    class="tw-flex tw-flex-wrap tw-border-0 tw-border-t tw-border-b tw-border-gray-300 dark:tw-border-[#223F57] tw-border-solid">

                    <iframe id="rcPortal"
                            src="https://admin.rechargeapps.com/portal/16ee71852e3e3063a55786100d46ea/schedule?token=eea820de0d8b4d2185bed3e469feaf70"
                            width=100% height=1200px></iframe>

                </div>

            </div>
        </div>
    </div>

    {{-- =================================  Legacy Video Player Form ================================= --}}

    <form method="POST" action="{{ url()->route('user_management_system.user.update', ['id' => user()->id ])}}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="pa-3 tw-border-0 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57] tw-border-solid tw-w-full">
            <h3 class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 tw-text-lg tw-font-bold">Would you like to use our
                legacy video player?</h3>
            <p class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 lg:tw-max-w-[50%]">
                Our video player may have compatibility issues with older devices and operating systems. We recommend
                switching to our legacy video player if you are experiencing playback issues.
            </p>
            {{-- Legacy Player Toggle --}}
            <div class="tw-flex tw-flex-row tw-mt-3">
                @include('partials.bladesora.members.inputs.toggle-input', [
                    "inputID" => "useLegacyPlayer",
                    "inputName" => "use_legacy_video_player",
                    "inputLabel" => "Use legacy video player.",
                    "checked" => (boolean) user()->use_legacy_video_player ?? false
                ])
            </div>
        </div>

        {{-- =================================  Save Account Settings ================================= --}}
        <div class="tw-flex tw-flex-row tw-flex-wrap sm:tw-flex-nowrap pa-3">
            <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white sm:tw-mr-2 tw-w-full sm:tw-w-auto"
                    type="submit"> Save
            </button>
            <button
                class="tw-btn-primary tw-bg-transparent tw-text-[#00101D] dark:tw-text-white dark:hover:tw-bg-white/10 hover:tw-bg-black/10 tw-w-full sm:tw-w-auto"
                type="reset"> Cancel
            </button>
        </div>
    </form>







    {{--  ================================================= MODALS ================================================= --}}

    @if($offerUpgradeToAnnualShowToStudent && $subscription->getIntervalType() === 'month')
        @component('account.settings.partials._modal', ['modalId' => 'modal-upgrade'])
            @slot('contentSlot')
                <div>
                    <h1 class="tw-text-center tw-font-bold tw-mb-8 tw-text-2xl tw-font-black">
                        @if( !empty($offerUpgradeToAnnualPercentSaved) )
                            Save {{ $offerUpgradeToAnnualPercentSaved }}% with an annual plan.
                        @else
                            Save with an annual plan.
                        @endif
                    </h1>

                    <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 tw-gap-4 tw-mb-8">

                        {{-- Upgrade Card: Keep Plan --}}
                        <div class="tw-p-6 tw-rounded-lg tw-border-2 tw-text-center tw-bg-[#e5e7eb]">
                            <h2 class="tw-font-black tw-leading-none tw-mb-4 tw-text-4xl">YOUR<br>PLAN</h2>

                            <div class="tw-mb-8">
                                @if($subscription->getIntervalCount() == 1)
                                    <p>${{ $subscription->getTotalPrice() }} per month</p>
                                    <p>= ${{ $subscription->getTotalPrice() * 12 }} per year</p>
                                @else
                                    <p>${{ $subscription->getTotalPrice() }} every {{ $intervalCountAsWord }} months</p>
                                    <p>= ${{ $subscription->getTotalPrice() * $annualPriceMultiplicationFactor }} per
                                        year</p>
                                @endif
                            </div>

                            <button class="tw-btn-primary tw-bg-black mu-modal-close tw-w-full tw-px-8">KEEP THIS PLAN
                            </button>
                        </div>

                        {{-- Upgrade Card: See Offer --}}
                        <div class="tw-p-6 tw-rounded-lg tw-border-2 tw-text-center tw-border-{{ $brand }}">
                            <h2 class="tw-font-black tw-leading-none tw-mb-4 tw-text-4xl">ANNUAL<br>PLAN</h2>

                            <div class="tw-mb-8">
                                @if( !empty($offerUpgradeToAnnualPercentSaved) )
                                    <p>Save {{ $offerUpgradeToAnnualPercentSaved }}%</p>
                                    <p>+ get limited time bonuses</p>
                                @else
                                    <p>Get limited time bonuses</p>
                                @endif
                            </div>

                            <a class="tw-btn-primary tw-bg-{{ $brand }} tw-w-full tw-px-8" href="{{ $salesPageUrl }}">
                                SEE OFFER
                            </a>
                        </div>

                    </div>

                    <p class="tw-text-sm tw-text-center">
                        By completing the checkout process on the next page, your monthly billing will be stopped and
                        replaced by an annual billing plan at the posted rate.
                    </p>
                </div>
            @endslot
        @endcomponent
    @endif

    @component('account.settings.partials._modal', ['modalId' => 'modal-how-can-we-help'])
        @slot('contentSlot')

            {{-- todo: this should submit the normal cancel help email that goes to the person is does now and return back to the account details page with a success message --}}
            <form method="post" action="{{ url()->route('platform.profile.settings.send-help-email') }}"
                  {{--                  class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-relative">--}}
                  class="">

                {{ csrf_field() }}

                <h1 class="heading tw-text-center">How can we help?</h1>

                <div class="tw-text-left">
                    <p class="body tw-mt-4">
                        Select any of the issues you’d like help with:
                    </p>
                    {{--<div class="tw-ml-3">--}}
                    <ul class="tw-ml-3">
                        @foreach(ProfileSettingsPagesController::HOW_CAN_WE_HELP_OPTIONS as $label => $text)
                            <li>
                                <input type="radio" name="help-issue" id="{{ $label }}" value="{{ $label }}"
                                       class="tw-mr-3">
                                <label for="{{ $label }}">{{ $text }}</label>
                            </li>
                        @endforeach
                    </ul>

                    <textarea placeholder="Send your questions to a {{ ucfirst($brand) }} teacher..."
                              class="tw-mt-6 tw-rounded-lg tw-w-full" name="text-input"></textarea>

                    {{--<label for="email-input" class="tw-py-1 tw-mt-6 tw-block">We'll get back to you at "{{ current_user()->getEmail() }}". If you prefer a different address, please enter it here (optional):</label>--}}
                    {{--<input type="text" name="email" id="email-input" class="tw-mt-1 tw-pt-0 tw-rounded-lg"--}}
                    {{--placeholder="Email address">--}}
                </div>

                <button
                    {{--                    class="tw-uppercase tw-font-bold tw-no-underline tw-p-3 tw-pl-16 tw-pr-16 tw-text-white tw-rounded-full tw-mt-8 tw-border-0"--}}
                    class="tw-btn-primary tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600 tw-w-full tw-my-2"
                    style="cursor:pointer">
                    Send Message
                </button>
            </form>
        @endslot
    @endcomponent

@endsection
