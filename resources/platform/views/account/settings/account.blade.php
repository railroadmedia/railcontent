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

    <script src="https://static.rechargecdn.com/assets/storefront/recharge-client-1.12.0.min.js"></script>
    <script type="text/javascript">
        recharge.init({
            // optional when in a shopify environment
            storeIdentifier: '{{ config('shopify.domain') }}',
            // required for API access
            storefrontAccessToken: '{{ config('shopify.rechargeStoreFrontAccessToken') }}',
            // retry middleware function if/when Recharge session expires
            loginRetryFn: () => {
                return recharge.auth.loginShopifyApi(
                    '{{ config('shopify.privateAppStorefrontAccessToken') }}',
                    '{{ $shopifyCustomerAccessToken }}'
                )
                    .then(session => {
                        console.log(session);
                        return session;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
        });

        recharge.auth.loginShopifyApi(
            '{{ config('shopify.privateAppStorefrontAccessToken') }}',
            '{{ $shopifyCustomerAccessToken }}'
        )
            .then(session => {
                console.log('session');
                console.log(session);
                recharge.customer.getCustomerPortalAccess(session).then(portal => {
                    console.log(portal);
                    document.getElementById('rcPortal').src = portal.portal_url.replace('schedule', 'subscriptions');
                })
            }).catch(error => {
            console.log(error);
        });
    </script>
@endsection

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

                @if($membershipLevel !== 'none')
                    <div class="tw-flex tw-flex-col body tw-pt-0 pa-3">
                        <div
                            class="tw-flex tw-flex-row tw-flex-auto tw-py-2 tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                            <h2 class="tw-font-bold tw-text-lg dark:tw-text-white">Your Membership Access</h2>
                        </div>

                        <div
                            class="tw-flex tw-flex-row tw-flex-auto tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                            <div class="tw-flex tw-flex-col">
                                <p>{{ ucwords($membershipLevel) }} Membership</p>
                                @if( $membershipLevel == 'plus' || $membershipLevel == 'basic')
                                    <p>Valid Until: {{ $membershipExpirationDate->format('F j, Y') }}</p>
                                @elseif($membershipLevel == 'lifetime' && $isLifetimeMember == true)
                                    <p>Never Expires</p>
                                @endif
                            </div>
                        </div>
                    </div>

                @endif

                @if(!empty($allPackPermissionNames))
                    <div class="tw-flex tw-flex-col body tw-pt-0 pa-3">
                        <div
                            class="tw-flex tw-flex-row tw-flex-auto tw-py-2 tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                            <h2 class="tw-font-bold tw-text-lg dark:tw-text-white">Your Other Products</h2>
                        </div>

                        <div
                            class="tw-flex tw-flex-row tw-flex-auto tw-text-[#00101D] dark:tw-text-white tw-text-[#00101D]">
                            <div class="tw-flex tw-flex-col">
                                <ul class="tw-mt-3 tw-space-y-1 tw-list-disc tw-ml-6">
                                    @foreach($allPackPermissionNames as $product)
                                        <li>{{ $product }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                @endif


                {{-- ============================================================================================= --}}
                {{-- ================================= Subscription Info Section ================================= --}}
                {{-- ============================================================================================= --}}
                
                <div class="tw-flex tw-flex-col pa-3">
                    {{-- TEMPORARY MESSAGE --}}
                    {{-- <div class="tw-full tw-flex tw-p-4 tw-mb-4 tw-rounded-lg tw-bg-red-100 tw-text-red-800 tw-font-semibold">
                        <p>
                            Hello! 👋 We are doing a quick systems update today that will impact this page. For help with managing 
                            your subscription in the interim, please <a href="/{{$brand}}/support#contactPageApp" class="tw-underline tw-text-current">contact our support team</a>!
                        </p>
                    </div> --}}

                    {{-- Recharge iFrame --}}
                    <iframe id="rcPortal"
                            src=""
                            width=100% height=850px>
                    </iframe>
                </div>

            </div>
        </div>
    </div>

    {{-- =================================  Legacy Video Player Form ================================= --}}

    <form method="POST" action="{{ url()->route('user_management_system.user.update', ['id' => user()->id ])}}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="pa-3 tw-border-0 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57] tw-border-solid tw-w-full">
            <h3 class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 tw-text-lg tw-font-bold">Would you like to use our
                legacy video player?</h3>
            <p class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 lg:tw-max-w-[50%]">
                Our video player may have compatibility issues with older devices and operating systems. We recommend
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
            <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white sm:tw-mr-2 tw-w-full sm:tw-w-auto"
                    type="submit"> Save
            </button>
            <button
                class="tw-btn-primary tw-bg-transparent tw-text-[#00101D] dark:tw-text-white dark:hover:tw-bg-white/10 hover:tw-bg-black/10 tw-w-full sm:tw-w-auto"
                type="reset"> Cancel
            </button>
        </div>
    </form>
@endsection
