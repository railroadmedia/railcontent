<section class="final-pitch px-2 py-14 md:py-20 lg:py-24 text-white text-center bg-center bg-cover lazyload" style="@isset($bgColor) background:{{ $bgColor }}; @endisset @isset($bgImg) background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/{{ $bgImg }}); @endisset">
    <div class="container mx-auto md:max-w-2xl lg:max-w-3xl">
        {!! $img !!}

        {!! $text !!}

        @if(!empty($submitButtonColor))
            @include("guitareo.lead-gen.partials._sign-up-form-tw", [
                "formId" => $formId,
                "formName" => $formName,
                "submitButtonColor" => $submitButtonColor,
            ])
        @else
            @include("guitareo.lead-gen.partials._sign-up-form-tw", [
                "formId" => $formId,
                "formName" => $formName,
            ])
        @endif
    </div>
</section>
