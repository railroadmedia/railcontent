<section class="header bottom text-center">
    <div class="container mx-auto max-w-5xl px-4 text-center">
        <h1>{{ $headLine }}</h1>

        @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
            "formId" => $formId,
            "formName" => $formName,
        ])
    </div>
</section>
