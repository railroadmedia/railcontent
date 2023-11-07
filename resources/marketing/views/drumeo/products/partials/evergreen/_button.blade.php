<div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/5">
    <a href="{{ $link }}" target="_blank" x-data="{ isHovered: false }">
        <button class="text-xl md:text-2xl bg-{{$brand}} uppercase rounded-full w-full sm:w-full md:w-full lg:w-full xl:w-full h-12 md:h-14 transition duration-300 ease-in-out {{ $buttonClass }}"
            :style="'background-color: ' + (isHovered ? 'lighten($brand, 10%)' : 'bg-{{$brand}}') + '; box-shadow: ' + (isHovered ? '0 0 7px rgba(0, 0, 0, 0.35)' : 'none') + '; filter: brightness(' + (isHovered ? '115%' : '100%') + ')'" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
            @if (!empty($iconClass) && $iconPosition === 'left')
                <i class="{{ $iconClass }}" aria-hidden="true"></i>
            @endif
            @if (!empty($buttonText))
                <strong>{{ $buttonText }}</strong>
            @else
                <strong>{{ $buttonText }}</strong>
            @endif
            @if (!empty($iconClass) && $iconPosition === 'right')
                <i class="{{ $iconClass }}" aria-hidden="true"></i>
            @endif
        </button>
    </a>
</div>
