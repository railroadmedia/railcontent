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
            class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-3xl lg:max-w-4xl mb-5 sm:mb-10 mx-auto"
            x-bind:class="{ 'hidden': !plusMembershipSelected }"
        >
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <a href="{{$firstDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif" style="margin-top: 30px">
                    <div class="bg-white px-3 py-6 md:py-8" style="border-bottom: 1px solid white">
                        <h2 class="mb-2 sm:my-3 text-3xl lg:text-4xl"><strong>{{$firstDeal}}</strong></h2>
                        <img
                                        class="{{$firstImageHeight}} rounded-md transition-opacity opacity-0"
                                        src={{ $firstDealImage }}
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        alt="card image"
                                    >
                        <h3 class="leading-tight pt-2">
                            @if(!empty($firstDealDiscount))
                                <span class="line-through" style="color: #879097; margin-right: 5px;"> ${{$firstDealDiscount}} </span>
                            @endif
                            <strong>${{$firstDealPrice}}</strong>
                        </h3>                        
                        <p class="text-sm"><em>{{$firstDealSub}}</em></p>
                        <div class="join my-5 smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px] {{ $theme }}">{{$buttonText}}</div>
                    </div>
                        @if(!empty($firstExtraBonuses))
                            <div class="px-4 md:px-6 lg:px-10 py-8" style="background:#F6F8FC">
                            @foreach($firstExtraBonuses as $bonus)
                            <p class="text-left text-sm mb-1.5 leading-tight">{!! $bonus !!}</p> 
                            @endforeach
                            </div>
                        @endif
                </a>
            </div>
            
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-{{ $theme }} @if($theme == 'musora') text-black @endif" >{{$topBadge}}</p>
                <a href="{{$secondDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-{{ $theme }}">
                    <div class="bg-white px-3 py-6 md:py-9">
                        <img
                                        class="absolute top-0 right-0 h-20 transition-opacity opacity-0"
                                        src={{ $badge }}
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        alt="free shipping badge"
                                    >
                        <h2 class="mb-2 sm:mb-3 text-3xl lg:text-4xl pt-4 md:pt-0"><strong>{{$secondDeal}}</strong></h2>
                         <img
                                        class="{{$secondImageHeight}} rounded-md transition-opacity opacity-0 transition-opacity opacity-0"
                                        src={{ $secondDealImage }}
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        alt="card image"
                                    >
                        <h3 class="leading-tight">
                            <span class="line-through" style="color: #879097; margin-right: 5px;">${{$secondDealDiscount}}</span>
                            <strong>${{$secondDealPrice}}</strong>
                        </h3>                        
                        <p class="text-sm"><em>{{$secondDealSub}}</em></p>
                        <div class="join my-5 {{ $theme }} smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]"> {{$buttonText}} </div>
                   </div>
                        @if(!empty($secondExtraBonuses))
                        <div class="px-4 md:px-6 lg:px-10 py-8" style="background:#F6F8FC">
                            @foreach($secondExtraBonuses as $bonus)
                            <p class="text-left text-sm mb-1.5">{!! $bonus !!}</p> 
                            @endforeach
                            </div>
                        @endif
                </a>
            </div>
        </div>
    </div>
</section>
