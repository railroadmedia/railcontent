@extends('account.settings.layout')

@section('meta')
    <title>Payments | Singeo</title>
@endsection

@section('styles')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('layout-scripts')
    @parent

    <script src="{{ mix('assets/members/js/profile.js') }}"></script>
@endsection

@section('edit-forms')
    <div id="payment-methods-section">
        <div class="flex flex-row pa-3 flex-auto bb-grey-1-1">
            <h1 class="heading">Payment Details</h1>
        </div>

        <div class="flex flex-row ph-3 mb-3">
            <payment-methods
                theme-color="singeo"
                :payment-methods="{{ $paymentMethodsJson }}"
                brand="singeo"
                stripe-publishable-key="{{ $stripePublishableKey }}"
                :countries="{{ $countries }}"
                :provinces="{{ $provinces }}"
                :cart="{{ $cartJson }}"
                :has-subscription="{{ json_encode(!empty($currentSubscription)) }}"
                :is-active="{{ json_encode($existingSubscriptionActive) }}"
                :user-id="{{ auth()->id() }}"
            />
        </div>
    </div>

    {{-- todo: remove this test code --}}
    @if(!empty($currentSubscription) && !$existingSubscriptionActive)
        {{-- show charge immediately checkbox and totals--}}
    @endif

    @if(!empty($currentSubscription) && $existingSubscriptionActive)
        {{-- do not show the checkbox, and also hide the payment totals since they will not be charged right away--}}
    @endif

    @if(empty($currentSubscription))
        {{-- do not show the checkbox, and also hide the payment totals since they will not be charged right away--}}
    @endif

    @if(!empty($currentSubscription))
        {{-- show a message like "all your subscriptions will be set to charge your updated payment method"
        somewhere so its clear this will be their primary method from now on--}}
    @endif

    <div class="flex flex-row pa-3 flex-auto bt-grey-1-1">
        <div class="flex flex-column">
            <div class="flex flex-row mb-3">
                <h4 class="subheading">Payment History</h4>
            </div>
            @if($payments)
                @foreach($payments as $payment)
                    <a href="{{ url()->route('members.payment-invoice', $payment->getId()) }}"
                       class="flex flex-row flex-wrap mb-1 text-black no-decoration"
                       target="_blank">
                        <div class="flex flex-column xs-12 md-6">
                            <div class="flex flex-row">
                                <p class="tiny font-bold">
                                    <i class="fal fa-file-pdf mr-1"></i>
                                    {{ Carbon\Carbon::parse($payment->getCreatedAt())->format('F j, Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-column xs-12 md-6">
                            <div class="flex flex-row">
                                <div class="flex flex-column x-tiny font-italic uppercase align-h-left xs-6">
                                    @if (!empty($payment->getPaymentMethod()) &&
                                    !empty($payment->getPaymentMethod()->getMethod()) &&
                                    $payment->getExternalProvider() == 'stripe')
                                        {{ $payment->getPaymentMethod()->getMethod()->getCompanyName() }} -
                                        {{ $payment->getPaymentMethod()->getMethod()->getLastFourDigits() }}
                                    @else
                                        {{ $payment->getExternalProvider() == 'paypal' ? 'PayPal' : 'Other' }}
                                    @endif

                                </div>
                                <div class="flex flex-column x-tiny font-italic uppercase align-h-center xs-3">
                                    {{ $payment->getType() }}
                                </div>
                                <div class="flex flex-column x-tiny font-italic uppercase align-h-right xs-3">
                                    &#36;{{ money_format('%i', $payment->getTotalPaid()) }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <p class="body">You do not have any payments in your payment history.</p>
            @endif
        </div>
    </div>
@endsection