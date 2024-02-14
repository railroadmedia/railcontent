<section class="text-center text-white  px-4 sm:px-6 py-10 sm:py-14 lg:py-20"
        style="background:linear-gradient(to bottom, #0C1524, #062746);"
    x-data="{ plusMembershipSelected: true }"
>
    <div class="container max-w-5xl mx-auto">

        <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 lg:mb-10 font-lexend leading-none sm:leading-none lg:leading-none uppercase">
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
        @if($theme == 'drumeo')
            @if ($products['alesis-ekit']->getStockAvailability() < 1 && !empty($products['alesis-ekit']->getStockAvailability()))
            <div class="bg-drumeo rounded-md sm:rounded-full px-6 sm:pl-6 sm:pr-2 py-2 inline-block w-auto mb-5 lg:mb-7">
                <h5 class="inline-block align-middle mb-2 sm:mb-0 sm:mr-4"><strong>The E-Kit Bundle is sold out. </strong></h5><br class="sm:hidden">
                <div class="inline-block join white smaller" @click="waitlist = true;">JOIN THE WAITLIST</div>
            </div>
            @endif
            @if(!empty($recaptchaKey))
                @component('_partials.components.modal',[
                    'name' => 'waitlist',
                ])
                    @slot('content')
                        <div class="relative overflow-y-visible max-w-3xl px-4 md:px-5 lg:px-7 py-5 md:py-7 lg:py-10 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                            <h3 class="leading-tight mb-5"><strong>Notify Me When They’re Back</strong></h3>
                            @include("drumeo.lead-gen.partials.sign-up-form", [
                                "formId" => "Drumeo - Engagement - Trigger - Alesis Waitlist - Web Form",
                                "formName" => 'Alesis Waitlist',
                                "buttonText" => "Notify Me",
                                'stacked' => true,
                                "redirectURL" => "/drumshop/kit?thankyou",
                                "recaptchaKey" => $recaptchaKey,
                                "minimalForm" => true
                            ])

                        </div>
                    @endslot
                @endcomponent
            @endif
        @endif
        <div id="plusOptions"
            class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-3xl lg:max-w-4xl mb-5 sm:mb-10 mx-auto"
            x-bind:class="{ 'hidden': !plusMembershipSelected }"
        >
            <div class="w-full md:w-1/2 lg:px-3 @if($theme == 'drumeo') order-1 @else md:order-1 @endif px-1 relative">
                @if(!empty($badge))
                <img class="absolute top-0 right-0 h-20 lg:h-24 z-10 -mt-3 -mr-3 transition-opacity opacity-0"
                    loading="lazy" onload="this.classList.remove('opacity-0')" alt="free shipping badge"
                    src={{ $badge }}>
                @endif
                @if(!empty($topBadge))
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-{{ $theme }} @if($theme == 'musora') text-black @endif" >{{$topBadge}}</p>
                @endif
                <div  class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 @if($theme != 'drumeo') border-{{ $theme }} @endif">
                    <div class="bg-white px-3 py-6 md:py-7">
                        <h3 class="leading-tight mb-2"><strong>{{$secondDeal}}</strong></h3>
                        <img
                            class="{{$secondImageHeight}} rounded-md transition-opacity opacity-0"
                            src="{{ $secondDealImage }}"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            alt="card image"
                        >
                        <h3 class="leading-tight mt-2">
                            <span class="line-through" style="color: #879097; margin-right: 5px;">${{$secondDealDiscount}}</span>
                            <strong>${{$secondDealPrice}}</strong>
                        </h3>
                        <p class="text-sm mb-5"><em>{!! $secondDealSub !!}</em></p>
                        @if(!empty($secondTwoButtons))
                            <div class="flex items-center">
                                <a href="{{$secondDealLink}}" class="mx-1 join {{ $theme }} smaller w-1/2 transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]"> {{$buttonText}} </a>
                                <a href="/drumshop/kit" class="mx-1 join black outline smaller w-1/2 transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]"> {{$secondTwoButtons}} </a>
                            </div>
                        @else
                            <a href="{{$secondDealLink}}" class="join {{ $theme }} smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]"> {{$buttonText}} </a>
                        @endif
                    </div>
                    @if(!empty($secondExtraBonuses))
                        <div class="px-4 sm:px-4 lg:px-6 py-7" style="background:#F6F8FC">
                            @foreach($secondExtraBonuses as $bonus)
                                <p class="text-left text-sm mb-1.5">{!! $bonus !!}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:px-3 px-1 relative">
                <a href="{{$firstDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif"
                    @if(!empty($topBadge)) style="margin-top: 30px" @endif>
                    <div class="bg-white px-3 py-6 md:py-7" style="border-bottom: 1px solid white">
                        <h3 class="leading-tight mb-2"><strong>{{$firstDeal}}</strong></h3>
                        <img
                                        class="{{$firstImageHeight}} rounded-md transition-opacity opacity-0"
                                        src={{ $firstDealImage }}
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        alt="card image"
                                    >
                        <h3 class="leading-tight mt-2">
                            @if(!empty($firstDealDiscount))
                                <span class="line-through" style="color: #879097; margin-right: 5px;"> ${{$firstDealDiscount}} </span>
                            @endif
                            <strong>${{$firstDealPrice}}</strong>
                        </h3>
                        <p class="text-sm mb-5"><em>{!! $firstDealSub !!}</em></p>
                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px] {{ $theme }}">{{$buttonText}}</div>
                    </div>
                        @if(!empty($firstExtraBonuses))
                            <div class="px-4 sm:px-4 lg:px-6 py-7" style="background:#F6F8FC">
                            @foreach($firstExtraBonuses as $bonus)
                            <p class="text-left text-sm mb-1.5 leading-tight">{!! $bonus !!}</p>
                            @endforeach
                            </div>
                        @endif
                </a>
            </div>
        </div>
    </div>
</section>
