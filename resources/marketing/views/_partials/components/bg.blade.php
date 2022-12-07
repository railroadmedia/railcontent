@if(!empty($breakpoints))
    /* $src is for default image source */
    <picture>
        @foreach($breakpoints as $breakpoint)
            <source media="(min-width: {{$breakpoint['px']}})" srcset="{{ $breakpoint['src'] }}">
            <img
                class="transition-opacity opacity-0 absolute object-cover top-0 left-0 w-full h-full @if(!empty($class)) {{ $class }} @endif"
                src="{{ $src }}"
                alt="{{ $alt }}"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            />
        @endforeach
    </picture>
@else
    <img
        class="transition-opacity opacity-0 absolute object-cover top-0 left-0 w-full h-full @if(!empty($class)) {{ $class }} @endif"
        src="{{ $src }}"
        alt="{{ $alt }}"
        loading="lazy"
        onload="this.classList.remove('opacity-0')"
    />
@endif
