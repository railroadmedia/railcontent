@if(!empty($vid))
    <div class="h-96 sm:h-[720px] cursor-pointer autoplay-video w-full relative z-20 bg-black" x-on:click="trailer = true;">
        <div class="absolute top-0 left-0 right-0 text-white z-20 text-center px-4 pt-7 sm:pt-10">
            <h1 class="font-lexend  text-3xl sm:text-5xl lg:text-6xl leading-none uppercase mb-3"><strong>PLAY TO LEARN</strong></h1>
            <h4 class="leading-tight">Improve your skills in<br class="sm:hidden"> just 10 minutes a day.</h4>
        </div>
        <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-20 mt-5"></i>
        <div class="h-full w-full absolute top-0 left-0 right-0 bottom-0 z-10 bg-{{ $theme }} opacity-50"></div>
        <div class="h-full w-full absolute top-0 left-0 right-0 bottom-0 z-10 bg-black opacity-20"></div>
        <video class="object-cover w-full h-full absolute z-0 lazyload" data-src="{{ $vid }}" type="video/mp4" autoplay muted loop playsinline></video>
    </div>
@else
    <section class="text-center px-5 sm:px-6 pt-5 sm:pt-7">
        <div class="container max-w-5xl mx-auto">
            <div class="p-5 bg-white">
                <h1 class="font-lexend  text-3xl sm:text-5xl lg:text-6xl leading-none uppercase mb-3"><strong>PLAY TO LEARN</strong></h1>
                <h4 class="leading-tight">Improve your skills in<br class="sm:hidden"> just 10 minutes a day.</h4>
            </div>
        </div>
    </section>
    <div class=" overflow-hidden mx-auto text-center relative">
        <div class="inline-block mx-auto left-1/2 relative xl:w-full" style="    transform: translate(-50%, 0);">
            <div class="flex flex-wrap justify-center mx-auto w-[965px] sm:w-[1485px] xl:w-[1665px]">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 2s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-01.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-artists-01.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 4s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-02.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 2s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-03.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-instruments-01.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 4s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-04.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 2s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-05.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-06.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 2s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-07.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-instruments-02.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-08.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 4s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-artists-02.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 2s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-09.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 4s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-10.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 2s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-11.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-artists-03.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 4s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-12.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 2s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-13.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-instruments-03.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-14.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 2s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-15.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-16.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-instruments-04.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 2s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-17.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;animation-delay: 4s;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-artists-04.jpg">
                <img class="h-20 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity" style="animation: breathing 6s infinite;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts/workouts-thumbs-18.jpg">
            </div>
        </div>
    </div>
@endif
<section class="text-center px-5 sm:px-6 pt-5 sm:pt-7 pb-10 sm:pb-14 lg:pb-20">
    <div class="container max-w-5xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap justify-center text-left">
            <div class="w-full sm:w-1/2">
                <div class="rounded-xl px-7 lg:px-10 py-7 lg:py-14 mb-5 lg:mb-7 clearfix" style="background-color:#f6f8fc;">
                    <h5 class="leading-tight mb-3"><strong>Your daily energy boost.</strong></h5>
                    <h6 class="leading-normal">
                        You shouldn't lose momentum between lessons. We’ll help you play every
                        <i class="fal fa-bolt inline text-6xl pt-3 pl-3 text-{{ $theme }} float-right"></i>
                        day with fun guided practice sessions.
                    </h6>
                </div>
                <div class="rounded-xl px-7 lg:px-10 py-7 lg:py-14 clearfix" style="background-color:#f6f8fc;">
                    <h5 class="leading-tight mb-3"><strong>Build better habits. </strong></h5>
                    <h6 class="leading-normal">
                        The best way to build habits is to start with small habits. Our
                        <i class="fal fa-user-clock inline text-6xl pt-3 pl-3 text-{{ $theme }} float-right"></i>
                        bite-sized sessions make it easier to practice & play more often.
                    </h6>
                </div>
            </div>
            <div class="mt-5 sm:mt-0 sm:pl-7 sm:w-1/2 flex-grow-0">
                <div class="h-full rounded-xl p-7 lg:p-10 pb-64 sm:pb-48 bg-black @if($theme != 'musora') text-white @else text-black @endif flex bg-cover bg-top" style="background-image:url('{{ $workoutsBG }}');">
                    <div>
                        <h5 class="leading-tight mb-3"><strong>
                                @if($theme == 'drumeo' || $theme == 'pianote')
                                    Practice with your heroes.
                                @else
                                    Never practice alone.
                                @endif
                            </strong></h5>
                        <h6 class="leading-normal max-w-lg mx-0">
                            Your favorite
                            @php
                                if($theme == 'drumeo'){
                                    echo 'drummers';
                                }
                                elseif($theme == 'pianote'){
                                    echo 'pianists';
                                }
                                elseif($theme == 'guitareo'){
                                    echo 'guitarists';
                                }
                                elseif($theme == 'singeo'){
                                    echo 'singers';
                                }
                                else{
                                    echo 'musicians';
                                }
                            @endphp
                             and teachers will share their tips, cheer you along, and help you learn by playing!
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
