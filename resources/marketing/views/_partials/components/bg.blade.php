<img
    class="transition-opacity opacity-0 absolute w-full h-full object-cover top-0 left-0 @if(!empty($class)) {{ $class }} @endif"
    src="{{ $src }}"
    alt="{{ $alt }}"
    loading="lazy"
    onload="this.classList.remove('opacity-0')"
/>
