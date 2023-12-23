<section class="text-center text-white  px-4 sm:px-6 py-10 sm:py-14 lg:py-20"
        style="background:linear-gradient(to bottom, #0C1524, #062746);"
    x-data="{ plusMembershipSelected: true }"
>
    <div class="container max-w-6xl mx-auto">

        <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl sm:mb-10 lg:mb-10 font-lexend leading-tight uppercase        ">
            <strong>{!! $header !!}</strong>
            @if(!empty($underline))
                <svg class="w-64 sm:w-72 lg:w-96 sm:absolute -mt-4 sm:mt-0 sm:-bottom-1 sm:px-6" style="right:6%;"
                    xmlns="http://www.w3.org/2000/svg" width="524" height="22" viewBox="0 0 524 22" fill="none">
                    <path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="@if(!empty($fillColor)) {{ $fillColor }} @else #ffac00 @endif" stroke-width="3" stroke-linecap="round"/>
                    <path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="@if(!empty($fillColor)) {{ $fillColor }} @else #ffac00 @endif" stroke-width="3" stroke-linecap="round"/>
                </svg>
            @endif
        </h1>
        <p class="text-sm leading-normal tracking-widest mb-5 lg:mb-7">
            <i class="fas fa-check text-{{ $theme }}"></i> {!! $pointOne !!}
            <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> {!! $pointTwo !!}
            <br class="lg:hidden">
            <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> {!! $pointThree !!}
            <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> {!! $pointFour !!}
        </p>

        <div id="plusOptions"
            class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto"
            x-bind:class="{ 'hidden': !plusMembershipSelected }"
        >
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <a href="{{$plusMonthlyLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif">
                    <div class="bg-white px-3 py-5 md:py-7">
                        <h2 class="mb-2 sm:mb-3 text-3xl lg:text-4xl"><strong>Monthly</strong></h2>
                        <h4 class="inline-block leading-tight"><strong>${{ Prices::$plusSubscriptionMonthly }}/month</strong></h4>
                        <p class="text-sm"><em>Pay as you go.</em></p>
                        <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for @if(!empty($month)) 1 Month @else 7 days @endif </div>
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
                <a href="{{$plusAnnualLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-{{ $theme }}">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <h2 class="mb-2 sm:mb-3 text-3xl lg:text-4xl"><strong>Annual</strong></h2>
                        <h4 class="inline-block leading-tight"><strong>${{ number_format(Prices::$plusSubscriptionAnnualFull / 12) }}/month</strong></h4>
                        <p class="text-sm"><em>Save 33%. Billed at ${{Prices::$plusSubscriptionAnnualFull}} per year.</em></p>
                        <div class="join my-5 {{ $theme }} smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Free for @if(!empty($month)) 1 Month @else 7 days @endif </div>
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


        <p><em>All prices listed in USD.</em></p>
    </div>
</section>
