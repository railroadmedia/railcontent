<a href="{{ $url }}" class="flex items-center text-gray-800 p-3 border-b border-gray-100 text-lg hover:bg-gray-100 leading-none"
    dusk="page-link-{{ strtolower(str_replace(' ', '-', $page)) }}">
    @if(!empty($iconClass))
        <i class=" {{ $iconClass }} text-{{ $greyed ? 'black' : $themeColor }} mr-2.5"></i>
        {{ $page }}
    @elseif(!empty($iconSvg))
        <svg class="mr-2.5" width="20" height="20" aria-hidden="true" focusable="false"><use xlink:href="#{{ $iconSvg }}"></use></svg>
        {{ $page }}
    @else
        {{ $page }}
    @endif
</a>