<div class="reveal large" @if(!empty($vertical)) style="max-width:400px;" @endif id="{{ $modalId }}" data-reveal data-reset-on-close="false">
    <div @if(!empty($vertical)) style="padding-bottom: 175%;" @endif class="aspect-16:9 w-full relative">
        <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="{{ $video }}" frameborder="0" allowfullscreen allow="autoplay" title="{{ $title }}"></iframe>
    </div>
</div>