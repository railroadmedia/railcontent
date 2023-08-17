<section class="catalogue-filters clearfix w-full">
    <div class="container mx-auto">
        <div class="md:flex justify-between md:px-3 lg:px-2">
            <div class="filter-wrap clearfix">
                <span
                    class="filter float-left w-1/2 md:w-auto border-guitareo after:bg-guitareo"
                    x-bind:class="filter === 'all' && 'active'"
                    x-on:click="filter = 'all'"
                >
                    All
                </span>
                <span
                    class="filter float-left w-1/2 md:w-auto border-guitareo after:bg-guitareo"
                    x-bind:class="filter === 'lessons' && 'active'"
                    x-on:click="filter = 'lessons'"
                >
                    Lessons
                </span>
                <span
                    class="filter float-left w-1/2 md:w-auto border-guitareo after:bg-guitareo"
                    x-bind:class="filter === 'accessories' && 'active'"
                    x-on:click="filter = 'accessories'"
                >
                    Accessories
                </span>
                @if(empty($noClothing))
                    <span
                        class="filter float-left w-1/2 md:w-auto border-guitareo after:bg-guitareo"
                        x-bind:class="filter === 'clothing' && 'active'"
                        x-on:click="filter = 'clothing'"
                    >
                        Clothing
                    </span>
                @endif
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
