<style>
    .big-promo-banner{z-index:98;}.big-promo-banner img{min-width:150px;width:150px;display:inline-block}@media (min-width:991px){.big-promo-banner img{min-width:200px;width:200px}}.big-promo-banner .text-right{flex-grow:1}.big-promo-banner h1.logo{color:#000;margin:0 auto;font-size:25px}@media (min-width:768px){.big-promo-banner h1.logo{font-size:28px}}@media (min-width:991px){.big-promo-banner h1.logo{font-size:35px}}.big-promo-banner p.text{font:400 17px/1.2em Bebas Neue,sans-serif;text-transform:uppercase;display:inline-block;}@media (min-width:768px){.big-promo-banner p.text{font-size:18px}}@media (min-width:991px){.big-promo-banner p.text{font-size:20px;white-space:nowrap}}.big-promo-banner p.text strong{display:inline-block}
    .promo-banner-shim{display:block;width:100%;height:40px}
    .promo-banner{transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Bebas Neue,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:white;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;text-transform:uppercase;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}
</style>
{{-- <div class="big-promo-banner text-white text-center lg:text-left uppercase relative py-4" style="background: #000 url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 100px inset #000;">
    <div class="row container mx-auto px-3 sm:flex items-center justify-between">
            <a href="/drumshop/"><img src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/christmas/holiday-drums.png"></a>
            <span class="text-center sm:text-right flex flex-wrap items-center sm:justify-end">
                <p class="text mx-auto sm:ml-0 sm:mr-3 my-2 sm:my-0 w-full sm:w-auto">@if(!empty($price))
                        @if(round(100 - (100 * ($price / $fullPrice))) > 1)
                            <strong>Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</strong> on {{ $name }}
                        @elseif(!empty($specialText))
                            {!!  $specialText  !!}
                        @endif
                    @endif
                </p>
                @if(empty($noCountdown))
                    <div class="tzcd-big inline-block text-center mx-auto sm:mx-0">
                        <div class="inline-block">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>
                        </div>
                        <div class="inline-block mx-2">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>
                        </div>
                        <div class="inline-block mr-2">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>
                        </div>
                        <div class="inline-block">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>
                        </div>
                    </div>
                @endif
        </span>
    </div>
</div> --}}

@if(!empty($noBreadcrumb))
    <a href="/drumshop" class="promo-banner text-center text-white w-full block fixed" style="background: #000 url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 100px inset #000;">
        <div class="noise-wrap">
            <div class="row container mx-auto">
                <div class="text text-left">
                    <img class="logo" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/christmas/holiday-drums.png">
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

@if(empty($noBreadcrumb))
    <div class="tw-container clearfix tw-max-w-6xl lg:tw-mx-auto">
        <div class="tw-mt-5 tw-px-3 tw-uppercase tw-text-xs tw-mb-2 md:tw-px-4 lg:tw-mb-0">
            <div><a class="tw-text-black tw-no-underline" href="/drumshop/">DRUM SHOP</a> /&nbsp;&nbsp;
                @if(!empty($videos))
                    <a class="tw-text-black tw-no-underline" href="/lessons/">VIDEO LESSONS</a> &nbsp;/&nbsp;
                @elseif(!empty($clothing))
                    <a class="tw-text-black tw-no-underline" href="/clothing/">CLOTHING</a> &nbsp;/&nbsp;
                @elseif(!empty($accessories))
                    <a class="tw-text-black tw-no-underline" href="/accessories/">ACCESSORIES</a> &nbsp;/&nbsp;
                @endif
                <strong>{{ $name }}</strong></div>
        </div>
    </div>
@endif
