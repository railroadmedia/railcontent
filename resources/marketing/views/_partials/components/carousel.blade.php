/* add following in the head
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    related documents
        https://splidejs.com/guides/getting-started/
        https://alpinejs.dev/component/splide
*/

<div
    x-data="{
        init() {
            new Splide(this.$refs.splide, {
                {{ $xdata }}
            }).mount()
        },
    }"
>
    <div x-ref="splide" class="splide max-w-4xl mx-auto relative" aria-label="Splide/Alpine.js Carousel Example">
        <div class="splide__track relative" style="z-index: 10">
            <ul class="splide__list">
                @foreach ($slider as $slide)
                    <li class="splide__slide">
                        {{ $content }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="absolute w-full top-1/2">
            <div class="border-2 border-white w-2/3 mx-auto"></div>
        </div>
    </div>
</div>
