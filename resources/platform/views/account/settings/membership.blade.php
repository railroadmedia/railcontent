@extends('account.settings.layout')

@section('meta')
    <title>Account Details | Musora</title>
@endsection

@section('styles')
    <style>
        .renew-link:hover .btn span.bg-success {
            background-color: #13E868;
        }

        .mu-modal {
            transition: opacity 0.25s ease;
        }

        body.mu-modal-active {
            overflow-x: hidden;
            overflow-y: visible !important;
        }
    </style>

    @php
        $txt = 'tw-cursor-pointer text-pianote text-pianote-hover-darken tw-no-underline';
        $redBtn = 'tw-cursor-pointer bg-pianote hover:tw-bg-red-600 tw-no-underline tw-uppercase tw-font-bold tw-text-white tw-rounded-full';
        $blkBtn = 'tw-cursor-pointer tw-uppercase tw-font-bold tw-no-underline tw-bg-black hover:tw-bg-gray-900 tw-p-3 tw-pl-8 tw-pr-8 ' .
            'tw-text-white tw-rounded-full tw-mt-8 tw-text-sm mu-modal-close';
        $btnPadding = 'tw-p-3 tw-pl-16 tw-pr-16';
    @endphp

@endsection

@section('scripts')

    <script src="{{ mix('assets/members/js/profile.js') }}"></script>

@endsection

