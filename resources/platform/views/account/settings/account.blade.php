@extends('account.settings.layout')

@section('meta')
    <title>Profile | Musora</title>
@endsection

@section('layout-scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ mix('platform/js/profile.js') }}"></script>
@endsection

@section('edit-forms')
    <div id="editForm" class="tw-flex tw-flex-row">
        <div class="tw-flex tw-flex-col tw-grow">

            <h1>Access Details</h1>

            <!-- ================================= Owned products ================================= -->

            <h2>Your Access Levels</h2>
            <p>Your Account includes:</p>

            @if($isLifetime)
                <li>Lifetime Membership</li>
            @elseif($membershipSubscription)
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


            <!-- ================================= Subscription Info Section ================================= -->

            <b>Subscription Info Section</b> <!-- todo: remove this -->

            <p>Thank you for being a student since {{ user()->created_at->format('F j, Y') }}.</p>
            @if($isLifetime)
                {{-- <p>lifetime_msg</p>--}}
                <p>Thank you for being a student since {{ user()->getCreatedAt()->format('F j, Y') }}.</p>

            @elseif(!$hasHadMembership)
                {{-- <p>logo_only</p>--}}

            @elseif($subscriptionIsPaused)
                {{-- <p>paused_msg</p>--}}
                <p>Thank you for being a student since {{ user()->getCreatedAt()->format('F j, Y') }}.</p>

            @else
                {{-- <p>default </p>--}}
                <p>Thank you for being a student since {{ user()->getCreatedAt()->format('F j, Y') }}.</p>

            @endif

            &nbsp; <!-- todo: remove this -->

            <!-- ================================= Call-to-action Section ================================= -->

            <b>Call-to-action Section</b> <!-- todo: remove this -->

            @if($isLifetime)
            {{--<p>no_action</p>--}}

            @elseif($accessIsFromAppPurchase)
            {{--<p>app_subscription_links</p>--}}

            @elseif($subscriptionIsPaused)
            {{--<p>unpause_btn</p>--}}

            @elseif(!$hasHadMembership)
            {{--<p>trial_offer</p>--}}

            @elseif(!$membershipSubscription)
            {{--<p>link_to_sales</p>--}}

            @else
            {{--<p>standard</p>--}}

            @endif

            &nbsp; <!-- todo: remove this -->

            <!-- ================================= Get Help Request Link ================================= -->

            <b>Get Help Request Link</b> <!-- todo: remove this -->

            @if($hasHadMembership)
                <p>DO show</p>
            @else
                <p>do NOT show</p>
            @endif

            &nbsp; <!-- todo: remove this -->
            &nbsp; <!-- todo: remove this -->


            <!-- =================================  ================================= -->

            <h1>Legacy Video Settings</h1> <!-- ikr -->

        </div>
    </div>
@endsection
