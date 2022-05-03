@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Update Payment Info | Musora</title>
@stop()

@section('styles')
    <style>
        #formLoading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            width: 480px;
            z-index: 105;
        }
        .form-group .stripe-element-container.focus ~ label,
        .form-group .stripe-element-container.populated ~ label {
            color: #f61a30;
            -webkit-transform: scale(.7) translateY(-10px);
            transform: scale(.7) translateY(-10px);
        }
        .stripe-element-container.error {
            border: 1px solid #F00;
        }
        .stripe-element-container .stripe-element-error {
            display: none;
        }
        .stripe-element-container.error .stripe-element-error {
            color: #F00;
            display: inline-block;
        }
    </style>
@stop()

@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var paymentMethodForm = document.getElementById('paymentMethodForm');
            var detailsSentToStripe = false;
            var paypalToken = document.getElementById('paypal-express-checkout-token');
            var typeSelector = document.getElementById('paymentType');
            var radioInputs = document.querySelectorAll('input[type="radio"]');
            var formErrors = document.getElementById('formErrors');
            var stripePublishableKey = document.getElementById('stripe-publishable-key').value;
            var loadingAnimation = document.getElementById('formLoading');

            var stripe = Stripe(stripePublishableKey);

            var elements = stripe.elements({
                fonts: [
                    {
                        cssSrc: 'https://fonts.googleapis.com/css?family=Open+Sans:400'
                    }
                ]
            });
            var style = {
                base: {
                    fontFamily: '"Open Sans", sans-serif',
                    fontSize: '16px',
                    fontStyle: 'normal',
                    fontWeight: 400,
                    fontVariant: 'normal',
                    color: '#0d0d0d',
                    lineHeight: '1.5em',
                    '::placeholder': {
                        color: '#fff',
                    },
                },
            };

            var completed = {
                cardNumber: false,
                cardExpiry: false,
                cardCvc: false
            };

            var empty = {
                cardNumber: true,
                cardExpiry: true,
                cardCvc: true
            };

            var touched = {
                cardNumber: false,
                cardExpiry: false,
                cardCvc: false
            };

            var ids = {
                cardNumber: 'card-number',
                cardExpiry: 'card-expiry',
                cardCvc: 'card-cvc',
            };

            var errors = {
                cardNumber: 'INVALID CARD NUMBER.',
                cardExpiry: 'INVALID DATE',
                cardCvc: 'INVALID CVV/CVC'
            };

            function elementsChangeHandler(payload) {
                completed[payload.elementType] = payload.complete;
                empty[payload.elementType] = payload.empty;

                removeElementContainerClass(ids[payload.elementType], 'error');

                if (!touched[payload.elementType]) {
                    touched[payload.elementType] = true;
                }

                if (payload.empty) {
                    removeElementContainerClass(ids[payload.elementType], 'populated');
                } else {
                    addElementContainerClass(ids[payload.elementType], 'populated');
                }
            }

            function elementsBlurHandler(payload) {

                removeElementContainerClass(ids[payload.elementType], 'focus');

                if (touched[payload.elementType] && !completed[payload.elementType]) {
                    addElementContainerClass(ids[payload.elementType], 'error');
                }
            }

            function elementsFocusHandler(payload) {
                addElementContainerClass(ids[payload.elementType], 'focus');
            }

            function validateElements() {
                var key, valid = true;

                for (key in touched) {
                    touched[key] = true;
                }

                for (key in completed) {
                    if (!completed[key]) {
                        valid = false;

                        addElementContainerClass(ids[key], 'error');
                    }
                }

                return valid;
            }

            function addElementContainerClass(elementId, className) {
                document.getElementById(elementId).parentElement.classList.add(className);
            }

            function removeElementContainerClass(elementId, className) {
                document.getElementById(elementId).parentElement.classList.remove(className);
            }

            function showFormError(error) {
                detailsSentToStripe = false;

                var errorMessage = document.createElement('li');
                errorMessage.classList.add('mb-2');
                errorMessage.innerHTML = error;

                formErrors.appendChild(errorMessage);

                errorMessage = null;

                loadingAnimation.classList.add('hide');
            }

            var cardNumber = elements.create('cardNumber', {style: style});
            cardNumber.mount('#card-number');
            cardNumber.on('change', elementsChangeHandler);
            cardNumber.on('focus', elementsFocusHandler);
            cardNumber.on('blur', elementsBlurHandler);

            var cardExpiry = elements.create('cardExpiry', {style: style});
            cardExpiry.mount('#card-expiry');
            cardExpiry.on('change', elementsChangeHandler);
            cardExpiry.on('focus', elementsFocusHandler);
            cardExpiry.on('blur', elementsBlurHandler);

            var cardCvc = elements.create('cardCvc', {style: style});
            cardCvc.mount('#card-cvc');
            cardCvc.on('change', elementsChangeHandler);
            cardCvc.on('focus', elementsFocusHandler);
            cardCvc.on('blur', elementsBlurHandler);

            if (paypalToken) {
                paymentMethodForm.submit();
            }

            paymentMethodForm.addEventListener('submit', function (event) {
                if (!detailsSentToStripe && !paypalToken && typeSelector.value !== 'paypal') {
                    event.preventDefault();
                    event.stopPropagation();

                    loadingAnimation.classList.remove('hide');

                    for (var i = 0; i < formErrors.childNodes.length; i++) {
                        formErrors.removeChild(formErrors.childNodes[i]);
                    }

                    stripe
                        .createToken(cardNumber)
                        .then(function(result) {
                            if (result && result.token && result.token.id) {

                                var token = result.token.id;
                                var tokenInput = document.createElement('input');

                                tokenInput.setAttribute('type', 'hidden');
                                tokenInput.setAttribute('name', 'card-token');
                                tokenInput.value = token;

                                paymentMethodForm.appendChild(tokenInput);

                                detailsSentToStripe = true;

                                paymentMethodForm.submit();

                            } else {
                                // could not reach this block with current stripe test credit cards that generate errors
                                console.log("stripe result with no token id: %s", JSON.stringify(result));
                                showFormError('Received an unexpected response from our payment processor, please refresh the page and try again');
                            }
                        })
                        .catch(function(error) {
                            // could not reach this block with current stripe test credit cards that generate errors
                            console.log("stripe error: %s", JSON.stringify(error));
                            showFormError('Received an unexpected response from our payment processor, please refresh the page and try again');
                        });
                }
            });

            typeSelector.addEventListener('change', function (event) {
                var paypalFields = document.querySelectorAll('.paypal-fields');
                var ccFields = document.querySelectorAll('.credit-card-fields');
                if (event.target.value === 'paypal') {
                    for (var i = 0; i < paypalFields.length; i++) {
                        paypalFields[i].classList.remove('hide');
                    }
                    for (var x = 0; x < ccFields.length; x++) {
                        ccFields[x].classList.add('hide');
                    }
                } else {
                    for (var y = 0; y < paypalFields.length; y++) {
                        paypalFields[y].classList.add('hide');
                    }
                    for (var z = 0; z < ccFields.length; z++) {
                        ccFields[z].classList.remove('hide');
                    }
                }
            });

            for (var i = 0; i < radioInputs.length; i++) {
                radioInputs[i].addEventListener('change', function (event) {
                    var priceId = 'price' + event.target.value;
                    var totalPrice = document.getElementById(priceId).value;

                    document.getElementById('totalPrice').innerHTML = totalPrice;
                });
            }
        });
    </script>
