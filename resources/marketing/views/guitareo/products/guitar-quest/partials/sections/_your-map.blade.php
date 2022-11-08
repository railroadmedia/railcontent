{{-- Guitar Quest: Your Map --}}
<section id="your_map" class="py-24 relative md:py-28" style="background-image: url('https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2Fstar-pattern.svg?auto=format&ixlib=php-1.2.1&w=1500&s=d8500ab0042ccc07f20b2465f7a39549'); background-color: #000718;">
    <div class="max-w-screen-xl m-auto px-6 flex text-center mb-6">
        <div class="w-full m-auto text-white sm:w-3/4 lg:w-1/2">
            <h2 class="uppercase font-bison-bold text-5xl md:text-6xl">
                <span class="">The</span>
                <span class="text-goldenrod underline">More Fun</span>
                <span class="">Guitar Lessons</span>
            </h2>
            <p class="font-semibold md:text-lg my-6">
                Skip the boring stuff. GuitarQuest is designed to get you playing songs faster, hooked and returning to the guitar more often, and making your own musical projects come to life with entertaining video missions and fluff-free exercises.
            </p>
            <button class="border-box px-6 mb-4 sm:px-8 py-2 cursor-pointer border-solid border-goldenrod text-goldenrod border-3 inline-block uppercase font-roboto-condensed-bold rounded-full transition duration-300 linear hover:bg-white hover:text-black" x-show="levelMap === false" x-on:click.prevent="levelModalOpen = 1">
               Click For Course Details &nbsp; <i class="fas fa-external-link"></i>
            </button>
        </div>
    </div>
    <!-- Map Partial -->
    @include("guitareo.products.guitar-quest.partials.map._map")

    <!-- Level Modals -->
    @include("guitareo.products.guitar-quest.partials.map._level-modals")
</section>
