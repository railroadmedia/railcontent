<header class="header-bg text-center text-white pt-20 pb-6 sm:py-9 md:py-12 lg:py-16 px-4 bg-top bg-no-repeat" style="background-color:#00101d;">
    <div class="container mx-auto">
        @if (!empty($upperImg))
            {!! $upperImg !!}
        @endif
        <i class="fas fa-play play-button autoplay-video {{ $playButtonStyles }}" data-open="trailer"></i><br>
        @if (!empty($lowerImg))
            {!! $lowerImg !!}
        @endif
        @if (!empty($text))
            {!! $text !!}
        @endif
        <div class="max-w-3xl mx-auto">
            @if (!empty($nameInput))
                @include('pianote._partials.sign-up-form', [
                        "recaptchaKey" => $recaptchaKey,
                    "formId" => $formId,
                    "formName" => $formName,
                    "nameInput" => true,
                        'stacked' => true,
                ])
            @else
                @include('pianote._partials.sign-up-form', [
                        "recaptchaKey" => $recaptchaKey,
                    "formId" => $formId,
                    "formName" => $formName,
                ])
            @endif
        </div>
    </div>
</header>
