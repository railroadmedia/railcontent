<section class="catalogue-filters clearfix">
    <div class="container mx-auto">
        <div class="md:flex justify-between">
            <div class="filter-wrap clearfix">
                <span
                    class="filter float-left px-2 md:px-3 w-1/2 md:w-full"
                    x-bind:class="filter === 'all' && 'active'"
                    x-on:click="filter = 'all'"
                >
                    All
                </span>
                <span
                    class="filter float-left px-2 md:px-3 w-1/2 md:w-full"
                    x-bind:class="filter === 'lessons' && 'active'"
                    x-on:click="filter = 'lessons'"
                >
                    Lessons
                </span>
                <span
                    class="filter float-left px-2 md:px-3 w-1/2 md:w-full"
                    x-bind:class="filter === 'accessories' && 'active'"
                    x-on:click="filter = 'accessories'"
                >
                    Accessories
                </span>
                <span
                    class="filter float-left px-2 md:px-3 w-1/2 md:w-full"
                    x-bind:class="filter === 'clothing' && 'active'"
                    x-on:click="filter = 'clothing'"
                >
                    Clothing
                </span>
            </div>
            <div class="select-wrap relative px-3 md:px-0">
                <select id="sortBySection" data-filter-type="sort-order" class="catalogue-filter w-full">
                    <option class="selectable-option" disabled selected>Sort By..</option>
                    <option class="selectable-option">Price: Low to High</option>
                    <option class="selectable-option">Price: High to Low</option>
                </select>
            </div>
        </div>
    </div>
</section>
