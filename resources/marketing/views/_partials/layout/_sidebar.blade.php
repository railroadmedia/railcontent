<aside id="navSideBar" 
       x-cloak
       class="z-[1000] fixed w-80 right-0 top-10 md:top-14 h-[calc(100vh-40px)] md:h-[calc(100vh-56px)] bg-white border-l border-gray-200 shadow-lg transition duration-300 ease-in-out"
       x-bind:class="sidebarOpen? 'translate-x-0' : 'translate-x-full'"
>
    <!-- Sidebar Links -->
    <section id="pageLinks" class="flex flex-col">
        @foreach($links as $page => $info)
            @if(!empty($info['children']))
                @include('_partials.layout._sidebar-dropdown', [
                    "page" => $page,
                    "iconClass" => $info['iconClass'],
                    "children" => $info['children'],
                ])
            @else
                @include('_partials.layout._sidebar-link', [
                    "page" => $page,
                    "iconClass" => $info['iconClass'],
                    "url" => $info['url'],
                    "greyed" => $info['greyed'] ?? false,
                ])
            @endif
        @endforeach
        <div class="flex flex-col"></div>
    </section>
    <!-- Social Links -->
    @if( @isset($external_links) )
        <section class="pt-1">
            <ul class="py-3 px-5">
                @foreach($external_links as $page => $info)
                    <li class="mb-1">
                        <a href="{{ $info['url'] }}" 
                            @if(@isset($info['target']))
                                target="{{$info['target']}}"
                            @else
                                target="_blank" 
                            @endif 
                            class="text-sm text-black"
                        >
                            <i class="{{ $info['iconClass'] }} mr-1 @if(@isset($info['themeClass'])){{$info['themeClass']}}@endif" aria-hidden="true"></i>
                            {{ $page }} 
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

</aside>