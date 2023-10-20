<section class="text-center relative overflow-hidden py-10 md:py-14 lg:py-16 px-6 sm:px-7">
    <div class="container mx-auto max-w-4xl">
        <h2 class="leading-tight"><strong>{!!  $title  !!}</strong></h2>
        <h4 class="leading-tight mt-2">(You'll Love Reason #5...)</h4>

        <div class="flex flex-wrap items-center justify-center mt-3 sm:mt-5 mx-auto">
            <a aria-label="Review" class="inline-block sm:hidden" href="https://www.shopperapproved.com/reviews/Musora.com">
                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>{{ number_format(round(Prices::$reviews, -2)) }}+ Reviews</em></u></p>
            </a>
            <a aria-label="Review" class="hidden sm:inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>{{ number_format(round(Prices::$reviews, -2)) }}+ Reviews</em></u></p>
            </a>
        </div>
        <picture>
            <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=1800,quality=95/{{ $header }}">
            <img
                class="w-full my-6 lg:my-10 transition-opacity opacity-0"
                src="https://www.musora.com/musora-cdn/image/width=600,quality=95/{{ $header }}"
                alt="header image"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
        </picture>
        <p class="text-left mb-12 lg:mb-20">{!!  $subHeader  !!}</p>

        @foreach($points as $point)
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-16 sm:mb-20">
                <picture class="@if(!empty($point['guarantee'])) w-36 @else w-full @endif sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/{!! $point['image'] !!}">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/{!! $point['image'] !!}"
                    >
                </picture>
                <div class="sm:pl-9 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>{!! $point['title'] !!}</strong></h4>
                    <p>{!! $point['description'] !!}</p>
                </div>
            </div>
        @endforeach

        <a class="join musora-gold mb-20 sm:mb-44 w-full" href="/choose-plan">START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>

        <h2><strong>The Best Music<br class="sm:hidden"> Lessons Ever!</strong></h2>
        <div class="flex flex-wrap my-5 sm:my-9">
            @php
                $reviews = [
                    [
                    "title" => "The most positive student-focused place!",
                    "description" => "I could not be more THRILLED with Musora!!! This is the most positive, helpful, caring, innovative, knowledgeable, student-focused place on the planet!!! It has been a Godsend for me! <br><br><strong>Kristyn T.</strong>",
                    ],
                    [
                    "title" => "All the instruments for a great price. ",
                    "description" => "I love the fact that I have access to many instruments for a great price. I'm learning to play the piano, which was a passion that I hadn't fulfilled in the past but now I'm so happy for it.<br><br><strong>Juan C.</strong>",
                    ],
                    [
                    "title" => "My daughter danced to my playing!",
                    "description" => "The lightbulb moment happened when my 6 year old daughter started dancing as I played – you must be doing something right if somebody dances when you’re playing, right?<br><br><strong>John M.</strong>",
                    ],
                    [
                    "title" => "Helpful lessons and supportive community. ",
                    "description" => "The materials are in helpful bite-size chunks, the support materials are excellent, the tutors are cheerful, and the online community is very supportive.<br><br><strong>Devon F.</strong> ",
                    ],
                    [
                    "title" => "The best course I’ve ever taken",
                    "description" => "There's really no comparative substitute to learning music. Any way you can learn, I say go for it, but this is the best course I have ever taken.<br><br><strong>Russ W.</strong>",
                    ],
                    [
                    "title" => "Tremendous value. ",
                    "description" => "The value you get with Musora is tremendous. Whether you want to learn to sing, play guitar, play drums, or piano, this site has you covered.<br><br><strong>Dennis R.</strong>",
                    ],
                    [
                    "title" => "Awesome to learn from home!",
                    "description" => "It’s just so awesome to know that I can learn from home and accomplish one of my dreams.<br><br><strong>Jayde M.</strong>",
                    ],
                    [
                    "title" => "Wish I was taught this way earlier!",
                    "description" => "If I had been taught this way as a child, I probably never would have quit<br><br><strong>Serena D.</strong>",
                    ],
                ]
            @endphp
        <div class="hidden sm:flex flex-wrap items-start text-left justify-center">
            @foreach($reviews as $review)
                <div class="w-full sm:w-1/3 lg:w-1/4 px-2 lg:px-1 mb-4 lg:mb-2 ">
                    <div class="border-2 border-black rounded-xl px-5 py-9">
                        <div class="text-center">
                            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                            <h6 class="leading-tight mt-5 mb-4"><strong>{!! $review['title'] !!}</strong></h6>
                        </div>
                        <div>
                            <p class="leading-normal text-sm">{!! $review['description'] !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

            <div class="relative flex sm:hidden w-full"
                x-data="{
        init() {
            new Splide(this.$refs.splide, {
                        classes: {
                                arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                                prev: 'hidden',
                                next: 'hidden',
                                pagination: 'hidden',
                        },
                        perPage: 1.5,
                        drag   : 'free',
                        snap   : false,
                        perMove: 1,
                        type: 'loop',
                        focus: 0,
                        interval: 2000,
            }).mount()
        },
    }"
            >
                <div x-ref="splide" class="w-full splide">
                    <div class="splide__track relative">
                        <ul class="splide__list">
                            @foreach($reviews as $review)
                                <li class="splide__slide flex flex-col items-center justify-center">
                                    <div class="flex flex-wrap items-start w-full sm:w-1/3 px-2 lg:px-3 mb-4 lg:mb-6 text-left">
                                        <div class="border-2 border-black rounded-xl px-5 py-9">
                                            <div class="text-center">
                                                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                <h6 class="leading-tight mt-5 mb-4"><strong>{!! $review['title'] !!}</strong></h6>
                                            </div>
                                            <div>
                                                <p class="leading-normal text-sm">{!! $review['description'] !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <a aria-label="Review" class="hidden sm:inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
            <br>
            <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>See {{ number_format(round(Prices::$reviews, -2)) }}+ More Student Reviews</em></u></p>
        </a>
        <a aria-label="Review" class="inline-block sm:hidden" href="https://www.shopperapproved.com/reviews/Musora.com">
            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
            <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
            <br>
            <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>See {{ number_format(round(Prices::$reviews, -2)) }}+ More Student Reviews</em></u></p>
        </a>
        <br>
        <a class="join musora-gold mt-12 w-full" href="/choose-plan">START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>
    </div>
</section>
