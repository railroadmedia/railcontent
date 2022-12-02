<section class="text-center py-10 md:py-16 lg:py-24" style="background:#E5E8E8;">
    <div class="mx-auto max-w-6xl">
        <h1 class="font-bold text-3xl leading-6 uppercase mx-auto mb-3 md:text-4xl lg:text-5xl lg:mb-4" style="color:{{ $themeColor }}; font-family:Roboto Condensed, sans-serif;">{!! $headLine !!}</h1>
        <h2 class="leading-6 mx-auto mb-9 text-base px-3 md:px-4 md:text-xl lg:text-2xl lg:mb-11">{!! $subHeadLine !!}</h2>
        <div class="flex flex-wrap justify-center flex-col sm:justify-between sm:flex-row">
            @foreach ($lessons as $lesson)
                <div class="px-3 sm:w-1/3">
                    <div class="flex justify-center items-center border-2 border-solid rounded-full text-center text-4xl w-16 h-16 mx-auto mb-3 md:p-10 md:mb-6 md:h-24 md:w-24 md:text-5xl" style="border-color:{{ $themeColor }};color:{{ $themeColor }}">
                        {!! $lesson['icon'] !!}
                    </div>
                    <p class="text-sm leading-normal mx-auto mb-5 w-full md:mb-0 md:max-w-full lg:text-base" style="max-width:300px;">
                        <strong class="font-bold mx-auto mb-1 uppercase inline-block md:text-2xl md:mb-2" style="color:{{ $themeColor }};font-family:Roboto Condensed, sans-serif;">
                            {!! $lesson['title'] !!}
                        </strong><br>
                        {!! $lesson['desc'] !!}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
