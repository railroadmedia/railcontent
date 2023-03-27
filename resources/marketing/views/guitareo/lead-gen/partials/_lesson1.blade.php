<section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="@isset($bg)background:{{ $bg }}; @endisset @isset($bgImg) background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/{{$bgImg}}); @endisset">
    <div class="container mx-auto">
        @if(!empty($headLine))
            {!! $headLine !!}
        @endif
        @if(!empty($subHeadLine))
            {!! $subHeadLine !!}
        @endif
        <div class="flex justify-center flex-wrap text-left mx-auto" style="max-width:1200px">
            @foreach($lessons as $key => $lesson)
                <div class="flex w-5/6 sm:flex-auto md:w-1/2 lg:w-1/3 px-2 md:px-3 mb-7 md:mb-10 step">
                    <div class="rounded-xl overflow-hidden" @isset($textbg) style="background: {{ $textbg }}; "@endisset>
                        <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=450,quality=85/{{ $lesson['image'] }}" alt="lesson-{{ $key+1 }}">
                        <div class="px-4 mt-4 mb-2 uppercase lg:text-lg lg:leading-none @isset($font){{$font}}@endisset"><strong>{!! $lesson['title'] !!}</strong></div>

                        @isset($lesson['description'])
                            <p class="px-4 pb-4 opacity-70">{!!  $lesson['description'] !!}</p>
                        @endisset
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