@section('edit-forms')

    <h1 class="heading tw-p-8">Account Details</h1>

    {{-- ----------------------------- --}}
    {{-- Access Levels --}}
    @if(!empty($ownedNonMembershipProducts) || $hasMembershipAccess)
        <div class="tw-flex tw-flex-col tw-p-8 tw-pt-2 body">
            <h2 class="subheading">Your Access Levels</h2>

            <p class="tw-mt-3">Your Musora Account includes:</p>
            <ul class="tw-mt-3 tw-space-y-1">
                @if($hasMembershipAccess)
                    <li>Musora Membership</li>
                @endif

                @foreach($ownedNonMembershipProducts as $product)
                    <? /** @var $product \Railroad\Ecommerce\Entities\Product */ ?>
                    @if($product->getType() !== 'physical one time')
                        <li>{{ $product->getName() }}</li>
                    @endif
                @endforeach

            </ul>
        </div>
    @endif

    @if(($membershipStatus == 'expired' || $membershipStatus == 'canceled') && !empty($membershipExpirationDate))
        <div class="body tw-p-8">

            @if($membershipExpirationDate < \Carbon\Carbon::now())
                <p>Your subscription to Musora has been canceled and your access ended
                    on {{ $membershipExpirationDate->format('F j, Y') }}. Please contact support or reorder on <a
                            href="/">www.musora.com</a> to continue your membership.</p>
            @else
                <p>Your subscription to Musora has been canceled and your access will be
                    removed on {{ $membershipExpirationDate->format('F j, Y') }}. Please contact support or reorder on <a
                            href="/">www.musora.com</a> to continue your membership.</p>
            @endif
        </div>
    @endif

    {{-- Member --}}
    @if(!empty($membershipType))
        <div class="tw-flex tw-flex-wrap tw-border-0 tw-border-t tw-border-b tw-border-gray-300 tw-border-solid">
            <div class="tw-flex tw-flex-col tw-w-full md:tw-w-1/2 tw-p-8 body tw-items-center tw-justify-center tw-border-0 tw-border-r tw-border-gray-300 tw-border-solid tw-text-center">
                <img src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png"
                     alt="Pianote logo"
                     class="tw-w-80">

                <h2 class="tw-text-lg tw-mt-3 tw-mb-3">
                    @if($membershipType == \App\Services\User\UserAccessService::$membershipStatuses['trial'] || $membershipType == \App\Services\User\UserAccessService::$membershipStatuses['non-recurring'])
                        {{ \App\Services\User\UserAccessService::isAdministrator(current_user()->getId()) ? 'Administrator' : 'Free Trial' }}
                    @elseif($membershipType == \App\Services\User\UserAccessService::$membershipStatuses['1-month'])
                        Monthly Member
                    @elseif($membershipType == \App\Services\User\UserAccessService::$membershipStatuses['6-month'])
                        6 Month Member
                    @elseif($membershipType == \App\Services\User\UserAccessService::$membershipStatuses['1-year'])
                        Annual Member
                    @elseif($membershipType == \App\Services\User\UserAccessService::$membershipStatuses['lifetime'])
                        Lifetime Member
                    @else
                        @if(!empty($subscription))
                            {{ $subscription->getIntervalCount() }} {{ ucwords($subscription->getIntervalType()) }}
                            Member
                        @else
                            Member
                        @endif
                    @endif
                </h2>

                @if ($membershipStatus == 'paused' && $membershipType != 'lifetime')
                    <p class="tw-text-gray-600 tw-w-full">
                        <strong>Your membership is paused.</strong><br>
                        Your membership will continue on {{ $userProduct->getStartDate()->format('F j, Y') }} and your
                        next renewal date has been extended to {{ $subscription->getPaidUntil()->format('F j, Y') }}.
                    </p>
                @elseif ($membershipStatus == 'active' && $membershipType != 'lifetime')
                    <p class="tw-text-gray-600 tw-w-full">
                        Your next renewal is for ${{ $subscription->getTotalPrice() }}
                        on {{ $subscription->getPaidUntil()->format('F j, Y') }}.
                    </p>
                @elseif(($membershipStatus == 'expired' || $membershipStatus == 'canceled' || $membershipStatus == 'non-recurring') &&
                        $membershipType != 'lifetime' && !empty($membershipExpirationDate))
                    <p class="tw-text-gray-600 tw-w-full">
                        @if($membershipExpirationDate < \Carbon\Carbon::now())
                            Your access ended on {{ $membershipExpirationDate->format('F j, Y') }}.
                        @else
                            Your access is ending
                            on {{ $membershipExpirationDate->format('F j, Y') }}.
                        @endif
                    </p>
                @endif

                @if ($membershipStatus !== null && $membershipStatus != 'paused')
                    <p class="tw-text-gray-600 tw-w-full">
                        Thank you for being a member since {{ current_user()->getCreatedAt()->format('F j, Y') }}.
                    </p>
                @endif

            </div>
            <div class="tw-flex tw-flex-col tw-w-full md:tw-w-1/2 body tw-p-8">
                <p class="tw-font-bold">Musora gives you access to:</p>

                <ul class="tw-mt-3 tw-text-gray-600 tw-space-y-1">
                    <li>The Method — Our Step-by-Step curriculum.</li>
                    <li>Consistent and qualified advice.</li>
                    <li>Progress tracking.</li>
                    <li>Popular song breakdowns.</li>
                    <li>Weekly live lessons and personal support.</li>
                </ul>

            </div>
        </div>
    @endif

    {{-- Trial Offer For Pack Only Users --}}
    @if(empty($membershipType))
        <div class="tw-flex tw-flex-wrap tw-border-0 tw-border-t tw-border-b tw-border-gray-300 tw-border-solid">
            <div class="tw-flex tw-flex-col tw-w-full md:tw-w-1/2 tw-p-8 body tw-items-center tw-justify-center tw-border-0 tw-border-r tw-border-gray-300 tw-border-solid">
                <img src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png"
                     alt="Musora logo"
                     class="tw-w-80">
            </div>
            <div class="tw-flex tw-flex-col tw-w-full md:tw-w-1/2 body tw-p-8">
                <p class="tw-font-bold">You’re eligible for a free 7-day trial to get:</p>

                <ul class="tw-mt-3 tw-text-gray-600 tw-space-y-1">
                    <li>Step-by-Step curriculum.</li>
                    <li>Consistent and qualified advice.</li>
                    <li>Progress tracking.</li>
                    <li>Popular song breakdowns.</li>
                    <li>Weekly live lessons and personal support.</li>
                </ul>
            </div>
        </div>
    @endif

    {{-- Buttons --}}
    <div class="body tw-p-8 tw-pt-10">
        @if($subscriptionManagedElsewhere)
            <div class="tw-flex tw-flex-col">
                <p class="tw-mb-2">To edit your membership please use the following guides:</p>
                <a href="https://support.apple.com/en-us/HT202039" class="body tw-mb-2" target="_blank">
                    For Apple users</a>
                <a href="https://support.google.com/googleplay/answer/7018481?co=GENIE.Platform%3DAndroid&hl=en"
                   class="body tw-mb-1" target="_blank">
                    For Google users
                </a>
            </div>
        @else
            @if(($membershipStatus == 'active' && $membershipType != 'lifetime' && $membershipType != '1-year') ||
                ($membershipStatus == 'non-recurring' && $membershipType != 'lifetime'))
                <a href="#"
                   class="mu-modal-open {{ $redBtn }} {{ $btnPadding }}"
                   id="modal-upgrade-to-annual">
                    Upgrade Membership
                </a>
            @endif
            @if($membershipStatus == 'canceled' || $membershipStatus == 'expired')
                <a href="/"
                   class="{{ $redBtn }} {{ $btnPadding }}">
                    Renew Your Membership
                </a>
            @endif
            @if($membershipStatus == 'paused')
                <a href="/"
                   class="{{ $redBtn }} {{ $btnPadding }}">
                    Continue Your Membership
                </a>
            @endif

            @if($membershipStatus == 'active' && ($membershipType != 'lifetime') && !$hasClaimedRetentionOfferAlready)
                @php
                    if (in_array($subscription->getProduct()->getId(), \App\Maps\ProductAccessMap::trialMembershipProductIds()) && count($subscription->getPayments()) == 0) {
                        $modalId = 'modal-extend-trial-14-days';
                    } else {
                        if ($subscription->getStartDate() > \Carbon\Carbon::now()->subDays(90)) {
                            $modalId = 'modal-free-30-days';
                        } else {
                            $modalId = 'modal-post-90-day-cancel-letter';
                        }
                    }
                @endphp

                <a href="#" id="{{ $modalId }}"
                    class="mu-modal-open tw-uppercase tw-font-bold tw-no-underline {{ $btnPadding }} {{ $txt }}">
                    Cancel Membership
                </a>
            @endif

            @if($membershipStatus == 'active' && ($membershipType != 'lifetime') && $hasClaimedRetentionOfferAlready)
                <a href="{{ url()->route('user.settings.cancel.cancel-reason-form') }}"
                    class="tw-uppercase tw-font-bold tw-no-underline {{ $btnPadding }} {{ $txt }}">
                    Cancel Membership
                </a>
            @endif

            @if(empty($membershipType))
                <a href="/trial"
                   class="{{ $redBtn }} {{ $btnPadding }}">
                    Start Free Trial
                </a>
            @endif
        @endif
    </div>

    {{-- Message --}}
    @if(!$subscriptionManagedElsewhere && $membershipType != 'lifetime')
        <div class="body tw-p-8 tw-pt-2">
            @if($membershipStatus == 'active' && $membershipType != 'lifetime' && $membershipType != '1-year')
                <p class="tw-text-gray-600 tw-italic">
                    Save {{ round(100 - (100 * (\App\Prices::$pianoteMembershipAnnualFull / (\App\Prices::$pianoteMembershipMonthlyFull * 12)))) }}% with an annual plan.
                </p>
            @elseif($membershipStatus == 'canceled' || $membershipStatus == 'expired' || $membershipStatus == 'paused')
                <p class="tw-text-gray-600 tw-italic">
                    This link will take you to reorder on <a href="/">www.musora.com</a>.
                    Any purchased access will be added to your existing
                    time. If you’d prefer, you can <a href="{{ url()->route('support.render-page') }}">click here</a> to
                    contact
                    Musora Support to restart your membership.
                </p>
            @elseif($membershipStatus == 'non-recurring')
                <p class="tw-text-gray-600 tw-italic">
                    Extend your membership beyond a trial at <a href="/">www.musora.com</a>
                </p>
            @elseif(empty($membershipType))
                <p class="tw-text-gray-600 tw-italic">
                    One time offer: 7 days free, no payment plan, starts immediately.
                </p>
            @endif
        </div>
    @endif
