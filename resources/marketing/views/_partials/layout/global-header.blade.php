<header class="flex-none z-40">  

    <!-- Nav -->
    @if(!$emptyPromoVersion)
        @include('_partials.layout._top-nav', [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
            "logo" => $logo,
            "links" => $nav_links,
            "cartVersion" => false,
            "checkoutVersion" => false,
        ])
    @else
        @include('_partials.layout._top-nav', [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "cartVersion" => false,
            "checkoutVersion" => false, 
            "logo" => $logo,
            "links" => $nav_links,
        ])
    @endif

    <!-- Sidebar -->
    @include('_partials.layout._sidebar', [
        "links" => $sidebar_links,
    ])

</header>
