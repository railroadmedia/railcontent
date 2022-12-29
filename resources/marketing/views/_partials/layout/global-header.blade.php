<header class="flex-none z-40">  

    <!-- Nav -->
    @include('_partials.layout._top-nav', [
        "emptyPromoVersion" => $emptyPromoVersion,
        "logo" => $logo,
        "links" => $nav_links,
    ])

    <!-- Sidebar -->
    @include('_partials.layout._sidebar', [
        "links" => $sidebar_links,
    ])

</header>
