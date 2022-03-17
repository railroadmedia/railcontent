<!-- Quest Map -->
<div class="w-full lg:w-3/4 m-auto">
    <!-- Desktop -->
    <div class="max-w-screen-xl m-auto hidden md:visible md:flex px-6 py-2 relative">
        <p class="absolute top-0 text-goldenrod leading-none text-center inline-block" style="left: 15%;"><em>Click a level<br> to see more!</em></p>
        @include("products.guitar-quest.partials.map._desktop-map")
    </div>
    <!-- Mobile -->
    <div class="max-w-screen-xl m-auto md:hidden px-6 py-5 relative">
        <p class="absolute top-0 text-goldenrod leading-none text-center inline-block" style="left: 8%;"><em>Click a level<br> to see more!</em></p>
        @include("products.guitar-quest.partials.map._mobile-map")
    </div>
</div>
