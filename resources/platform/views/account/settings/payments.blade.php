@extends('account.settings.layout')

@section('meta')
    <title>Payments | Musora</title>
@endsection

@section('edit-forms')
    <div id="editForm" class="tw-flex tw-flex-col">

        {{-- Coming Soon Message --}}
        <div id="payment-methods-section">

            <div class="tw-flex tw-flex-row pa-3 tw-pb-0 tw-flex-auto">
                <h1 class="tw-text-2xl tw-tw-font-bold tw-text-[#00101D] dark:tw-text-white">Payment Details</h1>
            </div>
            
            <payment-methods
                    theme-color="drumeo"
                    :payment-methods="{{ $paymentMethodsJson }}"
                    brand="drumeo"
                    stripe-publishable-key="{{ $stripePublishableKey }}"
                    :countries="{{ $countries }}"
                    :provinces="{{ $provinces }}"
                    :cart="{{ $cartJson }}"
                    :has-subscription="{{ json_encode(!empty($currentSubscription)) }}"
                    :is-active="{{ json_encode($existingSubscriptionActive) }}"
                    :user-id="{{ $currentUser->getId() }}"
                    display-override-price="{{ $displayOverridePrice }}"
                    display-override-tax="{{ $displayOverrideTax }}"
            ></payment-methods>
        </div>

        <div class="flex flex-row pa-3 flex-auto">
            <div class="flex flex-column">
                <div class="flex flex-row mb-3">
                    <h2 class="tw-font-bold tw-text-lg tw-text-[#00101D] dark:tw-text-white">Payment History</h2>
                </div>
                @if($payments)
                    @foreach($payments as $payment)
                        <a href="{{ url()->route('platform.profile.settings.payment-invoice', [user()->id, $payment->getId()]) }}"
                           class="flex flex-row flex-wrap mb-1 text-black no-decoration"
                           target="_blank">
                            <div class="flex flex-column xs-12 md-6">
                                <div class="flex flex-row">
                                    <p class="tw-text-sm tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                                        <i class="fal fa-file-pdf mr-1"></i>
                                        {{ Carbon\Carbon::parse($payment->getCreatedAt())->format('F j, Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-column xs-12 md-6">
                                <div class="flex flex-row">
                                    <div class="flex flex-column tw-text-xs tw-italic tw-uppercase align-h-left xs-6 tw-text-[#00101D] dark:tw-text-white">
                                        @if (!empty($payment->getPaymentMethod()) &&
                                        !empty($payment->getPaymentMethod()->getMethod()) &&
                                        $payment->getExternalProvider() == 'stripe')
                                            {{ $payment->getPaymentMethod()->getMethod()->getCompanyName() }} -
                                            {{ $payment->getPaymentMethod()->getMethod()->getLastFourDigits() }}
                                        @else
                                            {{ $payment->getExternalProvider() == 'paypal' ? 'PayPal' : 'Other' }}
                                        @endif
                                    </div>
                                    <div class="flex flex-column tw-text-xs tw-italic tw-uppercase align-h-center xs-3 tw-text-[#00101D] dark:tw-text-white">
                                        {{ $payment->getType() }}
                                    </div>
                                    <div class="flex flex-column tw-text-xs tw-italic tw-uppercase align-h-right xs-3 tw-text-[#00101D] dark:tw-text-white">
                                        ${{ number_format($payment->getTotalPaid(), 2, '.') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="body tw-text-[#00101D] dark:tw-text-white">You do not have any payments in your payment history.</p>
                @endif
            </div>
        </div>

    </div>
@endsection

@section('layout-scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endsection