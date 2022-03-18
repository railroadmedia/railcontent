{{-- Guitar Quest: Your Quest Section --}}
<section id="your_quest" class="bg-center bg-cover overflow-hidden header-image flex items-end pb-24 md:py-24 lg:py-60 lg:items-start">
    <div class="max-w-screen-xl mx-auto px-6 flex relative w-full">
        <!-- Rob Scallon Image -->
        <div class="lg:w-1/3 hidden lg:inline-flex">
            <img src="{{ imgix("https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/rob-scallon-header.png", ["auto" => "format", "w" => 730]) }}" width="730px" class="absolute max-w-none" style="top: -435px; left: -120px;">
        </div>
        <!-- Content -->
        <div class="w-full lg:w-2/3 z-10">
            <h1 class="text-white uppercase leading-none text-5xl md:text-8xl mb-12 font-bison-bold">
                <span class="block -ml-36 text-center md:-ml-64 lg:ml-48 lg:text-left">Your</span> 
                <span class="block text-goldenrod text-6xl sm:text-8xl md:text-9xl -my-3  md:-my-7 text-center">Guitar Journey</span> 
                <span class="block ml-24 text-center md:ml-48 lg:ml-0 lg:text-right lg:mr-36">Starts Here</span>
            </h1>
            <div class="text-center">
                <button class="border-box px-4 mb-2 sm:px-8 py-2 cursor-pointer border-solid mr-2 border-white border-3 py-1 inline-block uppercase text-white font-roboto-condensed-bold rounded-full transition duration-300 linear hover:bg-white hover:text-black"
                        x-on:click.prevent="document.querySelector('#intro-video').src += '&autoplay=1'; modalOpen = 'trailerModal';"
                >
                    <i class="fas fa-play pr-1"></i> Watch Trailer
                </button>
                @if($products['guitar-quest']->getStock() > 0)
                    <a class="bg-goldenrod-gradient transition duration-300 linear px-6 sm:px-10 py-2 inline-block uppercase text-black font-roboto-condensed-bold rounded-full" title="Go To Order Page" href="{{ $orderLink }}">Get Started</a>
                @else
                    <a class="bg-gray-400 hover-yellow transition duration-300 linear px-6 sm:px-10 py-2 inline-block uppercase text-black font-roboto-condensed-bold rounded-full" x-on:click.prevent="modalOpen = 'waitlistModal'">Join The Waitlist</a>
                @endif
            </div>
        </div>
    </div>
</section>