@endsection

@section('body-top')

    {{-- Modals --}}
    {{-- Extend Trial 14 Days  --}}
    @component('members.account.settings.partials._modal', ['modalId' => 'modal-extend-trial-14-days'])
        @slot('contentSlot')
            <h1 class="heading tw-text-center">Need more time?</h1>

            <p class="body tw-text-center tw-mt-6">
                Everyone gets busy and you may not have had enough time to watch lessons and practice.
                <strong>Extend your trial an additional 14 days</strong> on us to keep access to the best piano lessons
                in the world.
            </p>

            <form method="post"
                  action="{{ url()->route('user.settings.cancel.submit.accept-trial-extension-offer') }}">
                {{ csrf_field() }}

                <a href="#"
                   onclick="this.parentNode.submit(); return false;"
                   class="tw-block {{ $redBtn }} {{ $btnPadding }} tw-mt-8">
                    Yes, Extend My Trial
                </a>
            </form>

            <a href="{{ url()->route('user.settings.cancel.cancel-reason-form')}}"
               class="tw-uppercase tw-font-bold tw-no-underline tw-mt-6 {{ $txt }}">
                No Thanks, Cancel Membership
            </a>

        @endslot
    @endcomponent

    {{-- 30 Days Free  --}}
    @component('members.account.settings.partials._modal', ['modalId' => 'modal-free-30-days'])
        @slot('contentSlot')
            <h1 class="heading tw-text-center">Uh oh! It looks like you<br> didn’t love your lessons?</h1>

            <p class="body tw-text-center tw-mt-6">
                That’s not okay -- and we’d like a 2nd chance. Just click the “FREE MONTH” button below to keep your
                membership for one more month, totally free. Your renewal date will simply be delayed by 30 days.
            </p>

            <p class="body tw-text-center tw-mt-6">
                There’s only one catch… we’ll also quickly ask you what we can improve to hopefully give you a
                better experience in the next 30 days.
            </p>

            {{-- todo: this should immidately extend their renewal date 30 days and access and go back to the account details page with a message --}}

            <form method="post"
                  action="{{ url()->route('user.settings.cancel.submit.accept-month-extension-offer') }}">
                {{ csrf_field() }}

                <a href="#"
                   class="tw-block {{ $redBtn }} {{ $btnPadding }} tw-mt-8"
                   onclick="this.parentNode.submit(); return false;">
                    Free Month
                </a>
            </form>


            @if(!empty($subscription))
                <a href="{{ url()->route('user.settings.cancel.cancel-reason-form')}}"
                   class="tw-uppercase tw-font-bold tw-no-underline tw-mt-6 {{ $txt }}">
                    No Thanks, Cancel Membership
                </a>
            @endif
        @endslot
    @endcomponent

    {{-- How Can We Help?  --}}
    @component('members.account.settings.partials._modal', ['modalId' => 'modal-how-can-we-help'])
        @slot('contentSlot')

            {{-- todo: this should submit the normal cancel help email that goes to the person is does now and return back to the account details page with a success message --}}
            <form method="post" action="{{ url()->route('user.settings.cancel.submit.send-help-email') }}"
                  class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-relative">
                {{ csrf_field() }}

                <h1 class="heading tw-text-center">How can we help?</h1>

                <div class="tw-text-left">
                    <p class="body tw-mt-6">
                        Select any of the issues you’d like help with:
                    </p>

                    <ul class="tw-ml-3">
                        <li>
                            <input type="radio" name="help-issue" id="direction" value="direction"
                                   class="tw-mr-3 tw-mt-6">
                            <label for="direction">I need more direction</label>
                        </li>


                        <li>
                            <input type="radio" name="help-issue" id="time" value="time" class="tw-mr-3">
                            <label for="time">I don’t have enough time</label>
                        </li>


                        <li>
                            <input type="radio" name="help-issue" id="watch" value="watch" class="tw-mr-3">
                            <label for="watch">I don’t know what lesson to watch</label>
                        </li>


                        <li>
                            <input type="radio" name="help-issue" id="easy" value="easy" class="tw-mr-3">
                            <label for="easy">The lessons are too easy</label>
                        </li>


                        <li>
                            <input type="radio" name="help-issue" id="difficult" value="difficult" class="tw-mr-3">
                            <label for="difficult">The lessons are too difficult</label>
                        </li>


                        <li>
                            <input type="radio" name="help-issue" id="website" value="website" class="tw-mr-3">
                            <label for="website">I don’t know how to use the website/app.</label>
                        </li>


                        <li>
                            <input type="radio" name="help-issue" id="other" value="other" class="tw-mr-3">
                            <label for="other">Other</label>
                        </li>


                    </ul>

                    <textarea placeholder="Send your questions to a Musora teacher..."
                              class="tw-mt-6 tw-rounded-lg" name="text-input"></textarea>
                </div>

                <button
                        class="{{ $redBtn }} {{ $btnPadding }} tw-mt-8 tw-border-0">
                    Send Message
                </button>
            </form>
        @endslot
    @endcomponent

    {{-- How Can We Make The Next 30 Days Better?  --}}
    @component('members.account.settings.partials._modal', ['modalId' => 'modal-how-can-we-make-next-30-days-better'])
        @slot('contentSlot')

            <form method="post" action="{{ url()->route('user.settings.cancel.submit.feedback') }}" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-relative">
                {{ csrf_field() }}

                <input type="hidden" name="accepted-month-extension-offer" value="true">

                @if(session()->has('renewal-date'))
                    <input type="hidden" name="renewal-date" value="{{ session()->get('renewal-date') }}">
                @endif

                <p>We’ve added 30 days to your account!</p>

                <h1 class="heading tw-text-center tw-mt-4">How can we make the next 30 days better?</h1>

                <textarea placeholder="Type your feedback here..."
                          name="user-feedback"
                          class="tw-mt-6 tw-rounded-lg tw-w-full"></textarea>

                <button
                        type="submit"
                        class="{{ $redBtn }} {{ $btnPadding }} tw-mt-8 tw-border-0">
                    Send Feedback
                </button>
            </form>
        @endslot
    @endcomponent

    {{-- How Can We Make Your Musora Experience Better?  --}}
        {{-- I think this isn't used anywhere (Jonathan M, June 2021)  --}}
    @component('members.account.settings.partials._modal', ['modalId' => 'modal-how-can-we-make-your-pianote-experience-better'])
        @slot('contentSlot')

            <form method="post" action="{{ url()->route('user.settings.cancel.submit.feedback') }}"
                  class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-relative">
                {{ csrf_field() }}

                <h1 class="heading tw-text-center tw-mt-4">How can we make your Musora experience better?</h1>

                <textarea placeholder="Type your feedback here..."
                          name="user-feedback"
                          class="tw-mt-6 tw-rounded-lg tw-w-full"></textarea>

                <button
                        type="submit"
                        class="{{ $redBtn }} {{ $btnPadding }} tw-mt-8 tw-border-0">
                    Send Feedback >>
                </button>
            </form>
        @endslot
    @endcomponent

    {{-- Upgrade To Annual  --}}
    @component('members.account.settings.partials._modal', ['modalId' => 'modal-upgrade-to-annual'])
        @slot('contentSlot')
            <h1 class="heading tw-text-center">Save {{ round(100 - (100 * (\App\Prices::$pianoteMembershipAnnualFull / (\App\Prices::$pianoteMembershipMonthlyFull * 12)))) }}% with an annual plan.</h1>

            <div class="tw-flex md:tw-flex-row tw-flex-col tw-mt-10 tw-w-full">
                <div class="tw-flex tw-flex-col md:tw-w-1/2 tw-w-full tw-mr-3 tw-items-center tw-text-center tw-rounded-lg tw-bg-gray-200 tw-p-0 tw-py-8">
                    <h1 class="tw-uppercase tw-font-bold">Your <br>Plan</h1>
                    @if(!empty($subscription))
                        <p class="tw-mt-4 tw-leading-6">${{ $subscription->getTotalPrice() }} per month<br> =
                            ${{ $subscription->getTotalPrice() * 12 }} per year.</p>
                        <a href="#"
                           class="{{ $blkBtn }}">
                            Keep This Plan
                        </a>
                    @elseif(!empty($membershipExpirationDate))
                        <p class="tw-mt-4 tw-leading-6">Temporary access until
                            <br>{{ $membershipExpirationDate->format('F j, Y') }}.</p>
                        <a href="#"
                           class="{{ $blkBtn }}">
                            Keep This Plan
                        </a>
                    @else
                        <p class="tw-mt-4 tw-leading-6">Temporary access.</p>
                        <a href="#"
                           class="{{ $blkBtn }}">
                            Keep This Plan
                        </a>
                    @endif
                </div>
                <div class="tw-flex tw-flex-col md:tw-w-1/2 tw-w-full tw-ml-3 tw-items-center tw-text-center tw-rounded-lg tw-border-red-500 hover:tw-border-red-600 tw-border-2 tw-border-solid tw-p-3 tw-py-8">
                    <h1 class="tw-uppercase">Annual <br>Plan</h1>
                    <p class="tw-mt-4 tw-leading-6">Save {{ round(100 - (100 * (\App\Prices::$pianoteMembershipAnnualFull / (\App\Prices::$pianoteMembershipMonthlyFull * 12)))) }}%<br>+ get limited time
                        bonuses.
                    </p>
                    <a href="/#orderNow"
                       class="{{ $redBtn }} {{ $btnPadding }} tw-mt-8 tw-text-sm">
                        See Offer
                    </a>
                </div>
            </div>

            <p class="body tw-text-center tw-mt-10">
                By completing the checkout process on the next page, your monthly billing will be stopped and replaced
                by an annual billing plan at the posted rate.
            </p>
        @endslot
    @endcomponent

    {{-- Post 90 Days Cancel Letter --}}
    @component('members.account.settings.partials._modal', ['modalId' => 'modal-post-90-day-cancel-letter'])
        @slot('contentSlot')
            <h1 class="heading tw-text-center">Uh oh! We’re here to help.</h1>

            <div class="tw-text-left tw-leading-6">
                <p class="mt-4">
                    When you joined Musora, you made a decision to improve your skills. You were likely excited and
                    gained a new sense of energy and inspiration. Take a moment to reflect on what happened since then.
                </p>

                <p class="mt-2">
                    Are you practicing less? Do you feel like you’ve hit a wall? Are you not sure what to practice next?
                </p>

                <p class="mt-2">
                    We’re committed to helping musicians reach their goals, so before you cancel your membership
                    I wanted to see if there’s any way we can help.
                </p>

                <p class="mt-2">
                    My advice: Don’t give up.</p>

                <p class="mt-2">
                    The biggest difference between successful and unsuccessful musicians is the quality and quantity of
                    action they take. By asking us for help, we’ll do our best to get you back on track towards your
                    biggest and smallest musical goals. Just click the button to reach out.
                </p>

                <p class="mt-2">
                    To Your Musical Success,
                </p>

                <div class="tw-flex tw-flex-row tw-mt-6">

                    <img
                            src="https://musora.com/cdn-cgi/image/width=100,height=100,quality=80/https://d2vyvo0tyx8ig5.cloudfront.net/avatars/149630_1609278320825-1609278322-149630.jpg"
                            class="rounded"
                            alt="Lisa Witt Portrait">

                    <img
                            src="https://musora.com/cdn-cgi/image/width=100,height=100,quality=80/https://d1923uyy6spedc.cloudfront.net/jared-sig.jpg"
                            alt="Lisa Witt Portrait"
                            class="tw-ml-6 tw-mt-4 tw-h-16">

                    <p class="tw-mt-10 tw-ml-6"> - Lisa Witt</p>
                </div>
            </div>

            {{-- this needs to close the current modal, then open the how can we help one --}}
            <a href="#"
               class="mu-close-modal-then-open-how-can-we-help {{ $redBtn }} {{ $btnPadding }} tw-mt-8 tw-text-sm">
                Yes, Please Help
            </a>

            @if(!empty($subscription))
                <a href="{{ url()->route('user.settings.cancel.cancel-reason-form')}}"
                   class="tw-uppercase tw-font-bold tw-no-underline tw-mt-6 {{ $txt }} tw-text-sm">
                    No Thanks, Cancel Membership
                </a>
            @endif
        @endslot
    @endcomponent
@endsection