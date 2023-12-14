<div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative z-20 -mb-10" x-on:click="trailer = true;">
    <div class="absolute top-0 left-0 right-0 text-white z-10 text-center px-4 pt-10">
        <img class="h-10 sm:h-20 lg:h-24 mb-3 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2023/just-press-play-title3.png" alt="collage intro mobile" loading="lazy" onload="this.classList.remove('opacity-0')">
        <h3>Improve your skills in just 10 minutes a day.</h3>
    </div>
    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
    <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" data-src="{{ $vid }}" type="video/mp4" autoplay muted loop playsinline></video>
</div>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-4xl mx-auto">

        <div class="flex flex-wrap sm:flex-nowrap justify-center text-left">
            <div class="">
                <div class="rounded-xl p-7 sm:p-10 mb-5 sm:mb-7" style="background-color:#f6f8fc;">
                    <h5 class="leading-tight mb-3"><strong>Your daily energy boost.</strong></h5>
                    <h6 class="leading-normal max-w-lg mx-0">You shouldn't lose momentum between lessons. We’ll help you build better habits through bite-sized guided practice sessions.</h6>
                </div>
                <div class="rounded-xl p-7 sm:p-10" style="background-color:#f6f8fc;">
                    <h5 class="leading-tight mb-3"><strong>Accountability unlocked.</strong></h5>
                    <h6 class="leading-normal max-w-lg mx-0">Every workout has an on-screen practice partner and countdown timer to support your commitment so you actually see results!</h6>
                </div>
            </div>
            <div class="mb-5 sm:mb-0 sm:pl-7 sm:w-7/12 flex-grow-0">
                <div class="h-full rounded-xl p-7 sm:p-10 pb-48 bg-black text-white flex bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/new-drummers-image.jpg');">
                    <div>
                        <h5 class="leading-tight mb-3"><strong>Practice with your heroes.</strong></h5>
                        <h6 class="leading-normal max-w-lg mx-0">Never practice alone. Your favorite musicians and teachers will share their tips, cheer you along, and help you learn by playing!</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
