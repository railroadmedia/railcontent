<aside id="navSideBar" 
       x-cloak
       class="fixed w-80 right-0 top-14 h-[calc(100vh-56px)] bg-white border-l border-gray-200 transition duration-300 ease-in-out"
       x-bind:class="sidebarOpen? 'translate-x-0' : 'translate-x-full'"
>
    <section id="pageLinks" class="flex flex-col">
        @foreach($links as $page => $info)
            @if(!empty($info['children']))
                @include('_partials.layout._secondary-nav-link', [
                    "page" => $page,
                    "theme_text" => $theme_text,
                    "iconClass" => $info['iconClass'],
                    "children" => $info['children'],
                ])
            @else
                @include('_partials.layout._nav-link', [
                    "page" => $page,
                    "iconClass" => $info['iconClass'],
                    "url" => $info['url'],
                    "theme_text" => $theme_text,
                    "greyed" => $info['greyed'] ?? false,
                ])
            @endif
        @endforeach
        <div class="flex flex-col"></div>
    </section>
</aside>