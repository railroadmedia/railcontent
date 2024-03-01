<!-- To use this modal, add Focus Plugin (because of x-trap) in the head section before the Alpine.js script -->
<!-- <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script> -->

@props(['slides', 'scaleAnimation', 'handleClick'])


<div x-data="{
    open: false,
    imgIndex: null,
    slides: [
        @foreach ($slides as $slide)
        '{{ $slide['img'] }}',
        @endforeach
    ],
    splide: null,
    handleClick: function(index) {
        console.log('handleClick called with index:', index);
        this.open = true;
        this.imgIndex = index;
        this.slide = this.slides[index];
    },
    initSplide: function() {
        console.log('initSplide called');
        if (this.splide) {
            this.splide.destroy();
        }
        this.splide = new Splide($refs.splide, {
            classes: {
                    arrow: 'splide__arrow bg-white opacity-100 top-1/2 transform -translate-y-1/2 shadow-lg h-11 w-11',
                    prev: 'splide__arrow--prev your-class-prev flex -left-1',
                    next: 'splide__arrow--next your-class-next flex -right-1',
            },
            type: 'loop',
            pagination: false,
            start: this.imgIndex,
            perMove: 1,
            gap: '1rem',
            swipe: true,
            arrows: true,
            breakpoints: {
                640: {
                    type: 'loop',
                    gap: '1rem',
                    swipe: true,
                }
            },
        }).mount();
        console.log('Splide mounted');
    },
    close: function() {
        console.log('close called');
        this.open = false;
        if (this.splide) {
            setTimeout(() => {
                this.splide.destroy();
                this.splide = null;
            }, 300);
        }
    }
}"
x-init="$watch('open', value => { if (value) initSplide(); })">

   <!-- images -->
   {{ $slot }}

    <!-- Modal -->
    <div x-show="open"
        style="display: none; z-index: 2147483002;"
        x-on:keydown.escape.prevent.stop="open = false" role="dialog"
        aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 overflow-y-auto">
        <!-- Overlay -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-80 z-50" style="z-index: 1005;"></div>
        <!-- Panel -->
        <div x-show="open" x-transition.opacity x-on:click="open = false"
            class="relative min-h-screen flex items-start justify-center px-4 pt-40 sm:pt-28"
            style="z-index: 1006;">
            <!-- Close button -->
            <i @click="close()" class="fa-light fa-times fa-2x fixed top-1 right-1 text-white cursor-pointer text-5xl z-1005" style="z-index: 1005;"></i>
            <!-- Content -->
            <div x-on:click.stop x-trap.noscroll.inert="open"
                class="relative w-full overflow-y-visible max-w-6xl">
                <div class="@if(!empty($styles)) {{ $styles }} @endif w-full relative px-3 sm:px-5">
                    <div x-ref="splide" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <template x-for="(slide, index) in slides" :key="index">
                                    <li class="splide__slide">
                                        <picture>
                                            <source media="(min-width: 1160px)" x-bind:srcset="'https://d21q7xesnoiieh.cloudfront.net/fit-in/2300x0/filters:quality(95)/' + slide">
                                            <source media="(min-width: 1024px)" x-bind:srcset="'https://d21q7xesnoiieh.cloudfront.net/fit-in/1850x0/filters:quality(95)/' + slide">
                                            <source media="(min-width: 768px)" x-bind:srcset="'https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/' + slide">
                                            <source media="(min-width: 640px)" x-bind:srcset="'https://d21q7xesnoiieh.cloudfront.net/fit-in/1150x0/filters:quality(95)/' + slide">
                                            <img x-bind:src="'https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/' + slide"
                                                alt="product image" class="w-full h-full object-cover overflow-hidden rounded-xl">
                                        </picture>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
