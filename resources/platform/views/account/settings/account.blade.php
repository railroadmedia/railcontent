{{-- @php use App\Http\Controllers\Platform\ProfileSettingsPagesController; @endphp
@extends('account.settings.layout')

@section('meta')
    <title>Profile | Musora</title>
@endsection

@section('layout-scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/samk94ixqjb345m3tvofudoty51jv2qk1lk8q68vbeup3xbj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ mix('platform/js/profile.js') }}"></script>

    <script src="https://static.rechargecdn.com/assets/storefront/recharge-client-1.12.0.min.js"></script>
    <script type="text/javascript">
        recharge.init({
            // optional when in a shopify environment
            storeIdentifier: '{{ config('shopify.credentials.domain') }}',
            // required for API access
            storefrontAccessToken: '{{ config('shopify.recharge.storefront_access_token') }}',
            // retry middleware function if/when Recharge session expires
            loginRetryFn: () => {
                return recharge.auth.loginShopifyApi(
                    '{{ config('shopify.storefront.access_token') }}',
                    '{{ $shopifyCustomerAccessToken }}'
                )
                    .then(session => {
                        return session;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
        });

        recharge.auth.loginShopifyApi(
            '{{ config('shopify.storefront.access_token') }}',
            '{{ $shopifyCustomerAccessToken }}'
        )
        .then(session => {
            recharge.customer.getCustomerPortalAccess(session)
            .then(portal => {
                document.getElementById('rcPortal').src = portal.portal_url.replace('schedule', 'subscriptions');
            })
            .catch(error => {
                document.getElementById('rcPortalContainer').remove();
            })

        }).catch(error => {
            console.log(error);
        });
    </script>

    <script>
        const saveLegacyPlayerOption = (form) => {
            window.shownotification({
                icon: 'check',
                text: 'Legacy Player option saved successfully!',
            });

            setTimeout(() => {
                document.getElementById("legacy-form").submit();
            }, 500);
        }
    </script>
@endsection

@section('edit-forms')

    <form id="legacy-form" method="POST" action="{{ url()->route('user_management_system.user.update', ['id' => user()->id ])}}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="pa-3 tw-border-0 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57] tw-border-solid tw-w-full">
            <h3 class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 tw-text-lg tw-font-bold">Would you like to use our
                legacy video player?</h3>
            <p class="tw-text-[#00101D] dark:tw-text-white tw-mb-2 lg:tw-max-w-[50%]">
                Our video player may have compatibility issues with older devices and operating systems. We recommend
                switching to our legacy video player if you are experiencing playback issues.
            </p>
            <div class="tw-flex tw-flex-row tw-mt-3">
                @include('partials.bladesora.members.inputs.toggle-input', [
                    "inputID" => "useLegacyPlayer",
                    "inputName" => "use_legacy_video_player",
                    "inputLabel" => "Use legacy video player.",
                    "checked" => (boolean) user()->use_legacy_video_player ?? false,
                    "submitOnChange" => true,
                ])
            </div>
        </div>
    </form>

    <delete-account-modal></delete-account-modal>

@endsection --}}

@extends('partials.layout')

@section('meta')
    <title>Account Details | Musora</title>
@endsection

@section('content')
    {{-- <p class="tw-text-white">{{ json_encode($allPackPermissionNames) }}</p> --}}
    {{-- Acount Details Page Component --}}
    <account-details
        :user-packs="{{json_encode($allPackPermissionNames) }}"
        store-identifier="{{ config('shopify.credentials.domain') }}"
        recharge-storefront-access-token="{{ config('shopify.recharge.storefront_access_token') }}"
        storefront-access-token="{{ config('shopify.storefront.access_token') }}"
        customer-access-token="{{ $shopifyCustomerAccessToken }}"
    ></account-details>
@endsection
