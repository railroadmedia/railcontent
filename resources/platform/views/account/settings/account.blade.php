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

    <div class="tw-flex tw-flex-row tw-px-3 tw-pt-6 tw-pb-0 tw-flex-auto">
        <h1 class="tw-text-2xl tw-font-bold tw-text-[#00101D] dark:tw-text-white">Account Details</h1>
    </div>

    <div class="tw-flex tw-flex-row">
        <div class="tw-flex tw-flex-col tw-grow tw-w-full">
            <div class="tw-flex tw-flex-col tw-w-full">

                <!-- ================================= Owned products ================================= -->

                @if( !empty($userProductsDigitalAccessTypeSpecific) || $isLifetime || $subscription || $membershipFromOneTimeProduct)

                    <div class="tw-flex tw-flex-col tw-p-8 body">
                        <div class="tw-flex tw-flex-row tw-flex-auto tw-p-3 tw-text-[#00101D] dark:tw-text-white">
                            <h2 class="tw-font-bold tw-text-lg">Your Access Levels</h2>
                        </div>

                        <div class="tw-flex tw-flex-row tw-flex-auto tw-pl-3 tw-text-[#00101D] dark:tw-text-white">
                            <p class="tw-mt-3">Your account includes:</p>
                        </div>

                        <div class="tw-flex tw-flex-row tw-flex-auto tw-pl-3 tw-text-[#00101D] dark:tw-text-white">
                            <div class="tw-flex tw-flex-col">
                                <ul class="tw-mt-3 tw-space-y-1">
                                    @if($isLifetime)
                                        <li>Lifetime Membership</li>
                                    @elseif($subscription || $membershipFromOneTimeProduct)
                                        <li>Membership</li>
                                    @endif

                                    @foreach($userProductsDigitalAccessTypeSpecific as $userProduct)
                                        @php
                                            /** @var $product \Railroad\Ecommerce\Entities\UserProduct */
                                            $product = $userProduct->getProduct();
                                        @endphp

                                        @if($product->getType() !== 'physical one time')
                                            <li>{{ $product->getName() }}</li>
                                        @endif

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif($mostRecentSubscriptionCancelledOn && $activeAllContentAccessExpiryDate)

                    <div>
                        <h2>Musora Special Offer</h2>
                        @if($activeAllContentAccessExpiryDate < \Carbon\Carbon::now())
                            <p>Your subscription to Musora has been canceled and your access ended
                                on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}. Please contact support or
                                reorder on <a
                                    href="/">www.Musora.com</a> to continue your membership.</p>
                        @else
                            <p>Your subscription to Musora has been canceled and your access will be
                                removed on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}. Please contact
                                support
                                or reorder at <a
                                    href="/">www.Musora.com</a> to continue your membership.</p>
                        @endif
                    </div>

                @endif


                <!-- ============================================================================================= -->
                <!-- ================================= Subscription Info Section ================================= -->
                <!-- ============================================================================================= -->

                <div class="tw-flex tw-flex-wrap tw-border-0 tw-border-t tw-border-b tw-border-gray-300 tw-border-solid">

                    <!-- ================================= Left box ================================= -->

                    <div class="tw-flex tw-flex-col tw-w-full md:tw-w-1/2 tw-p-8 body tw-items-center tw-justify-center
                        tw-border-0 tw-border-r tw-border-gray-300 tw-border-solid tw-text-center">

                        {{-- light logo for dark-theme: https://musora-ui.s3.amazonaws.com/logos/musora-white.svg --}}
                        <img src="https://musora-ui.s3.amazonaws.com/logos/musora-black.svg" alt="Musora logo" class="w-40"
                            style="width:40%">

                        @if($isLifetime)
                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Lifetime Member</h2>
                        @elseif(!$hasHadMembership) {{-- has never had a membership --}}

                        @elseif(!$subscription)

                            @if($activeAllContentAccessExpiryDate)
                                {{-- access from non-recurring product --}}
                                Your access is ending on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}.
                            @else
                                {{-- todo: what to put here? --}}
                            @endif

                        @elseif($pausedSubscriptionStartDate)
                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Membership Paused</h2>
                            <p class="tw-text-gray-600 tw-w-full">Your membership will continue on
                                {{ $pausedSubscriptionStartDate->format('F j, Y') }} and your next renewal date has been extended
                                to {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                        @else

                            @if(!$subscription && $subscription->getPaidUntil()->gt($now))
                                {{-- expired --}}

                                <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Membership Expired</h2>

                                <p class="tw-text-gray-600 tw-w-full">Your access ended on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                {{-- Might not be totally accurate because of the difference between userproduct expiration date
                                and subscription paid-until times, but I don't know if that's universal. But this is probably fine.
                                Same for cancelled access below --}}

                            @elseif($subscription->getCanceledOn() !== null)
                                {{-- <p>default, cancelled </p>--}}
                                <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Membership Expired</h2>
                                @if($subscription->getPaidUntil()->gt($now) )
                                    <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Membership Cancelled</h2>
                                    <p class="tw-text-gray-600 tw-w-full">Your access ended on
                                        {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                @else
                                    <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Membership Cancelled</h2>
                                    <p class="tw-text-gray-600 tw-w-full">Your access is ending on
                                        {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                @endif
                            @else
                                {{-- <p>default, active </p>--}}

                                @if($subscription)
                                    @if($subscription->getIntervalType() === 'month')
                                        @if($subscription->getIntervalCount() == 2)
                                            {{-- <li>Membership (subscription is ${{ $subscriptionPriceFormatted }} every {{ $intervalCountAsWord }} months)</li>--}}
                                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Bimonthly Membership</h2>
                                            <p class="tw-text-gray-600 tw-w-full">Your membership renews every two months.</p>
                                            <p class="tw-text-gray-600 tw-w-full">The next renewal is for ${{ $subscriptionPriceFormatted }}
                                                on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                        @elseif($subscription->getIntervalCount() == 3)
                                            {{-- <li>Membership (subscription is ${{ $subscriptionPriceFormatted }} every {{ $intervalCountAsWord }} months)</li>--}}
                                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Quarterly Membership</h2>
                                            <p class="tw-text-gray-600 tw-w-full">Your membership renews every three months.</p>
                                            <p class="tw-text-gray-600 tw-w-full">The next renewal is for ${{ $subscriptionPriceFormatted }}
                                                on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                        @elseif($subscription->getIntervalCount() == 6)
                                            {{-- <li>Membership (subscription is ${{ $subscriptionPriceFormatted }} every {{ $intervalCountAsWord }} months)</li>--}}
                                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Biannual Membership</h2>
                                            <p class="tw-text-gray-600 tw-w-full">Your membership renews every six months.</p>
                                            <p class="tw-text-gray-600 tw-w-full">The next renewal is for ${{ $subscriptionPriceFormatted }}
                                                on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                        @else
                                            {{-- <li>Membership (monthly subscription)</li>--}}
                                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Monthly Membership</h2>
                                            <p class="tw-text-gray-600 tw-w-full">Your next renewal is for ${{ $subscriptionPriceFormatted }}
                                                on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                        @endif
                                    @elseif($subscription->getIntervalType() === 'year' && $subscription->getIntervalCount() == 1)
                                        <h2 class="tw-text-lg tw-mt-3 tw-mb-3">Annual Membership</h2>
                                        <p class="tw-text-gray-600 tw-w-full">Your next renewal is for ${{ $subscriptionPriceFormatted }}
                                            on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                    @else
                                        <li>Membership</li>
                                    @endif
                                @endif

                            @endif

                        @endif

                        <p class="tw-text-gray-600 tw-w-full">Thank you for being a student since {{ user()->created_at->format('F j, Y') }}.</p>

                    </div>

                    <!-- ================================= Right box ================================= -->

                    <div class="tw-flex tw-flex-col tw-w-full md:tw-w-1/2 body tw-p-8">
                        <p class="tw-font-bold">Musora membership gives you access to:</p>

                        <ul class="tw-mt-3 tw-text-gray-600 tw-space-y-1">
                            <li>Step-by-step curriculum.</li>
                            <li>Courses from legendary teachers.</li>
                            <li>Entertaining shows and documentaries.</li>
                            <li>Song breakdowns & Play-Alongs.</li>
                            <li>Live lessons and personal support.</li>
                        </ul>

                        <!-- ---------------------- How-Can-We-Help Request Link ---------------------- -->
                        @if($hasHadMembership)
                            <a href="#" class="tw-mt-3 tw-no-underline">
                                <p class="mu-modal-open" id="modal-how-can-we-help">Click here if you’d like
                                    help getting the most out of your account.</p>
                            </a>
                        @endif
                    </div>

                </div>

            <!-- ================================= Call-to-action Section ================================= -->
            {{--            <p style="size:0.8em; color:grey">(Call-to-action Section)</p> <!-- todo: remove this -->--}}
            {{--            <div style="background:lightgrey; min-height:200px; border:1px solid grey;">--}}


                <div class="body tw-p-8 tw-pt-10">

                    @if($accessIsFromAppPurchase)
                        <div class="tw-flex tw-flex-col">
                            <p class="tw-mb-2">To edit your membership please use the following guides:</p>
                            <a href="https://support.apple.com/en-us/HT202039" class="body tw-mb-2" target="_blank">
                                For Apple users</a>
                            <a href="https://support.google.com/googleplay/answer/7018481?co=GENIE.Platform%3DAndroid&hl=en"
                               class="body tw-mb-1" target="_blank">
                                For Google users
                            </a>
                        </div>

                    @elseif($pausedSubscriptionStartDate)
                        <form method="post"
                            {{-- action="{{  }}" --}} > {{-- todo: action for this --}}

                            {{ csrf_field() }}

                            <a href="#"
                               onclick="this.parentNode.submit(); return false;"
                               class="">
                                Continue Your Membership
                            </a>
                        </form>

                    @elseif(!$hasHadMembership)

                        <a href="{{ $trialUrl }}"
                           class="">
                            Start Free Trial
                        </a>

                    @elseif(!$subscription)
                        {{-- apparently same as if($mostRecentSubscriptionCancelledOn && $activeAllContentAccessExpiryDate) --}}
                        <a href="/">RENEW YOUR MEMBERSHIP</a>

                    @elseif($offerUpgradeToAnnualShowToStudent)

                        <div>
                            <button
                                class="mu-modal-open"
                                id="modal-upgrade"
                            >Upgrade
                            </button>
                        </div>

                        <div>
                            @include('account.settings.partials.cancellation.cancel-btn')
                        </div>

                        <div>
                            <p>Save with an annual plan</p>
                        </div>
                    @else
                        <div>
                        @include('account.settings.partials.cancellation.cancel-btn')
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- =================================  ================================= -->

    <h1>Legacy Video Settings</h1> <!-- ikr -->

    {{--  ================================================= MODALS ================================================= --}}

    @if($offerUpgradeToAnnualShowToStudent && $subscription->getIntervalType() === 'month')
        @component('account.settings.partials._modal', ['modalId' => 'modal-upgrade'])
            @slot('contentSlot')
                <div>
                    @if( !empty($offerUpgradeToAnnualPercentSaved) )
                        <h1>Save {{ $offerUpgradeToAnnualPercentSaved }}% with an annual plan.</h1>
                    @else
                        <h1>Save with an annual plan.</h1>
                    @endif

                    <div>
                        <h2>YOUR PLAN</h2>

                        @if($subscription->getIntervalCount() == 1)
                            <p>${{ $subscription->getTotalPrice() }} per month</p>
                            <p>= ${{ $subscription->getTotalPrice() * 12 }} per year</p>
                        @else
                            <p>${{ $subscription->getTotalPrice() }} every {{ $intervalCountAsWord }} months</p>
                            <p>= ${{ $subscription->getTotalPrice() * $annualPriceMultiplicationFactor }} per year</p>
                        @endif

                        <button class="mu-modal-close tw-cursor-pointer">KEEP THIS PLAN</button>
                    </div>

                    <div>
                        <h2>ANNUAL PLAN</h2>
                        @if( !empty($offerUpgradeToAnnualPercentSaved) )
                            <p>Save {{ $offerUpgradeToAnnualPercentSaved }}%</p>
                            <p>+ get limited time bonuses</p>
                        @else
                            <p>Get limited time bonuses</p>
                        @endif
                        <a href="">
                            <button>SEE OFFER</button>
                        </a>
                    </div>

                    <p>By completing the checkout process on the next page, your monthly billing will be stopped and
                        replaced by an annual billing plan at the posted rate.</p>
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
                    <p class="body tw-mt-6">
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
                              class="tw-mt-6 tw-rounded-lg" name="text-input"></textarea>

                    {{--<label for="email-input" class="tw-py-1 tw-mt-6 tw-block">We'll get back to you at "{{ current_user()->getEmail() }}". If you prefer a different address, please enter it here (optional):</label>--}}
                    {{--<input type="text" name="email" id="email-input" class="tw-mt-1 tw-pt-0 tw-rounded-lg"--}}
                    {{--placeholder="Email address">--}}
                </div>

                <button
                    {{--                    class="tw-uppercase tw-font-bold tw-no-underline tw-p-3 tw-pl-16 tw-pr-16 tw-text-white tw-rounded-full tw-mt-8 tw-border-0"--}}
                    class=""
                    style="cursor:pointer">
                    Send Message
                </button>
            </form>
        @endslot
    @endcomponent


    {{--    todo: DELETE THIS --- JUST FOR DEV --- DELETE THIS ANYTIME --- --}}
    {{--    todo: DELETE THIS --- JUST FOR DEV --- DELETE THIS ANYTIME --- --}}

    {{--    <div style="border:3px solid orange; margin: 20px; padding 20px; background: yellow;">--}}
    {{--        <pre>--}}
    {{--            $annualSubscriptionPrice: {{ $annualSubscriptionPrice }}--}}
    {{--            $currentMonthlySubPricePerYear: {{ $currentMonthlySubPricePerYear }}--}}
    {{--            $savingsFactor: {{ $savingsFactor }}--}}
    {{--            $savingsPercentage: {{ round($savingsPercentage) }}--}}
    {{--        </pre>--}}
    {{--    </div>--}}

    {{--    todo: DELETE THIS --- JUST FOR DEV --- DELETE THIS ANYTIME --- --}}
    {{--    todo: DELETE THIS --- JUST FOR DEV --- DELETE THIS ANYTIME --- --}}

@endsection
