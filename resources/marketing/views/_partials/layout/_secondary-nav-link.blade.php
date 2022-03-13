<div class="page-link parent flex flex-col flex-wrap body text-black align-v-center "
     data-remain-open="{{ strtolower(str_replace(' ', '-', $page)) }}">
    
     <div class="flex p-3 border-b border-gray-100 text-lg items-center leading-none"
          dusk="parent-button-{{ strtolower(str_replace(' ', '-', $page)) }}">
        @if(!empty($iconClass))
            <i class="no-events {{ $iconClass }} {{ $theme_text }} mr-2.5"></i>
            {{ $page }}
        @elseif(!empty($iconSvg))
            <svg class="mr-2.5" width="20" height="20" aria-hidden="true" focusable="false"><use xlink:href="#{{ $iconSvg }}"></use></svg>
            {{ $page }}
        @else
            {{ $page }}
        @endif
        <i class="no-events far fa-chevron-down arrow ml-auto {{ $theme_text }}"></i>
    </div>

    <div class="flex flex-col hidden">
        @foreach($children as $page => $info)
            @include('_partials.layout._nav-link', [
                "page" => $page,
                "theme_text" => $theme_text,
                "iconClass" => $info['iconClass'] ?? null,
                "iconSvg" => $info['iconSvg'] ?? null,
                "url" => $info['url'],
                "greyed" => true
            ])
        @endforeach
    </div>
</div>