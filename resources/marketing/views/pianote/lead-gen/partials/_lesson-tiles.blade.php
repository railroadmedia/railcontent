<div class="box with-video flex flex-wrap items-start justify-center mx-auto px-2 lg:max-w-6xl">
    @foreach ($lessons as $lesson)
        <a href="{{ $lesson['watchLink'] }}" class="px-2 md:px-3 {{ $width }} mb-7 lg:mb-4">
            <div class="@if(!empty($ratio)) {{ $ratio }} @endif border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="padding-bottom: 65%; background-image:url({{ $lesson['boxImage'] }});">
                @if(!empty($lesson['watchLink']))
                    <i class="fas fa-play-circle"></i>
                @endif
            </div>
            <h6 class="leading-normal">{!! $lesson['title'] !!}</h6>
        </a>
    @endforeach
</div>