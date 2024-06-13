<section class="text-center @if(empty($whiteBg)) text-white @endif px-4 sm:px-6 py-10 sm:py-14 lg:py-20"
    @if(!empty($whiteBg))
        style="background:linear-gradient(to bottom, #fff 33%, #e9eaec);"
    @else
        style="background:#0c1524;"
    @endif

    x-data="{ plusMembershipSelected: true }"
>
    <div class="container max-w-6xl mx-auto">
        <h1 class="leading-tight"><strong>
                @if(!empty($headline)) {!! $headline  !!}  @else Your first @if(empty($month)) week @else month @endif <br class="inline sm:hidden"> is free. @endif</strong></h1>
        <h5 class="mt-2 md:mt-4 mb-5">Choose the plan that will continue on <br class="inline lg:hidden">
            @if(empty($month)) {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }} @else {{ Carbon\Carbon::now()->addDays(30)->format('F jS') }} @endif
            (after your free trial). Cancel anytime.</h5>

        <div id="plusOptions"
            class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto"
            x-bind:class="{ 'hidden': !plusMembershipSelected }"
        >
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <a href="{{$plusMonthlyLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif" aria-label="Monthly Plan">
                    <div class="bg-white px-3 py-5 md:py-7">
                        <h2 class="mb-2 sm:mb-3 text-3xl lg:text-4xl"><strong>Monthly</strong></h2>
                        <h4 class="inline-block leading-tight"><strong>${{ Prices::$plusSubscriptionMonthly }}/month</strong></h4>
                        <p class="text-sm"><em>Pay as you go.</em></p>
                        <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0">Free for @if(!empty($month)) 1 Month @else 7 days @endif </div>
                        <p class="text-sm mb-1.5"><strong>{{ $firstPoint }}</strong></p>
                        <p class="text-sm mb-1.5"><strong>{{ $songs }}</strong></p>
                        <p class="text-sm mb-1.5"><strong>{{ $thirdPoint }}</strong></p>
                        <p class="text-sm mb-1.5">Join a community of {{ number_format(Prices::$students) }} students.</p>
                        @if(!empty($fifthPoint))
                            <p class="text-sm mb-1.5">{{ $fifthPoint }}</p>
                        @endif
                        <p class="text-sm mb-1.5">90-day money-back guarantee.</p>
                        <p class="text-sm">Cancel anytime.</p>
                    </div>
                </a>
            </div>
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-{{ $theme }} @if($theme == 'musora') text-black @endif" >MOST POPULAR</p>
                <a href="{{$plusAnnualLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-{{ $theme }}" aria-label="Plan">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="mb-2 sm:mb-3 text-3xl lg:text-4xl"><strong>Annual</strong></h2>
                        <h4 class="inline-block leading-tight"><strong>${{ number_format(Prices::$plusSubscriptionAnnualFull / 12) }}/month</strong></h4>
                        <p class="text-sm"><em>Save 33%. Billed at ${{Prices::$plusSubscriptionAnnualFull}} per year.</em></p>
                        <div class="join my-5 {{ $theme }} smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0">Free for @if(!empty($month)) 1 Month @else 7 days @endif </div>
                        <p class="text-sm mb-1.5"><strong>{{ $firstPoint }}</strong></p>
                        <p class="text-sm mb-1.5"><strong>{{ $songs }}</strong></p>
                        <p class="text-sm mb-1.5"><strong>{{ $thirdPoint }}</strong></p>
                        <p class="text-sm mb-1.5">Join a community of {{ number_format(Prices::$students) }} students.</p>
                        @if(!empty($fifthPoint))
                            <p class="text-sm mb-1.5">{{ $fifthPoint }}</p>
                        @endif
                        <p class="text-sm mb-1.5">90-day money-back guarantee.</p>
                        <p class="text-sm">Cancel anytime.</p>
                    </div>
                </a>
            </div>
        </div>
        @if(empty($month) && empty($noSelector))
            <div id="nonPlusOptions"
                    class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto"
                    x-cloak
                    x-bind:class="{ 'hidden': plusMembershipSelected }"
            >
                <div class="w-full md:w-1/2 px-2 md:px-3 mb-4 md:mb-0 relative">
                    <a href="{{$monthlyLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif" aria-label="Monthly Plan">
                        <div class="bg-white px-3 py-5 md:py-7">
                            <h2 class="mb-2 sm:mb-3 text-3xl lg:text-4xl"><strong>Monthly</strong></h2>
                            <h4 class="inline-block leading-tight"><strong>${{ 25 }}/month</strong></h4>
                            <p class="text-sm"><em>Pay as you go.</em></p>
                            <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0">Free for 7 days</div>
                            <p class="text-sm mb-1.5"><strong>{{ $firstPoint }}</strong></p>
                            <p class="text-sm mb-1.5"><strong>{{ $thirdPoint }}</strong></p>
                            <p class="text-sm mb-1.5">Join a community of {{ number_format(Prices::$students) }} students.</p>
                            @if(!empty($fifthPoint))
                                <p class="text-sm mb-1.5">{{ $fifthPoint }}</p>
                            @endif
                            <p class="text-sm mb-1.5">90-day money-back guarantee.</p>
                            <p class="text-sm">Cancel anytime.</p>
                        </div>
                    </a>
                </div>
                <div class="w-full md:w-1/2 px-2 md:px-3 mb-4 md:mb-0 relative">
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-{{ $theme }} @if($theme == 'musora') text-black @endif">MOST POPULAR</p>
                    <a href="{{$annualLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto group border-2 border-{{ $theme }}" aria-label="Annual Plan">
                        <div class="bg-white px-3 py-6 md:py-9">
                            <h2 class="mb-2 sm:mb-3 text-3xl lg:text-4xl"><strong>Annual</strong></h2>
                            <h4 class="inline-block leading-tight"><strong>${{ number_format(200 / 12, 2) }}/month</strong></h4>
                            <p class="text-sm"><em>Save 33%. Billed at ${{200}} per year.</em></p>
                            <div class="join my-5 {{ $theme }} smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0">Free for 7 days</div>
                            <p class="text-sm mb-1.5"><strong>{{ $firstPoint }}</strong></p>
                            <p class="text-sm mb-1.5"><strong>{{ $thirdPoint }}</strong></p>
                            <p class="text-sm mb-1.5">Join a community of {{ number_format(Prices::$students) }} students.</p>
                            @if(!empty($fifthPoint))
                                <p class="text-sm mb-1.5">{{ $fifthPoint }}</p>
                            @endif
                            <p class="text-sm mb-1.5">90-day money-back guarantee.</p>
                            <p class="text-sm">Cancel anytime.</p>
                        </div>
                    </a>
                </div>
            </div>
        @endif

        @if(empty($month) && empty($noSelector))
            <p x-bind:class="{ 'hidden': !plusMembershipSelected }">Or choose
                <u class="text-drumeo cursor-pointer" x-bind:class="{ 'active': !plusMembershipSelected }" x-on:click="plusMembershipSelected = false" role="button" tabindex="0">lessons only</u>
                to save 17%. (no songs)</p>
            <p class="text-drumeo cursor-pointer" x-cloak x-bind:class="{ 'hidden': plusMembershipSelected }">
                <u x-bind:class="{ 'active': plusMembershipSelected }" x-on:click="plusMembershipSelected = true" role="button" tabindex="0">Click here to add songs.</u></p>
        @endif

        <p><em>All prices listed in USD.</em></p>
    </div>
</section>
