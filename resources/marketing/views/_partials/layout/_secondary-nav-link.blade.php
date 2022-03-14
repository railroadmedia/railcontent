@php($id = uniqid())
<div class="page-link parent flex flex-col flex-wrap body text-black align-v-center "
     data-remain-open="{{ strtolower(str_replace(' ', '-', $page)) }}"
     x-data="{ dropdown_{{ $id }}: false }"
>
    
     <div class="flex p-3 border-b border-gray-100 md:text-lg items-center leading-none"
          dusk="parent-button-{{ strtolower(str_replace(' ', '-', $page)) }}"
          x-on:click.prevent="dropdown_{{ $id }} = !dropdown_{{ $id }}"      
    >
        @if(!empty($iconClass))
            <i class="no-events {{ $iconClass }} {{ $theme_text }} mr-2.5 text-lg"></i>
            {{ $page }}
        @elseif(!empty($iconSvg))
            <svg class="mr-2.5" width="20" height="20" aria-hidden="true" focusable="false"><use xlink:href="#{{ $iconSvg }}"></use></svg>
            {{ $page }}
        @else
            {{ $page }}
        @endif
        <i class="no-events far fa-chevron-down arrow ml-auto {{ $theme_text }}"></i>
    </div>

    <div class="flex flex-col overflow-hidden transition duration-200 ease-in-out"
         x-bind:class="dropdown_{{ $id }} ? 'max-h-[500px]' : 'max-h-0'"
    >
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