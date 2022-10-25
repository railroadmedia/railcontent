<section class="catalogue-filters clearfix">
    <div class="container mx-auto">
        <div class="sm:flex justify-between">
            <div class="filter-wrap clearfix">
                <a href="/drumshop/" class="filter float-left px-2 md:px-3 w-1/2 md:w-full @if(!empty($all)) active @endif">All</a>
                <a href="/lessons/" class="filter float-left px-2 md:px-3 w-1/2 md:w-full @if(!empty($lessons)) active @endif">Lessons</a>
                <a href="/accessories/" class="filter float-left px-2 md:px-3 w-1/2 md:w-full @if(!empty($accessories)) active @endif">Accessories</a>
                <a href="/clothing/" class="filter float-left px-2 md:px-3 w-1/2 md:w-full @if(!empty($clothing)) active @endif">Clothing</a>
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