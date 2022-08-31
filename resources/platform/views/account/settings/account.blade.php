@extends('account.settings.layout')

@section('meta')
    <title>Profile | Musora</title>
@endsection

@section('layout-scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ mix('platform/js/profile.js') }}"></script>
@endsection

@section('edit-forms')
    <div id="editForm" class="tw-flex tw-flex-row">
        <div class="tw-flex tw-flex-col tw-grow">

            <h1>Access Details</h1>

            <!-- ================================= Owned products ================================= -->

            @if( !empty($userProductsDigitalAccessTypeSpecific) || $isLifetime || $subscription)

                <div style="min-height:150px">
                    <h2>Your Access Levels</h2>
                    <p>Your Account includes:</p>

                    @if($isLifetime)
                        <li>Lifetime Membership</li>
                    @elseif($subscription)
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


                @elseif($pausedSubscriptionStartDate)
                    <strong>Your membership is paused.</strong><br>
                    Your membership will continue on {{ $pausedSubscriptionStartDate->format('F j, Y') }} and
                    your next renewal date has been extended to {{ $subscription->getPaidUntil()->format('F j, Y') }}.
                @else


                    @if($activeAllContentAccessExpiryDate && !$subscription) {{-- access from non-recurring product --}}

                        Your access is ending on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}.

                    @elseif(!$subscription && $subscription->getPaidUntil()->gt($now)) {{-- expired --}}

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
            &nbsp; <!-- todo: remove this -->

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

                @else


                    <a href="{{-- {{ url()->route('crux.cancel-reason-form') }} --}}" /> {{-- todo: action for this --}}
                        Cancel Membership
                    </a>

                @endif

            </div>
            &nbsp; <!-- todo: remove this -->

            <!-- ================================= Get Help Request Link ================================= -->
            <p style="size:0.8em; color:grey">(Get Help Request Link)</p> <!-- todo: remove this -->

            @if($hasHadMembership)
                <a href="#" class="tw-mt-3 tw-no-underline">
                    <p class="mu-modal-open text-{{ $brand }}" id="modal-how-can-we-help">Click here if you’d like
                        help getting the
                        most out of your account.</p>
                </a>
            @endif
            &nbsp; <!-- todo: remove this -->


            <!-- =================================  ================================= -->

            <h1>Legacy Video Settings</h1> <!-- ikr -->

        </div>
    </div>
@endsection
