@if(!empty($breakpoints))
    /* $src is for default image source */
    <picture>
        @foreach($breakpoints as $breakpoint)
            <source media="(min-width: {{$breakpoint['px']}})" srcset="{{ $breakpoint['src'] }}">
            <img
                class="@if(!empty($class)) {{ $class }} @endif transition-opacity opacity-0"
                src="{{ $src }}"
                alt="{{ $alt }}"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
        @endforeach
    </picture>
@else
    <img
        class="@if(!empty($class)) {{ $class }} @endif transition-opacity opacity-0"
        src="{{ $src }}"
        alt="{{ $alt }}"
        loading="lazy"
        onload="this.classList.remove('opacity-0')"
    >
@endif
