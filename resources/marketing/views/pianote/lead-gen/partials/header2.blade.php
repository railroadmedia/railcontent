<div class="promo-heading-background container-fluid" @if(!empty($bg)) style="background: {{ $bg }};" @endif>
    <div class="container promo-heading mx-auto lg:max-w-6xl series px-4 py-10 md:py-12 lg:py-14">
        <img class="big-logo mx-auto" src="{!! $imgSrc !!}" alt="logo">
        @if (!empty($text))
            {!! $text !!}
        @endif

        @if(!empty($form) && $form)
            <div class="email-form">
                @include('pianote.lead-gen._sign-up-form', [
                    "redirect" => true,
                    "formId" => $formId,
                    "formName" => $formName,
                ])
            </div>
        @endif
    </div>
</div>
