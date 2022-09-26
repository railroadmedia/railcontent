<img
    class="@if(!empty($class)) {{ $class }} @endif transition-opacity opacity-0"
    src="{{ $src }}"
    alt="{{ $alt }}"
    loading="lazy"
    onload="this.classList.remove('opacity-0')"
/>
