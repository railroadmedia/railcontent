{{-- Guitar Quest: Trailer Modal --}}
<div x-show.transition.opacity="modalOpen === 'trailerModal'" 
     x-cloak
     class="overflow-y-scroll p-4 fixed inset-0 bg-black bg-opacity-75 z-250 soft-block">
    <div x-show.transition="modalOpen === 'trailerModal'"
            x-on:click.away="modalOpen = false; document.querySelector('#intro-video').src = 'https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0'"
            class="flex items-start flex-col-reverse max-w-screen mx-auto"
            style="max-width: 90%;"
    >
        <div class="mx-auto overflow-hidden relative w-full rounded-2xl bg-white mb-12"
            style="padding-bottom: 56.25%;">
            <iframe 
                id="intro-video"
                width="640" 
                height="360"
                class="absolute w-full h-full top-0 left-0"
                src="https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0" 
                frameborder="0" 
                allow="autoplay; fullscreen" 
                allowfullscreen>
            </iframe>
        </div>
        <button class="text-white text-7xl cursor-pointer ml-auto mb-6"
                x-on:click.prevent="modalOpen = false; document.querySelector('#intro-video').src = 'https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0'">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>