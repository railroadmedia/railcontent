<header class="header-bg hero-header @if(!empty($submitButtonColor) && $submitButtonColor === 'blue') gsotac @endif text-white text-center px-3 py-5 md:py-6 lg:py-8 relative" style="background-color:{{ $bgColor }};background-image:url(https://cdn.musora.com/image/fetch/w_1300,q_auto:best/{{$bgImg}});">
    <div class="container mx-auto relative z-10">
        @if(!empty($playButton) && $playButton == "up") 
            <i data-open="trailer" class="fas fa-play play-button autoplay-video"></i><br>
        @endif

        @foreach ($imgs as $img)
                {!! $img !!}<br>
        @endforeach

        @if(!empty($playButton) && $playButton == "down")
            <i data-open="trailer" class="fas fa-play play-button autoplay-video hover:opacity-80 border-4 border-solid border-white rounded-full cursor-pointer mt-24 mb-12 text-3xl py-4 px-5 md:py-6 md:px-7 md:mt-40 md:mb-24 md:text-4xl duration-300" style="background:rgba(0, 0, 0, 0.6);"></i><br>
        @endif

        @isset($headLine)
            {!! $headLine !!}
        @endisset

        @include("lead-gen.partials._sign-up-form-tw", [
                "formId" => $formId,
                "formName" => $formName,
                "redirectURL" => isset($redirectURL) ? $redirectURL : '',
           ])
    </div>
</header>