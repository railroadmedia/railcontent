@foreach ($lessons as $lesson)
    <a href="{{ $lesson['href'] }}" class="w-full md:w-1/2 lg:w-1/3 px-2 md:px-4 mb-7 md:mb-10 lg:mb-14 step text-center hover:opacity-80 transition-opacity duration-300">
        <div class="relative">
            <i class="fas fa-play absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-50 text-4xl"></i>
            <img class="rounded-3xl border-4" style="border-color:#15283a;" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $lesson['img'] }}">
        </div>
        <p class="uppercase mt-2 mb-1" @isset($lesson['titleColor']) style="color:{{ $lesson['titleColor'] }};" @endisset>{{ $lesson['title'] }}</p>
        <h5><strong>{!! $lesson['desc'] !!}</strong></h5>
    </a>
@endforeach
