<section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="@isset($bg)background:{{ $bg }}; @endisset @isset($bgImg) background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/{{$bgImg}}); @endisset">
    <div class="container mx-auto">
        @isset($headLine)
            <h3>{!! $headLine !!}</h3>
        @endisset
        @isset($subHeadLine)
            <h6 class="opacity-70 mt-3 mb-8 leading-normal">{!! $subHeadLine !!}</h6>
        @endisset
        <div class="flex flex-wrap text-left mx-auto" style="max-width:1200px">
            @foreach($lessons as $lesson)
                <div class="flex flex-auto w-full md:w-1/2 lg:w-1/3 px-2 md:px-3 mb-7 md:mb-10 step">
                    <div class="rounded-xl overflow-hidden" @isset($textbg) style="background: {{ $textbg }}; "@endisset>
                        <img class="w-full" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $lesson['image'] }}">
                        <h6 class="px-4 mt-4 mb-2 uppercase @isset($font){{$font}}@endisset"><strong>{!! $lesson['title'] !!}</strong></h6>

                        @isset($lesson['description'])
                            <p class="px-4 pb-4 opacity-70">{!!  $lesson['description'] !!}</p>
                        @endisset
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>