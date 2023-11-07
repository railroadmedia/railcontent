<section class="{{ $bgClass }}" aria-label="Items">
    <div class="container max-w-6xl mx-auto px-4 lg:px-0 lg:flex">
        <div x-data="{ openItem: null }" class="text-center text-white w-full sm:w-auto pt-6 lg:mt-0 mx-auto px-4 pb-6 md:pb-28">
            <div class="flex flex-wrap items-top">
                @foreach ($songItems as $i => $songItem)
                    <div class="dropdown-box w-full sm:w-1/3 h-34 flex sm:items-start p-6 rounded-xl lg:my-6 leading-loose">
                        <div role="button" @click="openItem === {{ $i }} ? openItem = null : openItem = {{ $i }}"
                             class="flex sm:inline-block cursor-pointer sm:cursor-default w-full">
                            <div class="pr-3 sm:w-full text-left sm:text-center">
                                <i class="{{ $songItem['icon'] }} h-6 sm:h-10 text-{{$brand}} text-xl sm:text-4xl" aria-label="icon"></i>
                            </div>
                            <div class="w-4/5 sm:w-full text-left sm:text-center">
                                <h5 class="py-2 md:py-4">
                                    <strong>{!! $songItem['title'] !!}</strong>
                                </h5>
                                <p class="hidden sm:block">
                                    {!! $songItem['desc'] !!}
                                </p>
                                <div x-show="openItem === {{ $i }}" x-cloak
                                    class="text-sm md:hidden text-lg bg-gradient-to-b from-slate-900 to-slate-900 md:bg-none">
                                    {!! $songItem['desc'] !!}
                                </div>
                            </div>
                        </div>
                        <span class="w-5 h-5 sm:hidden inline cursor-pointer"
                            role="button"
                            x-bind:class="{ 'hidden': openItem === {{ $i }} }"
                            @click="openItem = (openItem === {{ $i }} ? null : {{ $i }})"><i class="fa-regular fa-plus text-{{$brand}}" aria-label="Toggle"></i></span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
