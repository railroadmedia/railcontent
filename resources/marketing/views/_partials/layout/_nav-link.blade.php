<a href="{{ $url }}" class="flex items-center text-gray-800 py-2 px-5 border-b border-gray-100 hover:bg-gray-100 leading-none {{ $greyed ? 'bg-gray-50 text-sm py-3' : 'md:text-lg' }}"
    dusk="page-link-{{ strtolower(str_replace(' ', '-', $page)) }}">
    @if(!empty($iconClass))
        <i class=" {{ $iconClass }} {{ $greyed ? 'text-black' : $theme_text }} mr-2.5 text-lg"></i>
        {{ $page }}
    @elseif(!empty($iconSvg))
        <svg class="mr-2.5" width="20" height="20" aria-hidden="true" focusable="false"><use xlink:href="#{{ $iconSvg }}"></use></svg>
        {{ $page }}
    @else
        {{ $page }}
    @endif
</a>