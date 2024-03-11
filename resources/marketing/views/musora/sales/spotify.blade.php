@extends('musora.sales.subscription', [
    "promoVersion" => true,
    "hideHeader" => true,
])

@section('spotify-banner')
    <p class="leading-tight mb-2 text-sm"><em>Learn your favorite songs for <strong>FREE</strong></em></p>
    <img class="h-7 sm:h-10 mb-9 sm:mb-14 transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1480x0/filters:quality(95)/marketing/musora/membership/redeem/musora-spotify-logo.svg"
        alt="spotify logo" loading="lazy" onload="this.classList.remove('opacity-0')">
@endsection

@section('promo-banner')
    <header class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-16 relative overflow-hidden"
        style="background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);"
    >
        <div class="container max-w-6xl mx-auto relative z-20">
            <img class="sm:hidden inline-block h-24 " src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/promos/march/8-anniversary-logo-black-m.webp" alt="30 day drummer logo" />
            <img class="hidden sm:inline-block sm:h-20 lg:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/960x0/filters:quality(95)/marketing/pianote/promos/march/8-anniversary-logo-black.webp" alt="30 day drummer logo" />
            <p class="leading-tight my-5 lg:my-7">
                Get legacy pricing on your first year <strong>OR</strong> 8 free bonuses with your membership <em class="text-pianote">(worth $987)</em>
                @if(Carbon\Carbon::create(2024, 3, 22, 0, 0, 0, 'America/Vancouver') < Carbon\Carbon::now())
                    <br>
                    <em class="font-black uppercase inline-block mt-2 text-{{ $theme }}">
                        Only
                        <span x-cloak x-data="timer()" x-init="countdown()">
                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                             <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                         </span>
                        left
                    </em>
                @endif
            </p>
            <img class="sm:hidden inline-block h-52 " src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/pianote/promos/march/bundle-header-m.webp" alt="30 day drummer logo" />
            <img class="hidden sm:inline-block sm:h-44 lg:h-64" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1810x0/filters:quality(95)/marketing/pianote/promos/march/bundle-header.webp" alt="30 day drummer logo" />
            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0 mt-5 lg:mt-7">
                <a class="sm:mx-0.5 w-full sm:w-56 join {{ $theme }} smaller sm:order-1 mb-2 sm:mb-0 @if(!empty($promoVersion)) anchor-slide @endif"
                    href="#customize-anchor" aria-label="Customize anchor"
                >Get Started <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i></a>
                @if(empty($noTrailer))
                    <div class="sm:mx-0.5 w-auto sm:w-56 join outline black smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
                @endif
            </div>
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
    </header>
@endsection

@section('final')
    @include('musora.sales.components.order-section-collage', [
    'emailSignup' => true,
    'logo' => 'marketing/musora/membership/redeem/musora-spotify-logo-white.svg',
    'subHeader' => 'LEARN YOUR FAVORITE SONGS FOR FREE.',
    'headerLight' => true,
    'header' => '<strong>30 days of FREE music lessons.</strong><br> Enter your email to get your access<br> code and start your free lessons.',
    'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> No credit card required.</li>
    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> No recurring billing.</li>
    <li class="leading-tight text-musora max-w-xs mx-0"><i class="fa-li fas fa-check"></i> Awesome music lessons.</li>',
    'image' => 'marketing/musora/membership/homepage/webp-format/musora-m-team2.webp',
    ])
@endsection

@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function (){

            $(".ajax-form").submit(function(e) {
                e.preventDefault();

                var pre = $(this).find(".pre-add"),
                    pending = $(this).find(".pending"),
                    success = $(this).find(".success"),
                    fail = $(this).find(".fail"),
                    submitButton = $(this).find(".submit"),
                    disclaimer = $(this).parent().find(".disclaimer"),
                    thankBanner = $(this).parent().find(".thank-you-box"),
                    form = $(this),
                    url = form.attr("action");

                pre.addClass("hide hidden");
                success.addClass("hide hidden");
                fail.addClass("hide hidden");
                pending.removeClass("hide hidden");
                submitButton.removeClass("error");

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function() {
                        form.addClass("hide hidden");
                        disclaimer.addClass("hide hidden");
                        thankBanner.addClass("active");

                        pending.addClass("hide hidden");
                        success.removeClass("hide hidden");
                    },
                    error: function() {
                        submitButton.addClass("error");

                        pending.addClass("hide hidden");
                        fail.removeClass("hide hidden");
                    }
                });
            });
        });
    </script>
@endsection
