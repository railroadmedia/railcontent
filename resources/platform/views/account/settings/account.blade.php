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

                @if( !empty($userProductsDigitalAccessTypeSpecific) || $isLifetime || $subscription || $membershipFromOneTimeProduct)

                    <div class="tw-flex tw-flex-col body tw-pt-0 pa-3">
                        <div class="tw-flex tw-flex-row tw-flex-auto tw-py-2 tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                            <h2 class="tw-font-bold tw-text-lg dark:tw-text-white">Your Access Levels</h2>
                        </div>

                        <div class="tw-flex tw-flex-row tw-flex-auto tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                            <p class="tw-mt-3">Your account includes:</p>
                        </div>

                        <div class="tw-flex tw-flex-row tw-flex-auto tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                            <div class="tw-flex tw-flex-col">
                                <ul class="tw-mt-3 tw-space-y-1 tw-list-disc tw-ml-6">
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
                        <h2 class="tw-text-[#00101D] dark:tw-text-white">Musora Special Offer</h2>
                        @if($activeAllContentAccessExpiryDate < \Carbon\Carbon::now())
                            <p class="tw-text-[#00101D] dark:tw-text-white">Your subscription to Musora has been canceled and your access ended
                                on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}. Please contact support or
                                reorder on <a
                                    href="/">www.Musora.com</a> to continue your membership.</p>
                        @else
                            <p class="tw-text-[#00101D] dark:tw-text-white">Your subscription to Musora has been canceled and your access will be
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

                <div class="tw-flex tw-flex-wrap tw-border-0 tw-border-t tw-border-b tw-border-gray-300 dark:tw-border-[#223F57] tw-border-solid">

                    {{-- ================================= Left box ================================= --}}

                    <div class="tw-flex tw-flex-col tw-w-full md:tw-w-1/2 tw-p-8 body tw-items-center tw-justify-center
                        tw-border-0 tw-border-b md:tw-border-b-0 md:tw-border-r tw-border-gray-300 dark:tw-border-[#223F57] tw-border-solid tw-text-center">

                        <div class="tw-text-[] dark:tw-text-white tw-text-[#00101D]">
                            <svg class="tw-w-[140px] lg:tw-w-48 tw-transition tw-mx-auto" 
                                alt="Musora logo"
                                viewBox="0 0 473 80" 
                                xmlns="http://www.w3.org/2000/svg" 
                                fill-rule="evenodd" 
                                clip-rule="evenodd" 
                                stroke-linejoin="round" 
                                stroke-miterlimit="2" 
                                fill="currentColor">
                                <path d="M371.404 79.425h-20.817V0h20.759v3.567l.912-.355 2.454-.904.305-.108c.854-.304 1.72-.579 2.595-.817a36.014 36.014 0 014.555-.941l.016-.005a41.492 41.492 0 013.505-.366A41.57 41.57 0 01387.979 0h.513a39.988 39.988 0 016.391.575 39.578 39.578 0 0110.446 3.35 45.315 45.315 0 00-6.587 6.329 45.292 45.292 0 00-7.067 11.3l-.404-.062a19.526 19.526 0 00-2.096-.213 23.97 23.97 0 00-.933-.029c-.179 0-.359 0-.538.004-.354.009-.708.021-1.062.046-.654.046-1.309.125-1.955.233a20.615 20.615 0 00-5.37 1.663 7.663 7.663 0 00-.363.179 15.888 15.888 0 00-2.704 2.138c-.417.441-.825.908-1.254 1.387a15.84 15.84 0 00-2.213 3.671c-.425.987-.75 2.021-.958 3.079-.092.45-.158.9-.213 1.354l-.037.384v43.929h-.171v.108zm-347.287-.033H0V.008h24.067V2.4A35.703 35.703 0 0129.004.954a36.675 36.675 0 016.209-.808 36.939 36.939 0 0111.958 1.425 36.739 36.739 0 0114.521 8.162 37.3 37.3 0 014.783-3.696A36.53 36.53 0 0178.642.954a36.763 36.763 0 016.212-.808 36.958 36.958 0 0111.959 1.425 36.65 36.65 0 019.737 4.466 37.059 37.059 0 018.946 8.176 36.828 36.828 0 015.546 9.866 36.636 36.636 0 012.016 8.184c.13 1.004.217 2.016.263 3.029.021.475.029.946.033 1.42.046 13.709.034 28.976.021 42.68 0 .054-24.138 0-24.138 0 .046-14.2.059-28.404-.079-42.609a12.765 12.765 0 00-.145-1.779 12.374 12.374 0 00-.896-3.096 12.77 12.77 0 00-2.609-3.837 12.75 12.75 0 00-3.808-2.659 12.456 12.456 0 00-3.475-.995 12.862 12.862 0 00-5.179.362 12.666 12.666 0 00-5.25 3.021 12.687 12.687 0 00-2.792 3.9c-.462 1-.787 2.058-.967 3.146a12.682 12.682 0 00-.17 2.021c-.046 14.175-.121 28.35-.109 42.525h-.025c0 .054-24.137 0-24.137 0 .046-14.2.058-28.404-.075-42.609a14.114 14.114 0 00-.146-1.779 12.382 12.382 0 00-.9-3.096 12.713 12.713 0 00-2.608-3.837 12.808 12.808 0 00-3.804-2.659 12.55 12.55 0 00-3.476-.995 12.882 12.882 0 00-5.183.362c-1.096.313-2.15.784-3.121 1.379a12.743 12.743 0 00-2.129 1.642 12.703 12.703 0 00-2.792 3.9c-.458 1-.787 2.058-.966 3.146a13.553 13.553 0 00-.171 2.021c-.042 14.175-.121 28.35-.108 42.525zm448.862-.05h-20.758v-4.617l-.825.367-2.613 1.121c-.791.329-1.587.637-2.395.92a39.198 39.198 0 01-4.396 1.255 40.044 40.044 0 01-10.471.916 39.807 39.807 0 01-7.288-1.008 39.16 39.16 0 01-7.57-2.608 39.885 39.885 0 01-18.18-17.013 39.621 39.621 0 01-4.041-11.012 40.02 40.02 0 01-.5-12.921c.204-1.638.508-3.263.916-4.863a39.072 39.072 0 012.334-6.637 39.89 39.89 0 013.766-6.529 40.01 40.01 0 0110.675-10.267 39.542 39.542 0 015.579-3.042 39.286 39.286 0 019.809-2.908 39.35 39.35 0 016.846-.492c.496.009.987.021 1.483.046.592.029 1.183.075 1.779.129 0 0 .871.05 2.384.317V19.8a20.862 20.862 0 00-6.196-.937c-11.504 0-20.846 9.341-20.846 20.85 0 11.504 9.342 20.845 20.846 20.845 11.508 0 20.85-9.341 20.85-20.845V5.925a42.036 42.036 0 012.787 1.896 40.296 40.296 0 014.854 4.262 40.028 40.028 0 015.85 7.734 39.765 39.765 0 013.734 8.704 39.904 39.904 0 011.587 10.904c.046 13.308 0 26.613 0 39.917zM305.971 0h.512a40.062 40.062 0 016.392.575 39.495 39.495 0 019.65 2.979 39.83 39.83 0 0110.937 7.404 39.941 39.941 0 017.746 10.234 39.479 39.479 0 013.829 10.85c.851 4.371.963 8.891.33 13.3a39.48 39.48 0 01-3.509 11.521 39.942 39.942 0 01-8.396 11.52 39.88 39.88 0 01-12.262 7.984 39.983 39.983 0 01-7.471 2.241 39.78 39.78 0 01-7.758.734 39.715 39.715 0 01-7.5-.734 39.33 39.33 0 01-7.696-2.337 39.81 39.81 0 01-12.212-8.054 40.032 40.032 0 01-3.892-4.346 39.366 39.366 0 01-4.433-7.225 39.326 39.326 0 01-3.442-11.55 40.004 40.004 0 01.367-13.054 39.112 39.112 0 013.662-10.529 39.859 39.859 0 013.846-6.046 39.88 39.88 0 0115.221-12.013A39.448 39.448 0 01305.971 0zM201.429.029c-.004 14.15-.033 28.296-.033 42.442a37.255 37.255 0 01-.388 5.379 36.644 36.644 0 01-6.283 15.763 37.432 37.432 0 01-4.754 5.525 37.051 37.051 0 01-11.496 7.454 36.562 36.562 0 01-6.05 1.879 37.062 37.062 0 01-18.171-.617 36.636 36.636 0 01-9.737-4.466 37.231 37.231 0 01-8.946-8.175 36.946 36.946 0 01-5.542-9.867 36.488 36.488 0 01-2.279-11.213c-.021-.475-.033-.95-.038-1.425-.041-13.704-.033-28.971-.016-42.679 0-.05 24.133 0 24.133 0-.041 14.204-.058 28.408.079 42.613.009.595.055 1.187.146 1.779.163 1.062.463 2.108.896 3.092a12.743 12.743 0 002.612 3.841 12.731 12.731 0 003.805 2.659c1.104.495 2.275.833 3.475.995 1.725.23 3.504.113 5.179-.366 1.1-.313 2.154-.775 3.125-1.375a13.13 13.13 0 002.129-1.642 12.772 12.772 0 002.792-3.9c.458-1 .783-2.058.962-3.146.113-.671.167-1.346.171-2.021.046-14.175.121-28.354.108-42.529h24.121zm36.342-.021a69.31 69.31 0 012.233.05c1.938.084 3.875.259 5.8.534a56.04 56.04 0 014.758.891 47.07 47.07 0 014.205 1.188c1.366.462 2.708.991 4 1.625l1.191.596-5.162 18.537-1.484-.8c-.154-.083-.154-.083-.308-.162a34.83 34.83 0 00-5.083-2.1 34.57 34.57 0 00-5.729-1.371 27.128 27.128 0 00-3.184-.283c-1-.03-2.008 0-2.995.15a9.218 9.218 0 00-.759.141 7.954 7.954 0 00-.608.154 6.122 6.122 0 00-.475.155c-.125.045-.25.091-.371.141-.792.334-1.542.829-2.037 1.542a3.445 3.445 0 00-.538 1.258c-.05.242-.079.492-.092.738-.004.166-.004.329.009.496a2.857 2.857 0 00.479 1.45c.2.291.441.545.704.779.317.283.662.529 1.021.758.5.325 1.029.608 1.562.875.588.296 1.188.563 1.792.821.725.312 1.463.604 2.204.883.738.284 1.484.554 2.229.821.546.192 1.092.379 1.634.575.216.075.429.154.645.233a58.2 58.2 0 012.476.984c.633.266 1.258.545 1.879.841.504.238 1.004.488 1.5.746 2.733 1.429 5.329 3.175 7.496 5.384a21.023 21.023 0 012 2.341 20.05 20.05 0 012.824 5.404c.671 1.955 1.042 4 1.188 6.063.029.387.05.779.058 1.167.009.179.013.358.013.537.004.229 0 .458-.008.683-.009.446-.034.888-.067 1.334-.1 1.35-.313 2.696-.642 4.016a22.207 22.207 0 01-1.433 4.05 21.817 21.817 0 01-3.096 4.821 23.853 23.853 0 01-3.858 3.617 34.41 34.41 0 01-1.267.892c-3.275 2.158-6.996 3.575-10.804 4.458-.617.146-1.242.275-1.863.392-3.5.658-7.071.904-10.629.883a66.29 66.29 0 01-6.441-.363 60.57 60.57 0 01-5.188-.77 51.799 51.799 0 01-6.175-1.58 38.43 38.43 0 01-4.812-1.908 30.93 30.93 0 01-1.134-.575l-1.137-.608 5.212-20.504c.496.3.996.604 1.496.9.096.058.192.112.287.17 1.213.684 2.484 1.267 3.771 1.792a48.819 48.819 0 004.742 1.642c1.625.471 3.279.862 4.946 1.15a31.32 31.32 0 003.991.437c.55.021 1.096.025 1.646.009.63-.017 1.254-.059 1.88-.134.524-.062 1.049-.15 1.566-.266.688-.163 1.371-.384 1.996-.713a4.291 4.291 0 001.133-.812c.288-.288.517-.63.667-1.005.158-.383.233-.8.242-1.216.012-.371-.025-.746-.163-1.092-.15-.383-.421-.708-.721-.987a6.22 6.22 0 00-.583-.471 9.966 9.966 0 00-.721-.467 19.784 19.784 0 00-2.017-1.012 42.75 42.75 0 00-1.895-.775 75.43 75.43 0 00-2.505-.905c-.5-.175-1.004-.341-1.508-.512l-.537-.188a53.1 53.1 0 01-1.559-.575 49.603 49.603 0 01-4.583-2.012 38.997 38.997 0 01-4.046-2.325c-2.221-1.467-4.287-3.196-6.004-5.233a21.47 21.47 0 01-1.854-2.551 19.268 19.268 0 01-1.554-3.083 18.658 18.658 0 01-1.209-4.937 19.046 19.046 0 01-.1-1.529c-.008-.184-.008-.363-.008-.546l.004-.642c.025-1.821.25-3.633.683-5.4a22.828 22.828 0 012.075-5.392 23.41 23.41 0 012.721-3.979 24.773 24.773 0 013.288-3.221 26.66 26.66 0 012.466-1.791 29.754 29.754 0 012.259-1.313c3.75-1.962 7.887-3.121 12.079-3.65a45.232 45.232 0 015.254-.346h.642zm68.462 18.859c-.179-.004-.358 0-.537 0a22.233 22.233 0 00-3.021.279 20.757 20.757 0 00-5.367 1.662 20.996 20.996 0 00-6.183 4.421 20.944 20.944 0 00-3.667 5.196 20.637 20.637 0 00-1.841 5.567 20.936 20.936 0 00-.104 6.712 20.722 20.722 0 001.887 6.1 20.913 20.913 0 0010.833 10.134 20.78 20.78 0 004.313 1.237 21.093 21.093 0 007.871-.146 20.823 20.823 0 0010.212-5.475 20.865 20.865 0 004.275-5.979 20.723 20.723 0 001.817-6.129 21.014 21.014 0 00-.163-6.583 20.787 20.787 0 00-5.929-11.075 20.846 20.846 0 00-5.971-4.084 20.614 20.614 0 00-7.491-1.812 17.127 17.127 0 00-.934-.025z"></path>
                            </svg>
                        </div>

                        @if($isLifetime)
                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Lifetime Member</h2>
                        @elseif(!$hasHadMembership) {{-- has never had a membership --}}

                        @elseif(!$subscription)

                            @if($activeAllContentAccessExpiryDate)
                                {{-- access from non-recurring product --}}
                                Your access is ending on {{ $activeAllContentAccessExpiryDate->format('F j, Y') }}.
                            @else
                                {{-- todo: what to put here? --}}
                            @endif

                        @elseif($pausedSubscriptionStartDate)
                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D] ">Membership Paused</h2>
                            <p class="tw-text-gray-600 dark:tw-text-white tw-w-full dark:tw-text-white">Your membership will continue on
                                {{ $pausedSubscriptionStartDate->format('F j, Y') }} and your next renewal date has been extended
                                to {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                        @else

                            @if(!$subscription && $subscription->getPaidUntil()->gt($now))
                                {{-- expired --}}

                                <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Membership Expired</h2>

                                <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">Your access ended on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                {{-- Might not be totally accurate because of the difference between userproduct expiration date
                                and subscription paid-until times, but I don't know if that's universal. But this is probably fine.
                                Same for cancelled access below --}}

                            @elseif($subscription->getCanceledOn() !== null)
                                {{-- <p>default, cancelled </p>--}}
                                <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Membership Expired</h2>
                                @if($subscription->getPaidUntil()->gt($now) )
                                    <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Membership Cancelled</h2>
                                    <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">Your access ended on
                                        {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                @else
                                    <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Membership Cancelled</h2>
                                    <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">Your access is ending on
                                        {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                @endif
                            @else
                                {{-- <p>default, active </p>--}}

                                @if($subscription)
                                    @if($subscription->getIntervalType() === 'month')
                                        @if($subscription->getIntervalCount() == 2)
                                            {{-- <li>Membership (subscription is ${{ $subscriptionPriceFormatted }} every {{ $intervalCountAsWord }} months)</li>--}}
                                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Bimonthly Membership</h2>
                                            <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">Your membership renews every two months.</p>
                                            <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">The next renewal is for ${{ $subscriptionPriceFormatted }}
                                                on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                        @elseif($subscription->getIntervalCount() == 3)
                                            {{-- <li>Membership (subscription is ${{ $subscriptionPriceFormatted }} every {{ $intervalCountAsWord }} months)</li>--}}
                                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Quarterly Membership</h2>
                                            <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">Your membership renews every three months.</p>
                                            <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">The next renewal is for ${{ $subscriptionPriceFormatted }}
                                                on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                        @elseif($subscription->getIntervalCount() == 6)
                                            {{-- <li>Membership (subscription is ${{ $subscriptionPriceFormatted }} every {{ $intervalCountAsWord }} months)</li>--}}
                                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Biannual Membership</h2>
                                            <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">Your membership renews every six months.</p>
                                            <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">The next renewal is for ${{ $subscriptionPriceFormatted }}
                                                on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                        @else
                                            {{-- <li>Membership (monthly subscription)</li>--}}
                                            <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Monthly Membership</h2>
                                            <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">Your next renewal is for ${{ $subscriptionPriceFormatted }}
                                                on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                        @endif
                                    @elseif($subscription->getIntervalType() === 'year' && $subscription->getIntervalCount() == 1)
                                        <h2 class="tw-text-lg tw-mt-3 tw-mb-3 dark:tw-text-white tw-text-[#00101D]">Annual Membership</h2>
                                        <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">Your next renewal is for ${{ $subscriptionPriceFormatted }}
                                            on {{ $subscription->getPaidUntil()->format('F j, Y') }}.</p>
                                    @else
                                        <li>Membership</li>
                                    @endif
                                @endif
                            @endif
                        @endif

                        {{-- Thank You Message --}}
                        <p class="tw-text-gray-600 dark:tw-text-white tw-w-full">
                            Thank you for being a student since {{ user()->created_at->format('F j, Y') }}.
                        </p>
                        
                        {{-- Call To Action Buttons --}}
                        <div class="body tw-mt-6">
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
                                       class="tw-btn-primary tw-bg-{{ $brand }}">
                                        Continue Your Membership
                                    </a>
                                </form>
        
                            @elseif(!$hasHadMembership)
        
                                <a href="{{ $addToCartUrlTrial }}"
                                   class="tw-btn-primary tw-bg-{{ $brand }}">
                                    Start Free Trial
                                </a>
        
                            @elseif(!$subscription)
                                {{-- apparently same as if($mostRecentSubscriptionCancelledOn && $activeAllContentAccessExpiryDate) --}}
                                <a class="tw-btn-primary tw-bg-{{ $brand }} visited:tw-text-white" href="/">
                                    RENEW YOUR MEMBERSHIP
                                </a>
        
                            @elseif($offerUpgradeToAnnualShowToStudent)
        
                                <div>
                                    <button
                                        class="tw-btn-priamry tw-bg-{{ $brand }} tw-my-3 mu-modal-open"
                                        id="modal-upgrade"
                                    >
                                        Upgrade Membership To Annual
                                    </button>
                                </div>
                                <p class="tw-text-xs tw-italic tw-my-1">Save with an annual plan</p>
                                <div>
                                    @include('account.settings.partials.cancellation.cancel-btn')
                                </div>

                            @else
                                <div>
                                    @include('account.settings.partials.cancellation.cancel-btn')
                                </div>
                            @endif
        
                        </div>
                    </div>

                    {{-- ================================= Right box ================================= --}}

                    <div class="tw-flex tw-flex-col tw-w-full md:tw-w-1/2 body pa-3 ">
                        <p class="tw-font-bold dark:tw-text-white">Musora membership gives you access to:</p>

                        <ul class="tw-mt-3 tw-text-gray-600 dark:tw-text-white tw-space-y-1 tw-list-disc tw-ml-6">
                            <li>Step-by-step curriculum.</li>
                            <li>Courses from legendary teachers.</li>
                            <li>Entertaining shows and documentaries.</li>
                            <li>Song breakdowns & Play-Alongs.</li>
                            <li>Live lessons and personal support.</li>
                        </ul>

                        {{-- ---------------------- How-Can-We-Help Request Link ---------------------- --}}
                        @if($hasHadMembership)
                            <a href="#" class="tw-mt-3 body">
                                <p class="mu-modal-open tw-underline body" id="modal-how-can-we-help">Click here if you’d like
                                    help getting the most out of your account.</p>
                            </a>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- =================================  Legacy Video Player Form ================================= --}}

    <form method="POST" action="{{ url()->route('user_management_system.user.update', ['id' => user()->id ])}}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="pa-3 tw-border-0 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57] tw-border-solid tw-w-full">
            <h3 class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 tw-text-lg tw-font-bold">Would you like to use our legacy video player?</h3> 
            <p class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 lg:tw-max-w-[50%]">
                Our video player may have compatibility issues with older devices and operationg systems. We recommend 
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
            <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white sm:tw-mr-2 tw-w-full sm:tw-w-auto" type="submit"> Save </button>
            <button class="tw-btn-primary tw-bg-transparent tw-text-[#00101D] dark:tw-text-white dark:hover:tw-bg-white/10 hover:tw-bg-black/10 tw-w-full sm:tw-w-auto" type="reset"> Cancel </button>
        </div>
    </form>







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
                        <a href="{{ $salesPageUrl }}">
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
                              class="tw-mt-6 tw-rounded-lg tw-w-full" name="text-input"></textarea>

                    {{--<label for="email-input" class="tw-py-1 tw-mt-6 tw-block">We'll get back to you at "{{ current_user()->getEmail() }}". If you prefer a different address, please enter it here (optional):</label>--}}
                    {{--<input type="text" name="email" id="email-input" class="tw-mt-1 tw-pt-0 tw-rounded-lg"--}}
                    {{--placeholder="Email address">--}}
                </div>

                <button
                    {{--                    class="tw-uppercase tw-font-bold tw-no-underline tw-p-3 tw-pl-16 tw-pr-16 tw-text-white tw-rounded-full tw-mt-8 tw-border-0"--}}
                    class="tw-btn-primary tw-bg-{{ $brand }} tw-w-full tw-my-2"
                    style="cursor:pointer">
                    Send Message
                </button>
            </form>
        @endslot
    @endcomponent

@endsection
