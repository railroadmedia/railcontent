<!-- To use this modal, add Focus Plugin (because of x-trap) in the head section before the Alpine.js script -->
<!-- <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script> -->

<!-- Modal -->
<div x-show="open" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog"
    aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')"
    class="fixed inset-0 z-10 overflow-y-auto">
    <!-- Overlay -->
    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
    <!-- Panel -->
    <div x-show="open" x-transition x-on:click="open = false"
        class="relative flex min-h-screen items-center justify-center p-4">
        <div x-on:click.stop x-trap.noscroll.inert="open"
            class="relative w-full max-w-5xl overflow-y-auto rounded-xl bg-white p-12 shadow-lg z-50">
            <!-- close button -->
            <i @click="open = false"
                class="fa fa-times absolute top-1 right-2 cursor-pointer text-2xl text-{{$brand}}"></i>
            <!-- Content -->
            <div x-ref="splide" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <template x-for="(slide, index) in slides" :key="index">
                            <li class="splide__slide">
                                <img :src="'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/' + slide"
                                    alt="product image" class="w-full h-full object-cover rounded-xl">
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>