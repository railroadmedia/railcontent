@extends('partials.layout')

@section('meta')
    <title>Account Details | Musora</title>
@endsection

@section('content')
    {{-- Acount Details Page Component --}}
    <account-details
        :user-packs="{{ json_encode($allPackPermissionNames) }}"
        store-identifier="{{ config('shopify.credentials.domain') }}"
        recharge-storefront-access-token="{{ config('shopify.recharge.storefront_access_token') }}"
        storefront-access-token="{{ config('shopify.storefront.access_token') }}"
        customer-access-token="{{ $shopifyCustomerAccessToken }}"
    ></account-details>
@endsection
