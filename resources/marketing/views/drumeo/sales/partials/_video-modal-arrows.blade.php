<div class="reveal large relative" style="@if(!empty($vertical)) max-width:600px;@endif background: transparent;" id="{{ $modalId }}" data-reveal data-reset-on-close="false">
    <div class="px-10 sm:px-20 relative" style="background: transparent;">
        <button class="shorts-arrow-left cursor-pointer"></button>
        <div @if(!empty($vertical)) style="padding-bottom: 175%;" @endif class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="{{ $video }}" frameborder="0" allowfullscreen allow="autoplay" title="{{ $title }}"></iframe>
        </div>
        <button class="shorts-arrow-right cursor-pointer"></button>
    </div>
</div>