@php
    $buttonBorder = (!empty($buttonBorder)) ? $buttonBorder : '';
@endphp

<section class="text-center py-16 md:py-20 lg:py-24 px-4 text-white bg-center bg-cover lazyload enter-email" @if(!empty($bgStyles)) style="{{ $bgStyles }}" @endif>
    <div class="container mx-auto">
        @if(!empty($content))
            {!! $content !!}
        @endif
        <div class="mx-auto" style="max-width:700px">
            @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                "formId" => $formId,
                "formName" => $formName,
                "buttonBorder" => $buttonBorder,
            ])
        </div>
    </div>
</section>
