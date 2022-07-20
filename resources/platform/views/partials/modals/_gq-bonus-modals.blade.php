{{-- Guitar Quest: Bonus Modal 1 --}}
<div x-show.transition.opacity="modalOpen === 'bonusModalOne'" 
     x-cloak
     class="tw-overflow-scroll tw-p-4 tw-fixed tw-inset-0 tw-bg-black tw-bg-opacity-75 tw-z-250 soft-block">
    <div x-show.transition="modalOpen === 'bonusModalOne'"
            x-on:click.away="modalOpen = false; document.querySelector('#gq-bonus-1').src = 'https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0'"
            class="tw-flex tw-items-start tw-flex-col-reverse tw-max-w-screen tw-mx-auto"
            style="max-width: 90%;"
    >
        <div>
            <p class="tw-uppercase text-goldenrod tw-mb-0">
                Bonus Video #1
            </p>
            <p class="tw-text-white tw-font-extrabold tw-text-3xl tw-font-bold font-primary tw-my-0">
                The Making of Guitar Quest 
            </p>
        </div>
        <div class="tw-mx-auto tw-overflow-hidden tw-relative tw-w-full tw-rounded-2xl tw-bg-white tw-mb-8"
            style="padding-bottom: 56.25%;">
            <iframe 
                id="gq-bonus-1"
                width="640" 
                height="360"
                class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0"
                src="https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0" 
                frameborder="0" 
                allow="autoplay; fullscreen" 
                allowfullscreen>
            </iframe>
        </div>
        <button class="tw-text-white tw-text-7xl tw-cursor-pointer tw-ml-auto tw-mb-6"
                x-on:click.prevent="modalOpen = false; document.querySelector('#gq-bonus-1').src = 'https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0'">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

{{-- Guitar Quest: Bonus Modal 2 --}}
<div x-show.transition.opacity="modalOpen === 'bonusModalTwo'" 
     x-cloak
     class="tw-overflow-scroll tw-p-4 tw-fixed tw-inset-0 tw-bg-black tw-bg-opacity-75 tw-z-250 soft-block">
    <div x-show.transition="modalOpen === 'bonusModalTwo'"
            x-on:click.away="modalOpen = false; document.querySelector('#gq-bonus-2').src = 'https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0'"
            class="tw-flex tw-items-start tw-flex-col-reverse tw-max-w-screen tw-mx-auto"
            style="max-width: 90%;"
    >
        <div>
            <p class="tw-uppercase text-goldenrod tw-mb-0">
                Bonus Video #2
            </p>
            <p class="tw-text-white tw-font-extrabold tw-text-3xl tw-font-bold font-primary tw-my-0">
                Making the Music of Guitar Quest 
            </p>
        </div>
        <div class="tw-mx-auto tw-overflow-hidden tw-relative tw-w-full tw-rounded-2xl tw-bg-white tw-mb-8"
            style="padding-bottom: 56.25%;">
            <iframe 
                id="gq-bonus-2"
                width="640" 
                height="360"
                class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0"
                src="https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0" 
                frameborder="0" 
                allow="autoplay; fullscreen" 
                allowfullscreen>
            </iframe>
        </div>
        <button class="tw-text-white tw-text-7xl tw-cursor-pointer tw-ml-auto tw-mb-6"
                x-on:click.prevent="modalOpen = false; document.querySelector('#gq-bonus-2').src = 'https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0'">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>