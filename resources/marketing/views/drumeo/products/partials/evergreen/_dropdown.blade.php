<section class="{{ $bgClass }}">
    <div class="container max-w-6xl mx-auto px-4 lg:px-0 lg:flex">
        <div x-data="{ openItem: null }" class="text-center text-white w-full sm:w-auto pt-6 lg:mt-0 mx-auto px-4 pb-6 md:pb-28">
            <div class="flex flex-wrap items-top">
                @foreach ($songItems as $i => $songItem)
                    <div class="dropdown-box w-full sm:w-1/3 h-34 flex sm:items-start px-6 py-6 mb-6 rounded-xl lg:my-6">
                        <div @click="openItem === {{ $i }} ? openItem = null : openItem = {{ $i }}"
                            class="flex sm:inline-block cursor-pointer w-full">
                            <div class="pr-3 sm:w-full text-left sm:text-center">
                                <i class="{{ $songItem['icon'] }} h-6 sm:h-10 text-{{$brand}} text-xl sm:text-4xl"></i>
                            </div>
                            <div class="w-4/5 sm:w-full text-left sm:text-center">
                                <p class="mb-1 sm:my-2 text-lg md:text-xl">
                                    <strong>{!! $songItem['title'] !!}</strong>
                                </p>
                                <div class="text-base md:text-lg hidden sm:block">
                                    {!! $songItem['desc'] !!}
                                </div>
                                <div x-show="openItem === {{ $i }}" x-cloak
                                    class="text-sm md:hidden text-lg bg-gradient-to-b from-slate-900 to-slate-900 md:bg-none">
                                    {!! $songItem['desc'] !!}
                                </div>
                            </div>
                        </div>
                        <span class="w-5 h-5 sm:hidden inline cursor-pointer"
                            x-bind:class="{ 'hidden': openItem === {{ $i }} }"
                            @click="openItem = (openItem === {{ $i }} ? null : {{ $i }})"><i class="fas fa-regular fa-plus text-{{$brand}}"></i></span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
