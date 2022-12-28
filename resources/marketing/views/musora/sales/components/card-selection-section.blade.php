<section class="text-center text-white px-4 sm:px-6 py-10 sm:py-14 lg:py-20 bg-[#0c1524]"
    x-data="{ plusMembershipSelected: true }"
>
    <div class="container max-w-6xl mx-auto">
        <h1><strong>Your first week<br class="inline sm:hidden"> is free.</strong></h1>
        <h5 class="mt-2 md:mt-4">Choose the plan that will continue on <br class="inline lg:hidden">
            {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }} (after your free trial). Cancel anytime.</h5>

        <div class="flex items-end justify-center my-5">
            <div class="px-1 sm:px-2">
                <p class="inline-block relative -bottom-1 mb-1 px-3 py-0.5 z-10 leading-tight text-black text-xs rounded-full bg-[#00c9ac]">MOST POPULAR</p>
                <div id="plusButton"
                    class="active option-buttons hover:opacity-90 cursor-pointer border-2 flex items-center rounded-xl py-3 sm:py-4 px-3 sm:px-5 bg-[#273040] border-[#0c1524]"
                    x-bind:class="{ 'active': plusMembershipSelected }"
                    x-on:click="plusMembershipSelected = true"
                >
                    <div class="text-left">
                        <img class="h-5 sm:h-6" src="https://drumeo-assets.s3.amazonaws.com/sales/2023/drumeoplus_logo.svg">
                        <p class="opacity-60 text-xs no-select mt-0.5"><em>Lessons + Songs</em></p>
                    </div>
                    <div class="radio-check ml-3 sm:ml-10 w-7 h-7 flex content-center justify-center border-2 rounded-full border-gray-500 text-gray-500">
                        <i class="fas fa-check text-base text-white hidden"></i>
                    </div>
                </div>
            </div>
            <div class="px-1 sm:px-2">
                <div id="nonPlusButton" class="option-buttons hover:opacity-90 cursor-pointer border-2 flex items-center rounded-xl py-3 sm:py-4 px-3 sm:px-5 bg-[#273040] border-[#0c1524]"
                    x-bind:class="{ 'active': !plusMembershipSelected }"
                    x-on:click="plusMembershipSelected = false"
                >
                    <div class="text-left">
                        <img class="h-5 sm:h-6" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
                        <p class="opacity-60 text-xs no-select mt-0.5"><em>Lessons only.</em></p>
                    </div>
                    <div class="radio-check ml-3 sm:ml-14 w-7 h-7 flex content-center justify-center border-2 rounded-full border-gray-500 text-gray-500">
                        <i class="fas fa-check text-base text-white hidden"></i>
                    </div>
                </div>
            </div>

        </div>

        <div id="plusOptions"
            class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto"
            x-bind:class="{ 'hidden': !plusMembershipSelected }"
        >
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-black text-sm rounded-full bg-[#ffac00]" >SAVE 33%</p>
                <a href="todo" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="leading-none mb-6"><strong>Annual</strong></h2>
                        <h4 class="inline-block leading-none"><strong>${{ number_format(Prices::$drumeoEdgeAnnual / 12) }}/month</strong></h4>
                        <p class="text-sm mb-6"><em>Billed at ${{Prices::$drumeoEdgeAnnual}} per year.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for 7 days</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10 bg-[#e7edf4]">
                        <p class="text-sm mb-1"><strong>The world’s best drum lessons.</strong></p>
                        <p class="text-sm mb-1"><strong>5000+ popular songs.</strong></p>
                        <p class="text-sm mb-1"><strong>Unlimited personal support.</strong></p>
                        <p class="text-sm mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                        <p class="text-sm mb-1">Lesson access for piano, guitar, and singing.</p>
                        <p class="text-sm">90-day money back guarantee.</p>
                    </div>
                </a>
            </div>
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <a href="todo" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="leading-none mb-6"><strong>Monthly</strong></h2>
                        <h4 class="inline-block leading-none"><strong>${{ Prices::$drumeoEdgeRegular }}/month</strong></h4>
                        <p class="text-sm mb-6"><em>Pay as you go.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for 7 days</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10 bg-[#e7edf4]">
                        <p class="text-sm mb-1"><strong>The world’s best drum lessons.</strong></p>
                        <p class="text-sm mb-1"><strong>5000+ popular songs.</strong></p>
                        <p class="text-sm mb-1"><strong>Unlimited personal support</strong></p>
                        <p class="text-sm mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                        <p class="text-sm mb-1">Lesson access for piano, guitar, and singing.</p>
                        <p class="text-sm">90-day money back guarantee.</p>
                    </div>
                </a>
            </div>
        </div>
        <div id="nonPlusOptions"
            class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto"
            x-cloak
            x-bind:class="{ 'hidden': plusMembershipSelected }"
        >
            <div class="w-full md:w-1/2 px-2 md:px-3 mb-4 md:mb-0 relative">
                <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-black text-sm rounded-full bg-[#ffac00]">SAVE 33%</p>
                <a href="todo" class="text-black overflow-hidden rounded-t-2xl block mx-auto group">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="leading-none mb-6"><strong>Annual</strong></h2>
                        <h4 class="inline-block leading-none"><strong>${{ number_format(200 / 12, 2) }}/month</strong></h4>
                        <p class="text-sm mb-6"><em>Billed at ${{200}} per year.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for 7 days</div>
                    </div>
                </a>
                <div class="text-black overflow-hidden rounded-b-2xl block mx-auto group px-3 pt-5 md:pt-6 pb-9 md:pb-10 bg-[#e7edf4]">
                    <p class="text-sm mb-1"><strong>The world’s best drum lessons.</strong></p>
                    <p class="text-sm mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                    <p class="text-sm mb-1">Lesson access for piano, guitar, and singing.</p>
                    <p class="text-sm mb-2">90-day money back guarantee.</p>
                    <a class="todo" href=""><p class="text-sm text-{{ $theme }}">You can add 5000+ popular songs<br> for just $40/year. <u>Click Here.</u></p></a>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-2 md:px-3 mb-4 md:mb-0 relative">
                <a href="todo" class="text-black overflow-hidden rounded-t-2xl block mx-auto group">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="leading-none mb-6"><strong>Monthly</strong></h2>
                        <h4 class="inline-block leading-none"><strong>${{ 25 }}/month</strong></h4>
                        <p class="text-sm mb-6"><em>Pay as you go.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for 7 days</div>
                    </div>
                </a>
                <div class="text-black overflow-hidden rounded-b-2xl block mx-auto group px-3 pt-5 md:pt-6 pb-9 md:pb-10 bg-[#e7edf4]">
                    <p class="text-sm mb-1"><strong>The world’s best drum lessons.</strong></p>
                    <p class="text-sm mb-1">Join a community of {{ number_format(31856) }} drum students.</p>
                    <p class="text-sm mb-1">Lesson access for piano, guitar, and singing.</p>
                    <p class="text-sm mb-2">90-day money back guarantee.</p>
                    <a class="todo" href=""><p class="text-sm text-{{ $theme }}">You can add 5000+ popular songs<br> for just $40/year. <u>Click Here.</u></p></a>
                </div>
            </div>
        </div>
        <p><em>All prices listed in USD.</em></p>
    </div>
</section>
