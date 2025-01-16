<section class="text-center px-4 pt-10 sm:py-16 text-white" style="background:#0C1524;">
    <div class="container max-w-6xl mx-auto">
        <div class="max-w-3xl mx-auto text-center mb-4 lg:mb-8">
            @if (!empty($heading))
                <h1 class="leading-none capitalize mb-4 sm:mb-8"><strong>{!! $heading !!}</strong></h1>
            @endif
            @if (!empty($subheading))
                <p class="leading-normal my-2 sm:mb-8 lg:mb-12 lg:px-14">
                    {!! $subheading !!}
                </p>
            @endif
        </div>
        <div class="max-w-6xl mx-auto px-4 pt-7 pb-6 md:pb-0">
            @foreach ($gettings as $key => $getting)
                @if ($getting['position'] === 'right')
                    <div class="flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-8 lg:gap-20 mb-16 md:mb-20">
                        <div class="flex md:justify-center md:items-center text-left md:pl-10 lg:pl-28">
                            <p class="md:text-sm lg:text-base">{!! $getting['desc'] !!}</p>
                        </div>
                        @if (!empty($getting['special']))
                            <video class="-mt-7 rounded-xl" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop></video>
                        @else
                            <img class="-mt-7 rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/{{ $getting['img'] }}" alt="{{ $getting['alt'] }}" />
                        @endif
                    </div>
                @else
                    <div class="flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-8 lg:gap-20 @if ($key !== count($gettings) - 1) mb-16 md:mb-20 @else md:mb-10 @endif">
                        @if (!empty($getting['special']))
                            <video class="-mt-7 rounded-xl" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop></video>
                        @else
                            <img class="-mt-7 rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/{{ $getting['img'] }}" alt="{{ $getting['alt'] }}" />
                        @endif
                        <div class="flex md:justify-center md:items-center text-left md:mb-10 md:pr-10 lg:pr-28">
                            <p class="md:text-sm lg:text-base">{!! $getting['desc'] !!}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>