<style>
    .big-promo-banner{z-index:98;}.big-promo-banner .text-right{flex-grow:1}.big-promo-banner h1.logo{color:#000;margin:0 auto;font-size:25px}@media (min-width:768px){.big-promo-banner h1.logo{font-size:28px}}@media (min-width:991px){.big-promo-banner h1.logo{font-size:35px}}.big-promo-banner p.text{font:400 17px/1.2em Open Sans,sans-serif;display:inline-block;}@media (min-width:768px){.big-promo-banner p.text{font-size:16px}}@media (min-width:991px){.big-promo-banner p.text{font-size:18px;white-space:nowrap}}.big-promo-banner p.text strong{display:inline-block}
    .promo-banner-shim{display:block;width:100%;height:40px}
    .promo-banner{transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Open Sans,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:white;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}
</style>
 <div class="big-promo-banner text-white text-center lg:text-left relative py-2 bg-cover bg-center shadow-lg @if(!empty($isFixed)) z-[60] sticky top-[40px] md:top-[56px] @endif"
     style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/summer-sale/header-bg.webp');">
    <div class="row container max-w-4xl mx-auto px-3 sm:flex items-center justify-between">
        <a @if($theme === 'drumeo') href="/drumshop/" @else href="/shop/" @endif>
            @include($theme.'._partials.holiday-logo',[
                'styles' => 'w-auto h-12 sm:h-14',
                'isProductPage' => true,
                'productPageStyles' => 'w-auto h-12 sm:h-14 p-1'
            ])
        </a>
        <span class="text-center sm:text-right flex flex-wrap items-center sm:justify-end">
                <p class="text mx-auto sm:ml-0 sm:mr-3 my-2 sm:my-0 w-full sm:w-auto">
                    @if(!empty($price))
                        @if(round(100 - (100 * ($price / $fullPrice))) > 1)
                            Save <strong>{{ round(100 - (100 * ($price / $fullPrice))) }}%</strong> on {{ $name }}
                        @elseif(!empty($specialText))
                            {!!  $specialText  !!}
                        @endif
                    @endif
                </p>
                @if(empty($noCountdown))
                    <div class="mx-auto" x-data="timer()" x-init="countdown()" x-cloak x-show="day < 7">
                        <div class="flex text-center mx-auto sm:mx-0">
                            <div class="mr-3 sm:mr-4" x-show="timeLeft > 0 && day > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="day">00</div>
                                <div class="text-xs font-bold text-black" x-text="dayText">DAYS</div>
                            </div>
                            <div class="mr-3 sm:mr-4" x-show="timeLeft > 0 && hour > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="hour">00</div>
                                <div class="text-xs font-bold text-black" x-text="hourText">HRS</div>
                            </div>
                            <div class="mr-3 sm:mr-4" x-show="timeLeft > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="minute">00</div>
                                <div class="text-xs font-bold text-black" x-text="minuteText">MIN</div>
                            </div>
                            <div x-show="timeLeft > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="second">00</div>
                                <div class="text-xs font-bold text-black" x-text="secondText">SEC</div>
                            </div>
                            <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                        </div>
                    </div>
                @endif
        </span>
    </div>
</div>

{{--@if(!empty($noBreadcrumb))--}}
{{--    <div class="promo-banner text-center text-white w-full block fixed bg-cover bg-center" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/header-bg.webp');">--}}
{{--        <div class="noise-wrap">--}}
{{--            <div class="row container mx-auto">--}}
{{--                <div class="text text-left">--}}
{{--                    @include($theme.'._partials.holiday-logo',[--}}
{{--                        'styles' => 'logo'--}}
{{--                    ])--}}
{{--                    <p>--}}
{{--                        @if(!empty($price))--}}
{{--                            @if(round(100 - (100 * ($price / $fullPrice))) > 1)--}}
{{--                                <strong>Save <span class="text-promo">{{ round(100 - (100 * ($price / $fullPrice))) }}%</span> on<br> {{ $name }}</strong>--}}
{{--                            @elseif(!empty($specialText))--}}
{{--                                {!! $specialText !!}--}}
{{--                            @endif--}}
{{--                        @endif--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}
