{{-- Guitar Quest: Your Quest Section --}}
<section id="your_quest" class=" bg-center bg-cover overflow-hidden header-image flex items-end pb-24 md:py-24 lg:py-60 lg:items-start">
    <div class="max-w-screen-xl mx-auto px-6 flex relative w-full">
        <!-- Rob Scallon Image -->
        <div class="lg:w-1/3 hidden lg:inline-flex">
            <img src="https://www.musora.com/musora-cdn/image/width=730,quality=95/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/rob-scallon-header.png" width="730px" class="absolute max-w-none" style="top: -435px; left: -120px;" alt="Rob Scallon">
        </div>
        <!-- Content -->
        <div class="w-full lg:w-2/3 z-10">
            <h1 class="text-white uppercase leading-none text-5xl sm:text-7xl lg:text-8xl font-bison-bold text-center @if(empty($saveText)) mb-12 @endif">
                <span class="inline-block">Your</span>
                <span class="block text-goldenrod text-6xl sm:text-8xl lg:text-9xl -my-3">Guitar Journey</span>
                <span class="inline-block">Starts Here</span>
            </h1>
            @if(!empty($dueDateText))
                <div class="text-white text-center my-4">
                    <p class="uppercase font-primary text-sm sm:text-base mb-4 leading-relaxed mx-auto">
                        <strong>{!! $dueDateText !!}
                    </p>
                </div>
            @endif
            <div class="text-center">
                <button class="border-box px-4 mb-2 sm:px-8 py-2 cursor-pointer border-solid mr-2 border-white border-3 py-1 inline-block uppercase text-white font-roboto-condensed-bold rounded-full transition duration-300 linear hover:bg-white hover:text-black"
                        x-on:click.prevent="document.querySelector('#intro-video').src += '&autoplay=1'; modalOpen = 'trailerModal';"
                >
                    <i class="fas fa-play pr-1"></i> Watch Trailer
                </button>
                @if($products['guitar-quest']->getPublicStockCount() > 0)
                    <a class="bg-goldenrod-gradient transition duration-300 linear px-6 sm:px-10 py-2 inline-block uppercase text-black font-roboto-condensed-bold rounded-full" title="Go To Order Page" href="{{ $orderLink }}">Get Started</a>
                @else
                    <a class="bg-gray-400 hover-yellow transition duration-300 linear px-6 sm:px-10 py-2 inline-block uppercase text-black font-roboto-condensed-bold rounded-full" x-on:click.prevent="modalOpen = 'waitlistModal'">Join The Waitlist</a>
                @endif
                @if(!empty($saveText))<p class="uppercase font-primary text-sm sm:text-base leading-relaxed mx-auto text-white"><strong>{!! $saveText !!}</strong></p>@endif
            </div>
        </div>
    </div>
</section>
