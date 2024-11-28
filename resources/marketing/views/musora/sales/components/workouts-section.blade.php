@if(!empty($vid))
    <div class="h-96 sm:h-[720px] cursor-pointer autoplay-video w-full relative z-20 bg-black" x-on:click="trailer = true;">
        <div class="absolute top-0 left-0 right-0 text-white z-20 text-center px-4 pt-7 sm:pt-10">
            <h1 class="font-lexend  text-3xl sm:text-5xl lg:text-6xl leading-none uppercase mb-3"><strong>PLAY TO LEARN</strong></h1>
            <h4 class="leading-tight">Improve your skills in<br class="sm:hidden"> just 10 minutes a day.</h4>
        </div>
        <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-20 mt-5"></i>
        <div class="h-full w-full absolute top-0 left-0 right-0 bottom-0 z-10 bg-{{ $theme }} opacity-50"></div>
        <div class="h-full w-full absolute top-0 left-0 right-0 bottom-0 z-10 bg-black opacity-20"></div>
        <video class="object-cover w-full h-full absolute z-0"
            x-ref="playToLearnVideo"
            x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"
            x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"
            data-src="{{ $vid }}" type="video/mp4" autoplay muted loop playsinline>
        </video>
    </div>
@else
    <section class="text-center pt-7 sm:pt-9 relative"
        x-data="{ stick: false }"
        x-init="window.addEventListener('scroll', () => {
        stick = window.scrollY + window.innerHeight > $refs.stickySection.offsetTop + $refs.stickySection.offsetHeight;
    })">
        <div class="w-auto inline-block py-3 sm:py-4 px-4 sm:px-6 bg-white rounded-xl z-10 sticky top-[40vh]"
            :class="{ 'bottom-auto': stick }" x-ref="stickySection">

            <h1 class="font-lexend  text-3xl sm:text-5xl lg:text-6xl leading-none uppercase mb-1 sm:mb-3"><strong>PLAY TO LEARN</strong></h1>
            <h4 class="leading-tight">Improve your skills in just<br class="sm:hidden">  10 minutes a day.</h4>
        </div>
        <div class="overflow-hidden pt-2 sm:pt-6">
            <div class="inline-block mx-auto left-1/2 relative xl:w-full -translate-x-1/2">
                <div class="flex flex-wrap justify-center mx-auto w-[490px] sm:w-[1010px] lg:w-[1250px] xl:w-[1400px]">
                    @foreach($workoutImages as $image)
                        <img src="{{ $image['src'] }}" style="{{ $image['animation'] }}" loading="lazy"
                            class="h-24 sm:h-32 xl:h-36 rounded-xl overflow-hidden mx-1.5 my-1 ease-in-out transition-opacity">
                    @endforeach
                </div>
            </div>
        </div>
    </section>
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
                <div class="h-full rounded-xl p-7 lg:p-10 pb-64 sm:pb-48 @if($theme != 'musora') text-white @else text-black @endif flex relative"
                    :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                    x-intersect.once="lazyLoad = true; $refs.workout.src = $refs.workout.dataset.src;">
                    <div class="absolute inset-0 w-full h-full rounded-xl object-cover bg-top" style="background: linear-gradient(180deg, transparent, rgba(246, 248, 252, 0.9));">
                        <picture>
                            <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $workoutsBG }}" media="(min-width:1024px)">
                            <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/840x0/filters:quality(95)/{{ $workoutsBG }}" media="(min-width:640px)">
                            <img x-ref="workout"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/5x0/filters:quality(10)/filters:blur(5)/{{ $workoutsBG }}"
                                data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/{{ $workoutsBG }}"
                                alt="Workouts Background"
                                class="w-full h-full object-cover rounded-xl transition-opacity opacity-0 duration-300"
                                onload="this.classList.remove('opacity-0');"
                                loading="lazy">
                        </picture>
                    </div>

                    <div class="relative z-10">
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