@stop()

@section('content')
    @include('members.partials._content-sidebar')

    @component('bladesora::members.partials._page-header', [
    "themeColor" => $brand,
    "pageTitle" => $existingSubscriptionActive ? 'Edit Payment Method' : 'Your Subscription has Expired',
    "backgroundImage" => 'https://singeo.s3.amazonaws.com/singeo-header-image.jpg',
    "pageDescription" => $existingSubscriptionActive ? "Edit your payment subscription details below." : "To renew your account you must update your payment details below.",
])
        @slot('interactionSlot')
            <p class="body text-white">
                <strong>Need assistance?</strong>
                Call Musora support at
                <a href="tel:1-800-439-8921" class="text-white">1-800-439-8921</a>
                or <a class="text-white" href="/support">contact us</a>
            </p>
        @endslot
    @endcomponent

    <input type="hidden" id="price1" value="{{ $monthMembershipProduct->getPrice() }}">
    <input type="hidden" id="price2" value="{{ $yearMembershipProduct->getPrice() }}">

    <div id="formLoading" class="hide">
        <div class="flex flex-column  pa-3 text-center">
            <h1 class="title">Processing Your Request</h1>
            <h6 class="body font-italic mb-2">Please Wait..</h6>
            <span class="heading">
                <i class="fas fa-spinner fa-spin text-{{ $brand }}"></i>
            </span>
        </div>
    </div>

    {{-- todo: remove this test code --}}
    @if(!empty($currentSubscription) && !$existingSubscriptionActive)
{{--        show charge immediately checkbox and totals--}}
    @endif

    @if(!empty($currentSubscription) && $existingSubscriptionActive)
{{--        do not show the checkbox, and also hide the payment totals since they will not be charged right away--}}
    @endif

    @if(empty($currentSubscription))
{{--        do not show the checkbox, and also hide the payment totals since they will not be charged right away--}}
    @endif

    @if(!empty($currentSubscription))
{{--        show a message like "all your subscriptions will be set to charge your updated payment method" somewhere so its clear this will be their primary method from now on--}}
    @endif

    <div class="container">
        <div class="flex flex-column bg-white shadow corners-10 mv-3">
            {{--<div class="flex flex-row ph pv-3 bb-grey-1-1">--}}
            {{--<h1 class="heading">Edit Payment Method</h1>--}}
            {{--</div>--}}
            <div class="flex flex-row">
                <div class="flex flex-column pv">

                    <form method="post"
                          id="paymentMethodForm"
                          action="/">
                        {{ csrf_field() }}

                        <input name="stripe-publishable-key" id="stripe-publishable-key" type="hidden"
                               value="{{ $stripePublishableKey }}">

                        @if ($payPalExpressCheckoutToken !== null && count($errors->all()) == 0)
                            <input type="hidden"
                                   id="paypal-express-checkout-token"
                                   name="paypal-express-checkout-token" value="{{ $payPalExpressCheckoutToken }}">
                        @endif

                        @if(!empty($currentSubscription))
                            <input type="hidden" name="subscription-id" value="{{ $currentSubscription->getId() }}">
                        @endif

                        <input type="hidden" name="redirect-url" value="{{ url()->route('members.profile.settings') }}">

                        <div class="flex flex-row mb-2 ph">
                            <div class="flex flex-column">
                                @include('bladesora::members.inputs.select-input', [
                                    "brand" => $brand,
                                    "inputId" => "paymentType",
                                    "inputName" => "payment-type",
                                    "inputLabel" => "Payment Method Type",
                                    "inputValue" => !empty($payPalExpressCheckoutToken) ? 'paypal' : 'credit',
                                    "inputOptions" => ['credit', 'paypal'],
                                    "inputErrors" => [],
                                ])
                            </div>
                        </div>

                        <div class="flex flex-row mb-2 credit-card-fields {{ $payPalExpressCheckoutToken !== null ? 'hide' : '' }}">
                            <div class="flex flex-column sm-6 mb-2 ph">
                                <div class="form-group">
                                    <div class="stripe-element-container">
                                        <div id="card-number" class="stripe-element"></div>
                                        <h5 class="stripe-element-error tiny mt-1">Invalid Credit Card Number.</h5>
                                    </div>
                                    <label for="card-number" class="{{ $brand }}">Credit Card Number</label>
                                </div>
                            </div>
                            <div class="flex flex-column xs-12 sm-3 mb-2 ph">
                                <div class="form-group">
                                    <div class="stripe-element-container">
                                        <div id="card-expiry" class="stripe-element"></div>
                                        <h5 class="stripe-element-error tiny mt-1">Invalid Credit Card Expiry</h5>
                                    </div>
                                    <label for="card-expiry" class="{{ $brand }}">Credit Card Expiry</label>
                                </div>
                            </div>
                            <div class="flex flex-column xs-12 sm-3 mb-2 ph">
                                <div class="form-group">
                                    <div class="stripe-element-container">
                                        <div id="card-cvc" class="stripe-element"></div>
                                        <h5 class="stripe-element-error tiny mt-1">Invalid Credit Card CVV/CVC</h5>
                                    </div>
                                    <label for="card-cvc" class="{{ $brand }}">CVV/CVC</label>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row ph pb-2 paypal-fields {{ $payPalExpressCheckoutToken !== null ? '' : 'hide' }}">
                            <p class="body">
                                Hitting submit will redirect you to PayPal to complete your
                                order.
                            </p>
                        </div>

                        <div class="flex flex-row ph">
                            <ul id="formErrors"
                                class="body text-error list-style-none">
                                @foreach($errors->all() as $error)
                                    <li class="mb-2">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="flex flex-row ph mb-2">
                            <div class="flex flex-column align-h-right">
                                <p class="title">Tax: $'tax info'</p>

                                <p class="heading">$<span id="totalPrice">'price info'</span>
                                    USD
                                </p>
                                <p class="tiny font-italic mb-2">
                                    Due {{ $existingSubscriptionActive ? \Carbon\Carbon::parse($currentSubscription->getPaidUntil())->format('F j, Y') : "Today" }}</p>

                                <button class="btn collapse-250"
                                        type="submit">
                                    <span class="bg-{{ $brand }} text-white">
                                        Submit
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-row ph">
                            @include('bladesora::members.partials._secure-connection')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
