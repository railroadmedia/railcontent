<section class="clearfix w-full text-center mx-auto sm:px-5 py-4 sm:pb-6 sm:pt-8">
    <div class="container mx-auto">
        <div class="sm:flex items-center justify-between">
            <div class="text-left whitespace-nowrap overflow-x-scroll sm:overflow-x-auto mb-4 sm:mb-0">
                <h4
                    class="px-2 sm:px-4 py-3 sm:py-4 inline-block cursor-pointer text-gray-400"
                    x-bind:class="filter === 'all' && 'active text-gray-900 font-black border-b-2 border-{{ $brand }}'"
                    x-on:click="filter = 'all'"
                >
                    All
                </h4>
                <h4
                    class="px-2 sm:px-4 py-3 sm:py-4 inline-block cursor-pointer text-gray-400"
                    x-bind:class="filter === 'lessons' && 'active text-gray-900 font-black border-b-2 border-{{ $brand }}'"
                    x-on:click="filter = 'lessons'"
                >
                    Lessons
                </h4>
                <h4
                    class="px-2 sm:px-4 py-3 sm:py-4 inline-block cursor-pointer text-gray-400"
                    x-bind:class="filter === 'accessories' && 'active text-gray-900 font-black border-b-2 border-{{ $brand }}'"
                    x-on:click="filter = 'accessories'"
                >
                    Gear
                </h4>
                @if(empty($noClothing))
                <h4
                    class="px-2 sm:px-4 py-3 sm:py-4 inline-block cursor-pointer text-gray-400"
                    x-bind:class="filter === 'clothing' && 'active text-gray-900 font-black border-b-2 border-{{ $brand }}'"
                    x-on:click="filter = 'clothing'"
                >
                    Clothing
                </h4>
                @endif
            </div>
            <div>
                <select id="sortBySection" data-filter-type="sort-order" class="w-full text-gray-500 py-2 pl-2 pr-6 rounded-xl bg-white border border-gray-400">
                    <option class="text-gray-500 selectable-option" disabled selected>Sort By..</option>
                    <option class="text-gray-500 selectable-option">Price: Low to High</option>
                    <option class="text-gray-500 selectable-option">Price: High to Low</option>
                </select>
            </div>
        </div>
    </div>
</section>
