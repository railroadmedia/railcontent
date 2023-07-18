@foreach ($lessons as $lesson)
    <div class="w-full md:w-1/2 lg:w-1/3 px-2 md:px-4 mb-7 md:mb-10 lg:mb-14 step text-center">
        <div class="relative @isset($lesson['playButton']) autoplay-video cursor-pointer transition-opacity duration-300 hover:opacity-80  @endisset" @isset($lesson['data']) data-open="{{ $lesson['data'] }}" @endisset >
            @isset($lesson['playButton'])
                <i class="fas fa-play absolute left-1/2 top-1/2 text-5xl animated infinite pulse" style="margin: -21px -24px;"></i>
            @else
                <i class="fas fa-lock absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-40 text-4xl"></i>
            @endisset
        <img class="rounded-3xl border-4" style="border-color:#15283a;" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $lesson['img'] }}">
        </div>
        <p class="uppercase mt-2 mb-1" @isset($lesson['titleColor']) style="color:{{ $lesson['titleColor'] }};" @endisset>{{ $lesson['title'] }}</p>
        <h5><strong>{!! $lesson['desc'] !!}</strong></h5>
    </div>
@endforeach
