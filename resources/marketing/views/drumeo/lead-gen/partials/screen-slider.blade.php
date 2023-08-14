@php
    $screenNum = 1;
@endphp

<section class="content-section py-16" style="background: linear-gradient(to bottom, #01050f 80%, #021225);">
    <div class="feature-rotater w-full max-w-md md:max-w-full flex flex-wrap md:flex-nowrap items-center justify-center mx-auto my-4 md:my-14 lg:my-20 px-4">
        <div class="pic-wrap md:order-1 mb-10 md:my-5 md:my-0 pl-0 md:pl-5 lg:pl-14 w-56 md:w-80 lg:w-96">
            @foreach ($screens as $screen)
                <img class="lazyload side-pic songs w-full h-auto rounded-2xl @if(!empty($screen['first'])) md:hidden @else hidden @endif" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $screen['img'] }}" alt="method-screen-{{ $screenNum }}">
                {{--{{ $screenNum++ }}--}}
            @endforeach
        </div>
        <div class="text-left text-gray-400">
            @foreach ($features as $feature)
                <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90 @if(!empty($feature['first'])) active @endif">
                    <i class="font-light flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs {{ $feature['icon'] }}" style="color: #ec0061;"></i>
                    <div class="pl-3">
                        <h4 class="mx-auto text-lg md:text-xl lg:text-2xl"><strong>{{ $feature['title'] }}</strong></h4>
                        <p>{{ $feature['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- NOTE: paste thses styles and js in the layout --}}

{{-- .text-icon-wrap {
    color: #fff;
}

.text-icon-wrap.active {
    color: #fff;
    opacity: 1 !important;
}

.side-pic {
    border: 1px solid #2C465F;
}

@media (min-width: 768px) {
    .text-icon-wrap {
        color: inherit;
    }

    .side-pic.active {
        display: block;
    }
} --}}


{{-- <script>
    $(document).ready(function () {
        $(document).foundation();

        // song point cycle
        var $songPoint = $('.side-pic.songs'),
            $songPointToggle = $('.text-icon-wrap.songs'),
            currentSongPoint = 0,
            updateIndex = function (currentSongPoint) {
                $songPoint.removeClass('active');
                $songPointToggle.removeClass('active');

                $songPoint.eq(currentSongPoint).addClass('active');
                $songPointToggle.eq(currentSongPoint).addClass('active');
            },
            autoplaySongPoints = setInterval(function () {
                if(currentSongPoint < 4){
                    currentSongPoint++;
                    updateIndex(currentSongPoint);
                }
                else {
                    currentSongPoint = 0;
                    updateIndex(currentSongPoint);
                }
            }, 10000);

        $songPoint.first().addClass('active');
        $songPointToggle.first().addClass('active');
        $songPointToggle.on('click', function () {
            updateIndex($songPointToggle.index($(this)));
            currentSongPoint = $songPointToggle.index($(this));
            clearInterval(autoplaySongPoints);
        });
    });
</script> --}}
