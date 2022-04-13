@php
    /** @var $subscription Railroad\Ecommerce\Entities\Subscription */
@endphp

@extends('account.settings.layout')

@section('meta')
    <title>Membership | Singeo</title>
@endsection

@section('scripts')

    <script src="{{ mix('assets/members/js/profile.js') }}"></script>
@endsection

@section('edit-forms')
    <div id="membershipMain" class="tw-flex tw-flex-column">
        <div class="tw-flex tw-flex-row pa-3 bb-grey-1-1 tw-flex-auto">
            <h1 class="heading">Membership</h1>
        </div>


        <div class="tw-flex tw-flex-row pa-3 tw-flex-auto">
            <div class="tw-flex tw-flex-column">
                <div class="tw-flex tw-flex-row">
                    <h2 class="subheading tw-mb-3">Membership Type</h2>
                </div>

                @if(!empty($ownedProducts))
                    <div class="tw-flex tw-flex-row tw-mb-3">
                        <div class="tw-flex tw-flex-column">
                            <p class="body tw-mb-1">
                                Your account has the following Singeo products:
                            </p>
                            <ul class="body">
                                @foreach($ownedProducts as $product)
                                    <? /** @var $product \Railroad\Ecommerce\Entities\Product */ ?>
                                    @if($product->getType() !== 'physical one time')
                                        <li>{{ $product->getName() }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if(!empty($subscription))
                    <div class="tw-flex tw-flex-row">
                        <div class="tw-flex tw-flex-column">
                            @if($subscription->getIsActive())
                                <p class="body tw-mb-1">
                                    You have a
                                    <strong>{{ str_replace('subscription', 'Singeo Membership', $subscription->getType()) }}</strong>
                                    billed at
                                    <strong>${{ $subscription->getTotalPrice() }}</strong>


                                    @if($subscription->getIntervalCount() == 1)
                                        per {{ $subscription->getIntervalType() }}.
                                    @else

                                        @if($subscription->getIntervalType() === 'month')
                                            @if($subscription->getIntervalCount() == 2)
                                                every two months.
                                            @elseif($subscription->getIntervalCount() == 3)
                                                every three months.
                                            @elseif($subscription->getIntervalCount() == 6)
                                                every six months.
                                            @else
                                                every {{ $subscription->getIntervalCount() }} months.
                                            @endif
                                        @else
                                            every {{ $subscription->getIntervalCount() }} {{ $subscription->getIntervalType() }}s.
                                        @endif

                                    @endif
                                </p>
                                <p class="body tw-italic">
                                    Your membership renews on
                                    <strong>{{ Carbon\Carbon::parse($subscription->getPaidUntil())->format('F j, Y') }}</strong>.
                                </p>
                            @else
                                <p class="body tw-mb-1">
                                    Your {{ $subscription->getType() }}
                                    {{ empty($subscription->getCanceledOn()) ? 'has expired' : 'has been canceled'  }}.
                                </p>

                                @if($subscription->getPaidUntil() > Carbon\Carbon::now())
                                    <p class="body tw-italic">
                                        Your membership will end on
                                        <strong>{{ Carbon\Carbon::parse($subscription->getPaidUntil())->format('F j, Y') }}</strong>.
                                    </p>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-row mt-3 tw-flex-auto">
                        <div class="tw-flex tw-flex-column">
                            @if($subscription->getIsActive())
                                <h2 class="subheading tw-mb-2">Cancel Membership</h2>
                                <div class="tw-flex tw-flex-row">
                                    <p id="openUnsubscribeForm"
                                       class="body tw-text-black tw-underline tw-pointer">
                                        Click here to cancel your membership
                                    </p>
                                </div>
                            @else
                                <h2 class="subheading tw-mb-2">Renew Membership</h2>
                                <div class="tw-flex tw-flex-row">
                                    <a class="body text-black"
                                       href="{{ url()->route('members.profile.settings', ['section' => 'payments']) }}">
                                        Click here to renew your membership.</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="tw-flex tw-flex-row">
                        @if($isLifetime)
                            <div class="tw-flex tw-flex-column tw-mb-2">
                                <p class="body tw-mb-1">
                                    Lifetime memberships never renew or expire, you have access for life!
                                </p>
                            </div>
                        @endif

                        @if($isPackOnly)
                            <div class="tw-flex tw-flex-column tw-mb-2">
                                <p class="body">
                                    You have a Singeo Pack Membership.
                                    <a href="/#orderNow" target="_blank">Learn more about Singeo Membership.</a>
                                </p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if(!empty($subscription))
        @include('account.settings.partials._unsubscribe', [
            "subscription" => $subscription
        ])
    @endif
@endsection
