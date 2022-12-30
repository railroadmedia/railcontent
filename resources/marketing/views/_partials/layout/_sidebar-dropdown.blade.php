@php($id = uniqid())
<div class="page-link parent flex flex-col flex-wrap body text-black align-v-center"
     data-remain-open="{{ strtolower(str_replace(' ', '-', $page)) }}"
     x-data="{ dropdown_{{ $id }}: false }"
>
    {{-- Dropdown Trigger --}}
     <div class="flex py-2 px-5 border-b border-gray-100 md:text-[17px] items-center leading-none cursor-pointer"
          dusk="parent-button-{{ strtolower(str_replace(' ', '-', $page)) }}"
          x-on:click.prevent="dropdown_{{ $id }} = !dropdown_{{ $id }}"      
    >
        @if(!empty($iconClass))
            <i class="no-events {{ $iconClass }} text-{{ $brand }} mr-2.5 text-lg"></i>
            {{ $page }}
        @elseif(!empty($iconSvg))
            <svg class="mr-2.5" width="20" height="20" aria-hidden="true" focusable="false"><use xlink:href="#{{ $iconSvg }}"></use></svg>
            {{ $page }}
        @else
            {{ $page }}
        @endif
        <i class="no-events far fa-chevron-down arrow ml-auto transition-all transform-gpu origin-center text-{{ $brand }}"
           x-bind:class="dropdown_{{ $id }} ? '-rotate-180' : 'rotate-0'" 
        ></i>
    </div>

    {{-- Dropdown --}}
    <div class="flex flex-col overflow-hidden transition-all transform-gpu"
         x-bind:class="dropdown_{{ $id }} ? 'max-h-[500px]' : 'max-h-0'"
    >
        @foreach($children as $page => $info)
            @include('_partials.layout._sidebar-link', [
                "page" => $page,
                "iconClass" => $info['iconClass'] ?? null,
                "iconSvg" => $info['iconSvg'] ?? null,
                "url" => $info['url'],
                "greyed" => true
            ])
        @endforeach
    </div>
</div>