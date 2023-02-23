
@if(!empty($promoVersion))
    <div id="headphones" class="anchor"></div>
    <section class="py-12 md:py-20">
        <div class="max-w-4xl mx-auto text-center px-4 lg:px-0">

            <h2><strong>Hear your piano the way <br class="hidden sm:inline">it was meant to sound.</strong></h2>
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center text-left my-6 sm:my-8">
                <div class="block rounded-xl bg-contain bg-center w-full sm:w-1/2 pb-72 sm:pb-96 lg:py-48 mb-4 sm:mb-0 bg-no-repeat" style="background-image:url(https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/anniversary/2023/headphones-collage.png);"></div>
                <p class="w-full sm:w-1/2 sm:pl-7">
                    Elevate your practice experience with these beautifully designed hi-end headphones for piano players. <br><br>
                    They’re lightweight and have super-comfy ear padding for extended playing sessions and unrivaled sound definition and bass response.
                    Your playing has never sounded so good.<br><br>
                    Valued at $189, these headphones are FREE with your Pianote Membership.<br><br>
                    But hurry - there are only <s>500</s> {-- TODO --} left.<br><br>
                    And when they’re gone, they’re gone.
                </p>
            </div>
{{--            <h2><strong>What's in the box?</strong></h2>--}}
{{--            <p class="leading-tight mt-2 sm:mt-3 mb-6">Scroll down to see everything that’s included.</p>--}}
            <img
                class="rounded-xl mb-2 cursor-pointer autoplay-video mt-16 transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-04.png"
                alt="montage 4"
                x-on:click="unbox = true;"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
{{--            <div class="flex flex-wrap mb-2">--}}
{{--                <img class="w-full md:w-2/3 rounded-xl md:pr-1 mb-2" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-01.jpg" alt="montage 1">--}}
{{--                <img class="w-1/2 md:w-1/3 rounded-xl md:pl-1 mb-2 pr-1 md:pr-0" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-05.jpg" alt="montage 5">--}}
{{--                <img class="w-1/2 md:w-1/3 rounded-xl md:pr-1 mb-2 md:mb-0 pl-1 md:pl-0" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-06.jpg" alt="montage 6">--}}
{{--                <img class="w-full md:w-2/3 rounded-xl md:pl-1" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-02.jpg" alt="montage 2">--}}
{{--            </div>--}}
{{--            <div class="relative">--}}
{{--                <img class="rounded-xl" src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-03.png" alt="montage 3">--}}
{{--                <div class="hidden md:block">--}}
{{--                    <div class="tool absolute cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 18%;left: 34%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);" tip="Padded headband for extra comfort">--}}
{{--                        <span class="text-2xl">+</span>--}}
{{--                    </div>--}}
{{--                    <div class="tool absolute cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 24%;left: 68%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);" tip="3-meter coiled cable">--}}
{{--                        <span class="text-2xl">+</span>--}}
{{--                    </div>--}}
{{--                    <div class="tool absolute cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 56%;left: 62%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);" tip="3-meter straight cable">--}}
{{--                        <span class="text-2xl">+</span>--}}
{{--                    </div>--}}
{{--                    <div class="tool absolute cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 68%;left: 78%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);" tip="¼” Adapter">--}}
{{--                        <span class="text-2xl">+</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
@endif
