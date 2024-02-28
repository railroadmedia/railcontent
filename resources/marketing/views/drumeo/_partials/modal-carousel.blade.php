<!-- To use this modal, add Focus Plugin (because of x-trap) in the head section before the Alpine.js script -->
<!-- <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script> -->
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
                    arrows: false,
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
x-init="$watch('open', value => { if (value) initSplide(); })"
class="flex flex-wrap items-center">
    

<!-- images design for similar size images-->
   
    <!-- @foreach ($slides as $index => $slide)
    <div class="w-full sm:w-1/2 sm:order-1">
        <div class="p-3 w-full">
            <div  @click="handleClick({{ $index }})"  
                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl {{ $scaleAnimation }}"
                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/{{ $slide['img'] }}')">
            </div>
        </div>
    </div>
    @endforeach -->

   <!-- images design -->
   <div class="w-full sm:w-1/2 sm:order-1">
        <div class="p-3 w-full">
            <div @click="handleClick(0)"  
                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl {{ $scaleAnimation }}"
                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[0]['img'] }}')">
            </div>
        </div>
    </div>
    <div class="w-1/2 sm:w-1/4">
        <div class="p-3 w-full">
            <div @click="handleClick(1)" 
                class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl {{ $scaleAnimation }}"
                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')">
            </div>
        </div>
        <div class="p-3 w-full">
            <div @click="handleClick(2)" 
                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl {{ $scaleAnimation }}"
                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[2]['img'] }}')">
            </div>
        </div>
    </div>
    <div class="w-1/2 sm:w-1/4 sm:order-2">
        <div class="p-3 w-full">
            <div  @click="handleClick(3)" 
                class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl {{ $scaleAnimation }}"
                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')">
            </div>
        </div>
        <div class="p-3 w-full">
            <div @click="handleClick(4)" 
                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl {{ $scaleAnimation }}"
                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[4]['img'] }}')">
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div x-show="open" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog"
        aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 z-10 overflow-y-auto">
        <!-- Overlay -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
        <!-- Panel -->
        <div x-show="open" x-transition.opacity x-on:click="open = false" 
            class="relative flex min-h-screen items-center justify-center p-4">
            <div x-on:click.stop x-trap.noscroll.inert="open" 
                class="relative w-full max-w-5xl overflow-y-auto rounded-xl bg-white p-12 shadow-lg z-50">
                <!-- close button -->
                <i @click="close()"
                    class="fa fa-times absolute top-1 right-2 cursor-pointer text-2xl text-{{$brand}}"></i>
                <!-- Content -->
                <div x-ref="splide" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                        <template x-for="(slide, index) in slides" :key="index">
                            <li class="splide__slide">
                                <img x-bind:src="'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/' + slide"
                                    alt="product image" class="w-full h-full object-cover rounded-xl">
                            </li>
                        </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
