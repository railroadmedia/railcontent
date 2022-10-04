@php use App\Http\Controllers\Platform\ProfileSettingsPagesController; @endphp
@extends('account.settings.layout')

@section('meta')
    <title>Profile | Musora</title>
@endsection

@section('layout-scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ mix('platform/js/profile.js') }}"></script>
    <script>
        // console.log('hooray');

        document.addEventListener('DOMContentLoaded', function() {

            // class="mu-modal-open"
            // id="modal-upgrade"

            // https://github.com/railroadmedia/drumeo/blob/master/laravel/resources/assets/members/js/profile.js#L194
            var openmodal = document.querySelectorAll('.mu-modal-open');

            console.log(openmodal.length);

            for (var i = 0; i < openmodal.length; i++) {
                openmodal[i].addEventListener('click', function(event){
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
            function openModal (event) {
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

            function closeModal (event) {
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

@section('edit-forms')
    <div id="editForm" class="tw-flex tw-flex-row">
        <div class="tw-flex tw-flex-col tw-grow">

            <h1>Access Details</h1>

            <!-- ================================= Owned products ================================= -->

            @if( !empty($userProductsDigitalAccessTypeSpecific) || $isLifetime || $subscription || $membershipFromOneTimeProduct)

                <div style="min-height:150px">
                    <h2>Your Access Levels</h2>
                    <p>Your Account includes:</p>

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
                </div>
            @elseif($mostRecentSubscriptionCancelledOn)

                <div>
                    <h2>Musora Special Offer</h2>
                    @if($activeAllContentAccessExpiryDate < \Carbon\Carbon::now())
                        <p>Your subscription to Musora has been canceled and your access ended
                            on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}. Please contact support or reorder on <a
                                href="/">www.Musora.com</a> to continue your membership.</p>
                    @else
                        <p>Your subscription to Musora has been canceled and your access will be
                            removed on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}. Please contact support or reorder on <a
                                href="/">www.Musora.com</a> to continue your membership.</p>
                    @endif
                </div>

            @endif

            <!-- ================================= Subscription Info Section ================================= -->
            <p style="size:0.8em; color:grey">(Subscription Info Section)</p> <!-- todo: remove this -->
            <div style="background:lightgrey; min-height:200px; border:1px solid grey;">


                @if($isLifetime)


                @elseif(!$hasHadMembership)


                @elseif(!$subscription)

                    @if($activeAllContentAccessExpiryDate) {{-- access from non-recurring product --}}
                        Your access is ending on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}.
                    @else
                        {{-- todo: what to put here? --}}
                    @endif

                @elseif($pausedSubscriptionStartDate)
                    <strong>Your membership is paused.</strong><br>
                    Your membership will continue on {{ $pausedSubscriptionStartDate->format('F j, Y') }} and
                    your next renewal date has been extended to {{ $subscription->getPaidUntil()->format('F j, Y') }}.
                @else



                    @if(!$subscription && $subscription->getPaidUntil()->gt($now)) {{-- expired --}}

                        Your access ended on {{ $subscription->getPaidUntil()->format('F j, Y') }}.
                        {{-- Might not be totally accurate because of the differnece between userproduct expiration date
                        and subscription paid-until times, but I don't know if that's universal. But this is probably fine.
                        Same for cancelled access below --}}

                    @elseif($subscription->getCanceledOn() !== null)
                        {{-- <p>default, cancelled </p>--}}
                        @if($subscription->getPaidUntil()->gt($now) )
                            Your access ended on {{ $subscription->getPaidUntil()->format('F j, Y') }}.
                        @else
                            Your access is ending on {{ $subscription->getPaidUntil()->format('F j, Y') }}.
                        @endif
                    @else
                        {{-- <p>default, active </p>--}}
                        Your next renewal is for ${{ $subscription->getTotalPrice() }}
                        on {{ $subscription->getPaidUntil()->format('F j, Y') }}.
                    @endif

                @endif

                <p>Thank you for being a student since {{ user()->created_at->format('F j, Y') }}.</p>

            </div>
            &nbsp; <!-- todo: remove this &nbsp-->

            <!-- ================================= Call-to-action Section ================================= -->
            <p style="size:0.8em; color:grey">(Call-to-action Section)</p> <!-- todo: remove this -->
            <div style="background:lightgrey; min-height:200px; border:1px solid grey;">


                {{-- @if($isLifetime) --}}
                {{--<p>no_action</p>--}}

                @if($accessIsFromAppPurchase)
                    <p class="tw-mb-2">To edit your membership please use the following guides:</p>
                    <a href="https://support.apple.com/en-us/HT202039" class="body tw-mb-2" target="_blank">
                        For Apple users</a>
                    <a href="https://support.google.com/googleplay/answer/7018481?co=GENIE.Platform%3DAndroid&hl=en"
                       class="body tw-mb-1" target="_blank">
                        For Google users
                    </a>

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
                {{--<p>link_to_sales</p>--}}

                @elseif($offerUpgradeToAnnualShowToStudent)

                    <button
                        class="mu-modal-open"
                        id="modal-upgrade"
                    >Ugrade</button>

                    @include('account.settings.partials.cancellation.cancel-btn')

                    <p>Save with an annual plan</p>

                @else

                    @include('account.settings.partials.cancellation.cancel-btn')

                @endif

            </div>
            &nbsp; <!-- todo: remove this &nbsp-->

            <!-- ================================= Get Help Request Link ================================= -->
            <p style="size:0.8em; color:grey">(Get Help Request Link)</p> <!-- todo: remove this -->

            @if($hasHadMembership)
                <a href="#" class="tw-mt-3 tw-no-underline">
                    <p class="mu-modal-open" id="modal-how-can-we-help">Click here if you’d like
                        help getting the most out of your account.</p>
                </a>
            @endif
            &nbsp; <!-- todo: remove this &nbsp -->


            <!-- =================================  ================================= -->

            <h1>Legacy Video Settings</h1> <!-- ikr -->

        </div>
    </div>

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
                            @endphp
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
                        <button>SEE OFFER</button>
                    </div>

                    <p>By completing the checkout process on the next page, your monthly billing will be stopped and replaced by an annual billing plan at the posted rate.</p>
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
                                <input type="radio" name="help-issue" id="{{ $label }}" value="{{ $label }}" class="tw-mr-3">
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
