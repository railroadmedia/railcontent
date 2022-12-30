@php($id = uniqid())

<div class="relative flex flex-col items-center"
     data-remain-open="{{ strtolower(str_replace(' ', '-', $page)) }}"
     x-data="{ dropdown_{{ $id }}: false }"
>
    {{-- DROPDOWN TRIGGER --}}
    <div class="flex py-2 mr-8 items-center text-white hover:text-{{ $brand }} tracking-widest text-base leading-none"
          dusk="parent-button-{{ strtolower(str_replace(' ', '-', $page)) }}"
          x-on:click.prevent="dropdown_{{ $id }} = !dropdown_{{ $id }}"      
    >
        {{ $page }}
        <i class="no-events fa-solid fa-caret-down ml-1 mb-1"></i>
    </div>

    {{-- DROPDOWN --}}
    <div class="flex flex-col overflow-hidden transition-all text-black transform-gpu bg-white absolute w-44 shadow-lg left-0 top-[100%] left-0 rounded-lg p-2"
         x-cloak
         x-bind:class="dropdown_{{ $id }} ? '' : 'hidden' "
    >
        @foreach($children as $page => $info)
            <a href="{{ $info['url'] }}" class="flex items-center text-base tracking-widest hover:text-{{ $brand }} px-2 py-1 hover:bg-gray-100 w-full"
                dusk="page-link-{{ strtolower(str_replace(' ', '-', $page)) }}">
                @if(!empty($info['iconClass']))
                    <i class="no-events {{ $info['iconClass'] }} mr-1"></i>
                @endif
                {{ $page }}
            </a>
        @endforeach
    </div>
</div>