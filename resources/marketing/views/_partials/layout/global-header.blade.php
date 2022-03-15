<header class="flex-none z-40">  

    <!-- Nav -->
    @include('_partials.layout._top-nav', [
        "logo" => $logo,
        "theme_bg" => $theme_bg,
    ])

    <!-- Sidebar -->
    @include('_partials.layout._sidebar', [
        "theme_text" => $theme_text,
        "links" => $links,
    ])

</header>
