<nav id="nav" class="bg-[#020815] fixed w-full top-0 left-0 flex items-center h-10 md:h-14">
    <!-- Logo/Home Link -->
    <a href="{{ $homeUrl ?? '/' }}" class="h-full px-2 md:px-4 flex items-center">
        <img src="{{ $logo }}" alt="Musora Logo" class="w-full max-w-[77px] md:max-w-[144px] max-h-9">
    </a>

    <!-- link-wrapper -->
    <div class="flex flex-1">

        <!-- Page Links -->
        <ul class="flex items-center text-white font-bebas-neue hidden md:flex">
            <li class="lg:ml-5"><a href="/#method" alt="Go to Method Section" class="uppercase border-b-[3px] pb-0.5 transition border-transparent hover:border-gray-600">Method</a></li>
            <li class="ml-3 lg:ml-6"><a href="/#songs" alt="Go to Songs Section" class="uppercase border-b-[3px] pb-0.5 transition border-transparent hover:border-gray-600">Songs</a></li>
            <li class="ml-3 lg:ml-6"><a href="/#coaches" alt="Go to Coaches Section" class="uppercase border-b-[3px] pb-0.5 transition border-transparent hover:border-gray-600">Coaches</a></li>
        </ul>

        <!-- Nav CTA buttons -->
        <div class="ml-auto flex items-center">
            <a href="/shop" class="btn-secondary btn-small text-base leading-none text-white mr-1.5 py-1 px-3 md:py-2.5 md:px-8 mb-0 h-auto md:h-initial hover:text-black hover:bg-white hover:border-white">Shop</a>
            <a href="/#join" class="btn-primary btn-small text-base leading-none {{ $theme_bg }} border-0 py-1.5 px-3 md:py-3 md:px-8 mr-1.5 mb-0 h-auto md:h-initial">Join Musora</a>
        </div>

    </div>

    <!-- Sidebar Toggle -->
    <button class="text-white w-10 h-10 md:w-14 md:h-14 relative focus:outline-none" x-on:click="sidebarOpen = !sidebarOpen, showOverlay = !showOverlay">
        <span class="sr-only">Open main menu</span>
        <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <span aria-hidden="true" class="block absolute h-0.5 w-5 bg-current transform transition duration-300 ease-in-out" x-bind:class="{'rotate-45': sidebarOpen,' -translate-y-1.5': !sidebarOpen }"></span>
            <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current   transform transition duration-300 ease-in-out" x-bind:class="{'opacity-0': sidebarOpen } "></span>
            <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current transform  transition duration-300 ease-in-out" x-bind:class="{'-rotate-45': sidebarOpen, ' translate-y-1.5': !sidebarOpen}"></span>
        </div>
    </button>
</nav>
