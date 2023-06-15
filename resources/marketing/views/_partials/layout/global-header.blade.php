<header class="flex-none z-[99]">
    <!-- Nav -->
    @include('_partials.layout._top-nav', [
        "logo" => $logo,
    ])

    <!-- Sidebar -->
    @include('_partials.layout._sidebar', [
        "links" => $links,
    ])

</header>
