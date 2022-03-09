<nav id="nav" class="bg-[#020815] fixed w-full top-0 left-0 flex items-center h-14">
    <!-- Logo/Home Link -->
    <a href="{{ $homeUrl ?? '/' }}" class="h-full px-4 flex items-center">
        <img src="{{ $logo }}" alt="Logo" class="w-full max-w-[144px] max-h-9">
    </a>

    <!-- link-wrapper -->
    <div class="flex flex-1">

        <!-- Page Links -->
        <ul class="mr-auto flex items-center text-white font-bebas-neue">
            <li class="ml-7"><a href="/#method" alt="Go to Method Section" class="uppercase border-b-[3px] pb-0.5 transition border-transparent hover:border-gray-600">Method</a></li>
            <li class="ml-7"><a href="/#songs" alt="Go to Songs Section" class="uppercase border-b-[3px] pb-0.5 transition border-transparent hover:border-gray-600">Songs</a></li>
            <li class="ml-7"><a href="/#coaches" alt="Go to Coaches Section" class="uppercase border-b-[3px] pb-0.5 transition border-transparent hover:border-gray-600">Coaches</a></li>
        </ul>

        <!-- Nav CTA buttons -->
        <div class="flex items-center">
            <a href="/shop" class="btn btn-secondary btn-small text-white mr-3 py-4 px-8 mb-0 h-auto">Shop</a>
            <a href="/#join" class="btn btn-primary btn-small bg-{{ $brand }} border-0 py-4 px-8 mr-3 mb-0 h-auto">Join Musora</a>
        </div>

    </div>

    <!-- Sidebar Toggle -->
    <button class="text-white w-14 h-14 relative focus:outline-none" x-on:click="sidebarOpen = !sidebarOpen, showOverlay = !showOverlay">
        <span class="sr-only">Open main menu</span>
        <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <span aria-hidden="true" class="block absolute h-0.5 w-5 bg-current transform transition duration-300 ease-in-out" x-bind:class="{'rotate-45': sidebarOpen,' -translate-y-1.5': !sidebarOpen }"></span>
            <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current   transform transition duration-300 ease-in-out" x-bind:class="{'opacity-0': sidebarOpen } "></span>
            <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current transform  transition duration-300 ease-in-out" x-bind:class="{'-rotate-45': sidebarOpen, ' translate-y-1.5': !sidebarOpen}"></span>
        </div>
    </button>
</nav>
