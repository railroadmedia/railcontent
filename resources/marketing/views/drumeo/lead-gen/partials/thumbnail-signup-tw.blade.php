<div {{ !empty($modal) ? 'data-open=' . $modal : 'data-open=signUpModal' }} class="block mb-7 md:mb-10 text-left {{ !empty($modal) ? '' : 'cursor-pointer outline-none autoplay-video' }}">
    <div class="relative rounded-lg overflow-hidden aspect-16:9 mb-3 md:mb-4 bg-center bg-no-repeat bg-contain {{ !empty($locked) ? 'locked' : '' }}" style="background-image:url(https://cdn.musora.com/image/fetch/w_400,q_auto:best/{{ $image }});">
        @if(!empty($badge))
            <p class="bg-drumeo text-white absolute left-0 top-0 text-center inline-block uppercase rounded-br-lg px-2 lg:px-3" style="z-index: 9;"><strong class="font-black">{{ $badge }}</strong></p>
        @endif
        @if(!empty($locked))
            <span class="absolute inset-0" style="background: rgba(0, 0, 0, 0.4);"><i class="fas fa-lock absolute inset-1/2 translate--1/2 z-10 text-3xl md:text-5xl lg:text-6xl"></i></span>
        @endif
    </div>
    @if(!empty($title))
        <div class="mb-1"><strong>{{ $title }}</strong></div>
    @endif
    @if(!empty($subTitle))
        <p>{{ $subTitle }}</p>
    @endif
</div>