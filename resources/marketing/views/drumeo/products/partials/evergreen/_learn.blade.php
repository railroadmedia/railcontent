<section class="px-3 sm:px-0 text-center customize relative z-50 overflow-hidden lazyload" style="background: #eff7ff;">
    <div class="container max-w-6xl mx-auto relative z-50" style="background: #eff7ff;" data-bg={{ $mainImage }}>
        <div class="flex flex-wrap items-center px-4 sm:px-6 pt-10">
            <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5" style="background: #eff7ff;">
                <img class="h-20 sm:h-24 lg:h-26 -mb-3 sm:mb-0 lg:mb-3 lazyload" data-src="{{ $logo }}"
                    alt="{{ $logoAlt }}">
                <h1 class="py-6 sm:py-4"><strong>{!! $title !!}</strong></h1>
                <div class="text-center sm:text-left sm:pb-5">
                    <ul>
                        @foreach ($points as $index => $point)
                            @if ($loop->last)
                                <li class="text-{{ $brand }}">
                                    <p class="pt-2"><i class="fas fa-sharp fa-solid fa-certificate pr-1"></i>
                                        <strong>{{ $point }}</strong></p>
                                </li>
                            @else
                                <li>
                                    <p class="pt-2"><i class="fas fa-check text-{{ $brand }} pr-1"></i>
                                        {{ $point }}</p>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="flex flex-wrap flex-col sm:flex-nowrap md:flex-row items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full md:w-2/3 text-center sm:pr-2 my-1">
                            {{-- <a href={{$buttonLink}} class="join blue medium w-full anchor-slide" role="button">{{ $buttonText }}</a> --}}

                            <div class="w-full">
                                @include('drumeo.products.partials.evergreen._button', [
                                    'link' => $buttonLink,
                                    'buttonClass' => 'text-white font-bebas tracking-widest',
                                    'buttonText' => $buttonText,
                                ])
                            </div>
                        </div>

                        <div class="w-full md:w-2/3 sm:flex py-2 md:py-0 items-center">
                             @if ($numStudents > 500)
                            <img class="h-7 mr-2 lazyload" data-src="{{ $studentProfilesImage }}"
                                alt="{{ $profileImageAlt }}">
                            <span class="inline-block align-middle leading-tight text-xs py-2">Join {{ $numStudents }}
                                {{ $students }} who have already registered.</span>
                            @endif
                        </div>

                    </div>
{{--                    @if (!empty($price) || !empty($enrollmentLink) || !empty($brandTitle))--}}
{{--                <p class="text-sm mb-5 sm:mb-0 hover:text-{{ $brand }} py-4 text-center">--}}
{{--                    @if (!empty($price))--}}
{{--                        <a href={{ $enrollmentLink }}>--}}
{{--                            <span class="text-black text-2xl block">--}}
{{--                                <strong>{{ $price }}</strong>--}}
{{--                            </span>--}}
{{--                            <span class="opacity-50 underline"> Or click here to get it free with a {{ $brandTitle }}--}}
{{--                                Membership.</span>--}}
{{--                        </a>--}}
{{--                    @else--}}
{{--                        <a href={{ $enrollmentLink }}>--}}
{{--                            <span class="text-black leading-tight mb-1 md:mb-2">--}}
{{--                                <strong>{{ $price }}</strong>--}}
{{--                            </span>--}}
{{--                            Get it free with a {{ $brandTitle }} Membership.--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                </p>--}}
{{--            @endif--}}
                </div>
            </div>
            <div
                class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 mt-7 sm:mt-0 hidden sm:block">
                <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl lazyload pb-4" data-src={{ $mainImage }} alt="collage">
            </div>
        </div>
    </div>
    <div class="w-full sm:hidden text-center py-8">
                <img class="lazyload" data-src={{ $mainImage }} alt="collage">
            </div>
</section>
