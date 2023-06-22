<section class="final-pitch px-2 py-14 md:py-20 lg:py-24 text-white text-center bg-center bg-cover lazyload" style="@isset($bgColor) background:{{ $bgColor }}; @endisset @isset($bgImg) background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/{{ $bgImg }}); @endisset">
    <div class="container mx-auto md:max-w-2xl lg:max-w-3xl">
        {!! $img !!}

        {!! $text !!}

        @if(!empty($submitButtonColor))
            @include("guitareo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                "formId" => $formId,
                "formName" => $formName,
                "submitButtonColor" => $submitButtonColor,
            ])
        @else
            @include("guitareo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                "formId" => $formId,
                "formName" => $formName,
            ])
        @endif
    </div>
</section>
