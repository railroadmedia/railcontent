<header class="header-bg hero-header @if(!empty($submitButtonColor) && $submitButtonColor === 'blue') gsotac @endif text-white text-center px-3 py-5 md:py-6 lg:py-8 relative bg-no-repeat" style="background-color:{{ $bgColor }};">
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

        @if(!empty($headLine))
            {!! $headLine !!}
        @endif

        @include("guitareo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                "formId" => $formId,
                "formName" => $formName,
                "redirectURL" => isset($redirectURL) ? $redirectURL : '',
           ])
    </div>
</header>
