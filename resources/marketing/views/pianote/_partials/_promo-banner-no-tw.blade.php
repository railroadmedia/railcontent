<style>
    .big-promo-banner{z-index:98;}.big-promo-banner img{min-width:150px;width:150px;display:inline-block}@media (min-width:991px){.big-promo-banner img{min-width:200px;width:200px}}.big-promo-banner .text-right{flex-grow:1}.big-promo-banner h1.logo{color:#000;margin:0 auto;font-size:25px}@media (min-width:768px){.big-promo-banner h1.logo{font-size:28px}}@media (min-width:991px){.big-promo-banner h1.logo{font-size:35px}}.big-promo-banner p.text{font:400 17px/1.2em Bebas Neue,sans-serif;text-transform:uppercase;display:inline-block;}@media (min-width:768px){.big-promo-banner p.text{font-size:18px}}@media (min-width:991px){.big-promo-banner p.text{font-size:20px;white-space:nowrap}}.big-promo-banner p.text strong{display:inline-block}
    .big-promo-banner .tzcd-big h2, .big-promo-banner .tzcd-big p {margin:0 auto!important;}
    .promo-banner-shim{display:block;width:100%;height:40px}
    .promo-banner{transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Bebas Neue,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:#000;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;text-transform:uppercase;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}
</style>
 <div class="big-promo-banner text-white text-center lg:text-left uppercase relative py-4" style="background: #000;">
    <div class="row container mx-auto px-3 sm:flex items-center justify-between">
        <a href="/shop/">
            @include($theme.'._partials.holiday-logo',[
                'styles' => 'w-auto max-h-12'
            ])
        </a>
        <span class="text-center sm:text-right flex flex-wrap items-center sm:justify-end">
                <p class="text mx-auto sm:ml-0 sm:mr-3 my-2 sm:my-0 w-full sm:w-auto">
                    @if(!empty($price))
                        @if(round(100 - (100 * ($price / $fullPrice))) > 1)
                            <strong class="text-promo">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</strong> on {{ $name }}
                        @elseif(!empty($specialText))
                            {!!  $specialText  !!}
                        @endif
                    @endif
                </p>
                @if(empty($noCountdown))
                <div class="flex"  x-data="timer()" x-init="countdown()">
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && day">
                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="day">00</div>
                            <div class="text-xs font-bold text-promo" x-text="dayText">DAYS</div>
                        </div>
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && hour > 0">
                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="hour">00</div>
                            <div class="text-xs font-bold text-promo" x-text="hourText">HRS</div>
                        </div>
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0">
                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="minute">00</div>
                            <div class="text-xs font-bold text-promo" x-text="minuteText">MIN</div>
                        </div>
                        <div x-show="timeLeft > 0">
                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="second">00</div>
                            <div class="text-xs font-bold text-promo" x-text="secondText">SEC</div>
                        </div>
                        <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                    </div>
            @endif
        </span>
    </div>
</div>

@if(!empty($noBreadcrumb))
    <a href="/shop" class="promo-banner text-center text-white w-full block fixed" style="background: #000;">
        <div class="noise-wrap">
            <div class="row container mx-auto">
                <div class="text text-left">
                    @include('pianote._partials.holiday-logo',[
                        'styles' => 'logo'
                    ])
                    <p>
                        @if(!empty($price))
                            @if(round(100 - (100 * ($price / $fullPrice))) > 1)
                                Save {{ round(100 - (100 * ($price / $fullPrice))) }}% on <br><strong>{{ $name }}</strong>.
                            @elseif(!empty($specialText))
                                {!! $specialText !!}
                            @endif
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </a>
@endif
