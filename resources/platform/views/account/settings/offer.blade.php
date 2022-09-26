
@extends('layout')

@section('content')

    <div class="">

        {{-- todo: musora logo --}}

        <h2 class="">Thanks for your feedback</h2>

        <p class="">We want to make sure Musora works for you. And we're here to help:</p>

        @if($isSubscriberMonthly)

            <div>
                <div>
                    <h3>Two payments on us</h3>
                </div>
                <div>
                    <div>
                        <p>Take a break from payments and save {{ $amountSaved }} PLUS keep access to
                            all your lessons</p>
                        <p>Regular:</p>
{{--                        <p style="text-decoration-line: line-through;">$19.00/mo</p>--}}
                        <p style="text-decoration-line: line-through;">${{ $subscriptionPrice }}/mo</p>
                        <p>$0.00/mo</p>
                        <p>No payment for 60 days.</p>
                        <p>Next payment will be on {{ Carbon::format($nextPaymentDate) }}</p>
                    </div>
                    @include('account.settings.partials.cancellation.continue-membership')
                </div>
            </div>

            <div>
                <div>
                    <h3>A personalized learning plan</h3>
                </div>
                <div>
                    <p>We don't want to see you go—and sometimes all you need is a nudge in the right direction.</p>
                    <p>By clicking below, you'll be connected directly with one of our instructors and receive a
                        personalized learning plan, just for you.</p>
                    @include('account.settings.partials.cancellation.accept-offer-button', [
                            'routeUrl' => 'platform.profile.settings.student-plan-offer',
                            'buttonText' => 'Get My Personalized Plan'
                        ])
                </div>
            </div>

        @elseif($isSubscriberAnnual)

            <div>
                <div>
                    <h3>Pause your account</h3>
                </div>
                <div>
                    <p>We know life gets busy. But instead of giving up your progress, pause your account and come
                        back when you're ready</p>
                    <p>Pause your account:</p>
                    @include('account.settings.partials.cancellation.pause-membership')
                </div>
            </div>

            <div>
                <div>
                    <h3></h3>
                </div>
                <div>
                    <p></p>
                    <p></p>
                    <p></p>
                    <button></button>
                </div>
            </div>

        @elseif($isSubscriberAnnualRenewingSoon)

            <div>
                <div>
                    <h3></h3>
                </div>
                <div>
                    <p></p>
                    <p></p>
                    <p></p>
                    @include('account.settings.partials.cancellation.continue-membership')
                </div>
            </div>

            <div>
                <div>
                    <h3></h3>
                </div>
                <div>
                    <p></p>
                    <p></p>
                    <p></p>
                    <button></button>
                </div>
            </div>

        @endif

        <form method="post"
{{--              action="{{ url()->route('platform.profile.settings.student-plan-offer') }}"--}}
{{--              action="{{ url()->route('platform.profile.settings.switch-to-monthly') }}"--}}
{{--              action="{{ url()->route('platform.profile.settings.gratis-access') }}"--}}
              id="cancel-reason-form"
              class="tw-flex tw-flex-col tw-flex-grow">

            {{ csrf_field() }}
                <button
                    type="submit"
                    class=""
                    style="cursor: pointer">
                    Finish Cancelling
                </button>

        </form>

    </div>

@endsection
