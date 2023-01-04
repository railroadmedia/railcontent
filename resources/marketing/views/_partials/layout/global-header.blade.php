<header class="flex-none z-40">
    <!-- Nav -->
    @if(!empty($promoVersion))
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
            "logo" => $logo,
        ])
    @endif

    <!-- Sidebar -->
    @include('_partials.layout._sidebar', [
        "links" => $links,
    ])

</header>
