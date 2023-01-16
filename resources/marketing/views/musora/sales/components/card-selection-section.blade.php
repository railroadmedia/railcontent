<section class="text-center text-white px-4 sm:px-6 py-10 sm:py-14 lg:py-20 bg-[#0c1524]"
    x-data="{ plusMembershipSelected: true }"
>
    <div class="container max-w-6xl mx-auto">
        <h1><strong>Your first @if(empty($month)) week @else month @endif <br class="inline sm:hidden"> is free.</strong></h1>
        <h5 class="mt-2 md:mt-4">Choose the plan that will continue on <br class="inline lg:hidden">
            @if(empty($month)) {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }} @else {{ Carbon\Carbon::now()->addDays(30)->format('F jS') }} @endif  (after your free trial). Cancel anytime.</h5>

        <div class="flex items-end justify-center my-5">
            <div class="px-1 sm:px-2">
                <p class="inline-block relative -bottom-1 mb-1 px-3 py-0.5 z-10 leading-tight text-black text-xs rounded-full bg-[#00c9ac]">MOST POPULAR</p>
                <div id="plusButton"
                    class="active option-buttons hover:opacity-90 cursor-pointer border-2 flex items-center rounded-xl py-3 sm:py-4 px-3 sm:px-5 bg-[#273040] border-[#0c1524]"
                    x-bind:class="{ 'active': plusMembershipSelected }"
                    x-on:click="plusMembershipSelected = true"
                >
                    <div class="text-left">
                        <img class="h-5 sm:h-6" src="{{ $plusLogo }}">
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
                        <img class="h-5 sm:h-6" src="{{ $logo }}">
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
                <a href="{{$plusAnnualLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="leading-none mb-6"><strong>Annual</strong></h2>
                        <h4 class="inline-block leading-none"><strong>${{ number_format(Prices::$plusSubscriptionAnnualFull / 12) }}/month</strong></h4>
                        <p class="text-sm mb-6"><em>Billed at ${{Prices::$plusSubscriptionAnnualFull}} per year.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for 7 days</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10 bg-[#e7edf4]">
                        <p class="text-sm mb-1"><strong>{{ $firstPoint }}</strong></p>
                        <p class="text-sm mb-1"><strong>{{ $songs }}+ popular songs.</strong></p>
                        <p class="text-sm mb-1"><strong>{{ $thirdPoint }}.</strong></p>
                        <p class="text-sm mb-1">Join a community of {{ number_format(Prices::$students) }} students.</p>
                        <p class="text-sm mb-1">{{ $fifthPoint }}</p>
                        <p class="text-sm">90-day money back guarantee.</p>
                    </div>
                </a>
            </div>
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <a href="{{$plusMonthlyLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="leading-none mb-6"><strong>Monthly</strong></h2>
                        <h4 class="inline-block leading-none"><strong>${{ Prices::$plusSubscriptionMonthly }}/month</strong></h4>
                        <p class="text-sm mb-6"><em>Pay as you go.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for 7 days</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10 bg-[#e7edf4]">
                        <p class="text-sm mb-1"><strong>{{ $firstPoint }}</strong></p>
                        <p class="text-sm mb-1"><strong>{{ $songs }}+ popular songs.</strong></p>
                        <p class="text-sm mb-1"><strong>{{ $thirdPoint }}</strong></p>
                        <p class="text-sm mb-1">Join a community of {{ number_format(Prices::$students) }} students.</p>
                        <p class="text-sm mb-1">{{ $fifthPoint }}</p>
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
                <a href="{{$annualLink}}" class="text-black overflow-hidden rounded-t-2xl block mx-auto group">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="leading-none mb-6"><strong>Annual</strong></h2>
                        <h4 class="inline-block leading-none"><strong>${{ number_format(200 / 12, 2) }}/month</strong></h4>
                        <p class="text-sm mb-6"><em>Billed at ${{200}} per year.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for 7 days</div>
                    </div>
                </a>
                <div class="text-black overflow-hidden rounded-b-2xl block mx-auto group px-3 pt-5 md:pt-6 pb-9 md:pb-10 bg-[#e7edf4]">
                    <p class="text-sm mb-1"><strong>{{ $firstPoint }}</strong></p>
                    <p class="text-sm mb-1">Join a community of {{ number_format(Prices::$students) }} students.</p>
                    <p class="text-sm mb-1">{{ $fifthPoint }}</p>
                    <p class="text-sm mb-2">90-day money back guarantee.</p>
                    <a class="cursor-pointer" x-on:click="plusMembershipSelected = true"><p class="text-sm text-{{ $theme }}">You can add {{ $songs }}+ popular songs<br> for just $40/year. <u>Click Here.</u></p></a>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-2 md:px-3 mb-4 md:mb-0 relative">
                <a href="{{$monthlyLink}}" class="text-black overflow-hidden rounded-t-2xl block mx-auto group">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="leading-none mb-6"><strong>Monthly</strong></h2>
                        <h4 class="inline-block leading-none"><strong>${{ 25 }}/month</strong></h4>
                        <p class="text-sm mb-6"><em>Pay as you go.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for 7 days</div>
                    </div>
                </a>
                <div class="text-black overflow-hidden rounded-b-2xl block mx-auto group px-3 pt-5 md:pt-6 pb-9 md:pb-10 bg-[#e7edf4]">
                    <p class="text-sm mb-1"><strong>{{ $firstPoint }}</strong></p>
                    <p class="text-sm mb-1">Join a community of {{ number_format(Prices::$students) }} students.</p>
                    <p class="text-sm mb-1">{{ $fifthPoint }}</p>
                    <p class="text-sm mb-2">90-day money back guarantee.</p>
                    <a class="cursor-pointer" x-on:click="plusMembershipSelected = true"><p class="text-sm text-{{ $theme }}">You can add {{ $songs }}+ popular songs<br> for just $40/year. <u>Click Here.</u></p></a>
                </div>
            </div>
        </div>
        <p><em>All prices listed in USD.</em></p>
    </div>
</section>
